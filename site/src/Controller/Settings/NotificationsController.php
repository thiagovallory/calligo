<?php
declare(strict_types=1);

namespace App\Controller\Settings;

use Cake\Event\EventInterface;

class NotificationsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    public function isAuthorized($user)
    {
        // TODO V1
        //return true;
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
            'contain' => ['Notifications'],
        ]);

        $this->set(compact('user'));
    }

    public function changeNotification()
    {
        $user = $this->Users->get($this->Auth->user('id'), [
            'contain' => ['Notifications'],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $updateNotifications = [
                'notification' => [
                    $this->request->getData('field') => $this->request->getData('value')
                ]
            ];

            $user = $this->Users->patchEntity($user, $updateNotifications);
            if ($this->Users->save($user)) {
                return $this->responseJSON(false, 204);
            } else {
                return $this->responseJSON($user->getErrors(), 400);
            }
        }

        return $this->responseJSON(false, 400);
    }
}
