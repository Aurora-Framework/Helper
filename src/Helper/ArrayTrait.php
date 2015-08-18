<?php

namespace Aurora\Helper;

trait ArrayTrait
{
    /**
    * Stores Object data
    *
    * @access protected
    * @var array|null $data Storage of helper class
    */
    protected $data = [];

    /**
	* Constructor (Sth like that)
	*
	* @access public
	* @param array $data Pre-populate set with this key-value array
	*/
	public function setData($data = array())
	{
		$this->data = (array) $data;

        return $this;
	}

	public function first()
	{
		return current($this->data);
	}

	public function last()
	{
		return end($this->data);
	}

    public function shuffle()
	{
		shuffle($this->data);

		return $this;
	}

	/**
	* @param string $key
	*
	* @return bool
	*/
	public function offsetExists($key)
	{
        return $this->exists($key);
	}

	/**
	* @param string $key
	*
	* @return mixed
	*/
	public function offsetGet($key)
	{
        return $this->get($key);
	}

	/**
	* @param string $key
 	* @param mixed $value
 	*/
 	public function offsetSet($key, $value)
 	{
        return $this->set($key, $value);
	}

	/**
 	* @param string $key
 	*/
 	public function offsetUnset($key)
 	{
        return $this->remove($key);
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
 	* Set new key for data, this can also
 	* ovewrite existing data
 	*
 	* @access public
 	* @param string $key Key identifier
 	* @param mixed $value Value assigned for key
 	*/
	public function set($path = null, $value = null)
	{
		if ($path === null) {
            $this->data = $value;
            return $this;
        }

        $at       =& $this->data;
        $keys     = explode(".", $path);
        $keyCount = count($keys);

        for ($i=0; $i < $keyCount; $i++) {
            if (($keyCount-1) === $i) {
                if (is_array($at)) {
                    $at[$keys[$i]] = $value;
                } else {
                    throw new \RuntimeException("Can not set value at this path ($path) because is not array.");
                }
            } else {
                $key = $keys[$i];
                if (!isset($at[$key])) {
                    $at[$key] = [];
                }
                $at =& $at[$key];
            }
        }

        return $this;
	}

	/**
	* Check if key exists, returns if exists
	*
	* @access public
	* @param string|int $key Identifier for $data
	* @return mixed Returns value
	*/
	public function has($key, $default = false)
	{
		return $this->get($key, false);
	}

	/**
 	* Existence
 	*
 	* @access public
 	* @param string|int $key Identifier for $data
 	* @return bool Return existence of key
 	*/
	public function exists($path)
	{
        $at       =& $this->data;
        $keys     = explode(".", $path);
        $keyCount = count($keys);

        for ($i=0; $i < $keyCount; $i++) {
            if (($keyCount-1) === $i) {
                return isset($at[$keys[$i]]);
            } else {
                $key = $keys[$i];
                if (!isset($at[$key])) {
                    $at[$key] = [];
                }
                $at =& $at[$key];
            }
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

		return $return;
	}

	/**
 	* Removes key
 	*
 	* @access public
 	* @param string|int $key Identifier for $data
 	* @return bool Value given for key
 	*/
	public function remove($path)
	{
        $at       =& $this->data;
        $keys     = explode(".", $path);
        $keyCount = count($keys);

        for ($i=0; $i < $keyCount; $i++) {
            if (($keyCount-1) === $i) {
                unset($at[$keys[$i]]);
                return true;
            } else {
                $key = $keys[$i];
                if (!isset($at[$key])) {
                    $at[$key] = [];
                }
                $at =& $at[$key];
            }
        }

		return false;
	}

    public function delete($path)
    {
        return $this->remove($path);
    }

}
