<?php
declare(strict_types=1);

namespace App\Controller\Webhooks;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\View\Exception\MissingTemplateException;
use Cake\Event\Event;
use Cake\Event\EventInterface;

class IuguController extends AppController
{

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $tokenIugu = $this->request->getHeader('Authorization');
        $tokenConfig = Configure::read('IUGU_WEBHOOKS_TOKEN');
        if ((isset($tokenIugu[0])) && ($tokenIugu[0]==$tokenConfig)){
            return true;
        } else {
            die('not authorized');
        }
    }

    public function all(){
        $vars['data1'] = $this->request->getData();
        $vars['data2'] = $this->request->getParsedBody();
        $vars['data3'] = $this->request->getHeader('Accept');
        $vars['data4'] = $this->request->getHeader('Authorization');
        $vars['data5'] = $this->request->getHeader('User-Agent');
        
        //echo "<pre>"; print_r($vars); echo "</pre>";
        $this->sendEmail('gustavo.souza@brave.ag', 'Fatura', $vars, 'teste');
        die;
    }

}
