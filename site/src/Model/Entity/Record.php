<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Record extends Entity
{

    protected $_accessible = [
        'name' => true,
        'description' => true,
        'private' => true,
        'type_of_record_id' => true,
        'owner_id' => true,
        'patient_id' => true,
        'created' => true,
        'modified' => true,
        'type_of_record' => true,
        'owner' => true,
        'patient' => true,
        'docs' => true,
    ];

    protected $_virtual = ['created_day', 'created_month', 'created_year'];

    protected function _getCreatedDay() {
        return $this->created->i18nFormat('dd');
    }

    protected function _getCreatedMonth() {
        return ucfirst($this->created->i18nFormat('MMMM'));
    }

    protected function _getCreatedYear() {
        return $this->created->i18nFormat('yyyy');
    }
}
