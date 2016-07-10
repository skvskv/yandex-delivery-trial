<?php
namespace YDT\Tests\Auxiliary\Range;
use YDT\Auxiliary\Range\RangeOfIntegers;
class RangeOfIntegersTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var RangeOfIntegers
     */
    protected $range;

    public function setup()
    {
        $this->range = new RangeOfIntegers();
    }

    public function tearDown()
    {

    }

    public function invalidBoundariesProvider()
    {
        $dataSets = [
            [[RangeOfIntegers::MIN => 10, RangeOfIntegers::MAX => 0]],
            [[RangeOfIntegers::MIN => 0, RangeOfIntegers::MAX => 1.3]],
            [[RangeOfIntegers::MIN => 0, RangeOfIntegers::MAX => "1E2"]],
            [[RangeOfIntegers::MIN => 0, RangeOfIntegers::MAX => 1E2]],
            [[0, RangeOfIntegers::MAX => 1.3]],
            [[RangeOfIntegers::MIN => 0, 1.3]],
            [[3,5]],
        ];

        return $dataSets;
    }

    /**
     * @covers isValidBoundary
     * @dataProvider invalidBoundariesProvider
     * @expectedException \YDT\Auxiliary\Range\EBadBoundaryForRange
     */
    public function testSetInvalidBoundary($invalidBoundary)
    {
        $this->range->setBoundary($invalidBoundary);
    }

    public function validBoundariesProvider()
    {
        $dataSets = [
            [[RangeOfIntegers::MIN => 0, RangeOfIntegers::MAX => 0]],
            [[RangeOfIntegers::MIN => -2, RangeOfIntegers::MAX => 1]],
            [[RangeOfIntegers::MIN => "-1", RangeOfIntegers::MAX => 2]],
            [[RangeOfIntegers::MIN => "-1", RangeOfIntegers::MAX => 2]],
        ];

        return $dataSets;
    }

    /**
     * @covers setBoundary
     * @dataProvider validBoundariesProvider
     */
    public function testSetValidBoundary($validBoundary)
    {
        $this->range->setBoundary($validBoundary);
    }

    public function operationTestDataProvider()
    {
        $dataSets = [
            ['expect' => false, 'testValue' => 1, 'boundary' => [RangeOfIntegers::MIN => 0, RangeOfIntegers::MAX => 0]],
            ['expect' => false, 'testValue' => -3, 'boundary' => [RangeOfIntegers::MIN => -3, RangeOfIntegers::MAX => -3, RangeOfIntegers::INCLUDE_MIN => false, RangeOfIntegers::INCLUDE_MAX => false]],
            ['expect' => false, 'testValue' => 11, 'boundary' => [RangeOfIntegers::MIN => 0, RangeOfIntegers::MAX => 10]],
            ['expect' => false, 'testValue' => -1, 'boundary' => [RangeOfIntegers::MIN => 0, RangeOfIntegers::MAX => 10]],
            ['expect' => false, 'testValue' => 0, 'boundary' => [RangeOfIntegers::MIN => 0, RangeOfIntegers::MAX => 10, RangeOfIntegers::INCLUDE_MIN => false]],
            ['expect' => false, 'testValue' => 10, 'boundary' => [RangeOfIntegers::MIN => 0, RangeOfIntegers::MAX => 10, RangeOfIntegers::INCLUDE_MAX => false]],

            ['expect' => true, 'testValue' => 7.5, 'boundary' => [RangeOfIntegers::MIN => 0, RangeOfIntegers::MAX => 10]],
            ['expect' => true, 'testValue' => 0, 'boundary' => [RangeOfIntegers::MIN => 0, RangeOfIntegers::MAX => 0]],
            ['expect' => true, 'testValue' => -1, 'boundary' => [RangeOfIntegers::MIN => "-1", RangeOfIntegers::MAX => 0]],
            ['expect' => true, 'testValue' => 0, 'boundary' => [RangeOfIntegers::MIN => "-1", RangeOfIntegers::MAX => 0]],
            ['expect' => true, 'testValue' => 3, 'boundary' => [RangeOfIntegers::MIN => 2, RangeOfIntegers::MAX => 4]],
            ['expect' => true, 'testValue' => 0, 'boundary' => [RangeOfIntegers::MIN => 0, RangeOfIntegers::MAX => 10, RangeOfIntegers::INCLUDE_MAX => false]],
            ['expect' => true, 'testValue' => 10, 'boundary' => [RangeOfIntegers::MIN => 0, RangeOfIntegers::MAX => 10, RangeOfIntegers::INCLUDE_MIN => false]],
            ['expect' => true, 'testValue' => 14, 'boundary' => [RangeOfIntegers::MIN => 14, RangeOfIntegers::MAX => 14, RangeOfIntegers::INCLUDE_MIN => false]],
            ['expect' => true, 'testValue' => 12, 'boundary' => [RangeOfIntegers::MIN => 12, RangeOfIntegers::MAX => 12, RangeOfIntegers::INCLUDE_MAX => false]],
        ];

        return $dataSets;
    }

    /**
     * @covers doesContain
     * @dataProvider operationTestDataProvider
     */
    public function testOperation($expect, $testValue, $boundary)
    {
        $this->range->setBoundary($boundary);
        $result = $this->range->doesContain($testValue);
        $this->assertEquals($expect, $result);
    }

}
