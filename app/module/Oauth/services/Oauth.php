<?php
/**
 * This file is part of Vegas package
 *
 * @author Jaroslaw <Macko>
 * @copyright Amsterdam Standard Sp. Z o.o.
 * @homepage https://bitbucket.org/amsdard/vegas-phalcon
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Oauth\Services;

use Phalcon\DiInterface;
use Vegas\Security\Authentication\Exception\IdentityNotFoundException;
use Vegas\Security\Authentication\Identity;
use Vegas\Security\OAuth\Exception\ServiceNotFoundException;
use Vegas\Security\OAuth\ServiceAbstract;

class Oauth implements \Phalcon\DI\InjectionAwareInterface
{
    use \Vegas\DI\InjectionAwareTrait;

    protected $config = array();

    protected $oAuthServices = array();

    protected $oAuth = null;

    public function initialize()
    {
        $this->config = $this->getDI()->get('config')->oauth->toArray();
        $this->setupServices();
    }

    protected function setupServices()
    {
        $this->oAuth = new \Vegas\Security\OAuth($this->di);
        foreach ($this->config as $serviceName => $serviceConfig) {
            $service = $this->oAuth->obtainServiceInstance($serviceName);

            $service->setupCredentials(array(
                'key'   =>  $serviceConfig['key'],
                'secret'    =>  $serviceConfig['secret'],
                'redirect_uri'  =>  $serviceConfig['redirect_uri']
            ));
            if (isset($serviceConfig['scopes'])) {
                $service->setScopes($serviceConfig['scopes']);
            }
            $service->init();
            $this->oAuthServices[$serviceName] = $service;
        }
    }

    /**
     * @param $serviceName
     * @return ServiceAbstract
     * @throws \Vegas\Security\OAuth\Exception\ServiceNotFoundException
     */
    protected function getService($serviceName)
    {
        if (!isset($this->oAuthServices[$serviceName])) {
            throw new ServiceNotFoundException($serviceName);
        }

        return $this->oAuthServices[$serviceName];
    }

    public function getAuthorizationUri($serviceName)
    {
        $service = $this->getService($serviceName);

        return $service->getAuthorizationUri();
    }

    public function authorize($serviceName)
    {
        $service = $this->getService($serviceName);

        return $service->authorize();
    }

    public function logout($serviceName = null)
    {
        if (null == $serviceName) {
            foreach ($this->oAuthServices as $service) {
                $service = $this->getService($service);
                $service->destroySession();
            }
        } else {
            $service = $this->getService($serviceName);
            $service->destroySession();
        }
    }

    public function getIdentity($serviceName)
    {
        $service = $this->getService($serviceName);
        return $service->getIdentity();
    }

    public function authenticate(Identity $identity)
    {
        try {
            $auth = $this->di->getService('auth:auth');
            $auth->authenticateByEmail($identity->getEmail());
        } catch (IdentityNotFoundException $ex) {

        }
    }
}
