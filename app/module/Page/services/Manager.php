<?php
/**
 * This file is part of Vegas package
 *
 * @author Frank Broersen <frank@pitgroup.nl>
 * @copyright Amsterdam Standard Sp. Z o.o.
 * @homepage http://vegas-cmf.github.io
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
        $identity = $this->di->get('auth')->getIdentity();
        $session = $this->di->get('session');
        
        $mode = 'view';
        if($identity && $session->has('mode'))
            $mode = $session->get('mode');
                
        if( $identity && ! $this->pages) {
            $this->pages      = Page::find(array(
                'sort' => array('name' => 1)    // @TODO make this a page tree
            ));
            $this->components = Preview::find(array(
                'sort' => array('name' => 1)
            ));
        }
        
        return array(
            'identity'          => $identity,
            'mode'              => $mode,
            'action'            => $params['action'],
            'page_id'           => $this->di->get('page')->_id,
            'pages'             => $this->pages,
            'components'        => $this->components,
        );
    }
}