<?php
/**
 * This file is part of Vegas package
 *
 * @author Slawomir Zytko <slawek@amsterdam-standard.pl>
 * @copyright Amsterdam Standard Sp. Z o.o.
 * @homepage https://github.com/vegas-cmf
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
 
namespace Crud\Forms;

use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Vegas\Forms\Element\Select;
use Vegas\Forms\Form;
use Vegas\Validation\Validator\PresenceOf;

class Article extends Form
{
    /**
     * Initializes backend form of pages
     */
    public function initialize()
    {
        $lang = new Select('lang', $this->di->get('config')->application->langs->toArray());
        $lang->setLabel('Language');
        $this->add($lang);

        $title = new Text('title');
        $title->setLabel('Title');
        $title->addValidator(new PresenceOf());
        $title->setAttribute('placeholder', 'Title');
        $this->add($title);

        $content = new Textarea('content');
        $content->setLabel('Content');
        $content->addValidator(new PresenceOf());
        $content->setAttribute('placeholder', 'content');
        $this->add($content);

    }
} 