<?php

return array(
    'oauth' => array(
        'route' => '/oauth',
        'paths' => array(
            'module'    =>  'Oauth',
            'controller' => 'Frontend\Oauth',
            'action' => 'oauth',

            'auth'  =>  false
        )
    ),
    'authorize' => array(
        'route' => '/oauth/{service}',
        'paths' => array(
            'module'    =>  'Oauth',
            'controller' => 'Frontend\Oauth',
            'action' => 'authorize',

            'auth'  =>  false
        )
    )
);
