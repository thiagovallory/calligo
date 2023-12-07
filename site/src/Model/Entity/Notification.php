<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Notification Entity
 *
 * @property int $id
 * @property int|null $sms_update_news
 * @property int|null $sms_update_terms
 * @property int|null $sms_clinic_schedule
 * @property int|null $sms_clinic_therapy
 * @property int|null $sms_clinic_messages
 * @property int|null $sms_learn_news
 * @property int|null $sms_learn_offers
 * @property int|null $email_update_news
 * @property int|null $email_update_terms
 * @property int|null $email_clinic_schedule
 * @property int|null $email_clinic_therapy
 * @property int|null $email_clinic_messages
 * @property int|null $email_learn_news
 * @property int|null $email_learn_offers
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property int $user_id
 *
 * @property \App\Model\Entity\User $user
 */
class Notification extends Entity
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
        'sms_update_news'       => true,
        'sms_update_terms'      => true,
        'sms_clinic_schedule'   => true,
        'sms_clinic_therapy'    => true,
        'sms_clinic_messages'   => true,
        'sms_learn_news'        => true,
        'sms_learn_offers'      => true,
        'email_update_news'     => true,
        'email_update_terms'    => true,
        'email_clinic_schedule' => true,
        'email_clinic_therapy'  => true,
        'email_clinic_messages' => true,
        'email_learn_news'      => true,
        'email_learn_offers'    => true,
        'created'               => true,
        'modified'              => true,
        'user_id'               => false,
        'user'                  => false,
    ];
}
