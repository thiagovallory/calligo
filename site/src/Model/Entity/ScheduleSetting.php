<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\I18n\FrozenTime;

class ScheduleSetting extends Entity
{

    protected $_accessible = [
        'day_name' => true,
        'day_index' => true,
        'hour_start' => true,
        'user_id' => true,
        'user' => true,
    ];

    protected $_virtual = ['hour'];

    protected function _getHour()
    {
    	$time = new FrozenTime($this->hour_start);
        return $time->i18nFormat('HH:mm');
    }
}
