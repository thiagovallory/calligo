<?php
declare(strict_types=1);

namespace App\Controller\Settings;

use Cake\Event\Event;
use Cake\Event\EventInterface;
use Cake\Utility\Security;
use Cake\Routing\Router;
use Cake\Core\Configure;

class CardsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadModel('Cards');
        $this->loadModel('States');
        $this->loadModel('Cities');
    }

    public function isAuthorized($user)
    {
        return true;
    }

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->viewBuilder()->setLayout('internal');
        $this->set('sidebar', 'account');
        $this->loadComponent('Iugu');
    }

    public function teste()
    {
        $res = [
            'success'  => true,
            'response' => 'Cartão salvo com sucesso.'
        ];
        return $this->responseJSON($res, 200);
    }

    public function index()
    {
        $cards    = [];
        $response = $this->Iugu->cards_list($this->Auth->user('iugu_customer_id'));
        if ($response['status'] === 200) {
            foreach ($response['data'] as $key => $card) {
                $card['data']['id'] = $response['data'][$key]['id'];
                $cards[] = $card['data'];
            }
        }
        $states = $this->States->getList();
        $cities = $this->Cities->getList();
        $years  = [];
        $year   = (int)date('Y');
        for ($i = $year - 5; $i < $year + 10; $i++) {
            $years[$i] = $i;
        }
        $this->set(compact('cards', 'states', 'cities', 'years'));
    }

    public function add($ajax = null)
    {
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $card = [
                'number'             => $data['number'],
                'verification_value' => $data['verification_value'],
                'first_name'         => $data['first_name'],
                'last_name'          => $data['last_name'],
                'month'              => $data['month'],
                'year'               => $data['year'],
                //                'address'            => $data['address'],
                //                'address_number'     => $data['address_number'],
                //                'complement'         => $data['complement'],
                //                'neighborhood'       => $data['neighborhood'],
                //                'zip_code'           => $data['zip_code'],
                //                'city_id'            => $data['city_id'],
                //                'state_id'           => $data['state_id'],
                //                'phone'              => $data['phone'],
                //                'emergency_phone'    => $data['emergency_phone']
            ];

            $fields = [
                'account_id' => Configure::read('IUGU_ID'),
                'method'     => 'credit_card',
                'data'       => $card,
//                'test'       => true
            ];

            $iugu = $this->Iugu->payment_token($fields);

            if ($iugu['status'] === 200) {
                $newCard  = [
                    'description' => 'Cartão de crédito',
                    'token'       => $iugu['data']['id'],
                ];
                $iuguCard = $this->Iugu->cards_add($this->Auth->user('iugu_customer_id'), $newCard);

                if ($iuguCard['status'] === 200) {
                    $res = [
                        'success'  => true,
                        'response' => 'Cartão salvo com sucesso.'
                    ];
                    return $this->responseJSON($res, 200);
                } else {
                    $res = [
                        'success'  => false,
                        'response' => $iuguCard['data']['errors']
                    ];
                    return $this->responseJSON($res, 400);
                }
            }

            if ($ajax) {
                return $this->responseJSON(false, 500);
            } else {
                $this->Flash->error(__('Erro, revise os dados e tente novamente'));
            }
        }

        return $this->redirect(['action' => 'index']);
    }

    public function delete($id)
    {
        $iuguCard = $this->Iugu->cards_delete($this->Auth->user('iugu_customer_id'), $id);
        return $this->redirect(['action' => 'index']);
    }
}
