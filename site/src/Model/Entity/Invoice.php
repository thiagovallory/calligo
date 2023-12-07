<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Invoice extends Entity
{
    protected $_accessible = [
        'iugu_udid' => true,
        'iugu_url' => true,
        'iugu_card_details' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'appointment_id' => true,
        'appointment' => true,
    ];
}
