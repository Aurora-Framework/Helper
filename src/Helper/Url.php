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
		$url = $Route->route;
		foreach ($segments as $key => $row) {
			if (isset($parameters[$row["name"]])) {
				if ($row["use"] === "*") {
					if (isset($definitions[$row["name"]])) {
						$definition = $definitions[$row["name"]];
						$regex = ($definition[0] === "(") ? $definition : $this->Router->getMatchType($definition, "(.*)");

						if (!preg_match($regex, $parameters[$row["name"]])) {
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
		if (!isset($this->Router->rawRoutes[$name])) {
			throw new RouteNotFoundException("Route with name or route: {$name} wasn't found", 1);
		}
		$Route = $this->Router->rawRoutes[$name];
		if (!isset($this->Router->rawRoutes[$name]["segments"])) {
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
