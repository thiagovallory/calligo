<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class ComplaintItem extends Entity
{

    protected $_accessible = [
        'name' => true,
        'description' => true,
        'complaint_selecteds' => true,
    ];
}
