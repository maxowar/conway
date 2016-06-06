<?php


namespace Maxowar\Conway\Universe;


class Navigator
{
    /**
     * @var Coordinate
     */
    private $cursor;

    public function __construct(Position $startingAt)
    {
        $this->cursor = $startingAt;
    }

    public function getCoordinate()
    {
        return clone $this->cursor->coordinates();
    }

    public function getPosition()
    {
        return $this->cursor;
    }

    public function up()
    {
        $coordinates = new Coordinate($this->cursor->coordinates()->x(), $this->cursor->coordinates()->y() - 1);
        $this->cursor = $this->cursor->universe->getPositionAt($coordinates);
        
        return $this;
    }

    public function down()
    {
        $coordinates = new Coordinate($this->cursor->coordinates()->x(), $this->cursor->coordinates()->y() + 1);
        $this->cursor = $this->cursor->universe->getPositionAt($coordinates);

        return $this;
    }

    public function left()
    {
        $coordinates = new Coordinate($this->cursor->coordinates()->x() - 1, $this->cursor->coordinates()->y());
        $this->cursor = $this->cursor->universe->getPositionAt($coordinates);

        return $this;
    }

    public function right()
    {
        $coordinates = new Coordinate($this->cursor->coordinates()->x() + 1, $this->cursor->coordinates()->y());
        $this->cursor = $this->cursor->universe->getPositionAt($coordinates);

        return $this;
    }

    public function upRight()
    {
        $coordinates = new Coordinate($this->cursor->coordinates()->x() + 1, $this->cursor->coordinates()->y() - 1);
        $this->cursor = $this->cursor->universe->getPositionAt($coordinates);

        return $this;
    }

    public function upLeft()
    {
        $coordinates = new Coordinate($this->cursor->coordinates()->x() - 1, $this->cursor->coordinates()->y() - 1);
        $this->cursor = $this->cursor->universe->getPositionAt($coordinates);

        return $this;
    }

    public function downRight()
    {
        $coordinates = new Coordinate($this->cursor->coordinates()->x() + 1, $this->cursor->coordinates()->y() + 1);
        $this->cursor = $this->cursor->universe->getPositionAt($coordinates);

        return $this;
    }

    public function downLeft()
    {
        $coordinates = new Coordinate($this->cursor->coordinates()->x() - 1, $this->cursor->coordinates()->y() + 1);
        $this->cursor = $this->cursor->universe->getPositionAt($coordinates);

        return $this;
    }
}