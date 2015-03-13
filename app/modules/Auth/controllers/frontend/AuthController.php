<?php
/**
 * This file is part of Vegas package
 *
 * @author Slawomir Zytko <slawek@amsterdam-standard.pl>
 * @copyright Amsterdam Standard Sp. Z o.o.
 * @homepage http://vegas-cmf.github.io
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Auth\Controllers\Frontend;
use Vegas\Mvc\Controller\ControllerAbstract;
use Vegas\Security\Authentication\Exception;

/**
 * Class AuthController
 * @package Auth\Controllers\Frontend
 */
class AuthController extends ControllerAbstract
{

    /**
     * @return \Phalcon\Http\ResponseInterface
     */
    public function loginAction()
    {
        $this->service = $this->serviceManager->getService('auth:auth');
        if ($this->di->get('auth')->isAuthenticated()) {
            return $this->response->redirect(['for' => 'root']);
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
            } catch (Exception $ex) {
                $this->flash->error($this->i18n->_($ex->getMessage()));
            }
        }
    }

    /**
     * @return \Phalcon\Http\ResponseInterface
     */
    public function logoutAction()
    {
        $this->view->disable();

        $authService = $this->serviceManager->getService('auth:auth');
        $authService->logout();
        return $this->response->redirect(['for' => 'login']);
    }
}
 
