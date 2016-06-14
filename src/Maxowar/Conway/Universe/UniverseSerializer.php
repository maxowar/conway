<?php

namespace Maxowar\Conway\Universe;


use Maxowar\Conway\Universe;
use Maxowar\Conway\Cell;

/**
 * Transform forward and back a Universe into a string representation
 *
 * @package Maxowar\Conway\Universe
 */
class UniverseSerializer
{
    private $options;

    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    /**
     * Read serialized data of a Universe and re-create it
     *
     * @param $serialized
     * @param $width @todo remove from here
     * @param $height @todo remove from here
     *
     * @return Universe
     */
    public function parse($serialized, $width, $height)
    {
        $universe = new Universe($width, $height);
        $grid = $universe->getGrid();

        foreach ($serialized as $address => $status) {
            if(!in_array($status, ['A', 'D'])) {
                throw new \UnexpectedValueException('File not valid');
            }
            if($status == 'A') {
                $cell = new Cell(100);
            } else {
                $cell = new Cell(0);
            }
            $grid[$address] = $position = new Universe\Position($universe, $universe->getAddresser()->decode($address), $cell);

            if($position->getCell()->isLiving())
                $universe->storeLivingCell($position);
        }
        $universe->countNeighbours();
        return $universe;
    }

    public function dump(Universe $universe)
    {
        $serialized = '';
        foreach ($universe->getGrid() as $key => $position) {
            if($position instanceof Position && $position->getCell()->isLiving()) {
                $serialized .= 'A';
            } else {
                $serialized .= 'D';
            }
            if($key % $universe->width()) {
                $serialized .= "\n";
            }
        }
        return $serialized;
    }
}