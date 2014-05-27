<?php
/**
 * This file is part of Vegas package
 *
 * @author Adrian Malik <adrian.malik.89@gmail.com>
 * @copyright Amsterdam Standard Sp. Z o.o.
 * @homepage https://bitbucket.org/amsdard/vegas-phalcon
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Page\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Textarea;
    
class Page extends Form
{
    /**
     * Initializes backend form of pages
     */
    public function initialize()
    {
        $name = new Text('name');
        $name->setAttribute('placeholder', 'Name');
        $this->add($name);
        
        $title = new Text('title');
        $title->setAttribute('placeholder', 'Title');
        $this->add($title);
        
        $description = new Textarea('description');
        $description->setAttribute('placeholder', 'Description');
        $this->add($description);
        
        $keywords = new Textarea('keywords');
        $keywords->setAttribute('placeholder', 'Keywords');
        $this->add($keywords);
        
    }
}