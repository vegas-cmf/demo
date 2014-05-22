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

namespace User\Controllers\Frontend;

use User\Forms\SignUp;
use User\Models\User;
use User\Services\Exception\InvalidFormException;
use User\Services\Exception\SignUpFailedException;
use User\Services\Exception\UserAlreadyExistsException;

/**
 * Class UserController
 *
 * @ACL(name='mvc:user:Frontend\User', description='User')
 *
 * @package User\Controllers\Frontend
 */
class UserController extends \Vegas\Mvc\Controller\ControllerAbstract
{
    /**
     * @ACL(name='show', description='Shows user')
     */
    public function showAction($id)
    {
//        $this->formatter->setPattern('dd-MM-YYYY');
//
//        $service = $this->di->get('serviceManager')->getService('user:user');
//
//        $user = User::findById((string)$id);
//
//        if(!$user) {
//            $this->throw404('Page does not exist.');
//        }
//
//        $this->view->investigations = $service->getInvestigations($user->_id, User::WIDGET_INVESTIGATIONS_LIMIT);
//        $this->view->messages = $service->getMessages();
//        $this->view->user = $user;
    }

    /**
     * @ACL(name='signup', description='Sign up new account')
     */
    public function signupAction()
    {
        $this->view->setLayout('login');
        $this->view->setRenderLevel(\Vegas\Mvc\View::LEVEL_LAYOUT);

        $userService = $this->di->get('serviceManager')->getService('user:user');
        $form = new SignUp();

        try {
            if ($this->request->isPost()) {
                $post = $this->request->getPost();
                if (!$form->isValid($post)) {
                    throw new InvalidFormException($form);
                }
                $userModel = new User();
                $form->bind($post, $userModel);

                $result = $userService->create($userModel);
                if (!$result) {
                    throw new SignUpFailedException();
                }
                return $this->response->redirect(array('for' => 'signup-success'));
            }
        } catch (InvalidFormException $ex) {
            $this->view->formErrors = $ex->getErrors();
        } catch (UserAlreadyExistsException $ex) {
            $this->flash->message('error', $ex->getMessage());
        } catch (SignUpFailedException $ex) {
            $this->flash->message('error', $ex->getMessage());
        }


        //oauth
        $oAuth = $this->serviceManager->getService('oauth:oauth');
        $oAuth->initialize();

        $this->view->linkedinUri = $oAuth->getAuthorizationUri('linkedin');
        $this->view->facebookUri = $oAuth->getAuthorizationUri('facebook');
        $this->view->googleUri = $oAuth->getAuthorizationUri('google');

        $this->view->form = $form;
    }

    public function signupSuccessAction()
    {

    }

    /**
     * @ACL(name='update', inherit='myAccount')
     * @override
     */
    public function updateAction()
    {
        $user = User::findById($this->authUser->getIdentity()->getId());
        $this->checkRequest($user);

        try {
            $this->processFormFor($user);
        } catch (\Vegas\Exception $e) {
//            $this->processUpdateError($e);
        }
    }

    private function processFormFor(User $user)
    {
        $form = new \User\Forms\MyAccount();
        $form->bind($this->request->getPost(), $user);

        if ($form->isValid()) {
            $user->save();
//            $this->processFilesForUser($user);
            $this->flash->success($this->i18n->_('Your account is updated.'));
            $this->view->disable();
            $this->response->redirect(array(
                'for' => 'my-account'
            ));
        } else {
            $this->view->form = $form;
            $this->view->record = $user;
            throw new \Vegas\DI\Scaffolding\Exception\InvalidFormException();
        }
    }

    private function checkRequest($user = null)
    {
        if(!$user) {
            $this->throw404('Page does not exist.');
        }

        if (!$this->request->isPost()) {
            throw new \Vegas\Mvc\Controller\Crud\Exception\PostRequiredException();
        }
    }

//    private function processFilesForUser(User $user)
//    {
//        $files = $this->request->getPost('files');
//
//        if (!empty($files)) {
//            $user->files = $files;
//            $user->save();
//
//            MediaHelper::moveFilesFrom($user);
//            MediaHelper::generateThumbnailsFrom($user, array('width' => 46, 'height' => 46));
//            MediaHelper::generateThumbnailsFrom($user, array('width' => 190, 'height' => 190));
//            MediaHelper::generateThumbnailsFrom($user, array('width' => 200, 'height' => 200));
//        }
//    }

//    private function processUpdateError(\Vegas\Exception $e)
//    {
//        $this->flash->error($e->getMessage());
//        if ($this->getDI()->has('fileWrapper')) {
//            $this->view->files = $this->fileWrapper->wrapValues($this->request->getPost('files'));
//        }
//        $this->view->pick(array('frontend/user/myAccount'));
//    }
}

