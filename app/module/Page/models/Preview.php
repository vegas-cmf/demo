<?php
/**
 * This file is part of Vegas package
 *
 * @author Frank Broersen <frank@pitgroup.nl>
 * @copyright Amsterdam Standard Sp. Z o.o.
 * @homepage https://bitbucket.org/amsdard/vegas-phalcon
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Page\Models;

use Vegas\Db\Decorator\CollectionAbstract;

class Preview extends CollectionAbstract
{
    public $module;
    public $class;
    
    public $name;
    public $image;
        
    public function getSource()
    {
        return 'vegas_previews';
    }
}
