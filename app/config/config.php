<?php

define('HOSTNAME', 'vegasdemo.com');
define('DEFAULT_LANG', 'nl');

return array(
    'application' => array(
        'environment'    => \Vegas\Constants::DEV_ENV,

        'lang' => DEFAULT_LANG,
        //list of available languages
        'langs' => array(
            'nl' => 'Nederlands',
            'en' => 'English',
            'pl' => 'Polski'
        ),

        'servicesDir'   =>  APP_ROOT . '/app/services/',
        'configDir'     => dirname(__FILE__) . DIRECTORY_SEPARATOR,
        'libraryDir'     => APP_ROOT . DIRECTORY_SEPARATOR . 'lib/',
        'pluginDir'      => APP_ROOT . '/app/plugins/',
        'moduleDir'      => APP_ROOT . '/app/module/',
        'tasksDir'      => APP_ROOT . '/app/tasks/',
        'baseUri'        => '/',
        'language'       => 'nl_NL',
        'subModules'    =>  array(
            'frontend', 'backend', 'dashboard'
        ),
        'view'  => array(
            'cacheDir'  =>  APP_ROOT . '/cache/',
            'layout'    =>  'main',
            'layoutsDir'    =>  APP_ROOT. '/app/layouts/'
        ),

        'hostname'    =>  'vegasdemo.com'
    ),

    'mongo' => array(
        'db' => 'vegas_demo',
        'host' => 'localhost'
    ),

    'db' => array(
        "adapter"  => "Mysql",
        "host"     => "localhost",
        "username" => "root",
        "port" => 3306,
        "password" => "root",
        "dbname"     => "vegas_project",
    ),

    'session' => array(
        'cookie_name'   =>  'sid',
        'cookie_lifetime'   =>  36*3600, //day and a half
        'cookie_secure' => 0,
        'cookie_httponly' => 1
    ),

    'plugins' => array(
        'security' => array(
            'class' => 'SecurityPlugin',
            'attach' => 'dispatch'
        )
    )
);