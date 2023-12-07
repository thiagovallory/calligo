<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Core\Configure;

class Appointment extends Entity
{

    protected $_accessible = [
        'modality_id'  => true,
        'therapist_id' => true,
        'patient_id'   => true,
        'created'      => true,
        'modified'     => true,
        'user'         => true,
        'day'          => true,
        'hour'         => true,
        'mode'         => true,
        'status'       => true,
        'price'        => true,
        'therapist'    => true,
        'patient'      => true,
        'modalities'     => true,
        'invoice'      => true,
    ];

    protected $_virtual = ['status_name','day_complet','hour_complet', 'hour_end'];

    protected function _getStatusName()
    {
        if ($this->status) {
            return Configure::read('APPOINTMENTS_STATUS')[$this->status];
        } else {
            return null;
        }
    }

    protected function _getDayComplet()
    {
        if ($this->day) {
            return $this->day->i18nFormat('MMMM dd, yyyy');
        } else {
            return null;
        }
    }

    protected function _getHourComplet()
    {
        if ($this->hour) {
            return $this->hour->i18nFormat('HH:mm');
        } else {
            return null;
        }
    }

    protected function _getHourEnd()
    {
        if ($this->hour) {
            return $this->hour->addHour()->i18nFormat('HH:mm');
        } else {
            return null;
        }
    }
}
