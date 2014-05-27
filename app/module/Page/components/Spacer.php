<?php

namespace Page\Components;

use Vegas\DI\Service\ComponentAbstract;

/** 
 * @name Spacer
 * @image http://thrivingsites.com/wp-content/uploads/2012/06/wysiwyg-small.jpg
 */
class Spacer extends ComponentAbstract {
    
    protected function setUp($params = array())
    {
        return $params;
    }
        
    public function getElements()
    {
        $source = new \Phalcon\Forms\Element\Text('size');
        $source->addValidator(new \Phalcon\Validation\Validator\PresenceOf());
        $source->setLabel('How high?');        
        return array($source);        
    }
}