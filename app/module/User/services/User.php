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

use User\Models\User As UserModel;
use User\Services\EventsManager\SignUp;
use User\Services\Exception\UserAlreadyExistsException;
use Vegas\DI\Service\ModelProxyAbstract;
use Phalcon\DI\InjectionAwareInterface;

/**
 * Class User
 * @package User\Services
 */
class User extends ModelProxyAbstract implements InjectionAwareInterface
{
    use \Vegas\DI\InjectionAwareTrait;

    /**
     *
     */
    public function __construct()
    {
        $this->model = new UserModel();
    }

    /**
     *
     */
    public function setupEventsManager()
    {
        $eventsManager = $this->di->get('eventsManager');
        $eventsManager->attach('user:afterSignUp', SignUp::afterSignUp());

        $this->di->set('eventsManager', $eventsManager);
    }

    /**
     * @param array $data
     * @return bool
     * @throws Exception\UserAlreadyExistsException
     */
    public function validate(array $data)
    {
        $email = $data['email'];
        $usersCount = UserModel::count(array(array('email'    =>  $email)));
        if ($usersCount > 0) {
            throw new UserAlreadyExistsException();
        }

        return true;
    }

    /**
     * @param UserModel $userModel
     * @return bool
     */
    public function create(UserModel $userModel)
    {
        $this->setupEventsManager();
        $this->validate($userModel->toArray());
        $result = $userModel->save();
        $this->di->get('eventsManager')->fire('user:afterSignUp', array('user' => $userModel));

        return $result;
    }

    /**
     * @return array
     */
    public function findWithIdAsKey() 
    {
        $preparedUsers = [];
        $users = $this->model->find();
        foreach($users as $user) {
            $preparedUsers[(string)$user->getId()] = $user;
        }

        return $preparedUsers;
    }

    /**
     * @param $query
     * @return array
     */
    public function getUsers($query)
    {
        return UserModel::find($query);
    }

    /**
     * @param $id
     * @param bool $throwException
     * @return \Phalcon\Mvc\Collection
     * @throws \Vegas\Exception
     */
    public function retrieveById($id, $throwException=false)
    {
        $user = UserModel::findById($id);

        if ($throwException && !$user) {
            throw new \Vegas\Exception('User does not exist', 404);
        }

        return $user;
    }

    /**
     * @return array
     */
    public function getForMultiSelect()
    {
        $usersForMultiSelect = [];
        $users = $this->model->find(array('sort' => array('last_name' => 1)));

        foreach($users as $user) {
            $usersForMultiSelect[(string)$user->_id] = sprintf('%s %s', $user->first_name, $user->last_name);
        }

        return $usersForMultiSelect;
    }

}
