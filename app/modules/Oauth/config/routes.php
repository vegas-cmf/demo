<?php

return [
    'oauth' => [
        'route' => '/oauth',
        'paths' => [
            'module'    =>  'Oauth',
            'controller' => 'Frontend\Oauth',
            'action' => 'oauth',

            'auth'  =>  false
        ]
    ],
    'authorize' => [
        'route' => '/oauth/{service}',
        'paths' => [
            'module'    =>  'Oauth',
            'controller' => 'Frontend\Oauth',
            'action' => 'authorize',

            'auth'  =>  false
        ]
    ]
];
