<?php

namespace Maxowar\Conway;


use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Maxowar\Conway\Universe\Coordinate;

class CoordinateTest extends \PHPUnit_Framework_TestCase
{
    public function testX()
    {
        $coordinate = new Coordinate(3, 7);
        $this->assertEquals(3, $coordinate->x());
    }

    public function testNegativeX()
    {
        $coordinate = new Coordinate(-3, 7);
        $this->assertEquals(-3, $coordinate->x());
    }

    public function testY()
    {
        $coordinate = new Coordinate(3, 7);
        $this->assertEquals(7, $coordinate->y());
    }

    public function testNegativeY()
    {
        $coordinate = new Coordinate(3, -7);
        $this->assertEquals(-7, $coordinate->y());
    }

    public function testNonValidValue()
    {
        $this->expectException('\TypeError');

        $coordinate = new Coordinate(null, '');
    }
}