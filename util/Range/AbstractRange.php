<?php
namespace YDT\Auxiliary\Range;
abstract class AbstractRange implements IRange
{
    protected $boundary;

    /**
     * @param $value
     * @return bool
     * @throws ERangeHasInvalidBoundary
     */
    public function doesContain($value)
    {
        if (!$this->isValidBoundary($this->boundary))
        {
            throw new ERangeHasInvalidBoundary("Boundary should be set up prior to doesContain() method use");
        }

        return $this->doesValueBelongToBoundary($value) || $this->isValueInsideRange($value);
    }

    public abstract function setBoundary($boundary);

    public abstract function getBoundary();

    public abstract function isValidBoundary($boundary);

    /**
     * Tests if a value belongs to the region when at boundary.
     * @param $value
     * @return bool
     */
    protected abstract function doesValueBelongToBoundary($value);

    /**
     * Tests if a value lies strictly inside the region.
     * @param $value
     * @return bool
     */
    protected abstract function isValueInsideRange($value);
}
