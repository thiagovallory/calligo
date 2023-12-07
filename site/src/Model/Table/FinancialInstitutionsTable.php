<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class FinancialInstitutionsTable extends Table
{

    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('financial_institutions');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Banks', [
            'foreignKey' => 'financial_institution_id',
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

        return $validator;
    }

    public function getList()
    {
        $results = $this->find()
            ->order(['name' => 'ASC'])
            ->all()
            ->combine('id', 'name')
            ->toArray();

        return $results;
    }
}
