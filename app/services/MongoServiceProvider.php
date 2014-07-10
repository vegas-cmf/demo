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
use Phalcon\Mvc\Url as UrlResolver;

class MongoServiceProvider implements ServiceProviderInterface
{
    const SERVICE_NAME = 'mongo';

    /**
     * {@inheritdoc}
     */
    public function register(DiInterface $di)
    {
        $di->set(self::SERVICE_NAME, function() use ($di) {
            $mongoConfig = $di->get('config')->mongo->toArray();

            //obtains hostname
            if (isset($mongoConfig['host'])) {
                $hostname = 'mongodb://' . $mongoConfig['host'];
            } else {
                $hostname = 'mongodb://localhost';
            }
            unset($mongoConfig['host']);

            $mongo = new \MongoClient($hostname, $mongoConfig);
            return $mongo->selectDb($mongoConfig['db']);
        }, true);
    }

    /**
     * {@inheritdoc}
     */
    public function getDependencies()
    {
        return array(
            CollectionManagerServiceProvider::SERVICE_NAME
        );
    }
} 