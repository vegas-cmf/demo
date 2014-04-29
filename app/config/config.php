<?php
return array(
    'application' => array(
        'servicesDir'   =>  APP_ROOT . '/app/services/',
        'configDir'     => dirname(__FILE__) . DIRECTORY_SEPARATOR,
        'libraryDir'     => dirname(APP_ROOT) . DIRECTORY_SEPARATOR,
        'pluginDir'      => APP_ROOT . '/app/plugins/',
        'moduleDir'      => APP_ROOT . '/app/module/',
        'baseUri'        => '/',
        'language'       => 'nl_NL',
        'subModules'    =>  array(
            'frontend', 'backend', 'custom'
        ),
        'view'  => array(
            'cacheDir'  =>  APP_ROOT . '/cache/',
            'layout'    =>  'main',
            /**
             * app/layouts must be relative in vendor/Vegas/Mvc/ModuleAbstract
             * @see https://github.com/phalcon/cphalcon/issues/546
             */
            'layoutsDir'    =>  '../../../../app/layouts'
        )
    ),


    'plugins' => array(),

    'environment'    => 'development',

    'mongo' => array(
        'db' => 'vegas_test',
    ),
);