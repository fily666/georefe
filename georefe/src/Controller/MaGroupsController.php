<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * MaGroups Controller
 *
 * @property \App\Model\Table\MaGroupsTable $MaGroups
 */
class MaGroupsController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        $maGroups = $this->MaGroups->find('all')->where(['MaGroups.status_id <>' => 3])->contain(['MaStatus']);
        $this->set(compact('maGroups'));
        $this->set('_serialize', ['maGroups']);
    }

    /**
     * View method
     *
     * @param string|null $id Ma Group id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $maGroup = $this->MaGroups->get($id, [
            'contain' => ['Users', 'MaActions'],
        ]);

        $this->set('maGroup', $maGroup);
        $this->set('_serialize', ['maGroup']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $group = $this->MaGroups->newEntity();

        if ($this->request->is('post')) {
            $actions = $this->request->data['ma_actions'];
            $this->request->data['ma_actions'] = ['_ids' => $actions];
            $group = $this->MaGroups->patchEntity($group, $this->request->data, [
                'associated' => ['MaActions' => ['validate' => false]]
            ]);
            $this->request->data['ma_actions'] = $actions;
            $group->status_id = 1;
            $group->creator_id = $this->Auth->user()['id'];

            if (count($group->ma_actions) > 0) {
                if ($this->MaGroups->save($group)) {
                    $this->Flash->success(__('El Rol ha sido agregado.'), 'success');
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('No se pudo agregar el Rol.'));
                }
            } else {
                $this->Flash->error(__('Debe seleccionar como mínimo una acción.'));
            }
        }

        $this->loadModel('MaControllers');
        $options = $this->MaControllers->find('all')->where(['MaControllers.status_id' => 1])->contain(['MaActions' => ['conditions' => ['MaActions.status_id' => 1]]]);

        $this->set(compact('options', 'group'));
        $this->set('_serialize', ['options']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Ma Group id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $group = $this->MaGroups->find('all')->where(['id' => $id])->contain(['MaActions' => ['fields' => ['id', 'MaActionsGroups.group_id']]])->first();
        $selected = [];

        foreach ($group['ma_actions'] as $action) {
            $selected[] = $action['id'];
        }

        if (!isset($this->request->data['ma_actions'])) {
            $this->request->data['ma_actions'] = "";
        }

        if ($this->request->is(['post', 'put'])) {
            $actions = $this->request->data['ma_actions'];

            if ($this->request->data['ma_actions'] && count($this->request->data['ma_actions']) > 0) {
                $this->request->data['ma_actions'] = ['_ids' => $actions];
                $group = $this->MaGroups->patchEntity($group, $this->request->data, [
                    'associated' => ['MaActions' => ['validate' => false]]
                ]);
            } else {
                unset($this->request->data['ma_actions']);
                $group = $this->MaGroups->patchEntity($group, $this->request->data);
            }

            if (count($actions) > 0 && $actions !== "") {

                /* if ($this->request->data['status_id'] == 'on') {
                  $group->status_id = 1;
                  } elseif ($this->request->data['status_id'] == 1) {
                  $group->status_id = 2;
                  } else {
                  $group->status_id = 3;
                  } */

                $group->modifier_id = $this->Auth->user()['id'];

                if ($this->MaGroups->save($group)) {
                    $this->Flash->success(__('El grupo ha sido editado.'), 'success');
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('No se pudo editar el grupo.'));
                }
            } else {
                $this->Flash->error(__('Debe seleccionar como mínimo una acción.'));
            }

            $this->request->data['ma_actions'] = $actions;
        }
        $this->loadModel('MaControllers');
        $options = $this->MaControllers->find('all')->contain('MaActions');
        $this->set(compact('options', 'group', 'selected'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Ma Group id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $maGroup = $this->MaGroups->get($id);
        $maGroup->status_id = 3;

        if ($this->canDelete($maGroup)) {
            if ($this->MaGroups->save($maGroup)) {
                $this->Flash->success(__('El Rol ha sido eliminado con éxito.'));
            } else {
                $this->Flash->error(__('El Rol no pudo ser eliminado. Por favor, intente nuevamente.'));
            }
        } else {
            $this->Flash->error(__('El Rol no pudo ser eliminado porque tiene asociado uno o varios usuarios.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Verifica si el grupo tiene asociado uno o mas usuarios
     */
    private function canDelete($maGroup = null) {
        if ($maGroup) {

            $count = TableRegistry::get('Users')
                    ->find()
                    ->where(['Users.group_id' => $maGroup->id])
                    ->count();

            if ($count == 0) {
                return true;
            }
        }

        return false;
    }

}
