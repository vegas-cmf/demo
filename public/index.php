<?php
/**
 * @author Sławomir Żytko <slawek@amsterdam-standard.pl>
 * @copyright (c) 2014, Amsterdam Standard
 */
error_reporting(E_ALL);
define('APP_ROOT', dirname(dirname(__FILE__)));


require APP_ROOT . '/vendor/autoload.php';
require APP_ROOT . '/app/Bootstrap.php';
$config = require APP_ROOT . '/app/config/config.php';

$bootstrap = new \Bootstrap(new \Phalcon\Config($config));

try {
    echo $bootstrap->setup()->run();
} catch (\Exception $e) {
    file_put_contents('/tmp/vegas-cmf-error.log', $e->getTraceAsString() . PHP_EOL . $_SERVER['REQUEST_URI']);
}