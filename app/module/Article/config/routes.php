<?php
return array(
    'articles' =>  array(
        'route' =>  '/{lang:[a-z]{2}}/articles/:action/:params',
        'paths' => array(
            'module'    =>  'Article',
            'controller'    =>  'Frontend\Example',
            'action'    =>  2,
            'params'    =>  3,

            'auth'      =>  false
        )
    )
);