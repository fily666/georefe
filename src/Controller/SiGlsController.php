<?php

namespace App\Controller;

use Cake\Event\Event;

class SiGlsController extends AppController
{

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['datosbasicos', 'listabarrios', 'listalocalidades', 'addasistencia']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->loadModel('Users');
        $this->loadModel('SiLideres');
        $rol = $this->Auth->user()['group_id'];
        if ($rol == 1) {
            $siGls = $this->SiGls->find('all')
                ->where(['SiGls.status_id <>' => 3])
                ->contain(['Lider.Persons', 'SiPastores.Persons', 'DiaReunion', 'MaStatus', 'Categoria'])
                ->order(['SiGls.id' => 'DESC']);
        } else {
            $user = $this->Users->find('all')->select(['person_id'])
                ->where(['id' => $this->Auth->user()['id']])->first();

            $lider = $this->SiLideres->find('all')->select(['id'])
                ->where(['id_datos_basicos' => $user->person_id, 'id_nivel' => 1173])->first();

            $siGls = $this->SiGls->find('all')
                ->where(['SiGls.id_lider' => $lider->id,
                    'SiGls.status_id <>' => 3])
                ->contain(['Lider.Persons', 'SiPastores.Persons', 'DiaReunion', 'MaStatus', 'Categoria'])
                ->order(['SiGls.id' => 'DESC']);
        }
        $this->set(compact('siGls'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->loadModel('SiLideres');
        $this->loadModel('SiPastores');
        $siGl = $this->SiGls->newEntity();
        if ($this->request->is('post')) {
            $siGl = $this->SiGls->patchEntity($siGl, $this->request->data);

            $siGl->creator_id = $this->Auth->user()['id'];
            if ($this->SiGls->save($siGl)) {
                
                 //SE AGREGAN LOS TEMAS POR DEFECTO
                 $this->loadModel('SiTemas');
                 $this->loadModel('SiGlTemas');
                 $temas = $this->SiTemas->find('all')->where(['tipo_id' => 1174, 'status_id' => 1]);
 
                 if ($temas != '') {
                     foreach ($temas as $tema) {
                         $siGlTemas = $this->SiGlTemas->newEntity();
                         $siGlTemas->id_gl = $siGl->id;
                         $siGlTemas->id_tema = $tema->id;
                         $siGlTemas->status_id = 1;
                         $siGlTemas->creator_id = $this->Auth->user()['id'];
                         $this->SiGlTemas->save($siGlTemas);
                     }
                 }
                 
                $this->Flash->success(__('El grupo de liderazgo ha sido agregado'), 'success');
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El grupo de liderazgo no se ha podido agregar'));
        }

        $lista2[] = array();
        unset($lista2[0]);

        $lista3[] = array();
        unset($lista3[0]);

        $lista7 = array();

        $lista8 = array();

        $lideresGl = $this->SiLideres->find()->select(['SiLideres.id', 'Persons.documento', 'Persons.nombres', 'Persons.apellidos'])
            ->where(['SiLideres.id_nivel' => 1173, 'SiLideres.status_id' => 1])
            ->contain(['Persons'])
            ->order(['Persons.nombres' => 'ASC']);

        foreach ($lideresGl as $lider) {
            $lista2[$lider['id']] = $lider['person']['documento'] . ' | ' . $lider['person']['nombres'] . ' ' . $lider['person']['apellidos'];
        } 

        $pastores = $this->SiPastores->find()->select(['SiPastores.id', 'Persons.documento', 'Persons.nombres', 'Persons.apellidos'])
            ->where(['SiPastores.status_id' => 1])
            ->contain(['Persons'])
            ->order(['Persons.nombres' => 'ASC']);

        foreach ($pastores as $pastor) {
            $lista3[$pastor['id']] = $pastor['person']['documento'] . ' | ' . $pastor['person']['nombres'] . ' ' . $pastor['person']['apellidos'];
        }

        $lista1 = $this->properties(290); //Lista para dias de reunion

        $lista4 = $this->estadosCategoria("GT"); //Lista para los estados de GL, se manejan los mismos que GT
        $lista5 = $this->properties(287); //Lista de categorias

        $lista6 = $this->properties(349); //Lista de Ciudades

        $this->set(compact('siGl', 'lista1', 'lista2', 'lista3', 'lista4', 'lista5', 'lista6', 'lista7', 'lista8'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Si Gl id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->loadModel('SiLideres');
        $this->loadModel('SiPastores');
        $siGl = $this->SiGls->find('all')->where(['id' => $id])->first();
        if ($this->request->is(['post', 'put'])) {
            $siGl = $this->SiGls->patchEntity($siGl, $this->request->data);
            
            $siGl->modifier_id = $this->Auth->user()['id'];
            if ($this->SiGls->save($siGl)) {
                $this->Flash->success(__('El grupo de liderazgo ha sido editado.'), 'success');
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se ha podido editar el grupo de liderazgo.'));
        }
        
        $lideresGl = $this->SiLideres->find()->select(['SiLideres.id', 'Persons.documento', 'Persons.nombres', 'Persons.apellidos'])
            ->where(['SiLideres.id_nivel' => 1173, 'SiLideres.status_id' => 1])
            ->contain(['Persons'])
            ->order(['Persons.nombres' => 'ASC']);

        foreach ($lideresGl as $lider) {
            $lista2[$lider['id']] = $lider['person']['documento'] . ' | ' . $lider['person']['nombres'] . ' ' . $lider['person']['apellidos'];
        } 

        $pastores = $this->SiPastores->find()->select(['SiPastores.id', 'Persons.documento', 'Persons.nombres', 'Persons.apellidos'])
            ->where(['SiPastores.status_id' => 1])
            ->contain(['Persons'])
            ->order(['Persons.nombres' => 'ASC']);

        foreach ($pastores as $pastor) {
            $lista3[$pastor['id']] = $pastor['person']['documento'] . ' | ' . $pastor['person']['nombres'] . ' ' . $pastor['person']['apellidos'];
        }
        $lista1 = $this->properties(290); //Lista para dias de reunion

        $lista4 = $this->estadosCategoria("GT"); //Lista para los estados de GL, se manejan los mismos que GT
        $lista5 = $this->properties(287); //Lista de categorias

        $lista6 = $this->properties(349); //Lista de Ciudades

        $lista7 = $this->properties(350); //Lista de Localidades
        $lista8 = $this->properties(366); //Lista de Barrios

        $this->set(compact('siGl', 'lista1', 'lista2', 'lista3', 'lista4', 'lista5', 'lista6', 'lista7', 'lista8'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Si Gl id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $siGl = $this->SiGls->get($id);
        $siGl->status_id = 3;
        if ($this->SiGls->save($siGl)) {
            $this->Flash->success(__('El grupo de liderazgo con el id: {0} ha sido eliminado.', h($id)), 'success');
            return $this->redirect(['action' => 'index']);
        } else {
            $this->Flash->error(__('No se h podido eliminar el Grupo de Liderazgo.'));
        }
    }

    public function inactivity($id)
    {
        $this->request->allowMethod(['post', 'inactivity']);
        $siGl = $this->SiGls->get($id);
        $siGl->status_id = 0;
        if ($this->SiGls->save($siGl)) {
            $this->Flash->success(__('La Grupo de liderazgo con el id: {0} ha sido inactivado.', h($id)), 'success');
            return $this->redirect(['action' => 'index']);
        }
    }

    public function activity($id)
    {
        $this->request->allowMethod(['post', 'activity']);
        $siGl = $this->SiGls->get($id);
        $siGl->status_id = 1;
        if ($this->SiGls->save($siGl)) {
            $this->Flash->success(__('La Grupo de liderazgo con el id: {0} ha sido activado.', h($id)), 'success');
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
        $this->loadModel('SiGlTemas');
        $this->loadModel('SiGls');
        $this->loadModel('SiTemas');
        $siGlTemas = $this->SiGlTemas->find('all')
            ->where(['SiGlTemas.id_gl' => $id, 'SiGlTemas.status_id IN' => [1, 2]])
            ->contain(['SiGls', 'SiTemas', 'MaStatus'])
            ->order(['SiGlTemas.id' => 'ASC']);

        if ($this->request->is('post')) {
            $request = $this->request->data;
            // Validacion otros temas
            $id_tema = $request['id_tema'];
            if ($id_tema == 98){
                $siGlTemaFechaExist = $this->SiGlTemas->find('all')
                ->where(['id_gl' => $id, 'fecha' => $request['fecha'], 'status_id IN' => [1, 2]])->first();
                if ($siGlTemaFechaExist == '') {
                    $descOtroTema = $request['descripcion_tema'];
                    $citaOtroTema = $request['cita_biblica'];
                    if ($descOtroTema == '' || $citaOtroTema == '') {
                        $this->Flash->error(__('Debe ingresar descripción y cita bíblica para Otro Tema.'), 'success');
                        return $this->redirect(['action' => 'index2', $id]);
                    } else {
                        // Ingreso de nuevo tema
                        $siTema = $this->SiTemas->newEntity();
                        $siTema->tema = $citaOtroTema . " " . $descOtroTema;
                        $siTema->tipo_id = 1174;
                        $siTema->tema_estandar = 0;
                        $siTema->status_id = 1;
                        $siTema->creator_id = $this->Auth->user()['id'];
                        if ($this->SiTemas->save($siTema)) {
                            $siGlTema = $this->SiGlTemas->newEntity();
                            $siGlTema->id_gl = $id;
                            $siGlTema->id_tema = $siTema->id;
                            $siGlTema->fecha = $request['fecha'];
                            $siGlTema->status_id = 1;
                            $siGlTema->creator_id = $this->Auth->user()['id'];
    
                            if ($this->SiGlTemas->save($siGlTema)) {
                                //Se crea la asistencia del tema creado para los asistentes del GL                        
                                $this->loadModel('SiGlAsistencias');
                                $this->loadModel('SiGlAsistentes');
                                $siGlAsistentes = $this->SiGlAsistentes->find('all')
                                ->where(['SiGlAsistentes.id_gl' => $id, 'SiGlAsistentes.status_id' => 1])
                                ->contain(['Persona', 'SiGls', 'MaStatus'])
                                ->order(['Persona.nombres' => 'ASC']);
                                
                                foreach ($siGlAsistentes as $siGlAsistente) {
                                    
                                    $siGlAsistencia = $this->SiGlAsistencias->newEntity();
                                    $siGlAsistencia->id_gl_asistente = $siGlAsistente->id;
                                    $siGlAsistencia->id_gl_tema = $siGlTema->id;
                                    $siGlAsistencia->asistio = false;
                                    $siGlAsistencia->creator_id = $this->Auth->user()['id'];
    
                                    $this->SiGlAsistencias->save($siGlAsistencia);
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
                $siGlTemaExist = $this->SiGlTemas->find('all')->where(['id_gl' => $id, 'id_tema' => $request['id_tema'], 'status_id IN' => [1, 2]])->first();

                if ($siGlTemaExist == '') {
                    $siGlTema = $this->SiGlTemas->newEntity();
                    $siGlTema->id_gl = $id;
                    $siGlTema->id_tema = $request['id_tema'];
                    $siGlTema->fecha = $request['fecha'];
                    $siGlTema->status_id = 1;
                    $siGlTema->creator_id = $this->Auth->user()['id'];

                    if ($this->SiGlTemas->save($siGlTema)) {
                        //Se crea la asistencia del tema creado para los asistentes del Grupo Liderazgo
                        $this->loadModel('SiGlAsistencias');
                        $this->loadModel('SiGlAsistentes');
                        $siGlAsistentes = $this->SiGlAsistentes->find('all')
                        ->where(['SiGlAsistentes.id_gl' => $id, 'SiGlAsistentes.status_id' => 1])
                        ->contain(['Persona', 'SiGls', 'MaStatus'])
                        ->order(['Persona.nombres' => 'ASC']);
                        
                        foreach ($siGlAsistentes as $siGlAsistente) {
                            
                            $siGlAsistencia = $this->SiGlAsistencias->newEntity();
                            $siGlAsistencia->id_gl_asistente = $siGlAsistente->id;
                            $siGlAsistencia->id_gl_tema = $siGlTema->id;
                            $siGlAsistencia->asistio = false;
                            $siGlAsistencia->creator_id = $this->Auth->user()['id'];

                            $this->SiGlAsistencias->save($siGlAsistencia);
                        }
                        $this->Flash->success(__('El tema ha sido Agregado.'), 'success');
                        return $this->redirect(['action' => 'index2', $id]);
                    }
                } else {
                    $this->Flash->error(__('El Tema ya se encuentra asociado al grupo de liderazgo.'), 'success');
                    return $this->redirect(['action' => 'index2', $id]);
                }
            }
        }

        $gl = $this->SiGls->find('all')->where(['id' => $id])->first();

        $this->loadModel('SiTemas');

        $lista1 = $this->SiTemas->find('list', ['id' => 'id', 'valueField' => 'tema'])
            ->where(['tipo_id' => 1174, 'status_id' => 1, 'tema_estandar' => 1])
            ->order(['id' => 'ASC']);

        $this->set(compact('siGlTemas', 'gl', 'id', 'lista1'));
    }

    public function delete2($id, $idGl)
    {
        $this->request->allowMethod(['post', 'delete']);
        $this->loadModel('SiGlTemas');
        $this->loadModel('SiGlAsistencias');
        $siGlTema = $this->SiGlTemas->get($id);
        $idGlTema = $siGlTema->id;
        $siGlAsistencias = $this->SiGlAsistencias->find('all')
        ->where(['id_gl_tema' => $idGlTema]);
        
        foreach ($siGlAsistencias as $asistencia) {
            $this->SiGlAsistencias->delete($asistencia);
        }
        
        if ($this->SiGlTemas->delete($siGlTema)) {
            $this->Flash->success(__('El tema con el id: {0} ha sido eliminado.', h($id)), 'success');
            return $this->redirect(['action' => 'index2', $idGl]);
        }
    }

    public function edit2($id = null, $idGl = null)
    {
        $this->loadModel('SiGlTemas');
        $siGlTema = $this->SiGlTemas->find('all')
        ->where(['id' => $id])->first();
        if ($this->request->is(['post', 'put'])) {
            $siGlTema = $this->SiGlTemas->patchEntity($siGlTema, $this->request->data);

            $siGlTema->modifier_id = $this->Auth->user()['id'];
            if ($this->SiGlTemas->save($siGlTema)) {
                $this->Flash->success(__('El Grupo de liderazgo ha sido Editado.'), 'success');
                return $this->redirect(['action' => 'index2', $idGl]);
            }
            $this->Flash->error(__('No se pudo editar el grupo de liderazgo.'));
        }

        $gl = $this->SiGls->find('all')->where(['id' => $idGl])->first();

        $this->loadModel('SiTemas');
        $this->loadModel('SiLideres');

        $lista1 = $this->SiTemas->find('list', ['id' => 'id', 'valueField' => 'tema'])
            ->where(['tipo_id' => 1174, 'status_id' => 1])
            ->order(['id' => 'ASC']);

        $this->set(compact('siGlTema', 'gl', 'id', 'lista1'));
    }

    /////////////////////////////////////////METODOS PARA SEGUIMIENTOS////////////////////////////////////////////////

    public function asistentes($idGl = null)
    {
        $this->loadModel('SiGlAsistentes');
        $this->loadModel('SiGls');
        $this->loadModel('SiPastores');
        $this->loadModel('Persons');
        $this->loadModel('SiGlTemas');

        $siGlTemasExist = $this->SiGlTemas->find('all')
        ->where(['id_gl' => $idGl, 'status_id' => 1]);

        if (count($siGlTemasExist->toArray()) > 0) {
            $siGlAsistentes = $this->SiGlAsistentes->find('all')
                ->where(['SiGlAsistentes.id_gl' => $idGl, 'SiGlAsistentes.status_id' => 1])
            //->limit(300)
            //->page(1)
                ->contain(['Persona', 'SiGls', 'MaPropiedades', 'MaStatus'])
                ->order(['Persona.nombres' => 'ASC']);

            if ($this->request->is('post')) {
                $request = $this->request->data;

                $siGlAsistenteExist = $this->SiGlAsistentes->find('all')
                ->where(['id_gl' => $idGl, 'id_datos_basicos' => $request['id_datos_basicos'], 'status_id' => 1])->first();

                if ($siGlAsistenteExist == '') {
                    $siGlAsistente = $this->SiGlAsistentes->newEntity();
                    $siGlAsistente->id_datos_basicos = $request['id_datos_basicos'];
                    $siGlAsistente->id_gl = $idGl;
                    $siGlAsistente->id_tipo_asistente = $request['id_tipo_asistente'];
                    $siGlAsistente->status_id = 1;
                    $siGlAsistente->creator_id = $this->Auth->user()['id'];

                    if ($this->SiGlAsistentes->save($siGlAsistente)) {
                        //SE CREA LA ASISTENCIA CON LOS TEMAS ASOCIADOS AL GL PARA EL ASISTENTE CREADO
                        $this->loadModel('SiGlTemas');
                        $this->loadModel('SiGlAsistencias');
                        $siGlTemas = $this->SiGlTemas->find('all')
                            ->where(['SiGlTemas.id_gl' => $idGl, 'SiGlTemas.status_id' => 1]);

                        foreach ($siGlTemas as $siGlTema) {
                            $siGlAsistencia = $this->SiGlAsistencias->newEntity();
                            $siGlAsistencia->id_gl_asistente = $siGlAsistente->id;
                            $siGlAsistencia->id_gl_tema = $siGlTema->id;
                            $siGlAsistencia->asistio = false;
                            $siGlAsistencia->creator_id = $this->Auth->user()['id'];

                            $this->SiGlAsistencias->save($siGlAsistencia);
                        }

                        $this->Flash->success(__('El asistente ha sido Agregado.'), 'success');
                        return $this->redirect(['action' => 'asistentes', $idGl]);
                    }
                } else {
                    $this->Flash->error(__('El asistente ya esta agregado al grupo de liderazgo.'), 'success');
                    return $this->redirect(['action' => 'asistentes', $idGl]);
                }
            }

            $gl = $this->SiGls->find('all')->where(['id' => $idGl])->first();

            $personsdb = $this->Persons->find()->select(['id', 'documento', 'nombres', 'apellidos'])
                ->where(['status_id' => 1])
                ->order(['nombres' => 'ASC']);
            foreach ($personsdb as $person) {
                $lista1[$person['id']] = $person['documento'] . ' | ' . $person['nombres'] . ' ' . $person['apellidos'];
            } //Lista de personas

            $lista4 = $this->properties(1175); //Lista para tipo de asistente

            $this->set(compact('siGlAsistentes', 'gl', 'lista1', 'lista4'));
        } else {
            $this->Flash->error(__('Para agregar asistentes primero debe asociar temas a el grupo de liderazgo.'), 'success');
            return $this->redirect(['action' => 'index']);
        }
    }

    public function delete3($id, $idGl)
    {
        $this->request->allowMethod(['post', 'delete']);
        $this->loadModel('SiGlAsistentes');
        $this->loadModel('SiGlAsistencias');
        $asistencias = $this->SiGlAsistencias->find('all')
        ->where(['id_gl_asistente' => $id]);

        foreach ($asistencias as $asistencia) {
            $this->SiGlAsistencias->delete($asistencia);
        }

        $siGlAsistente = $this->SiGlAsistentes->get($id);
        if ($this->SiGlAsistentes->delete($siGlAsistente)) {
            $this->Flash->success(__('El asistente con el id: {0} ha sido eliminado.', h($id)), 'success');
            return $this->redirect(['action' => 'asistentes', $idGl]);
        }
    }

    public function asistencia($idGl = null)
    {

        $this->loadModel('SiGlAsistencias');
        $this->loadModel('SiGlAsistentes');
        $this->loadModel('SiGlTemas');

        $siGlAsistentes = $this->SiGlAsistentes->find('all')
            ->select(['SiGlAsistentes.id', 'Persona.id', 'Persona.nombres', 'Persona.apellidos', 'Persona.documento'])
            ->where(['SiGlAsistentes.id_gl' => $idGl, 'SiGlAsistentes.status_id' => 1])
            ->contain(['Persona']);

        if (count($siGlAsistentes->toArray()) > 0) {
            $siGlAsistencias = $this->SiGlAsistencias->find('all')
                ->where(['SiGlAsistentes.id_gl' => $idGl])
            //->limit(300)
            //->page(1)
                ->contain(['SiGlAsistentes', 'SiGlTemas.SiTemas'])
                ->order(['SiGlAsistencias.id' => 'ASC']);

            //$this->pr($siGlAsistentesExist); die;

            $gl = $this->SiGls->find('all')->where(['id' => $idGl])->first();
            $temas = $this->SiGlTemas->find('all')
                ->select(['SiTemas.tema', 'SiGlTemas.fecha'])
                ->where(['id_gl' => $idGl, 'SiGlTemas.status_id' => 1])
                ->contain(['SiTemas']);

            $this->set(compact('siGlAsistencias', 'siGlAsistentes', 'gl', 'temas'));
        } else {
            $this->Flash->error(__('Para gestionar la asistencia primero debe asociar asistentes al grupo de liderazgo.'), 'success');
            return $this->redirect(['action' => 'index']);
        }
    }

    public function datosbasicos()
    {
        $this->loadModel('Persons');
        $this->viewBuilder()->layout();
        $persona = $this->Persons->find('all')
        ->select(['MaPropiedades.valor', 'Persons.documento', 'Persons.nombres', 'Persons.apellidos',
            'Persons.direccion', 'Persons.email', 'Persons.telefono1', 'Persons.celular',
            'Persons.fotografia', 'Persons.status_id'])
            ->where(['Persons.id' => $this->request->data['id']])
            ->contain(['MaPropiedades'])->first();

        $this->set(compact('persona'));
    }

    public function addasistencia()
    {
        $this->request->allowMethod(['post', 'addasistencia']);
        $this->loadModel('SiGlAsistencias');
        $siGlAsistencias = $this->SiGlAsistencias->get($this->request->data['id']);
        $siGlAsistencias->asistio = $this->request->data['asistio'];

        if ($this->SiGlAsistencias->save($siGlAsistencias)) {
            $this->Flash->success(__('La aistencia con el id: {0} ha sido guardada.', h($id)), 'success');
            return $this->redirect(['action' => 'asistencia', $this->request->data['id']]);
        }
    }
}
