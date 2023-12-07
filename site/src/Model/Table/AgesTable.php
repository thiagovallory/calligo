<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class AgesTable extends Table
{

    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('ages');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsToMany('Users', [
            'foreignKey'       => 'age_id',
            'targetForeignKey' => 'user_id',
            'joinTable'        => 'ages_users',
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 50)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        return $validator;
    }

    public function getList($toUser = null)
    {
        $ages   = $this->find()
            ->order(['name' => 'ASC'])
            ->all()
            ->toArray();
        $result = [];

        foreach ($ages as $key => $obj) {
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
