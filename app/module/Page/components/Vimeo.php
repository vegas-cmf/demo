<?php

namespace Page\Components;

use Vegas\DI\Service\ComponentAbstract;

/** 
 * @name Vimeo embed
 * @image http://www.148apps.com/wp-content/uploads/2011/04/vimeo-logo-300x205.png
 */
class Vimeo extends ComponentAbstract {
    
    protected function setUp($params = array())
    {
        if(strstr($params['code'],'vimeo.com/')) {
            $parts = explode('vimeo.com/',$params['code']);
            $params['code'] = $parts[1];
        }
        
        return $params;
    }
        
    public function getElements()
    {
        $code = new \Phalcon\Forms\Element\Text('code');
        $code->addValidator(new \Phalcon\Validation\Validator\PresenceOf());
        $code->setLabel('Vimeo url or code');        
        $code->setAttribute('placeholder','http://vimeo.com/92179785');
        
        $width = new \Phalcon\Forms\Element\Text('width');
        $width->addValidator(new \Phalcon\Validation\Validator\PresenceOf());
        $width->setLabel('Width');        
        $width->setAttribute('placeholder','500');
        $width->setAttribute('value','500');
        
        $height = new \Phalcon\Forms\Element\Text('height');
        $height->addValidator(new \Phalcon\Validation\Validator\PresenceOf());
        $height->setLabel('Height');        
        $height->setAttribute('placeholder','281');
        $height->setAttribute('value','281');
        
        return array($code, $width, $height);        
    }
}
    