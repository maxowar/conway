<?php

namespace Maxowar\Conway\Universe;

use Maxowar\Conway\Cell;
use Maxowar\Conway\Universe;

/**
 * Position is a square in the grid Universe
 * It holds the Coordinates and the Cell associated with that Position
 *
 * @package Maxowar\Conway\Universe
 */
class Position
{
    /**
     * @var Universe
     */
    public $universe;

    /**
     * @var Coordinate
     */
    public $coordinate;

    /**
     * @var Cell
     */
    public $cell;

    /**
     * @var int
     */
    private $neighbours;

    public function __construct(Universe $universe, Coordinate $coordinate, Cell $cell = null)
    {
        $this->universe = $universe;
        $this->coordinate = $coordinate;
        $this->cell = $cell ?? new Cell();

        $this->neighbours = 0;
    }

    public function __toString()
    {
        return $this->write();
    }

    /**
     * Render a textual representation of current Position
     *
     * @return string
     */
    public function write()
    {
        return 'U(' . $this->coordinates()->x() . ', ' . $this->coordinates()->y() . ', ' .
            ($this->getCell()->isLiving() ? 'A' : 'D') . ')';
    }

    public function place(Cell $cell)
    {
        $this->cell = $cell;
    }

    /**
     * @return Coordinate
     */
    public function coordinates()
    {
        return $this->coordinate;
    }

    /**
     * return neighbours of current Position cell
     *
     * @return array
     */
    public function getNeighbours()
    {
        $navigator = new Navigator($this);

        return [
            $navigator->up()->getPosition(),
            $navigator->right()->getPosition(),
            $navigator->down()->getPosition(),
            $navigator->down()->getPosition(),
            $navigator->left()->getPosition(),
            $navigator->left()->getPosition(),
            $navigator->up()->getPosition(),
            $navigator->up()->getPosition()
        ];
    }

    public function countNeighbours()
    {
        return $this->neighbours;
    }

    /**
     * Return the Cell at current Position
     *
     * @return Cell
     */
    public function getCell()
    {
        return $this->cell;
    }

    public function isValid()
    {
        
    }

    public function address()
    {
        $addresser = new Addresser($this->universe);
        return $addresser->linear($this->coordinate);
    }
}