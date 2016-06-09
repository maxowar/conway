<?php

namespace Maxowar\Conway\Universe;

use Maxowar\Conway\Universe;

class Serializer
{
    public function serialize(Universe $universe)
    {
        $data = '';

        foreach ($universe->getGrid() as $position) {
            if(!$position instanceof Position || !$position->getCell()->isLiving()) {
                $data .= 'D';
            } else {
                $data .= 'A';
            }
        }
    }

    public function unserialize($data)
    {
        
    }
}