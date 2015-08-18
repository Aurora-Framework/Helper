<?php

namespace Aurora\Helper;

use Aurora\Helper\Exception\RouteNotFoundException;
use Aurora\Router;

class Url
{
	public function __construct(Router $Router)
	{
		$this->Router     = $Router;
	}

	protected function replaceWithParameters($Route, $parameters = [])
	{
		$segments    = $Route->segments;
		$definitions = $Route->definitions;

		foreach ($segments as $key => $row) {
			if (isset($parameters[$row["name"]])) {
				if ($row["use"] === "*") {
					if (isset($definitions[$row["name"]])) {
						if (!preg_match($this->matchTypes[$definitions[$row["name"]]], $parameters[$row["name"]])) {
							throw new \UnexpectedValueException;
						}
					}

					$url = str_replace("{".$row["name"]."}", $parameters[$row["name"]], $url);
				} else {
					$url = str_replace("?{".$row["name"]."}", $parameters[$row["name"]], $url);
				}
			} else {
				if ($row["use"] === "*")	{
					throw new \UnexpectedValueException;
				}
			}
		}

		return $url;
	}

	public function get($name, $parameters = [])
	{
		$Route = $this->routes[$name];
		if (!isset($this->routes[$name]["segments"])) {
			$Route->segments  = $this->Router->normalize($name);
		}
		return $this->replaceWithParameters($Route, $parameters);
	}

	public function asset($asset)
	{
		return sprintf($this->Router->baseUri.'/assets/%s', ltrim($asset, '/'));
	}

	public function base($to = "")
	{
		return sprintf($this->Router->baseUri.'/%s', ltrim($to, '/'));
	}

	public function url($to = "")
	{
		return sprintf($this->Router->baseUri.'/%s', ltrim($to, '/'));
	}

	public function link($to = "")
	{
		return sprintf($this->Router->baseUri.'/%s', ltrim($to, '/'));
	}
}
