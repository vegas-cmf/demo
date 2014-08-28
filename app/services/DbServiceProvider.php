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

use Phalcon\DiInterface;
use Vegas\DI\ServiceProviderInterface;

class DbServiceProvider implements ServiceProviderInterface
{
    const SERVICE_NAME = 'db';

    /**
     * {@inheritdoc}
     */
    public function register(DiInterface $di)
    {
        $di->set(self::SERVICE_NAME, function () use ($di) {
            $config = $di->get('config');
            return new Phalcon\Db\Adapter\Pdo\Mysql(array(
                "host" => $config->database->host,
                "dbname" => $config->database->dbname,
                "port" => $config->database->port,
                "username" => $config->database->username,
                "password" => $config->database->password
            ));
        }, true);
    }

    /**
     * {@inheritdoc}
     */
    public function getDependencies()
    {
        return array(
            ModelsManagerServiceProvider::SERVICE_NAME
        );
    }
} 
