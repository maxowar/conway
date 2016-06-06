<?php

namespace Maxowar\Conway\Renderer;

use Maxowar\Conway\Universe\Coordinate;

class ConsoleRenderer
{
    private $data;

    
    public function __construct()
    {

    }

    public function welcome()
    {
        echo PHP_EOL . "PHP Conway's life game" . PHP_EOL;
    }
    
    public function getMatrix()
    {

    }
    
    public function render($data)
    {
        $dimension = 250;
        $width = 25;

        $vector = [];

        for($i = 0; $i < $dimension; $i++) {
            //$vector[] = new Coordinate($i % $width, floor($i / $width));
            $vector[] = chr(255);
        }

        foreach ($data as $position) {
            $vector[$position->coordinate()->address()] = chr(254);
        }

        foreach ($vector as $key => $value) {
            if(($key % $width) == 0)
                echo PHP_EOL;

            echo $value . ' ';
        }
    }
}