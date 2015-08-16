<?php

namespace Aurora\Helper;

use ArrayAccess;

class DataObject implements ArrayAccess
{
    private $strict = false;

    use DataObjectTrait,
        ArrayTrait,
        CallablePropertyTrait;
}
