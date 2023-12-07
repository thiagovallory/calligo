<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\Datasource\EntityInterface;
use Cake\I18n\FrozenDate;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use DateTime;

class ProfilesTable extends Table
{

    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('profiles');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'photo_url' => [
                'nameCallback'      => function ($table, $entity, $data, $field, $settings) {
                    $file = explode('.', $data->getClientFilename());
                    $ext  = end($file);
                    return (new DateTime())->getTimestamp() . uniqid() . '.' . $ext;
                },
                'keepFilesOnDelete' => false,
                'path'              => 'webroot{DS}uploads{DS}',
            ],
        ]);

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType'   => 'INNER',
        ]);

        $this->belongsTo('Titles', [
            'foreignKey' => 'title_id',
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->date('birth_date')
            ->allowEmptyDate('birth_date');

        $validator
            ->integer('gender')
            ->allowEmptyString('gender');

        $validator
            ->integer('pronoun')
            ->allowEmptyString('pronoun');

        $validator
            ->scalar('document_number')
            ->maxLength('document_number', 50)
            ->notEmptyString('document_number', 'Campo obrigatório')
            ->notBlank('document_number', 'Campo obrigatório')
            ->add('document_number', 'cpf', [
                'rule'    => [$this, 'validateCpf'],
                'message' => 'CPF inválido'
            ]);

        $validator
            ->scalar('telephone_number')
            ->maxLength('telephone_number', 19)
            ->requirePresence('telephone_number', 'create', 'Telefone é obrigatório')
            ->notEmptyString('telephone_number', 'Campo obrigatório')
            ->notBlank('telephone_number', 'Campo obrigatório')
            ->add('telephone_number', 'telephone_number', [
                'rule'    => [$this, 'validateTelephoneNumber'],
                'message' => 'Telefone é inválido'
            ]);

        $validator
            ->email('email')
            ->allowEmptyString('email');

        $validator
            ->scalar('crp')
            ->maxLength('crp', 45)
            ->notBlank('crp', 'Campo obrigatório');

        $validator
            ->date('crp_expiration')
            ->notEmptyDate('crp_expiration', 'Campo obrigatório')
            ->notBlank('crp_expiration', 'Campo obrigatório');

        $validator
            ->integer('crp_origin')
            ->notEmptyString('crp_origin')
            ->notBlank('crp_origin', 'Campo obrigatório');

        $validator
            ->scalar('epsi')
            ->maxLength('epsi', 45)
            ->allowEmptyString('epsi');

        $validator
            ->date('epsi_expiration')
            ->notEmptyDate('epsi_expiration', 'Campo obrigatório')
            ->notBlank('epsi_expiration', 'Campo obrigatório');

        $validator
            ->integer('epsi_origin')
            ->notEmptyString('epsi_origin')
            ->notBlank('epsi_origin', 'Campo obrigatório');

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        $validator
            ->scalar('video_url')
            ->allowEmptyString('video_url')
            ->add('video_url', 'video_url', [
                'rule'    => [$this, 'validateYoutubeAndVimeoUrls'],
                'message' => 'Url é inválida'
            ]);

        $validator
            ->integer('default_time_zone')
            ->notEmptyString('default_time_zone', 'Campo obrigatório')
            ->notBlank('default_time_zone', 'Campo obrigatório');

        return $validator;
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }

    public function getByUserId($user_id)
    {
        $profile = $this->find()
            ->where(['user_id' => $user_id])
            ->first();
        if ($profile) {
            return $profile->id;
        }
        return null;
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

    public function validateYoutubeAndVimeoUrls($value, $context)
    {
        $regexYoutubeUrl = "/http(?:s?):\/\/(?:www\.)?youtu(?:be\.com\/watch\?v=|\.be\/)([\w\-\_]*)(&(amp;)?[\w\?=]*)?/";
        $regexVimeoUrl = "/(?:http:|https:|)\/\/(?:player.|www.)?vimeo\.com\/(?:video\/|embed\/|watch\?\S*v=|v\/)?(\d*)/";
        if (preg_match($regexYoutubeUrl, $value) || preg_match($regexVimeoUrl, $value) ) {
            return true;
        } else {
            return false;
        }
    }

    public function getToMaxTimeWorkExperience()
    {
        $profile = $this->find()
            ->order(['time_work_experience' => 'DESC'])
            ->first();
        if ($profile) {
            return $profile->time_work_experience;
        } else {
            return 0;
        }
    }

    public function verifyProfileCompleted($user_id)
    {
        return $this->find()
            ->where(['user_id' => $user_id, 'completed_profile' => 1])
            ->count();
    }

    public function setProfileCompleted($user_id)
    {
        $prof = $this->find()
            ->where(['user_id' => $user_id])
            ->first();

        if ($prof) {
            $update                    = $this->get($prof->id);
            $update->completed_profile = 1;
            return $this->save($update);
        }
        return false;
    }

    public function getExpiringEpsi($date)
    {
        $expiring = $this->find()
            ->contain('Users')
            ->where(['epsi_expiration >= NOW()'])
            ->where(['epsi_expiration <=' => $date]);

        return $expiring;
    }

    public function isRuleCrpAndEpsiValid($therapist_id)
    {
        $profile = $this->find()
            ->where(['user_id' => $therapist_id])->first();

        if(!$profile->crp_expiration || !$profile->epsi_expiration) {
            return false;
        }

        if ($profile && ($profile->crp_expiration->isPast() || $profile->epsi_expiration->isPast())) {
            return false;
        }

        return true;
    }
}
