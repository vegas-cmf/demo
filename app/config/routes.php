<?php
return array(
    'root'  =>  array(
        'route' =>  '/',
        'type'  =>  'static',
        'paths' =>  array(
            'module'    =>  'Home',
            'controller'    =>  'Frontend\Home',
            'action'    =>  'index',

            /**
             * Put 'auth' key within 'paths' where user should be authenticated
             * false    =>  authentication is disabled
             * auth     =>  'auth' is a name of registered authentication service.
             *              It can be also 'authAdmin', 'authUser' or any name you
             *              used for register authentication service in service
             *              provider.
             */
            'auth'  =>  false
        )
    )
);