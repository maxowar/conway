<?php

namespace Maxowar\Conway\Universe;

use Maxowar\Conway\Universe;

class Addresser
{
    private $universe;

    public function __construct(Universe $universe)
    {
        $this->universe = $universe;
    }

    public function linear(Coordinate $coordinate)
    {
        return ($coordinate->x() + (($coordinate->y() - 1) * $this->universe->width())) - 1;
    }
}