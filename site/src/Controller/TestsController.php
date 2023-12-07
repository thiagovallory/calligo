<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\View\Exception\MissingTemplateException;
use Cake\Event\Event;
use Cake\Event\EventInterface;

class TestsController extends AppController
{

    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Iugu');
    }

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['pagarporboleto', 'pagarporcartao']);
    }

    public function pagarporboleto()
    {
        //debug($this->Iugu->gerar_boleto());
        debug($this->Iugu->gerar_pgtocartao());
        die;


    }

    public function pagarporcartao()
    {

    }

    
}
