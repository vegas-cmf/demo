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
namespace Page\Controllers\Backend\Component;

use \Vegas\Mvc\Controller;

use Page\Models\Preview,
    Page\Models\Component;

/**
 * Class ToolsController
 *
 * @ACL(name='mvc:component:Backend\Component', description='Component tools controller')
 *
 * @package Component\Controllers\Backend
 */
class ToolsController extends Controller\Crud
{
    protected $formName = 'Page\Forms\Component';
    protected $modelName = 'Page\Models\Component';

    public function initialize()
    {
        parent::initialize();
        
        // window reload via js
        $this->dispatcher->getEventsManager()->attach(Controller\Crud\Events::AFTER_CREATE, $this->redirectAfterSuccess());
        $this->dispatcher->getEventsManager()->attach(Controller\Crud\Events::AFTER_UPDATE, $this->redirectAfterSuccess()); 
        $this->dispatcher->getEventsManager()->attach(Controller\Crud\Events::AFTER_DELETE, $this->redirectAfterSuccess());
        
        // we view this in the modal layout
        $this->view->setLayout('modal');
    }
    
    /**
     * Display the "select a component to insert" screen
     * @ACL(name='select', description='Select component type')
     */
    public function selectAction($params = '')
    {
        // if we have parameters, it means that the user has selected a component
        if( ! empty($params)) {
            $component = Component::createStatic($params,$this->parseQuery());
            $this->response->redirect(array(
                'for'    => 'admin/component', 
                'action' => 'edit', 
                'params' => $component->_id
            ));
        }
        
        $restrictions = $this->di->get('componentManager')
                                 ->getRestrictions($this->request);
        
        $criteria = array();
        if($restrictions['blocked']) {
            $criteria = array('conditions' => array(
                'name' => array('$nin' => $restrictions['blocked'])
            ));
        }
        $this->view->previews   = Preview::find($criteria);
        
        // advice to use specific components
        $this->view->allowed    = $restrictions['allowed'];
                 
        // extra parameters for better user experience
        $this->view->paste      = isset($_COOKIE['component']) ? $_COOKIE['component'] : false;
        $this->view->query      = http_build_query($this->parseQuery());   
        
        // this forces the view to display a javascript click to directly paste
        if($this->view->paste && $this->request->getQuery("paste")) {            
            $this->view->triggerPaste = true;
        }
    }
    
    /**
     * Update the position of an array of components
     * @ACL(name='position', description='Store positions of components after dragging')
     */
    public function positionAction()
    {
        if(is_array($this->request->getPost('ids'))) {
            $level    = (string) $this->request->getPost("level");
            $position = (int)    $this->request->getPost("position");
            $manager  = $this->di->get('componentManager');
            foreach($this->request->getPost('ids') as $rank => $id) {
                $manager->updatePosition($id, $level, $position, $rank);
            }
        }
                
        $this->view->disable();
    }
        
    /**
     * Paste a component either from copy, or cut
     * @ACL(name='paste', description='Paste components')
     */
    public function pasteAction()
    {      
        $cookie  = isset($_COOKIE['component']) ? $_COOKIE['component'] : false;        
        if($cookie) {            
            $component = $this->di->get('componentManager')->paste($cookie, $this->parseQuery());            
            $this->response->redirect(array(
                'for'    => 'admin/component', 
                'action' => 'modal', 
                'params' => $component->_id
            ));            
        }
    }
    
    /**
     * Scan all the modules for components, and create previews     * 
     * @ACL(name='scan', description='Scan for components')
     */
    public function scanAction()
    {
        $path    = $this->di->get('config')->application->moduleDir;
        $pattern = '*/components/*.php';
        
        $this->di->get('previewManager')
                 ->scan($path, $pattern);
        
        // redirect to the select page
        $this->response->redirect(array(
            'for'    => 'admin/component', 
            'action' => 'select'
        ));
    }
    
    /**
     * Get the query parameters for manipulating the component
     * @return array
     */
    private function parseQuery()
    {
        return $this->di->get('componentManager')
                        ->parseQuery($this->request);
    }
    
    /**
     * Redirect user after success
     * @return redirect method
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
    
}
