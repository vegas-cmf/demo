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
    )
);