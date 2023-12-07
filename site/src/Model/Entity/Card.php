<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Card extends Entity
{

    protected $_accessible = [
        'is_main'         => true,
        'card_number'     => true,
        'owner_name'      => true,
        'owner_cpf'       => true,
        'expiration_date' => true,
        'cvv'             => true,
        'created'         => true,
        'modified'        => true,
        'user_id'         => true,
        'user'            => true,
        'address'         => true,
        'address_number'  => true,
        'complement'      => true,
        'neighborhood'    => true,
        'zip_code'        => true,
        'city_id'         => true,
        'state_id'        => true,
        'phone'           => true,
        'emergency_phone' => true,
    ];
}
