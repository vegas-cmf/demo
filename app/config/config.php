<?php

define('HOSTNAME', 'vegasdemo.com');
define('DEFAULT_LANG', 'en');

return [
    'application' => [
        'environment'    => \Vegas\Constants::DEV_ENV,

        'lang' => DEFAULT_LANG,
        //list of available languages
        'langs' => [
            'nl' => 'Nederlands',
            'en' => 'English',
            'pl' => 'Polski'
        ],

        'serviceDir'   =>  APP_ROOT . '/app/services/',
        'configDir'     => dirname(__FILE__) . DIRECTORY_SEPARATOR,
        'libraryDir'     => APP_ROOT . DIRECTORY_SEPARATOR . 'lib/',
        'pluginDir'      => APP_ROOT . '/app/plugins/',
        'moduleDir'      => APP_ROOT . '/app/modules/',
        'taskDir'      => APP_ROOT . '/app/tasks/',
        'baseUri'        => '/',
        'language'       => 'nl_NL',
        'view'  => [
            'cacheDir'  =>  APP_ROOT . '/cache/',
            'layout'    =>  'main',
            'layoutsDir'    =>  APP_ROOT. '/app/layouts/'
        ],

        'hostname'    =>  HOSTNAME
    ],

    'mongo' => [
        'dbname' => 'vegas_demo',
        'host' => 'localhost'
    ],

    'db' => [
        "adapter"  => "Mysql",
        "host"     => "localhost",
        "username" => "root",
        "port" => 3306,
        "password" => "root",
        "dbname"     => "vegas_project",
    ],

    'session' => [
        'cookie_name'   =>  'sid',
        'cookie_lifetime'   =>  36*3600, //day and a half
        'cookie_secure' => 0,
        'cookie_httponly' => 1
    ],

    'plugins' => [
        'security' => [
            'class' => 'SecurityPlugin',
            'attach' => 'dispatch'
        ]
    ]
];