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
            $component = Component::createStatic($params,$this->getComponentQuery());
            $this->response->redirect(array(
                'for'    => 'admin/component', 
                'action' => 'edit', 
                'params' => $component->_id
            ));
        }
        
        // Parse blocked components from the uri, and fetch previews
        $settings = $this->parseRestrictionsFromUrl();
        $criteria = array();
        if($settings['blocked']) {
            $criteria = array('conditions' => array(
                'name' => array('$nin' => $settings['blocked'])
            ));
        }
        $this->view->previews = Preview::find($criteria);
        
        // advice to use specific components
        $this->view->allowed = $settings['allowed'];
                 
        // extra parameters for better user experience
        $this->view->paste      = isset($_COOKIE['component']) ? $_COOKIE['component'] : false;
        $this->view->query      = http_build_query($this->getComponentQuery());   
        
        // this forces the view to display a javascript click to directly paste
        if($this->view->paste && isset($_GET['paste'])) {            
            $this->view->triggerPaste = true;
        }
    }
    
    /**
     * Update the position of a list of components
     * @ACL(name='position', description='Store positions of components after dragging')
     */
    public function positionAction()
    {
        $level    = (string)$this->request->getPost("level");
        $position = (int)$this->request->getPost("position");
        
        foreach($this->request->getPost('ids') as $rank => $id) {
            $component = $this->scaffolding->doRead($id);
            $component->level    = $level;
            $component->position = $position;
            $component->rank     = $rank;
            $component->save();
        }
        
        die('OK');
    }
        
    /**
     * Paste a component either from copy, or cut
     * @ACL(name='paste', description='Paste components')
     */
    public function pasteAction()
    {
        $cookie = isset($_COOKIE['component']) ? $_COOKIE['component'] : false;
        if($cookie) {
            
            // extract the component and the action from the cookie
            $parts     = explode(':',$cookie);
            $action    = $parts[0];
            $component = $this->scaffolding->doRead($parts[1]);   
            
            if($action == 'cut') {
                
                // cut / paste equals to moving the component around
                $component = $this->move($component);
                setcookie('component',null,0,'/');
                
            } elseif($action == 'copy') {
                
                $component = $this->copy($component);
                
            }
        }
        
        // 
        $this->response->redirect(array(
            'for'    => 'admin/component', 
            'action' => 'modal', 
            'params' => $component->_id
        ));
    }
    
    /**
     * Scan all the modules for components, and create previews     * 
     * @ACL(name='scan', description='Scan for components')
     */
    public function scanAction()
    {
        // get the module path, and create the pattern to scan for components
        $modulePath  = $this->di->get('config')->application->moduleDir;
        $scanPattern = '*/components/*.php';
        
        // we glob the path with the pattern, and 
        $components  = glob($modulePath . $scanPattern);        
        foreach($components as $path) {            
            $this->fileToComponentPreview($path);            
        }
        
        // redirect to the select page
        $this->response->redirect(array(
            'for'    => 'admin/component', 
            'action' => 'select'
        ));
    }
    
    /**
     * Using the path we get from the scanning of the modules, create a new 
     * component preview, if there is not already on existing.
     * 
     * A typical path would be:
     * /app/module/Page/components/Image.php
     * 
     * The path will be split, to get the module and the class name of the 
     * component, e.g.
     * Module:    Page
     * Component: Image
     * 
     * @param string $path
     */
    private function fileToComponentPreview($path)
    {
        // figure out what class and module this component is in
        $parts  = explode('/',$path);
        $class  = str_replace('.php','',end($parts));
        $module = array_slice($parts,-3,1)[0];
        
        // find component meta / create it if it doesnt exist
        $preview = Preview::findFirst(array(array(
            'module' => $module,
            'class'  => $class,
        )));
        
        // if we do not have it in our database, create it
        if( ! $preview ) {
            
            // include the component file
            require_once $path;
            
            // prepare the classname
            $fullclass = "\\$module\\components\\$class";
            
            // create the reflection class so we can read the documentation
            $object = new \ReflectionClass($fullclass);
            $docs   = $object->getDocComment();
            
            // default name & image
            $name  = $class;
            $image = '';
            
            // find name in docs
            $regex = '/.?(@name)(\\s+)((?:[a-z][a-z0-9_]*))/is';
            if( preg_match_all($regex,$docs,$matches) ) {
                $name = trim( end($matches)[0] );
            }
            
            // find image in docs
            $regex = '/.*?(@image)(\\s+)((?:http|https)(?::\\/{2}[\\w]+)(?:[\\/|\\.]?)(?:[^\\s"]*))/is';
            if( preg_match_all($regex,$docs,$matches) ) {
                $image = trim( end($matches)[0] );
            }
            
            // create the preview and store it in the database
            $preview = new Preview();
            $preview->class = $class;
            $preview->module = $module;
            $preview->name  = $name;
            $preview->image = $image;
            $preview->save();
        }
        
    }
    
    /**
     * When selecting a component, there can be restrictions, either by allowing
     * a specific (set of) component(s), by blocking a (set of) component(s)
     * @return array
     */
    private function parseRestrictionsFromUrl()
    {
        $raw = isset($_GET['settings']) ? $_GET['settings'] : false;
        return array(
            'allowed' => isset($raw['allowed']) ? explode(',',$raw['allowed']) : array(),
            'blocked' => isset($raw['blocked']) ? explode(',',$raw['blocked']) : array(),
        );
    }
    
    /**
     * Get the query parameters for manipulating the component
     * @return array
     */
    private function getComponentQuery()
    {
        return array(
            'page_id'  => $this->request->getQuery("page_id",  "string"), // 1 page
            'level'    => $this->request->getQuery("level",    "string"), // 2 layout or page
            'position' => $this->request->getQuery("position", "int"),    // 2 number of the component list
            'before'   => $this->request->getQuery("before",   "string"), // 3 above or below component
            'after'    => $this->request->getQuery("after",    "string"), // 3 above or below component
        );  
    }
        
    /**
     * Move a component to a different level, page and/or position
     * @param \Component\Models\Component $component
     * @return \Component\Models\Component
     */
    private function move(Component $component) {
        $query = $this->getComponentQuery();
        $component->level    = $query['level'];
        $component->page_id  = new \MongoId($query['page_id']);
        $component->position = (int)$query['position'];
        $component->save();
        return $component;
    }
    
    /**
     * Copy a component for position on a different page or position
     * @param \Component\Models\Component $original
     * @return \Component\Models\Component
     */
    private function copy(Component $original) {
        // get parameters that will overwrite settings in the component that is copied
        $query = $this->getComponentQuery();       
               
        // create static component
        $component = Component::createStatic($original->module . ':' . $original->class, $query);
        
        // copy parameters from the original component
        $component->params = $original->params;
        $component->save();
        
        return $component;
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
