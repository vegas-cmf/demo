<?php
/**
 * This file is part of Vegas package
 *
 * @author Slawomir Zytko <slawek@amsterdam-standard.pl>
 * @copyright Amsterdam Standard Sp. Z o.o.
 * @homepage http://vegas-cmf.github.io
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */ 

namespace User\Tasks;

use Auth\Models\BaseUser;
use Vegas\Cli\Task;
use Vegas\Cli\Task\Action;
use Vegas\Cli\Task\Option;

class UserTask extends Task
{

    /**
     * Available options
     *
     * @return mixed
     */
    public function setOptions()
    {
        $action = new Action('create', 'Create user account');

        $option = new Option('email', 'e', 'User email address');
        $option->setRequired(true);
        $action->addOption($option);

        $option = new Option('password', 'p', 'User password');
        $option->setRequired(true);
        $action->addOption($option);

        $option = new Option('name', 'n', 'User name');
        $option->setRequired(true);
        $action->addOption($option);

        $this->addTaskAction($action);
    }

    public function createAction()
    {
        $user = new BaseUser();
        $user->email = $this->getOption('email');
        $user->raw_password = $this->getOption('password');
        $user->name = $this->getOption('name');

        $user->save();

        $this->putSuccess('User created');
        $this->pubObject($user->toArray());

        $this->putText('Done.');
    }
}
 