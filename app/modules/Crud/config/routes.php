<?php
return [
    'crud' =>  [
        'route' =>  '/crud/:action/:params',
        'paths' => [
            'module'    =>  'Crud',
            'controller'    =>  'Frontend\Article',
            'action'    =>  1,
            'params'    =>  2,

            'auth'      =>  'auth'
        ]
    ]
];