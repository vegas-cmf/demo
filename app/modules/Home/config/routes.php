<?php
return [
    'private' => [
        'route' => '/private',
        'paths' => [
            'module'    =>  'Home',
            'controller' => 'Frontend\Private',
            'action' => 'index',

            'auth'  =>  'auth',
        ],
        'type' => 'static',
    ]
];