<?php
return array(
    'application' => array(
        'servicesDir'   =>  APP_ROOT . '/app/services/',
        'configDir'     => dirname(__FILE__) . DIRECTORY_SEPARATOR,
        'libraryDir'     => APP_ROOT . DIRECTORY_SEPARATOR . 'lib/',
        'pluginDir'      => APP_ROOT . '/app/plugins/',
        'moduleDir'      => APP_ROOT . '/app/module/',
        'baseUri'        => '/',
        'language'       => 'nl_NL',
        'subModules'    =>  array(
            'frontend', 'backend'
        ),
        'view'  => array(
            'cacheDir'  =>  APP_ROOT . '/cache/',
            'layout'    =>  'main',
            /**
             * app/layouts must be relative in vendor/Vegas/Mvc/ModuleAbstract
             * @see https://github.com/phalcon/cphalcon/issues/546
             */
            'layoutsDir'    =>  '../../../../app/layouts'
        ),

        'hostname'    =>  'vegasdemo.com'
    ),

    'environment'    => 'development',

    'auth'  =>  array(
        'auth'  =>  array(
            'route'    =>  'login'
        ),
        'authDashboard'  =>  array(
            'route'    =>  'dashboard_login'
        )
    ),

    'oauth' =>  array(
        'linkedin'  =>  array(
            'key'   =>  '77yxzhmmzdj0xg',
            'secret'    =>  'WgSxkb1I8yovu0T1',
            'redirect_uri' => '/oauth/linkedin',
            'scopes' => array(
                \Vegas\Security\OAuth\Service\Linkedin::SCOPE_FULL_PROFILE,
                \Vegas\Security\OAuth\Service\Linkedin::SCOPE_EMAIL_ADDRESS,
                \Vegas\Security\OAuth\Service\Linkedin::SCOPE_NETWORK_UPDATES
            )
        ),
        'facebook'  =>  array(
            'key'   =>  '641315079294877',
            'secret'    =>  '149317069d91ad668831b3db8f65457e',
            'redirect_uri' => '/oauth/facebook',
            'scopes' => array(
                \Vegas\Security\OAuth\Service\Facebook::SCOPE_EMAIL,
                \Vegas\Security\OAuth\Service\Facebook::SCOPE_PAGES,
                \Vegas\Security\OAuth\Service\Facebook::SCOPE_PUBLISH_ACTIONS,
                \Vegas\Security\OAuth\Service\Facebook::SCOPE_PUBLISH_STREAM,
                \Vegas\Security\OAuth\Service\Facebook::SCOPE_USER_ABOUT,
                \Vegas\Security\OAuth\Service\Facebook::SCOPE_USER_ACTIVITIES
            )
        ),
        'google'  =>  array(
            'key'    =>  '772598645983-djivugpe83m3og9rt87u3bfqooue9n7m.apps.googleusercontent.com',
            'secret'   =>  'krX1s6vsNTXAS-t0_FUIjDi6',
            'redirect_uri' => '/oauth/google',
            'scopes' => array(
                \Vegas\Security\OAuth\Service\Google::SCOPE_EMAIL,
                \Vegas\Security\OAuth\Service\Google::SCOPE_PROFILE
            )
        ),
    ),

    'mongo' => array(
        'db' => 'vegas_demo',
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