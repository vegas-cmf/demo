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
namespace Oauth\Controllers\Frontend;
use Vegas\Mvc\Controller\ControllerAbstract;
use Vegas\Security\OAuth\Exception\FailedAuthorizationException;

/**
 * Class OauthController
 * @package Oauth\Controllers\Frontend
 */
class OauthController extends ControllerAbstract
{

    /**
     *
     */
    public function authorizeAction()
    {
        $this->view->disable();

        $serviceName = $this->dispatcher->getParam('service');
        $oauth = $this->serviceManager->getService('oauth:oauth');
        $oauth->initialize();

        try {
            $oauth->authorize($serviceName);
            $identity = $oauth->getIdentity($serviceName);
            $oauth->authenticate($identity);

            return $this->response->redirect(['for' => 'root'])->send();
        } catch (\Exception $ex) {
            $this->flash->error($ex->getMessage());
        }

        return $this->response->redirect(['for' => 'login'])->send();
    }
}
 
