<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class LangsTable extends Table
{

    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('langs');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsToMany('Users', [
            'foreignKey'       => 'lang_id',
            'targetForeignKey' => 'user_id',
            'joinTable'        => 'langs_users',
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

    public function getAllList()
    {
        $results = $this->find()
            ->order(['name' => 'ASC'])
            ->all()
            ->combine('id', 'name')
            ->toArray();

        return $results;
    }

    public function getList($toUser = null)
    {
        $langs  = $this->find()
            ->order(['name' => 'ASC'])
            ->all()
            ->toArray();
        $result = [];

        foreach ($langs as $key => $obj) {
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
