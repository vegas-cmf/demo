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

namespace Auth\Services;

use Auth\Models\BaseUser;
use User\Models\User;
use Vegas\Security\OAuth\Exception\ServiceNotFoundException;

class Auth implements \Phalcon\DI\InjectionAwareInterface
{
    use \Vegas\DI\InjectionAwareTrait;

    public function login($email, $password) 
    {
        $user = BaseUser::findFirst(array(array('email' => $email)));
        if (!$user) {
            throw new \Vegas\Security\Authentication\Exception\IdentityNotFoundException();
        }
        $this->di->get('auth')->authenticate($user, $password);
    }

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
        $auth = $this->di->get('auth');
        $auth->logout();
    }

    public function authenticateByEmail($email)
    {
        $user = BaseUser::findFirst(array(array('email' => $email)));
        if (!$user) {
            throw new \Vegas\Security\Authentication\Exception\IdentityNotFoundException();
        }
        $adapter = new \Vegas\Security\Authentication\Adapter\Email($this->di->get('userPasswordManager'));
        $adapter->setSessionStorage($this->di->get('sessionManager')->createScope('auth'));
        $auth = new \Vegas\Security\Authentication($adapter);
        return $auth->authenticate($user, null);
    }
}
