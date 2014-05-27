<?php
return array(
    'dashboard' =>  array(
        'route' =>  '/',
        'paths' => array(
            'module'    =>  'Dashboard',
            'controller'    =>  'Frontend\Home',
            'action'    =>  'index',

            'auth'      =>  'authDashboard'
        ),
        'type' => 'static',
        'params' => array(
            'hostname'  =>  'test.vegasdemo.com'
        )
    ),
    'dashboard_login' =>  array(
        'route' =>  '/login',
        'paths' => array(
            'module'    =>  'Dashboard',
            'controller'    =>  'Frontend\Auth',
            'action'    =>  'login',

            'auth'      =>  false
        ),
        'type' => 'static',
        'params' => array(
            'hostname'  =>  'test.vegasdemo.com'
        )
    ),
    'dashboard_logout' =>  array(
        'route' =>  '/logout',
        'paths' => array(
            'module'    =>  'Dashboard',
            'controller'    =>  'Frontend\Auth',
            'action'    =>  'logout',

            'auth'      =>  false
        ),
        'type' => 'static',
        'params' => array(
            'hostname'  =>  'test.vegasdemo.com'
        )
    )
);