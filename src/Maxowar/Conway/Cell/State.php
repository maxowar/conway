<?php

namespace Maxowar\Conway\Cell;


use Maxowar\Conway\Cell;

abstract class State
{
    protected $neighbours;

    public function __construct($neighbours = 0)
    {
        $this->neighbours = $neighbours;
    }

    public function setNeighbours($number)
    {
        $this->neighbours = $number;
    }

    public function addNeighbour()
    {
        $this->neighbours++;
    }

    public function removeNeighbour()
    {
        $this->neighbours--;
    }

    abstract public function elapse(Cell $cell);
}