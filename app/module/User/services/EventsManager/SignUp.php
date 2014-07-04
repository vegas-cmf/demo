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
 
namespace User\Services\EventsManager;


use Phalcon\Dispatcher;
use Phalcon\Events\Event;

class SignUp
{
    public static function afterSignUp()
    {
        return function(Event $event, $eventData) {
            $user = $eventData['user'];

            if (!isset($user->password)) {
                $newRawPassword = substr(md5(uniqid() . time()), 2, 8);
                $user->raw_password = $newRawPassword;
                $user->save();

                file_put_contents(APP_ROOT . '/' . $user->slug . '.pwd', $newRawPassword);
            }

        };
    }
} 