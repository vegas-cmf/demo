<?php
/**
 * This file is part of Vegas package
 *
 * @author Frank Broersen <frank@pitgroup.nl>
 * @copyright Amsterdam Standard Sp. Z o.o.
 * @homepage http://vegas-cmf.github.io
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
 
namespace Component\Forms;

use Phalcon\Forms\Element\Hidden;
use Vegas\Forms\Form;

class Select extends Form
{
    public function initialize()
    {
        $class = new Hidden('class');
        $this->add($class);
        
        $module = new Hidden('module');
        $this->add($module);
        
        $level = new Hidden('level');
        $this->add($level);
        
        $page_id = new Hidden('page_id');
        $this->add($page_id);
        
        $page_id = new Hidden('position');
        $this->add($page_id);
        
    }
}