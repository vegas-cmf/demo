<?php

/**
 * 
 */
return array(
    
    /* page frontend */
        
    'page' => array(
        'route' => '/{slug}',
        'paths' => array(
            'module'        => 'Page',
            'controller'    => 'Frontend\Page',
            'action'        => 'show',
            'slug'          => 1
        )
    ),
    
    /* component backend */
    
    'admin/component' => array(
        'route' => '/admin/component/:action/:params',
        'paths' => array(
            'module'        => 'Page',
            'controller'    => 'Backend\Component',
            'action'        => 1,
            'params'        => 2
        )
    ),    
    
    'admin/component/tools' => array(
        'route' => '/admin/component/tools/:action/:params',
        'paths' => array(
            'module'        => 'Page',
            'controller'    => 'Backend\Component\Tools',
            'action'        => 1,
            'params'        => 2
        )
    ),    
        
    /* page backend */
    'admin/modal/page' => array(
        'route' => '/admin/modal/page/:action/:params',
        'paths' => array(
            'module'        => 'Page',
            'controller'    => 'Backend\Page',
            'action'        => 1,
            'params'        => 2,
            'display'       => 'modal',
        )
    ),
    
    'admin/page' => array(
        'route' => '/admin/page/:action/:params',
        'paths' => array(
            'module'        => 'Page',
            'controller'    => 'Backend\Page',
            'action'        => 1,
            'params'        => 2
        )
    ),
    
);
