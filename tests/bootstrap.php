<?php
//Test Suite bootstrap
include __DIR__ . "/../vendor/autoload.php";

define('TESTS_ROOT_DIR', dirname(__FILE__));

$configArray = require_once dirname(__FILE__) . '/config.php';

$config = new \Phalcon\Config($configArray);
$di = new \Phalcon\DI\FactoryDefault();

\Phalcon\DI::setDefault($di);