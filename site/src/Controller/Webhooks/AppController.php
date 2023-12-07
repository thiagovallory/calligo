<?php
declare(strict_types=1);

namespace App\Controller\Webhooks;

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
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
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
