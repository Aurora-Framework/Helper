<?php

namespace Aurora\Helper;

class Arr
{
	use StatefulTrait;

	public function __construct($data = array())
	{
		$this->data = $data;
	}

	public static function create($data = array())
	{
		return new static($data);
	}

	public function shuffle()
	{
		shuffle($this->data);

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

	public function flatten($glue = ':', $reset = true, $indexed = true)
	{
		static $return = array();
		static $curr_key = array();
		if ($reset) {
			$return = array();
			$curr_key = array();
		}
		foreach ($this->data as $key => $val) {
			$curr_key[] = $key;
			if (is_array($val) and ($indexed or array_values($val) !== $val)) {
				$this->flatten($val, $glue, false, $indexed);
			} else {
				$return[implode($glue, $curr_key)] = $val;
			}
			array_pop($curr_key);
		}

		return $return;
	}

	public function isNumeric()
	{
		foreach ($this->data as $key => $unused) {
			if (!is_int($key)) {
				return false;
			}
		}

		return true;
	}

	public function isMulti($all_keys = false)
	{
		$values = array_filter($this->data, 'is_array');
		
		return $all_keys ? count($this->data) === count($values) : count($values) > 0;
	}

}
