<?php
require __DIR__ . "./../vendor/autoload.php"; // Autoload files using Composer
use Aurora\Helper\Object;
use Aurora\Helper\StrictObject;
//$StrictObject = new StrictObject();
$Object = new Object();

xdebug_start_trace();

echo($Object->has("myvalue")); #false
echo($Object->exists("myvalue")); #false

echo($Object->get("myvalue"));
echo($Object->get("myvalue", false));

$Object->set("myvalue", "Hey");

$Object->set("hello.hey", "Hey");

echo($Object->has("myvalue")); #false
echo($Object->exists("hello.hey")); #false

echo($Object->remove("myvalue")); #true

//
// echo($StrictObject->has("myvalue")); #false
// echo($StrictObject->exists("myvalue")); #false
//
// echo($StrictObject->get("myvalue"));
// echo($StrictObject->get("myvalue", false));
//
// $StrictObject->set("myvalue", "Hey");
// $StrictObject->set("hello.hey", "Hey");
//
// echo($StrictObject->has("myvalue")); #false
// echo($StrictObject->exists("hello.hey")); #false
//
// echo($StrictObject->remove("myvalue")); #true

// $StrictObject->car = "Ferrari";
// echo($StrictObject->caro);
//
// unset($StrictObject->caro);
