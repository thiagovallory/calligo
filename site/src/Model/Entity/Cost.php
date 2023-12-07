<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Cost extends Entity
{

    protected $_accessible = [
        'user_id' => true,
        'modality_id' => true,
        'value_full' => true,
        'value_additional' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'modality' => true,
    ];
}
