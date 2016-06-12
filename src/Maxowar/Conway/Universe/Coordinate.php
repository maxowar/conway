<?php

namespace Maxowar\Conway\Universe;

/**
 * Simple couple of linear spatial values (x,y)
 *
 * @package Maxowar\Conway\Universe
 */
class Coordinate
{
    const ADDRESS_LINEAR = 0;
    const ADDRESS_MATRIX = 1;

    private $x;

    private $y;

    public function __construct(int $x, int $y)
    {
        if($x == 0 || $y == 0) {
            throw new \OutOfRangeException('Point does not exists');
        }
        $this->x = $x;
        $this->y = $y;
    }

    public function __toString()
    {
        return sprintf('(%d, %d)', $this->x(), $this->y());
    }

    /**
     * @return int
     */
    public function x(): int
    {
        return $this->x;
    }

    /**
     * @return int
     */
    public function y(): int
    {
        return $this->y;
    }

    
}