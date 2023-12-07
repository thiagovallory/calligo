<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EmergencyContact Entity
 *
 * @property int $id
 * @property string $name
 * @property string|null $telephone_number
 * @property string|null $email
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property int $user_id
 * @property int|null $gender
 * @property int|null $pronoun
 *
 * @property \App\Model\Entity\User $user
 */
class EmergencyContact extends Entity
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
        'name' => true,
        'telephone_number' => true,
        'email' => true,
        'created' => true,
        'modified' => true,
        'user_id' => true,
        'gender' => true,
        'pronoun' => true,
        'user' => true,
    ];
}
