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
        $this->cell = $cell ?? new Cell(0);

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

        $neighbours = [];

        //$navigator->follow()->up()->right()->down()->down()

        if($navigator->up()->moved()) {
            $neighbours[] = $navigator->getPosition();
            $navigator->back();
        }

        if($navigator->upRight()->moved()) {
            $neighbours[] = $navigator->getPosition();
            $navigator->back();
        }

        if($navigator->upLeft()->moved()) {
            $neighbours[] = $navigator->getPosition();
            $navigator->back();
        }

        if($navigator->left()->moved()) {
            $neighbours[] = $navigator->getPosition();
            $navigator->back();
        }

        if($navigator->right()->moved()) {
            $neighbours[] = $navigator->getPosition();
            $navigator->back();
        }

        if($navigator->down()->moved()) {
            $neighbours[] = $navigator->getPosition();
            $navigator->back();
        }

        if($navigator->downRight()->moved()) {
            $neighbours[] = $navigator->getPosition();
            $navigator->back();
        }

        if($navigator->downLeft()->moved()) {
            $neighbours[] = $navigator->getPosition();
            $navigator->back();
        }

        return $neighbours;
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