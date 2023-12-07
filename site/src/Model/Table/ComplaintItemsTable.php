<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class ComplaintItemsTable extends Table
{

    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('complaint_items');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('ComplaintSelecteds', [
            'foreignKey' => 'complaint_item_id',
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

        return $validator;
    }

    public function getAll($role)
    {
        return $this->find()
            ->where(['role' => $role])
            ->order(['name' => 'ASC'])
            ->all();
    }
}
