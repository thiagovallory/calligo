<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;
use Cake\I18n\FrozenDate;


class CronsController extends AppController {

	public $token = 'SIb2F3nH6bWMaVez6bzR1lS029dm2VyIYy107kF6HgQrDP4HNZ9tw6gh8IP4v0pS';

	public function isAuthorized() {
		return true;
    }

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow();
        if ($this->request->getQuery('token') && ($this->request->getQuery('token') == $this->token) ){
            return true;
        } else {
            die('não autorizado');
        }
    }

	public function removeAccounts() {
	    $this->Users = $this->loadModel('Users');
        $accounts = $this->Users->getAccountsToRemove();

        foreach ($accounts as $account) {
            $data = [
                'username'  => 'delete_' . uniqid() . '_' . $account->username,
                'to_remove' => 0,
            ];
            $this->Users->patchEntity($account, $data, ['validate' => false]);
            $this->Users->save($account);
        }

        return $this->responseJSON(true, 200);
	}

    // public function cancelAppointmentsForNonPayment(){
    //     $this->Users = $this->loadModel('Users');
    //     $appointments = $this->Users->AppointmentsMade->getCancelAppointmentsForNonPayment();

    //     foreach ($appointments as $key => $obj) {
    //         $app = $this->Users->AppointmentsMade->get($obj['id']);
    //         $app = $this->Users->AppointmentsMade->patchEntity($app, ['status'=>6], ['validate' => false,'checkRules' => false]);

    //         if ($this->Users->AppointmentsMade->save($app, ['checkRules' => false])) {
    //             echo 'salvou - ';
    //         } else {
    //             debug($app->getErrors());
    //         }
    //         die;
    //     }
    //     return $this->responseJSON($appointments, 200);
    // }

    public function cancelAppointmentsForNonPayment(){
        $this->Appointments = $this->loadModel('Appointments');
        $appointments = $this->Appointments->getCancelAppointmentsForNonPayment();

        foreach ($appointments as $key => $obj) {
           if ($this->Appointments->setCancelAppointmentsForNonPayment($obj['id'])){
               $this->sendEmail($obj['patient']['username'], 'Consulta cancelada', $obj, 'scheduled_appointment_canceled_non_payment');
           }
        }
        die;
        return $this->responseJSON($appointments, 200);
    }

    public function epsiRenovationAlert() {
        $this->Profiles = $this->loadModel('Profiles');
        $profiles = $this->Profiles->getExpiringEpsi(FrozenDate::now()->addMonth()->format('Y-m-d'));

        foreach ($profiles as $profile) {
            $this->sendEmail($profile['user']['username'], 'E-psi expirando', $profile, 'epsi_expiration');
        }

        return $this->responseJSON(true, 200);
    }
}








