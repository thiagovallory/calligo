<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Help extends Entity
{

    protected $_accessible = [
        'name' => true,
        'description' => true,
        'created' => true,
        'modified' => true,
        'role' => true,
        'subject_help_id' => true,
    ];
}
