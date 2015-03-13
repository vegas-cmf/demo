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

use Phalcon\DiInterface;
use Vegas\DI\ServiceProviderInterface;

class ModelsManagerServiceProvider implements ServiceProviderInterface
{
    const SERVICE_NAME = 'modelsManager';

    /**
     * {@inheritdoc}
     */
    public function register(DiInterface $di)
    {
        $di->set(self::SERVICE_NAME, function() use ($di) {
            return new \Phalcon\Mvc\Model\Manager();
        }, true);
    }

    /**
     * {@inheritdoc}
     */
    public function getDependencies()
    {
        return [];
    }
} 