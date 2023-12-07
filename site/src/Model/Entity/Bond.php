<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;


class Bond extends Entity
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
        'therapist_id'              => true,
        'patient_id'                => true,
        'status'                    => true,
        'started_at'                => true,
        'ended_at'                  => true,
        'created'                   => true,
        'modified'                  => true,
        'user'                      => true,
        'closing_description'       => true,
        'closing_patient_at_risk'   => true,
        'closing_file_name'         => true,
        'closing_file_url'          => true,
        'closing_file_size'         => true,
    ];
}
