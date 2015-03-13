<?php
/**
 * This file is part of Vegas package
 *
 * @author Slawomir Zytko <slawek@amsterdam-standard.pl>
 * @copyright Amsterdam Standard Sp. Z o.o.
 * @homepage https://github.com/vegas-cmf
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
 
namespace Crud\Controllers\Frontend;

use Crud\Models\Article;
use Vegas\Mvc\Controller\Crud;

class ArticleController extends Crud
{
    protected $modelName = 'Crud\Models\Article';

    protected $formName = 'Crud\Forms\Article';

    public function initialize()
    {
        parent::initialize();

        $getRoute = function() {
            $redirectTo = [
                'for' => 'crud',
                'action' => 'index'
            ];
            return $redirectTo;
        };

        // we can also add this event in the Module.php to the dispatcher
        $this->dispatcher->getEventsManager()->attach(Crud\Events::AFTER_CREATE, function() use ($getRoute) {
            $this->response->redirect($getRoute());
        });

        $this->dispatcher->getEventsManager()->attach(Crud\Events::AFTER_DELETE, function() use ($getRoute) {
            $this->response->redirect($getRoute());
        });

        $this->dispatcher->getEventsManager()->attach(Crud\Events::AFTER_UPDATE, function() use ($getRoute) {
            $this->response->redirect($getRoute());
        });
    }

    public function indexAction()
    {
        $this->view->articles = Article::find();
    }
} 