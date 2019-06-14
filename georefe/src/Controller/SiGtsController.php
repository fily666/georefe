<?php

namespace App\Controller;

use Cake\Event\Event;

class SiGtsController extends AppController
{

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['datosbasicos', 'addasistencia', 'listabarrios', 'listalocalidades']);
    }

    public function index()
    {
        $this->loadModel('Users');
        $this->loadModel('SiLideres');
        $rol = $this->Auth->user()['group_id'];
        if ($rol == 1) {
            $siGts = $this->SiGts->find('all')
                ->where(['SiGts.status_id <>' => 3])
            //->limit(300)
            //->page(1)
                ->contain(['Lider1', 'Lider1.Persons', 'SiPastores.Persons', 'DiaReunion', 'MaStatus', 'Categoria'])
                ->order(['SiGts.id' => 'DESC']);
        } else {
            $user = $this->Users->find('all')->select(['person_id'])
                ->where(['id' => $this->Auth->user()['id']])->first();

            $lider = $this->SiLideres->find('all')->select(['id'])
                ->where(['id_datos_basicos' => $user->person_id, 'id_nivel' => 207])->first();

            $siGts = $this->SiGts->find('all')
                ->where(['SiGts.id_lider_asignado1' => $lider->id,
                    'SiGts.status_id <>' => 3])
                ->contain(['Lider1', 'Lider1.Persons', 'SiPastores.Persons', 'DiaReunion', 'MaStatus', 'Categoria'])
                ->order(['SiGts.id' => 'DESC']);
        }

        //$this->pr($this->Auth->user()['id']);
        //$this->pr($siGts); die;

        $this->set(compact('siGts'));
    }

    public function add()
    {
        $this->loadModel('SiLideres');
        $this->loadModel('SiPastores');
        $siGt = $this->SiGts->newEntity();
        if ($this->request->is('post')) {
            $siGt = $this->SiGts->patchEntity($siGt, $this->request->data);

            $siGt->creator_id = $this->Auth->user()['id'];
            if ($this->SiGts->save($siGt)) {

                //SE AGREGAN LOS TEMAS POR DEFECTO
                $this->loadModel('SiTemas');
                $this->loadModel('SiGtTemas');
                $temas = $this->SiTemas->find('all')->where(['tipo_id' => 1166, 'status_id' => 1]);

                if ($temas != '') {
                    foreach ($temas as $tema) {
                        $siGtTemas = $this->SiGtTemas->newEntity();
                        $siGtTemas->id_gt = $siGt->id;
                        $siGtTemas->id_tema = $tema->id;
                        $siGtTemas->status_id = 1;
                        $siGtTemas->creator_id = $this->Auth->user()['id'];
                        $this->SiGtTemas->save($siGtTemas);
                    }
                }

                $this->Flash->success(__('El GT ha sido agregado.'), 'success');
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo agregar el gt.'));
        }

        $lista2[] = array();
        unset($lista2[0]);

        $lista3[] = array();
        unset($lista3[0]);

        $lista7 = array();

        $lista8 = array();

        $lista9[] = array();
        unset($lista9[0]);

        $lideresGt = $this->SiLideres->find()->select(['SiLideres.id', 'Persons.documento', 'Persons.nombres', 'Persons.apellidos'])
            ->where(['SiLideres.id_nivel' => 207, 'SiLideres.status_id' => 1])
            ->contain(['Persons'])
            ->order(['Persons.nombres' => 'ASC']);

        foreach ($lideresGt as $lider) {
            $lista2[$lider['id']] = $lider['person']['documento'] . ' | ' . $lider['person']['nombres'] . ' ' . $lider['person']['apellidos'];
        } //Lista para lideres de gt

        $lideresAc = $this->SiLideres->find()->select(['SiLideres.id', 'Persons.documento', 'Persons.nombres', 'Persons.apellidos'])
            ->where(['SiLideres.id_nivel' => 209, 'SiLideres.status_id' => 1])
            ->contain(['Persons'])
            ->order(['Persons.nombres' => 'ASC']);

        foreach ($lideresAc as $liderAc) {
            $lista9[$liderAc['id']] = $liderAc['person']['documento'] . ' | ' . $liderAc['person']['nombres'] . ' ' . $liderAc['person']['apellidos'];
        } //Lista para lideres de acompañamiento

        $pastores = $this->SiPastores->find()->select(['SiPastores.id', 'Persons.documento', 'Persons.nombres', 'Persons.apellidos'])
            ->where(['SiPastores.status_id' => 1])
            ->contain(['Persons'])
            ->order(['Persons.nombres' => 'ASC']);

        foreach ($pastores as $pastor) {
            $lista3[$pastor['id']] = $pastor['person']['documento'] . ' | ' . $pastor['person']['nombres'] . ' ' . $pastor['person']['apellidos'];
        } //Lista para lideres de gt

        $lista1 = $this->properties(290); //Lista para dias de reunion

        $lista4 = $this->estadosCategoria("GT"); //Lista para los estados de GT
        $lista5 = $this->properties(287); //Lista de categorias

        $lista6 = $this->properties(349); //Lista de Ciudades

        $this->set(compact('siGt', 'lista1', 'lista2', 'lista3', 'lista4', 'lista5', 'lista6', 'lista7', 'lista8', 'lista9'));
    }

    public function edit($id = null)
    {
        $this->loadModel('SiLideres');
        $this->loadModel('SiPastores');
        $this->loadModel('SiLideres');
        $siGt = $this->SiGts->find('all')->where(['id' => $id])->first();
        if ($this->request->is(['post', 'put'])) {
            $siGt = $this->SiGts->patchEntity($siGt, $this->request->data);

            $siGt->modifier_id = $this->Auth->user()['id'];
            if ($this->SiGts->save($siGt)) {
                $this->Flash->success(__('El gt ha sido Editado.'), 'success');
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo editar el gt.'));
        }

        $lideresGt = $this->SiLideres->find()->select(['SiLideres.id', 'Persons.documento', 'Persons.nombres', 'Persons.apellidos'])
            ->where(['SiLideres.id_nivel' => 207, 'SiLideres.status_id' => 1])
            ->contain(['Persons'])
            ->order(['Persons.nombres' => 'ASC']);

        foreach ($lideresGt as $lider) {
            $lista2[$lider['id']] = $lider['person']['documento'] . ' | ' . $lider['person']['nombres'] . ' ' . $lider['person']['apellidos'];
        } //Lista para lideres de gt

        $lideresAc = $this->SiLideres->find()->select(['SiLideres.id', 'Persons.documento', 'Persons.nombres', 'Persons.apellidos'])
            ->where(['SiLideres.id_nivel' => 209, 'SiLideres.status_id' => 1])
            ->contain(['Persons'])
            ->order(['Persons.nombres' => 'ASC']);

        foreach ($lideresAc as $liderAc) {
            $lista9[$liderAc['id']] = $liderAc['person']['documento'] . ' | ' . $liderAc['person']['nombres'] . ' ' . $liderAc['person']['apellidos'];
        } //Lista para lideres de acompañamiento

        $pastores = $this->SiPastores->find()->select(['SiPastores.id', 'Persons.documento', 'Persons.nombres', 'Persons.apellidos'])
            ->where(['SiPastores.status_id' => 1])
            ->contain(['Persons'])
            ->order(['Persons.nombres' => 'ASC']);

        foreach ($pastores as $pastor) {
            $lista3[$pastor['id']] = $pastor['person']['documento'] . ' | ' . $pastor['person']['nombres'] . ' ' . $pastor['person']['apellidos'];
        } //Lista para lideres de gt

        $lista1 = $this->properties(290); //Lista para dias de reunion

        $lista4 = $this->estadosCategoria("GT"); //Lista para los estados de GT
        $lista5 = $this->properties(287); //Lista de categorias

        $lista6 = $this->properties(349); //Lista de Ciudades
        $lista7 = $this->properties(350); //Lista de Localidades
        $lista8 = $this->properties(366); //Lista de Barrios

        $this->set(compact('siGt', 'lista1', 'lista2', 'lista3', 'lista4', 'lista5', 'lista6', 'lista7', 'lista8', 'lista9'));
    }

    public function delete($id)
    {
        $this->request->allowMethod(['post', 'delete']);
        $siGt = $this->SiGts->get($id);
        $siGt->status_id = 3;
        if ($this->SiGts->save($siGt)) {
            $this->Flash->success(__('El gt con el id: {0} ha sido eliminado.', h($id)), 'success');
            return $this->redirect(['action' => 'index']);
        }
    }

    public function inactivity($id)
    {
        $this->request->allowMethod(['post', 'inactivity']);
        $siGt = $this->SiGts->get($id);
        $siGt->status_id = 0;
        if ($this->SiGts->save($siGt)) {
            $this->Flash->success(__('La Gt con el id: {0} ha sido inactivado.', h($id)), 'success');
            return $this->redirect(['action' => 'index']);
        }
    }

    public function activity($id)
    {
        $this->request->allowMethod(['post', 'activity']);
        $siGt = $this->SiGts->get($id);
        $siGt->status_id = 1;
        if ($this->SiGts->save($siGt)) {
            $this->Flash->success(__('La Gt con el id: {0} ha sido activado.', h($id)), 'success');
            return $this->redirect(['action' => 'index']);
        }
    }

    public function listalocalidades($id)
    {
        $this->request->allowMethod(['get', 'listalocalidades']);
        $this->layout = 'ajax';
        $this->loadModel('MaPropiedades');
        $lista7 = $this->properties($id); 
        $this->set('lista7' ,$lista7);
    }

    public function listabarrios($id)
    {
        $this->request->allowMethod(['get', 'listabarrios']);
        $this->layout = 'ajax';
        $this->loadModel('MaPropiedades');
        $lista8 = $this->properties($id); 
        $this->set('lista8' ,$lista8);
    }
    
    /////////////////// METODOS PARA ASOCIAR LOS TEMAS A LOS PUNTOS DE ENCUENTRO ////////////////

    public function index2($id = null)
    {
        $this->loadModel('SiGtTemas');
        $this->loadModel('SiGts');
        $this->loadModel('SiTemas');
        $siGtTemas = $this->SiGtTemas->find('all')
            ->where(['SiGtTemas.id_gt' => $id, 'SiGtTemas.status_id IN' => [1, 2]])
            ->contain(['SiGts', 'SiTemas', 'MaStatus'])
            ->order(['SiGtTemas.id' => 'ASC']);

        if ($this->request->is('post')) {
            $request = $this->request->data;
            // Validacion otros temas
            $id_tema = $request['id_tema'];
            if ($id_tema == 75){
                $siGtTemaFechaExist = $this->SiGtTemas->find('all')
                ->where(['id_gt' => $id, 'fecha' => $request['fecha'], 'status_id IN' => [1, 2]])->first();
                if ($siGtTemaFechaExist == '') {
                    $descOtroTema = $request['descripcion_tema'];
                    $citaOtroTema = $request['cita_biblica'];
                    if ($descOtroTema == '' || $citaOtroTema == '') {
                        $this->Flash->error(__('Debe ingresar descripción y cita bíblica para Otro Tema.'), 'success');
                        return $this->redirect(['action' => 'index2', $id]);
                    } else {
                        // Ingreso de nuevo tema
                        $siTema = $this->SiTemas->newEntity();
                        $siTema->tema = $citaOtroTema . " " . $descOtroTema;
                        $siTema->tipo_id = 1166;
                        $siTema->tema_estandar = 0;
                        $siTema->status_id = 1;
                        $siTema->creator_id = $this->Auth->user()['id'];
                        if ($this->SiTemas->save($siTema)) {
                            $siGtTema = $this->SiGtTemas->newEntity();
                            $siGtTema->id_gt = $id;
                            $siGtTema->id_tema = $siTema->id;
                            $siGtTema->fecha = $request['fecha'];
                            $siGtTema->status_id = 1;
                            $siGtTema->creator_id = $this->Auth->user()['id'];
    
                            if ($this->SiGtTemas->save($siGtTema)) {
                                //Se crea la asistencia del tema creado para los asistentes del GT                        $this->loadModel('SiGtTemas');
                                $this->loadModel('SiGtAsistencias');
                                $this->loadModel('SiGtAsistentes');
                                $siGtAsistentes = $this->SiGtAsistentes->find('all')
                                ->where(['SiGtAsistentes.id_gt' => $id, 'SiGtAsistentes.status_id' => 1])
                                ->contain(['Persona', 'SiGts', 'MaStatus'])
                                ->order(['Persona.nombres' => 'ASC']);
                                
                                foreach ($siGtAsistentes as $siGtAsistente) {
                                    
                                    $siGtAsistencia = $this->SiGtAsistencias->newEntity();
                                    $siGtAsistencia->id_gt_asistente = $siGtAsistente->id;
                                    $siGtAsistencia->id_gt_tema = $siGtTema->id;
                                    $siGtAsistencia->asistio = false;
                                    $siGtAsistencia->creator_id = $this->Auth->user()['id'];
    
                                    $this->SiGtAsistencias->save($siGtAsistencia);
                                }
                                $this->Flash->success(__('El tema ha sido Agregado.'), 'success');
                                return $this->redirect(['action' => 'index2', $id]);
                            }   
                        }
                    }   
                } else {
                    $this->Flash->error(__('Ya existe un tema con la fecha seleccionada.'), 'success');
                    return $this->redirect(['action' => 'index2', $id]);
                }

            } else {
                $siGtTemaExist = $this->SiGtTemas->find('all')->where(['id_gt' => $id, 'id_tema' => $request['id_tema'], 'status_id IN' => [1, 2]])->first();

                if ($siGtTemaExist == '') {
                    $siGtTema = $this->SiGtTemas->newEntity();
                    $siGtTema->id_gt = $id;
                    $siGtTema->id_tema = $request['id_tema'];
                    $siGtTema->fecha = $request['fecha'];
                    $siGtTema->status_id = 1;
                    $siGtTema->creator_id = $this->Auth->user()['id'];

                    if ($this->SiGtTemas->save($siGtTema)) {
                        //Se crea la asistencia del tema creado para los asistentes del GT                        $this->loadModel('SiGtTemas');
                        $this->loadModel('SiGtAsistencias');
                        $this->loadModel('SiGtAsistentes');
                        $siGtAsistentes = $this->SiGtAsistentes->find('all')
                        ->where(['SiGtAsistentes.id_gt' => $id, 'SiGtAsistentes.status_id' => 1])
                        ->contain(['Persona', 'SiGts', 'MaStatus'])
                        ->order(['Persona.nombres' => 'ASC']);
                        
                        foreach ($siGtAsistentes as $siGtAsistente) {
                            
                            $siGtAsistencia = $this->SiGtAsistencias->newEntity();
                            $siGtAsistencia->id_gt_asistente = $siGtAsistente->id;
                            $siGtAsistencia->id_gt_tema = $siGtTema->id;
                            $siGtAsistencia->asistio = false;
                            $siGtAsistencia->creator_id = $this->Auth->user()['id'];

                            $this->SiGtAsistencias->save($siGtAsistencia);
                        }
                        $this->Flash->success(__('El tema ha sido Agregado.'), 'success');
                        return $this->redirect(['action' => 'index2', $id]);
                    }
                } else {
                    $this->Flash->error(__('El Tema ya se encuentra asociado al gt.'), 'success');
                    return $this->redirect(['action' => 'index2', $id]);
                }
            }
        }

        $gt = $this->SiGts->find('all')->where(['id' => $id])->first();

        $this->loadModel('SiTemas');

        $lista1 = $this->SiTemas->find('list', ['id' => 'id', 'valueField' => 'tema'])
            ->where(['tipo_id' => 1166, 'status_id' => 1, 'tema_estandar' => 1])
            ->order(['id' => 'ASC']);

        $this->set(compact('siGtTemas', 'gt', 'id', 'lista1'));
    }

    public function delete2($id, $idGt)
    {
        $this->request->allowMethod(['post', 'delete']);
        $this->loadModel('SiGtTemas');
        $this->loadModel('SiGtAsistencias');
        $siGtTema = $this->SiGtTemas->get($id);
        $idGtTema = $siGtTema->id;
        $siGtAsistencias = $this->SiGtAsistencias->find('all')->where(['id_gt_tema' => $idGtTema]);
        
        foreach ($siGtAsistencias as $asistencia) {
            $this->SiGtAsistencias->delete($asistencia);
        }
        
        if ($this->SiGtTemas->delete($siGtTema)) {
            $this->Flash->success(__('El tema con el id: {0} ha sido eliminado.', h($id)), 'success');
            return $this->redirect(['action' => 'index2', $idGt]);
        }
    }

    public function edit2($id = null, $idGt = null)
    {
        $this->loadModel('SiGtTemas');
        $siGtTema = $this->SiGtTemas->find('all')->where(['id' => $id])->first();
        if ($this->request->is(['post', 'put'])) {
            $siGtTema = $this->SiGtTemas->patchEntity($siGtTema, $this->request->data);

            $siGtTema->modifier_id = $this->Auth->user()['id'];
            if ($this->SiGtTemas->save($siGtTema)) {
                $this->Flash->success(__('El GT ha sido Editado.'), 'success');
                return $this->redirect(['action' => 'index2', $idGt]);
            }
            $this->Flash->error(__('No se pudo editar el gt.'));
        }

        $gt = $this->SiGts->find('all')->where(['id' => $idGt])->first();

        $this->loadModel('SiTemas');
        $this->loadModel('SiLideres');

        $lista1 = $this->SiTemas->find('list', ['id' => 'id', 'valueField' => 'tema'])
            ->where(['tipo_id' => 1166, 'status_id' => 1])
            ->order(['id' => 'ASC']);

        $this->set(compact('siGtTema', 'gt', 'id', 'lista1'));
    }

    /////////////////////////////////////////METODOS PARA SEGUIMIENTOS////////////////////////////////////////////////

    public function asistentes($idGt = null)
    {
        $this->loadModel('SiGtAsistentes');
        $this->loadModel('SiGts');
        $this->loadModel('SiPastores');
        $this->loadModel('Persons');
        $this->loadModel('SiGtTemas');

        $siGtTemasExist = $this->SiGtTemas->find('all')->where(['id_gt' => $idGt, 'status_id' => 1]);

        if (count($siGtTemasExist->toArray()) > 0) {
            $siGtAsistentes = $this->SiGtAsistentes->find('all')
                ->where(['SiGtAsistentes.id_gt' => $idGt, 'SiGtAsistentes.status_id' => 1])
            //->limit(300)
            //->page(1)
                ->contain(['Persona', 'SiGts', 'MaPropiedades', 'MaStatus'])
                ->order(['Persona.nombres' => 'ASC']);

            if ($this->request->is('post')) {
                $request = $this->request->data;

                $siGtAsistenteExist = $this->SiGtAsistentes->find('all')->where(['id_gt' => $idGt, 'id_datos_basicos' => $request['id_datos_basicos'], 'status_id' => 1])->first();

                if ($siGtAsistenteExist == '') {
                    $siGtAsistente = $this->SiGtAsistentes->newEntity();
                    $siGtAsistente->id_datos_basicos = $request['id_datos_basicos'];
                    $siGtAsistente->id_gt = $idGt;
                    $siGtAsistente->id_tipo_asistente = $request['id_tipo_asistente'];
                    $siGtAsistente->status_id = 1;
                    $siGtAsistente->creator_id = $this->Auth->user()['id'];

                    if ($this->SiGtAsistentes->save($siGtAsistente)) {
                        //SE CREA LA ASISTENCIA CON LOS TEMAS ASOCIADOS AL GT A EL ASISTENTE CREADO
                        $this->loadModel('SiGtTemas');
                        $this->loadModel('SiGtAsistencias');
                        $siGtTemas = $this->SiGtTemas->find('all')
                            ->where(['SiGtTemas.id_gt' => $idGt, 'SiGtTemas.status_id' => 1]);

                        foreach ($siGtTemas as $siGtTema) {
                            $siGtAsistencia = $this->SiGtAsistencias->newEntity();
                            $siGtAsistencia->id_gt_asistente = $siGtAsistente->id;
                            $siGtAsistencia->id_gt_tema = $siGtTema->id;
                            $siGtAsistencia->asistio = false;
                            $siGtAsistencia->creator_id = $this->Auth->user()['id'];

                            $this->SiGtAsistencias->save($siGtAsistencia);
                        }

                        //////////////////////

                        $this->Flash->success(__('El asistente ha sido Agregado.'), 'success');
                        return $this->redirect(['action' => 'asistentes', $idGt]);
                    }
                } else {
                    $this->Flash->error(__('El asistente ya se esta agregado al gt.'), 'success');
                    return $this->redirect(['action' => 'asistentes', $idGt]);
                }
            }

            $gt = $this->SiGts->find('all')->where(['id' => $idGt])->first();

            $personsdb = $this->Persons->find()->select(['id', 'documento', 'nombres', 'apellidos'])
                ->where(['status_id' => 1])
                ->order(['nombres' => 'ASC']);
            foreach ($personsdb as $person) {
                $lista1[$person['id']] = $person['documento'] . ' | ' . $person['nombres'] . ' ' . $person['apellidos'];
            } //Lista de personas

            $lista4 = $this->properties(232); //Lista para tipo de asistente

            $this->set(compact('siGtAsistentes', 'gt', 'lista1', 'lista4'));
        } else {
            $this->Flash->error(__('Para agregar asistentes primero debe asociar temas a el gt.'), 'success');
            return $this->redirect(['action' => 'index']);
        }
    }

    public function delete3($id, $idGt)
    {
        $this->request->allowMethod(['post', 'delete']);
        $this->loadModel('SiGtAsistentes');
        $this->loadModel('SiGtAsistencias');
        $asistencias = $this->SiGtAsistencias->find('all')->where(['id_gt_asistente' => $id]);

        foreach ($asistencias as $asistencia) {
            $this->SiGtAsistencias->delete($asistencia);
        }

        $siGtAsistente = $this->SiGtAsistentes->get($id);
        if ($this->SiGtAsistentes->delete($siGtAsistente)) {
            $this->Flash->success(__('El asistente con el id: {0} ha sido eliminado.', h($id)), 'success');
            return $this->redirect(['action' => 'asistentes', $idGt]);
        }
    }

    public function asistencia($idGt = null)
    {

        $this->loadModel('SiGtAsistencias');
        $this->loadModel('SiGtAsistentes');
        $this->loadModel('SiGtTemas');

        $siGtAsistentes = $this->SiGtAsistentes->find('all')
            ->select(['SiGtAsistentes.id', 'Persona.id', 'Persona.nombres', 'Persona.apellidos', 'Persona.documento'])
            ->where(['SiGtAsistentes.id_gt' => $idGt, 'SiGtAsistentes.status_id' => 1])
            ->contain(['Persona']);

        if (count($siGtAsistentes->toArray()) > 0) {
            $siGtAsistencias = $this->SiGtAsistencias->find('all')
                ->where(['SiGtAsistentes.id_gt' => $idGt])
            //->limit(300)
            //->page(1)
                ->contain(['SiGtAsistentes', 'SiGtTemas.SiTemas'])
                ->order(['SiGtAsistencias.id' => 'ASC']);

            //$this->pr($siGtAsistentesExist); die;

            $gt = $this->SiGts->find('all')->where(['id' => $idGt])->first();
            $temas = $this->SiGtTemas->find('all')
                ->select(['SiTemas.tema', 'SiGtTemas.fecha'])
                ->where(['id_gt' => $idGt, 'SiGtTemas.status_id' => 1])
                ->contain(['SiTemas']);

            $this->set(compact('siGtAsistencias', 'siGtAsistentes', 'gt', 'temas'));
        } else {
            $this->Flash->error(__('Para gestionar la asistencia primero debe asociar asistentes a el gt.'), 'success');
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
        $this->loadModel('SiGtAsistencias');
        $siGtAsistencias = $this->SiGtAsistencias->get($this->request->data['id']);
        $siGtAsistencias->asistio = $this->request->data['asistio'];

        if ($this->SiGtAsistencias->save($siGtAsistencias)) {
            $this->Flash->success(__('La aistencia con el id: {0} ha sido guardada.', h($id)), 'success');
            return $this->redirect(['action' => 'asistencia', $this->request->data['id']]);
        }
    }

}
