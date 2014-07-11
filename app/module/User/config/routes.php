<?php

return array(
    'signup-success'    =>  array(
        'route'  =>  '/sign-up/success',
        'paths'  =>  array(
            'module'    =>  'User',
            'controller' => 'Frontend\User',
            'action'    =>  'signupSuccess',
            'auth'  =>  false
        ),
        'type'  =>  'static'
    ),
    'signup'    =>  array(
        'route'  =>  '/sign-up',
        'paths'  =>  array(
            'module'    =>  'User',
            'controller' => 'Frontend\User',
            'action'    =>  'signup',
            'auth'  =>  false
        ),
        'type'  =>  'static'
    ),
    'admin/user' => array(
        'route' =>  '/admin/user/:action/:params',
        'paths' => array(
            'module' => 'User',
            'controller' => 'Backend\User',
            'action' => 1,
            'params' => 2
        )
    )
);
