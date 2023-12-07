<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\I18n\FrozenDate;

/**
 * BlockedSchedules Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\BlockedSchedule newEmptyEntity()
 * @method \App\Model\Entity\BlockedSchedule newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\BlockedSchedule[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BlockedSchedule get($primaryKey, $options = [])
 * @method \App\Model\Entity\BlockedSchedule findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\BlockedSchedule patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BlockedSchedule[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\BlockedSchedule|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BlockedSchedule saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BlockedSchedule[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\BlockedSchedule[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\BlockedSchedule[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\BlockedSchedule[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BlockedSchedulesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('blocked_schedules');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType'   => 'INNER',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->dateTime('begin')
            ->requirePresence('begin', 'create')
            ->notEmptyDateTime('begin');

        $validator
            ->dateTime('end')
            ->requirePresence('end', 'create')
            ->notEmptyDateTime('end')
            ->add('end', 'end', [
                'rule'    => [$this, 'validRange'],
                'message' => 'Intervalo inválido'
            ]);

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }

    public function validRange($value, $context)
    {
        $begin = $context['data']['begin'];

        return ($value > $begin);
    }

    public function getWeekBlocks($id, $inital_date)
    {
        $begin = new FrozenDate($inital_date);
        $end   = $begin->addDays(7);

        $blocks = $this
            ->find()
            ->where(['user_id' => $id])
            ->where([
                'OR' => [
                    ['AND' => [['begin >=' => $begin], ['end <=' => $end]]],
                    ['AND' => [['begin <=' => $begin], ['end >=' => $begin]]],
                    ['AND' => [['begin <=' => $end], ['end >=' => $end]]]
                ]
            ])
            ->toArray();

        return $blocks;
    }

    public function isScheduleBlocked($id, $datetime)
    {
        $blocks = $this
            ->find()
            ->where(['user_id' => $id])
            ->where(['begin <=' => $datetime])
            ->where(['end >=' => $datetime])->count();

        return ($blocks > 0);
    }

}
