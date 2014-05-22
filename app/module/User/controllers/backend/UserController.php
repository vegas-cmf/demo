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
namespace User\Controllers\Backend;

use Vegas\Mvc\Controller;
use Vegas\Media\Helper as MediaHelper;
use Favourite\Models\Favourite;

/**
 * Class UserController
 *
 * @ACL(name='mvc:user:Backend\User', description='User')
 *
 * @package User\Controllers\Backend
 */
class UserController extends Controller\Crud
{  
    protected $formName = 'User\Forms\User';
    protected $modelName = 'User\Models\User';
    
    public function initialize()
    {
        parent::initialize();
        
        $this->view->favourites = array();
        $this->view->files = array();
        
        $this->dispatcher->getEventsManager()->attach(Controller\Crud\Events::AFTER_CREATE, function() {
            $this->processFiles();
            
            $this->response->redirect(array(
                'for' => 'admin/user', 
                'action' => 'edit', 
                'params' => $this->scaffolding->getRecord()->getId()
            ));
        });
        
        $this->dispatcher->getEventsManager()->attach(Controller\Crud\Events::AFTER_CREATE_EXCEPTION, function() {
            if ($this->getDI()->has('fileWrapper')) {
                $this->view->files = $this->fileWrapper->wrapValues($this->request->getPost('files'));
            }
            $this->view->favourites = Favourite::findByUserId($this->scaffolding->getRecord()->getId());
        });
        
        $this->dispatcher->getEventsManager()->attach(Controller\Crud\Events::AFTER_DELETE, function() {
            $this->response->redirect(array(
                'for' => 'admin/user', 
                'action' => 'index', 
            ));
        });
        
        $this->dispatcher->getEventsManager()->attach(Controller\Crud\Events::AFTER_EDIT, function() {
            $files = $this->view->files;
            if (empty($files)) {
                $record = $this->scaffolding->getRecord();
                $this->view->files = $record->getFiles();
            }
        });

        $this->dispatcher->getEventsManager()->attach(Controller\Crud\Events::AFTER_UPDATE, function() {
            $this->processFiles();
            
            $this->response->redirect(array(
                'for' => 'admin/user', 
                'action' => 'edit', 
                'params' => $this->scaffolding->getRecord()->getId()
            ));
        });
        
        $this->dispatcher->getEventsManager()->attach(Controller\Crud\Events::AFTER_UPDATE_EXCEPTION, function() {
            if ($this->getDI()->has('fileWrapper')) {
                $this->view->files = $this->fileWrapper->wrapValues($this->request->getPost('files'));
            }
            $this->view->favourites = Favourite::findByUserId($this->scaffolding->getRecord()->getId());
        });
    }
    
    private function processFiles()
    {
        $files = $this->request->getPost('files');
        
        $record = $this->scaffolding->getRecord();
        $record->files = $files;
        $record->save();

        if (!empty($files)) {
            MediaHelper::moveFilesFrom($record);
            MediaHelper::generateThumbnailsFrom($record, array('width' => 46, 'height' => 46));
            MediaHelper::generateThumbnailsFrom($record, array('width' => 190, 'height' => 190));
            MediaHelper::generateThumbnailsFrom($record, array('width' => 200, 'height' => 200));
        }
    }

    /**
     * @ACL(name='index', description='List users')
     */
    public function indexAction()
    {
        $this->view->users = \User\Models\User::find();
    }
}
