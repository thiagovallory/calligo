<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\Routing\Router;
use Cake\View\Exception\MissingTemplateException;
use Cake\Event\Event;
use Cake\Event\EventInterface;

class PagesController extends AppController
{

    public function isAuthorized($user)
    {
        return true;
    }

    public function beforeFilter(EventInterface $event)
    {
        $this->loadComponent('Iugu');
        parent::beforeFilter($event);
        $this->Auth->allow(['display', 'home', 'designSystem', 'help', 'therapist', 'manifest', 'terms', 'privacy']);
    }

    public function home()
    {
    }

    public function patient()
    {

    }

    public function therapist()
    {

    }

    public function manifest()
    {

    }

    public function terms()
    {

    }

    public function privacy()
    {

    }

    public function designSystem()
    {
        $this->viewBuilder()->setLayout('internal');
        $this->set('sidebar', 'designsystem');
    }

    public function display(string ...$path): ?Response
    {
        if (!$path) {
            return $this->redirect('/');
        }
        if (in_array('..', $path, true) || in_array('.', $path, true)) {
            throw new ForbiddenException();
        }
        $page = $subpage = null;

        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }
        $this->set(compact('page', 'subpage'));

        try {
            return $this->render(implode('/', $path));
        } catch (MissingTemplateException $exception) {
            if (Configure::read('debug')) {
                throw $exception;
            }
            throw new NotFoundException();
        }
    }
}
