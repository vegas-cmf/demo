<?php
/**
 * This file is part of Vegas package
 *
 * @author Slawomir Zytko <slawomir.zytko@gmail.com>
 * @copyright Amsterdam Standard Sp. Z o.o.
 * @homepage https://bitbucket.org/amsdard/vegas-phalcon
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
 
namespace Home\Controllers\Frontend;

use Vegas\Mvc\Controller\ControllerAbstract;

/**
 * Class HomeController
 * @package Home\Controllers\Frontend
 */
class HomeController extends ControllerAbstract
{
    public function indexAction()
    {
        if ($this->di->get('auth')->isAuthenticated()) {
            $identity = $this->di->get('auth')->getIdentity();

            $this->view->identity = $identity;
        }
    }
} 