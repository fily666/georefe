<?php

namespace App\Controller;

use Cake\Event\Event;

class SiTemasController extends AppController {

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow(['']);
    }

    public function index() {
        $this->loadModel('MaPropiedades');
        $temas = $this->MaPropiedades->find('all')
                ->where(['MaPropiedades.padre_id' => 1162, 'MaPropiedades.status_id' => 1])
                ->contain(['MaStatus'])
                ->order(['MaPropiedades.id' => 'DESC']);
        $this->set(compact('temas'));
    }

    public function index2($idTipo) {
        $this->loadModel('MaPropiedades');
        $tipoTema = $this->MaPropiedades->find('all')->select(['id', 'valor'])->where(['id' => $idTipo])->first();

        $temas = $this->SiTemas->find('all')
                ->where(['SiTemas.tipo_id' => $idTipo, 'SiTemas.status_id IN' => [1, 2], 'SiTemas.tema_estandar' => 1])
                ->contain(['MaStatus'])
                ->order(['SiTemas.id' => 'DESC']);

        $this->set(compact('temas', 'tipoTema'));
    }

    public function add($idTipo) {
        $this->loadModel('MaPropiedades');
        $tipoTema = $this->MaPropiedades->find('all')->select(['id', 'valor'])->where(['id' => $idTipo])->first();
        $siTema = $this->SiTemas->newEntity();
        if ($this->request->is('post')) {
            $siTema = $this->SiTemas->patchEntity($siTema, $this->request->data);
            $siTema->status_id = 1;
            $siTema->tema_estandar = 1;
            $siTema->tipo_id = $idTipo;
            $siTema->creator_id = $this->Auth->user()['id'];
            if ($this->SiTemas->save($siTema)) {
                $this->Flash->success(__('El Tema ha sido agregada.'), 'success');
                return $this->redirect(['action' => 'index2', $idTipo]);
            }
            $this->Flash->error(__('No se pudo agregar el Tema.'));
        }

        $this->set(compact('siTema', 'tipoTema'));
    }

    public function edit($id = null, $idTipo = null) {
        $this->loadModel('MaPropiedades');
        $tipoTema = $this->MaPropiedades->find('all')->select(['id', 'valor'])->where(['id' => $idTipo])->first();
        $siTema = $this->SiTemas->find('all')->where(['id' => $id])->first();
        if ($this->request->is(['post', 'put'])) {
            $siTema = $this->SiTemas->patchEntity($siTema, $this->request->data);
            $siTema->modifier_id = $this->Auth->user()['id'];
            if ($this->SiTemas->save($siTema)) {
                $this->Flash->success(__('El Tema ha sido Editado.'), 'success');
                return $this->redirect(['action' => 'index2', $idTipo]);
            }
            $this->Flash->error(__('No se pudo editar el Tema.'));
        }

        $this->set(compact('siTema', 'tipoTema'));
    }

    public function delete($id, $idTipo = null) {
        $this->request->allowMethod(['post', 'delete']);
        $siTema = $this->SiTemas->get($id);
        $siTema->status_id = 3;
        if ($this->SiTemas->save($siTema)) {
            $this->Flash->success(__('El Tema con el id: {0} ha sido eliminado.', h($id)), 'success');
            return $this->redirect(['action' => 'index2', $idTipo]);
        }
    }

}
