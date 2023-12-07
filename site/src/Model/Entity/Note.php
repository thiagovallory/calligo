<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Utility\Text;

class Note extends Entity
{
    protected $_accessible = [
        'owner_id' => true,
        'patient_id' => true,
        'description' => true,
        'created' => true,
        'modified' => true,
        'owner' => true,
        'patient' => true
    ];

    protected $_virtual = ['created_complet', 'created_simple', 'description_resume'];

    protected function _getCreatedComplet()
    {
        if ($this->created) {
            return $this->created->i18nFormat('MMMM dd, yyyy').' às '.$this->created->i18nFormat('HH:ss');
        } else {
            return null;
        }
    }

    protected function _getCreatedSimple()
    {
        if ($this->created) {
            return $this->created->i18nFormat('dd')
                    .' de '.
                    ucfirst($this->created->i18nFormat('MMMM'))
                    .' de '.
                    $this->created->i18nFormat('yyyy');
        } else {
            return null;
        }
    }

    protected function _getDescriptionResume()
    {
        if ($this->description) {
            return Text::truncate(
                strip_tags($this->description),
                20,
                [
                    'ellipsis' => '...',
                    'exact' => false
                ]
            );
        } else {
            return null;
        }
    }
}
