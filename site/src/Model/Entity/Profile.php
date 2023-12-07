<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Core\Configure;
use Cake\I18n\FrozenTime;

class Profile extends Entity
{

    protected $_virtual = ['photo', 'video', 'age'];

    protected $_accessible = [
        'title_id'                 => true,
        'birth_date'               => true,
        'gender'                   => true,
        'pronoun'                  => true,
        'document_number'          => true,
        'telephone_number'         => true,
        'email'                    => true,
        'created'                  => true,
        'modified'                 => true,
        'crp'                      => true,
        'crp_expiration'           => true,
        'crp_origin'               => true,
        'epsi'                     => true,
        'epsi_origin'              => true,
        'epsi_expiration'          => true,
        'description'              => true,
        'user_id'                  => true,
        'user'                     => true,
        'default_language'         => true,
        'default_time_zone'        => true,
        'photo_url'                => true,
        'photo_name'               => true,
        'session_duration'         => true,
        'session_break'            => true,
        'time_work_experience'     => true,
        'video_url'                => true,
        'video_name'               => true,
        'completed_profile'        => true,
        'attendance_by_phone_call' => true,
        'attendance_by_video_call' => true,
    ];


    protected function _getPhoto()
    {
        if ($this->photo_url) {
//            return Configure::read('SERVER_PHOTOS') . $this->photo_url;
            return (Configure::read('SERVER_PHOTOS') . '/uploads/' . $this->photo_url);
        }

        return Configure::read('SERVER_PHOTOS') . Configure::read('NO_PHOTO');
    }

    protected function _getAge()
    {
        if ($this->birth_date) {
            $date = new FrozenTime($this->birth_date);
            return $date->diffInYears(FrozenTime::now()) . ' anos';
        }
        return null;
    }

    protected function _getCrpExpirationDate()
    {
        if ($this->crp_expiration) {
            $date = new FrozenTime($this->crp_expiration);
            $days = $date->diffInDays(FrozenTime::now(), false);
            if (abs($days) > 30) {
                $months = $date->diffInMonths(FrozenTime::now(), false);
                if (abs($months) > 12) {
                    return 'CRP ' . ($months < 0 ? 'expira em ' : 'expirou há ') . intdiv(abs($months), 12) . ' anos';
                }
                return 'CRP ' . ($months < 0 ? 'expira em ' : 'expirou há ') . abs($months) . ' meses';
            }
            return 'CRP ' . ($days < 0 ? 'expira em ' : 'expirou há ') . abs($days) . ' dias';
        }
        return null;
    }

    protected function _getEpsiExpirationDate()
    {
        if ($this->epsi_expiration) {
            $date = new FrozenTime($this->epsi_expiration);
            $days = $date->diffInDays(FrozenTime::now(), false);
            if (abs($days) > 30) {
                $months = $date->diffInMonths(FrozenTime::now(), false);
                if (abs($months) > 12) {
                    return 'Epsi ' . ($months < 0 ? 'expira em ' : 'expirou há ') . intdiv(abs($months), 12) . ' anos';
                }
                return 'Epsi ' . ($months < 0 ? 'expira em ' : 'expirou há ') . abs($months) . ' meses';
            }
            return 'Epsi ' . ($days < 0 ? 'expira em ' : 'expirou há ') . abs($days) . ' dias';
        }
        return null;
    }

    protected function _getVideo()
    {
        if ($this->video_url) {
            return Configure::read('SERVER_VIDEOS') . $this->video_url;
        }

        return Configure::read('SERVER_VIDEOS') . Configure::read('NO_VIDEO');
    }
}
