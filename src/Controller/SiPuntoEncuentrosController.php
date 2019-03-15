<?php

namespace App\Controller;

use Cake\Event\Event;

class SiPuntoEncuentrosController extends AppController
{

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['datosbasicos', 'addasistencia']);
    }

    public function index()
    {
        $siPuntoEncuentros = $this->SiPuntoEncuentros->find('all')
            ->where(['SiPuntoEncuentros.status_id <>' => 3])
        //->limit(300)
        //->page(1)
            ->contain(['Coordinador.Persons', 'MaPropiedades', 'MaStatus'])
            ->order(['SiPuntoEncuentros.id' => 'DESC']);

        //$this->pr($siPuntoEncuentros); die;

        $this->set(compact('siPuntoEncuentros'));
    }

    public function add()
    {
        $this->loadModel('SiLideres');
        $siPuntoEncuentro = $this->SiPuntoEncuentros->newEntity();
        if ($this->request->is('post')) {
            $siPuntoEncuentro = $this->SiPuntoEncuentros->patchEntity($siPuntoEncuentro, $this->request->data);

            $siPuntoEncuentro->creator_id = $this->Auth->user()['id'];
            if ($this->SiPuntoEncuentros->save($siPuntoEncuentro)) {

                //SE AGREGAN LOS TEMAS POR DEFECTO
                $this->loadModel('SiTemas');
                $this->loadModel('SiPuntosEncuentroTemas');
                $temas = $this->SiTemas->find('all')->where(['tipo_id' => 1163, 'status_id' => 1]);

                if ($temas != '') {
                    foreach ($temas as $tema) {
                        $siPuntoEncuentroTemas = $this->SiPuntosEncuentroTemas->newEntity();
                        $siPuntoEncuentroTemas->id_punto_encuentro = $siPuntoEncuentro->id;
                        $siPuntoEncuentroTemas->id_tema = $tema->id;
                        $siPuntoEncuentroTemas->status_id = 1;
                        $siPuntoEncuentroTemas->creator_id = $this->Auth->user()['id'];
                        $this->SiPuntosEncuentroTemas->save($siPuntoEncuentroTemas);
                    }
                }

                $this->Flash->success(__('El punto de encuentro ha sido agregada.'), 'success');
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo agregar el punto de encuentro.'));
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

        $lista2 = $this->properties(228); //Lista para tipos de punto de encuentro
        $lista3 = $this->estadosCategoria('AMBIENTES'); //Lista para estados de puntos de encuentro

        $this->set(compact('siPuntoEncuentro', 'lista1', 'lista2', 'lista3'));
    }

    public function edit($id = null)
    {
        $this->loadModel('SiLideres');
        $siPuntoEncuentro = $this->SiPuntoEncuentros->find('all')->where(['id' => $id])->first();
        if ($this->request->is(['post', 'put'])) {
            $siPuntoEncuentro = $this->SiPuntoEncuentros->patchEntity($siPuntoEncuentro, $this->request->data);

            $siPuntoEncuentro->modifier_id = $this->Auth->user()['id'];
            if ($this->SiPuntoEncuentros->save($siPuntoEncuentro)) {
                $this->Flash->success(__('El punto de encuentro ha sido Editado.'), 'success');
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo editar el punto de encuentro.'));
        }

        $coordinadores = $this->SiLideres->find()->select(['SiLideres.id', 'Persons.documento', 'Persons.nombres', 'Persons.apellidos'])
            ->where(['SiLideres.id_nivel' => 210, 'SiLideres.status_id' => 1])
            ->contain(['Persons'])
            ->order(['Persons.nombres' => 'ASC']);

        foreach ($coordinadores as $coordinador) {
            $lista1[$coordinador['id']] = $coordinador['person']['documento'] . ' | ' . $coordinador['person']['nombres'] . ' ' . $coordinador['person']['apellidos'];
        } //Lista para Coordinadores de exodo

        $lista2 = $this->properties(228); //Lista para tipos de punto de encuentro
        $lista3 = $this->estadosCategoria('AMBIENTES'); //Lista para estados de puntos de encuentro

        $this->set(compact('siPuntoEncuentro', 'lista1', 'lista2', 'lista3'));
    }

    public function delete($id)
    {
        $this->request->allowMethod(['post', 'delete']);
        $siPuntoEncuentro = $this->SiPuntoEncuentros->get($id);
        $siPuntoEncuentro->status_id = 3;
        if ($this->SiPuntoEncuentros->save($siPuntoEncuentro)) {
            $this->Flash->success(__('El punto de encuentro con el id: {0} ha sido eliminado.', h($id)), 'success');
            return $this->redirect(['action' => 'index']);
        }
    }

    public function inactivity($id)
    {
        $this->request->allowMethod(['post', 'inactivity']);
        $siPuntoEncuentro = $this->SiPuntoEncuentros->get($id);
        $siPuntoEncuentro->status_id = 0;
        if ($this->SiPuntoEncuentros->save($siPuntoEncuentro)) {
            $this->Flash->success(__('El Punto con el id: {0} ha sido inactivado.', h($id)), 'success');
            return $this->redirect(['action' => 'index']);
        }
    }

    public function activity($id)
    {
        $this->request->allowMethod(['post', 'activity']);
        $siPuntoEncuentro = $this->SiPuntoEncuentros->get($id);
        $siPuntoEncuentro->status_id = 1;
        if ($this->SiPuntoEncuentros->save($siPuntoEncuentro)) {
            $this->Flash->success(__('El punto con el id: {0} ha sido activado.', h($id)), 'success');
            return $this->redirect(['action' => 'index']);
        }
    }

    /////////////////// METODOS PARA ASOCIAR LOS TEMAS A LOS PUNTOS DE ENCUENTRO ////////////////

    public function index2($id = null)
    {
        $this->loadModel('SiPuntosEncuentroTemas');
        $this->loadModel('SiPuntoEncuentros');
        $siPuntosEncuentroTemas = $this->SiPuntosEncuentroTemas->find('all')
            ->where(['SiPuntosEncuentroTemas.id_punto_encuentro' => $id, 'SiPuntosEncuentroTemas.status_id IN' => [1, 2]])
            ->contain(['SiPuntoEncuentros', 'SiTemas', 'SiLideres.Persons', 'MaStatus'])
            ->order(['SiPuntosEncuentroTemas.id' => 'ASC']);

        if ($this->request->is('post')) {
            $request = $this->request->data;

            $siPuntoEncuentroTemaExist = $this->SiPuntosEncuentroTemas->find('all')->where(['id_punto_encuentro' => $id, 'id_tema' => $request['id_tema'], 'status_id IN' => [1, 2]])->first();

            if ($siPuntoEncuentroTemaExist == '') {
                $siPuntoEncuentroTema = $this->SiPuntosEncuentroTemas->newEntity();
                $siPuntoEncuentroTema->id_punto_encuentro = $id;
                $siPuntoEncuentroTema->id_tema = $request['id_tema'];
                $siPuntoEncuentroTema->id_lider = $request['id_lider'];
                $siPuntoEncuentroTema->fecha = $request['fecha'];
                $siPuntoEncuentroTema->status_id = 1;
                $siPuntoEncuentroTema->creator_id = $this->Auth->user()['id'];

                if ($this->SiPuntosEncuentroTemas->save($siPuntoEncuentroTema)) {
                    $this->Flash->success(__('El tema ha sido Agregado.'), 'success');
                    return $this->redirect(['action' => 'index2', $id]);
                }
            } else {
                $this->Flash->error(__('El Tema ya se encuentra asociado al punto de encuentro.'), 'success');
                return $this->redirect(['action' => 'index2', $id]);
            }
        }

        $puntoEncuentro = $this->SiPuntoEncuentros->find('all')->where(['id' => $id])->first();

        $this->loadModel('SiTemas');
        $this->loadModel('SiLideres');

        $lista1 = $this->SiTemas->find('list', ['id' => 'id', 'valueField' => 'tema'])
            ->where(['tipo_id' => 1163, 'status_id' => 1])
            ->order(['id' => 'ASC']);

        $lideresdb = $this->SiLideres->find()->select(['SiLideres.id', 'Persons.documento', 'Persons.nombres', 'Persons.apellidos'])
            ->where(['SiLideres.id_nivel' => 209, 'SiLideres.status_id' => 1])
            ->contain(['Persons']);

        foreach ($lideresdb as $lider) {
            $lista2[$lider['id']] = $lider['person']['documento'] . ' | ' . $lider['person']['nombres'] . ' ' . $lider['person']['apellidos'];
        } //Lista para Lideres de acompañamiento

        $this->set(compact('siPuntosEncuentroTemas', 'puntoEncuentro', 'id', 'lista1', 'lista2'));
    }

    public function delete2($id, $idPunto)
    {
        $this->request->allowMethod(['post', 'delete']);
        $this->loadModel('SiPuntosEncuentroTemas');
        $siPuntosEncuentroTema = $this->SiPuntosEncuentroTemas->get($id);
        if ($this->SiPuntosEncuentroTemas->delete($siPuntosEncuentroTema)) {
            $this->Flash->success(__('El tema con el id: {0} ha sido eliminado.', h($id)), 'success');
            return $this->redirect(['action' => 'index2', $idPunto]);
        }
    }

    public function edit2($id = null, $idPunto = null)
    {
        $this->loadModel('SiPuntosEncuentroTemas');
        $siPuntosEncuentroTema = $this->SiPuntosEncuentroTemas->find('all')->where(['id' => $id])->first();
        if ($this->request->is(['post', 'put'])) {
            $siPuntosEncuentroTema = $this->SiPuntosEncuentroTemas->patchEntity($siPuntosEncuentroTema, $this->request->data);

            $siPuntosEncuentroTema->modifier_id = $this->Auth->user()['id'];
            if ($this->SiPuntosEncuentroTemas->save($siPuntosEncuentroTema)) {
                $this->Flash->success(__('El punto de encuentro ha sido Editado.'), 'success');
                return $this->redirect(['action' => 'index2', $idPunto]);
            }
            $this->Flash->error(__('No se pudo editar el punto de encuentro.'));
        }

        $puntoEncuentro = $this->SiPuntoEncuentros->find('all')->where(['id' => $idPunto])->first();

        $this->loadModel('SiTemas');
        $this->loadModel('SiLideres');

        $lista1 = $this->SiTemas->find('list', ['id' => 'id', 'valueField' => 'tema'])
            ->where(['tipo_id' => 1163, 'status_id' => 1])
            ->order(['id' => 'ASC']);

        $lideresdb = $this->SiLideres->find()->select(['SiLideres.id', 'Persons.documento', 'Persons.nombres', 'Persons.apellidos'])
            ->where(['SiLideres.id_nivel' => 209, 'SiLideres.status_id' => 1])
            ->contain(['Persons']);

        foreach ($lideresdb as $lider) {
            $lista2[$lider['id']] = $lider['person']['documento'] . ' | ' . $lider['person']['nombres'] . ' ' . $lider['person']['apellidos'];
        } //Lista para Lideres de acompañamiento

        $this->set(compact('siPuntosEncuentroTema', 'puntoEncuentro', 'id', 'lista1', 'lista2'));
    }

    /////////////////////////////////////////METODOS PARA SEGUIMIENTOS////////////////////////////////////////////////

    public function asistentes($idPunto = null)
    {
        $this->loadModel('SiPuntosEncuAsistentes');
        $this->loadModel('SiPuntoEncuentros');
        $this->loadModel('SiPastores');
        $this->loadModel('Persons');
        $this->loadModel('SiPuntosEncuentroTemas');

        $siPuntosEncuentroTemasExist = $this->SiPuntosEncuentroTemas->find('all')->where(['id_punto_encuentro' => $idPunto, 'status_id' => 1]);

        if (count($siPuntosEncuentroTemasExist->toArray()) > 0) {
            $siPuntosEncuAsistentes = $this->SiPuntosEncuAsistentes->find('all')
                ->where(['SiPuntosEncuAsistentes.id_punto_encuentro' => $idPunto, 'SiPuntosEncuAsistentes.status_id' => 1])
            //->limit(300)
            //->page(1)
                ->contain(['Persona', 'Guia', 'SiPastores.Persons', 'SiPuntoEncuentros', 'MaPropiedades', 'MaStatus'])
                ->order(['Persona.nombres' => 'ASC']);

            if ($this->request->is('post')) {
                $request = $this->request->data;

                $siPuntosEncuAsistenteExist = $this->SiPuntosEncuAsistentes->find('all')->where(['id_punto_encuentro' => $idPunto, 'id_datos_basicos' => $request['id_datos_basicos'], 'status_id' => 1])->first();

                if ($siPuntosEncuAsistenteExist == '') {
                    $siPuntosEncuAsistente = $this->SiPuntosEncuAsistentes->newEntity();
                    $siPuntosEncuAsistente->id_datos_basicos = $request['id_datos_basicos'];
                    $siPuntosEncuAsistente->id_punto_encuentro = $idPunto;
                    $siPuntosEncuAsistente->id_tipo_asistente = $request['id_tipo_asistente'];
                    $siPuntosEncuAsistente->id_guia = $request['id_guia'];
                    $siPuntosEncuAsistente->id_pastor = $request['id_pastor'];
                    $siPuntosEncuAsistente->status_id = 1;
                    $siPuntosEncuAsistente->creator_id = $this->Auth->user()['id'];

                    if ($this->SiPuntosEncuAsistentes->save($siPuntosEncuAsistente)) {
                        //SE CREA LA ASISTENCIA CON LOS TEMAS ASOCIADOS AL PUNTO DE ENCUENTRO A EL ASISTENTE CREADO
                        $this->loadModel('SiPuntosEncuentroTemas');
                        $this->loadModel('SiPuntosEncuAsistencias');
                        $siPuntosEncuentroTemas = $this->SiPuntosEncuentroTemas->find('all')
                            ->where(['SiPuntosEncuentroTemas.id_punto_encuentro' => $idPunto, 'SiPuntosEncuentroTemas.status_id' => 1]);

                        foreach ($siPuntosEncuentroTemas as $siPuntosEncuentroTema) {
                            $siPuntosEncuAsistencia = $this->SiPuntosEncuAsistencias->newEntity();
                            $siPuntosEncuAsistencia->id_puntencu_asistente = $siPuntosEncuAsistente->id;
                            $siPuntosEncuAsistencia->id_puntencu_tema = $siPuntosEncuentroTema->id;
                            $siPuntosEncuAsistencia->asistio = false;
                            $siPuntosEncuAsistencia->creator_id = $this->Auth->user()['id'];

                            $this->SiPuntosEncuAsistencias->save($siPuntosEncuAsistencia);
                        }

                        //////////////////////

                        $this->Flash->success(__('El asistente ha sido Agregado.'), 'success');
                        return $this->redirect(['action' => 'asistentes', $idPunto]);
                    }
                } else {
                    $this->Flash->error(__('El asistente ya se esta agregado al punto de encuentro.'), 'success');
                    return $this->redirect(['action' => 'asistentes', $idPunto]);
                }
            }

            $puntoEncuentro = $this->SiPuntoEncuentros->find('all')->where(['id' => $idPunto])->first();

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

            $this->set(compact('siPuntosEncuAsistentes', 'puntoEncuentro', 'lista1', 'lista2', 'lista3', 'lista4'));
        } else {
            $this->Flash->error(__('Para agregar asistentes primero debe asociar temas al punto de encuentro.'), 'success');
            return $this->redirect(['action' => 'index']);
        }
    }

    public function delete3($id, $idPunto)
    {
        $this->request->allowMethod(['post', 'delete']);
        $this->loadModel('SiPuntosEncuAsistentes');
        $siPuntosEncuAsistente = $this->SiPuntosEncuAsistentes->get($id);
        if ($this->SiPuntosEncuAsistentes->delete($siPuntosEncuAsistente)) {
            $this->Flash->success(__('El asistente con el id: {0} ha sido eliminado.', h($id)), 'success');
            return $this->redirect(['action' => 'asistentes', $idPunto]);
        }
    }

    public function asistencia($idPunto = null)
    {

        $this->loadModel('SiPuntosEncuAsistencias');
        $this->loadModel('SiPuntosEncuAsistentes');
        $this->loadModel('SiPuntosEncuentroTemas');

        $siPuntosEncuAsistentes = $this->SiPuntosEncuAsistentes->find('all')
            ->select(['SiPuntosEncuAsistentes.id', 'Persona.id', 'Persona.nombres', 'Persona.apellidos', 'Persona.documento'])
            ->where(['SiPuntosEncuAsistentes.id_punto_encuentro' => $idPunto, 'SiPuntosEncuAsistentes.status_id' => 1])
            ->contain(['Persona']);

        if (count($siPuntosEncuAsistentes->toArray()) > 0) {
            $siPuntosEncuAsistencias = $this->SiPuntosEncuAsistencias->find('all')
                ->where(['SiPuntosEncuAsistentes.id_punto_encuentro' => $idPunto])
            //->limit(300)
            //->page(1)
                ->contain(['SiPuntosEncuAsistentes', 'SiPuntosEncuentroTemas.SiTemas'])
                ->order(['SiPuntosEncuAsistencias.id' => 'ASC']);

            //$this->pr($siPuntosEncuAsistentesExist); die;

            $puntoEncuentro = $this->SiPuntoEncuentros->find('all')->where(['id' => $idPunto])->first();
            $temas = $this->SiPuntosEncuentroTemas->find('all')
                ->select(['SiTemas.tema', 'SiPuntosEncuentroTemas.fecha'])
                ->where(['id_punto_encuentro' => $idPunto, 'SiPuntosEncuentroTemas.status_id' => 1])
                ->contain(['SiTemas']);

            $this->set(compact('siPuntosEncuAsistencias', 'siPuntosEncuAsistentes', 'puntoEncuentro', 'temas'));
        } else {
            $this->Flash->error(__('Para gestionar la asistencia primero debe asociar asistentes al punto de encuentro.'), 'success');
            return $this->redirect(['action' => 'index']);
        }
    }

    public function datosbasicos()
    {
        $this->loadModel('Persons');
        $this->viewBuilder()->layout();
        $persona = $this->Persons->find('all')->select(['MaPropiedades.valor', 'Persons.documento', 'Persons.nombres', 'Persons.apellidos',
            'Persons.direccion', 'Persons.email', 'Persons.telefono1', 'Persons.celular',
            'Persons.fotografia', 'Persons.status_id'])
            ->where(['Persons.id' => $this->request->data['id']])
            ->contain(['MaPropiedades'])->first();

        $this->set(compact('persona'));
    }

    public function addasistencia()
    {
        $this->request->allowMethod(['post', 'addasistencia']);
        $this->loadModel('SiPuntosEncuAsistencias');
        $siPuntosEncuAsistencias = $this->SiPuntosEncuAsistencias->get($this->request->data['id']);
        $siPuntosEncuAsistencias->asistio = $this->request->data['asistio'];

        if ($this->SiPuntosEncuAsistencias->save($siPuntosEncuAsistencias)) {
            $this->Flash->success(__('La aistencia con el id: {0} ha sido guardada.', h($id)), 'success');
            return $this->redirect(['action' => 'asistencia', $this->request->data['id']]);
        }
    }

}
