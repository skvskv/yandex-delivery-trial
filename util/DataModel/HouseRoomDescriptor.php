<?php
namespace YDT\DataModel;

class HouseRoomDescriptor implements IHouseRoomDescriptor
{
    /**
     * @var int
     */
    protected $provinceId;

    /**
     * @var int
     */
    protected $houseroomUnitPrice;

    /**
     * @var int
     */
    protected $sFrom;

    /**
     * @var int
     */
    protected $sTo;

    /**
     * @return int
     */
    public function getProvinceId()
    {
        return $this->provinceId;
    }

    /**
     * @param int $provinceId
     * @return HouseRoomDescriptor
     */
    public function setProvinceId($provinceId)
    {
        $this->provinceId = $provinceId;
        return $this;
    }

    /**
     * @return int
     */
    public function getSFrom()
    {
        return $this->sFrom;
    }

    /**
     * @param int $sFrom
     * @return HouseRoomDescriptor
     */
    public function setSFrom($sFrom)
    {
        $this->sFrom = $sFrom;
        return $this;
    }

    /**
     * @return int
     */
    public function getSTo()
    {
        return $this->sTo;
    }

    /**
     * @param int $sTo
     * @return HouseRoomDescriptor
     */
    public function setSTo($sTo)
    {
        $this->sTo = $sTo;
        return $this;
    }

    /**
     * @return int
     */
    public function getHouseroomUnitPrice()
    {
        return $this->houseroomUnitPrice;
    }

    /**
     * @param int $houseroomUnitPrice
     * @return HouseRoomDescriptor
     */
    public function setHouseroomUnitPrice($houseroomUnitPrice)
    {
        $this->houseroomUnitPrice = $houseroomUnitPrice;
        return $this;
    }

    public function __construct($provinceId, $roomUnitPrice, $sFrom, $sTo)
    {
        $this->provinceId = $provinceId;
        $this->houseroomUnitPrice = $roomUnitPrice;
        $this->sFrom = $sFrom;
        $this->sTo = $sTo;
    }
}
