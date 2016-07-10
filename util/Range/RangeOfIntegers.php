<?php
namespace YDT\Auxiliary\Range;
class RangeOfIntegers extends AbstractRange
{
    const MIN = 'min';
    const MAX = 'max';
    const INCLUDE_MIN = 'include_min';
    const INCLUDE_MAX = 'include_max';
    const DEFAULT_INCLUDE_BOUNDARY = true;

    /**
     * @param $boundary
     * @throws EBadBoundaryForRange
     */
    public function __construct(array $boundary=null)
    {
        if (!is_null($boundary))
        {
            $this->setBoundary($boundary);
        }
    }

    public function setBoundary($boundary)
    {
        if (!$this->isValidBoundary($boundary))
        {
            throw new EBadBoundaryForRange("Invalid input data for " . __METHOD__);
        }

        $this->boundary = [
            self::MIN => (int)$boundary[self::MIN],
            self::MAX => (int)$boundary[self::MAX],
            self::INCLUDE_MIN => (bool)(isset($boundary[self::INCLUDE_MIN])?$boundary[self::INCLUDE_MIN]:self::DEFAULT_INCLUDE_BOUNDARY),
            self::INCLUDE_MAX => (bool)(isset($boundary[self::INCLUDE_MAX])?$boundary[self::INCLUDE_MAX]:self::DEFAULT_INCLUDE_BOUNDARY),
        ];

        return $this;
    }

    public function getBoundary()
    {
        return $this->boundary;
    }

    /**
     * @inheritdoc
     */
    public function isValidBoundary($boundary)
    {
        return self::validateBoundary($boundary);
    }

    /**
     * Validates if boundaries are set correctly, i.e. are of proper type and min < max.
     * @param $boundary
     * @return bool
     */
    public static function validateBoundary($boundary)
    {
        if (isset($boundary[self::MIN])
            && isset($boundary[self::MAX])
            && static::isIntegerOrCastable($boundary[self::MIN])
            && static::isIntegerOrCastable($boundary[self::MAX])
            && (((int)$boundary[self::MIN]) <= ((int)$boundary[self::MAX])))
        {
            return true;
        }
        return false;
    }

    /**
     * @inheritdoc
     */
    protected function isValueInsideRange($value)
    {
        return (($this->boundary[self::MIN] < $value) && ($value < $this->boundary[self::MAX]));
    }

    /**
     * @inheritdoc
     */
    protected function doesValueBelongToBoundary($value)
    {
        $boundary = $this->boundary;
        return (($value == $boundary[self::MIN]) && $boundary[self::INCLUDE_MIN]) || (($value == $boundary[self::MAX]) && $boundary[self::INCLUDE_MAX]);
    }

    /**
     * Tests if an argument is of integer type or is gracefully castable to.
     * @param $arg
     * @return bool
     */
    protected static function isIntegerOrCastable($arg)
    {
        return is_int($arg) || ( is_string($arg) && (strspn($arg, '0123456789-') == mb_strlen($arg)) );
    }
}
