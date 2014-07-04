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

namespace Vegas\Page\Component;

use Page\Models\Component;

class Manager {
    
    /**
     * Update the position of a given component
     * @param string $id
     * @param string $level
     * @param int $position
     * @param int $rank
     */
    public function updatePosition($id, $level, $position, $rank)
    {
        $component = Component::findById($id);
        if($component) {
            $component->level    = $level;
            $component->position = $position;
            $component->rank     = $rank;
            $component->save(false);
        }
    }
    
    /**
     * Paste a component (move or copy)
     * @param string $cookie
     * @param array $query
     * @return boolean
     */
    public function paste($cookie, $query) {          
        $parts     = explode(':',$cookie);
        $action    = $parts[0];
        $component = Component::findById($parts[1]);        
        if($action == 'cut') {
            setcookie('component',null,0,'/');            
            return $this->move($component, $query);
        } elseif($action == 'copy') {
            return $this->copy($component, $query);
        }        
        return false;
    }
    
    /**
     * 
     * @param \Phalcon\HTTP\RequestInterface $request
     * @return type
     */
    public function getRestrictions(\Phalcon\HTTP\RequestInterface $request)
    {
        $restrictions = $request->getQuery("settings");
        return array(
            'allowed' => isset($restrictions['allowed']) ? explode(',', $restrictions['allowed']) : array(),
            'blocked' => isset($restrictions['blocked']) ? explode(',', $restrictions['blocked']) : array(),
        );
    }
    
    /**
     * 
     * @param \Phalcon\HTTP\RequestInterface $request
     * @return type
     */
    public function parseQuery(\Phalcon\HTTP\RequestInterface $request)
    {
        return array(
            'page_id'  => $request->getQuery("page_id",  "string"), // 1 page
            'level'    => $request->getQuery("level",    "string"), // 2 layout or page
            'position' => $request->getQuery("position", "int"),    // 2 number of the component list
            'before'   => $request->getQuery("before",   "string"), // 3 above or below component
            'after'    => $request->getQuery("after",    "string"), // 3 above or below component
        );  
    }
        
    /**
     * Move a component to a different level, page and/or position
     * @param \Component\Models\Component $component
     * @return \Component\Models\Component
     */
    private function move(Component $component, $query) {
        $component->level    = $query['level'];
        $component->page_id  = new \MongoId($query['page_id']);
        $component->position = (int)$query['position'];
        $component->save(false);
        return $component;
    }
    
    /**
     * Copy a component for position on a different page or position
     * @param \Component\Models\Component $original
     * @return \Component\Models\Component
     */
    private function copy(Component $original, $query) {
              
        // create static component
        $component = Component::createStatic($original->module . ':' . $original->class, $query);
        
        // copy parameters from the original component
        $component->params = $original->params;
        $component->save(false);        
        
        return $component;
    }
    
    /**
     * 
     * @param type $record
     * @return \Page\Forms\Component
     */
    public function createForm($record)
    {
        $component = $record->getComponent();                  
        $form = new \Page\Forms\Component();
        foreach($component->getElements() as $element) {
            $element->setDefault($record->getParam($element->getName()));
            $element->setName('params_' . $element->getName());
            $form->add($element);
        }
        return $form;
    }
    
}