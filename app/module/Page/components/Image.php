<?php

namespace Page\Components;

use Vegas\DI\Service\ComponentAbstract;

/** 
 * @name Image
 * @image http://img2.wikia.nocookie.net/__cb20130320065142/commando2/images/thumb/7/7b/Tank_Commando_2_Shape_3307.png/200px-22,1261,0,619-Tank_Commando_2_Shape_3307.png
 */
class Image extends ComponentAbstract {
    
    protected function setUp($params = array())
    {
        return $params;
    }
    
    public function getElements()
    {
        $source = new \Phalcon\Forms\Element\Text('source');
        $source->addValidator(new \Phalcon\Validation\Validator\PresenceOf());
        $source->setLabel('Source');        
        return array($source);
    }
    
}