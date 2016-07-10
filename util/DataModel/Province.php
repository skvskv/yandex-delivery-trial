<?php
namespace YDT\DataModel;
class Province
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
     * @var array
     */
    protected $houseroomDescriptors = [];

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Province
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
     * @return Province
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
     * @return Province
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
     * @return Province
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function addHouseRoomDescriptor(IHouseRoomDescriptor $descriptor)
    {
        $this->houseroomDescriptors[] = $descriptor;
        return $this;
    }

    public function getHouseRoomDescriptors()
    {
        return $this->houseroomDescriptors;
    }

    public function getNumOfDescs()
    {
        return count($this->houseroomDescriptors);
    }

//    public function __construct($id, $name, $type, $parentId)
//    {
//        $this->id = $id;
//        $this->name = $name;
//        $this->type = $type;
//        $this->parentId = $parentId;
//    }

}
