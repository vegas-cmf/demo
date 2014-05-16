<?php

return array(
    'login' => array(
        'route' => '/login',
        'paths' => array(
            'module' => 'Auth',
            'controller' => 'Frontend\Auth',
            'action' => 'login',

            'auth'  =>  false
        ),
        'type' => 'static'
    ),
    'logout' => array(
        'route' => '/logout',
        'paths' => array(
            'module' => 'Auth',
            'controller' => 'Frontend\Auth',
            'action' => 'logout',

            'auth'  =>  'auth'
        ),
        'type' => 'static',
    )
);
