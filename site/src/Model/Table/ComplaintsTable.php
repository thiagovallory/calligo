<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class ComplaintsTable extends Table
{
   
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('complaints');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Therapist', [
            'foreignKey' => 'therapist_id',
            'joinType' => 'INNER',
            'className'  => 'Users'
        ]);
        $this->belongsTo('Patient', [
            'foreignKey' => 'patient_id',
            'joinType' => 'INNER',
            'className'  => 'Users'
        ]);
        $this->hasMany('ComplaintSelecteds', [
            'foreignKey' => 'complaint_id',
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        return $validator;
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['therapist_id'], 'Therapist'), ['errorField' => 'therapist_id']);
        $rules->add($rules->existsIn(['patient_id'], 'Patient'), ['errorField' => 'patient_id']);

        return $rules;
    }
}
