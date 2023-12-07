<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\EventInterface;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public function initialize(): void
    {
        $this->viewBuilder()->setLayout('Admin/admin');
        parent::initialize();
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
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Ages', 'Characteristics', 'Langs', 'Problems', 'Specialties', 'Therapies', 'Banks', 'EmergencyContacts', 'Notifications', 'Profiles', 'ReasonsUsers', 'AcademicBackgrounds', 'Cards', 'Costs', 'Products', 'Reviews', 'ScheduleSettings', 'ReviewsMade', 'ReviewsReceived', 'AppointmentsMade', 'AppointmentsReceived', 'RecordsOwner', 'RecordsPatient', 'NotesOwner', 'NotesPatient', 'Clients', 'Therapists'],
        ]);

        $this->set(compact('user'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $ages = $this->Users->Ages->find('list', ['limit' => 200]);
        $characteristics = $this->Users->Characteristics->find('list', ['limit' => 200]);
        $langs = $this->Users->Langs->find('list', ['limit' => 200]);
        $problems = $this->Users->Problems->find('list', ['limit' => 200]);
        $specialties = $this->Users->Specialties->find('list', ['limit' => 200]);
        $therapies = $this->Users->Therapies->find('list', ['limit' => 200]);
        $this->set(compact('user', 'ages', 'characteristics', 'langs', 'problems', 'specialties', 'therapies'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Ages', 'Characteristics', 'Langs', 'Problems', 'Specialties', 'Therapies'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $ages = $this->Users->Ages->find('list', ['limit' => 200]);
        $characteristics = $this->Users->Characteristics->find('list', ['limit' => 200]);
        $langs = $this->Users->Langs->find('list', ['limit' => 200]);
        $problems = $this->Users->Problems->find('list', ['limit' => 200]);
        $specialties = $this->Users->Specialties->find('list', ['limit' => 200]);
        $therapies = $this->Users->Therapies->find('list', ['limit' => 200]);
        $this->set(compact('user', 'ages', 'characteristics', 'langs', 'problems', 'specialties', 'therapies'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function login()
    {
        $this->viewBuilder()->setLayout('Admin/login');

        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());

            }
            $this->Flash->error('Credenciais incorretas.');
        }
    }

    public function logout()
    {
        $this->Auth->logout();
        return $this->redirect('/');
    }
}
