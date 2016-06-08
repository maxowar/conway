<?php

namespace Maxowar\Conway\Cell\State;

use Maxowar\Conway\Cell;
use Maxowar\Conway\Cell\State;

class AliveCell  extends State
{
    public function elapse(Cell $cell)
    {
        if($cell->getNeighbours() < 2 || $cell->getNeighbours() > 3) {
            $cell->change(new DeadCell());
        }
    }
}