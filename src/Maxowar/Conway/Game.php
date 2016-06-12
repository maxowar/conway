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
        if(!file_exists($filename)) {
            throw new \InvalidArgumentException("File $filename not exists");
        }

        $fp = fopen($filename, 'r');
        $width = $height = 0;
        $data = [];
        while ($line = trim(fgets($fp))) {
            if($width && $width != strlen($line)) {
                throw new \RangeException('Invalid Universe format');
            } else {
                $width = strlen($line);
            }
            $height++;

            $data = array_merge($data, str_split($line));
        }
        
        $universe = new Universe($width, $height);
        $grid = $universe->getGrid();
        
        foreach ($data as $address => $status) {
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

            //$this->renderer->render($this->universe->getCommunity());
            $this->renderer->renderNeighbours($this->universe->getGrid());
            $generations--;

            $this->universe->elapse();

            usleep(80000);
        }
    }
}