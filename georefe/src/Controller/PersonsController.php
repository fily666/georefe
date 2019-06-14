<?php

namespace App\Controller;

use Cake\Event\Event;

class PersonsController extends AppController {

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow(['datosbasicos']);
    }

    public function index() {
        $persons = $this->Persons->find('all')->select(['Persons.id', 'MaPropiedades.valor', 'Persons.documento', 'Persons.nombres', 'Persons.apellidos',
                    'Persons.fotografia', 'Persons.status_id', 'MaStatus.value'])
                ->where(['Persons.status_id IN' => [1, 2]])
                //->limit(300)
                //->page(1)                
                ->contain(['MaPropiedades', 'MaStatus'])
                ->order(['Persons.id' => 'DESC']);
        $this->set(compact('persons'));
    }

    public function add() {
        $this->loadModel('MaPropiedades');
        $person = $this->Persons->newEntity();
        if ($this->request->is('post')) {
            $person = $this->Persons->patchEntity($person, $this->request->data);

            $personDocument = $this->Persons->find('all')->where(['documento' => $person->documento, 'status_id' => 1])->toArray();

            if (count($personDocument) > 0) {
                $this->Flash->error(__('La persona con documento ' . $person->documento . ', ya existe en el sistema'));
            } else {
                //////////////////Fotografia////////////
                //echo "########## el barrio ##########  $person->id_barrio";
                if (!empty($this->request->data['fotografia']['tmp_name'])) {
                    $file = $this->request->data['fotografia'];
                    $newName = date("YmdHmsu") . preg_replace('/[^ A-Za-z0-9_.-]/', '_', utf8_encode($file['name']));
                    $newLink = '/attachments/users/';
                    move_uploaded_file($file['tmp_name'], WWW_ROOT . $newLink . $newName);
                    $person->fotografia = $newName;
                } else {
                    $person->fotografia = 'default.png';
                }
                ///////////////////////////

                $person->status_id = 1;
                $person->creator_id = $this->Auth->user()['id'];
                if ($this->Persons->save($person)) {
                    $this->Flash->success(__('La persona ha sido agregada.'), 'success');
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('No se pudo agregar la persona.'));
            }
        }
        $doctypes = $this->properties(1); //Lista para tipos de documentos
        $genders = $this->properties(14); //Lista para generos 
        $localidadesbog = $this->properties(350); //Lista de Localidades para Bogota
        $barrios = array();
        foreach ($localidadesbog as $localidad => $id) {
            //echo "########## ID DE LOCALIDAD ##########  $localidad";
            $listabarrios = $this->propertiesOrderbyValue($localidad);
            
            foreach ($listabarrios as $barrio) {
                $barrios[] = $barrio;
            }
            $listabarrios[] = array();
        }
        
        $this->set(compact('person', 'doctypes', 'genders','barrios'));
    }

    public function edit($id = null) {
        $person = $this->Persons->find('all')->where(['id' => $id])->first();

        if ($this->request->is(['post', 'put'])) {
            $person = $this->Persons->patchEntity($person, $this->request->data);

            //////////////////Fotografia////////////
            if (!empty($this->request->data['fotografia']['tmp_name'])) {
                $file = $this->request->data['fotografia'];
                $newName = date("YmdHmsu") . preg_replace('/[^ A-Za-z0-9_.-]/', '_', utf8_encode($file['name']));
                $newLink = '/attachments/users/';
                move_uploaded_file($file['tmp_name'], WWW_ROOT . $newLink . $newName);
                $person->fotografia = $newName;
            } else {
                $persondb = $this->Persons->get($id);
                $person->fotografia = $persondb->fotografia;
            }
            ///////////////////////////  

            $person->modifier_id = $this->Auth->user()['id'];

            if ($this->Persons->save($person)) {
                $this->Flash->success(__('El personal ha sido editado.'), 'success');
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo editar la persona.'));
        }
        $doctypes = $this->properties(1); //Lista para tipos de documentos        
        $localidadesbog = $this->properties(350); //Lista de Localidades para Bogota
        $barrios = array();
        foreach ($localidadesbog as $localidad => $id) {
            //echo "########## ID DE LOCALIDAD ##########  $localidad";
            $listabarrios = $this->propertiesOrderbyValue($localidad);
            
            foreach ($listabarrios as $barrio) {
                $barrios[] = $barrio;
            }
            $listabarrios[] = array();
        }
        $this->set(compact('person', 'doctypes','barrios'));
    }

    public function add2($id = null) {
        $this->loadModel('SiDatosComplementarios');
        $datosComplementarios = $this->SiDatosComplementarios->find('all')->where(['id_datos_basicos' => $id])->first();
        $persona = $this->Persons->find('all')->where(['id' => $id])->first();

        if ($datosComplementarios == '') {
            $datosComplementarios = $this->SiDatosComplementarios->newEntity();
        }

        if ($this->request->is(['post', 'put'])) {
            $datosComplementarios = $this->SiDatosComplementarios->patchEntity($datosComplementarios, $this->request->data);
            $datosComplementarios->id_datos_basicos = $id;
            $datosComplementarios->status_id = 1;
            $datosComplementarios->creator_id = $this->Auth->user()['id'];

            if ($datosComplementarios->id_estado_civil != 9) {
                $datosComplementarios->nombre_conyugue = null;
                $datosComplementarios->id_tipo_doc_conyugue = null;
                $datosComplementarios->documento_conyugue = null;
            }


            if ($this->SiDatosComplementarios->save($datosComplementarios)) {
                $this->Flash->success(__('Datos complementarios guardados.'), 'success');
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Error grabando los datos complementarios.'));
        }
        $lista1 = $this->properties(8); //Lista para estado civil
        $lista2 = $this->properties(14); //Lista para generos 
        $lista3 = $this->properties(1); //Lista para tipo documentos conyue 
        $lista4 = $this->properties(17); //Lista para Nivel de estudio
        $lista5 = $this->properties(23); //Lista para profesiones
        $lista6 = $this->properties(148); //Lista para ejerce profesión
        $lista7 = $this->properties(151); //Lista para Ministerios

        $this->set(compact('datosComplementarios', 'persona', 'lista1', 'lista2', 'lista3', 'lista4', 'lista5', 'lista6', 'lista7'));
    }

    public function add3($id = null) {
        $this->loadModel('SiParientes');
        $parientes = $this->SiParientes->find('all')->where(['id_datos_basicos' => $id, 'SiParientes.status_id IN' => [1, 2]])->contain(['Pariente', 'MaPropiedades'])->toArray();
         $persona = $this->Persons->find('all')->where(['id' => $id])->first();
         
        //pr($parientes); die;

        if ($this->request->is(['post', 'put'])) {
            $pariente = $this->SiParientes->newEntity();
            $request = $this->request->data;

            $person = $this->Persons->find('all')->where(['documento' => $request['documento']])->first();

            if (count($person) == 0) {
                $this->Flash->error(__('La persona con documento ' . $request['documento'] . ', no existe en el sistema, debe crearlo.'));
            } else {
                $pariente->id_datos_basicos = $id;
                $pariente->id_datos_basicos_pariente = $person->id;
                $pariente->id_tipo_relacion = $request['id_parentesco'];
                $pariente->status_id = 1;
                $pariente->creator_id = $this->Auth->user()['id'];

                if ($this->SiParientes->save($pariente)) {
                    $this->Flash->success(__('Pariente guardado.'), 'success');
                    return $this->redirect(['action' => 'add3', $id]);
                }
                $this->Flash->error(__('Error guardando pariente.'));
            }
        }
        $lista1 = $this->properties(159); //Lista para tipos de parientes

        $this->set(compact('parientes', 'persona', 'lista1'));
    }

    public function delete($id) {
        $this->request->allowMethod(['post', 'delete']);
        $person = $this->Persons->get($id);
        $person->status_id = 3;
        if ($this->Persons->save($person)) {
            $this->Flash->success(__('La persona con el id: {0} ha sido eliminado.', h($id)), 'success');
            return $this->redirect(['action' => 'index']);
        }
    }

    public function deletepariente($id, $idpersona) {
        $this->loadModel('SiParientes');
        $this->request->allowMethod(['post', 'delete']);
        $pariente = $this->SiParientes->get($id);
        if ($this->SiParientes->delete($pariente)) {
            $this->Flash->success(__('El pariente con el id: {0} ha sido eliminado.', h($id)), 'success');
            return $this->redirect(['action' => 'add3', $idpersona]);
        }
    }

    public function inactivity($id) {
        $this->request->allowMethod(['post', 'inactivity']);
        $person = $this->Persons->get($id);
        $person->status_id = 0;
        if ($this->Persons->save($person)) {
            $this->Flash->success(__('El personal con el id: {0} ha sido inactivado.', h($id)), 'success');
            return $this->redirect(['action' => 'index']);
        }
    }

    public function activity($id) {
        $this->request->allowMethod(['post', 'activity']);
        $person = $this->Persons->get($id);
        $person->status_id = 1;
        if ($this->Persons->save($person)) {
            $this->Flash->success(__('El personal con el id: {0} ha sido activado.', h($id)), 'success');
            return $this->redirect(['action' => 'index']);
        }
    }

    public function datosbasicos() {
        $this->viewBuilder()->layout();
        $persona = $this->Persons->find('all')->select(['MaPropiedades.valor','Barrio.valor', 'Persons.documento', 'Persons.nombres', 'Persons.apellidos',
                            'Persons.direccion', 'Persons.email', 'Persons.telefono1', 'Persons.celular',
                            'Persons.fotografia', 'Persons.status_id','Persons.edad'])
                        ->where(['Persons.id' => $this->request->data['id']])
                        ->contain(['MaPropiedades','Barrio'])->first();

        $this->set(compact('persona'));
    }

}
