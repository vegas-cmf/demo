<?php
/**
 * This file is part of Vegas package
 *
 * @author Adrian Malik <adrian.malik.89@gmail.com>
 * @copyright Amsterdam Standard Sp. Z o.o.
 * @homepage http://vegas-cmf.github.io
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Page\Controllers\Frontend;

use Vegas\Mvc\Controller\ControllerAbstract,
    Page\Models\Page,
    Phalcon\Mvc\View;

/**
 * Class PageController
 *
 * @ACL(name='mvc:page:Frontend\Page', description='Static page')
 *
 * @package Page\Controllers\Frontend
 */
class PageController extends ControllerAbstract
{
    /**
     * @ACL(name='show', description='Show static page')
     */
    public function showAction($slug)
    {
        if(!$slug) {
            $slug = 'home';
        }
        
        $page = Page::findFirst(array('conditions' => array('slug' => $slug)));

        if(!$page) {
            $this->throw404('Page does not exist.');
        }
        
        $this->di->set('page',function() use ($page) {
            return $page;
        }, true);
        
        $this->view->title = $page->title;
        $this->view->page = $page;
        
        if(isset($_GET['layout']))
            $this->view->setLayout($_GET['layout']);
        
        if(isset($_GET['ajax']))
            $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
    }
}

