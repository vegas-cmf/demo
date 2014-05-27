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

//    'user' => array(
//        '/user/([a-z0-9]{24})',
//        array(
//            'module' => 'User',
//            'controller' => 'Frontend\User',
//            'action' => 'show',
//            'id' => 1
//        )
//    ),
//
//    'my-account' => array(
//        '/my-account',
//        array(
//            'module' => 'User',
//            'controller' => 'Frontend\User',
//            'action' => 'myAccount'
//        )
//    ),
//
//    'my-account/update' => array(
//        '/my-account/update',
//        array(
//            'module' => 'User',
//            'controller' => 'Frontend\User',
//            'action' => 'update'
//        )
//    ),
//
    'admin/user' => array(
        'route' =>  '/admin/user/:action/:params',
        'paths' => array(
            'module' => 'User',
            'controller' => 'Backend\User',
            'action' => 1,
            'params' => 2
        )
    ),
//
//    'admin/user/upload' => array(
//        '/admin/user/upload',
//        array(
//            'module' => 'User',
//            'controller' => 'Backend\User',
//            'action' => 'upload'
//        )
//    )
);
