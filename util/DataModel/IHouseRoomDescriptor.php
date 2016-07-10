<?php
namespace YDT\DataModel;

interface IHouseRoomDescriptor
{
    /**
     * @return int
     */
    public function getProvinceId();

    /**
     * @param int $provinceId
     * @return HouseRoomDescriptor
     */
    public function setProvinceId($provinceId);

    /**
     * @return int
     */
    public function getSFrom();

    /**
     * @param int $sFrom
     * @return HouseRoomDescriptor
     */
    public function setSFrom($sFrom);

    /**
     * @return int
     */
    public function getSTo();

    /**
     * @param int $sTo
     * @return HouseRoomDescriptor
     */
    public function setSTo($sTo);

    /**
     * @return int
     */
    public function getHouseroomUnitPrice();

    /**
     * @param int $houseroomUnitPrice
     * @return HouseRoomDescriptor
     */
    public function setHouseroomUnitPrice($houseroomUnitPrice);
}