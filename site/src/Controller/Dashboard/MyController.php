<?php
declare(strict_types=1);

namespace App\Controller\Dashboard;

use Cake\Event\Event;
use Cake\Event\EventInterface;
use Cake\Utility\Security;
use Cake\Routing\Router;
use Cake\Core\Configure;

class MyController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadModel('Bonds');
        $this->loadModel('Records');
        $this->loadModel('TypeOfRecords');
        $this->loadModel('Docs');
        $this->loadModel('ComplaintItems');
    }

    public function isAuthorized($user)
    {
        return true;
    }

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->viewBuilder()->setLayout('internal');
        $this->set('sidebar', 'my');
    }

    public function index()
    {
        $params['type']       = ($this->request->getQuery('type')) ? $this->request->getQuery('type') : null;
        $params['asc']        = ($this->request->getQuery('asc')) ? $this->request->getQuery('asc') : null;
        $params['order_date'] = ($this->request->getQuery('order_date')) ? $this->request->getQuery('order_date') : null;

        $patient         = $this->Users->getViewResume($this->Auth->user('id'));
        $therapist       = $this->Bonds->getMyTherapist($this->Auth->user('id'));
        $records         = $this->Records->getAll($this->Auth->user('id'), null, $params, true);
        $summaryListDocs = $this->Docs->getSummaryList($this->Auth->user('id'), $this->Auth->user('id'), 1);
        $typeOfRecords   = $this->TypeOfRecords->getAll();
        $complaintItems  = $this->ComplaintItems->getAll($this->Auth->user('role'));

        $appointmentPath = Router::url(['controller'=>'Users','action'=>'search', 'prefix' => false]);

        if (!empty($therapist))
            $appointmentPath = Router::url(['controller'=>'Users','action'=>'profile', 'prefix' => false]) . '/' . $therapist['therapist_id'];

        $this->set(compact('patient', 'appointmentPath', 'therapist', 'records', 'summaryListDocs', 'typeOfRecords', 'params', 'complaintItems'));
    }

    public function docs()
    {
        $patient = $this->Users->getViewResume($this->Auth->user('id'));
        $my      = $this->Docs->getMyDocs($this->Auth->user('id'), $this->Auth->user('id'), $this->Auth->user('role'));
        $shared  = $this->Docs->getShareDocs($this->Auth->user('id'), $this->Auth->user('id'), $this->Auth->user('role'));
        $all     = array_merge($my, $shared);
        $this->set(compact('all', 'patient'));
    }

    public function setEndTherapy($therapist_id)
    {
        if (!$this->Bonds->isRuleIsPatientByTherapist($this->Auth->user('id'), $therapist_id)) {
            die('not permited');
        }

        $data                                  = $this->request->getData();
        $updateBond['patient_id']              = $this->Auth->user('id');
        $updateBond['therapist_id']            = $therapist_id;
        $updateBond['closing_description']     = $data['closing_description'];
        $updateBond['closing_patient_at_risk'] = $data['closing_patient_at_risk'];
        $updateBond['closing_file_name']       = $data['closing_file_name'];
        $updateBond['closing_file_url']        = $data['closing_file_url'];
        $updateBond['closing_file_size']       = $data['closing_file_size'];

        if ($this->Bonds->setEndTherapy($updateBond, 'patient')) {
            $dataEmail = $this->Bonds->getInfos($this->Auth->user('id'), $therapist_id);
            $this->sendEmail($dataEmail['patient']['username'], 'Sua terapia foi encerrada', $dataEmail, 'therapy_ended');
            $this->sendEmail($dataEmail['therapist']['username'], 'Uma terapia foi encerrada', $dataEmail, 'therapy_ended_by_patient');
            return $this->responseJSON(true, 200);
        } else {
            return $this->responseJSON('Erro', 400);
        }
    }

    public function setComplaint($therapist_id)
    {
        if (!$this->Bonds->isRuleIsPatientByTherapist($this->Auth->user('id'), $therapist_id)) {
            die('not permited');
        }

        $comp                    = $this->Complaints->newEmptyEntity();
        $data                    = $this->request->getData();
        $newComp['patient_id'] = $this->Auth->user('id');
        $newComp['therapist_id']   = $patient_id;
        $newComp['description']  = $data['description'];

        foreach ($data['items'] as $key => $item) {
            $newComp['complaint_selecteds'][]['complaint_item_id'] = $item;
        }

        $comp = $this->Complaints->patchEntity($comp, $newComp);
        if ($this->Complaints->save($comp)) {
            $dataEmail = $this->Bonds->getInfos($this->Auth->user('id'), $therapist_id);
            $dataEmail['compaint'] = $newComp;
            $this->sendEmail(Configure::read('EMAILS')['compaint'], 'Denuncia feita', $dataEmail, 'compaint_add');
            return $this->responseJSON(true, 200);
        } else {
            return $this->responseJSON($comp->getErrors(), 400);
        }
    }
}
