<?php
require __DIR__ . "./../../Router/vendor/Router.php"; // Autoload files using Composer
require __DIR__ . "./../vendor/autoload.php"; // Autoload files using Composer

class HelpMe
{
   use Aurora\Helper\Object;
}

$HelpMe = new HelpMe();

echo $HelpMe->has("myvalue"); #false
echo $HelpMe->get("myvalue"); #null
echo $HelpMe->set("myvalue", "Hey");
echo $HelpMe->remove("myvalue"); #true
