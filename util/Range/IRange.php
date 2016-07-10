<?php
namespace YDT\Auxiliary\Range;
interface IRange
{
    /**
     * @param $value
     * @return bool
     */
    function doesContain($value);

    /**
     * @param $boundary
     * @return $this
     */
    function setBoundary($boundary);

    /**
     * @return mixed
     */
    function getBoundary();

}
