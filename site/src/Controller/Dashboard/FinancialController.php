<?php
declare(strict_types=1);

namespace App\Controller\Dashboard;

use Cake\Event\Event;
use Cake\Event\EventInterface;
use Cake\Utility\Security;
use Cake\Routing\Router;
use Cake\Core\Configure;

class FinancialController extends AppController
{
	public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadModel('Invoices');
    }

    public function isAuthorized($user)
    {    
        // TODO V1
        // return false;
        
        // para v2
        if ($user['role'] == 2){
            return true;
        }
        return false;
    }

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->viewBuilder()->setLayout('internal');
        $this->set('sidebar', 'dashboard');
    }

    public function index()
    {
        $order = ($this->request->getQuery('paymentOrder')) ? $this->request->getQuery('paymentOrder') : 0;
        $finacialType = ($this->request->getQuery('paymentType')) ? $this->request->getQuery('paymentType') : 0;
        $invoices = $this->paginate($this->Invoices->getQueryFinancial($this->Auth->user('id'), $order, $finacialType));
        $this->set(compact('invoices','order','finacialType'));
    }
}
