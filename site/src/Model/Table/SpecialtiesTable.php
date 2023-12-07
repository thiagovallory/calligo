<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class SpecialtiesTable extends Table
{

    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('specialties');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsToMany('Users', [
            'foreignKey'       => 'specialty_id',
            'targetForeignKey' => 'user_id',
            'joinTable'        => 'specialties_users',
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 45)
            ->requirePresence('name', 'create')
            ->notEmptyString('name')
            ->add('name', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        return $validator;
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['name']), ['errorField' => 'name']);

        return $rules;
    }

    public function getList($toUser = null)
    {
        $specialties = $this->find()
            ->order(['name' => 'ASC'])
            ->all()
            ->toArray();
        $result      = [];

        foreach ($specialties as $key => $obj) {
            if ($toUser) {
                $key      = array_search($obj['id'], array_column($toUser, 'id'));
                $selected = ($key !== false) ? true : false;
            } else {
                $selected = false;
            }

            $result[] = [
                'id'       => $obj['id'],
                'name'     => $obj['name'],
                'selected' => $selected
            ];
        }
        return $result;
    }
}
