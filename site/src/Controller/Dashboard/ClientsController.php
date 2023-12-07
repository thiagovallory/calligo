<?php
declare(strict_types=1);

namespace App\Controller\Dashboard;

use Cake\Event\Event;
use Cake\Event\EventInterface;
use Cake\Utility\Security;
use Cake\Routing\Router;
use Cake\Core\Configure;

class ClientsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadModel('Bonds');
        $this->loadModel('Docs');
        $this->loadModel('Users');
        $this->loadModel('Notes');
        $this->loadModel('Appointments');
        $this->loadModel('Complaints');
        $this->loadModel('ComplaintItems');
        $this->loadModel('TypeOfRecords');
        $this->loadModel('Records');
    }

    public function isAuthorized($user)
    {
        // TODO V1
        // return false;

        // para v2
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

    public function index()
    {
        $param['search'] = ($this->request->getQuery('search')) ? $this->request->getQuery('search') : null;
        $param['order']  = ($this->request->getQuery('order')) ? $this->request->getQuery('order') : null;
        $param['active'] = ($this->request->getQuery('active')) ? $this->request->getQuery('active') : null;
        $param['role']   = 1;

        $clients        = $this->paginate($this->Bonds->getQueryClients($this->Auth->user('id'), $param));
        $genders        = Configure::read('GENDERS');
        $pronouns       = Configure::read('PRONOUNS');
        $complaintItems = $this->ComplaintItems->getAll($this->Auth->user('role'));
        $this->set(compact('clients', 'genders', 'pronouns', 'param', 'complaintItems'));
    }

    public function supervision()
    {
        $param['search'] = ($this->request->getQuery('search')) ? $this->request->getQuery('search') : null;
        $param['order']  = ($this->request->getQuery('order')) ? $this->request->getQuery('order') : null;
        $param['active'] = ($this->request->getQuery('active')) ? $this->request->getQuery('active') : null;
        $param['role']   = 2;

        $clients        = $this->paginate($this->Bonds->getQueryClients($this->Auth->user('id'), $param));
        $genders        = Configure::read('GENDERS');
        $pronouns       = Configure::read('PRONOUNS');
        $complaintItems = $this->ComplaintItems->getAll($this->Auth->user('role'));
        $this->set(compact('clients', 'genders', 'pronouns', 'param', 'complaintItems'));
    }

    public function view($patient_id)
    {
        if (!$this->Bonds->isRuleExistBond($patient_id, $this->Auth->user('id'))) {
            die('not permited');
        }

        $params['type']       = ($this->request->getQuery('type')) ? $this->request->getQuery('type') : null;
        $params['asc']        = ($this->request->getQuery('asc')) ? $this->request->getQuery('asc') : null;
        $params['order_date'] = ($this->request->getQuery('order_date')) ? $this->request->getQuery('order_date') : null;

        $patient         = $this->Users->getViewResume($patient_id);
        $lastNote        = $this->Notes->getLastNote($patient_id, $this->Auth->user('id'));
        $records         = $this->Records->getAll($patient_id, $this->Auth->user('id'), $params);
        $summaryListDocs = $this->Docs->getSummaryList($patient_id, $this->Auth->user('id'), 2);
        $genders         = Configure::read('GENDERS');
        $pronouns        = Configure::read('PRONOUNS');
        $complaintItems  = $this->ComplaintItems->getAll($this->Auth->user('role'));
        $typeOfRecords   = $this->TypeOfRecords->getAll();
        $bondActive      = $this->Bonds->isRuleIsPatientByTherapist($patient_id, $this->Auth->user('id'));
        $this->set(compact('patient', 'genders', 'pronouns', 'lastNote', 'complaintItems', 'typeOfRecords', 'params', 'records', 'summaryListDocs', 'bondActive'));
    }

    public function docs($patient_id)
    {
        if (!$this->Bonds->isRuleExistBond($patient_id, $this->Auth->user('id'))) {
            die('not permited');
        }

        $patient = $this->Users->getViewResume($patient_id);
        $my      = $this->Docs->getMyDocs($patient_id, $this->Auth->user('id'), $this->Auth->user('role'));
        $shared  = $this->Docs->getShareDocs($patient_id, $this->Auth->user('id'), $this->Auth->user('role'));
        $all     = array_merge($my, $shared);
        $this->set(compact('all', 'patient'));
    }

    public function notes($patient_id)
    {

        if (!$this->Bonds->isRuleExistBond($patient_id, $this->Auth->user('id'))) {
            die('not permited');
        }

        $param['text'] = ($this->request->getQuery('text')) ? $this->request->getQuery('text') : null;
        $notes         = $this->Notes->getMyNotes($patient_id, $this->Auth->user('id'), $param);
        $patient       = $this->Users->getViewResume($patient_id);
        $this->set(compact('notes', 'patient'));
    }

    public function setEndTherapy($patient_id)
    {

        if (!$this->Bonds->isRuleIsPatientByTherapist($patient_id, $this->Auth->user('id'))) {
            die('not permited');
        }

        $data                                  = $this->request->getData();
        $updateBond['patient_id']              = $patient_id;
        $updateBond['therapist_id']            = $this->Auth->user('id');
        $updateBond['closing_description']     = $data['closing_description'];
        $updateBond['closing_patient_at_risk'] = $data['closing_patient_at_risk'];
        $updateBond['closing_file_name']       = $data['closing_file_name'];
        $updateBond['closing_file_url']        = $data['closing_file_url'];
        $updateBond['closing_file_size']       = $data['closing_file_size'];

        if ($this->Bonds->setEndTherapy($updateBond, 'therapist')) {
            $dataEmail = $this->Bonds->getInfos($patient_id, $this->Auth->user('id'));
            $this->sendEmail($dataEmail['patient']['username'], 'Sua terapia foi encerrada', $dataEmail, 'therapy_ended');
            return $this->responseJSON(true, 200);
        } else {
            return $this->responseJSON('Erro', 400);
        }
    }

    public function setComplaint($patient_id)
    {

        if (!$this->Bonds->isRuleIsPatientByTherapist($patient_id, $this->Auth->user('id'))) {
            die('not permited');
        }

        $comp                    = $this->Complaints->newEmptyEntity();
        $data                    = $this->request->getData();
        $newComp['patient_id']   = $patient_id;
        $newComp['therapist_id'] = $this->Auth->user('id');
        $newComp['description']  = $data['description'];

        foreach ($data['items'] as $key => $item) {
            $newComp['complaint_selecteds'][]['complaint_item_id'] = $item;
        }

        $comp = $this->Complaints->patchEntity($comp, $newComp);
        if ($this->Complaints->save($comp)) {
            $dataEmail             = $this->Bonds->getInfos($patient_id, $this->Auth->user('id'));
            $dataEmail['compaint'] = $newComp;
            $this->sendEmail(Configure::read('EMAILS')['compaint'], 'Denuncia feita', $dataEmail, 'compaint_add');
            return $this->responseJSON(true, 200);
        } else {
            return $this->responseJSON($comp->getErrors(), 400);
        }
    }
}
