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
use User\Services\Exception\SignUpFailedException;
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
        try {
            $oauth->authenticate($serviceName, $token, $identity);
            return $this->response->redirect(array('for' => 'root'))->send();

        } catch (IdentityNotFoundException $ex) {
            $this->flashSession->message('error', $ex->getMessage());
        } catch (SignUpFailedException $ex) {
            $this->flashSession->message('error', $ex->getMessage());
        } catch (\Exception $ex) {
            $this->flashSession->message('error', $ex->getMessage());
        }

        return $this->response->redirect(array('for' => 'login'))->send();
    }
}
 
