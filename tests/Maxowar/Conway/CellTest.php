<?php
/**
 * Created by PhpStorm.
 * User: maxowar
 * Date: 03/06/2016
 * Time: 23:22
 */

namespace Maxowar\Conway;


use Maxowar\Conway\Cell\State\AliveCell;
use Maxowar\Conway\Cell\State\DeadCell;

class CellTest extends \PHPUnit_Framework_TestCase
{
    public function testElapse()
    {

    }

    public function testIsLiving()
    {
        $cell = new Cell();
        $cell->change(new AliveCell());
        $this->assertTrue($cell->isLiving());
    }

    public function testChange()
    {
        $cell = new Cell();

        $cell->change(new AliveCell());
        $this->assertInstanceOf(AliveCell::class, $cell->state());

        $cell->change(new DeadCell());
        $this->assertInstanceOf(DeadCell::class, $cell->state());

        $cell->change(new AliveCell());
        $this->assertInstanceOf(AliveCell::class, $cell->state());
    }
}