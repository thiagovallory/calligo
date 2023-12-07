<?php
declare(strict_types=1);

namespace App\Controller\Settings;

use Cake\Controller\Controller;
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
            'authorize'            => 'Controller',
            'authenticate'         => [
                'Form' => [
                    'fields' => [],
                    'finder' => 'auth'
                ]
            ],
            'unauthorizedRedirect' => false,
            'loginAction'          => [
                'prefix'     => false,
                'controller' => 'Users',
                'action'     => 'login',
            ],
            'loginError'           => 'E-mail ou senha incorreta.',
            'authError'            => 'Você não possui privilégios para acessar este área do site.'
        ]);
        $this->loadComponent('Paginator');
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $_userLogged = $this->Auth->user();
        if (($_userLogged) && (!isset($_userLogged['profile']['photo']))){
            $this->loadModel('Users');
            $user = $this->Users->get($this->Auth->user('id'), [
                'contain' => ['Profiles'],
            ])->toArray();
            $_userLogged['profile'] = $user['profile'];
        }
        $this->set(compact('_userLogged'));
    }

    public function responseJSON($data, $status = 200)
    {
        $response = $this->response->withType('json')
            ->withStringBody(json_encode($data))
            ->withCharset('UTF-8')
            ->withStatus($status);

        return $response;
    }

    public function sendEmail($mailto, $subject, $vars, $template = 'default')
    {
        try {
            $mailer = new Mailer(Configure::read('MAILER'));
            $mailer
                ->setEmailFormat('html')
                ->setTo($mailto)
                ->setSubject($subject)
                ->viewBuilder()
                ->setTemplate($template);

            $mailer->setViewVars(['data' => $vars]);
            $mailer->deliver();

            return $mailer->getMessage()->getBodyString();
        } catch (\Exception $e) {
            Log::debug($e->getMessage());
        }
        return false;
    }

}

