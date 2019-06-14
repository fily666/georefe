<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Password Controller
 */
class PasswordController extends AppController {

    public function beforeFilter(Event $event) {
        $this->Auth->allow(['index', 'recoverPassword']);
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

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index($id = null) {

        $this->authorized();
        $this->viewBuilder()->layout('login');


        $this->loadModel('Users');
        $idUsr = base64_decode($id);
        $this->viewBuilder()->layout('formExternal');
        $user = $this->Users->get($idUsr);

        if ($this->request->is(['post'])) {

            if ($this->request->data['pass1'] != $this->request->data['pass2']) {
                $this->Flash->error(__('Las contraseñas no coinciden'));
                return;
            }

            $user->password = $this->request->data['pass1'];
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Contraseña editada correctamente.'), 'success');
                return $this->redirect(['controller' => 'Users', 'action' => 'login']);
            }
            $this->Flash->error(__('Error cambiando la contraseña.'));
        }
    }

    /**
     * recoverPassword method
     *
     * @return \Cake\Network\Response|null
     */
    public function recoverpassword() {
        $this->loadModel('Users');
        $this->viewBuilder()->layout('formExternal');
        if ($this->request->is(['post', 'put'])) {
            $users = $this->Users->find()->select(['Users.id', 'Persons.email'])->where(['Users.username' => $this->request->data['user']])->contain(['Persons'])->first();
            if ($users) {
                $this->sendMail($users['person']['email'], 'Solicitud de cambio de contraseña sistema Fénix', $users->id);
                $this->Flash->success(__('Se envío un email con el link para cambio de contraseña al correo asociado al usuario ingresado.'), 'success');
            } else {
                $this->Flash->error(__('El documento ingresado no existe en el sistema.'));
            }
        }
    }

}
