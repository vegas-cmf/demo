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
namespace Page\Controllers\Backend;

use Vegas\Mvc\Controller;

/**
 * Class ComponentController
 *
 * @ACL(name='mvc:component:Backend\Component', description='Component')
 *
 * @package Component\Controllers\Backend
 */
class ComponentController extends Controller\Crud
{
    protected $formName = 'Page\Forms\Component';
    protected $modelName = 'Page\Models\Component';

    private $component;
    
    public function initialize()
    {
        parent::initialize();
        
        // create generic form
        $this->dispatcher->getEventsManager()->attach(Controller\Crud\Events::AFTER_READ, $this->createComponentForm());
        $this->dispatcher->getEventsManager()->attach(Controller\Crud\Events::BEFORE_UPDATE, $this->createComponentForm());
        
        // window reload via js
        $this->dispatcher->getEventsManager()->attach(Controller\Crud\Events::AFTER_CREATE, $this->redirectAfterSuccess());
        $this->dispatcher->getEventsManager()->attach(Controller\Crud\Events::AFTER_UPDATE, $this->redirectAfterSuccess()); 
        $this->dispatcher->getEventsManager()->attach(Controller\Crud\Events::AFTER_DELETE, $this->redirectAfterSuccess());
        
        // we view this in the modal layout
        $this->view->setLayout('modal');
    }   
    
    /**
     * @ACL(name='modal', description='After action modal display')
     */
    public function modalAction($params = '')
    {        
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
    }
    
    /**
     * Redirect to the modal screen after action success
     * @return type
     */
    private function redirectAfterSuccess()
    {        
        return function() {            
            $this->response->redirect(array(
                'for'    => 'admin/component', 
                'action' => 'modal', 
            ));
        };
    }
    
    /**
     * Create the form with the component specific fields
     * @return type
     */
    private function createComponentForm()
    {
        return function() {
            if(!$this->view->record) {
                $this->view->record = $this->scaffolding->doRead($this->router->getParams()[0]);
            }
            $form = $this->di->get('componentManager')
                             ->createForm($this->view->record);
            $this->scaffolding->setForm($form);
        };
    } 
    
}
