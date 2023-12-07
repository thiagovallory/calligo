<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\Datasource\EntityInterface;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class CostsTable extends Table
{

    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('costs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType'   => 'INNER',
        ]);
        $this->belongsTo('Modalities', [
            'foreignKey' => 'modality_id',
            'joinType'   => 'INNER',
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->decimal('value_full')
            ->requirePresence('value_full', 'create', 'Valor é obrigatório')
            ->notEmptyString('value_full', 'Valor é obrigatório')
            ->notBlank('value_full', 'Valor é obrigatório');

        $validator
            ->decimal('value_additional')
            ->allowEmptyString('value_additional', 'Valor é obrigatório');

        return $validator;
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);
        $rules->add($rules->existsIn(['modality_id'], 'Modalities'), ['errorField' => 'modality_id']);

        return $rules;
    }

    public function getToMaxPrice(){
        $cost = $this->find()
                    ->order(['value_full'=>'DESC'])
                    ->first();
        if ($cost){
            return $cost->value_full;
        } else {
            return 0;
        }
    }
}
