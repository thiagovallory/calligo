<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\Core\Configure;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class ScheduleSettingsTable extends Table
{

    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('schedule_settings');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType'   => 'INNER',
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('day_name')
            ->maxLength('day_name', 3)
            ->requirePresence('day_name', 'create')
            ->notEmptyString('day_name');

        $validator
            ->integer('day_index')
            ->requirePresence('day_index', 'create')
            ->notEmptyString('day_index');

        $validator
            ->time('hour_start')
            ->requirePresence('hour_start', 'create')
            ->notEmptyTime('hour_start');

        return $validator;
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }

    public function getList($user_id)
    {
        $settings = $this->find()
            ->order(['day_index' => 'ASC', 'hour_start' => 'ASC'])
            ->where(['user_id' => $user_id])
            ->all()
            ->toArray();

        $return = [0 => [], 1 => [], 2 => [], 3 => [], 4 => [], 5 => [], 6 => []];
        foreach ($settings as $key => $obj) {
            $return[$obj['day_index']][] = $obj;
        }

        return $return;
    }
}
