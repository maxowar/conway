<?php

namespace Maxowar\Conway\Universe\Navigator;


use Maxowar\Conway\Universe\Coordinate;
use Maxowar\Conway\Universe\Navigator\Exception\UnknownDirectionException;

class Direction
{
    const UP         = 'up';
    const DOWN       = 'down';
    const LEFT       = 'left';
    const RIGHT      = 'right';
    const UP_RIGHT   = 'upRight';
    const UP_LEFT    = 'upLeft';
    const DOWN_RIGHT = 'downRight';
    const DOWN_LEFT  = 'downLeft';

    public function __call($name, $arguments)
    {
        throw new UnknownDirectionException($name);
    }
    
    public function up(Coordinate $coordinate)
    {
        return new Coordinate($coordinate->x(), $coordinate->y() - 1);
    }

    public function down(Coordinate $coordinate)
    {
        return new Coordinate($coordinate->x(), $coordinate->y() + 1);
    }

    public function left(Coordinate $coordinate)
    {
        return new Coordinate($coordinate->x() - 1, $coordinate->y());
    }

    public function right(Coordinate $coordinate)
    {
        return new Coordinate($coordinate->x() + 1, $coordinate->y());
    }

    public function upRight(Coordinate $coordinate)
    {
        return new Coordinate($coordinate->x() + 1, $coordinate->y() - 1);
    }

    public function upLeft(Coordinate $coordinate)
    {
        return new Coordinate($coordinate->x() - 1, $coordinate->y() - 1);
    }

    public function downRight(Coordinate $coordinate)
    {
        return new Coordinate($coordinate->x() + 1, $coordinate->y() + 1);
    }

    public function downLeft(Coordinate $coordinate)
    {
        return new Coordinate($coordinate->x() - 1, $coordinate->y() + 1);
    }
}