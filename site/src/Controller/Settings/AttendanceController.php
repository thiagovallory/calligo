<?php
declare(strict_types=1);

namespace App\Controller\Settings;

use Cake\Event\Event;
use Cake\Event\EventInterface;
use Cake\Utility\Security;
use Cake\Routing\Router;
use Cake\Core\Configure;

class AttendanceController extends AppController
{

    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    public function isAuthorized($user)
    {

        if ($user['role'] == 2) {
            return true;
        }
        return false;
    }

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->loadModel('Users');
        $this->viewBuilder()->setLayout('internal');
        $this->set('sidebar', 'account');
    }

    public function index()
    {
        $user = $this->Users->get($this->Auth->user('id'), [
            'contain' => ['AcademicBackgrounds', 'Ages', 'Characteristics', 'Langs', 'Problems', 'Specialties', 'ScheduleSettings', 'Therapies', 'Profiles', 'Costs.Modalities'],
        ])->toArray();

        $specialties     = $this->Users->Specialties->getList($user['specialties']);
        $problems        = $this->Users->Problems->getList($user['problems']);
        $therapies       = $this->Users->Therapies->getList($user['therapies']);
        $characteristics = $this->Users->Characteristics->getList($user['characteristics']);

        $schedule_settings = $this->Users->ScheduleSettings->getList($this->Auth->user('id'));

        $modalities = $this->Users->Costs->Modalities->getList($user['costs']);
        $ages       = $this->Users->Ages->getList($user['ages']);
        $langs      = $this->Users->Langs->getList($user['langs']);

        $academic_backgrounds_types  = Configure::read('ACADEMIC_BACKGROUNDS_TYPES');
        $academic_backgrounds_status = Configure::read('ACADEMIC_BACKGROUNDS_STATUS');

        $this->set(compact('user', 'ages', 'characteristics', 'langs', 'modalities', 'problems', 'specialties', 'therapies', 'academic_backgrounds_types', 'academic_backgrounds_status', 'schedule_settings'));
    }

    public function step1()
    {
        $user = $this->Users->get($this->Auth->user('id'), [
            'contain' => ['Profiles'],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();

            $updateUser = [
                'profile'     => [
                    'description' => $data['description'],
                ],
                'specialties' => $data['specialties']
            ];

            $user = $this->Users->patchEntity($user, $updateUser);
            if ($this->Users->save($user)) {
                return $this->responseJSON(true, 200);
            } else {
                return $this->responseJSON($user->getErrors(), 200);

            }
        }

        return $this->responseJSON(false, 400);
    }

    public function step2()
    {
        $user = $this->Users->get($this->Auth->user('id'), [
            'contain' => ['AcademicBackgrounds', 'Profiles'],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();

            if (!empty($data['academic_backgrounds'])) {
                $academic_backgrounds = [];
                foreach ($data['academic_backgrounds'] as $key => $obj) {
                    $academic_backgrounds[] = [
                        'id'           => $obj['id'],
                        'type'         => $obj['type'],
                        'class_name'   => $obj['class_name'],
                        'institution'  => $obj['institution'],
                        'period_start' => $obj['period_start'],
                        'period_end'   => $obj['period_end'],
                        'status'       => $obj['status'],
                    ];
                }
                $updateUser['academic_backgrounds'] = $academic_backgrounds;
            }

            if (!empty($data['time_work_experience'])) {
                $profile['time_work_experience'] = $data['time_work_experience'];
                $updateUser['profile']           = $profile;
            }

            $user = $this->Users->patchEntity($user, $updateUser);
            if ($this->Users->save($user)) {
                return $this->responseJSON(true, 200);
            } else {
                return $this->responseJSON($user->getErrors(), 400);
            }
        }

        return $this->responseJSON(false, 400);
    }

    public function step3()
    {
        $user = $this->Users->get($this->Auth->user('id'), [
            'contain' => ['Problems', 'Therapies', 'Characteristics'],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();

            $updateUser = [
                'problems'        => $data['problems'],
                'therapies'       => $data['therapies'],
                'characteristics' => $data['characteristics'],
            ];

            $user = $this->Users->patchEntity($user, $updateUser);
            if ($this->Users->save($user)) {
                return $this->responseJSON(true, 200);
            } else {
                return $this->responseJSON($user->getErrors(), 400);
            }
        }

        return $this->responseJSON(false, 400);
    }

    public function step4()
    {
        $user = $this->Users->get($this->Auth->user('id'), [
            'contain' => ['Ages', 'Langs', 'Profiles'],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();

            $updateUser = [
                'profile' => [
                    'attendance_by_phone_call' => $data['attendance_by_phone_call'],
                    'attendance_by_video_call' => $data['attendance_by_video_call'],
                ],
                'ages'    => $data['ages'],
                'langs'   => $data['langs'],
            ];

            $user = $this->Users->patchEntity($user, $updateUser);
            if ($this->Users->save($user)) {
                return $this->responseJSON(true, 200);
            } else {
                return $this->responseJSON($user->getErrors(), 400);
            }
        }

        return $this->responseJSON(false, 400);
    }

    public function step5()
    {
        $user = $this->Users->get($this->Auth->user('id'), [
            'contain' => ['Costs'],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data       = $this->request->getData();
            $updateUser = [];

            $this->Users->Costs->deleteAll(['user_id' => $this->Auth->user('id')]);
            if (!empty($data['costs'])) {
                $costs = [];
                foreach ($data['costs'] as $key => $obj) {
                    $costs[] = [
                        'value_full'       => str_replace(',', '', $obj['value_full']),
                        'value_additional' => 0,//$obj['value_additional'],
                        'modality_id'      => $obj['modality_id'],
                    ];
                }
                $updateUser['costs'] = $costs;

                $user = $this->Users->patchEntity($user, $updateUser);
                if ($this->Users->save($user)) {
                    return $this->responseJSON(true, 200);
                } else {
                    return $this->responseJSON($user->getErrors(), 400);
                }
            }
        }

        return $this->responseJSON(false, 400);
    }

    public function step6()
    {
        $user = $this->Users->get($this->Auth->user('id'), [
            'contain' => ['Profiles'],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();

            $updateUser = [
                'profile' => [
                    'session_duration' => '50',
                    'session_break'    => '10',
                ]
            ];

            $user = $this->Users->patchEntity($user, $updateUser);
            if ($this->Users->save($user)) {
                return $this->responseJSON(true, 200);
            } else {
                return $this->responseJSON($user->getErrors(), 200);

            }
        }

        return $this->responseJSON(false, 400);
    }

    public function step7()
    {
        $user = $this->Users->get($this->Auth->user('id'), [
            'contain' => ['Profiles'],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();

            $updateUser = [
                'profile' => [
                    'photo_url'  => $data['photo_url'],
                    'photo_name' => $data['photo_name'],
                ]
            ];

            $user = $this->Users->patchEntity($user, $updateUser);
            if ($this->Users->save($user)) {
                return $this->responseJSON(true, 200);
            } else {
                return $this->responseJSON($user->getErrors(), 200);

            }
        }

        return $this->responseJSON(false, 400);
    }

    public function step8()
    {
        $user = $this->Users->get($this->Auth->user('id'), [
            'contain' => ['Profiles'],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();

            $updateUser = [
                'profile' => [
                    'video_url'  => $data['video_url'],
                    'video_name' => $data['video_name']
                ]
            ];

            $user = $this->Users->patchEntity($user, $updateUser);
            if ($this->Users->save($user)) {
                return $this->responseJSON(true, 200);
            } else {
                return $this->responseJSON($user->getErrors(), 400);

            }
        }

        return $this->responseJSON(false, 400);
    }

    public function step9()
    {
        $user = $this->Users->get($this->Auth->user('id'), [
            'contain' => ['ScheduleSettings', 'Profiles'],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data       = $this->request->getData();
            $updateUser = [];

            $this->Users->ScheduleSettings->deleteAll(['user_id' => $this->Auth->user('id')]);
            if (!empty($data['schedule_settings'])) {
                $scheduleSetting = [];
                foreach ($data['schedule_settings'] as $key => $obj) {
                    $scheduleSetting[] = [
                        'day_name'   => Configure::read('DAYS_NAME')[$obj['day_index']],
                        'day_index'  => $obj['day_index'],
                        'hour_start' => $obj['hour_start'],
                    ];
                }
                $updateUser['schedule_settings'] = $scheduleSetting;
                $updateUser['profile'] = [
                    'session_duration'  => '50',
                    'session_break'     => '10',
                    'completed_profile' => 1
                ];

                $user = $this->Users->patchEntity($user, $updateUser);
                if ($this->Users->save($user)) {
                    return $this->responseJSON(true, 200);
                } else {
                    return $this->responseJSON($user->getErrors(), 400);
                }
            }
        }

        return $this->responseJSON(false, 400);
    }

    public function getSessionTime()
    {
        $user = $this->Users->get($this->Auth->user('id'), [
            'contain' => ['Profiles'],
        ]);

        return $this->responseJSON([
            'session_duration' => $user->profile->session_duration,
            'session_break'    => $user->profile->session_duration,
        ], 200);
    }
}
