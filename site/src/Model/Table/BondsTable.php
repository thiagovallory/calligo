<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\I18n\Date;
use Cake\I18n\FrozenTime;
use Cake\ORM\TableRegistry;

class BondsTable extends Table
{

    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('bonds');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

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
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->integer('status')
            ->notEmptyString('status');

        $validator
            ->dateTime('started_at')
            ->allowEmptyDateTime('started_at');

        $validator
            ->dateTime('ended_at')
            ->allowEmptyDateTime('ended_at');

        return $validator;
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['therapist_id'], 'Therapist'), ['errorField' => 'therapist_id']);
        $rules->add($rules->existsIn(['patient_id'], 'Patient'), ['errorField' => 'patient_id']);

        return $rules;
    }

    public function setActive($therapist_id, $patient_id)
    {
        $bond = $this->find()
            ->where([
                'therapist_id' => $therapist_id,
                'patient_id'   => $patient_id,
                'status'       => 1,
            ])
            ->order(['id' => 'DESC'])
            ->first();
        if ($bond) {
            $update             = $this->get($bond->id);
            $update->status     = 2;
            $update->started_at = date('Y-m-d H:i:s');
            if ($this->save($update)) {
                return true;
            }
        }

        return false;
    }

    // public function setCancelBondActual($patient_id)
    // {
    //     $bondActiveOrPending = $bond = $this->find()
    //         ->where([
    //             'patient_id' => $patient_id,
    //             'status <'   => 3,
    //         ])
    //         ->order(['id' => 'DESC'])
    //         ->first();

    //     if ($bondActiveOrPending) {
    //         $update           = $this->get($bondActiveOrPending->id);
    //         $update->status   = 3;
    //         $update->ended_at = date('Y-m-d H:i:s');
    //         if (!$this->save($update)) {
    //             return false;
    //         }
    //     }

    //     return true;
    // }

    public function isRuleAssociatedOtherTherapistBond($patient_id, $therapist_id){
        return $this->find()
            ->where([
                'therapist_id !=' => $therapist_id,
                'patient_id'   => $patient_id,
                'status <'    => 3
            ])
            ->count();
    }

    public function isRuleExistBond($patient_id, $therapist_id){
        return $this->find()
            ->where([
                'therapist_id' => $therapist_id,
                'patient_id'   => $patient_id,
                'status >'    => 1
            ])
            ->count();
    }

    public function isRuleIsPatientByTherapist($patient_id, $therapist_id)
    {
        return $this->find()
            ->where([
                'therapist_id' => $therapist_id,
                'patient_id'   => $patient_id,
                'status'       => 2
            ])
            ->count();
    }

    public function createBlondPending($therapist_id, $patient_id)
    {
        $data = [
            'therapist_id' => $therapist_id,
            'patient_id'   => $patient_id,
            'status'       => 1
        ];
        $bond = $this->newEmptyEntity();
        $bond = $this->patchEntity($bond, $data);
        return $this->save($bond);
    }

    public function getQueryClients($therapist_id,$param_filters)
    {
        $conditions = [];
        $conditions[] = ['Bonds.therapist_id' => $therapist_id];
        $conditions[] = ['Patient.role' => $param_filters['role']];

        switch ($param_filters['order']) {
            case 'name':
                $order = ['Patient.name' => 'ASC'];
                break;
            case 'name-desc':
                $order = ['Patient.name' => 'DESC'];
                break;
            case 'date':
                $order = ['Bonds.started_at' => 'DESC'];
                break;
            case 'date-desc':
                $order = ['Bonds.started_at' => 'ASC'];
                break;
            default:
                $order = ['Patient.name' => 'ASC'];
                break;
        }

        switch ($param_filters['active']) {
            case 'y':
                $conditions[] = ['Bonds.status' => 2];
                break;
            case 'n':
                $conditions[] = ['Bonds.status' => 3];
                break;
            case 'week':
                $conditions[] = ['Bonds.started_at >' => new \DateTime('-7 days')];
                break;
            case 'month':
                $conditions[] = ['Bonds.started_at >' => new \DateTime('-30 days')];
                break;
            case 'year':
                $conditions[] = ['YEAR(Bonds.started_at)' => date('Y')];
                break;
            default:
                $conditions[] = ['Bonds.status' => 2];
                break;
        }

        if ($param_filters['search']){
            $conditions[] = ['Patient.name LIKE' => '%' . $param_filters['search'] . '%'];
        }

        return $this->find()
            ->where($conditions)
            ->contain([
                'Patient.Problems',
                'Patient.Profiles',
                'Patient.AppointmentsReceived'=> function ($q) {
                    return $q
                         ->where(['status' => 1])
                         ->order([
                            'day'  => 'ASC',
                            'hour' => 'ASC'
                         ]);
                 }
            ])
            ->order($order);
    }

    public function setEndTherapy($data, $who)
    {
        $bondActive = $this->find()
            ->where([
                'patient_id'    => $data['patient_id'],
                'therapist_id'  => $data['therapist_id'],
                'status'        => 2,
            ])
            ->order(['id' => 'DESC'])
            ->first();

        if (!$bondActive) {
            return false;
        }

        $update = $this->get($bondActive->id);
        $update->status                     = 3;
        $update->ended_at                   = date('Y-m-d H:i:s');
        $update->closing_description        = $data['closing_description'];
        $update->closing_patient_at_risk    = $data['closing_patient_at_risk'];
        $update->closing_file_name          = $data['closing_file_name'];
        $update->closing_file_url           = $data['closing_file_url'];
        $update->closing_file_size          = $data['closing_file_size'];

        if (!$this->save($update)) {
            return false;
        }
        $this->Records = TableRegistry::get('Records');
        $patient = $this->Patient->get($data['patient_id']);
        $therapist = $this->Therapist->get($data['therapist_id']);

        if ($who=='therapist'){
            $description = $therapist->name.' encerrou terapia com '.$patient->name;
        } else {
            $description = $patient->name.' encerrou terapia com '.$therapist->name;
        }

        $rec = $this->Records->newEmptyEntity();
        $newRec                         = [];
        $newRec['name']                 = 'Terapia Encerrada';
        $newRec['description']          = $description;
        $newRec['type_of_record_id']    = 1;
        $newRec['private']              = 1;
        $newRec['owner_id']             = $data['therapist_id'];
        $newRec['patient_id']           = $data['patient_id'];

        $rec = $this->Records->patchEntity($rec, $newRec);
        $this->Records->save($rec);

        return true;
    }

    public function getInfos($patient_id, $therapist_id){
        return $this->find()
            ->where([
                'Bonds.patient_id'    => $patient_id,
                'Bonds.therapist_id'  => $therapist_id,
            ])
            ->order(['Bonds.id' => 'DESC'])
            ->contain(['Patient','Therapist'])
            ->first()
            ->toArray();

    }

    public function getRecordDateLimit($patient_id, $therapist_id){
        $bond = $this->find()
            ->where([
                'Bonds.patient_id'    => $patient_id,
                'Bonds.therapist_id'  => $therapist_id,
            ])
            ->order(['Bonds.id' => 'DESC'])
            ->first();

        if ($bond && $bond->ended_at){
            return $bond->ended_at->i18nFormat('yyyy-MM-dd HH:mm:ss');
        } else {
            return FrozenTime::now()->i18nFormat('yyyy-MM-dd HH:mm:ss');
        }
    }

    public function getMyTherapist($patient_id){
        return $this->find()
            ->where([
                'Bonds.patient_id'  => $patient_id,
                'Bonds.status'      => 2,
            ])
            ->order(['Bonds.id' => 'DESC'])
            ->contain([
                'Patient.AppointmentsReceived'=> function ($q) {
                    return $q
                        ->where([
                            'status' => 1,
                            'day >=' => date('Y-m-d')
                        ])
                        ->order([
                            'day'  => 'ASC',
                            'hour' => 'ASC'
                        ]);
                 },
                'Therapist' => ['Profiles', 'Costs' => ['Modalities']]
            ])
            ->first();

    }

}
