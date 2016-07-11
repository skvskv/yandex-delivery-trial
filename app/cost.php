<?php

namespace YDT\Application;

define('APPLICATION_ROOT_DIR', dirname(__DIR__));
require_once APPLICATION_ROOT_DIR . DIRECTORY_SEPARATOR . "bootstrap.php";

define('PROVINCE_DATAFILE', '/tmp/city.csv');
define('PRICES_DATAFILE', '/tmp/cost.csv');

$app = new Application(PROVINCE_DATAFILE, PRICES_DATAFILE);

$app->init();
$app->run();
