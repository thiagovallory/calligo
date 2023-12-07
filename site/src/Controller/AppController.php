<?php
declare(strict_types=1);

namespace App\Controller;

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

        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
            'authorize'=> 'Controller',
            'authenticate' => [
                'Form' => [
                    'fields' => [],
                    'finder' => 'auth'
                ]
            ],
            'loginAction' => [
                'controller' => 'Users',
                'action' => 'login'
            ],
            'loginRedirect' => [
                'controller' => 'Dashboard',
                'action' => 'index'
            ],
            'logoutRedirect' => [
                'controller' => 'Pages',
                'action' => 'home'
            ],
            'unauthorizedRedirect' => true,
            'loginError' => 'Credenciais inválidas.',
            'authError' => 'Você não possui privilégios para acessar este área do site.'
        ]);

        // Permite a ação display, assim nosso pages controller
        //$this->Auth->allow(['display']);

        /*
         * Enable the following component for recommended CakePHP form protection settings.
         * see https://book.cakephp.org/4/en/controllers/components/form-protection.html
         */
        //$this->loadComponent('FormProtection');
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

        $_isMobile = $this->request->is('mobile');

        $this->set(compact('_userLogged', '_isMobile'));
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

    public function getPhoneAttr($attr, $string){
        $number = preg_replace("/[^0-9]/", "", $string);
        if ($attr=='phone_prefix'){
           return substr($number, 0, 2);
        } else {
            return substr($number, 2);
        }
    }

}
