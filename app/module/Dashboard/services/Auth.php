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

namespace Dashboard\Services;

use Auth\Models\BaseUser;
use User\Models\User;
use Vegas\Security\OAuth\Exception\ServiceNotFoundException;

/**
 * Class Auth
 * @package Dashboard\Services
 */
class Auth implements \Phalcon\DI\InjectionAwareInterface
{
    use \Vegas\DI\InjectionAwareTrait;

    /**
     * Authenticates user by email and password
     *
     * @param $email
     * @param $password
     * @throws \Vegas\Security\Authentication\Exception\IdentityNotFoundException
     */
    public function login($email, $password) 
    {
        $user = BaseUser::findFirst(array(array('email' => $email)));
        if (!$user) {
            throw new \Vegas\Security\Authentication\Exception\IdentityNotFoundException();
        }
        $this->di->get('authDashboard')->authenticate($user, $password);
    }

    /**
     * Ends session
     */
    public function logout() 
    {
        $this->di->get('authDashboard')->logout();
    }
}