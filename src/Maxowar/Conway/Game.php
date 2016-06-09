<?php

namespace Maxowar\Conway;

use Maxowar\Conway\Renderer\ConsoleRenderer;
use Maxowar\Conway\Universe;

/**
 * It holds the settings to start and run the Conway's life game 
 * 
 * @package Maxowar\Conway
 */
class Game
{
    /**
     * @var int
     */
    private $iterations;

    /**
     * @var Universe
     */
    private $universe;

    public function __construct(int $iterations = 1)
    {
        $this->iterations = $iterations;
        $this->universe = new Universe(25, 10);
        $this->renderer = new ConsoleRenderer();
    }

    public function loadUniverse(string $filename)
    {
        $fp = fopen($filename, 'r');
        $width = $height = 0;
        $data = [];
        while ($line = fgets($fp)) {
            if($width && $width != strlen($line)) {
                throw new \RangeException('File not valid');
            } else {
                $width = strlen($line);
            }
            $height++;

            array_merge($data, str_split($line));
        }
        
        $this->universe = new Universe($width, $height);
        $grid = $this->universe->getGrid();
        
        foreach ($data as $address => $status) {
            if(!in_array($status, ['A', 'D'])) {
                throw new \UnexpectedValueException('File not valid');
            }
            if($status == 'A') {
                $cell = new Cell(100);
            } else {
                $cell = new Cell(0);
            }
            $grid[$address] = new Universe\Position($this->universe, $this->universe->getAddresser()->decode($address), $cell);
        }
    }

    /**
     * Initialize everything
     */
    public function init()
    {
        $this->universe->bigBang();
    }

    /**
     * Run the game
     */
    public function run()
    {
        $this->init();

        $this->renderer->welcome();

        while($this->iterations) {
            echo "Iterazione $this->iterations\n";

            //$this->renderer->render($this->universe->getCommunity());
            $this->renderer->renderNeighbours($this->universe->getGrid());
            $this->iterations--;

            $this->universe->elapse();

            usleep(80000);
        }
    }
}