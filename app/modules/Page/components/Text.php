<?php

namespace Page\Components;

use Vegas\DI\Service\ComponentAbstract;

/** 
 * @name Text
 * @image http://img2.wikia.nocookie.net/__cb20130320065142/commando2/images/thumb/7/7b/Tank_Commando_2_Shape_3307.png/200px-22,1261,0,619-Tank_Commando_2_Shape_3307.png
 */
class Text extends ComponentAbstract {
    
    protected function setUp($params = array())
    {
        return $params;
    }
    
    public function getElements()
    {
        $source = new \Phalcon\Forms\Element\Text('text');
        $source->addValidator(new \Vegas\Validation\Validator\PresenceOf());
        $source->setLabel('Text');   
        
        $type = new \Phalcon\Forms\Element\Select('type');
        $type->addValidator(new \Vegas\Validation\Validator\PresenceOf());
        $type->setLabel('type'); 
        $type->setOptions(array(
            'p'  => 'Paragraph',
            'h1' => 'Heading 1',
            'h2' => 'Heading 2',
            'h3' => 'Heading 3',
            'h4' => 'Heading 4',
            'h5' => 'Heading 5',
            'h6' => 'Heading 6',
        ));
        return array($source,$type);
    }
    
}