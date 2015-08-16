<?php

namespace Aurora\Helper;

use Exception;

class stdObject
{
    use CallableProperty;

    public function __construct(array $arguments = array())
    {
        foreach ($arguments as $property => $argument) {
            $this->{$property} = $argument;
        }
    }
}
