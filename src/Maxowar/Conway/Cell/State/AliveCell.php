<?php

namespace Maxowar\Conway\Cell\State;

use Maxowar\Conway\Cell;
use Maxowar\Conway\Cell\State;

class AliveCell  extends State
{
    public function elapse(Cell $cell)
    {
        if($this->neighbours < 2 || $this->neighbours > 3) {
            $cell->change(new DeadCell());
        }
    }
}