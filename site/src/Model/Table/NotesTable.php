<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

class NotesTable extends Table
{

    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('notes');
        $this->setDisplayField('description');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Owner', [
            'foreignKey' => 'owner_id',
            'joinType' => 'INNER',
            'className'=>'Users'
        ]);
        $this->belongsTo('Patient', [
            'foreignKey' => 'patient_id',
            'joinType' => 'INNER',
            'className'=>'Users'
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        return $validator;
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
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

    public function getMyNotes($patient_id, $user_id, $param=null){
        $conditions=[];
        $conditions[]=['Notes.owner_id' => $user_id];
        $conditions[]=['Notes.patient_id' => $patient_id];

        $this->Bonds = TableRegistry::get('Bonds');
        $limit = $this->Bonds->getRecordDateLimit($patient_id, $user_id);
        $conditions[]=['Notes.created <=' => $limit];

        if ($param['text']){
            $conditions[] =['Notes.description LIKE' => '%'.$param['text'].'%'];
        }

        return $this->find()
            ->where($conditions)
            ->all()
            ->toArray();
    }

    public function getLastNote($patient_id, $owner_id){
        $this->Bonds = TableRegistry::get('Bonds');
        $limit = $this->Bonds->getRecordDateLimit($patient_id, $owner_id);
        
        return $this->find()
            ->where([
                'patient_id'=>$patient_id,
                'owner_id'=>$owner_id,
                'created <='=>$limit
            ])
            ->order(['id' => 'DESC'])
            ->first();
    }
}
