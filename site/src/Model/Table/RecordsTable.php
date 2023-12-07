<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;
use Cake\Utility\Hash;
use Cake\I18n\Date;

class RecordsTable extends Table
{

    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('records');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('TypeOfRecords', [
            'foreignKey' => 'type_of_record_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Owner', [
            'foreignKey' => 'owner_id',
            'joinType' => 'INNER',
            'className'  => 'Users'
        ]);
        $this->belongsTo('Patient', [
            'foreignKey' => 'patient_id',
            'joinType' => 'INNER',
            'className'  => 'Users'
        ]);
        $this->hasMany('Docs', [
            'foreignKey' => 'record_id',
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        $validator
            ->integer('private')
            ->requirePresence('private', 'create')
            ->notEmptyString('private');

        return $validator;
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['type_of_record_id'], 'TypeOfRecords'), ['errorField' => 'type_of_record_id']);
        $rules->add($rules->existsIn(['owner_id'], 'Owner'), ['errorField' => 'owner_id']);
        $rules->add($rules->existsIn(['patient_id'], 'Patient'), ['errorField' => 'patient_id']);

        return $rules;
    }

    public function getRuleChange($id, $user_id){
        return $this->find()
            ->where([
                'id'=>$id,
                'owner_id' => $user_id
            ])
            ->count();
    }

    // public function getMyDocs($patient_id, $user_id, $param=null){
    //     $conditions=[];
    //     $conditions[]=['Docs.owner_id' => $user_id];
    //     $conditions[]=['Docs.patient_id' => $patient_id];

    //     if ($param['text']){
    //         $conditions[] = [
    //             'OR' => [
    //                 ['Docs.name LIKE' => '%'.$param['text'].'%'],
    //                 ['Docs.url LIKE' => '%'.$param['text'].'%'],
    //                 ['TypeOfDocuments.name LIKE' => '%'.$param['text'].'%']
    //             ]];
    //     }

    //     return $this->find()
    //         ->where($conditions)
    //         ->contain(['TypeOfDocuments'])
    //         ->all()
    //         ->toArray();
    // }

    // public function getShareDocs($user_id, $param=null){
    //     $conditions=[];
    //     $conditions[]=[
    //         'Docs.owner_id !='   => $user_id,
    //         'Docs.patient_id'    => $user_id,
    //         'Docs.private'       => 0
    //     ];

    //     if ($param['text']){
    //         $conditions[] = [
    //             'OR' => [
    //                 ['Docs.name LIKE' => '%'.$param['text'].'%'],
    //                 ['Docs.url LIKE' => '%'.$param['text'].'%'],
    //                 ['TypeOfDocuments.name LIKE' => '%'.$param['text'].'%']
    //             ]];
    //     }

    //     return $this->find()
    //     ->where($conditions)
    //     ->contain(['TypeOfDocuments'])
    //     ->all()
    //     ->toArray();
    // }

    // public function setAlterPrivateOrShared($id){
    //     $rec = $this->get($id);

    //     if (!$rec){
    //         return false;
    //     }

    //     $rec->private = ($rec->private==1) ? 0 : 1;
    //     return $this->save($rec);
    // }

    // public function getSummaryList($patient_id, $user_id){
    //     $limit = 7;

    //     $condShared = [
    //         'Docs.owner_id !='   => $patient_id,
    //         'Docs.patient_id'    => $patient_id,
    //         'Docs.private'       => 0
    //     ];
    //     $shared = $this->find()
    //             ->where($condShared)
    //             ->order(['id' => 'DESC'])
    //             ->limit($limit)
    //             ->all()
    //             ->toArray();
    //     $ids_shared = [];
    //     foreach ($shared as $key => $obj) {
    //         $ids_shared[$obj['id']] = $obj['id'];
    //     }

    //     $condMy[] = [
    //         'Docs.owner_id' => $user_id,
    //         'Docs.patient_id' => $patient_id,
    //     ];
    //     if ($ids_shared){
    //         $condMy[] = ['Docs.id NOT IN'=>$ids_shared];
    //     }

    //     $my = $this->find()
    //             ->where($condMy)
    //             ->order(['id' => 'DESC'])
    //             ->limit($limit)
    //             ->all()
    //             ->toArray();

    //     $all = array_merge($shared,$my);
    //     $all = Hash::sort($all, '{n}.id', 'DESC');
    //     $all = array_slice($all, 0, $limit);

    //     return $all;

    // }

    public function getAll($patient_id, $therapist_id=null, $param_filters, $publicOnly = false){
        $conditions = [];
        $conditions[] = ['Records.patient_id' => $patient_id];

        if ($therapist_id){
            $this->Bonds = TableRegistry::get('Bonds');
            $limitCreated = $this->Bonds->getRecordDateLimit($patient_id, $therapist_id);
            $conditions[] = ['Records.created <=' => $limitCreated];
        }

        if($publicOnly) {
            $conditions[] = ['Records.private' => 0];
        }

        if ($param_filters['type']){
            $conditions[] = ['Records.type_of_record_id' => $param_filters['type']];
        }

        if ($param_filters['asc']){
            $order = ['Records.created' => $param_filters['asc']];
        } else {
            $order = ['Records.created' => 'DESC'];
        }

        switch ($param_filters['order_date']) {
            case 'week':
                $conditions[] = ['Records.created >' => new \DateTime('-7 days')];
                break;
            case 'month':
                $conditions[] = ['Records.created >' => new \DateTime('-30 days')];
                break;
            case 'year':
                $conditions[] = ['YEAR(Records.created)' => date('Y')];
                break;
        }

        return $this->find()
            ->where($conditions)
            ->contain([
                'TypeOfRecords',
                'Owner.Profiles'
            ])
            ->order($order)
            ->all();
    }
}
