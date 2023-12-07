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

class AppointmentsController extends AppController
{

    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Iugu');
        $this->loadModel('Appointments');
        $this->loadModel('Bonds');
        $this->loadModel('Cards');
        $this->loadModel('IuguCustomerTokens');
        $this->loadModel('States');
        $this->loadModel('Cities');
    }

    public function isAuthorized($user)
    {
        return true;
    }

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
    }


    public function payment($appointment_id)
    {
        if (!$this->Appointments->isRulePatientOwner($appointment_id, $this->Auth->user('id'))) {
            return $this->redirect(['controller' => 'Schedules', 'action' => 'index', 'prefix' => 'Dashboard']);
        }

        if (!$this->Appointments->isRulePaymentReleased($appointment_id)) {
            return $this->redirect(['controller' => 'Schedules', 'action' => 'index', 'prefix' => 'Dashboard']);
        }

        $appointment = $this->Appointments->get($appointment_id, ['contain' => ['Therapist', 'Patient', 'Modalities', 'Invoices']]);
        $therapist   = $this->Users->get($appointment->therapist_id);

        $cards    = [];
        $response = $this->Iugu->cards_list($this->Auth->user('iugu_customer_id'));
        if ($response['status'] === 200) {
            foreach ($response['data'] as $key => $card) {
                $card['data']['id'] = $response['data'][$key]['id'];
                $cards[]            = $card['data'];
            }
        }

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            if (!isset($data['card'])) {
                return $this->redirect('/appointments/payment/' . $appointment_id);
            }

            $customer_master = $this->Iugu->get_customer($this->Auth->user('iugu_customer_id'));
            if ($customer_master['status'] === 200) {
                $fields              = ['name' => $customer_master['data']['name'], 'email' => $customer_master['data']['email']];
                $customer_subaccount = $this->Iugu->create_customer_subaccount($therapist->iugu_live_token, $fields);
                if ($customer_subaccount['status'] === 200) {
                    $fields                     = ["proxy_payments_from_customer_id" => $this->Auth->user('iugu_customer_id')];
                    $customer_subaccount_edited = $this->Iugu->edit_customer_subaccount($therapist->iugu_live_token, $customer_subaccount['data']['id'], $fields);
                } else {
                    return $this->redirect(['controller' => 'Schedules', 'action' => 'index', 'prefix' => 'Dashboard']);
                }
            } else {
                return $this->redirect(['controller' => 'Schedules', 'action' => 'index', 'prefix' => 'Dashboard']);
            }

            $user = $this->Users->get($this->Auth->user('id'), ['contain' => ['Profiles']]);

            $fields = [
                'customer_id'                => $customer_subaccount['data']['id'],
                'customer_payment_method_id' => $data['card'],
                'email'                      => $user->username,
                'items'                      => [
                    0 => [
                        'description' => 'Calligo - Serviço Profissional',
                        'quantity'    => 1,
                        'price_cents' => ($appointment->price * 100)
                    ]
                ],
                'payer'                      => [
                    'cpf_cnpj'     => $user->profile->document_number,
                    'name'         => $user->name,
                    'email'        => $user->username,
                ],
            ];

            $iugu = $this->Iugu->charge($therapist->iugu_live_token, $fields);

            if ($iugu['status'] === 200) {
                $detailsCard = $data['card'];

                $updateAppointment = [
                    'status' => 3,
                    'hour'   => $appointment['hour']->addSeconds(1)
                ];
                $appointment       = $this->Appointments->patchEntity($appointment, $updateAppointment);

                $updateInvoice = [
                    'iugu_url'          => $iugu['data']['url'],
                    'iugu_udid'         => $iugu['data']['invoice_id'],
                    'iugu_card_details' => $detailsCard,
                    'appointment_id'    => $appointment->id,
                    'status'            => 1
                ];
                $invoice       = $this->loadModel('Invoices')->newEmptyEntity();
                $invoice       = $this->loadModel('Invoices')->patchEntity($invoice, $updateInvoice);


                if (($this->Appointments->save($appointment)) && ($this->Invoices->save($invoice))) {
                    $data            = $appointment;
                    $data['patient'] = $this->Auth->user();
                    $this->Bonds->setActive($appointment->therapist_id, $appointment->patient_id);
                    //$this->sendEmail($data['patient']['username'], 'Consulta confirmada', $data, 'scheduled_appointment_confirmed');
                    return $this->redirect(['controller' => 'Schedules', 'action' => 'index', 'prefix' => 'Dashboard']);
                }

            } else {
                $this->Flash->error(__('HOUVE UMA FALHA, TENTE NOVAMENTE'));
                return $this->redirect('/appointments/payment/' . $appointment_id);
            }
        }
        $years = [];
        $year  = (int)date('Y');
        for ($i = $year - 5; $i < $year + 10; $i++) {
            $years[$i] = $i;
        }
        $states = $this->States->getList();
        $cities = $this->Cities->getList();
        $this->set(compact('appointment', 'cards', 'states', 'cities', 'years'));

    }

    public function _getTelephone($tel)
    {
        $tel = str_replace("(", "", $tel);
        $tel = str_replace(")", "", $tel);
        $tel = str_replace(" ", "", $tel);
        $tel = str_replace("-", "", $tel);

        return $tel;
    }

    public function success($id)
    {
        $this->set(compact('id'));
    }

    public function splitNames($name)
    {
        return explode(' ', $name, 2);
    }

    public function splitExpiration($date)
    {
        return explode('-', $date);
    }
}
