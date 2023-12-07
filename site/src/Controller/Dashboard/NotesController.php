<?php
declare(strict_types=1);

namespace App\Controller\Dashboard;

use Cake\Event\Event;
use Cake\Event\EventInterface;
use Cake\Utility\Security;
use Cake\Routing\Router;
use Cake\Core\Configure;

class NotesController extends AppController
{
	public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadModel('Users');
    }

    public function isAuthorized($user)
    {    
        // TODO V1
        //return false;
        
        if ($user['role'] == 2) {
            return true;
        }
        return false;
    }

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->viewBuilder()->setLayout('internal');
        $this->set('sidebar', 'dashboard');
    }

    public function add(){

        $note = $this->Notes->newEmptyEntity();

        if ($this->request->is('post')) {
            $data                       = $this->request->getData();

            if (!$this->Users->Clients->isRuleIsPatientByTherapist($data['patient_id'], $this->Auth->user('id'))){
                die('not permited');
            }

            $newNote['description']     = $data['description'];
            $newNote['patient_id']      = $data['patient_id'];
            $newNote['owner_id']        = $this->Auth->user('id');
            
            $note = $this->Notes->patchEntity($note, $newNote);
            if ($this->Notes->save($note)) {
                return $this->responseJSON(true, 200);
            } else {
                return $this->responseJSON($note->getErrors(), 400);
            }
        }
        return $this->responseJSON(false, 500);
    }

    public function edit($id){

        if (!$this->Users->Clients->isRuleIsPatientByTherapist($id, $this->Auth->user('id'))){
            die('not permited');
        }

        if (!$this->Notes->getRuleChange($id, $this->Auth->user('id'))){
            die('not permited');
        }

        if ($this->request->is('post')) {
            $note = $this->Notes->get($id);
            $data = $this->request->getData();
            $updateNote = [
                'description' => $data['description'],
            ];

            $note = $this->Notes->patchEntity($note, $updateNote);
            if ($this->Notes->save($note)) {
                return $this->responseJSON(true,200);
            } else {
                return $this->responseJSON($note->getErrors(),400);

            }
        }
        return $this->responseJSON(false, 500);
    }

    public function delete($id){
        $note = $this->Notes->get($id);

        if (!$this->Users->Clients->isRuleIsPatientByTherapist($note->patient_id, $this->Auth->user('id'))){
            die('not permited');
        }

        if (!$this->Notes->getRuleChange($id, $this->Auth->user('id'))){
            die('not permited');
        }
        
        if ($this->Notes->delete($note)) {
            return $this->responseJSON(true,200);
        } 
        
        return $this->responseJSON(false, 500);
    }
}
