<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * HelpQuestions Model
 *
 * @method \App\Model\Entity\HelpQuestion newEmptyEntity()
 * @method \App\Model\Entity\HelpQuestion newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\HelpQuestion[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\HelpQuestion get($primaryKey, $options = [])
 * @method \App\Model\Entity\HelpQuestion findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\HelpQuestion patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\HelpQuestion[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\HelpQuestion|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\HelpQuestion saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\HelpQuestion[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\HelpQuestion[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\HelpQuestion[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\HelpQuestion[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class HelpQuestionsTable extends Table
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

        $this->setTable('help_questions');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->notEmptyString('name');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email');

        $validator
            ->scalar('telephone')
            ->maxLength('telephone', 19)
            ->requirePresence('telephone', 'create')
            ->notEmptyString('telephone')
            ->add('telephone', 'telephone', [
                'rule'    => [$this, 'validateTelephoneNumber'],
                'message' => 'Telefone é inválido'
            ]);

        $validator
            ->scalar('message')
            ->requirePresence('message', 'create')
            ->notEmptyString('message');

        return $validator;
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
