<?php

namespace Maxowar\Conway;

use Maxowar\Conway\Cell\State\AliveCell;
use Maxowar\Conway\Cell\State;

class Cell
{
    private $state;

    protected $neighbours;

    public function __construct($probability = 100)
    {
        $this->state = new State\DeadCell();

        if(mt_rand(0, 100) > (100 - $probability)) {
            $this->comeToLight();
        }

        $this->neighbours = 0;
    }

    public function elapse()
    {
        $this->state->elapse($this);

        $this->neighbours = 0;
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


    public function getNeighbours()
    {
        return $this->neighbours;
    }

    public function addNeighbour()
    {
        $this->neighbours++;
    }

    public function removeNeighbour()
    {
        $this->neighbours--;
    }
}