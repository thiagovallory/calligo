<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class HelpsTable extends Table
{

    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('helps');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('SubjectHelps', [
            'foreignKey' => 'subject_help_id',
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
            ->notEmptyString('name');

        $validator
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        $validator
            ->integer('role')
            ->allowEmptyString('role');

        return $validator;
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['subject_help_id'], 'SubjectHelps'), ['errorField' => 'subject_help_id']);

        return $rules;
    }

    public function getAll($role)
    {
        $subjects = $this->SubjectHelps->find()->all()->toArray();
        $return   = [];
        foreach ($subjects as $key => $sub) {
            $helps = $this->find()
                ->where([
                    [
                        'subject_help_id' => $sub['id']
                    ],
                    [
                        'OR' => [
                            ['role' => $role],
                            ['role' => 3]
                        ]
                    ]
                ])
                ->all()
                ->toArray();
            if ($helps) {
                $return[] = [
                    'subject_help' => $sub,
                    'helps'        => $helps
                ];
            }
        }

        return $return;
    }

    public function getSearch($text=null)
    {
        $subjects = $this->SubjectHelps->find()->all()->toArray();
        $return   = [];
        foreach ($subjects as $key => $sub) {
            $helps = $this->find()
                ->where([
                    'subject_help_id' => $sub['id'],
                    [
                        'OR' => [
                            ['name LIKE' => '%'.$text.'%'],
                            ['description LIKE' => '%'.$text.'%'],
                        ]
                    ]
                ])
                ->all()
                ->toArray();
            
            $return[] = [
                'subject_help' => $sub,
                'helps'        => $helps
            ];
        }

        return $return;
    }
}
