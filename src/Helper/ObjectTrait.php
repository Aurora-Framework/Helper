<?php

namespace Aurora\Helper;

use ArrayAccess;

trait ObjectTrait
{
	/**
 	*	Stores Object data
 	*
 	* @access protected
 	* @var array|null $data Storage of helper class
 	*/
	protected $data = [];

	/**
	* Constructor
	*
	* @access public
	* @param array $data Pre-populate set with this key-value array
	*/
	public function setData($data = array())
	{
		$this->data = (array) $data;
	}

	/**
	* @param string $key
	*
	* @return bool
	*/
	public function offsetExists($key)
	{
	}

	/**
	* @param string $key
	*
	* @return mixed
	*/
	public function offsetGet($key)
	{
	}

	/**
	* @param string $key
 	* @param mixed $value
 	*/
 	public function offsetSet($key, $value)
 	{
	}

	/**
 	* @param string $key
 	*/
 	public function offsetUnset($key)
 	{
	}

	 /**
 	* Set new key for data, this can also
 	* ovewrite existing data
 	*
 	* @access public
 	* @param string $key Key identifier
 	* @param mixed $value Value assigned for key
 	*/
	public function set($key = null, $value)
	{
		if ($key === null) return $this->data = $value;

		$keys = explode('.', $key);
		$keyCount = count($keys);
		while ($keyCount > 1) {
			$key = array_shift($keys);
			if (!isset($this->data[$key])
			|| !is_array($this->data[$key])
			) {
				$this->data[$key] = array();
			}

			$this->data =& $this->data[$key];
		}

		$this->data[array_shift($keys)] = $value;

		return $this->data;
				}

				/**
 			* Check if key exists, returns if exists
 		*
 	* @access public
 			* @param string|int $key Identifier for $data
 		* @return mixed Returns value
 	*/
	public function has($key)
	{
		if (isset($this->data[(string) $key])) {
			return $this->data[$key];
		}

		return null;
	}

	/**
 	* Existence
 	*
 	* @access public
 	* @param string|int $key Identifier for $data
 	* @return bool Return existence of key
 	*/
	public function exists($key)
	{
		if (isset($this->data[(string) $key])) {
			return true;
		}

		return false;
	}

	/**
 	* Get value assigned for key
 	*
 	* @access public
 	* @param string|int $key Identifier for $data
 	* @return mixed|null Value given for key
 	*/
	public function get($key = null, $default = null)
	{
		$return = $this->data;

		if ($key !== null) {
			$keys = explode('.', $key);

			foreach ($keys as $key) {
				if (isset($return[(string) $key])) {
					$return = $return[$key];
				} else {
					$return = $default;
					break;
				}
			}
		}

		return (is_object($return) && method_exists($return, '__invoke')) ? $return($this) : $return;
	}

	/**
 	* Removes key
 	*
 	* @access public
 	* @param string|int $key Identifier for $data
 	* @return bool Value given for key
 	*/
	public function remove($key)
	{
		if ($this->exists((string) $key)) {
			unset($this->data[$key]);

			return true;
		}

		return false;
	}

	/**
 	* Replace, can overwrite data or
 	* add items to $data
 	*
 	* @access public
 	* @param array $items Array of items
 	* @param bool $recursive Allows to use array_replace_recursive
 	*/
	public function replace($items = array(), $recursive = true)
	{
		$items = (array) $items;

		if ($recursive) {
				$this->data = array_replace_recursive($this->data, $items);
			} else {
					$this->data = $items;
				}
			}

			/**
 		* Get keys of array
 	*
 	* @access public
 	* @return array Array of keys
 	*/
	public function keys()
	{
		return array_keys($this->data);
	}

	/**
 	* Get values of data
 	*
 	* @access public
 	* @return array Array of keys
 	*/
	public function values()
	{
		return array_values($this->data);
	}

	/**
 	* Clear all values
 	*/
	public function clear()
	{
		$this->data = [];
	}

	/**
 	* Short hand for clear
 	*/
	public function reset()
	{
		$this->data = [];
	}

	/**
 	* Connects array with data
 	*
 	* @method connect
 	*
 	* @param  array  $data Data to be connected
 	*
 	*/
	public function connect($data)
	{
		$this->data = array_merge_recursive($data);
	}

	/**
 	* Magic methods
 	*/

	public function __get($key)
	{
		return $this->get($key);
	}

	public function __set($key, $value)
	{
		$this->set($key, $value);
	}

	public function __isset($key)
	{
		return $this->has($key);
	}

	public function __unset($key)
	{
		$this->remove($key);
	}

	/**
 	* Return count of elements in
 	* array
 	*
 	* @access public
 	* @return int
 	*/
	public function count()
	{
		return count($this->data);
	}

	/**
 	* Converts data to array
 	*
 	* @access public
 	* @return array Data array
 	*/
	public function toArray()
	{
		return (array) $this->data;
	}

}
