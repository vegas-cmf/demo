<?php
/**
 * This file is part of Vegas package
 *
 * @author Slawomir Zytko <slawomir.zytko@gmail.com>
 * @copyright Amsterdam Standard Sp. Z o.o.
 * @homepage https://bitbucket.org/amsdard/vegas-phalcon
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
 
namespace Article\Controllers\Frontend;

use Article\Models\Article;
use Vegas\Mvc\Controller\Crud;

class ExampleController extends Crud
{
    protected $modelName = 'Article\Models\Article';

    protected $formName = 'Article\Forms\Article';

    public function initialize()
    {
        parent::initialize();

        $getRoute = function() {
            $redirectTo = array(
                'for' => 'articles',
                'lang' => $this->dispatcher->getParam('lang'),
                'action' => 'index'
            );
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
        $lang = !$this->dispatcher->getParam('lang') ? DEFAULT_LANG : $this->dispatcher->getParam('lang');

        $this->view->articles = Article::find(array(array('lang' => $lang)));
    }
} 