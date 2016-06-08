<?php

namespace Maxowar\Conway;

use Maxowar\Conway\Cell;
use Maxowar\Conway\Universe\Addresser;
use Maxowar\Conway\Universe\Coordinate;
use Maxowar\Conway\Universe\Position;

/**
 * A Universe is where life happen
 *
 * A Universe is a grid of Positions with alive or dead Cells that behaviours according to alive neighbours Cells
 *
 * @package Maxowar\Conway
 */
class Universe
{
    private $dimension;

    private $size_x;

    private $size_y;

    /**
     * Alive cells
     *
     * @var \SplObjectStorage
     */
    private $cells;

    private $population;

    /**
     * World matrix
     *
     * @var \SplFixedArray
     */
    private $grid;

    public function __construct(int $size_x, int $size_y,  $population = 0.2)
    {
        $this->dimension = $size_x * $size_y;
        $this->size_x = $size_x;
        $this->size_y = $size_y;
        $this->population = $population;

        $this->cells = [];

        $this->grid = new \SplFixedArray($this->dimension);

        echo "Universo di dimensione {$this->dimension}\n";
    }

    /**
     * Return the list of Positions of only alive cells
     *
     * @return array|\SplObjectStorage
     */
    public function getCommunity()
    {
        return $this->cells;
    }

    /**
     * Let explode the big bang and auto generate living Cells
     */
    public function bigBang()
    {
        while(count($this->cells) < round($this->dimension * $this->population)) {
            $cell = new Cell(100);
            $position = $this->getRandomPosition();

            $position->place($cell);
            $this->cells[$position->address()] = $position;
            $this->grid[$position->address()] = $position;
        }
    }

    /**
     * Query a Position at certain Coordinate
     *
     * @param Coordinate $coordinate
     * @return mixed
     */
    public function getPositionAt(Coordinate $coordinate)
    {
        $addresser = new Addresser($this);
        $address = $addresser->linear($coordinate);

        if(!$this->isValid($coordinate)) {
            return null;
        }

        if(!($this->grid[$address] instanceof Position)) {
            $this->grid[$address] = new Position($this, $coordinate);
        }
        return $this->grid[$address];
    }

    /**
     * @return int
     */
    public function width()
    {
        return $this->size_x;
    }

    public function height()
    {
        return $this->size_y;
    }

    public function getDimension()
    {
        return $this->dimension;
    }

    /**
     * Let the universe step forward of a generation
     */
    public function elapse()
    {
        //$this->resetGrid();

        foreach ($this->grid as $position) {
            if($position instanceof Position) {
                $position->getCell()->elapse();
            }
        }
        
        $this->census();
    }

    /**
     * Update population number
     */
    public function census()
    {
        $this->population = $this->countPopulation();

        $this->countNeighbours();
    }

    /**
     * @return float
     */
    public function countPopulation()
    {
        return count($this->cells) / $this->dimension;
    }

    /**
     *
     */
    public function resetGrid()
    {
        $this->grid = new \SplFixedArray($this->dimension);
    }

    /**
     * Initialize the number of adiacency living Cells on the Universe
     */
    public function countNeighbours()
    {
        foreach ($this->cells as $position) {
            /** @var Position $position */
            foreach ($position->getNeighbours() as $neighbour) {
                /** @var Position $neighbour */
                $neighbour->getCell()->state()->addNeighbour();
            }
        }
    }

    /**
     * Return a random position inside the Universe
     *
     * @todo move to another place, maybe on Navigator
     *
     * @return Position
     */
    public function getRandomPosition()
    {
        return new Position($this, new Coordinate(rand(1, $this->size_x), rand(1, $this->size_y)));
    }

    public function isValid(Coordinate $coordinate)
    {
        $addresser = new Addresser($this);
        $address = $addresser->linear($coordinate);

        return $address > 0 && $address < $this->dimension;
    }

}