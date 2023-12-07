<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * HelpQuestion Entity
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $telephone
 * @property string $message
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 */
class HelpQuestion extends Entity
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
        'name'      => true,
        'email'     => true,
        'telephone' => true,
        'message'   => true,
        'created'   => true,
        'modified'  => true,
    ];
}
