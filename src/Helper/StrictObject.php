<?php

namespace Aurora\Helper;

use ArrayAccess;

class StrictObject implements ArrayAccess
{
    private $strict = true;

    use ObjectTrait,
        ArrayTrait,
        CallablePropertyTrait;
}
