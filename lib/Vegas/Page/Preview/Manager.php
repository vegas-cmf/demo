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

namespace Vegas\Page\Preview;

use Page\Models\Preview;

class Manager {
    
    /**
     * Scane the given path for modules 
     * @param type $path
     * @param type $pattern
     */
    public function scan($path, $pattern)
    {
        $paths  = glob($path . $pattern);        
        foreach($paths as $path) {
            list($module, $class) = $this->parse($path);
            if(!$this->find($module, $class)) {
                $this->create($path, $module, $class);
            }
        }
    }
    
    /**
     * Create the preview based on the meta info in the file
     * @param type $path
     * @param type $module
     * @param type $class
     */
    private function create($path, $module, $class) {
        
        // include the component file
        require_once $path;

        // parse info from the file
        list($name, $image) = $this->getMeta($module, $class);

        // create the preview and store it in the database
        $preview = new Preview();
        $preview->module = $module;
        $preview->class  = $class;
        $preview->name  = $name;
        $preview->image = $image;
        $preview->save();
    }
    
    /**
     * Get Meta information by reading the docs in the component
     * @param string $module
     * @param string $class
     * @return array array($name,$image)
     */
    private function getMeta($module, $class)
    {
        $object = new \ReflectionClass("\\$module\\components\\$class");
        $docs   = $object->getDocComment();

        // find name in docs
        if( preg_match_all('/.?(@name)(\\s+)((?:[a-z][a-z0-9_]*))/is', $docs, $matches) ) {
            $name = trim( end($matches)[0] );
        } else {
            $name = $class;
        }

        // find image in docs
        if( preg_match_all('/.*?(@image)(\\s+)((?:http|https)(?::\\/{2}[\\w]+)(?:[\\/|\\.]?)(?:[^\\s"]*))/is', $docs, $matches) ) {
            $image = trim( end($matches)[0] );
        } else {
            $image = '';
        }
        
        return array($name, $image);
    }
    
    /**
     * Find a preview by module ans class
     * @param type $module
     * @param type $class
     * @return type
     */
    private function find($module, $class) {
        return Preview::findFirst(array(array(
            'module' => $module,
            'class'  => $class,
        )));
    }
    
    /**
     * Parse a path into a module and class
     * @param type $path
     * @return type
     */
    private function parse($path) {
        $parts  = explode('/',$path);
        $class  = str_replace('.php','',end($parts));
        $module = array_slice($parts,-3,1)[0];        
        return array($module, $class);
    }
    
}