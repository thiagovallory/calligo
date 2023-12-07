<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Doc extends Entity
{
 
    protected $_accessible = [
        'name' => true,
        'size' => true,
        'url' => true,
        'created' => true,
        'modified' => true,
        'record_id' => true,
        'record' => true,
    ];

    protected $_virtual = ['created_simple', 'size_formated'];

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

    protected function _getSizeFormated()
    {
        if ($this->size) {
            $kb = $this->size/1000;
            if ($kb > 1000) {
                return number_format(($kb/1000),2).' Mb';
            } else {
                return number_format($kb,2).' Kb';
            }
        } else {
            return null;
        }
    }
}
