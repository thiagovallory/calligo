<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Bank Entity
 *
 * @property int $id
 * @property string $name
 * @property string $document_number
 * @property string $agency
 * @property string $account
 * @property int $type
 * @property int $user_id
 * @property int $financial_institution_id
 *
 * @property \App\Model\Entity\User $user
 */
class Bank extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'name'                     => true,
        'document_number'          => true,
        'agency'                   => true,
        'account'                  => true,
        'type'                     => true,
        'user_id'                  => true,
        'financial_institution_id' => true,
        'user'                     => true,
        'cep'                      => true,
        'address'                  => true,
        'state_id'                 => true,
        'city_id'                  => true,
        'neighborhood'             => true,
        'telephone'                => true
    ];
}
