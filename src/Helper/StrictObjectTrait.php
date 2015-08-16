<?php

namespace Aurora\Helper;

use Aurora\Helper\Exception\PropertyNotSetException;

trait StrictObjectTrait
{
    public function __get($key)
	{
		if (isset($this->{$key})) {
			return $this->$key;
		}
		throw new PropertyNotSetException("Property {$key} of strict object wasn't set", 1);
	}

	public function __set($key, $value)
	{
		$this->{$key} = $value;
	}

	public function __isset($key)
	{
		return isset($this->{$key});
	}

	public function __unset($key)
	{
		if (isset($this->{$key})) {
			unset($this->{$key});
		}
		throw new PropertyNotSetException("Property {$key} of strict object wasn't set", 1);
	}
}
