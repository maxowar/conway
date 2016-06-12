<?php

namespace Maxowar\Conway;

use Maxowar\Conway\Cell\State\AliveCell;
use Maxowar\Conway\Cell\State;

/**
 * The Cell
 *
 * Can live, die and live and die again inside a Universe
 *
 * @package Maxowar\Conway
 */
class Cell
{
    /**
     * @var State\DeadCell
     */
    private $state;

    /**
     * The neighbours cell count
     *
     * @var int
     */
    protected $neighbours;

    public function __construct($probability = 100)
    {
        $this->state = new State\DeadCell();

        if(mt_rand(0, 99) >= (100 - $probability)) {
            $this->comeToLight();
        }

        $this->neighbours = 0;
    }

    /**
     * Elapse a generation
     */
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