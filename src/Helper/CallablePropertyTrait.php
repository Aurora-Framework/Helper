<?php

namespace Aurora\Helper;

trait CallablePropertyTrait
{
    public function __call($method, $arguments)
    {
        if (isset($this->{$method})
            && is_callable($this->{$method})
        ) {
            $fn = $this->{$method};
            return $fn(...$arguments);
        }
    }
}
