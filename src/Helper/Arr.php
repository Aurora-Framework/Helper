<?php

/**
 * Aurora - Framework
 *
 * Aurora is fast, simple, extensible Framework
 *
 *
 * @category   Framework
 * @package    Aurora
 * @author     VeeeneX <veeenex@gmail.com>
 * @copyright  2015 Caroon
 * @license    MIT
 * @version    0.1.3
 * @link       http://caroon.com/Aurora
 *
 */

namespace Aurora\Helper;

/**
 * Arr
 *
 * @category   Common
 * @package    Aurora
 * @author     VeeeneX <veeenex@gmail.com>
 * @copyright  2015 Caroon
 * @license    MIT
 * @version    0.1.3
 *
 */

/**
 * https://github.com/fuel/core/blob/1.8/develop/classes/arr.php
 */
class Arr
{
	use StatefulTrait;

	public static function create($data = array())
	{
		return new static($data);
	}

	public function __construct($data = array())
	{
		$this->data = $data;
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
