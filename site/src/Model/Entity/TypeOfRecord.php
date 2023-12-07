<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class TypeOfRecord extends Entity
{

    protected $_accessible = [
        'name' => true,
        'records' => true,
    ];
}
