<?php
/**
 * This file is part of Vegas package
 *
 * @author Arkadiusz Ostrycharz <arkadiusz.ostrycharz@gmail.com>
 * @copyright Amsterdam Standard Sp. Z o.o.
 * @homepage https://bitbucket.org/amsdard/vegas-phalcon
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Phalcon\DiInterface;
use Vegas\DI\ServiceProviderInterface;


/**
 * Class PageServiceProvider
 */
class PageServiceProvider implements ServiceProviderInterface
{
    const SERVICE_NAME = 'page';

    /**
     * {@inheritdoc}
     */
    public function register(DiInterface $di)
    {
        $di->set(self::SERVICE_NAME,function() use($di) {
            $router  = $di->get('router');
            $matched = $router->getMatchedRoute();
            return \Page\Models\Page::findOrCreateByRoute($matched);    
        }, true);
        return $di;
    }

    /**
     * {@inheritdoc}
     */
    public function getDependencies()
    {
        return array(
            MongoServiceProvider::SERVICE_NAME,

        );
    }
} 