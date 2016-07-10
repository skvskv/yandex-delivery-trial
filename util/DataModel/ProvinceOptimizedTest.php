<?php
namespace YDT\Tests\DataModel;
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

    public function testSimpleSingular()
    {
        $this->pro = ProvinceOptimized::createFromProvince($this->province);
        $this->assertInstanceOf(ProvinceOptimized::class, $this->pro);
    }
}
