<?php
return array(
    'private' => array(
        'route' => '/private',
        'paths' => array(
            'module'    =>  'Home',
            'controller' => 'Frontend\Private',
            'action' => 'index',

            'auth'  =>  'auth'
        )
    ),
    'oauth' => array(
        'route' => '/oauth',
        'paths' => array(
            'module'    =>  'Home',
            'controller' => 'Frontend\Home',
            'action' => 'oauth',

            'auth'  =>  false
        )
    ),
    'linkedin' => array(
        'route' => '/linkedin',
        'paths' => array(
            'module'    =>  'Home',
            'controller' => 'Frontend\Home',
            'action' => 'linkedin',

            'auth'  =>  false
        )
    )
);