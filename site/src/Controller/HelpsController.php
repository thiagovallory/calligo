<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\View\Exception\MissingTemplateException;
use Cake\Event\Event;
use Cake\Event\EventInterface;

class HelpsController extends AppController
{

    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    public function isAuthorized($user)
    {
        return true;
    }

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['index','search']);
    }


    public function index(){
        if($this->Auth->user()) {
            $helps = $this->Helps->getAll($this->Auth->user('role'));
        } else {
            $helps = $this->Helps->getAll(3);
        }
        $this->helpQuestion = $this->loadModel('HelpQuestions');
        $helpQuestion       = $this->helpQuestion->newEmptyEntity();

        if ($this->request->is('post')) {
            $data         = $this->request->getData();
            $helpQuestion = $this->helpQuestion->patchEntity($helpQuestion, $data);
            $this->sendEmail('contato@calligo.com.br', 'Ajuda', $data, 'help');
            if ($this->helpQuestion->save($helpQuestion)) {
                $this->Flash->success(__('Mensagem enviada com sucesso!'));
                $helpQuestion = $this->helpQuestion->newEmptyEntity();
                $this->redirect(['action' => 'index']);
            };
        }

        $this->set(compact('helps', 'helpQuestion'));
    }

    public function search(){
        $text = ($this->request->getQuery('text')) ? $this->request->getQuery('text') : null;
        $helps = $this->Helps->getSearch($text);
        return $this->responseJSON($helps,200);
    }

}
