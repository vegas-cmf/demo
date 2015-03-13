<?php
/**
 * @author Sławomir Żytko <slawek@amsterdam-standard.pl>
 * @homepage https://github.com/szytko
 */

namespace User\Controllers\Frontend;

use User\Services\Exception\InvalidFormException;
use Vegas\Mvc\Controller\ControllerAbstract;

class UserController extends ControllerAbstract
{
    public function signUpAction()
    {
        if ($this->request->isPost()) {
            try {
                $this->serviceManager->get('user:user')->createAccount(
                    $this->serviceManager->get('user:user')->validate($this->request->getPost())
                );

                $this->flash->success($this->i18n->_('Account created'));
                $this->response->redirect(ltrim($this->url->get(['for' => 'root']), '/'));
            } catch (InvalidFormException $e) {
                $this->view->formErrors = $e->getErrors();
            } catch (\Exception $e) {
                $this->view->error = $e->getMessage();
            }
        }
    }
}