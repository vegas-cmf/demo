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
namespace Auth\Controllers\Frontend;
use Vegas\Security\OAuth\Exception\ServiceNotFoundException;

/**
 * Class AuthController
 *
 * @ACL(name='mvc:auth:Frontend\Auth', description='Authentication')
 * @package Auth\Controllers\Frontend
 */
class AuthController extends \Vegas\Mvc\Controller\ControllerAbstract
{

    public function signupAction()
    {
        $this->view->setLayout('login');
        $this->view->setRenderLevel(\Vegas\Mvc\View::LEVEL_LAYOUT);
    }

    /**
     * @ACL(name='login', description='Login action')
     * @throws \Vegas\Security\Authentication\Exception\InvalidCredentialException
     * @return \Phalcon\Http\Response|\Phalcon\Http\ResponseInterface
     */
    public function loginAction()
    {
        $this->view->setLayout('login');
        $this->view->setRenderLevel(\Vegas\Mvc\View::LEVEL_LAYOUT);

        $this->service = $this->serviceManager->getService('auth:auth');
        if ($this->di->get('auth')->isAuthenticated()) {
            return $this->response->redirect(array('for' => 'root'));
        }
        //oauth
        $oAuth = $this->serviceManager->getService('oauth:oauth');
        $oAuth->initialize();

        $this->view->linkedinUri = $oAuth->getAuthorizationUri('linkedin');
        $this->view->facebookUri = $oAuth->getAuthorizationUri('facebook');
        $this->view->googleUri = $oAuth->getAuthorizationUri('google');

        if ($this->request->isPost()) {
            try {
                $email = $this->request->getPost('email');
                $password = $this->request->getPost('password');
                $this->service->login($email, $password);

                $redirectUrl = '';
                if ($this->session->has('redirect_url')) {
                    $redirectUrl = ltrim($this->session->get('redirect_url'), '/');
                }

                $this->session->remove('redirect_url');
                return $this->response->redirect($redirectUrl);
            } catch (\Vegas\Security\Authentication\Exception $ex) {
                $this->flash->error($this->i18n->_($ex->getMessage()));
            }
        }
    }

    /**
     * @ACL(name='logout', description='Logout action')
     * @return \Phalcon\Http\Response|\Phalcon\Http\ResponseInterface
     */
    public function logoutAction()
    {
        $this->view->disable();

        $authService = $this->serviceManager->getService('auth:auth');
        $authService->logout();
        return $this->response->redirect(array('for' => 'login'));
    }
}
 
