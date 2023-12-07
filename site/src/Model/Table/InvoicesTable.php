<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class InvoicesTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('invoices');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Appointments', [
            'foreignKey' => 'appointment_id',
            'joinType' => 'INNER',
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('iugu_udid')
            ->maxLength('iugu_udid', 45)
            ->allowEmptyString('iugu_udid');

        $validator
            ->scalar('iugu_url')
            ->maxLength('iugu_url', 255)
            ->allowEmptyString('iugu_url');

        return $validator;
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['appointment_id'], 'Appointments'), ['errorField' => 'appointment_id']);

        return $rules;
    }

    public function getQueryHistory($user_id, $order_index){
        switch ($order_index) {
            case 0:
                $order = ['Invoices.created'=>'DESC'];
                break;
            case 1:
                $order = ['Invoices.created'=>'ASC'];
                break;
            case 2:
                $order = ['Appointments.price'=>'DESC'];
                break;
            case 3:
                $order = ['Appointments.price'=>'ASC'];
                break;
            default:
                $order = ['Invoices.created'=>'DESC'];
                break;
        }
        return $this->find()
            ->where(['Appointments.patient_id'=>$user_id])
            ->contain(['Appointments.Therapist'])
            ->order($order);
    }

    public function getQueryFinancial($user_id, $order_index, $finacialType){
        switch ($order_index) {
            case 0:
                $order = ['Invoices.created'=>'DESC'];
                break;
            case 1:
                $order = ['Invoices.created'=>'ASC'];
                break;
            case 2:
                $order = ['Appointments.price'=>'DESC'];
                break;
            case 3:
                $order = ['Appointments.price'=>'ASC'];
                break;
            default:
                $order = ['Invoices.created'=>'DESC'];
                break;
        }
        if($finacialType != 0){
            return $this->find()
                ->where(['Appointments.therapist_id'=>$user_id, 'Invoices.status'=>$finacialType])
                ->contain(['Appointments.Patient', 'Appointments.Modalities'])
                ->order($order);
        }
        return $this->find()
                ->where(['Appointments.therapist_id'=>$user_id])
                ->contain(['Appointments.Patient', 'Appointments.Modalities'])
                ->order($order);
    }

    
}
