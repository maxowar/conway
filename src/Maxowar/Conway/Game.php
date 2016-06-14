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

    private $settings;

    private $initialized;

    public function __construct(array $settings = [])
    {
        $this->settings    = array_merge($this->getDefaultSettings(), $settings);

        $this->initialized = false;
    }

    private function getDefaultSettings()
    {
        return [
            'width' => 25,
            'height' => 10,
            'generations' => 1,
            'load' => null
        ];
    }

    private function loadUniverse(string $filename)
    {
        $loader = new Universe\UniverseLoader(new Universe\UniverseSerializer());
        return $loader->load($filename);
    }

    /**
     * Initialize everything
     */
    public function init()
    {
        // universe
        if($this->settings['load']) {
            $this->universe = $this->loadUniverse($this->settings['load']);
        } else {
            $this->universe = new Universe($this->settings['width'], $this->settings['height']);
            $this->universe->bigBang();
        }



        // renderer
        $this->renderer    = new ConsoleRenderer($this->universe->width(), $this->universe->height());

        $this->initialized = true;
    }

    /**
     * Run the game
     */
    public function run($generations = 1)
    {
        if(!$this->initialized) {
            throw new \RuntimeException('Game not initialized');
        }

        $this->renderer->welcome();

        while($generations) {
            echo "Iterazione $this->iterations\n";

            $this->renderer->render($this->universe->getCommunity());
            //$this->renderer->renderNeighbours($this->universe->getGrid());
            $generations--;

            $this->universe->elapse();

            usleep(80000);
        }
    }
}