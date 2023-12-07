<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\Datasource\EntityInterface;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EmergencyContacts Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\EmergencyContact newEmptyEntity()
 * @method \App\Model\Entity\EmergencyContact newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\EmergencyContact[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EmergencyContact get($primaryKey, $options = [])
 * @method \App\Model\Entity\EmergencyContact findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\EmergencyContact patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EmergencyContact[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\EmergencyContact|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EmergencyContact saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EmergencyContact[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\EmergencyContact[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\EmergencyContact[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\EmergencyContact[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EmergencyContactsTable extends Table
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

        $this->setTable('emergency_contacts');
        $this->setDisplayField('name');
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
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->allowEmptyString('name');

        $validator
            ->scalar('telephone_number')
            ->maxLength('telephone_number', 255)
            ->allowEmptyString('telephone_number')
            ->add('telephone_number', 'telephone_number', [
                'rule'    => [$this, 'validateTelephoneNumber'],
                'message' => 'Telefone é inválido'
            ]);

        $validator
            ->email('email')
            ->allowEmptyString('email');

        $validator
            ->integer('gender')
            ->allowEmptyString('gender');

        $validator
            ->integer('pronoun')
            ->allowEmptyString('pronoun');

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

    public function validateTelephoneNumber($value, $context)
    {
        $phone_number = trim(str_replace([' ', '-', '(', ')'], '', $value));

        $regexTelephone = "/[0-9]{10,11}/";
        if (preg_match($regexTelephone, $phone_number)) {
            return true;
        } else {
            return false;
        }
    }
}
