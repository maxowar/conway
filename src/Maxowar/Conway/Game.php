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

    public function __construct()
    {
        $this->iterations = 2;
        $this->universe = new Universe(25, 10);
        $this->renderer = new ConsoleRenderer();
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