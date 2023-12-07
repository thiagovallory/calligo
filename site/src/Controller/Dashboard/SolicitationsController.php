<?php
declare(strict_types=1);

namespace App\Controller\Dashboard;

use Cake\Event\Event;
use Cake\Event\EventInterface;
use Cake\Utility\Security;
use Cake\Routing\Router;
use Cake\Core\Configure;

class SolicitationsController extends AppController
{
	public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadModel('Appointments');
        $this->loadModel('Bonds');
    }

    public function isAuthorized($user)
    {    
        // TODO V1
        return false;
        
        // para v2
        if ($user['role'] == 2){
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
        die;
        // $appointments = $this->paginate($this->Appointments->getQueryWaitingTherapist($this->Auth->user('id')));
        // $this->set(compact('appointments'));
    }

    public function status($id,$status){
        die;
        // if (!$this->Appointments->isRuleApprovalNewStatus($status)){
        //     die('novo status inválido');
        // }

        // if (!$this->Appointments->isRuleApprovalCurrentStatus($id)){
        //     die('status atual inválido');
        // }

        // if (!$this->Appointments->isRuleTherapistOwner($id, $this->Auth->user('id'))){
        //     die('terapeuta dono inválido');
        // }

        // $appointment = $this->Appointments->get($id, ['contain' => ['Patient']]);
        // $update = ['status' => $status];
        // $appointment = $this->Appointments->patchEntity($appointment, $update);
        
        // if ($this->Appointments->save($appointment)) {
        //     $data['id']=$appointment->id;
        //     $data['patient']= [
        //         'id'=>$appointment->patient->id,
        //         'name'=>$appointment->patient->name,
        //     ];

        //     if ($status==4){   
        //         $this->sendEmail($appointment->patient->username, 'Consulta agendada : faça o pagamento', $data, 'scheduled_appointment_waiting_payment');
        //     } else {
        //         $this->Bonds->setCancelBondActual($appointment->patient->id);
        //         $this->sendEmail($appointment->patient->username, 'Consulta não aprovada', $data, 'scheduled_appointment_canceled');
        //     }
        //     return $this->responseJSON(true, 200);
        // } else {
        //     return $this->responseJSON($appointment->getErrors(), 500);
        // }
    }
}
