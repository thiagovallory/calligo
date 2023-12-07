<?php
declare(strict_types=1);

namespace App\Controller\Settings;

use Cake\Event\Event;
use Cake\Event\EventInterface;
use Cake\Utility\Security;
use Cake\Routing\Router;
use Cake\Core\Configure;

class HistoryController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadModel('Invoices');
    }

    public function isAuthorized($user)
    {
        return true;
    }

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->viewBuilder()->setLayout('internal');
        $this->set('sidebar', 'account');
    }

    public function index()
    {
        $order = ($this->request->getQuery('paymentOrder')) ? $this->request->getQuery('paymentOrder') : 0;
        $invoices = $this->paginate($this->Invoices->getQueryHistory($this->Auth->user('id'), $order));
        $this->set(compact('invoices'));
    }

    public function requestrefund($id = null){
        $invoice = $this->Invoices->get($id, ['contain' => ['Appointments']]);
        $therapist = $this->loadModel('Users')->get($invoice->appointment->therapist_id);
        $patient = $this->Users->get($invoice->appointment->patient_id);
            $data = [
            'therapist_name' => $therapist->name,
            'therapist_email' => $therapist->username,
            'therapist_iugu_id' => $therapist->iugu_udid,
            'patient_iugu_id' => $patient->iugu_customer_id,
            'patient_name' => $patient->name,
            'patient_email' => $patient->username,
            'payment_id' => $invoice->iugu_udid,
            'payment_url' => $invoice->iugu_url
        ];

        $invoiceStatus = [
            'status' => 2 // status de estorno
        ];
        $invoice = $this->Invoices->patchEntity($invoice, $invoiceStatus);
        if($this->Invoices->save($invoice)){
            $this->sendEmail('contato@calligo.com.br', 'Reembolso', $data, 'refund');
            $this->Flash->success(__('Cartão salvo com sucesso.'));
        } else {
            $this->Flash->success(__('Houve um erro na gravação dos dados. Por favor, tente novamente'));
        }
        return $this->redirect('/settings/history');
    }

}
