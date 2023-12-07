<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

class User extends Entity
{

    protected $_accessible = [
        'username'             => true,
        'password'             => true,
        'name'                 => true,
        'role'                 => true,
        'active'               => true,
        'created'              => true,
        'modified'             => true,
        'hash_active'          => true,
        'academic_backgrounds' => true,
        'bank'                 => true,
        'costs'                => true,
        'emergency_contact'    => true,
        'notification'         => true,
        'cards'                => true,
        'products'             => true,
        'profile'              => true,
        'reviews'              => true,
        'ages'                 => true,
        'characteristics'      => true,
        'langs'                => true,
        'problems'             => true,
        'specialties'          => true,
        'therapies'            => true,
        'schedule_settings'    => true,
        'iugu_udid'            => true,
        'iugu_live_token'      => true,
        'iugu_test_token'      => true,
        'iugu_user_token'      => true,
        'reasons_user'         => true,
        'records'                 => true,
        'first_login'          => true,
        'to_remove'            => true,
    ];

    protected $_hidden = [
        'password',
    ];

    protected function _setPassword($value)
    {
        $hasher = new DefaultPasswordHasher();
        return $hasher->hash($value);
    }
}
