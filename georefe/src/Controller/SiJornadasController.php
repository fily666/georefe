<?php

namespace App\Controller;

use Cake\Event\Event;

class SiJornadasController extends AppController {

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow(['datosbasicos', 'addasistencia']);
    }

    public function index() {
        $siJornadas = $this->SiJornadas->find('all')
                ->where(['SiJornadas.status_id <>' => 3])
                //->limit(300)
                //->page(1)                
                ->contain(['Coordinador.Persons', 'MaPropiedades', 'MaStatus'])
                ->order(['SiJornadas.id' => 'DESC']);

        //$this->pr($siJornadas); die;

        $this->set(compact('siJornadas'));
    }

    public function add() {
        $this->loadModel('SiLideres');
        $siJornada = $this->SiJornadas->newEntity();
        if ($this->request->is('post')) {
            $siJornada = $this->SiJornadas->patchEntity($siJornada, $this->request->data);

            $siJornada->creator_id = $this->Auth->user()['id'];
            if ($this->SiJornadas->save($siJornada)) {

                //SE AGREGAN LOS TEMAS POR DEFECTO
                $this->loadModel('SiTemas');
                $this->loadModel('SiJornadaTemas');
                $temas = $this->SiTemas->find('all')->where(['tipo_id' => 1165, 'status_id' => 1]);

                if ($temas != '') {
                    foreach ($temas as $tema) {
                        $siJornadaTemas = $this->SiJornadaTemas->newEntity();
                        $siJornadaTemas->id_jornada = $siJornada->id;
                        $siJornadaTemas->id_tema = $tema->id;
                        $siJornadaTemas->status_id = 1;
                        $siJornadaTemas->creator_id = $this->Auth->user()['id'];
                        $this->SiJornadaTemas->save($siJornadaTemas);
                    }
                }

                $this->Flash->success(__('La jornada ha sido agregada.'), 'success');
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo agregar la jornada.'));
        }
        
        $lista1[] = array();
        unset($lista1[0]);

        $coordinadores = $this->SiLideres->find()->select(['SiLideres.id', 'Persons.documento', 'Persons.nombres', 'Persons.apellidos'])
                ->where(['SiLideres.id_nivel' => 210, 'SiLideres.status_id' => 1])
                ->contain(['Persons'])
                ->order(['Persons.nombres' => 'ASC']);

        foreach ($coordinadores as $coordinador) {
            $lista1[$coordinador['id']] = $coordinador['person']['documento'] . ' | ' . $coordinador['person']['nombres'] . ' ' . $coordinador['person']['apellidos'];
        } //Lista para Coordinadores de jornada 

        $lista2 = $this->properties(238); //Lista para tipos de jornada
        $lista3 = $this->estadosCategoria('AMBIENTES'); //Lista para estados de jornada

        $this->set(compact('siJornada', 'lista1', 'lista2', 'lista3'));
    }

    public function edit($id = null) {
        $this->loadModel('SiLideres');
        $siJornada = $this->SiJornadas->find('all')->where(['id' => $id])->first();
        if ($this->request->is(['post', 'put'])) {
            $siJornada = $this->SiJornadas->patchEntity($siJornada, $this->request->data);

            $siJornada->modifier_id = $this->Auth->user()['id'];
            if ($this->SiJornadas->save($siJornada)) {
                $this->Flash->success(__('El jornada ha sido Editado.'), 'success');
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo editar el jornada.'));
        }

        $coordinadores = $this->SiLideres->find()->select(['SiLideres.id', 'Persons.documento', 'Persons.nombres', 'Persons.apellidos'])
                ->where(['SiLideres.id_nivel' => 210, 'SiLideres.status_id' => 1])
                ->contain(['Persons'])
                ->order(['Persons.nombres' => 'ASC']);

        foreach ($coordinadores as $coordinador) {
            $lista1[$coordinador['id']] = $coordinador['person']['documento'] . ' | ' . $coordinador['person']['nombres'] . ' ' . $coordinador['person']['apellidos'];
        } //Lista para Coordinadores de jornada 

        $lista2 = $this->properties(238); //Lista para tipos de jornada
        $lista3 = $this->estadosCategoria('AMBIENTES'); //Lista para estados de jornada

        $this->set(compact('siJornada', 'lista1', 'lista2', 'lista3'));
    }

    public function delete($id) {
        $this->request->allowMethod(['post', 'delete']);
        $siJornada = $this->SiJornadas->get($id);
        $siJornada->status_id = 3;
        if ($this->SiJornadas->save($siJornada)) {
            $this->Flash->success(__('El jornada con el id: {0} ha sido eliminado.', h($id)), 'success');
            return $this->redirect(['action' => 'index']);
        }
    }

    public function inactivity($id) {
        $this->request->allowMethod(['post', 'inactivity']);
        $siJornada = $this->SiJornadas->get($id);
        $siJornada->status_id = 0;
        if ($this->SiJornadas->save($siJornada)) {
            $this->Flash->success(__('La Jornada con el id: {0} ha sido inactivado.', h($id)), 'success');
            return $this->redirect(['action' => 'index']);
        }
    }

    public function activity($id) {
        $this->request->allowMethod(['post', 'activity']);
        $siJornada = $this->SiJornadas->get($id);
        $siJornada->status_id = 1;
        if ($this->SiJornadas->save($siJornada)) {
            $this->Flash->success(__('La Jornada con el id: {0} ha sido activado.', h($id)), 'success');
            return $this->redirect(['action' => 'index']);
        }
    }

    /////////////////// METODOS PARA ASOCIAR LOS TEMAS A LOS PUNTOS DE ENCUENTRO ////////////////

    public function index2($id = null) {
        $this->loadModel('SiJornadaTemas');
        $this->loadModel('SiJornadas');
        $siJornadaTemas = $this->SiJornadaTemas->find('all')
                ->where(['SiJornadaTemas.id_jornada' => $id, 'SiJornadaTemas.status_id IN' => [1, 2]])
                ->contain(['SiJornadas', 'SiTemas', 'SiLideres.Persons', 'MaStatus'])
                ->order(['SiJornadaTemas.id' => 'ASC']);

        if ($this->request->is('post')) {
            $request = $this->request->data;

            $siJornadaTemaExist = $this->SiJornadaTemas->find('all')->where(['id_jornada' => $id, 'id_tema' => $request['id_tema'], 'status_id IN' => [1, 2]])->first();

            if ($siJornadaTemaExist == '') {
                $siJornadaTema = $this->SiJornadaTemas->newEntity();
                $siJornadaTema->id_jornada = $id;
                $siJornadaTema->id_tema = $request['id_tema'];
                $siJornadaTema->id_lider = $request['id_lider'];
                $siJornadaTema->fecha = $request['fecha'];
                $siJornadaTema->status_id = 1;
                $siJornadaTema->creator_id = $this->Auth->user()['id'];

                if ($this->SiJornadaTemas->save($siJornadaTema)) {
                    $this->Flash->success(__('El tema ha sido Agregado.'), 'success');
                    return $this->redirect(['action' => 'index2', $id]);
                }
            } else {
                $this->Flash->error(__('El Tema ya se encuentra asociado al jornada.'), 'success');
                return $this->redirect(['action' => 'index2', $id]);
            }
        }

        $jornada = $this->SiJornadas->find('all')->where(['id' => $id])->first();

        $this->loadModel('SiTemas');
        $this->loadModel('SiLideres');

        $lista1 = $this->SiTemas->find('list', ['id' => 'id', 'valueField' => 'tema'])
                ->where(['tipo_id' => 1165, 'status_id' => 1])
                ->order(['id' => 'ASC']);

        $lideresdb = $this->SiLideres->find()->select(['SiLideres.id', 'Persons.documento', 'Persons.nombres', 'Persons.apellidos'])
                ->where(['SiLideres.id_nivel' => 209, 'SiLideres.status_id' => 1])
                ->contain(['Persons']);

        foreach ($lideresdb as $lider) {
            $lista2[$lider['id']] = $lider['person']['documento'] . ' | ' . $lider['person']['nombres'] . ' ' . $lider['person']['apellidos'];
        } //Lista para Lideres de acompañamiento 

        $this->set(compact('siJornadaTemas', 'jornada', 'id', 'lista1', 'lista2'));
    }

    public function delete2($id, $idJornada) {
        $this->request->allowMethod(['post', 'delete']);
        $this->loadModel('SiJornadaTemas');
        $siJornadaTema = $this->SiJornadaTemas->get($id);
        if ($this->SiJornadaTemas->delete($siJornadaTema)) {
            $this->Flash->success(__('El tema con el id: {0} ha sido eliminado.', h($id)), 'success');
            return $this->redirect(['action' => 'index2', $idJornada]);
        }
    }

    public function edit2($id = null, $idJornada = null) {
        $this->loadModel('SiJornadaTemas');
        $siJornadaTema = $this->SiJornadaTemas->find('all')->where(['id' => $id])->first();
        if ($this->request->is(['post', 'put'])) {
            $siJornadaTema = $this->SiJornadaTemas->patchEntity($siJornadaTema, $this->request->data);

            $siJornadaTema->modifier_id = $this->Auth->user()['id'];
            if ($this->SiJornadaTemas->save($siJornadaTema)) {
                $this->Flash->success(__('La jornada ha sido Editado.'), 'success');
                return $this->redirect(['action' => 'index2', $idJornada]);
            }
            $this->Flash->error(__('No se pudo editar el jornada.'));
        }

        $jornada = $this->SiJornadas->find('all')->where(['id' => $idJornada])->first();

        $this->loadModel('SiTemas');
        $this->loadModel('SiLideres');

        $lista1 = $this->SiTemas->find('list', ['id' => 'id', 'valueField' => 'tema'])
                ->where(['tipo_id' => 1165, 'status_id' => 1])
                ->order(['id' => 'ASC']);

        $lideresdb = $this->SiLideres->find()->select(['SiLideres.id', 'Persons.documento', 'Persons.nombres', 'Persons.apellidos'])
                ->where(['SiLideres.id_nivel' => 209, 'SiLideres.status_id' => 1])
                ->contain(['Persons']);

        foreach ($lideresdb as $lider) {
            $lista2[$lider['id']] = $lider['person']['documento'] . ' | ' . $lider['person']['nombres'] . ' ' . $lider['person']['apellidos'];
        } //Lista para Lideres de acompañamiento 

        $this->set(compact('siJornadaTema', 'jornada', 'id', 'lista1', 'lista2'));
    }

    /////////////////////////////////////////METODOS PARA SEGUIMIENTOS////////////////////////////////////////////////

    public function asistentes($idJornada = null) {
        $this->loadModel('SiJornadaAsistentes');
        $this->loadModel('SiJornadas');
        $this->loadModel('SiPastores');
        $this->loadModel('Persons');
        $this->loadModel('SiJornadaTemas');

        $siJornadaTemasExist = $this->SiJornadaTemas->find('all')->where(['id_jornada' => $idJornada, 'status_id' => 1]);

        if (count($siJornadaTemasExist->toArray()) > 0) {
            $siJornadaAsistentes = $this->SiJornadaAsistentes->find('all')
                    ->where(['SiJornadaAsistentes.id_jornada' => $idJornada, 'SiJornadaAsistentes.status_id' => 1])
                    //->limit(300)
                    //->page(1)                
                    ->contain(['Persona', 'Guia', 'SiPastores.Persons', 'Tutor', 'SiJornadas', 'MaPropiedades', 'MaStatus'])
                    ->order(['Persona.nombres' => 'ASC']);

            if ($this->request->is('post')) {
                $request = $this->request->data;

                $siJornadaAsistenteExist = $this->SiJornadaAsistentes->find('all')->where(['id_jornada' => $idJornada, 'id_datos_basicos' => $request['id_datos_basicos'], 'status_id' => 1])->first();

                if ($siJornadaAsistenteExist == '') {
                    $siJornadaAsistente = $this->SiJornadaAsistentes->newEntity();
                    $siJornadaAsistente->id_datos_basicos = $request['id_datos_basicos'];
                    $siJornadaAsistente->id_jornada = $idJornada;
                    $siJornadaAsistente->id_tipo_asistente = $request['id_tipo_asistente'];
                    $siJornadaAsistente->id_guia = $request['id_guia'];
                    $siJornadaAsistente->id_pastor = $request['id_pastor'];
                    $siJornadaAsistente->id_tutor_pena = $request['id_tutor_pena'];
                    $siJornadaAsistente->status_id = 1;
                    $siJornadaAsistente->creator_id = $this->Auth->user()['id'];

                    if ($this->SiJornadaAsistentes->save($siJornadaAsistente)) {
                        //SE CREA LA ASISTENCIA CON LOS TEMAS ASOCIADOS AL PUNTO DE ENCUENTRO A EL ASISTENTE CREADO
                        $this->loadModel('SiJornadaTemas');
                        $this->loadModel('SiJornadaAsistencias');
                        $siJornadaTemas = $this->SiJornadaTemas->find('all')
                                ->where(['SiJornadaTemas.id_jornada' => $idJornada, 'SiJornadaTemas.status_id' => 1]);
                        
                        foreach ($siJornadaTemas as $siJornadaTema) {
                            $siJornadaAsistencia = $this->SiJornadaAsistencias->newEntity();
                            $siJornadaAsistencia->id_jornada_asistente = $siJornadaAsistente->id;
                            $siJornadaAsistencia->id_jornada_tema = $siJornadaTema->id;
                            $siJornadaAsistencia->asistio = false;
                            $siJornadaAsistencia->creator_id = $this->Auth->user()['id'];

                            $this->SiJornadaAsistencias->save($siJornadaAsistencia);
                        }

                        //////////////////////                    

                        $this->Flash->success(__('El asistente ha sido Agregado.'), 'success');
                        return $this->redirect(['action' => 'asistentes', $idJornada]);
                    }
                } else {
                    $this->Flash->error(__('El asistente ya se esta agregado al jornada.'), 'success');
                    return $this->redirect(['action' => 'asistentes', $idJornada]);
                }
            }

            $jornada = $this->SiJornadas->find('all')->where(['id' => $idJornada])->first();

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
            
            $lista5 = $lista1; //Tutores de peña

            $this->set(compact('siJornadaAsistentes', 'jornada', 'lista1', 'lista2', 'lista3', 'lista4', 'lista5'));
        } else {
            $this->Flash->error(__('Para agregar asistentes primero debe asociar temas a la jornada.'), 'success');
            return $this->redirect(['action' => 'index']);
        }
    }

    public function delete3($id, $idJornada) {
        $this->request->allowMethod(['post', 'delete']);
        $this->loadModel('SiJornadaAsistentes');
        $siJornadaAsistente = $this->SiJornadaAsistentes->get($id);
        if ($this->SiJornadaAsistentes->delete($siJornadaAsistente)) {
            $this->Flash->success(__('El asistente con el id: {0} ha sido eliminado.', h($id)), 'success');
            return $this->redirect(['action' => 'asistentes', $idJornada]);
        }
    }

    public function asistencia($idJornada = null) {

        $this->loadModel('SiJornadaAsistencias');
        $this->loadModel('SiJornadaAsistentes');
        $this->loadModel('SiJornadaTemas');

        $siJornadaAsistentes = $this->SiJornadaAsistentes->find('all')
                ->select(['SiJornadaAsistentes.id', 'Persona.id', 'Persona.nombres', 'Persona.apellidos', 'Persona.documento'])
                ->where(['SiJornadaAsistentes.id_jornada' => $idJornada, 'SiJornadaAsistentes.status_id' => 1])
                ->contain(['Persona']);

        if (count($siJornadaAsistentes->toArray()) > 0) {
            $siJornadaAsistencias = $this->SiJornadaAsistencias->find('all')
                    ->where(['SiJornadaAsistentes.id_jornada' => $idJornada])
                    //->limit(300)
                    //->page(1)                
                    ->contain(['SiJornadaAsistentes', 'SiJornadaTemas.SiTemas'])
                    ->order(['SiJornadaAsistencias.id' => 'ASC']);

            //$this->pr($siJornadaAsistentesExist); die;

            $jornada = $this->SiJornadas->find('all')->where(['id' => $idJornada])->first();
            $temas = $this->SiJornadaTemas->find('all')
                    ->select(['SiTemas.tema', 'SiJornadaTemas.fecha'])
                    ->where(['id_jornada' => $idJornada, 'SiJornadaTemas.status_id' => 1])
                    ->contain(['SiTemas']);

            $this->set(compact('siJornadaAsistencias', 'siJornadaAsistentes', 'jornada', 'temas'));
        } else {
            $this->Flash->error(__('Para gestionar la asistencia primero debe asociar asistentes a la jornada.'), 'success');
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
        $this->loadModel('SiJornadaAsistencias');
        $siJornadaAsistencias = $this->SiJornadaAsistencias->get($this->request->data['id']);
        $siJornadaAsistencias->asistio = $this->request->data['asistio'];

        if ($this->SiJornadaAsistencias->save($siJornadaAsistencias)) {
            $this->Flash->success(__('La aistencia con el id: {0} ha sido guardada.', h($id)), 'success');
            return $this->redirect(['action' => 'asistencia', $this->request->data['id']]);
        }
    }

}
