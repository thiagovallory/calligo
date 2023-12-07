<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Core\Configure;
use Cake\Http\Client;
use Cake\Routing\Router;

class IuguComponent extends Component
{
    private $http;
    private $iugu_token;

    public function __construct(ComponentRegistry $registry, array $config = [])
    {
        parent::__construct($registry, $config);
        $this->iugu_token = Configure::read('IUGU_TOKEN');

        $this->http = new Client([
            'host'    => 'api.iugu.com/v1',
            'scheme'  => 'https',
            'headers' => [
                'Authorization' => 'Basic ' . base64_encode($this->iugu_token),
                'Accept'        => 'application/json',
                'Content-Type'  => 'application/json'
            ]
        ]);
    }

    public function retrieve_subaccounts_api_token()
    {
        $response = $this->http->get('/retrieve_subaccounts_api_token');
        return ['status' => $response->getStatusCode(), 'data' => $response->getJson()];
    }

    public function create_account($fields)
    {
        $response = $this->http->post('/marketplace/create_account', json_encode($fields));
        return ['status' => $response->getStatusCode(), 'data' => $response->getJson()];
    }

    public function subaccount_verify($account_id, $user_token, $fields)
    {
        $response = $this->http->post('/accounts/' . $account_id . '/request_verification?api_token=' . $user_token, json_encode($fields));
        return ['status' => $response->getStatusCode(), 'data' => $response->getJson()];
    }

    public function subaccount_bank_verify($user_token, $fields)
    {
        $response = $this->http->post('/bank_verification?api_token=' . $user_token, json_encode($fields));
        return ['status' => $response->getStatusCode(), 'data' => $response->getJson()];
    }

    public function create_customer($fields)
    {
        $response = $this->http->post('/customers', json_encode($fields));
        return ['status' => $response->getStatusCode(), 'data' => $response->getJson()];
    }

    public function create_customer_subaccount($token, $fields)
    {
        $http = new Client([
            'host'    => 'api.iugu.com/v1',
            'scheme'  => 'https',
            'headers' => [
                'Authorization' => 'Basic ' . base64_encode($token),
                'Accept'        => 'application/json',
                'Content-Type'  => 'application/json'
            ]
        ]);

        $response = $http->post('/customers', json_encode($fields));
        return ['status' => $response->getStatusCode(), 'data' => $response->getJson()];
    }

    public function get_customer($customer_id)
    {
        $response = $this->http->get('/customers/' . $customer_id);
        return ['status' => $response->getStatusCode(), 'data' => $response->getJson()];
    }

    public function edit_customer_subaccount($token, $customer_id, $fields)
    {
        $http = new Client([
            'host'    => 'api.iugu.com/v1',
            'scheme'  => 'https',
            'headers' => [
                'Authorization' => 'Basic ' . base64_encode($token),
                'Accept'        => 'application/json',
                'Content-Type'  => 'application/json'
            ]
        ]);

        $response = $http->put('/customers/' . $customer_id, json_encode($fields));
        return ['status' => $response->getStatusCode(), 'data' => $response->getJson()];
    }

    public function payment_token($fields)
    {
        $response = $this->http->post('/payment_token', json_encode($fields));
        return ['status' => $response->getStatusCode(), 'data' => $response->getJson()];
    }

    public function cards_add($iugu_udid, $fields)
    {
        $response = $this->http->post('/customers/' . $iugu_udid . '/payment_methods', json_encode($fields));
        return ['status' => $response->getStatusCode(), 'data' => $response->getJson()];
    }

    public function cards_delete($customer_id, $card_id)
    {
        $response = $this->http->delete('customers/' . $customer_id . '/payment_methods/' . $card_id);
        return ['status' => $response->getStatusCode(), 'data' => $response->getJson()];
    }

    public function cards_list($customer_id)
    {
        $response = $this->http->get('customers/' . $customer_id . '/payment_methods');
        return ['status' => $response->getStatusCode(), 'data' => $response->getJson()];
    }

    public function charge($token, $fields)
    {
        $http = new Client([
            'host'    => 'api.iugu.com/v1',
            'scheme'  => 'https',
            'headers' => [
                'Authorization' => 'Basic ' . base64_encode($token),
                'Accept'        => 'application/json',
                'Content-Type'  => 'application/json'
            ]
        ]);

        $response = $http->post('/charge', json_encode($fields));
        return ['status' => $response->getStatusCode(), 'data' => $response->getJson()];
    }
}
