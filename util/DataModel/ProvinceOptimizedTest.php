<?php
namespace YDT\Tests\DataModel;
use YDT\DataModel\HouseRoomDescriptor;
use YDT\DataModel\Province;
use YDT\DataModel\ProvinceOptimized;

class ProvinceOptimizedTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Province
     */
    protected $province;

    /**
     * @var ProvinceOptimized
     */
    protected $pro;

    public function setup()
    {
        $this->province = new Province();
    }

    /**
     * @covers createFromProvince
     */
    public function testSimpleSingular()
    {
        $this->pro = ProvinceOptimized::createFromProvince($this->province);
        $this->assertInstanceOf(ProvinceOptimized::class, $this->pro);
        $this->assertEquals(0, $this->pro->getHouseroomDescriptors()->getSize());
    }

    /**
     * @return array
     */
    public function properDataProvider()
    {
        $dataSets = [
            ['dataSet'=>[
                'descriptors' => [],
                'id' => 3,
                'parentId' => '1',
                'type' => 'Город',
                'name' => 'Китежград',
                'guess' => false,
                'roomAmount' => 31,
                'price' => null
            ]],
            ['dataSet'=>[
                'descriptors' => [
                    ['sFrom'=> 5, 'sTo'=> 12,  'houseroomUnitPrice'=>11, 'provinceId'=> 3],
                    ['sFrom'=> 13, 'sTo'=> 28, 'houseroomUnitPrice'=>12, 'provinceId'=> 3],
                    ['sFrom'=> 29, 'sTo'=> 37, 'houseroomUnitPrice'=>13, 'provinceId'=> 3],
                    ['sFrom'=> 38, 'sTo'=> 46, 'houseroomUnitPrice'=>14, 'provinceId'=> 3],
                    ['sFrom'=> 47, 'sTo'=> 53, 'houseroomUnitPrice'=>15, 'provinceId'=> 3],
                    ['sFrom'=> 54, 'sTo'=> 59, 'houseroomUnitPrice'=>16, 'provinceId'=> 3],
                    ['sFrom'=> 60, 'sTo'=> 67, 'houseroomUnitPrice'=>17, 'provinceId'=> 3],
                    ['sFrom'=> 68, 'sTo'=> 74, 'houseroomUnitPrice'=>18, 'provinceId'=> 3],
                    ['sFrom'=> 75, 'sTo'=> 81, 'houseroomUnitPrice'=>19, 'provinceId'=> 3],
                    ['sFrom'=> 82, 'sTo'=> 89, 'houseroomUnitPrice'=>20, 'provinceId'=> 3],
                    ['sFrom'=> 90, 'sTo'=> 100,'houseroomUnitPrice'=>21, 'provinceId'=> 3],
                ],
                'id' => 3,
                'parentId' => '1',
                'type' => 'Город',
                'name' => 'Китежград',
                'guess' => true,
                'roomAmount' => 31,
                'price' => 13
            ]],
            ['dataSet'=>[
                'descriptors' => [
                    ['sFrom'=> 5, 'sTo'=> 12,  'houseroomUnitPrice'=>11, 'provinceId'=> 3],
                    ['sFrom'=> 13, 'sTo'=> 28, 'houseroomUnitPrice'=>12, 'provinceId'=> 3],

                    ['sFrom'=> 38, 'sTo'=> 46, 'houseroomUnitPrice'=>14, 'provinceId'=> 3],
                    ['sFrom'=> 47, 'sTo'=> 53, 'houseroomUnitPrice'=>15, 'provinceId'=> 3],
                    ['sFrom'=> 54, 'sTo'=> 59, 'houseroomUnitPrice'=>16, 'provinceId'=> 3],
                    ['sFrom'=> 60, 'sTo'=> 67, 'houseroomUnitPrice'=>17, 'provinceId'=> 3],
                    ['sFrom'=> 68, 'sTo'=> 74, 'houseroomUnitPrice'=>18, 'provinceId'=> 3],
                    ['sFrom'=> 75, 'sTo'=> 81, 'houseroomUnitPrice'=>19, 'provinceId'=> 3],
                    ['sFrom'=> 82, 'sTo'=> 89, 'houseroomUnitPrice'=>20, 'provinceId'=> 3],
                    ['sFrom'=> 90, 'sTo'=> 100,'houseroomUnitPrice'=>21, 'provinceId'=> 3],
                ],
                'id' => 3,
                'parentId' => '1',
                'type' => 'Город',
                'name' => 'Китежград',
                'guess' => true,
                'roomAmount' => 31,
                'price' => null
            ]],
            ['dataSet'=>[
                'descriptors' => [
                    ['sFrom'=> 54, 'sTo'=> 59, 'houseroomUnitPrice'=>16, 'provinceId'=> 3],
                    ['sFrom'=> 60, 'sTo'=> 67, 'houseroomUnitPrice'=>17, 'provinceId'=> 3],
                    ['sFrom'=> 68, 'sTo'=> 74, 'houseroomUnitPrice'=>18, 'provinceId'=> 3],
                    ['sFrom'=> 75, 'sTo'=> 81, 'houseroomUnitPrice'=>19, 'provinceId'=> 3],
                    ['sFrom'=> 82, 'sTo'=> 89, 'houseroomUnitPrice'=>20, 'provinceId'=> 3],
                    ['sFrom'=> 90, 'sTo'=> 100,'houseroomUnitPrice'=>21, 'provinceId'=> 3],
                ],
                'id' => 3,
                'parentId' => '1',
                'type' => 'Город',
                'name' => 'Китежград',
                'guess' => false,
                'roomAmount' => 31,
                'price' => null
            ]],
            ['dataSet'=>[
                'descriptors' => [
                    ['sFrom'=> 54, 'sTo'=> 59, 'houseroomUnitPrice'=>16, 'provinceId'=> 3],
                    ['sFrom'=> 60, 'sTo'=> 67, 'houseroomUnitPrice'=>17, 'provinceId'=> 3],
                    ['sFrom'=> 68, 'sTo'=> 74, 'houseroomUnitPrice'=>18, 'provinceId'=> 3],
                    ['sFrom'=> 75, 'sTo'=> 81, 'houseroomUnitPrice'=>19, 'provinceId'=> 3],
                    ['sFrom'=> 82, 'sTo'=> 89, 'houseroomUnitPrice'=>20, 'provinceId'=> 3],
                    ['sFrom'=> 90, 'sTo'=> 100,'houseroomUnitPrice'=>21, 'provinceId'=> 3],
                ],
                'id' => 3,
                'parentId' => '1',
                'type' => 'Город',
                'name' => 'Китежград',
                'guess' => false,
                'roomAmount' => 101,
                'price' => null
            ]],
            ['dataSet'=>[
                'descriptors' => [
                    ['sFrom'=> 5, 'sTo'=> 12,  'houseroomUnitPrice'=>11, 'provinceId'=> 3],
                    ['sFrom'=> 13, 'sTo'=> 28, 'houseroomUnitPrice'=>12, 'provinceId'=> 3],
                    ['sFrom'=> 29, 'sTo'=> 37, 'houseroomUnitPrice'=>13, 'provinceId'=> 3],
                    ['sFrom'=> 38, 'sTo'=> 46, 'houseroomUnitPrice'=>14, 'provinceId'=> 3],
                    ['sFrom'=> 47, 'sTo'=> 53, 'houseroomUnitPrice'=>15, 'provinceId'=> 3],
                    ['sFrom'=> 54, 'sTo'=> 59, 'houseroomUnitPrice'=>16, 'provinceId'=> 3],
                    ['sFrom'=> 60, 'sTo'=> 67, 'houseroomUnitPrice'=>17, 'provinceId'=> 3],
                    ['sFrom'=> 68, 'sTo'=> 74, 'houseroomUnitPrice'=>18, 'provinceId'=> 3],
                    ['sFrom'=> 75, 'sTo'=> 81, 'houseroomUnitPrice'=>19, 'provinceId'=> 3],
                    ['sFrom'=> 82, 'sTo'=> 89, 'houseroomUnitPrice'=>20, 'provinceId'=> 3],
                    ['sFrom'=> 90, 'sTo'=> 100,'houseroomUnitPrice'=>21, 'provinceId'=> 3],
                ],
                'id' => 3,
                'parentId' => '1',
                'type' => 'Город',
                'name' => 'Китежград',
                'guess' => true,
                'roomAmount' => 5,
                'price' => 11
            ]],
            ['dataSet'=>[
                'descriptors' => [
                    ['sFrom'=> 5, 'sTo'=> 12,  'houseroomUnitPrice'=>11, 'provinceId'=> 3],
                    ['sFrom'=> 13, 'sTo'=> 28, 'houseroomUnitPrice'=>12, 'provinceId'=> 3],
                    ['sFrom'=> 29, 'sTo'=> 37, 'houseroomUnitPrice'=>13, 'provinceId'=> 3],
                    ['sFrom'=> 38, 'sTo'=> 46, 'houseroomUnitPrice'=>14, 'provinceId'=> 3],
                    ['sFrom'=> 47, 'sTo'=> 53, 'houseroomUnitPrice'=>15, 'provinceId'=> 3],
                    ['sFrom'=> 54, 'sTo'=> 59, 'houseroomUnitPrice'=>16, 'provinceId'=> 3],
                    ['sFrom'=> 60, 'sTo'=> 67, 'houseroomUnitPrice'=>17, 'provinceId'=> 3],
                    ['sFrom'=> 68, 'sTo'=> 74, 'houseroomUnitPrice'=>18, 'provinceId'=> 3],
                    ['sFrom'=> 75, 'sTo'=> 81, 'houseroomUnitPrice'=>19, 'provinceId'=> 3],
                    ['sFrom'=> 82, 'sTo'=> 89, 'houseroomUnitPrice'=>20, 'provinceId'=> 3],
                    ['sFrom'=> 90, 'sTo'=> 100,'houseroomUnitPrice'=>21, 'provinceId'=> 3],
                ],
                'id' => 3,
                'parentId' => '1',
                'type' => 'Город',
                'name' => 'Китежград',
                'guess' => true,
                'roomAmount' => 12,
                'price' => 11
            ]],
            ['dataSet'=>[
                'descriptors' => [
                    ['sFrom'=> 5, 'sTo'=> 12,  'houseroomUnitPrice'=>11, 'provinceId'=> 3],
                    ['sFrom'=> 13, 'sTo'=> 28, 'houseroomUnitPrice'=>12, 'provinceId'=> 3],
                    ['sFrom'=> 29, 'sTo'=> 37, 'houseroomUnitPrice'=>13, 'provinceId'=> 3],
                    ['sFrom'=> 38, 'sTo'=> 46, 'houseroomUnitPrice'=>14, 'provinceId'=> 3],
                    ['sFrom'=> 47, 'sTo'=> 53, 'houseroomUnitPrice'=>15, 'provinceId'=> 3],
                    ['sFrom'=> 54, 'sTo'=> 59, 'houseroomUnitPrice'=>16, 'provinceId'=> 3],
                    ['sFrom'=> 60, 'sTo'=> 67, 'houseroomUnitPrice'=>17, 'provinceId'=> 3],
                    ['sFrom'=> 68, 'sTo'=> 74, 'houseroomUnitPrice'=>18, 'provinceId'=> 3],
                    ['sFrom'=> 75, 'sTo'=> 81, 'houseroomUnitPrice'=>19, 'provinceId'=> 3],
                    ['sFrom'=> 82, 'sTo'=> 89, 'houseroomUnitPrice'=>20, 'provinceId'=> 3],
                    ['sFrom'=> 90, 'sTo'=> 100,'houseroomUnitPrice'=>21, 'provinceId'=> 3],
                ],
                'id' => 3,
                'parentId' => '1',
                'type' => 'Город',
                'name' => 'Китежград',
                'guess' => true,
                'roomAmount' => 100,
                'price' => 21
            ]],
        ];

        return $dataSets;
    }

    /**
     * @param $dataSet
     */
    protected function feedProvinceObjectWithData($dataSet)
    {
        $this->province
            ->setId($dataSet['id'])
            ->setParentId($dataSet['parentId'])
            ->setType($dataSet['type'])
            ->setName($dataSet['name']);

        $tmpArr = $dataSet['descriptors'];
        if (!shuffle($tmpArr))
        {
            $this->markTestIncomplete("Failed to shuffle an array.");
        }
        foreach ($tmpArr as $desc)
        {
            $this->province->addHouseRoomDescriptor(
                new HouseRoomDescriptor(
                    $desc['provinceId'],
                    $desc['houseroomUnitPrice'],
                    $desc['sFrom'],
                    $desc['sTo']
                )
            );
        }
        unset($tmpArr);
    }

    /**
     * @covers createFromProvince
     * @dataProvider properDataProvider
     */
    public function testCreateFromProvince($dataSet)
    {
        $this->feedProvinceObjectWithData($dataSet);
        $this->assertEquals(count($dataSet['descriptors']), count($this->province->getHouseRoomDescriptors()));
        $this->pro = ProvinceOptimized::createFromProvince($this->province);
        $this->assertEquals(count($dataSet['descriptors']), $this->pro->getHouseroomDescriptors()->count());
        foreach ($dataSet['descriptors'] as $k => $ent)
        {
            /**
             * @var $obj HouseRoomDescriptor
             */
            $obj = $this->pro->getHouseroomDescriptors()->offsetGet($k);
            $tmp = [
                    'sFrom'=> $obj->getSFrom(),
                    'sTo'=> $obj->getSTo(),
                    'houseroomUnitPrice'=>$obj->getHouseroomUnitPrice(),
                    'provinceId'=> $obj->getProvinceId()
                   ];
            $this->assertArraySubset($tmp, $ent);
            $this->assertArraySubset($ent, $tmp);
        }
    }

    /**
     * @covers canPossiblyFindPrice
     * @dataProvider properDataProvider
     */
    public function testCanPossiblyFindPrice($dataSet)
    {
        $this->feedProvinceObjectWithData($dataSet);
        $this->pro = ProvinceOptimized::createFromProvince($this->province);
        $guess = $this->pro->canPossiblyFindPrice($dataSet['roomAmount']);
        $this->assertEquals($dataSet['guess'], $guess);
    }

    /**
     * @covers binarySearchPrice
     * @dataProvider properDataProvider
     * @depends testCanPossiblyFindPrice
     */
    public function testBinarySearchPrice($dataSet)
    {
        $this->feedProvinceObjectWithData($dataSet);
        $this->pro = ProvinceOptimized::createFromProvince($this->province);
        $price = $this->pro->getPrice($dataSet['roomAmount']);
        $this->assertEquals($dataSet['price'], $price);
    }
}
