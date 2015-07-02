<?php
include __DIR__ . "./../../Router/src/Router.php"; // Autoload files using Composer
require __DIR__ . "./../vendor/autoload.php"; // Autoload files using Composer


$Router = new Aurora\Router("/home");
$Router->post('/', 'HomeController@index');


$Router->addRoute("GET", '/user/{id}/?{name}', 'UserController@show', "getUser", [
	"id" => "num",
]);


$Router->addRoute("GET", '/user/messages/{id}/?{toId}', 'UserController@show', "getMessage");
$Router->findRoute('GET', '/home/user/1');


$raw = $Router->getRawRoutes();
$url = new Aurora\Helper\Url($raw);

# Usage

// var_dump($url->withRoute("/user/{id}/?{name}", [
// 	"id" => 3,
// 	"name" => "Samuell"
// ]));