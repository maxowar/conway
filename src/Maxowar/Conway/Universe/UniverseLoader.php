<?php

namespace Maxowar\Conway\Universe;

/**
 * Load a dumped Universe in a resource and 
 * @package Maxowar\Conway\Universe
 */
class UniverseLoader
{
    private $serializer;

    public function __construct(UniverseSerializer $serializer)
    {
        $this->serializer = $serializer;
    }

    public function load(string $filename)
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

        return $this->serializer->parse($data, $width, $height);
    }
}