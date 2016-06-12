<?php


namespace Maxowar\Conway\Universe;


use Maxowar\Conway\Universe\Navigator\Direction;

class Navigator
{
    /**
     * @var Position
     */
    private $cursor;

    private $path;

    private $moved;

    private $direction;

    public function __construct(Position $startingAt, Direction $direction = null)
    {
        $this->moveTO($startingAt);

        $this->direction = $direction ?? new Direction();
        $this->moved = false;
    }

    public function getCoordinate()
    {
        return clone $this->cursor->coordinates();
    }

    public function getPosition()
    {
        return $this->cursor;
    }

    public function back()
    {
        if(count($this->path)) {
            $this->cursor = array_pop($this->path);
        }
    }
    
    public function ifCanGo($direction)
    {
        return $this->cursor->universe->getPositionAt(
            $this->direction->$direction()
        );
    }

    public function move($direction)
    {
        $this->moved = false;

        try {
            $newCoordinate = $this->direction->$direction($this->cursor->coordinates());

            if($this->cursor->universe->isValid($newCoordinate)) {
                $destination = $this->cursor->universe->getPositionAt($newCoordinate);
                $this->moveTo($destination);
            }
        } catch (\OutOfRangeException $e) {

        }
        return $this;
    }

    public function up()
    {
        return $this->move(__FUNCTION__);
    }

    public function down()
    {
        return $this->move(__FUNCTION__);
    }

    public function left()
    {
        return $this->move(__FUNCTION__);
    }

    public function right()
    {
        return $this->move(__FUNCTION__);
    }

    public function upRight()
    {
        return $this->move(__FUNCTION__);
    }

    public function upLeft()
    {
        return $this->move(__FUNCTION__);
    }

    public function downRight()
    {
        return $this->move(__FUNCTION__);
    }

    public function downLeft()
    {
        return $this->move(__FUNCTION__);
    }

    public function moveTO(Position $position)
    {
        $this->path[] = $this->cursor;
        $this->cursor = $position;
        $this->moved = true;
    }

    public function moved()
    {
        return $this->moved;
    }
}