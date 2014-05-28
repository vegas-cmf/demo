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

class Component extends CollectionAbstract
{
    public $module;
    public $class;
    
    public $page_id;
    public $container_id;
    public $level;
    
    public $params = array();
    
    public function getSource()
    {
        return 'vegas_components';
    }
    
    public function save($parseParams = true)
    {
        if($parseParams) {
            $this->parseParams();
        }
        return parent::save();
    }
    
    private function parseParams()
    {
        $params = array();
        foreach($this as $var => $value) {            
            if(substr($var,0,7) == 'params_') {
                $params[substr($var,7)] = $value;
                unset($this->$var);
            }
        }
        $this->params = $params;
    }
    
    public static function createStatic($name,$params = array())
    {
        // module:class
        $parts = explode(':',$name);
        
        // create the component        
        $component = new self;
        $component->module   = $parts[0];
        $component->class    = $parts[1];
        $component->level    = $params['level'];
        $component->page_id  = new \MongoId($params['page_id']);
        $component->position = (int)$params['position'];
        
        // position the component (moves the other ones)
        if($params['before']) {
            $rank = $component->getRank('before', $params['before']);
        } elseif($params['after']) {
            $rank = $component->getRank('after', $params['after']);
        } else {
            $rank = 0;
        }
        
        // create the component
        $component->rank     = $rank;
        $component->save(false);
        
        return $component;        
    }
    
    protected function getRank($position, $id)
    {
        $components = Component::find(array(array(
            "page_id"   => $this->page_id,
            "level"     => $this->level,
            "position"  => $this->position,
        ),'sort' => array('rank' => 1)));
       
        $rank   = 0;
        $return = false;
        foreach($components as $i => $component) {
            if($component->_id == $id) {
                if($position == 'before') {
                    $return = $rank;
                    $rank++;
                    $component->rank = $rank;
                    $component->save();
                }
                if($position == 'after') {
                    $component->rank = $rank;
                    $component->save();
                    $rank++;
                    $return = $rank;
                }                
            } else {                
                $component->rank = $rank;
                $component->save();
            }
            $rank++;    
        }    
        return $return;
    }
    
    public function getParam($param,$default = null)
    {
        return isset($this->params[$param]) ? $this->params[$param] : $default;
    }
    
    public function getComponent()
    {
        $component = "\\$this->module\\Components\\$this->class";
        return new $component();
    }
    
    public static function findByPageAndLevel($pageId,$level)
    {
        return self::find(array(array(
            'page_id' => $pageId,
            'level'   => $level
        )));
    }
}
