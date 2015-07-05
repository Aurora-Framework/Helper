<?php

namespace Aurora\Helper;

use Aurora\Helper\Exception\RouteNotFoundException;

class Url
{
	protected $baseUri;
	protected $routes;
	protected $matchTypes = [
		'any' => "([^\/]++)",
		'num' => "([0-9]++)",
		'int' => "([0-9]++)",
		'all' => "(.*)",
		'alphanum' => "([0-9A-Za-z]++)"
	];


	public function __construct($routes = [], $matchTypes = null, $baseUri = "/")
	{
		$this->routes = $routes;
		$this->baseUri = $baseUri;
		if ($matchTypes !== null) {
			$this->matchTypes = $matchTypes;
		}
	}


	protected function normalize($route)
	{
		//make sure that all urls have the same structure
		/*if ($route[0] !== '/') {
			$route = '/' . $route;
		}*/

		/* Fix trailling shash */
		if (mb_substr($route, -1, 1) == '/') {
			$route = substr($route, 0, -1);
		}

		$result = explode('/', $route);
		$result[0] = "/";
		$ret = [];
		//check for dynamic and optional parameters
		foreach ($result as $v) {
			if (!$v) {
				continue;
			}
			if ($v[0] === "?") {
				$ret[] = [
					'name' => explode('}', mb_substr($v, 2))[0],
					'use' => '?'
				];
			} elseif (($v[0]) === '{') {
				$ret[] = [
					'name' => explode('}', mb_substr($v, 1))[0],
					'use' => "*"
				];
			}
		}

		return $ret;
	}

	protected function replaceWithParameters($url, $segments, $parameters = [], $definitions = [])
	{
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
		if (!isset($this->routes[$name]["route"])) {
			throw new RouteNotFoundException;
		}

		$url         = $this->routes[$name]["route"];
		$definitions = $this->routes[$name]["definitions"];
		$segments    = $this->normalize($this->routes[$name]["route"]);

		return $this->replaceWithParameters($url, $segments, $parameters, $definitions);
	}

	public function withRoute($url, $parameters = [], $definitions = [])
	{
		$segments = $this->normalize($url);

		return $this->replaceWithParameters($url, $segments, $parameters, $definitions);
	}

	public function asset($asset)
	{
		return sprintf($this->baseUri.'/assets/%s', ltrim($asset, '/'));
	}

	public function base($to = "")
	{
		return sprintf($this->baseUri.'/%s', ltrim($to, '/'));
	}
}
