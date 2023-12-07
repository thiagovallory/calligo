<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;
use Cake\I18n\Date;

class AppointmentsTable extends Table
{

    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('appointments');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Modalities', [
            'foreignKey' => 'modality_id',
            'joinType'   => 'INNER',
        ]);
        $this->belongsTo('Therapist', [
            'foreignKey' => 'therapist_id',
            'joinType'   => 'INNER',
            'className'  => 'Users'
        ]);
        $this->belongsTo('Patient', [
            'foreignKey' => 'patient_id',
            'joinType'   => 'INNER',
            'className'  => 'Users'
        ]);

        $this->hasOne('Invoices', [
            'foreignKey' => 'appointment_id',
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->integer('mode')
            ->requirePresence('mode', 'create');

        return $validator;
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['modality_id'], 'Modalities'), ['errorField' => 'modality_id']);
        $rules->add($rules->existsIn(['therapist_id'], 'Therapist'), ['errorField' => 'therapist_id']);
        $rules->add($rules->existsIn(['patient_id'], 'Patient'), ['errorField' => 'patient_id']);
        $rules->add(function ($entity, $options) { // verifica se horário está disponível
            $appointments = $this
                ->find()
                ->where([
                    'therapist_id' => $entity->therapist_id,
                    'day'          => $entity->day->format('Y-m-d'),
                    'hour'         => $entity->hour->format('H:i:s'),
                    'status !='    => 6
                ])->count();
            return !($appointments > 0);
        }, [
            'errorField' => 'hour',
            'message'    => 'Horário indisponível'
        ]);
//        $rules->add(function ($entity, $options) { // verifica se paciente já tem consulta no mesmo dia com mesmo terapeuta
//            $appointments = $this
//                ->find()
//                ->where([
//                    'therapist_id'  => $entity->therapist_id,
//                    'day'           => $entity->day,
//                    'patient_id'    => $entity->patient_id,
//                    'status NOT IN' => [5, 6]
//                ])->count();
//            return !($appointments > 0);
//        }, [
//            'errorField' => 'patient_id',
//            'message'    => 'Paciente já tem uma consulta nesse dia'
//        ]);
        $rules->add(function ($entity, $options) { // verifica se horário está disponível
            $hour             = $entity->day->format('Y-m-d') . ' ' . $entity->hour->format('H:i:s');
            $blockedSchedules = TableRegistry::getTableLocator()->get('BlockedSchedules');
            $blocks           = $blockedSchedules
                ->find()
                ->where(['user_id' => $entity->therapist_id])
                ->where(['begin <=' => $hour])
                ->where(['end >=' => $hour])->count();
            return !($blocks > 0);
        }, [
            'errorField' => 'patient_id',
            'message'    => 'O horário está bloqueado'
        ]);
        $rules->add(function ($entity, $options) { // verifica se horário está disponível
            return !($entity->therapist_id == $entity->patient_id);
        }, [
            'errorField' => 'patient_id',
            'message'    => 'Não é possível marcar consulta para si mesmo.'
        ]);
        return $rules;
    }

    public function getWeekAppointments($profile_id, $initial_date)
    {
        return $this->find('all', [
            'fields'     => ['therapist_id', 'hour', 'day'],
            'conditions' => [
                'therapist_id' => $profile_id,
                "day >="       => $initial_date,
                "day <"        => (new \DateTime($initial_date))->add(new \DateInterval('P7D'))->format('Y-m-d')
            ]
        ])->toArray();
    }

    public function isRuleIsPatientByTherapist($patient_id, $therapist_id)
    {
        return $this->find()
            ->where([
                'therapist_id' => $therapist_id,
                'patient_id'   => $patient_id,
                'status'       => 5
            ])
            ->count();
    }

    public function isRulePatientOwner($appointment_id, $pacient_id)
    {
        return $this->find()
            ->where([
                'id'         => $appointment_id,
                'patient_id' => $pacient_id
            ])
            ->count();
    }

    public function isRuleTherapistOwner($appointment_id, $therapist_id)
    {
        return $this->find()
            ->where([
                'id'           => $appointment_id,
                'therapist_id' => $therapist_id
            ])
            ->count();
    }

    public function isRuleApprovalNewStatus($status)
    {
        if (($status == 4) || ($status == 6)) {
            return true;
        }
        return false;
    }

    public function isRuleApprovalCurrentStatus($appointment_id)
    {
        return $this->find()
            ->where([
                'id'     => $appointment_id,
                'status' => 2
            ])
            ->count();
    }

    public function isRulePaymentReleased($appointment_id)
    {
        return $this->find()
            ->where([
                'id'     => $appointment_id,
                'status' => 4
            ])
            ->count();
    }



    public function getQueryWaitingTherapist($therapist_id)
    {
        return $this->find()
            ->where([
                'Appointments.therapist_id' => $therapist_id,
                'Appointments.status'       => 2
            ])
            ->contain(['Patient.Problems', 'Modalities'])
            ->order(['Appointments.created' => 'DESC']);
    }

    public function getCalendar($user_id, $role, $period)
    {
        $date = new Date($period . '-01');
        if ($role == 2) {
            return $this->find()
                ->where([
                    'Appointments.therapist_id' => $user_id,
                    'MONTH(day)'                => $date->format('m'),
                    'YEAR(day)'                 => $date->format('Y')
                ])
                ->contain(['Patient' => ['Profiles'], 'Modalities'])
                ->order([
                    'Appointments.day'  => 'ASC',
                    'Appointments.hour' => 'ASC'
                ])->toArray();
        } elseif ($role == 1) {
            return $this->find()
                ->where([
                    'Appointments.patient_id' => $user_id,
                    'MONTH(day)'              => $date->format('m'),
                    'YEAR(day)'               => $date->format('Y'),
                ])
                ->contain(['Therapist' => ['Profiles'], 'Modalities'])
                ->order([
                    'Appointments.day'  => 'ASC',
                    'Appointments.hour' => 'ASC'
                ])->toArray();
        }
    }

    public function getCancelAppointmentsForNonPayment(){
        return $this->find()
            ->where([
                'status' => 4,
                'reserved_until <='      => date('Y-m-d H:i:s')

            ])
            ->contain(['Patient'])
            ->toArray();
    }

    public function setCancelAppointmentsForNonPayment($id){

        $app = $this->get($id);
        $app = $this->patchEntity($app, ['status'=>6]);
        return $this->save($app, ['checkRules' => false]);
    }

}
