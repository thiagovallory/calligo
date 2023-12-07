<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\Datasource\EntityInterface;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * IuguCustomerTokens Model
 *
 * @method \App\Model\Entity\IuguCustomerToken newEmptyEntity()
 * @method \App\Model\Entity\IuguCustomerToken newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\IuguCustomerToken[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\IuguCustomerToken get($primaryKey, $options = [])
 * @method \App\Model\Entity\IuguCustomerToken findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\IuguCustomerToken patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\IuguCustomerToken[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\IuguCustomerToken|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\IuguCustomerToken saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\IuguCustomerToken[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\IuguCustomerToken[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\IuguCustomerToken[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\IuguCustomerToken[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class IuguCustomerTokensTable extends Table
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

        $this->setTable('iugu_customer_tokens');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
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
            ->integer('customer_id')
            ->allowEmptyString('customer_id');
        $validator
            ->integer('subaccount_id')
            ->allowEmptyString('subaccount_id');
        $validator
            ->scalar('iugu_udid')
            ->allowEmptyString('iugu_udid');

        return $validator;
    }

    public function listCustomerSubaccounts($customer_id){
        return $this->find('all', [
            'conditions' => [
                'customer_id' => $customer_id
            ]
        ])->get()->toArray();
    }

    public function listSubaccountCustomers($subaccount_id){
        return $this->find('all', [
            'conditions' => [
                'subaccount_id' => $subaccount_id
            ]
        ])->get()->toArray();
    }

    public function getIuguId($customer_id=null, $subaccount_id=null){
        if( ($subaccount_id!=null) && ($customer_id!=null) &&
            (($item = $this->find('all', ['conditions' => ['customer_id' => $customer_id,'subaccount_id' => $subaccount_id]])->count()) != 0)){
            $item = $this->find('all', [
                'conditions' => [
                    'customer_id' => $customer_id,
                    'subaccount_id' => $subaccount_id
                ]
            ])->first();
            return $item->iugu_udid;
        }
        return '';
    }

    public function is_match($customer_id, $subaccount_id){
        $match = $this->find('all', [
            'conditions' => [
                'customer_id' => $customer_id,
                'subaccount_id' => $subaccount_id
            ]
        ])->first();

        if(empty($match))
            return false;
        return true;
    }
}
