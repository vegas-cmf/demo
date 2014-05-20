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
use Vegas\Security\OAuth\Adapter\Linkedin;

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

    private function initLinkedin()
    {
        $oauth = new \Vegas\Security\OAuth($this->di);
        $oauth->setAdapter('linkedin');
        $oauth->setupCredentials(array(
            'key'   =>  '77vrwtb3qaiq8y',
            'secret'    =>  'xRFH1mvEwQez6Uvm',
            'redirect_uri'  =>  $this->router->getRouteByName('linkedin')->getCompiledPattern()
        ));
        $oauth->addScope(Linkedin::SCOPE_FULL_PROFILE);
        $oauth->init();
        return $oauth;
    }

    public function oauthAction()
    {
        $linkedinOAuth = $this->initLinkedin();
        $this->view->linkedinUri = $linkedinOAuth->getAuthorizationUri();

        $this->view->isAuthenticated = $linkedinOAuth->isAuthenticated();
        try {
            if ($linkedinOAuth->isAuthenticated()) {
                $response = $linkedinOAuth->request('/people/~?format=json');
                $this->view->firstName = $response['firstName'];
                $this->view->lastName = $response['lastName'];
            }
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function linkedinAction()
    {
        $linkedinOAuth = $this->initLinkedin();
        $token = $linkedinOAuth->authenticate();

        $this->response->redirect('oauth');
    }

    public function logoutAction()
    {
        $linkedinOAuth = $this->initLinkedin();
        $linkedinOAuth->destroy();
    }
} 