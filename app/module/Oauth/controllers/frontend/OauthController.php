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
namespace Oauth\Controllers\Frontend;
use Vegas\Security\Authentication\Exception\IdentityNotFoundException;

/**
 * Class AuthController
 *
 * @ACL(name='mvc:auth:Frontend\Oauth', description='Open Authorization')
 * @package Oauth\Controllers\Frontend
 */
class OauthController extends \Vegas\Mvc\Controller\ControllerAbstract
{

    /**
     *
     */
    public function authorizeAction()
    {
        $this->view->disable();

        $serviceName = $this->dispatcher->getParam('service');
        $oauth = $this->serviceManager->getService('oauth:oauth');
        $oauth->initialize();

        $token = $oauth->authorize($serviceName);
        $identity = $oauth->getIdentity($serviceName);
        var_dump($identity);die;
        try {
            $oauth->authenticate($serviceName, $token, $identity);
        } catch (IdentityNotFoundException $ex) {

        }
        return $this->response->redirect('/');
    }
}
 
