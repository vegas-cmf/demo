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
        )
    ),

    'environment'    => 'development',

    'auth'  =>  array(
        'auth'  =>  array(
            'route'    =>  'login'
        )
    ),

    'oauth' =>  array(
        'linkedin'  =>  array(
            'key'   =>  '77vrwtb3qaiq8y',
            'secret'    =>  'xRFH1mvEwQez6Uvm',
            'redirect_uri' => '/oauth/linkedin',
            'scopes' => array(
                \Vegas\Security\OAuth\Service\Linkedin::SCOPE_FULL_PROFILE,
                \Vegas\Security\OAuth\Service\Linkedin::SCOPE_EMAIL_ADDRESS,
                \Vegas\Security\OAuth\Service\Linkedin::SCOPE_NETWORK_UPDATES
            )
        ),
        'facebook'  =>  array(
            'key'   =>  '1451737385070448',
            'secret'    =>  '54046a53e2d13fc32e387039c0d3203a',
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
            'key'    =>  '559999790295-8l0dmppvrtd4qrfonu8bdnjm94db3qd3.apps.googleusercontent.com',
            'secret'   =>  '8jz78cLHV2a9_X4ZzrTKK5Lo',
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