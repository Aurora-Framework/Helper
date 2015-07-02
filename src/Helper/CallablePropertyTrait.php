<?php

namespace Aurora\Helper;

trait CallableProperty
{
    public function __call($method, $args)
    {
        if (isset($this[$method]) && is_callable($this->$method)) {
            return call_user_func_array($this->$method, $args);
        }
    }
}
