<?php
/**
 * This file is part of Vegas package
 *
 * @author Slawomir Zytko <slawomir.zytko@gmail.com>
 * @copyright Amsterdam Standard Sp. Z o.o.
 * @homepage http://vegas-cmf.github.io
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Oauth\Controllers\Frontend;
use User\Services\Exception\SignUpFailedException;
use Vegas\Security\Authentication\Exception\IdentityNotFoundException;
use Vegas\Security\OAuth\Exception\FailedAuthorizationException;

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

        try {
            $oauth->authorize($serviceName);
        } catch(FailedAuthorizationException $ex) {
            $this->flashSession->message('error', $ex->getMessage());
        }

        try {
            $identity = $oauth->getIdentity($serviceName);
            $oauth->authenticate($identity);

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
 
