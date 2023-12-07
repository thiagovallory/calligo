<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\I18n\Date;

class AcademicBackground extends Entity
{
    protected $_accessible = [
        'type' => true,
        'class_name' => true,
        'institution' => true,
        'period_start' => true,
        'period_end' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'user_id' => true,
        'user' => true,
    ];

    protected $_virtual = ['period_start_formated', 'period_end_formated'];

    protected function _getPeriodStartFormated() {
        $date = new Date($this->period_start);
        return $date->format('Y-m-d');
    }

     protected function _getPeriodEndFormated() {
        $date = new Date($this->period_end);
        return $date->format('Y-m-d');
    }
}
