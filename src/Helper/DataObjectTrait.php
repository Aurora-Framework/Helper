<?php

namespace Aurora\Helper;

use Aurora\Helper\Exception\PropertyNotSetException;

trait DataObjectTrait
{
	public function __get($key)
	{
		if (isset($this->data[$key])) {
			return $this->data[$key];
		}
		if ($this->strict) throw new PropertyNotSetException("Property {$key} of strict object wasn't set", 1);
	}

	public function __set($key, $value)
	{
		$this->data[$key] = $value;
	}

	public function __isset($key)
	{
		return isset($this->data[$key]);
	}

	public function __unset($key)
	{
		if (isset($this->data[$key])) {
			unset($this->data[$key]);
		}
		if ($this->strict) throw new PropertyNotSetException("Property {$key} of strict object wasn't set", 1);
	}
}
