<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AgesUser Entity
 *
 * @property int $id
 * @property int $age_id
 * @property int $user_id
 *
 * @property \App\Model\Entity\Age $age
 * @property \App\Model\Entity\User $user
 */
class AgesUser extends Entity
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
        'age_id' => true,
        'user_id' => true,
        'age' => true,
        'user' => true,
    ];
}
