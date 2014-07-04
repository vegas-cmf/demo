<?php
/**
 * This file is part of Vegas package
 *
 * @author Frank Broersen <frank@pigroup.nl>
 * @copyright Amsterdam Standard Sp. Z o.o.
 * @homepage http://vegas-cmf.github.io
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Phalcon\DiInterface;
use Vegas\DI\ServiceProviderInterface;

class PreviewManagerServiceProvider implements ServiceProviderInterface
{
    const SERVICE_NAME = 'previewManager';

    /**
     * {@inheritdoc}
     */
    public function register(DiInterface $di)
    {
        $di->set(self::SERVICE_NAME, function() use ($di) {
            return new \Vegas\Page\Preview\Manager();
        }, true);
    }

    /**
     * {@inheritdoc}
     */
    public function getDependencies()
    {
        return array();
    }
} 