<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class ComplaintSelected extends Entity
{
   
    protected $_accessible = [
        'complaint_id' => true,
        'complaint_item_id' => true,
        'complaint' => true,
        'complaint_item' => true,
    ];
}
