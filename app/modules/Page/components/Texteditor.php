<?php

namespace Page\Components;

use Vegas\DI\Service\ComponentAbstract;

/** 
 * @name Texteditor
 * @image http://thrivingsites.com/wp-content/uploads/2012/06/wysiwyg-small.jpg
 */
class Texteditor extends ComponentAbstract {
    
    protected function setUp($params = array())
    {
        return $params;
    }
        
    public function getElements()
    {
        $source = new \Phalcon\Forms\Element\Textarea('text');
        $source->addValidator(new \Vegas\Validation\Validator\PresenceOf());
        $source->setLabel('Contents');        
        return array($source);        
    }
}