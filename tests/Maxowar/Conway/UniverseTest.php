<?php

namespace Maxowar\Conway;

class UniverseTest extends \PHPUnit_Framework_TestCase
{
    public function testGetCommunity()
    {
        $universe = new Universe(10, 10, 0.2);
        $this->assertInternalType('array', $universe->getCommunity());
        $this->assertEquals(0, count($universe->getCommunity()));

        $universe->bigBang();
        $this->assertEquals(20, count($universe->getCommunity()));
    }

    public function testGetGrid()
    {
        $universe = new Universe(10, 10);
        $this->isInstanceOf('\\SplFixedArray', $universe->getGrid());
        $this->assertEquals(100, count($universe->getGrid()));
    }

    public function testBigBang()
    {
        $universe = new Universe(10, 10, 0.2);
        $universe->bigBang();

        $this->assertEquals(20, count($universe->getCommunity()));
    }

    public function testWidth()
    {
        $universe = new Universe(3, 5);
        $this->assertEquals(3, $universe->width());
    }

    public function testHeight()
    {
        $universe = new Universe(3, 5);
        $this->assertEquals(5, $universe->height());
    }

    public function testDimension()
    {
        $universe = new Universe(3, 5);
        $this->assertEquals(15, $universe->getDimension());
    }
}