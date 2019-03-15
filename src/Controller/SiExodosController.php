<?php

namespace App\Controller;

use Cake\Event\Event;

class SiExodosController extends AppController {

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow(['datosbasicos', 'addasistencia']);
    }

    public function index() {
        $siExodos = $this->SiExodos->find('all')
                ->where(['SiExodos.status_id <>' => 3])
                //->limit(300)
                //->page(1)                
                ->contain(['Coordinador.Persons', 'MaPropiedades', 'MaStatus'])
                ->order(['SiExodos.id' => 'DESC']);

        //$this->pr($siExodos); die;

        $this->set(compact('siExodos'));
    }

    public function add() {
        $this->loadModel('SiLideres');
        $siExodo = $this->SiExodos->newEntity();
        if ($this->request->is('post')) {
            $siExodo = $this->SiExodos->patchEntity($siExodo, $this->request->data);

            $siExodo->creator_id = $this->Auth->user()['id'];
            if ($this->SiExodos->save($siExodo)) {

                //SE AGREGAN LOS TEMAS POR DEFECTO
                $this->loadModel('SiTemas');
                $this->loadModel('SiExodoTemas');
                $temas = $this->SiTemas->find('all')->where(['tipo_id' => 1164, 'status_id' => 1]);

                if ($temas != '') {
                    foreach ($temas as $tema) {
                        $siExodoTemas = $this->SiExodoTemas->newEntity();
                        $siExodoTemas->id_exodo = $siExodo->id;
                        $siExodoTemas->id_tema = $tema->id;
                        $siExodoTemas->status_id = 1;
                        $siExodoTemas->creator_id = $this->Auth->user()['id'];
                        $this->SiExodoTemas->save($siExodoTemas);
                    }
                }

                $this->Flash->success(__('El exodo ha sido agregada.'), 'success');
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo agregar el exodo.'));
        }
        
        $lista1[] = array();
        unset($lista1[0]);

        $coordinadores = $this->SiLideres->find()->select(['SiLideres.id', 'Persons.documento', 'Persons.nombres', 'Persons.apellidos'])
                ->where(['SiLideres.id_nivel' => 210, 'SiLideres.status_id' => 1])
                ->contain(['Persons'])
                ->order(['Persons.nombres' => 'ASC']);

        foreach ($coordinadores as $coordinador) {
            $lista1[$coordinador['id']] = $coordinador['person']['documento'] . ' | ' . $coordinador['person']['nombres'] . ' ' . $coordinador['person']['apellidos'];
        } //Lista para Coordinadores de exodo 

        $lista2 = $this->properties(238); //Lista para tipos de exodo
        $lista3 = $this->estadosCategoria('AMBIENTES'); //Lista para estados de exodo

        $this->set(compact('siExodo', 'lista1', 'lista2', 'lista3'));
    }

    public function edit($id = null) {
        $this->loadModel('SiLideres');
        $siExodo = $this->SiExodos->find('all')->where(['id' => $id])->first();
        if ($this->request->is(['post', 'put'])) {
            $siExodo = $this->SiExodos->patchEntity($siExodo, $this->request->data);

            $siExodo->modifier_id = $this->Auth->user()['id'];
            if ($this->SiExodos->save($siExodo)) {
                $this->Flash->success(__('El exodo ha sido Editado.'), 'success');
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo editar el exodo.'));
        }

        $coordinadores = $this->SiLideres->find()->select(['SiLideres.id', 'Persons.documento', 'Persons.nombres', 'Persons.apellidos'])
                ->where(['SiLideres.id_nivel' => 210, 'SiLideres.status_id' => 1])
                ->contain(['Persons'])
                ->order(['Persons.nombres' => 'ASC']);

        foreach ($coordinadores as $coordinador) {
            $lista1[$coordinador['id']] = $coordinador['person']['documento'] . ' | ' . $coordinador['person']['nombres'] . ' ' . $coordinador['person']['apellidos'];
        } //Lista para Coordinadores de exodo 

        $lista2 = $this->properties(238); //Lista para tipos de exodo
        $lista3 = $this->estadosCategoria('AMBIENTES'); //Lista para estados de exodo

        $this->set(compact('siExodo', 'lista1', 'lista2', 'lista3'));
    }

    public function delete($id) {
        $this->request->allowMethod(['post', 'delete']);
        $siExodo = $this->SiExodos->get($id);
        $siExodo->status_id = 3;
        if ($this->SiExodos->save($siExodo)) {
            $this->Flash->success(__('El exodo con el id: {0} ha sido eliminado.', h($id)), 'success');
            return $this->redirect(['action' => 'index']);
        }
    }

    public function inactivity($id) {
        $this->request->allowMethod(['post', 'inactivity']);
        $siExodo = $this->SiExodos->get($id);
        $siExodo->status_id = 0;
        if ($this->SiExodos->save($siExodo)) {
            $this->Flash->success(__('El Exodo con el id: {0} ha sido inactivado.', h($id)), 'success');
            return $this->redirect(['action' => 'index']);
        }
    }

    public function activity($id) {
        $this->request->allowMethod(['post', 'activity']);
        $siExodo = $this->SiExodos->get($id);
        $siExodo->status_id = 1;
        if ($this->SiExodos->save($siExodo)) {
            $this->Flash->success(__('El Exodo con el id: {0} ha sido activado.', h($id)), 'success');
            return $this->redirect(['action' => 'index']);
        }
    }

    /////////////////// METODOS PARA ASOCIAR LOS TEMAS A LOS PUNTOS DE ENCUENTRO ////////////////

    public function index2($id = null) {
        $this->loadModel('SiExodoTemas');
        $this->loadModel('SiExodos');
        $siExodoTemas = $this->SiExodoTemas->find('all')
                ->where(['SiExodoTemas.id_exodo' => $id, 'SiExodoTemas.status_id IN' => [1, 2]])
                ->contain(['SiExodos', 'SiTemas', 'SiLideres.Persons', 'MaStatus'])
                ->order(['SiExodoTemas.id' => 'ASC']);

        if ($this->request->is('post')) {
            $request = $this->request->data;

            $siExodoTemaExist = $this->SiExodoTemas->find('all')->where(['id_exodo' => $id, 'id_tema' => $request['id_tema'], 'status_id IN' => [1, 2]])->first();

            if ($siExodoTemaExist == '') {
                $siExodoTema = $this->SiExodoTemas->newEntity();
                $siExodoTema->id_exodo = $id;
                $siExodoTema->id_tema = $request['id_tema'];
                $siExodoTema->id_lider = $request['id_lider'];
                $siExodoTema->fecha = $request['fecha'];
                $siExodoTema->status_id = 1;
                $siExodoTema->creator_id = $this->Auth->user()['id'];

                if ($this->SiExodoTemas->save($siExodoTema)) {
                    $this->Flash->success(__('El tema ha sido Agregado.'), 'success');
                    return $this->redirect(['action' => 'index2', $id]);
                }
            } else {
                $this->Flash->error(__('El Tema ya se encuentra asociado al exodo.'), 'success');
                return $this->redirect(['action' => 'index2', $id]);
            }
        }

        $exodo = $this->SiExodos->find('all')->where(['id' => $id])->first();

        $this->loadModel('SiTemas');
        $this->loadModel('SiLideres');

        $lista1 = $this->SiTemas->find('list', ['id' => 'id', 'valueField' => 'tema'])
                ->where(['tipo_id' => 1164, 'status_id' => 1])
                ->order(['id' => 'ASC']);

        $lideresdb = $this->SiLideres->find()->select(['SiLideres.id', 'Persons.documento', 'Persons.nombres', 'Persons.apellidos'])
                ->where(['SiLideres.id_nivel' => 209, 'SiLideres.status_id' => 1])
                ->contain(['Persons']);

        foreach ($lideresdb as $lider) {
            $lista2[$lider['id']] = $lider['person']['documento'] . ' | ' . $lider['person']['nombres'] . ' ' . $lider['person']['apellidos'];
        } //Lista para Lideres de acompañamiento 

        $this->set(compact('siExodoTemas', 'exodo', 'id', 'lista1', 'lista2'));
    }

    public function delete2($id, $idExodo) {
        $this->request->allowMethod(['post', 'delete']);
        $this->loadModel('SiExodoTemas');
        $siExodoTema = $this->SiExodoTemas->get($id);
        if ($this->SiExodoTemas->delete($siExodoTema)) {
            $this->Flash->success(__('El tema con el id: {0} ha sido eliminado.', h($id)), 'success');
            return $this->redirect(['action' => 'index2', $idExodo]);
        }
    }

    public function edit2($id = null, $idExodo = null) {
        $this->loadModel('SiExodoTemas');
        $siExodoTema = $this->SiExodoTemas->find('all')->where(['id' => $id])->first();
        if ($this->request->is(['post', 'put'])) {
            $siExodoTema = $this->SiExodoTemas->patchEntity($siExodoTema, $this->request->data);

            $siExodoTema->modifier_id = $this->Auth->user()['id'];
            if ($this->SiExodoTemas->save($siExodoTema)) {
                $this->Flash->success(__('El exodo ha sido Editado.'), 'success');
                return $this->redirect(['action' => 'index2', $idExodo]);
            }
            $this->Flash->error(__('No se pudo editar el exodo.'));
        }

        $exodo = $this->SiExodos->find('all')->where(['id' => $idExodo])->first();

        $this->loadModel('SiTemas');
        $this->loadModel('SiLideres');

        $lista1 = $this->SiTemas->find('list', ['id' => 'id', 'valueField' => 'tema'])
                ->where(['tipo_id' => 1164, 'status_id' => 1])
                ->order(['id' => 'ASC']);

        $lideresdb = $this->SiLideres->find()->select(['SiLideres.id', 'Persons.documento', 'Persons.nombres', 'Persons.apellidos'])
                ->where(['SiLideres.id_nivel' => 209, 'SiLideres.status_id' => 1])
                ->contain(['Persons']);

        foreach ($lideresdb as $lider) {
            $lista2[$lider['id']] = $lider['person']['documento'] . ' | ' . $lider['person']['nombres'] . ' ' . $lider['person']['apellidos'];
        } //Lista para Lideres de acompañamiento 

        $this->set(compact('siExodoTema', 'exodo', 'id', 'lista1', 'lista2'));
    }

    /////////////////////////////////////////METODOS PARA SEGUIMIENTOS////////////////////////////////////////////////

    public function asistentes($idExodo = null) {
        $this->loadModel('SiExodoAsistentes');
        $this->loadModel('SiExodos');
        $this->loadModel('SiPastores');
        $this->loadModel('Persons');
        $this->loadModel('SiExodoTemas');

        $siExodoTemasExist = $this->SiExodoTemas->find('all')->where(['id_exodo' => $idExodo, 'status_id' => 1]);

        if (count($siExodoTemasExist->toArray()) > 0) {
            $siExodoAsistentes = $this->SiExodoAsistentes->find('all')
                    ->where(['SiExodoAsistentes.id_exodo' => $idExodo, 'SiExodoAsistentes.status_id' => 1])
                    //->limit(300)
                    //->page(1)                
                    ->contain(['Persona', 'Guia', 'SiPastores.Persons', 'SiExodos', 'MaPropiedades', 'MaStatus'])
                    ->order(['Persona.nombres' => 'ASC']);

            if ($this->request->is('post')) {
                $request = $this->request->data;

                $siExodoAsistenteExist = $this->SiExodoAsistentes->find('all')->where(['id_exodo' => $idExodo, 'id_datos_basicos' => $request['id_datos_basicos'], 'status_id' => 1])->first();

                if ($siExodoAsistenteExist == '') {
                    $siExodoAsistente = $this->SiExodoAsistentes->newEntity();
                    $siExodoAsistente->id_datos_basicos = $request['id_datos_basicos'];
                    $siExodoAsistente->id_exodo = $idExodo;
                    $siExodoAsistente->id_tipo_asistente = $request['id_tipo_asistente'];
                    $siExodoAsistente->id_guia = $request['id_guia'];
                    $siExodoAsistente->id_pastor = $request['id_pastor'];
                    $siExodoAsistente->status_id = 1;
                    $siExodoAsistente->creator_id = $this->Auth->user()['id'];

                    if ($this->SiExodoAsistentes->save($siExodoAsistente)) {
                        //SE CREA LA ASISTENCIA CON LOS TEMAS ASOCIADOS AL PUNTO DE ENCUENTRO A EL ASISTENTE CREADO
                        $this->loadModel('SiExodoTemas');
                        $this->loadModel('SiExodoAsistencias');
                        $siExodoTemas = $this->SiExodoTemas->find('all')
                                ->where(['SiExodoTemas.id_exodo' => $idExodo, 'SiExodoTemas.status_id' => 1]);

                        foreach ($siExodoTemas as $siExodoTema) {
                            $siExodoAsistencia = $this->SiExodoAsistencias->newEntity();
                            $siExodoAsistencia->id_exodo_asistente = $siExodoAsistente->id;
                            $siExodoAsistencia->id_exodo_tema = $siExodoTema->id;
                            $siExodoAsistencia->asistio = false;
                            $siExodoAsistencia->creator_id = $this->Auth->user()['id'];

                            $this->SiExodoAsistencias->save($siExodoAsistencia);
                        }

                        //////////////////////                    

                        $this->Flash->success(__('El asistente ha sido Agregado.'), 'success');
                        return $this->redirect(['action' => 'asistentes', $idExodo]);
                    }
                } else {
                    $this->Flash->error(__('El asistente ya se esta agregado al exodo.'), 'success');
                    return $this->redirect(['action' => 'asistentes', $idExodo]);
                }
            }

            $exodo = $this->SiExodos->find('all')->where(['id' => $idExodo])->first();

            $personsdb = $this->Persons->find()->select(['id', 'documento', 'nombres', 'apellidos'])
                    ->where(['status_id' => 1])
                    ->order(['nombres' => 'ASC']);
            foreach ($personsdb as $person) {
                $lista1[$person['id']] = $person['documento'] . ' | ' . $person['nombres'] . ' ' . $person['apellidos'];
            } //Lista de personas

            $lista2 = $lista1; //Lista de Guías

            $pastoresdb = $this->SiPastores->find()->select(['SiPastores.id', 'Persons.documento', 'Persons.nombres', 'Persons.apellidos'])
                    ->where(['SiPastores.status_id' => 1])
                    ->contain(['Persons'])
                    ->order(['Persons.nombres' => 'ASC']);

            foreach ($pastoresdb as $pastor) {
                $lista3[$pastor['id']] = $pastor['person']['documento'] . ' | ' . $pastor['person']['nombres'] . ' ' . $pastor['person']['apellidos'];
            } //Lista para pastores 

            $lista4 = $this->properties(232); //Lista para tipo de asistente

            $this->set(compact('siExodoAsistentes', 'exodo', 'lista1', 'lista2', 'lista3', 'lista4'));
        } else {
            $this->Flash->error(__('Para agregar asistentes primero debe asociar temas al exodo.'), 'success');
            return $this->redirect(['action' => 'index']);
        }
    }

    public function delete3($id, $idExodo) {
        $this->request->allowMethod(['post', 'delete']);
        $this->loadModel('SiExodoAsistentes');
        $siExodoAsistente = $this->SiExodoAsistentes->get($id);
        if ($this->SiExodoAsistentes->delete($siExodoAsistente)) {
            $this->Flash->success(__('El asistente con el id: {0} ha sido eliminado.', h($id)), 'success');
            return $this->redirect(['action' => 'asistentes', $idExodo]);
        }
    }

    public function asistencia($idExodo = null) {

        $this->loadModel('SiExodoAsistencias');
        $this->loadModel('SiExodoAsistentes');
        $this->loadModel('SiExodoTemas');

        $siExodoAsistentes = $this->SiExodoAsistentes->find('all')
                ->select(['SiExodoAsistentes.id', 'Persona.id', 'Persona.nombres', 'Persona.apellidos', 'Persona.documento'])
                ->where(['SiExodoAsistentes.id_exodo' => $idExodo, 'SiExodoAsistentes.status_id' => 1])
                ->contain(['Persona']);

        if (count($siExodoAsistentes->toArray()) > 0) {
            $siExodoAsistencias = $this->SiExodoAsistencias->find('all')
                    ->where(['SiExodoAsistentes.id_exodo' => $idExodo])
                    //->limit(300)
                    //->page(1)                
                    ->contain(['SiExodoAsistentes', 'SiExodoTemas.SiTemas'])
                    ->order(['SiExodoAsistencias.id' => 'ASC']);

            //$this->pr($siExodoAsistentesExist); die;

            $exodo = $this->SiExodos->find('all')->where(['id' => $idExodo])->first();
            $temas = $this->SiExodoTemas->find('all')
                    ->select(['SiTemas.tema', 'SiExodoTemas.fecha'])
                    ->where(['id_exodo' => $idExodo, 'SiExodoTemas.status_id' => 1])
                    ->contain(['SiTemas']);

            $this->set(compact('siExodoAsistencias', 'siExodoAsistentes', 'exodo', 'temas'));
        } else {
            $this->Flash->error(__('Para gestionar la asistencia primero debe asociar asistentes al exodo.'), 'success');
            return $this->redirect(['action' => 'index']);
        }
    }

    public function datosbasicos() {
        $this->loadModel('Persons');
        $this->viewBuilder()->layout();
        $persona = $this->Persons->find('all')->select(['MaPropiedades.valor', 'Persons.documento', 'Persons.nombres', 'Persons.apellidos',
                            'Persons.direccion', 'Persons.email', 'Persons.telefono1', 'Persons.celular',
                            'Persons.fotografia', 'Persons.status_id'])
                        ->where(['Persons.id' => $this->request->data['id']])
                        ->contain(['MaPropiedades'])->first();

        $this->set(compact('persona'));
    }

    public function addasistencia() {
        $this->request->allowMethod(['post', 'addasistencia']);
        $this->loadModel('SiExodoAsistencias');
        $siExodoAsistencias = $this->SiExodoAsistencias->get($this->request->data['id']);
        $siExodoAsistencias->asistio = $this->request->data['asistio'];

        if ($this->SiExodoAsistencias->save($siExodoAsistencias)) {
            $this->Flash->success(__('La aistencia con el id: {0} ha sido guardada.', h($id)), 'success');
            return $this->redirect(['action' => 'asistencia', $this->request->data['id']]);
        }
    }

}
