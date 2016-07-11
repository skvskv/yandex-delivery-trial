<?php
namespace YDT\Application;
use League\Csv\Reader;
use SplFixedArray;
use YDT\DataModel\HouseRoomDescriptor;
use YDT\DataModel\Province;
use YDT\DataModel\ProvinceOptimized;

class Application
{
    /** @var  SplFixedArray */
    protected $provinces;

    /** @var  string */
    protected $citiesFileName;

    /** @var  string */
    protected $pricesFileName;

    /** @return SplFixedArray */
    public function getProvinces()
    {
        return $this->provinces;
    }

    /**
     * @param SplFixedArray $provinces
     * @return Application
     */
    public function setProvinces($provinces)
    {
        $this->provinces = $provinces;
        return $this;
    }

    /** @return string */
    public function getCitiesFileName()
    {
        return $this->citiesFileName;
    }

    /**
     * @param string $citiesFileName
     * @return Application
     */
    public function setCitiesFileName($citiesFileName)
    {
        $this->citiesFileName = $citiesFileName;
        return $this;
    }

    /** @return string */
    public function getPricesFileName()
    {
        return $this->pricesFileName;
    }

    /**
     * @param string $pricesFileName
     * @return Application
     */
    public function setPricesFileName($pricesFileName)
    {
        $this->pricesFileName = $pricesFileName;
        return $this;
    }

    public function findProvinceById($provinceId)
    {
        /** @var $probe Province | ProvinceOptimized */
        $left = 0;
        $right = $this->provinces->count();
        while ($left<=$right)
        {
            $probeIdx = (int)(($left+$right) / 2);
            $probe = $this->provinces->offsetGet($probeIdx);
            if ($provinceId < $probe->getId())
            {
                $right = $probeIdx - 1;
                continue;
            }
            if ($probe->getId() < $provinceId)
            {
                $left = $probeIdx + 1;
                continue;
            }
            if ( $provinceId == $probe->getId() )
            {
                return $probe;
            }
        }

        return null;
    }

    public function __construct($citiesFileName, $pricesFileName)
    {
        $this->citiesFileName = $citiesFileName;
        $this->pricesFileName = $pricesFileName;
    }

    public function init()
    {
        if (!ini_get("auto_detect_line_endings")) {
            ini_set("auto_detect_line_endings", '1');
        }

        $this->readCitiesData();
        $this->readPricesData();
        $this->optimizeProvinces();
    }

    public function run()
    {
        while( ($inputLine = fgets(STDIN)) )
        {
            $inputLine = trim($inputLine);
            if ("" !== $inputLine)
            {
                $inputRow = explode(',', $inputLine);
                $inputRow['provinceId'] = (int) $inputRow[0];
                $inputRow['roomAmount'] = (int) $inputRow[1];
                $price = $this->getPriceByInputRow($inputRow);
                if (is_null($price))
                {
                    echo "false\n";
                }
                else
                {
                    echo $price*$inputRow['roomAmount']."\n";
                }
            }
        }
    }

    protected function getPriceByInputRow($row)
    {
        /** @var $province ProvinceOptimized */
        $province = $this->findProvinceById($row['provinceId']);
        if (is_null($province))
        {
            return null;
        }
        while($province->getId() !== 0)
        {
            if (!is_null($province->getPrice($row['roomAmount'])))
            {
                return $province->getPrice($row['roomAmount']);
            }
            $province = $province->getParent();
        }

        return null;
    }

    protected function readCitiesData()
    {
        $csvSchema = ['name', 'type', 'id', 'parentId'];
        $provinceDataReader = Reader::createFromPath(PROVINCE_DATAFILE);
        $tmpArray = [];
        foreach ($provinceDataReader->fetchAssoc($csvSchema) as $idx => $row)
        {
            $tmpArray[] = self::createProvinceFromCsvRow($row);
        }
        $tmpArray[] = (new Province())->setId(0)->setParentId(0)->setName('none')->setType('root');
        usort($tmpArray, [$this, 'compareProvincesById']);
        $this->provinces = SplFixedArray::fromArray($tmpArray);
        unset($tmpArray, $provinceDataReader);
    }

    protected function readPricesData()
    {
        $csvSchema = ['sFrom', 'sTo', 'unitPrice', 'provinceId'];
        $pricesDataReader = Reader::createFromPath($this->pricesFileName);
        foreach($pricesDataReader->fetchAssoc($csvSchema) as $idx => $row)
        {
            $hrpDescriptor = self::createHouseRoomDescriptorFromCsvRow($row);
            $this->findProvinceById($row['provinceId'])->addHouseRoomDescriptor($hrpDescriptor);
        }
    }

    protected function optimizeProvinces()
    {
        /** @var  $province Province */
        foreach ($this->provinces as $index => $province)
        {
            $this->provinces->offsetSet($index, ProvinceOptimized::createFromProvince($province));
        }

        /** @var  $province ProvinceOptimized */
        foreach ($this->provinces as $index => $province)
        {
            if (0 !== $province->getId())
            {
                $province->setParent(
                    $this->findProvinceById($province->getParentId())
                );
            }
        }
    }

    protected static function compareProvincesById(Province $a, Province $b)
    {
        if ($a->getId() == $b->getId())
        {
            return 0;
        }
        return ( ($a->getId() < $b->getId()) ? -1 : 1 );
    }

    protected static function createProvinceFromCsvRow($row)
    {
        return (new Province())
                ->setId((int)$row['id'])
                ->setName((int)$row['name'])
                ->setId((int)$row['id'])
                ->setParentId((int)$row['parentId']);
    }

    protected static function createHouseRoomDescriptorFromCsvRow($row)
    {
        return new HouseRoomDescriptor((int)$row['provinceId'], (int)$row['unitPrice'], (int)$row['sFrom'], (int)$row['sTo']);
    }
}