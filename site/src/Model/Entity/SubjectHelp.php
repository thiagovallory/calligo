<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class SubjectHelp extends Entity
{

    protected $_accessible = [
        'name' => true,
        'icon_class' => true,
        'created' => true,
        'modified' => true,
        'helps' => true,
    ];
}
