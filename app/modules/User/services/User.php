<?php
/**
 * This file is part of Vegas package
 *
 * @author Arkadiusz Ostrycharz <arkadiusz.ostrycharz@gmail.com>
 *         Jaroslaw Macko <jarek@amsterdam-standard.pl>
 * @copyright Amsterdam Standard Sp. Z o.o.
 * @homepage http://vegas-cmf.github.io
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace User\Services;

use Phalcon\DI\InjectionAwareInterface;
use User\Forms\SignUp;
use User\Models\User as UserModel;
use User\Services\Exception\InvalidFormException;
use User\Services\Exception\UserAlreadyExistsException;
use Vegas\DI\InjectionAwareTrait;
use Vegas\DI\Service\ModelProxyAbstract;

/**
 * Class User
 * @package User\Services
 */
class User extends ModelProxyAbstract implements InjectionAwareInterface
{
    use InjectionAwareTrait;

    /**
     * @param array $data
     * @return UserModel
     * @throws InvalidFormException
     * @throws UserAlreadyExistsException
     * @throws \Exception
     */
    public function validate(array $data)
    {
        $form = new SignUp();
        $entity = new UserModel();
        $form->bind($data, $entity);
        if (!$form->isValid($data)) {
            throw new InvalidFormException($form);
        }

        $email = $data['email'];
        $usersCount = UserModel::count([['email'    =>  $email]]);
        if ($usersCount > 0) {
            throw new UserAlreadyExistsException();
        }

        if ($data['password'] !== $data['password']) {
            throw new \Exception('Passwords do not match');
        }
        unset($entity->repassword);

        return $entity;
    }

    /**
     * @param UserModel $userEntity
     * @return bool
     */
    public function createAccount(UserModel $userEntity)
    {
        $result = $userEntity->save();

        return $result;
    }
}
