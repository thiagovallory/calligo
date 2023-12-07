<?php
declare(strict_types=1);

namespace App\Controller\Settings;

use Cake\Auth\AbstractPasswordHasher;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Event\Event;
use Cake\Event\EventInterface;
use Cake\Utility\Security;
use Cake\Routing\Router;
use Cake\Core\Configure;
use Laminas\Diactoros\UploadedFile;

class AccountController extends AppController
{

    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Iugu');
        $this->loadModel('States');
        $this->loadModel('Cities');
        $this->loadModel('Users');
        $this->loadModel('Banks');
        $this->loadModel('FinancialInstitutions');
    }

    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');

        if (in_array($action, ['index',
                               'changeEmail', 'changeEmailSuccess',
                               'changePassword', 'changePasswordSuccess',
                               'forgotPassword', 'forgotPasswordSuccess',
                               'deactivateAccount', 'deleteAccount' //'xxx','yyy'
        ])) {
            return true;
        }

        if (in_array($action, ['bank'])) {
            if ($user['role'] == 2) {
                return true;
            }
        }

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
            'contain' => ['Profiles' => ['Titles'], 'EmergencyContacts', 'Problems'],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();

            if ($data['profile']['photo_base64']) {
                $filename = uniqid() . '.png';
                $file     = '/tmp/' . $filename;
                file_put_contents($file, file_get_contents($data['profile']['photo_base64']));
                $filesize                     = filesize($file);
                $media_type                   = mime_content_type($file);
                $data['profile']['photo_url'] = new UploadedFile($file, $filesize, 0, $filename, $media_type);
            }

            $updateUser = [
                'name'     => $data['name'],
                'username' => $data['username'],
                'profile'  => [
                    'document_number'   => $data['profile']['document_number'],
                    'gender'            => $data['profile']['gender'],
                    'pronoun'           => $data['profile']['pronoun'],
                    'telephone_number'  => $data['profile']['telephone_number'],
                    'birth_date'        => $data['profile']['birth_date'],
                    'default_language'  => $data['profile']['default_language'],
                    'default_time_zone' => $data['profile']['default_time_zone'],
                ]
            ];

            if (isset($data['profile']['photo_url'])) {
                $updateUser['profile']['photo_url'] = $data['profile']['photo_url'];
            }

            if ($this->Auth->user('role') == 2) {
                $updateUser['profile']['title_id']        = $data['profile']['title_id'];
                $updateUser['profile']['crp']             = $data['profile']['crp'];
                $updateUser['profile']['crp_expiration']  = $data['profile']['crp_expiration'];
                $updateUser['profile']['crp_origin']      = $data['profile']['crp_origin'];
                $updateUser['profile']['epsi']            = $data['profile']['epsi'];
                $updateUser['profile']['epsi_expiration'] = $data['profile']['epsi_expiration'];
                $updateUser['profile']['epsi_origin']     = $data['profile']['epsi_origin'];
            }

            if ($this->Auth->user('role') == 1) {
                if (!empty($data['problems'])) {
                    $updateUser['problems'] = $data['problems'];
                }

                $updateUser['emergency_contact'] = [
                    'id'               => $data['emergency_contact']['id'],
                    'name'             => $data['emergency_contact']['name'],
                    'telephone_number' => $data['emergency_contact']['telephone_number'],
                    'gender'           => $data['emergency_contact']['gender'],
                    'pronoun'          => $data['emergency_contact']['pronoun'],
                    'email'            => $data['emergency_contact']['email']
                ];
            }

            $user = $this->Users->patchEntity($user, $updateUser);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Dados salvos com sucesso'));
            } else {
                $this->Flash->error(__('Erro ao tentar salvar'));
            }
        }

        $genders                = Configure::read('GENDERS');
        $pronouns               = Configure::read('PRONOUNS');
        $time_zones             = Configure::read('TIME_ZONES');
        $bank_types             = Configure::read('BANKS_TYPES');
        $crp_origins            = Configure::read('CRP_ORIGINS');
        $languages              = $this->Users->Langs->getAllList();
        $titles                 = $this->Users->Profiles->Titles->getAllList();
        $financial_institutions = $this->Users->Banks->FinancialInstitutions->getList();
        $problems               = $this->Users->Problems->getList($user['problems']);
        $this->set(compact('user', 'genders', 'pronouns', 'languages', 'time_zones', 'bank_types', 'crp_origins', 'financial_institutions', 'problems', 'titles'));
    }

    public function changeEmail()
    {
        $user = $this->Users->get($this->Auth->user('id'));

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();

            if ((new DefaultPasswordHasher())->check($this->request->getData('current_password'), $user->password)) {

                $hash       = Security::hash($data['username'] . date('Ymd His') . uniqid());
                $updateUser = [
                    'name'             => $user['name'],
                    'username'         => $data['username'],
                    'username_confirm' => $data['username_confirm'],
                    'active'           => 0,
                    'hash_active'      => $hash,
                    'link_active'      => $this->_generateUrlToActive($hash),
                ];


                $user = $this->Users->patchEntity($user, $updateUser);
                if ($this->Users->save($user)) {
                    $this->sendEmail($updateUser['username'], 'Ative seu cadastro', $updateUser, 'user_add');
                    $this->redirect(['action' => 'change_email_success']);
                }
            } else {
                $user->setError('current_password', ['invalid' => 'Senha inválida']);
            }
        }

        $this->set(compact('user'));
    }

    public function changeEmailSuccess()
    {

    }

    private function _generateUrlToActive($hash)
    {
        return str_replace('/settings', '', Router::url(['controller' => 'Users', 'action' => 'active', '_full' => true, 'prefix' => null])) . '/' . $hash;
    }

    public function changePassword()
    {
        $user = $this->Users->get($this->Auth->user('id'));

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();

            if ((new DefaultPasswordHasher())->check($this->request->getData('current_password'), $user->password)) {
                $updateUser = [
                    'password'         => $data['password'],
                    'password_confirm' => $data['password_confirm']
                ];

                $user = $this->Users->patchEntity($user, $updateUser);
                if ($this->Users->save($user)) {
                    $this->redirect(['action' => 'change_password_success']);
                }
            } else {
                $user->setError('current_password', ['invalid' => 'Senha inválida']);
            }
        }

        $this->set(compact('user'));
    }

    public function changePasswordSuccess()
    {

    }

    public function deleteAccount()
    {
        $this->viewBuilder()->setLayout('nofooter');
        $user    = $this->Users->get($this->Auth->user('id'));
        $reasons = $this->Users->ReasonsUsers->Reasons->getList();

        if ($this->request->is(['patch', 'post', 'put'])) {
            if ((new DefaultPasswordHasher())->check($this->request->getData('current_password'), $user->password)) {
                if ($this->Users->deleteAccount($user, $this->request->getData('reason_id'))) {
                    return $this->redirect($this->Auth->logout());
                }
            } else {
                $user->setError('current_password', ['invalid' => 'Senha inválida']);
            }
        }
        $this->set(compact('user', 'reasons'));
    }

    public function deactivateAccount()
    {
        $this->viewBuilder()->setLayout('nofooter');
        $user    = $this->Users->get($this->Auth->user('id'));
        $reasons = $this->Users->ReasonsUsers->Reasons->getList();

        if ($this->request->is(['patch', 'post', 'put'])) {
            if ((new DefaultPasswordHasher())->check($this->request->getData('current_password'), $user->password)) {
                if ($this->Users->deactivateAccount($user, $this->request->getData('reason_id'))) {
                    return $this->redirect($this->Auth->logout());
                }
            } else {
                $user->setError('current_password', ['invalid' => 'Senha inválida']);
            }
        }
        $this->set(compact('user', 'reasons'));
    }

    public function forgotPassword()
    {
        $user = $this->Users->get($this->Auth->user('id'));
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->Users->getRuleForgotPassword($user->get('username'));
            if ($data) {
                $this->sendEmail($data['username'], 'Recuperação de senha', $data, 'user_forgotpassword');
                $this->redirect(['controller' => 'Account', 'action' => 'changePassword']);
            } else {
                $user->setError('username', ['invalid' => 'Email não encontrado.']);
            }
        }
        $this->redirect(['controller' => 'Account', 'action' => 'changePassword']);
    }

    public function bank()
    {
        $bank = $this->Users->get($this->Auth->user('id'),  ['contain' => ['Banks']]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();

            $updateBank = $data;

            $bank = $this->Users->patchEntity($bank, $updateBank);
            if ($this->Users->save($bank)) {
                if ($this->Auth->user('role') == 2) {
                    if ($this->_verifySubaccountIugu()) {
                        $this->Flash->success(__('Dados salvos com sucesso'));
                    } else {
                        $this->Flash->error(__('Erro ao tentar salvar na API'));
                    }
                } else {
                    $this->Flash->success(__('Dados salvos com sucesso'));
                }
            } else {
                $this->Flash->error(__('Erro ao tentar salvar'));
            }
        }

        $bank_types             = Configure::read('BANKS_TYPES');
        $financial_institutions = $this->Users->Banks->FinancialInstitutions->getList();
        $states                 = $this->States->getList();
        $cities                 = $this->Cities->getList();
        $this->set(compact('bank', 'bank_types', 'cities', 'states', 'financial_institutions'));
    }


    public function _verifySubaccountIugu()
    {
        $user = $this->Auth->user();

        if ($user['role'] == 2) {
            $user = $this->Users->get($this->Auth->user('id'),  ['contain' => ['Banks' => ['Cities', 'States']]]);
            $bank = $user->bank;
            $bank_name = $this->FinancialInstitutions->find('all', ['conditions' => ['id' => $bank['financial_institution_id']]])->first()->toArray(); // find bank info by user_id
            $doc       = $this->_getCpfCnpj($bank['document_number']);

            $fields = [
                'data' => [
                    'price_range'        => 'Até R$1000,00',
                    'physical_products'  => false,
                    'business_type'      => 'Terapia',
                    'person_type'        => $doc['type'],
                    'cep'                => $bank['cep'],
                    'address'            => $bank['address'],
                    'city'               => $bank['city']['name'],
                    'district'           => $bank['neighborhood'],
                    'state'              => $bank['state']['name'],
                    'telephone'          => $this->_getTelephone($bank['telephone']),
                    'bank_cc'            => $bank['account'],
                    'bank_ag'            => $bank['agency'],
                    'account_type'       => $bank['type'] == '1' ? 'Corrente' : 'Poupança',
                    'bank'               => $bank_name['name'],
                    'automatic_transfer' => false,
                    'name'               => $bank['name']
                ]
            ];

            if ($doc['type'] == 'Pessoa Física') {
                $fields['data']['cpf'] = $doc['data'];
            } else {
                $fields['data']['cnpj'] = $doc['data'];
            }

            $iugu = $this->Iugu->subaccount_verify($user['iugu_udid'], $user['iugu_user_token'], $fields);
            if ($iugu['status'] === 200) {
                return true;
            } else {
                $bank_fields = [
                    'agency'       => $fields['data']['bank_ag'],
                    'account'      => $fields['data']['bank_cc'],
                    'account_type' => $fields['data']['account_type'] == 'Corrente' ? 'cc' : 'cp',
                    'bank'         => "{$bank['financial_institution_id']}"
                ];
                $iugu        = $this->Iugu->subaccount_bank_verify($user['iugu_user_token'], $bank_fields);
                if ($iugu['status'] === 200) {
                    return true;
                } else {
                    return false;
                }
            }
        }

        return true;
    }

    public function _getCpfCnpj($doc)
    {
        $doc = str_replace(".", "", $doc);
        $doc = str_replace("-", "", $doc);
        $doc = str_replace("/", "", $doc);

        if (strlen($doc) <= 12) {
            return [
                'type' => 'Pessoa Física',
                'data' => $doc
            ];
        } else {
            return [
                'type' => 'Pessoa Jurídica',
                'data' => $doc
            ];
        }
    }

    public function _getTelephone($tel)
    {
        $tel = str_replace("(", "", $tel);
        $tel = str_replace(")", "", $tel);
        $tel = str_replace(" ", "", $tel);
        $tel = str_replace("-", "", $tel);

        return $tel;
    }
}
