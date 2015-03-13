<?php

return [
    'signup-success'    =>  [
        'route'  =>  '/sign-up/success',
        'paths'  =>  [
            'module'    =>  'User',
            'controller' => 'Frontend\User',
            'action'    =>  'signupSuccess',
            'auth'  =>  false
        ],
        'type'  =>  'static'
    ],
    'signup'    =>  [
        'route'  =>  '/sign-up',
        'paths'  =>  [
            'module'    =>  'User',
            'controller' => 'Frontend\User',
            'action'    =>  'signup',
            'auth'  =>  false
        ],
        'type'  =>  'static'
    ]
];
