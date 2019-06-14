<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController {

    public function beforeFilter(Event $event) {
        $this->Auth->allow(['login', 'logout', 'cambiocontrasena']);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        $users = $this->Users->find('all')->where(['Users.status_id IN ' => [1, 2]])
                ->order(['Users.id' => 'DESC'])
                ->contain(['Persons', 'MaStatus', 'MaGroups']);
        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $user = $this->Users->get($id, [
            'contain' => ['Persons', 'MaGroups', 'Users']
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $this->loadModel('Users');
        $this->loadModel('Persons');
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $unaPerson = $this->Persons->find('all')->where(['id' => $this->request->data['person_id']])->first();
            $exists = $this->Users->find('all', ['fields' => ['id']])->where(['person_id' => $this->request->data['person_id'], 'status_id <>' => 3])->first();

            if (!$exists) {
                $user = $this->Users->patchEntity($user, $this->request->data);
                $user->username = $unaPerson->documento;
                $user->password = $unaPerson->documento;
                $user->status_id = 1;
                $user->creator_id = $this->Auth->user()['id'];
                if ($this->Users->save($user)) {
                    //CORREO PARA ASIGNACIÓN DE CONTRASEÑA
                    $this->sendMail($unaPerson->email, 'Asignación de contraseña a usuario SISM', $user->id);
                    $this->Flash->success(__('El usuario ha sido agregado.'), 'success');
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('Error agregar el usuario.'));
                }
            } else {
                $this->Flash->error(__('El usuario ya existe.'));
            }
        }
        $maGroups = $this->Users->MaGroups->find('list', ['limit' => 200])->where(['MaGroups.status_id' => 1]);

        $personsdb = $this->Persons->find()->select(['id', 'documento', 'nombres', 'apellidos'])
                ->where(['status_id' => 1])
                ->order(['nombres' => 'ASC']);
        foreach ($personsdb as $person) {
            $persons[$person['id']] = $person['documento'] . ' | ' . $person['nombres'] . ' ' . $person['apellidos'];
        }

        $this->set(compact('user', 'maGroups', 'persons'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $user = $this->Users->find('all')->contain('Persons')->where(['Users.id' => $id])->first();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);

            $user->status_id = 1;

            $user->modifier_id = $this->Auth->user()['id'];
            if ($this->Users->save($user)) {
                $this->Flash->success(__('El Usuario ha sido editado.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Error editando el usuario.'));
            }
        }

        $this->loadModel('Persons');

        $personsdb = $this->Persons->find()->select(['id', 'documento', 'nombres', 'apellidos'])->where(['status_id' => 1]);
        foreach ($personsdb as $person) {
            $persons[$person['id']] = $person['documento'] . ' | ' . $person['nombres'] . ' ' . $person['apellidos'];
        }

        $maGroups = $this->Users->MaGroups->find('list', ['limit' => 200])->where(['MaGroups.status_id' => 1]);
        $this->set(compact('user', 'maGroups', 'persons'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        $user->status_id = 3;

        if ($this->Users->save($user)) {
            $this->Flash->success(__('Usuario Borrado'));
        } else {
            $this->Flash->error(__('Usuario no pudo ser borrado intente de nuevo'));
        }
        return $this->redirect(['action' => 'index']);
    }

    /**
     * Muestra un mensaje si el usuario no esta autorizado para realizar una
     * accion.
     */
    private function authorized() {
        if ($this->Auth->user()) {
            if (!$this->isAuthorized($this->Auth->user())) {
                //$this->Flash->error("No esta autorizado para realizar esta acción.");
                $this->redirect($this->referer());
            }
        }
    }

    public function login() {
        $this->authorized();
        $this->set('module', ['name' => 'Login']);
        $this->viewBuilder()->layout('login');

        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                if ($user['status_id'] == 1) {
                    $user = $this->Users
                                    ->find('all', ['fields' => [
                                            'id',
                                            'person_id',
                                            'username',
                                            'group_id',
                                            'Users.status_id']
                                    ])->where(['Users.id' => $user['id'], 'Users.status_id' => 1])
                                    ->contain([
                                        'Persons' => [
                                            'fields' => ['Persons.id', 'Persons.nombres', 'Persons.apellidos', 'Persons.fotografia']
                                        ],
                                        'MaGroups' => [
                                            'fields' => ['MaGroups.id', 'MaGroups.name'],
                                            'MaActions' => [
                                                'fields' => ['MaActions.id', 'MaActions.url', 'MaActionsGroups.group_id'],
                                                'MaControllers' => ['fields' => ['MaControllers.url']]
                                            ]
                                        ]
                                    ])->first();
                    $user['permissions'] = [];

                    foreach ($user['ma_group']['ma_actions'] as $actions) {
                        $user['permissions'][$actions['ma_controller']['url']][] = $actions['url'];
                    }

                    $user['permissions']['Home'] = ['index'];
                    $usuario = $user->toArray();
                    $this->Auth->setUser($usuario);

                    return $this->redirect($this->Auth->redirectUrl());
                }
            }
            $this->Flash->error(__('Usuario o contraseña inválida.'));
        }
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

    /**
     * Función para enviar la acción de cambio de contraeña
     */
    public function sendmailpassword($id = null) {
        $this->autoRender = false;
        $user = $this->Users->find('all')->contain('Persons')->where(['Users.id' => $id])->first();
        //CORREO PARA CAMBIO DE CONTRASEÑA
        $this->sendMail($user->person->email, 'Cambio de contraseña a usuario SISM', $user->id);
    }

    public function cambiocontrasena($id = null) {

        $idUsr = base64_decode($id);

        $user = $this->Users->get($idUsr);
        if ($this->request->is(['post'])) {
            if ($this->request->data['pass1'] != $this->request->data['pass2']) {
                $this->Flash->error(__('Las contraseñas no coinciden'));
                return;
            }

            $user->password = $this->request->data['pass1'];
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Contraseña editada correctamente.'), 'success');
                return $this->redirect(['controller' => 'Users', 'action' => 'cambiocontrasena', $id]);
            }
            $this->Flash->error(__('Error cambiando la contraseña.'));
        }
    }

}
