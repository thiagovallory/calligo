<?php
declare(strict_types=1);

namespace App\Controller\Dashboard;

use Cake\Event\Event;
use Cake\Event\EventInterface;
use Cake\Utility\Security;
use Cake\Routing\Router;
use Cake\Core\Configure;

class SchedulesController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadModel('Appointments');
        $this->loadModel('BlockedSchedules');
        $this->loadModel('Bonds');
    }

    public function isAuthorized($user)
    {
        // TODO V1
        // return false;

        // para v2
        if ($user) {
            return true;
        }
        return false;
    }

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->viewBuilder()->setLayout('internal');
        if ($this->Auth->user('role') == 2) {
            $this->set('sidebar', 'dashboard');
        } else {
            $this->set('sidebar', 'my');
        }
    }

    public function index()
    {
        if ($this->Auth->user('role') == 1) {
            $appointmentPath = Router::url(['controller'=>'Users','action'=>'search', 'prefix' => false]);
            $therapist = $this->Bonds->getMyTherapist($this->Auth->user('id'));

            if (!empty($therapist))
                $appointmentPath = Router::url(['controller'=>'Users','action'=>'profile', 'prefix' => false]) . '/' . $therapist['therapist_id'];

            $this->set(compact('appointmentPath'));
        }
    }

    public function getCalendar($period)
    {
        return $this->responseJSON($this->Appointments->getCalendar($this->Auth->user('id'), $this->Auth->user('role'), $period), 200);
    }

    public function blockSchedule()
    {
        $data = [
            'user_id' => $this->Auth->user('id'),
            'begin'   => $this->request->getData('begin'),
            'end'     => $this->request->getData('end'),
        ];

        $blockedSchedules = $this->BlockedSchedules->newEmptyEntity();
        $blockedSchedules = $this->BlockedSchedules->patchEntity($blockedSchedules, $data);

        if ($this->BlockedSchedules->save($blockedSchedules)) {
            return $this->responseJSON(true, 204);
        } else {
            return $this->responseJSON($blockedSchedules->getErrors(), 400);
        }
    }
}
