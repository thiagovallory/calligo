<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use Cake\Controller\Controller;
use Cake\Event\EventInterface;
use Cake\Log\Log;
use Cake\Mailer\Mailer;
use Cake\Core\Configure;

class AppController extends Controller
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
            'authorize'=> 'Controller',
            'authenticate' => [
                'Form' => [
                    'fields' => [],
                    'scope' => ['Users.role' => 3]
                ]
            ],
            'loginAction' => [
                'controller' => 'Users',
                'action' => 'login',
                'prefix' => 'Admin'
            ],
            'loginRedirect' => [
                'controller' => 'Users',
                'action' => 'index',
                'prefix' => 'Admin'
            ],
            'logoutRedirect' => [
                'controller' => 'Users',
                'action' => 'login',
                'prefix' => 'Admin'
            ],
            'unauthorizedRedirect' => true,
            'loginError' => 'Credenciais inválidas.',
            'authError' => 'Você não possui privilégios para acessar este área do site.'
        ]);
    }

    public function isAuthorized($user)
    {
        if ($user['role'] == 3) {
            return true;
        }

        return false;
    }

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->viewBuilder()->setLayout('Admin/admin');
    }

    public function responseJSON($data, $status=200){
        $response = $this->response->withType('json')
            ->withStringBody(json_encode($data))
            ->withCharset('UTF-8')
            ->withStatus($status);

        return $response;
    }

    public function sendEmail($mailto, $subject, $vars, $template = 'default'){
        try {
            $mailer = new Mailer(Configure::read('MAILER'));
            $mailer
                ->setEmailFormat('html')
                ->setTo($mailto)
                ->setSubject($subject)
                ->viewBuilder()
                ->setTemplate($template);

            $mailer->setViewVars(['data'=>$vars]);
            $mailer->deliver();

            return $mailer->getMessage()->getBodyString();
        } catch (\Exception $e) {
            Log::debug($e->getMessage());
        }
        return false;
    }

}
