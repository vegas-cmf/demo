<?php

namespace Page\Components;

use Vegas\DI\Service\ComponentAbstract;

/** 
 * @name Youtube embed
 * @image http://www.iriscorporation.biz/images/links/youtube.jpg
 */
class Youtube extends ComponentAbstract {
    
    protected function setUp($params = array())
    {
        if(strstr($params['code'],'http')) {
            if(strstr($params['code'],'?v=')) {
                $parts = explode('?v=',$params['code']);
                $params['code'] = $parts[1];
            } elseif(substr($params['code'],0,16) == 'http://youtu.be/') {
                $params['code'] = substr($params['code'],16);
            }
            if(strpos($params['code'],'&') > -1) {
                $params['code'] = substr($params['code'],0,strpos($params['code'],'&'));
            }
        }
        
        return $params;
    }
        
    public function getElements()
    {
        $code = new \Phalcon\Forms\Element\Text('code');
        $code->addValidator(new \Phalcon\Validation\Validator\PresenceOf());
        $code->setLabel('Youtube url or code');        
        $code->setAttribute('placeholder','http://www.youtube.com/watch?v=sEW-Qb2qqA8');
        
        $width = new \Phalcon\Forms\Element\Text('width');
        $width->addValidator(new \Phalcon\Validation\Validator\PresenceOf());
        $width->setLabel('Width');        
        $width->setAttribute('placeholder','560');
        $width->setAttribute('value','560');
        
        $height = new \Phalcon\Forms\Element\Text('height');
        $height->addValidator(new \Phalcon\Validation\Validator\PresenceOf());
        $height->setLabel('Height');        
        $height->setAttribute('placeholder','315');
        $height->setAttribute('value','315');
        
        return array($code, $width, $height);        
    }
}
    