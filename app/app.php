<?php

//use lib\HW;
use Library\HelloWorld\HW;

define('APPLICATION_ROOT_DIR', dirname(__DIR__));
require_once APPLICATION_ROOT_DIR . DIRECTORY_SEPARATOR . "bootstrap.php";

$hw = new HW();

$hw->run();
