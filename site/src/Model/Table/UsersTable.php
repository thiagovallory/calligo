<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\Datasource\EntityInterface;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Exception;

class UsersTable extends Table
{

    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('users');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('AcademicBackgrounds', [
            'foreignKey' => 'user_id',
            //            'dependent'  => true,
        ]);
        $this->hasOne('Banks', [
            'foreignKey' => 'user_id',
            //            'dependent'  => true,
        ]);
        $this->hasMany('Cards', [
            'foreignKey' => 'user_id',
            //            'dependent'  => true,
        ]);
        $this->hasMany('Costs', [
            'foreignKey' => 'user_id',
            //            'dependent'  => true,
        ]);
        $this->hasOne('EmergencyContacts', [
            'foreignKey' => 'user_id',
            //            'dependent'  => true,
        ]);
        $this->hasOne('Notifications', [
            'foreignKey' => 'user_id',
            //            'dependent'  => true,
        ]);
        $this->hasMany('Products', [
            'foreignKey' => 'user_id',
            //            'dependent'  => true,
        ]);
        $this->hasOne('Profiles', [
            'foreignKey' => 'user_id',
            //            'dependent'  => true,
        ]);
        $this->hasMany('Reviews', [
            'foreignKey' => 'user_id',
            //            'dependent'  => true,
        ]);
        $this->hasMany('ScheduleSettings', [
            'foreignKey' => 'user_id',
            //            'dependent'  => true,
        ]);
        $this->hasMany('Cards', [
            'foreignKey' => 'user_id',
            //            'dependent'  => true,
        ]);
        $this->hasMany('ReviewsMade', [
            'foreignKey' => 'reviwer_id',
            'className'  => 'TherapistsReviews',
            //            'dependent'  => true,
        ]);
        $this->hasMany('ReviewsReceived', [
            'foreignKey' => 'therapist_id',
            'className'  => 'TherapistsReviews',
            //            'dependent'  => true,
        ]);
        $this->hasMany('AppointmentsMade', [
            'foreignKey' => 'therapist_id',
            'className'  => 'Appointments',
            //            'dependent'  => true,
        ]);
        $this->hasMany('AppointmentsReceived', [
            'foreignKey' => 'patient_id',
            'className'  => 'Appointments',
            //            'dependent'  => true,
        ]);
        $this->hasOne('ReasonsUsers', [
            'foreignKey' => 'user_id',
            'joinType'   => 'INNER',
        ]);
        $this->belongsToMany('Ages', [
            'foreignKey'       => 'user_id',
            //            'dependent'        => true,
            'targetForeignKey' => 'age_id',
            'joinTable'        => 'ages_users',
        ]);
        $this->belongsToMany('Characteristics', [
            'foreignKey'       => 'user_id',
            //            'dependent'        => true,
            'targetForeignKey' => 'characteristic_id',
            'joinTable'        => 'characteristics_users',
        ]);
        $this->belongsToMany('Langs', [
            'foreignKey'       => 'user_id',
            //            'dependent'        => true,
            'targetForeignKey' => 'lang_id',
            'joinTable'        => 'langs_users',
        ]);
        $this->belongsToMany('Problems', [
            'foreignKey'       => 'user_id',
            //            'dependent'        => true,
            'targetForeignKey' => 'problem_id',
            'joinTable'        => 'problems_users',
        ]);
        $this->belongsToMany('Specialties', [
            'foreignKey'       => 'user_id',
            //            'dependent'        => true,
            'targetForeignKey' => 'specialty_id',
            'joinTable'        => 'specialties_users',
        ]);
        $this->belongsToMany('Therapies', [
            'foreignKey'       => 'user_id',
            //            'dependent'        => true,
            'targetForeignKey' => 'therapy_id',
            'joinTable'        => 'therapies_users',
        ]);
        $this->hasMany('RecordsOwner', [
            'foreignKey' => 'owner_id',
            'className'  => 'Records',
        ]);
        $this->hasMany('RecordsPatient', [
            'foreignKey' => 'patient_id',
            'className'  => 'Records',
        ]);
        $this->hasMany('NotesOwner', [
            'foreignKey' => 'owner_id',
            'className'  => 'Notes',
        ]);
        $this->hasMany('NotesPatient', [
            'foreignKey' => 'patient_id',
            'className'  => 'Notes',
        ]);
        $this->hasMany('Clients', [
            'foreignKey' => 'therapist_id',
            'className'  => 'Bonds',
            //            'dependent'  => true,
        ]);
        $this->hasMany('Therapists', [
            'foreignKey' => 'patient_id',
            'className'  => 'Bonds',
            //            'dependent'  => true,
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('username')
            ->maxLength('username', 255)
            ->requirePresence('username', 'create')
            ->notEmptyString('username')
            ->add('username', 'unique', [
                'rule'     => 'validateUnique',
                'provider' => 'table',
                'message'  => 'Este e-mail já está cadastrado'
            ])
            ->add('username', [
                'email' => [
                    'rule'    => ['email'],
                    'message' => 'E-mail inválido'
                ]
            ]);

        $validator->add('username_confirm', 'no-misspelling', [
            'rule'    => ['compareWith', 'username'],
            'message' => 'E-mails estão diferentes',
        ]);

        $validator
            ->add('password', [
                'minLength' => [
                    'rule'    => ['minLength', 6],
                    'message' => 'A senha deve conter ao menos 6 digitos'
                ],
            ])
            ->maxLength('password', 255)
            ->requirePresence('password', 'create', 'Senha é obrigatório');

        $validator->add('password_confirm', 'no-misspelling', [
            'rule'    => ['compareWith', 'password'],
            'message' => 'Senhas estão diferentes',
        ]);

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name', 'Nome é obrigatório')
            ->notBlank('name', 'Nome é obrigatório');

        $validator
            ->integer('role')
            ->requirePresence('role', 'create')
            ->notEmptyString('role');

        $validator
            ->integer('active')
            ->requirePresence('active', 'create')
            ->notEmptyString('active');

        $validator
            ->scalar('accept_terms')
            ->requirePresence('accept_terms', 'create')
            ->notEmptyString('accept_terms');

        $validator
            ->scalar('not_employee')
            ->requirePresence('not_employee', 'create')
            ->notEmptyString('not_employee');

        $validator
            ->scalar('accept_contact')
            ->requirePresence('accept_contact', 'create')
            ->notEmptyString('accept_contact');

        $validator
            ->scalar('hash_active')
            ->maxLength('hash_active', 255)
            ->requirePresence('hash_active', 'create')
            ->notEmptyString('hash_active', 'Hash obrigatória')
            ->notBlank('hash_active', 'Hash obrigatória');

        return $validator;
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['username']), ['errorField' => 'username']);

