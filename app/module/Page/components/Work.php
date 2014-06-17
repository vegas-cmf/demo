<?php

namespace Page\Components;

use Vegas\DI\Service\ComponentAbstract;

/** 
 * @name Work
 * @image http://img2.wikia.nocookie.net/__cb20130320065142/commando2/images/thumb/7/7b/Tank_Commando_2_Shape_3307.png/200px-22,1261,0,619-Tank_Commando_2_Shape_3307.png
 */
class Work extends ComponentAbstract {
    
    protected function setUp($params = array())
    {
        return $params;
    }
    
    public function getElements()
    {
        $title = new \Phalcon\Forms\Element\Text('title');
        $title->addValidator(new \Vegas\Validation\Validator\PresenceOf());
        $title->setLabel('Title');  
        
        $description = new \Phalcon\Forms\Element\Textarea('description');
        $description->addValidator(new \Vegas\Validation\Validator\PresenceOf());
        $description->setLabel('Description'); 
        
        $image = new \Phalcon\Forms\Element\Text('image');
        $image->addValidator(new \Vegas\Validation\Validator\PresenceOf());
        $image->setLabel('Image');   
        
        $position = new \Phalcon\Forms\Element\Select('position');
        $position->addValidator(new \Vegas\Validation\Validator\PresenceOf());
        $position->setLabel('Image position'); 
        $position->setOptions(array(
            'left'   => 'Left',
            'right'  => 'Right',
        ));
        return array($title,$description,$image,$position);
    }
    
}