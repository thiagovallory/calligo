<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Reasons Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsToMany $Users
 *
 * @method \App\Model\Entity\Reason newEmptyEntity()
 * @method \App\Model\Entity\Reason newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Reason[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Reason get($primaryKey, $options = [])
 * @method \App\Model\Entity\Reason findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Reason patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Reason[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Reason|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Reason saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Reason[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Reason[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Reason[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Reason[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ReasonsTable extends Table
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

        $this->setTable('reasons');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('ReasonsUsers', [
            'foreignKey'       => 'reason_id',
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
            ->scalar('name')
            ->maxLength('name', 45)
            ->allowEmptyString('name');

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
