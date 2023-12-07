<?php
declare(strict_types=1);

namespace App\Controller\Dashboard;

use Cake\Event\Event;
use Cake\Event\EventInterface;
use Cake\Utility\Security;
use Cake\Routing\Router;
use Cake\Core\Configure;

class DocsController extends AppController
{
	public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadModel('Users');
    }

    public function isAuthorized($user)
    {    
        return true;
    }

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->viewBuilder()->setLayout('internal');
        $this->set('sidebar', 'dashboard');
    }

    public function delete($id){
    
        if (!$this->Docs->getRuleChange($id, $this->Auth->user('id'))){
            die('not permited');
        }

        if ($this->Docs->deleteDocAndRecord($id)) {
            return $this->responseJSON(true,200);
        } 
        
        return $this->responseJSON(false, 500);
    }

    public function download($id){

        if (!$this->Docs->getRuleView($id, $this->Auth->user('id'), $this->Auth->user('role'))){
            die('not permited');
        }

        $doc = $this->Docs->get($id);
        $path = Configure::read('FOLDER_DOCS').$doc->url;
        $response = $this->response->withFile(
            $path,
            ['download' => true, 'name' => $doc->url]
        );

        return $response;
    }

    public function view($id){

        if (!$this->Docs->getRuleView($id, $this->Auth->user('id'), $this->Auth->user('role'))){
            die('not permited');
        }

        $doc = $this->Docs->get($id);
        $path = Configure::read('FOLDER_DOCS').$doc->url;
        $response = $this->response->withFile(
            $path,
            ['download' => false, 'name' => $doc->url]
        );

        return $response;
    }
}
