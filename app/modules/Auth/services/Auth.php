<?php
/**
 * This file is part of Vegas package
 *
 * @author Jaroslaw <Macko>
 * @copyright Amsterdam Standard Sp. Z o.o.
 * @homepage http://vegas-cmf.github.io
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Auth\Services;

use Auth\Models\BaseUser;
use Phalcon\DI\InjectionAwareInterface;
use Vegas\DI\InjectionAwareTrait;
use Vegas\Security\Authentication;
use Vegas\Security\Authentication\Exception\IdentityNotFoundException;
use Vegas\Security\OAuth\Exception\ServiceNotFoundException;

/**
 * Class Auth
 * @package Auth\Services
 */
class Auth implements InjectionAwareInterface
{
    use InjectionAwareTrait;

    /**
     * Authenticates user by email and password
     *
     * @param $email
     * @param $password
     * @throws IdentityNotFoundException
     */
    public function login($email, $password) 
    {
        $user = BaseUser::findFirst([['email' => $email]]);
        if (!$user) {
            throw new IdentityNotFoundException();
        }
        $this->di->get('auth')->authenticate($user, $password);
    }

    /**
     * Ends session
     */
    public function logout() 
    {
        $identity = $this->di->get('auth')->getIdentity();
        if (($service = $identity->getService()) != null) {
            try {
                $oAuthService = $this->di->get('serviceManager')->getService('oauth:oauth')->initialize();
                $oAuthService->logout($service);
            } catch (ServiceNotFoundException $ex) {
            }
        }
        $this->di->get('auth')->logout();
    }

    /**
     * Authenticates user by e-mail address
     *
     * @param $email
     * @return mixed
     * @throws IdentityNotFoundException
     */
    public function authenticateByEmail($email)
    {
        $user = BaseUser::findFirst([['email' => $email]]);
        if (!$user) {
            throw new IdentityNotFoundException();
        }
        $adapter = new \Vegas\Security\Authentication\Adapter\NoCredential($this->di->get('userPasswordManager'));
        $adapter->setSessionStorage($this->obtainSessionScope());
        $auth = new Authentication($adapter);
        $auth->authenticate($user, null);
        return $auth->getIdentity();
    }

    /**
     * Obtains session scope for authentication
     * It safely checks if the session scope with 'auth' name already exists
     *
     * @return mixed
     */
    private function obtainSessionScope()
    {
        $sessionManager = $this->di->get('sessionManager');
        if (!$sessionManager->scopeExists('auth')) {
            $sessionScope = $sessionManager->createScope('auth');
        } else {
            $sessionScope = $sessionManager->getScope('auth');
        }

        return $sessionScope;
    }
}