        $rules->addDelete(function ($entity, $options) {
            //TODO: adicionar verificação das pendências
            return true;
        }, 'noPendencies');

        return $rules;
    }

    public function setActive($hash)
    {
        $user = $this->find('all', [
            'conditions' => [
                'first_login' => 1,
                'hash_active' => $hash
            ]
        ])->first();

        if ($user) {
            $update              = $this->get($user->id);
            $update->first_login = 0;
            $update->active      = 1;
            if ($this->save($update)) {
                if ($user->role == 1) {
                    return $this->Profiles->setProfileCompleted($user->id);
                } else {
                    return true;
                }
            }
        }

        return false;
    }

    public function getById($id)
    {
        return $this->find('all', [
            'conditions' => [
                'id' => $id,
            ]
        ])->first()->toArray();
    }

    public function getByHash($hash)
    {
        return $this->find('all', [
            'conditions' => [
                'hash_active' => $hash
            ]
        ])->first()->toArray();
    }

    public function setIuguUDID($user_id, $iugu_udid)
    {
        $update            = $this->get($user_id);
        $update->iugu_udid = $iugu_udid;
        return $this->save($update);
    }

    public function setIuguCustomerId($user_id, $iugu_customer_id)
    {
        $update                   = $this->get($user_id);
        $update->iugu_customer_id = $iugu_customer_id;
        return $this->save($update);
    }

    public function setIuguTokens($user_id, $iugu_ltoken, $iugu_ttoken, $iugu_utoken)
    {
        $update                  = $this->get($user_id);
        $update->iugu_live_token = $iugu_ltoken;
        $update->iugu_test_token = $iugu_ttoken;
        $update->iugu_user_token = $iugu_utoken;
        return $this->save($update);
    }

    public function getRuleResendEmail($email)
    {
        $user = $this->find('all', [
            'conditions' => [
                'first_login' => 1,
                'username'    => $email
            ]
        ])->first();

        if ($user) {
            return $user->toArray();
        }

        return false;
    }

    public function getRuleForgotPassword($email)
    {
        $user = $this->find('all', [
            'conditions' => [
                'first_login' => 0,
                'username'    => $email
            ]
        ])->first();

        if ($user) {
            $newPass          = $this->_generateNewPass();
            $update           = $this->get($user->id);
            $update->password = $newPass;
            if ($this->save($update)) {
                return [
                    'name'     => $user->name,
                    'username' => $user->username,
                    'newPass'  => $newPass
                ];
            }
        }

        return false;
    }

    public function deactivateAccount($user, $reason)
    {
        $this->getConnection()->begin();
        $data = [
            'active' => 0,
        ];
        $this->patchEntity($user, $data, ['validate' => false]);

        $reasonEntity = $this->ReasonsUsers->newEntity([
            'user_id'   => $user->id,
            'reason_id' => $reason,
            'type'      => 1
        ]);

        try {
            if (!$this->ReasonsUsers->save($reasonEntity)) {
                $this->getConnection()->rollback();
                return false;
            }
            if (!$this->save($user)) {
                $this->getConnection()->rollback();
                return false;
            }
            if ($this->delete($user)) {
                $this->getConnection()->commit();
                return true;
            } else {
                $this->getConnection()->rollback();
            }
        } catch (Exception $e) {
            $this->getConnection()->rollback();
        }
        return false;
    }

    public function delete(EntityInterface $entity, $options = []): bool
    {
        if ($this->save($entity->set('active', 0))) {
            return true;
        }
    }

    public function deleteAll($conditions): int
    {
        return parent::updateAll(['active' => 0], $conditions);
    }

    public function deleteAccount($user, $reason)
    {
        $this->getConnection()->begin();
        $data = [
            //'username' => 'delete_' . uniqid() . '_' . $user->username,
            'active'    => 0,
            'to_remove' => 1,
        ];
        $this->patchEntity($user, $data, ['validate' => false]);

        $reasonEntity = $this->ReasonsUsers->newEntity([
            'user_id'   => $user->id,
            'reason_id' => $reason,
            'type'      => 0
        ]);

        try {
            if (!$this->ReasonsUsers->save($reasonEntity)) {
                $this->getConnection()->rollback();
                return false;
            }
            if (!$this->save($user)) {
                $this->getConnection()->rollback();
                return false;
            }
            if ($this->delete($user)) {
                $this->getConnection()->commit();
                return true;
            } else {
                $this->getConnection()->rollback();
            }
        } catch (Exception $e) {
            $this->getConnection()->rollback();
        }
        return false;
    }

    public function getAppointmentsCount($user_id): int
    {
        return $this->AppointmentsMade->find('all', [
            'conditions' => [
                'therapist_id' => $user_id,
                'status'       => 5 // bootstrap.php => Finalizada
            ]
        ])->count();
    }

    public function getClientsCount($user_id)
    {
        return $this->Clients->find('all', [
            'fields'     => 'patient_id',
            'conditions' => [
                'therapist_id' => $user_id,
                'status'       => 2
            ],
            'group'      => 'patient_id'
        ])->count();
    }

    public function getClientsList($user_id)
    {
        return $this->Clients->find()
            ->select(['Patient.name', 'Clients.patient_id', 'Clients.therapist_id'])
            ->contain(['Patient'])
            ->where([
                'Clients.therapist_id' => $user_id,
                'Clients.status'       => 2
            ])
            ->group(['Patient.name', 'Clients.patient_id', 'Clients.therapist_id'])
            ->order(['Patient.name' => 'ASC'])
            ->all()
            ->combine('patient_id', 'patient.name')
            ->toArray();
    }

    public function getQueryClientsList($users_id)
    {
        return $this->find()
            ->where([
                'Users.id IN' => array_keys($users_id),
            ])
            ->contain(['Profiles', 'Problems'])
            ->order(['Users.name' => 'ASC']);
    }

    public function findAuth(Query $query, array $options)
    {
        $query
            ->select()
            ->where(['Users.first_login' => 0]);

        return $query;
    }

    private function _generateNewPass()
    {
        $ma = "ABCDEFGHIJKLMNOPQRSTUVYXWZ";
        $mi = "abcdefghijklmnopqrstuvyxwz";
        $nu = "0123456789";

        $senha = str_shuffle($ma);
        $senha .= str_shuffle($mi);
        $senha .= str_shuffle($nu);

        return substr(str_shuffle($senha), 0, 6);
    }

    public function getQueryToSearch($param)
    {
        $query = $this->find();

        $conditions   = [];
        $conditions[] = ['Users.role' => 2];
        $conditions[] = ['Users.active' => 1];
        $conditions[] = ['Users.first_login' => 0];
        $conditions[] = ['Profiles.epsi_expiration >= NOW()'];
        $conditions[] = ['Profiles.crp_expiration >= NOW()'];

        if ($param['session_type']) {
            $size = count($param['session_type']);
            if ($size == 1) {
                $conditions[] = ['Profiles.' . $param['session_type'][0] => 1];
            } else if ($size == 2) {
                $conditions[] = [
                    'OR' => [
                        ['Profiles.' . $param['session_type'][0] => 1],
                        ['Profiles.' . $param['session_type'][1] => 1]
                    ]];
            }
        }

        if ($param['cost_value']) {
            $tmp          = explode('-', $param['cost_value']);
            $conditions[] = [
                'AND' => [
                    ['Costs.value_full >=' => $tmp[0]],
                    ['Costs.value_full <=' => count($tmp) > 1 ? $tmp[1] : $tmp[0]]
                ]];
            $query->innerJoinWith('Costs');
        }

        if ($param['time_work_experience']) {
            $tmp          = explode('-', $param['time_work_experience']);
            $conditions[] = [
                'AND' => [
                    ['Profiles.time_work_experience >=' => $tmp[0]],
                    ['Profiles.time_work_experience <=' => $tmp[1]]
                ]];
        }

        if ($param['text']) {
            $conditions[] = [
                'OR' => [
                    ['Specialties.name LIKE' => '%' . $param['text'] . '%'],
                    ['Problems.name LIKE' => '%' . $param['text'] . '%'],
                    ['Therapies.name LIKE' => '%' . $param['text'] . '%'],
                    ['Characteristics.name LIKE' => '%' . $param['text'] . '%'],
                    ['Ages.name LIKE' => '%' . $param['text'] . '%'],
                    ['Profiles.description LIKE' => '%' . $param['text'] . '%'],
                    ['Langs.name LIKE' => '%' . $param['text'] . '%'],
                    ['AcademicBackgrounds.class_name LIKE' => '%' . $param['text'] . '%'],
                    ['AcademicBackgrounds.institution LIKE' => '%' . $param['text'] . '%'],
                    ['Users.name LIKE' => '%' . $param['text'] . '%'],
                ]];

            $query->innerJoinWith('Problems')
                ->innerJoinWith('Characteristics')
                ->innerJoinWith('Ages')
                ->innerJoinWith('Langs')
                ->innerJoinWith('Therapies')
                ->innerJoinWith('Specialties')
                ->innerJoinWith('AcademicBackgrounds');
        }

        if ($param['problems']) {
            $conditions[] = ['Problems.id IN' => $param['problems']];
            $query->innerJoinWith('Problems');
        }

        if ($param['gender']) {
            $conditions[] = ['Profiles.gender' => $param['gender']];
        }

        if ($param['crp_origin']) {
            $conditions[] = ['Profiles.crp_origin' => $param['crp_origin']];
        }

        if ($param['attendance_type']) {
            $conditions[] = ['Costs.modality_id IN' => $param['attendance_type']];
            $query->innerJoinWith('Costs');
        }
        if ($param['characteristics']) {
            $conditions[] = ['Characteristics.id IN' => $param['characteristics']];
            $query->innerJoinWith('Characteristics');
        }
        if ($param['therapies']) {
            $conditions[] = ['Therapies.id IN' => $param['therapies']];
            $query->innerJoinWith('Therapies');
        }
        if ($param['ages']) {
            $conditions[] = ['Ages.id IN' => $param['ages']];
            $query->innerJoinWith('Ages');
        }
        if ($param['langs']) {
            $conditions[] = ['Langs.id IN' => $param['langs']];
            $query->innerJoinWith('Langs');
        }

        if ($param['time']) $conditions[] = [];
        if ($param['max_date']) $conditions[] = [];

        $query->innerJoinWith('Profiles')
            ->contain(['Profiles', 'Problems', 'Costs' => ['Modalities'], 'Characteristics', 'Ages', 'Langs', 'Therapies', 'Specialties'])
            ->where($conditions)
            ->group('Users.id');

        return $query;
    }

    public function getAccountsToRemove()
    {
        $accounts = $this
            ->find()
            ->where(['to_remove' => 1]);

        return $accounts;
    }

    public function getViewResume($patient_id)
    {
        return $this->find()
            ->where([
                'Users.id' => $patient_id,
            ])
            ->contain([
                'Problems',
                'Profiles',
                'AppointmentsReceived' => function ($q) {
                    return $q
                        ->where([
                            'status' => 1,
                            'day >=' => date('Y-m-d')
                        ])
                        ->order([
                            'day'  => 'ASC',
                            'hour' => 'ASC'
                        ]);
                }
            ])
            ->first();
    }
}
