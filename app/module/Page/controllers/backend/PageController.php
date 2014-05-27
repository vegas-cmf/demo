<?php
/**
 * This file is part of Vegas package
 *
 * @author Adrian Malik <adrian.malik.89@gmail.com>
 * @copyright Amsterdam Standard Sp. Z o.o.
 * @homepage https://bitbucket.org/amsdard/vegas-phalcon
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Page\Controllers\Backend;

use Vegas\Mvc\Controller;

/**
 * Class PageController
 *
 * @ACL(name='mvc:Page:Backend\Page', description='Static page')
 *
 * @package Page\Controllers\Backend
 */
class PageController extends Controller\Crud
{
    protected $formName = 'Page\Forms\Page';
    protected $modelName = 'Page\Models\Page';

    public function initialize()
    {
        parent::initialize();
        
        // we (can) view this in the modal layout from the frontend     
        if( $this->dispatcher->getParam('display') == 'modal' ){ 
            $this->view->setLayout('modal');
            $this->view->route = 'admin/modal/page';            
        } else {
            $this->view->route = 'admin/page';
        }
        
        //
        $this->view->h1 = 'Create a page';
        
        // add events
        $this->dispatcher->getEventsManager()->attach(Controller\Crud\Events::AFTER_CREATE, $this->displayAfterSuccess());
        $this->dispatcher->getEventsManager()->attach(Controller\Crud\Events::AFTER_UPDATE, $this->displayAfterSuccess());

        // @TODO DELETE COMPONENTS !!!
        $this->dispatcher->getEventsManager()->attach(Controller\Crud\Events::AFTER_DELETE, $this->displayAfterSuccess());
    }
    
    private function displayAfterSuccess()
    {
        return function() {
            // @TODO: display view 
            echo '<script>parent.window.location = "/' . $this->scaffolding->getRecord()->slug . '?vegas-component-manager";</script>';
            exit;
        };
    }
    
    private function redirectAfterSuccess()
    {
        return function() {
            $this->response->redirect(array(
                'for'    => 'admin/page', 
                'action' => 'index', 
            ));
        };
    }
    
    /**
     * @ACL(name='modal', description='After action modal display')
     */
    public function modalAction($params = '')
    {        
        
    }  

    /**
     * @ACL(name='index', description='List static pages')
     */
    public function indexAction()
    {
        $pages = \Page\Models\Page::find();

        $this->view->pages = $pages;
    }
}

