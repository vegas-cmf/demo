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

class UserTask extends \Vegas\Cli\Task
{

    /**
     * Available options
     *
     * @return mixed
     */
    public function setOptions()
    {
        $action = new \Vegas\Cli\Task\Action('create', 'Create user account');

        $option = new \Vegas\Cli\Task\Option('email', 'e', 'User email address');
        $option->setRequired(true);
        $action->addOption($option);

        $option = new \Vegas\Cli\Task\Option('password', 'p', 'User password');
        $option->setRequired(true);
        $action->addOption($option);

        $option = new \Vegas\Cli\Task\Option('name', 'n', 'User name');
        $option->setRequired(true);
        $action->addOption($option);

        $this->addTaskAction($action);
    }

    public function createAction()
    {
        $user = new \Auth\Models\BaseUser();
        $user->email = $this->getOption('email');
        $user->raw_password = $this->getOption('password');
        $user->name = $this->getOption('name');

        $user->save();

        $this->putSuccess('User created');
        $this->pubObject($user->toArray());

        $this->putText('Done.');
    }
}
 