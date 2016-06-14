<?php

namespace Maxowar\Conway\Renderer;

use Maxowar\Conway\Universe\Coordinate;
use Maxowar\Conway\Universe\Position;
use Symfony\Component\Console\Output\ConsoleOutput;

class ConsoleRenderer
{
    private $width;

    private $height;

    private $output;
    
    public function __construct($width, $height)
    {
        $this->width = $width;
        $this->height = $height;

        $this->output = new ConsoleOutput();
    }

    public function welcome()
    {
        echo PHP_EOL . "PHP Conway's life game" . PHP_EOL;
    }
    
    public function render($data)
    {
        $dimension = $this->width * $this->height;

        $vector = [];

        for($i = 0; $i < $dimension; $i++) {
            //$vector[] = new Coordinate($i % $width, floor($i / $width));
            $vector[] = chr(255);
        }

        foreach ($data as $position) {
            /** @var Position $position */
            $vector[$position->address()] = chr(254);
        }

        foreach ($vector as $key => $value) {
            if(($key % $this->width) == 0)
                echo PHP_EOL;

            echo $value . ' ';
        }
    }
    
    public function renderNeighbours($grid)
    {
        $vector = [];

        foreach ($grid as $position) {
            /** $var Position $position */

            if(!$position instanceof Position) {
                $vector[] = 0;
            } elseif ($position->getCell()->isLiving()) {
                $vector[] = chr(254);
            } else {
                $vector[] = $position->getCell()->getNeighbours();
            }
        }

        foreach ($vector as $key => $value) {
            if(($key % $this->width) == 0)
                echo PHP_EOL;

            echo $value . ' ';
        }
        echo PHP_EOL;
    }
}