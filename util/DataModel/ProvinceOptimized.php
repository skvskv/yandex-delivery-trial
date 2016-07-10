<?php
namespace YDT\DataModel;
use SplFixedArray;
class ProvinceOptimized
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var int
     */
    protected $parentId;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var \SplFixedArray
     */
    protected $houseroomDescriptors;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return ProvinceOptimized
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * @param int $parentId
     * @return ProvinceOptimized
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return ProvinceOptimized
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return ProvinceOptimized
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return \SplFixedArray | null
     */
    public function getHouseroomDescriptors()
    {
        return $this->houseroomDescriptors;
    }

    /**
     * @param \SplFixedArray $houseroomDescriptors
     * @return ProvinceOptimized
     */
    public function setHouseroomDescriptors(SplFixedArray $houseroomDescriptors)
    {
        $this->houseroomDescriptors = $houseroomDescriptors;
        return $this;
    }

    /**
     * @param Province $province
     * @return ProvinceOptimized
     * @throws \Exception
     */
    public static function createFromProvince(Province $province)
    {
        $sortedDescriptors = $province->getHouseRoomDescriptors();
        $isSortingSucceded = usort(
            $sortedDescriptors,
            [static::class, "cmp"]
        );

        if (!$isSortingSucceded)
        {
            $sortedDescriptors = null;
            throw new \Exception(__METHOD__ . "() dailed to sort array to create an instance upon.");
        }

        /**
         * @var $result ProvinceOptimized
         */
        $result = new static();
        $result->setId($province->getId())
            ->setParentId($province->getParentId())
            ->setName($province->getName())
            ->setType($province->getType())
            ->setHouseroomDescriptors(SplFixedArray::fromArray($sortedDescriptors));

        return $result;
    }

    /**
     * @param IHouseRoomDescriptor $a
     * @param IHouseRoomDescriptor $b
     * @return int
     */
    protected static function cmp(IHouseRoomDescriptor $a, IHouseRoomDescriptor $b)
    {
        if ($a->getSFrom() === $b->getSFrom())
        {
            return 0;
        }

        return ( ($a->getSFrom() < $b->getSFrom()) ? -1 : 1 );
    }
}
