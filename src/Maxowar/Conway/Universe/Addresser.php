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

    public function encode(Coordinate $coordinate)
    {
        return ($coordinate->x() + (($coordinate->y() - 1) * $this->universe->width())) - 1;
    }

    public function decode(int $address)
    {
        return new Coordinate($address % $this->universe->width(), ceil($address / $this->universe->width()));
    }
}