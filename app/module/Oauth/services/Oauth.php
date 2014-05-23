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

use User\Models\User;
use User\Services\Exception\SignUpFailedException;
use Vegas\Security\Authentication\Exception\IdentityNotFoundException;
use Vegas\Security\Authentication\Identity as AuthIdentity;
use Vegas\Security\OAuth\Exception\ServiceNotFoundException;
use Vegas\Security\OAuth\Identity;
use Vegas\Security\OAuth\Identity as OAuthIdentity;
use Vegas\Security\OAuth\ServiceAbstract;

/**
 * Class Oauth
 * @package Oauth\Services
 */
class Oauth implements \Phalcon\DI\InjectionAwareInterface
{
    use \Vegas\DI\InjectionAwareTrait;

    /**
     * @var array
     */
    protected $config = array();

    /**
     * @var array
     */
    protected $oAuthServices = array();

    /**
     * @var null
     */
    protected $oAuth = null;

    /**
     * Initializes service from provided configuration
     *
     * @param null $config
     * @return $this
     */
    public function initialize($config = null)
    {
        if (null == $config) {
            $this->config = $this->getDI()->get('config')->oauth->toArray();
        } else {
            $this->config = $config;
        }
        $this->setupServices();

        return $this;
    }

    /**
     * Setups oAuth services from configuration
     */
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
     * Returns the instance of indicated service
     *
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

    /**
     * Returns the prepared authorization uri to indicated oAuth Service
     *
     * @param $serviceName
     * @return mixed
     */
    public function getAuthorizationUri($serviceName)
    {
        $service = $this->getService($serviceName);
        return $service->getAuthorizationUri();
    }

    /**
     * Authorizes
     *
     * @param $serviceName
     * @return \OAuth\Common\Http\Uri\UriInterface|string
     */
    public function authorize($serviceName)
    {
        $service = $this->getService($serviceName);
        return $service->authorize();
    }

    /**
     * Remove session for indicated service
     *
     * @param null $serviceName
     */
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

    /**
     * Returns identity with accessToken for indicated service
     *
     * @param $serviceName
     * @return mixed
     */
    public function getIdentity($serviceName)
    {
        $service = $this->getService($serviceName);
        $identity = $service->getIdentity();
        $identity->accessToken = $service->getAccessToken();

        return $identity;
    }

    /**
     * Authenticates authorized user
     *
     * @param Identity $oauthIdentity
     * @throws \User\Services\Exception\SignUpFailedException
     */
    public function authenticate(Identity $oauthIdentity)
    {
        $auth = $this->di->get('serviceManager')->getService('auth:auth');
        try {
            $authIdentity = $auth->authenticateByEmail($oauthIdentity->getEmail());
        } catch (IdentityNotFoundException $ex) {
            $userService = $this->di->get('serviceManager')->getService('user:user');
            $userModel = new User();

            //store identity values without id, service and accessToken
            $identityValues = $oauthIdentity->toArray();
            unset($identityValues['id']);
            unset($identityValues['service']);
            unset($identityValues['accessToken']);
            $userModel->writeAttributes($identityValues);

            //try to create new account
            if (!$userService->create($userModel)) {
                throw new SignUpFailedException();
            }

            $authIdentity = $auth->authenticateByEmail($oauthIdentity->getEmail());
        }
        $this->afterAuthentication($authIdentity, $oauthIdentity);
    }

    /**
     * Adds oAuth identity for authenticated user
     *
     * @param AuthIdentity $authIdentity
     * @param Identity $oauthIdentity
     */
    private function afterAuthentication(AuthIdentity $authIdentity, OAuthIdentity $oauthIdentity)
    {
        \Oauth\Models\Identity::addUserIdentity($authIdentity->getId(), $oauthIdentity);
    }
}
