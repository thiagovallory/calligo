<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\Datasource\EntityInterface;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class BanksTable extends Table
{

    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('banks');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType'   => 'INNER',
        ]);
        $this->belongsTo('FinancialInstitutions', [
            'foreignKey' => 'financial_institution_id',
            'joinType'   => 'INNER',
        ]);
        $this->belongsTo('Cities', [
            'foreignKey' => 'city_id',
            'joinType'   => 'INNER',
        ]);
        $this->belongsTo('States', [
            'foreignKey' => 'state_id',
            'joinType'   => 'INNER',
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name','Campo obrigatório')
            ->notBlank('name', 'Campo obrigatório');

        $validator
            ->scalar('document_number')
            ->maxLength('document_number', 50)
            ->requirePresence('document_number', 'create')
            ->notEmptyString('document_number', 'Campo obrigatório')
            ->notBlank('document_number', 'Campo obrigatório')
            ->add('document_number', 'cpfcnpj', [
                'rule'    => [$this, 'validateCpfCnpj'],
                'message' => 'CPF ou CNPJ inválido'
            ]);

        $validator
            ->scalar('agency')
            ->maxLength('agency', 50)
            ->requirePresence('agency', 'create')
            ->notEmptyString('agency', 'Campo obrigatório')
            ->notBlank('agency', 'Campo obrigatório');

        $validator
            ->scalar('account')
            ->maxLength('account', 50)
            ->requirePresence('account', 'create')
            ->notEmptyString('account', 'Campo obrigatório')
            ->notBlank('account', 'Campo obrigatório');

        $validator
            ->integer('type')
            ->requirePresence('type', 'create')
            ->notEmptyString('type', 'Campo obrigatório')
            ->notBlank('type', 'Campo obrigatório');

        $validator
            ->scalar('financial_institution_id')
            ->requirePresence('financial_institution_id', 'create')
            ->notEmptyString('financial_institution_id', 'Campo obrigatório')
            ->notBlank('financial_institution_id', 'Campo obrigatório');

        $validator
            ->scalar('state_id')
            ->requirePresence('financial_institution_id', 'create')
            ->notEmptyString('financial_institution_id', 'Campo obrigatório')
            ->notBlank('financial_institution_id', 'Campo obrigatório');

        $validator
            ->scalar('city_id')
            ->requirePresence('financial_institution_id', 'create')
            ->notEmptyString('financial_institution_id', 'Campo obrigatório')
            ->notBlank('financial_institution_id', 'Campo obrigatório');

        return $validator;
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);
        $rules->add($rules->existsIn(['financial_institution_id'], 'FinancialInstitutions'), ['errorField' => 'financial_institution_id']);

        return $rules;
    }

    public function validateCpfCnpj($value, $context)
    {
        $cpfcnpj = preg_replace('/[^0-9]/', '', (string)$value);

        if (strlen($cpfcnpj) == 14) {
            return $this->validateCnpj($cpfcnpj, $context);
        }

        if (strlen($cpfcnpj) == 11) {
            return $this->validateCpf($cpfcnpj, $context);
        }

        return false;
    }

    public function validateCnpj($value, $context)
    {
        $cnpj = preg_replace('/[^0-9]/', '', (string)$value);

        if (strlen($cnpj) != 14)
            return false;

        if (preg_match('/(\d)\1{13}/', $cnpj))
            return false;

        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++) {
            $soma += $cnpj[$i] * $j;
            $j    = ($j == 2) ? 9 : $j - 1;
        }

        $resto = $soma % 11;

        if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto)) {
            return false;
        }

        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++) {
            $soma += $cnpj[$i] * $j;
            $j    = ($j == 2) ? 9 : $j - 1;
        }

        $resto = $soma % 11;

        return $cnpj[13] == ($resto < 2 ? 0 : 11 - $resto);
    }

    public function validateCpf($value, $context)
    {
        $cpf = preg_replace('/[^0-9]/is', '', $value);

        if (strlen($cpf) != 11) {
            return false;
        }

        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;
    }
}
