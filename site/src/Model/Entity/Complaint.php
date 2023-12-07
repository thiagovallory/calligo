<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Complaint extends Entity
{

    protected $_accessible = [
        'therapist_id' => true,
        'patient_id' => true,
        'created' => true,
        'modified' => true,
        'therapist' => true,
        'patient' => true,
        'complaint_selecteds' => true,
        'description'=>true,
    ];
}
