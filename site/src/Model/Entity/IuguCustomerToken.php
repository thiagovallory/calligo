<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class IuguCustomerToken extends Entity
{

    protected $_accessible = [
        'customer_id'          => true,
        'subaccount_id'        => true,
        'iugu_udid'            => true,
        'created'              => true,
        'modified'             => true
    ];

}
