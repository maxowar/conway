<?php

namespace Maxowar\Conway;

use Maxowar\Conway\Universe\Coordinate;
use Maxowar\Conway\Universe\Position;

class PositionTest extends \PHPUnit_Framework_TestCase
{
    public function testPlace()
    {
        $coordinate = $this->createMock('\\Maxowar\\Conway\\Universe\\Coordinate');
        $universe = $this->createMock('\\Maxowar\\Conway\\Universe');

        $position = new Position($universe, $coordinate);

        $cell = new Cell();
        $position->place($cell);

        $this->assertSame($cell, $position->getCell());
    }

    public function testCoordinates()
    {
        $coordinate = $this->createMock('\\Maxowar\\Conway\\Universe\\Coordinate')
            ->method('x')
            ->willReturn(3)
            ->method('y')
            ->willReturn(7);

        $position = new Position($this->getUniverse(), $coordinate);
        $this->assertEquals(3, $position->coordinates()->x());
        $this->assertEquals(7, $position->coordinates()->y());

    }

    public function testAddress()
    {
        $coordinate = $this->createMock('\\Maxowar\\Conway\\Universe\\Coordinate')
            ->method('x')
            ->willReturn(3)
            ->method('y')
            ->willReturn(7);
        $universe = $this->createMock('\\Maxowar\\Conway\\Universe');

        $position = new Position($universe, $coordinate);

        $this->assertEquals(14, $position->address());
    }
}