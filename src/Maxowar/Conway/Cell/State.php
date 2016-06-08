<?php

namespace Maxowar\Conway\Cell;


use Maxowar\Conway\Cell;

abstract class State
{
    abstract public function elapse(Cell $cell);
}