<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\Datasource\EntityInterface;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class CardsTable extends Table
{

    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('cards');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

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
            ->integer('is_main')
            ->allowEmptyString('is_main');

        $validator
            ->scalar('card_number')
            ->maxLength('card_number', 30)
            ->requirePresence('card_number', 'create')
            ->notEmptyString('card_number');

        $validator
            ->scalar('owner_name')
            ->maxLength('owner_name', 255)
            ->requirePresence('owner_name', 'create')
            ->notEmptyString('owner_name');

        $validator
            ->scalar('owner_cpf')
            ->maxLength('owner_cpf', 14)
            ->requirePresence('owner_cpf', 'create')
            ->notEmptyString('owner_cpf');

        $validator
            ->date('expiration_date')
            ->requirePresence('expiration_date', 'create')
            ->notEmptyDate('expiration_date');

        $validator
            ->scalar('cvv')
            ->maxLength('cvv', 3)
            ->requirePresence('cvv', 'create')
            ->notEmptyString('cvv');

        $validator
            ->scalar('address')
            ->maxLength('address', 100)
            ->requirePresence('address', 'create')
            ->notEmptyString('address');

        $validator
            ->scalar('address_number')
            ->maxLength('address_number', 10)
            ->requirePresence('address_number', 'create')
            ->notEmptyString('address_number');

        $validator
            ->scalar('neighborhood')
            ->maxLength('neighborhood', 100)
            ->requirePresence('neighborhood', 'create')
            ->notEmptyString('neighborhood');

        $validator
            ->scalar('complement')
            ->maxLength('complement', 45)
            ->requirePresence('complement', 'create')
            ->notEmptyString('complement');

        $validator
            ->scalar('zip_code')
            ->maxLength('zip_code', 9)
            ->requirePresence('zip_code', 'create')
            ->notEmptyString('zip_code');

        $validator
            ->integer('city_id')
            ->requirePresence('city_id', 'create')
            ->notEmptyString('city_id');

        $validator
            ->integer('state_id')
            ->requirePresence('state_id', 'create')
            ->notEmptyString('state_id');

        $validator
            ->scalar('phone')
            ->maxLength('phone', 13)
            ->requirePresence('phone', 'create')
            ->notEmptyString('phone');
        return $validator;
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }

    public function listCards(){
        $cards = $this->Cards->find('all',['conditions' => ['user_id' => $this->Auth->user('id')]])->toArray();
        $this->set('cards',$cards);
    }

    public function splitNames($name){
        return explode(' ', $name, 2);
    }

    public function splitExpiration($date){
        return explode('-', $date);
    }

    public function getBrand($number){
        $brand = substr($number, 0, 1);
        switch($brand){
            case '3':
                return 'american express';
                break;
            case '4':
                return 'visa';
                break;
            case '5':
                return 'mastercard';
                break;
            case '6':
                return 'discover card';
                break;
            default:
                return 'desconhecido';
        }
    }

    public function maskNumber($number){
        $res = substr($number, 0, 5);
        return $res.'...';
    }
}
