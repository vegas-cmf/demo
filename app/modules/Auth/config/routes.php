<?php

return [
    'login' => [
        'route' => '/login',
        'paths' => [
            'module' => 'Auth',
            'controller' => 'Frontend\Auth',
            'action' => 'login',

            'auth'  =>  false
        ],
        'type' => 'static'

    ],
    'logout' => [
        'route' => '/logout',
        'paths' => [
            'module' => 'Auth',
            'controller' => 'Frontend\Auth',
            'action' => 'logout',

            'auth'  =>  'auth'
        ],
        'type' => 'static'
    ]
];
