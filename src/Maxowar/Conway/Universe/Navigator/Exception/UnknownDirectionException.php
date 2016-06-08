<?php

namespace Maxowar\Conway\Universe\Navigator\Exception;


class UnknownDirectionException extends \RuntimeException
{
    public function __construct($message, $code, Exception $previous)
    {
        parent::__construct(sprintf('Unknown direction %s', $message), $code, $previous);
    }
}