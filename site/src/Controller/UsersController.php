<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\Event;
use Cake\Event\EventInterface;
use Cake\Utility\Security;
use Cake\Routing\Router;
use Cake\Core\Configure;
use Cake\I18n\FrozenDate;
use Cake\I18n\FrozenTime;

class UsersController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Iugu');
        $this->loadModel('BlockedSchedules');
    }

    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');
        //actions sempre permitidas
        if (in_array($action, [
                'index',
                'add',
                'resendmail',
                'forgotpassword',
                'logout',
                'addSelectType',
                'profile',
                'search',
                'getSchedule',
                'scheduleAppointment',
            ]
        )) {
            return true;
        }

        // Todas as outras ações requerem um id.
        if ($this->request->getParam('pass.0') != null) {
            $id       = $this->request->getParam('pass.0');
            $register = $this->Users->get($id);
            if ($register->id == $user['id']) {
                return true;
            }
        }

        if (in_array($action, ['xxxxxxx'])) {
            if ($user['role'] == 2) {
                return true;
            }
        }

        return false;
    }

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['addSelectType', 'add', 'active', 'resendmail', 'forgotpassword', 'search', 'profile', 'getSchedule']);
    }

    public function addSelectType()
    {
        $this->viewBuilder()->setLayout('nofooter');
    }

    public function add()
    {
        $this->viewBuilder()->setLayout('nofooter');
        $crp_origins = Configure::read('CRP_ORIGINS');

        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $data                                          = $this->request->getData();
            $data['active']                                = 0;
            $data['first_login']                           = 1;
            $data['hash_active']                           = Security::hash($data['name'] . date('Ymd His') . uniqid());
            $data['not_employee']                          = (isset($data['not_employee'])) ? $data['not_employee'] : 0;
            $data['link_active']                           = $this->_generateUrlToActive($data['hash_active']);
            $data['notification']['sms_update_news']       = 1;
            $data['notification']['sms_update_terms']      = 1;
            $data['notification']['sms_clinic_schedule']   = 1;
            $data['notification']['sms_clinic_therapy']    = 1;
            $data['notification']['sms_clinic_messages']   = 1;
            $data['notification']['sms_learn_news']        = 1;
            $data['notification']['sms_learn_offers']      = 1;
            $data['notification']['email_update_news']     = 1;
            $data['notification']['email_update_terms']    = 1;
            $data['notification']['email_clinic_schedule'] = 1;
            $data['notification']['email_clinic_therapy']  = 1;
            $data['notification']['email_clinic_messages'] = 1;
            $data['notification']['email_learn_news']      = 1;
            $data['notification']['email_learn_offers']    = 1;

            $user = $this->Users->patchEntity($user, $data);
            if ($this->Users->save($user)) {
                $this->sendEmail($data['username'], 'Ative seu cadastro', $data, 'user_add');
                return $this->redirect(['action' => 'add', '?' => ['status' => 'success', 'email' => $data['username']]]);
            } else {
                $this->Flash->error(__('Erro ao tentar salvar os dados.'));
            }
        }
        $this->set(compact('user', 'crp_origins'));
    }

    public function resendmail()
    {
        $data = $this->Users->getRuleResendEmail($this->request->getQuery('email'));
        if ($data) {
            $data['link_active'] = $this->_generateUrlToActive($data['hash_active']);
            $this->sendEmail($data['username'], 'Ative seu cadastro', $data, 'user_add');
            return $this->responseJSON(true, 200);
        }

        return $this->responseJSON(false, 404);
    }

    public function active($hash)
    {
        $success = false;
        if ($this->Users->setActive($hash)) {
            if ($this->_addSubaccountToIugu($hash)) {
                $success = true;
            }
        }
        $this->set('success', $success);
    }

    public function forgotpassword()
    {
        $data = $this->Users->getRuleForgotPassword($this->request->getQuery('email'));
        if ($data) {
            $this->sendEmail($data['username'], 'Recuperação de senha', $data, 'user_forgotpassword');
            return $this->responseJSON(true, 200);
        }
        return $this->responseJSON(false, 400);
    }

    private function _generateUrlToActive($hash)
    {
        return Router::url(['controller' => 'Users', 'action' => 'active', '_full' => true]) . '/' . $hash;
    }


    public function index()
    {
        $this->redirect('/');
    }

    public function teste()
    {
        return $this->responseJSON($this->Users->find('all'), 400);
    }

    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Ages', 'Characteristics', 'Langs', 'Problems', 'Specialties', 'Therapies', 'AcademicBackgrounds', 'ModalitiesHasUsers', 'Notifications', 'PaymentMethods', 'Products', 'Profiles', 'Reviews'],
        ]);

        $this->set(compact('user'));
    }


    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Ages', 'Characteristics', 'Langs', 'Problems', 'Specialties', 'Therapies'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Dados salvos com sucesso'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Erro ao tentar salvar os dados'));
        }
        $ages            = $this->Users->Ages->find('list', ['limit' => 200]);
        $characteristics = $this->Users->Characteristics->find('list', ['limit' => 200]);
        $langs           = $this->Users->Langs->find('list', ['limit' => 200]);
        $problems        = $this->Users->Problems->find('list', ['limit' => 200]);
        $specialties     = $this->Users->Specialties->find('list', ['limit' => 200]);
        $therapies       = $this->Users->Therapies->find('list', ['limit' => 200]);
        $this->set(compact('user', 'ages', 'characteristics', 'langs', 'problems', 'specialties', 'therapies'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user     = $this->Users->get($id);
        $hash     = $user->hash_active;
        $roleUser = $user->role;

        if ($this->Users->delete($user)) {
            if ($roleUser == 2) {
                if ($this->_deleteSubaccountIugu($hash)) {
                    $this->Flash->success(__('Dados salvos com sucesso'));
                } else {
                    $this->Flash->error(__('Erro ao tentar salvar os dados'));
                }

            } else {
                $this->Flash->success(__('Dados salvos com sucesso'));
            }
        } else {
            $this->Flash->error(__('Erro ao tentar salvar os dados'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function login()
    {
        $this->viewBuilder()->setLayout('nofooter');

        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                $userEntity            = $this->Users->get($user['id']);
                $userEntity->active    = 1;
                $userEntity->to_remove = 0;
                $this->Users->save($userEntity);
                if ($this->Users->Profiles->verifyProfileCompleted($user['id'])) {
                    return $this->redirect($this->Auth->redirectUrl());
                } else {
                    return $this->redirect(['controller' => 'Account', 'action' => 'index', 'prefix' => 'Settings']);
                }

            }
            $this->Flash->error('Credenciais incorretas.');
        }
    }

    public function logout()
    {
        //$this->Flash->success('Você foi deslogado.'); // TODO: mensagem aparece sem estilo e quebra o layout
        return $this->redirect($this->Auth->logout());
    }

    //funcoes de subconta
    private function _addSubaccountToIugu($hash)
    {
        $user = $this->Users->getByHash($hash);

        $fields = [
            'email' => $user['username'],
            'name'  => $user['name'],
        ];

        $response = $this->Iugu->create_customer($fields);

        if ($response['status'] === 200) {
            $this->Users->setIuguCustomerId($user['id'], $response['data']['id']);
        }

        if ($user['role'] == 2) {
            $fields = [
                'name'   => "Terapeuta - " . $user['name'],
                'splits' => [
                    [
                        'recipient_account_id' => Configure::read('IUGU_ID'),
                        'percent'              => 20,
                    ]
                ]
            ];
            $iugu   = $this->Iugu->create_account($fields);

            if ($iugu['status'] === 200) {
                if (($this->Users->setIuguUDID($user['id'], $iugu['data']['account_id'])) && ($this->Users->setIuguTokens($user['id'], $iugu['data']['live_api_token'], $iugu['data']['test_api_token'], $iugu['data']['user_token']))) {
                    return true;
                }
            }

            return false;
        }

        return true;
    }

    public function _deleteSubaccountIugu($hash)
    {
        $user   = $this->Users->getByHash($hash);
        $id     = null;
        $utoken = null;

        if ($user['role'] == 2) {
            $iugu = $this->Iugu->subaccount_delete($id, $utoken);

            if ($iugu['success']) {
                return true;
            }

            return false;
        }

        return true;
    }

    public function profile($id = 0)
    {
        try {
            $user = $this->Users->find()
                ->where(['user_id' => $id, 'role' => 2, 'completed_profile' => true])
                ->contain([
                    'AcademicBackgrounds',
                    'Ages',
                    'Characteristics',
                    'Costs'           => ['Modalities'],
                    'Langs',
                    'Problems',
                    'Profiles',
                    'ReviewsReceived' => [
                        'Reviewer',
                        'queryBuilder' => function ($q) {
                            return $q->order(['ReviewsReceived.created' => 'DESC'])->limit(10);
                        },
                    ],
                    'Specialties',
                    'Therapies',
                ])->firstOrFail();
        } catch (\Exception $e) {
            return $this->redirect(['action' => 'search']);
        }

        foreach ($user['reviews_received'] as &$item) {
            $initials                  = explode(' ', $item['reviewer']['name']);
            $item['reviewer']['abbrv'] = '';
            foreach ($initials as $initial) {
                $item['reviewer']['abbrv'] .= $initial[0] . '.';
            }
        }

        $appointments = $this->Users->getAppointmentsCount($id);
        $clients      = $this->Users->getClientsCount($id);

        [$schedule_settings, $week_days, $week, $time_zones, $month, $year] = $this->getScheduleData($id);

        $academic_background_types = Configure::read('ACADEMIC_BACKGROUNDS_TYPES');

        $this->set(compact(
            'user',
            'academic_background_types',
            'appointments',
            'clients',
            'schedule_settings',
            'time_zones',
            'week',
            'month',
            'year',
            'week_days'
        ));
    }

    public function search()
    {
        $param['text']         = ($this->request->getQuery('text')) ? $this->request->getQuery('text') : null;
        $param['problems']     = ($this->request->getQuery('problems')) ? $this->request->getQuery('problems') : null;
        $param['session_type'] = ($this->request->getQuery('session_type')) ? $this->request->getQuery('session_type') : null;
        if ($this->Auth->user('role') == 2) {
            $param['attendance_type'] = [6]; // Supervisão Técnica, tabela modalities
        } else {
            $param['attendance_type'] = ($this->request->getQuery('attendance_type')) ? $this->request->getQuery('attendance_type') : null;
        }
        $param['cost_value']           = ($this->request->getQuery('cost_value')) ? $this->request->getQuery('cost_value') : null;
        $param['therapies']            = ($this->request->getQuery('therapies')) ? $this->request->getQuery('therapies') : null;
        $param['ages']                 = ($this->request->getQuery('ages')) ? $this->request->getQuery('ages') : null;
        $param['gender']               = ($this->request->getQuery('gender')) ? $this->request->getQuery('gender') : null;
        $param['time_work_experience'] = ($this->request->getQuery('time_work_experience')) ? $this->request->getQuery('time_work_experience') : null;
        $param['langs']                = ($this->request->getQuery('langs')) ? $this->request->getQuery('langs') : null;
        $param['characteristics']      = ($this->request->getQuery('characteristics')) ? $this->request->getQuery('characteristics') : null;
        $param['max_date']             = ($this->request->getQuery('max_date')) ? $this->request->getQuery('max_date') : null;
        $param['time']                 = ($this->request->getQuery('time')) ? $this->request->getQuery('time') : null;
        $param['crp_origin']           = ($this->request->getQuery('crp_origin')) ? $this->request->getQuery('crp_origin') : null;

        $this->paginate = [];
        $users          = $this->paginate($this->Users->getQueryToSearch($param));
        foreach ($users as $user) {
            $user['data'] = $this->getScheduleData($user['id']);
        }

        $selects = $this->_normalizeSelectsToFormSearch($param);
        $inputs  = $this->_normalizeInputsToFormSearch($param);

        $this->set(compact('users', 'selects', 'inputs'));
    }

    private function _normalizeSelectsToFormSearch($param)
    {
        $limit_date_attendance      = new FrozenDate(date('Y-m-d'));
        $selects['problems']        = $this->Users->Problems->getList();
        $selects['session_type']    = Configure::read('SESSION_TYPE');
        $selects['attendance_type'] = $this->Users->Costs->Modalities->getList();
        $selects['therapies']       = $this->Users->Therapies->getList();
        $selects['ages']            = $this->Users->Ages->getList();
        $selects['genders']         = Configure::read('GENDERS');
        $selects['langs']           = $this->Users->Langs->getList();
        $selects['characteristics'] = $this->Users->Characteristics->getList();
        $selects['max_date']        = $limit_date_attendance->modify(Configure::read('TIME_OF_DEADLINE_FOR_SEARCH'));
        $selects['time']            = [];
        $selects['states']          = Configure::read('CRP_ORIGINS');


        foreach ($selects['problems'] as $key => $obj) {
            $selected = null;
            if ($param['problems']) : foreach ($param['problems'] as $kP => $prob) {
                if ($obj['id'] == $prob) $selected = 'selected';
            } endif;
            $selects['problems'][$key]['selected'] = $selected;
        }

        foreach ($selects['session_type'] as $key => $obj) {
            $selected = null;
            if ($param['session_type']) : foreach ($param['session_type'] as $kP => $prob) {
                if ($obj['id'] == $prob) $selected = 'selected';
            } endif;
            $selects['session_type'][$key]['selected'] = $selected;
        }

        foreach ($selects['attendance_type'] as $key => $obj) {
            $selected = null;
            if ($param['attendance_type']) : foreach ($param['attendance_type'] as $kP => $prob) {
                if ($obj['id'] == $prob) $selected = 'selected';
            } endif;
            $selects['attendance_type'][$key]['selected'] = $selected;
        }

        foreach ($selects['therapies'] as $key => $obj) {
            $selected = null;
            if ($param['therapies']) : foreach ($param['therapies'] as $kP => $prob) {
                if ($obj['id'] == $prob) $selected = 'selected';
            } endif;
            $selects['therapies'][$key]['selected'] = $selected;
        }

        foreach ($selects['ages'] as $key => $obj) {
            $selected = null;
            if ($param['ages']) : foreach ($param['ages'] as $kP => $prob) {
                if ($obj['id'] == $prob) $selected = 'selected';
            } endif;
            $selects['ages'][$key]['selected'] = $selected;
        }

        foreach ($selects['langs'] as $key => $obj) {
            $selected = null;
            if ($param['langs']) : foreach ($param['langs'] as $kP => $prob) {
                if ($obj['id'] == $prob) $selected = 'selected';
            } endif;
            $selects['langs'][$key]['selected'] = $selected;
        }

        foreach ($selects['characteristics'] as $key => $obj) {
            $selected = null;
            if ($param['characteristics']) : foreach ($param['characteristics'] as $kP => $prob) {
                if ($obj['id'] == $prob) $selected = 'selected';
            } endif;
            $selects['characteristics'][$key]['selected'] = $selected;
        }

        return $selects;
    }

    public function _normalizeInputsToFormSearch($param)
    {
        $inputs['cost_value']['min']   = 0;
        $inputs['cost_value']['max']   = $this->Users->Costs->getToMaxPrice();
        $inputs['cost_value']['start'] = $inputs['cost_value']['min'];
        $inputs['cost_value']['end']   = $inputs['cost_value']['max'];

        $inputs['time_work_experience']['min']   = 0;
        $inputs['time_work_experience']['max']   = $this->Users->Profiles->getToMaxTimeWorkExperience();
        $inputs['time_work_experience']['start'] = $inputs['time_work_experience']['min'];
        $inputs['time_work_experience']['end']   = $inputs['time_work_experience']['max'];

        if ($param['time_work_experience']) {
            $tmp                                     = explode('-', $param['time_work_experience']);
            $inputs['time_work_experience']['start'] = $tmp[0];
            $inputs['time_work_experience']['end']   = $tmp[1];
        }

        $inputs['text'] = $param['text'];

        return $inputs;
    }

    public function getSchedule()
    {
        $range        = 7; // Configure::read('TIME_OF_DEADLINE_FOR_SEARCH');
        $months       = Configure::read('MONTHS_PORT');
        $profile_id   = $this->request->getQuery('profile_id');
        $initial_date = $this->request->getQuery('initial_date');
        $day          = new FrozenDate($this->request->getQuery('initial_date'));
        $days         = [];
        for ($i = 0; $i < $range; $i++) {
            $days[] = $day->addDay($i)->format('Y-m-d');
        }

        [$schedule_settings, $week_days] = $this->getScheduleData($profile_id, $initial_date);

        return $this->responseJSON([
                'abbrv'    => $week_days,
                'days'     => $days,
                'month'    => $months[(int)$day->format('m')],
                'year'     => $day->format('Y'),
                'schedule' => $schedule_settings,
            ]
            , 200);
    }

    public function scheduleAppointment()
    {
        $user = $this->Users->get($this->Auth->user('id'));

        if ($this->request->is(['patch', 'post', 'put'])) {

            if ($user->role == 1) {
                $therapist_id = $this->request->getData('therapist_id');
                $patient_id   = $this->Auth->user('id');
                $modality_id  = $this->request->getData('modality_id');
                $mode         = $this->request->getData('mode');
                $day          = $this->request->getData('day');
                $hour         = $this->request->getData('hour');

                if (!$this->Users->Profiles->isRuleCrpAndEpsiValid($therapist_id)) {
                    return $this->responseJSON(['error' => 'CRP ou E-psi fora da validade!'], 400);
                }

                if (empty($modality_id))
                    return $this->responseJSON(['error' => 'É obrigatório selecionar o tipo de terapia!'], 400);

                $cost = $this->Users->Costs->find('all', [
                    'conditions' => [
                        'user_id'     => $therapist_id,
                        'modality_id' => $modality_id
                    ]
                ])->first();

                if ($this->Users->Clients->isRuleAssociatedOtherTherapistBond($patient_id, $therapist_id))
                    return $this->responseJSON(['error' => 'Não permitido, já tem vinculo pendente ou ativo com outro terapeuta!'], 400);


                if (empty($therapist_id))
                    return $this->responseJSON(['error' => 'therapist_id is null'], 400);

                $therapist = $this->Users->get($therapist_id);

                if ($therapist->role != 2)
                    return $this->responseJSON(['error' => 'therapist_id is not a therapist'], 400);

                $isPatientByTherapist = $this->Users->Clients->isRuleIsPatientByTherapist($patient_id, $therapist_id);

                $data = [
                    'therapist_id' => $therapist_id,
                    'patient_id'   => $patient_id,
                    'modality_id'  => $modality_id,
                    'price'        => $cost['value_full'],
                    'mode'         => $mode,
                    'day'          => $day,
                    'hour'         => $hour,
                    'status'       => 4,
                    //'status'       => ($isPatientByTherapist) ? 4 : 2,
                ];

            } elseif ($user->role == 2) {
                $therapist_id = $this->request->getData('therapist_id');
                $patient_id   = $this->Auth->user('id');
                $modality_id  = $this->request->getData('modality_id');
                $mode         = $this->request->getData('mode');
                $day          = $this->request->getData('day');
                $hour         = $this->request->getData('hour');
                $cost         = $this->Users->Costs->find('all', [
                    'conditions' => [
                        'user_id'     => $therapist_id,
                        'modality_id' => $modality_id
                    ]
                ])->first();

                if (empty($patient_id)) {
                    return $this->responseJSON(['error' => 'patient_id is null'], 400);
                }

                if (empty($modality_id)) {
                    return $this->responseJSON(['error' => 'modalidade inválida para'], 400);
                }

                //$patient = $this->Users->get($patient_id);
                //if ($patient->role != 1) {
                //    return $this->responseJSON(['error' => 'patient_id is not a patient'], 400);
                //}

                $now  = new FrozenTime(date('Y-m-d H:i:s'));
                $data = [
                    'therapist_id'   => $therapist_id,
                    'patient_id'     => $patient_id,
                    'modality_id'    => $modality_id,
                    'price'          => $cost['value_full'],
                    'mode'           => $mode,
                    'day'            => $day,
                    'hour'           => $hour,
                    'status'         => 4,
                    'reserved_until' => $now->modify(Configure::read('TIME_ALLOWED_FOR_APPOINTMENT_PAYMENT'))
                ];
            }

            $appointment     = $this->Users->AppointmentsMade->newEntity($data);
            $saveAppointment = $this->Users->AppointmentsMade->save($appointment);
            if ($saveAppointment) {
                $next            = null;
                $data['id']      = $saveAppointment->id;
                $data['patient'] = $this->Auth->user();
                if ($user->role == 1) {
                    if (!$isPatientByTherapist) {
                        $this->Users->Clients->createBlondPending($therapist_id, $patient_id);
                    }
                    // else {

                    //     $this->Users->Clients->createBlondPending($therapist_id,$patient_id);
                    //     $this->sendEmail($data['patient']['username'], 'Consulta aguardando aprovação do terapeuta', $data, 'scheduled_appointment_waiting_therapist');
                    //     $next = 'waiting_therapist';
                    // }
                    $this->sendEmail($data['patient']['username'], 'Consulta agendada : faça o pagamento', $data, 'scheduled_appointment_waiting_payment');
                    $next = 'payment';
                } else {
                    //TODO um terapeuta marca consulta, o que ocorre?
                }

                return $this->responseJSON(['next' => $next, 'appoitment_id' => $saveAppointment->id], 200);
            } else {
                return $this->responseJSON($appointment->getErrors(), 400);
            }
        }
        return $this->responseJSON(false, 400);
    }

    public function getScheduleData($id, $monday = null)
    {
        if (!$monday) {
            $monday = strtotime('monday this week');
        } else {
            $monday = strtotime($monday);
        }

        $date = new FrozenDate($monday);

        $blocks            = $this->BlockedSchedules->getWeekBlocks($id, $date->format('Y-m-d'));
        $schedule_settings = $this->Users->ScheduleSettings->getList($id);
        foreach ($schedule_settings as $key => $schedule_setting) {
            foreach ($schedule_setting as $key2 => &$item) {
                $item['date'] = $date->addDays($key)->format('Y-m-d');
//                if($this->BlockedSchedules->isScheduleBlocked($id, $item['date'] . ' '. $item['hour'])) {
//                    unset($schedule_settings[$key][$key2]);
//                }
                foreach ($blocks as $block) {
                    if (
                        (($block['begin']->format('Y-m-d H:i')) <= ($item['date'] . ' ' . $item['hour'])) &&
                        (($block['end']->format('Y-m-d H:i')) >= ($item['date'] . ' ' . $item['hour']))
                    ) {
                        unset($schedule_settings[$key][$key2]);
                    }
                }
            }
        }

        $appointments_week = $this->Users->AppointmentsMade->getWeekAppointments($id, date('Y-m-d', $monday));
        $this->_checkSchedule($schedule_settings, $appointments_week);

        $time_zones = Configure::read('TIME_ZONES');
        $week_days  = Configure::read('DAYS_NAME_PORT');

        $months = Configure::read('MONTHS_PORT');
        $month  = $months[(int)date('m', $monday)];
        $year   = date('Y', $monday);
        $monday = date('d', $monday);

        $week = [
            0 => $monday + 0,
            1 => $monday + 1,
            2 => $monday + 2,
            3 => $monday + 3,
            4 => $monday + 4,
            5 => $monday + 5,
            6 => $monday + 6,
        ];

        return [$schedule_settings, $week_days, $week, $time_zones, $month, $year];
    }

    public function getClientsList($therapist_id)
    {
        return $this->Users->getClientsList($therapist_id);
    }

    private function _checkSchedule(&$schedule, $appointments)
    {
        foreach ($schedule as &$schedule_setting) {
            foreach ($schedule_setting as &$item) {
                $item['selected'] = false;
            }
        }

        foreach ($appointments as $appointment) {
            $weekday = $appointment['day']->format('w') == 0 ? 6 : $appointment['day']->format('w') - 1;
            foreach ($schedule[$weekday] as &$schedule_setting) {
                if ($appointment['hour_complet'] == $schedule_setting['hour']) {
                    $schedule_setting['selected'] = true;
                }
            }
        }
    }
}
