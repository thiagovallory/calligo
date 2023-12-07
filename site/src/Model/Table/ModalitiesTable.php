<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class ModalitiesTable extends Table
{

    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('modalities');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Costs', [
            'foreignKey' => 'modality_id',
        ]);

        $this->hasMany('Appointments', [
            'foreignKey' => 'modality_id',
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
        $modalities = $this->find()
            ->order(['name' => 'ASC'])
            ->all()
            ->toArray();
        $result     = [];

        foreach ($modalities as $key => $obj) {
            $selected         = false;
            $value_full       = 0;
            $value_additional = 0;

            if ($toUser) {
                $key = array_search($obj['id'], array_column($toUser, 'modality_id'));
                if ($key !== false) {
                    $selected         = true;
                    $value_full       = $toUser[$key]['value_full'];
                    $value_additional = $toUser[$key]['value_additional'];
                }
            }

            $result[] = [
                'id'               => $obj['id'],
                'name'             => $obj['name'],
                'selected'         => $selected,
                'value_full'       => $value_full,
                'value_additional' => $value_additional,
            ];
        }

        return $result;
    }

}
