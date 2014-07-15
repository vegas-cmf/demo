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
namespace Auth\Models;

use Vegas\Db\Decorator\CollectionAbstract;
use Vegas\Security\Authentication\GenericUserInterface;

class BaseUser extends CollectionAbstract implements GenericUserInterface
{
    public function getSource()
    {
        return 'vegas_users';
    }

    public function beforeSave()
    {
        if (!empty($this->raw_password)) {
            $this->writeAttribute('password', $this->getDI()->get('userPasswordManager')->encryptPassword($this->raw_password));
            unset($this->raw_password);
        }
    }

    public function getIdentity()
    {
        return $this->readAttribute('email');
    }

    public function getCredential()
    {
        return $this->readAttribute('password');
    }

    public function getAttributes()
    {
        $userData = $this->toArray();
        //remove password from user data
        unset($userData['password']);
        $userData['id'] = $this->getId();

        return $userData;
    }
}
 
