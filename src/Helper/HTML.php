<?php

namespace Aurora\Helper;

use Closure;
use BadMethodCallException;

class HTML
{
	protected $xhtml;

	protected static $tags = [];

	public function __construct($xhtml = false)
	{
		$this->xhtml = $xhtml;
	}

	public static function registerTag($name, Closure $tag)
	{
		static::$tags[$name] = $tag;
	}

	public function attributes($attributes)
	{
		if (!is_array($attributes)) {
			return $attributes;
		}

		$attr = '';
		foreach ($attributes as $attribute => $value) {
			if (is_int($attribute)) {
				$attribute = $value;
			}
			$attr .= ' ' . $attribute . '="' . $value . '"';
		}

		return $attr;
	}

	public function tag($name, $content = null, $attributes = [])
	{
		return '<' . $name . $this->attributes($attributes) . (($content === null) ? ($this->xhtml ? ' />' : '>') : '>' . $content . '</' . $name . '>');
	}

	public function a($href = "", $content = null, $attributes = [])
	{
		if ($content === null) {
			$content = $href;
		}

		return '<a href="'.$href.'"'. $this->attributes($attributes) . (($content === null) ? ($this->xhtml ? ' />' : '>') : '>' . $content . '</a>');
	}

	protected function buildList($type, $items, $attributes)
	{
		$list = '';

		foreach ($items as $item) {
			if (is_array($item)) {
				$list .= $this->tag('li', $this->buildList($type, $item, []), []);
			} else {
				$list .= $this->tag('li', $item, []);
			}
		}

		return $this->tag($type, $list, $attributes);
	}

	public function ul(array $items, array $attributes = [])
	{
		return $this->buildList('ul', $items, $attributes);
	}

	public function img($content = null, $attributes = [])
	{
		return '<img' . $this->attributes($attributes) . (($content === null) ? ($this->xhtml ? ' />' : '>') : '>' . $content . '</img>');
	}

	public function ol(array $items, array $attributes = [])
	{
		return $this->buildList('ol', $items, $attributes);
	}

	public function meta($name, $content = null, $type = "name")
	{
		return '<meta'. (($type === "name") ? ' name="'.$name.'" ' : "" ).' content="'.$content.'" />';
	}

	public function __call($name, array $arguments = [])
	{
		if (!isset(static::$tags[$name])) {
			throw new BadMethodCallException(vsprintf("Call to undefined method HTML::%s().", [$name]));
		}

		$fn = static::$tags[$name];

		return $fn(...array_merge([$this], $arguments));
	}
}
