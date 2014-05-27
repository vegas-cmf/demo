<?php
/**
 * This file is part of Vegas package
 *
 * @author Frank Broersen <frank@pitgroup.nl>
 * @copyright Amsterdam Standard Sp. Z o.o.
 * @homepage https://bitbucket.org/amsdard/vegas-phalcon
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Page\Services;

use Page\Models\Page,
    Page\Models\Preview;

class Manager extends \Vegas\DI\Service\ComponentAbstract
{    
    private $pages = false;
    
    private $components = false;
    
    protected function setUp($params = array())
    {        
        $mode = 'view';
        if(isset($_GET['vegas-component-manager']))
            $mode = 'edit';
                
        $identity = $this->di->get('auth')->getIdentity();
        
        $action  = $params['action'];
        $page_id = $this->di->get('page')->_id;
        
        if( $mode === 'edit' && ! $this->pages) {
            $this->pages      = Page::find();
            $this->components = Preview::find(array(
                'sort' => array('name' => 1)
            ));
        }
        
        // if ($this->di->get('authUser')->isAuthenticated()) {
        //    $userId = $this->di->get('authUser')->getIdentity()->getId();
        //    $isFaved = Component::isUrlFaved($url, $userId);
        // }
        
        return array(
            'identity'          => $identity,
            'action'            => $action,
            'mode'              => $mode,
            'page_id'           => $page_id,
            'pages'             => $this->pages,
            'components'        => $this->components,
        );
    }
}