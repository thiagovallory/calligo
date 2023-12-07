<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;

class ApiController extends AppController
{

    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadModel('Appointments');
        $this->loadModel('BlockedSchedules');
        $this->loadModel('Cities');

    }

    public function isAuthorized($user)
    {
        if ($user) {
            return true;
        }
        return false;
    }

    public function cancelAppointment()
    {
        $appointment_id = $this->request->getData('appointment_id');
        $user_role      = $this->request->getData('user_role');

        if ($appointment_id) {

            if ($user_role == 2)
                $appointment = $this->Appointments
                    ->find()
                    ->where(['id' => $appointment_id])
                    ->where(['therapist_id' => $this->Auth->user('id')])
                    ->where(['status' => 1])
                    ->first();
            else
                $appointment = $this->Appointments
                    ->find()
                    ->where(['id' => $appointment_id])
                    ->where(['patient_id' => $this->Auth->user('id')])
                    ->where(['status' => 1])
                    ->first();

            if (!$appointment) {
                return $this->responseJSON(['appointment_id' => 'Agendamento inválido'], 400);
            }

            $data        = ['status' => 6];
            $appointment = $this->Appointments->patchEntity($appointment, $data);
            if ($this->Appointments->save($appointment, ['checkRules' => false])) {
                return $this->responseJSON($appointment, 200);
            } else {
                return $this->responseJSON($appointment->getErrors(), 400);
            }
        }

        return $this->responseJSON(['appointment_id' => 'Agendamento inválido'], 400);
    }

    public function changeAppointmentStatus()
    {
        $appointment_id = $this->request->getData('appointment_id');
        $status         = $this->request->getData('status');

        if (!($status == 5 || $status == 7)) {
            return $this->responseJSON(['status' => 'Status inválido'], 400);
        }

        if ($appointment_id) {
            $appointment = $this->Appointments
                ->find()
                ->where(['id' => $appointment_id])
                ->where(['therapist_id' => $this->Auth->user('id')])
                ->where(['status IN' => [5, 7]])
                ->first();

            if (!$appointment) {
                return $this->responseJSON(['appointment_id' => 'Agendamento inválido'], 400);
            }

            $data        = ['status' => $status];
            $appointment = $this->Appointments->patchEntity($appointment, $data);
            if ($this->Appointments->save($appointment, ['checkRules' => false])) {
                return $this->responseJSON($appointment, 200);
            } else {
                return $this->responseJSON($appointment->getErrors(), 400);
            }
        }

        return $this->responseJSON(['appointment_id' => 'Agendamento inválido'], 400);
    }

    public function changeState()
    {
        $state_id = $this->request->getQuery('state_id');

        if(!$state_id) {
            return $this->responseJSON(['state_id' => 'Parâmetro é obrigatório'], 400);
        }

        $cities = $this->Cities->getList($state_id);
        return $this->responseJSON($cities, 200);
    }

    public function changeAppointmentStatusToTherapist()
    {
        $appointment_id = $this->request->getData('appointment_id');
        $therapist_id   = $this->request->getData('therapist_id');
        $status         = $this->request->getData('status');

        if ($appointment_id) {
            $appointment = $this->Appointments
                ->find()
                ->where(['id' => $appointment_id])
                ->where(['therapist_id' => $therapist_id])
                ->where(['status IN' => [5]])
                ->first();

            if (!$appointment) {
                return $this->responseJSON(['appointment_id' => 'Agendamento inválido'], 400);
            }

            $data        = ['status' => $status];
            $appointment = $this->Appointments->patchEntity($appointment, $data);
            if ($this->Appointments->save($appointment, ['checkRules' => false])) {
                return $this->responseJSON($appointment, 200);
            } else {
                return $this->responseJSON($appointment->getErrors(), 400);
            }
        }

        return $this->responseJSON(['appointment_id' => 'Agendamento inválido'], 400);
    }


    public function getBlockedSchedules()
    {
        $blockedSchedules = $this->BlockedSchedules->find();
        if ($this->request->getQuery('date_begin') && $this->request->getQuery('date_end')) {
            $begin            = $this->request->getQuery('date_begin');
            $end              = $this->request->getQuery('date_end');
            $blockedSchedules = $blockedSchedules->where([
                'OR' => [
                    ['AND' => [['begin >=' => $begin], ['end <=' => $end]]],
                    ['AND' => [['begin <=' => $begin], ['end >=' => $begin]]],
                    ['AND' => [['begin <=' => $end], ['end >=' => $end]]]
                ]
            ]);
        }
        $blockedSchedules = $blockedSchedules->where(['user_id' => $this->Auth->user('id')]);

        return $this->responseJSON($blockedSchedules, 200);
    }

    public function deleteBlockedSchedules()
    {
        $blockId = $this->request->getData('id');

        $blockedSchedule = $this->BlockedSchedules
            ->find()
            ->where(['id' => $blockId])
            ->where(['user_id' => $this->Auth->user('id')])
            ->first();

        if ($blockedSchedule) {
            $this->BlockedSchedules->delete($blockedSchedule);
            return $this->responseJSON(true, 204);
        } else {
            return $this->responseJSON(['message' => 'Não possível encontrar este bloqueio'], 400);
        }
    }
}























