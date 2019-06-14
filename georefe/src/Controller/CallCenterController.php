<?php

namespace App\Controller;

use Cake\Event\Event;

class CallCenterController extends AppController {

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow(['datosbasicos', 'guardarencuesta']);
    }

    public function index() {
        $this->loadModel('SiVeriEncuestas');
        $this->loadModel('SiLideres');
        $this->loadModel('Users');

        if($this->Auth->user()['group_id'] == 1){
        $encuestas = $this->SiVeriEncuestas->find('all')                
                ->where(['SiVeriEncuestas.status_id IN' => [1, 2]])
                //->limit(300)
                //->page(1)                
                ->contain(['Entrega', 'Entrega.Persona', 'Entrega.LiderLlamada.Persons', 'Entrega.EstadoLlamada'])
                ->order(['SiVeriEncuestas.id' => 'DESC']);
        }else{
            $user = $this->Users->find('all')->select(['person_id'])
                ->where(['id' => $this->Auth->user()['id']])->first();
            $lider = $this->SiLideres->find()->select(['id'])
            ->where(['SiLideres.id_nivel' => 207,
            'SiLideres.status_id' => 1,
            'SiLideres.id_datos_basicos' => $user->person_id])->first();
            if($lider){
                $encuestas = $this->SiVeriEncuestas->find('all')              
                ->where(['SiVeriEncuestas.status_id IN' => [1, 2],
                'LiderLlamada.id' => $lider->id])
                //->limit(300)
                //->page(1)                
                ->contain(['Entrega', 'Entrega.Persona', 'Entrega.LiderLlamada.Persons', 'Entrega.EstadoLlamada'])
                ->order(['SiVeriEncuestas.id' => 'DESC']);
            }else{
                $encuestas = $this->SiVeriEncuestas->newEntity();
            }
        }        

        $this->set(compact('encuestas'));
    }

    public function datosbasicos() {
        $this->loadModel('Persons');
        $this->viewBuilder()->layout();
        $persona = $this->Persons->find('all')->select(['MaPropiedades.valor','Barrio.valor', 'Persons.documento', 'Persons.nombres', 'Persons.apellidos',
        'Persons.direccion', 'Persons.email', 'Persons.telefono1', 'Persons.celular',
        'Persons.fotografia', 'Persons.status_id', 'Persons.edad'])
        ->where(['Persons.id' => $this->request->data['id']])
        ->contain(['MaPropiedades','Barrio'])->first();

        $this->set(compact('persona'));
    }

    public function encuesta($id = null) {
        $this->loadModel('SiVeriEncuestas');        
        $this->loadModel('Persons');
        $this->viewBuilder()->layout();        

        $encuesta = $this->SiVeriEncuestas->find('all')
                        ->select(['SiVeriEncuestas.id', 'Entrega.id', 'Entrega.id_datos_basicos', 'MedioInfoSM.id', 'MedioInfoSM.valor', 'ResultadoLlamada.id', 'ResultadoLlamada.id',
                         'ResultadoLlamada.valor', 'Prioridad.id', 'Prioridad.valor', 'FaseConsolidacion.id', 'FaseConsolidacion.valor', 'SiVeriEncuestas.observacion'])
                        ->where(['SiVeriEncuestas.id' => $id])
                        ->contain(['MedioInfoSM', 'ResultadoLlamada', 'Prioridad', 'FaseConsolidacion', 'Entrega'])->first();

        $persona = ($encuesta != '') ? $this->Persons->find('all')->select(['nombres', 'apellidos'])->where(['id' => $encuesta->entrega->id_datos_basicos])->first() : '';
              
        if ($this->request->is('post')) {
            $request = $this->request->data;

            $encuesta->id_medio_info_sm = $request['id_medio_info_sm']; 
            $encuesta->id_resultado_llamada = $request['id_resultado_llamada']; 
            $encuesta->id_prioridad = $request['id_prioridad']; 
            $encuesta->id_fase_consolidacion = $request['id_fase_consolidacion']; 
            $encuesta->observacion = $request['observacion'];             
            $encuesta->modifier_id = $this->Auth->user()['id'];

            if ($this->SiVeriEncuestas->save($encuesta)) {

                $this->loadModel('SiVeriEntregas');
                $verificacion = $this->SiVeriEntregas->find('all')->where(['id' => $encuesta->entrega->id])->first();
                $verificacion->id_estado_llamada = $encuesta->id_resultado_llamada;
                $this->SiVeriEntregas->save($verificacion);                      

                $this->Flash->success(__('La encueta ha sido guardada.'), 'success');
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo agregar la encueta.'));
        }

        $lista1 = $this->properties(253); //Lista para A través de que medio obtuvo información 
        $lista2 = $this->properties(248); //Lista para Resultado Llamada 
        $lista3 = $this->properties(277); //Lista para Prioridad 
        $lista4 = $this->properties(281); //Lista para Fase de Consolidación

        $this->set(compact('encuesta', 'persona', 'lista1', 'lista2', 'lista3', 'lista4'));
    }

    

}
