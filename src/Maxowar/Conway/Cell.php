<?php

namespace Maxowar\Conway;

use Maxowar\Conway\Cell\State\AliveCell;
use Maxowar\Conway\Cell\State;

class Cell
{
    private $state;

    public function __construct($probability = 100)
    {
        $this->state = new State\DeadCell();

        if(mt_rand(0, 100) > (100 - $probability)) {
            $this->comeToLight();
        }
    }

    public function elapse()
    {
        $this->state->elapse($this);
    }

    public function isLiving() 
    {
        return ($this->state instanceof AliveCell);
    }

    public function comeToLight()
    {
        $this->state = new AliveCell();
    }

    public function change(State $state)
    {
        $this->state = $state;
    }

    public function state()
    {
        return $this->state;
    }
}