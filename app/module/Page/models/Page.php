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
namespace Page\Models;

use Vegas\Db\Decorator\CollectionAbstract;

class Page extends CollectionAbstract
{
    public function getSource()
    {
        return 'vegas_pages';
    }
    
    public function beforeSave() {        
        
        $this->generateSlug($this->name); 
        
    }
        
    public static function findOrCreateByRoute($router) {
        
        $paths = $router->getPaths();
        $url   = $paths['module'] . '/' . $paths['controller'] . '/' . $paths['action'];
        return new Page;
    }
    
}
