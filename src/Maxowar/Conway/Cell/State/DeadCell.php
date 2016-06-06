<?php
/**
 * Created by PhpStorm.
 * User: maxowar
 * Date: 29/05/2016
 * Time: 23:21
 */

namespace Maxowar\Conway\Cell\State;


use Maxowar\Conway\Cell;
use Maxowar\Conway\Cell\State;

class DeadCell extends State
{
    public function elapse(Cell $cell)
    {
        if($this->neighbours > 3) {
            $cell->change(new AliveCell());
        }
    }
}