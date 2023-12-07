<?php
declare(strict_types=1);

namespace App\Controller\Dashboard;

use Cake\Event\Event;
use Cake\Event\EventInterface;
use Cake\Utility\Security;
use Cake\Routing\Router;
use Cake\Core\Configure;

class RecordsController extends AppController
{
	public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadModel('Users');
        $this->loadModel('Bonds');
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

    public function add(){

        if ($this->request->is('post')) {

            $rec = $this->Records->newEmptyEntity();
            $data                           = $this->request->getData();
            $newRec                         = [];
            $newRec['name']                 = $data['name'];
            $newRec['description']          = $data['description'];
            $newRec['type_of_record_id']    = $data['type_of_record_id'];
            $newRec['private']              = ($this->Auth->user('role')==1) ? 0 : $data['private'];
            $newRec['owner_id']             = $this->Auth->user('id');
            $newRec['patient_id']           = ($this->Auth->user('role')==1) ? $this->Auth->user('id') : $data['patient_id'];

            if (isset($data['docs'][0]['name'])){
                foreach ($data['docs'] as $key => $obj) {
                    $newRec['docs'][] = [
                        'name'=>$obj['name'],
                        'size'=>$obj['size'],
                        'url'=>$obj['url']
                    ];
                }
            }
            
            if ($this->Auth->user('role')==2){
                if (!$this->Bonds->isRuleIsPatientByTherapist($data['patient_id'], $this->Auth->user('id'))){
                    die('not permited');
                }
            }
        
            $rec = $this->Records->patchEntity($rec, $newRec);
            if ($this->Records->save($rec)) {
                return $this->responseJSON(true, 200);
            } else {
                return $this->responseJSON($rec->getErrors(), 400);
            }
        }
        return $this->responseJSON(false, 500);
    }

    public function edit($id){

        $rec = $this->Records->get($id);

        if (!$this->Records->getRuleChange($id, $this->Auth->user('id'))){
            die('not permited');
        }

        if ($this->Auth->user('role')==2){
            if (!$this->Bonds->isRuleIsPatientByTherapist($rec->patient_id, $this->Auth->user('id'))){
                die('not permited');
            }
        }

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $updateRec = [
                'name'              => $data['name'],
                'description'       => $data['description'],
                'private'           => ($this->Auth->user('role')==1) ? 0 : $data['private'],
                'type_of_record_id' => $data['type_of_record_id']
            ];

            $rec = $this->Records->patchEntity($rec, $updateRec);
            if ($this->Records->save($rec)) {
                return $this->responseJSON(true,200);
            } else {
                return $this->responseJSON($rec->getErrors(),400);
            }
        }
        return $this->responseJSON(false, 500);
    }

    public function delete($id){
    
        // if (!$this->Records->getRuleChange($id, $this->Auth->user('id'))){
        //     die('not permited');
        // }

        // $rec = $this->Records->get($id);
        // if ($this->Records->delete($rec)) {
        //     return $this->responseJSON(true,200);
        // } 
        
        //return $this->responseJSON(false, 500);
    }

    public function alterPrivateOrShared($id){
        // if (!$this->Records->getRuleChange($id, $this->Auth->user('id'))){
        //     die('not permited');
        // }

        // if ($this->Records->setAlterPrivateOrShared($id)) {
        //     return $this->responseJSON(true,200);
        // }

        // return $this->responseJSON(false,400);
    }
}
