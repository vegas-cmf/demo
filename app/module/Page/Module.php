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

namespace Page;

class Module extends \Vegas\Mvc\ModuleAbstract
{
    public function __construct() {
        $this->namespace = __NAMESPACE__;
        $this->dir = __DIR__;
    }
    
    public function registerServices($di)
    {
        $this->registerScaffolding($di);        
        $this->registerPage($di);
        parent::registerServices($di);
    }

    protected function registerPage($di)
    {
        $di->set('page',function() use($di) {
            $router  = $di->get('router');
            $matched = $router->getMatchedRoute();
            return \Page\Models\Page::findOrCreateByRoute($matched);    
        }, true);
    }
    
    protected function registerScaffolding($di)
    {
        $adapter = new \Vegas\DI\Scaffolding\Adapter\Mongo;
        $di->set('scaffolding', new \Vegas\DI\Scaffolding($adapter));
    }
}