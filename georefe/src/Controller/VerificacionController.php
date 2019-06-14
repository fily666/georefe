<?php

namespace App\Controller;

use Cake\Event\Event;

class VerificacionController extends AppController
{

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['datosbasicos']);
    }

    public function index()
    {
        $this->loadModel('SiVeriEntregas');
        $this->loadModel('Users');
        $this->loadModel('SiLideres');
        $rol = $this->Auth->user()['group_id'];
        if ($rol == 1) {
            $siverientregas = $this->SiVeriEntregas->find('all')
            ->where(['SiVeriEntregas.status_id IN' => [1, 2]])
            //->limit(300)
            //->page(1)
            ->contain(['Persona', 'LiderAsignado.Persons', 'Guia', 'Pastor.Persons', 'EstadoLlamada'])
            ->order(['SiVeriEntregas.id' => 'DESC']);
        } else {
            $user = $this->Users->find('all')->select(['person_id'])
                ->where(['id' => $this->Auth->user()['id']])->first();
            $lider = $this->SiLideres->find('all')->select(['id'])
                ->where(['id_datos_basicos' => $user->person_id, 'id_nivel' => 1179])->first();
            if($lider){
                $siverientregas = $this->SiVeriEntregas->find('all')
                ->where(['SiVeriEntregas.status_id IN' => [1, 2],
                'SiVeriEntregas.id_lider_consolida' => $lider->id])
                ->contain(['Persona', 'LiderAsignado.Persons', 'Pastor.Persons', 'EstadoLlamada'])
                ->order(['SiVeriEntregas.id' => 'DESC']);
            }else{
                $siverientregas = $this->SiVeriEntregas->newEntity();
                $this->Flash->error(__('No esta registrado como lider de consolidacion, contacte al Administrador'));
            }
        }    
        $this->set(compact('siverientregas'));
    }

    public function add()
    {
        //Carga de entidades a usar
        $this->loadModel('SiVeriEntregas');
        $this->loadModel('Persons');
        $this->loadModel('SiLideres');
        $this->loadModel('SiPastores');
        $this->loadModel('MaPropiedades');
        //Objeto a llenar
        $verificacion = $this->SiVeriEntregas->newEntity();

        //POST que guarda la información agregada al formulario
        if ($this->request->is('post')) {
            $verificacion = $this->SiVeriEntregas->patchEntity($verificacion, $this->request->data);

            $verificaciondb = $this->SiVeriEntregas->find('all')->select(['Persona.documento'])
                ->where(['SiVeriEntregas.id_datos_basicos' => $this->request->data['id_datos_basicos'], 'SiVeriEntregas.status_id' => 1])
                ->contain(['Persona'])
                ->toArray();

            if (count($verificaciondb) > 0) {
                $this->Flash->error(__('La persona con documento ' . $verificaciondb[0]['Persona']['documento'] . ', ya tiene una verificación'));
            } else {
                $verificacion->id_estado_llamada = 251;
                $verificacion->status_id = 1;
                $verificacion->creator_id = $this->Auth->user()['id'];

                if ($this->SiVeriEntregas->save($verificacion)) {
                    $this->addEncuesta($verificacion);
                    $this->Flash->success(__('La verificación ha sido agregada.'), 'success');
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('No se pudo agregar la verificación.'));
            }
        }

        //Listas que se presentan en el formulario
        $lista1[] = array();
        unset($lista1[0]);
        $lista3[] = array();
        unset($lista3[0]);
        $lista4[] = array();
        unset($lista4[0]);
        $lista5[] = array();
        unset($lista5[0]);
        $lista9[] = array();

        $personsdb = $this->Persons->find()->select(['id', 'documento', 'nombres', 'apellidos'])
            ->where(['status_id' => 1])
            ->order(['nombres' => 'ASC']);
        foreach ($personsdb as $person) {
            $lista1[$person['id']] = $person['documento'] . ' | ' . $person['nombres'] . ' ' . $person['apellidos'];
        } //Lista de personas a verificar
        
        $lideresgt = $this->SiLideres->find()->select(['SiLideres.id', 'Persons.documento', 'Persons.nombres', 'Persons.apellidos'])
            ->where(['SiLideres.id_nivel' => 207, 'SiLideres.status_id' => 1])
            ->contain(['Persons'])
            ->order(['Persons.nombres' => 'ASC']);

        foreach ($lideresgt as $lidergt) {
            $lista2[$lidergt['id']] = $lidergt['person']['documento'] . ' | ' . $lidergt['person']['nombres'] . ' ' . $lidergt['person']['apellidos'];
        } //Lista para Lideres de GT

        $lideresdb = $this->SiLideres->find()->select(['SiLideres.id', 'Persons.documento', 'Persons.nombres', 'Persons.apellidos'])
            ->where(['SiLideres.id_nivel' => 209, 'SiLideres.status_id' => 1])
            ->contain(['Persons'])
            ->order(['Persons.nombres' => 'ASC']);

        foreach ($lideresdb as $lider) {
            $lista3[$lider['id']] = $lider['person']['documento'] . ' | ' . $lider['person']['nombres'] . ' ' . $lider['person']['apellidos'];
        } //Lista para Lideres de acompañamiento

        $pastoresdb = $this->SiPastores->find()->select(['SiPastores.id', 'Persons.documento', 'Persons.nombres', 'Persons.apellidos'])
            ->where(['SiPastores.status_id' => 1])
            ->contain(['Persons'])
            ->order(['Persons.nombres' => 'ASC']);

        foreach ($pastoresdb as $pastor) {
            $lista4[$pastor['id']] = $pastor['person']['documento'] . ' | ' . $pastor['person']['nombres'] . ' ' . $pastor['person']['apellidos'];
        } //Lista para pastores

        $liderconsolida = $this->SiLideres->find()->select(['SiLideres.id', 'Persons.documento', 'Persons.nombres', 'Persons.apellidos'])
            ->where(['SiLideres.id_nivel' => 1179, 'SiLideres.status_id' => 1])
            ->contain(['Persons'])
            ->order(['Persons.nombres' => 'ASC']);

        foreach ($liderconsolida as $liderco) {
            $lista5[$liderco['id']] = $liderco['person']['documento'] . ' | ' . $liderco['person']['nombres'] . ' ' . $liderco['person']['apellidos'];
        } //Lista para lideres de consolidación

        $lista6 = $lista1; //Lista para quien lo invito
        $lista7 = $this->properties(219); //Lista para tipo de entrega
        $lista8 = $this->properties(223); //Lista para fase de la entrega    
        
        //Parametros que se envian a la vista
        $this->set(compact('verificacion', 'lista1', 'lista2', 'lista3', 'lista4', 'lista5', 'lista6', 'lista7', 'lista8'));
    }

    private function addEncuesta($verificacion)
    {
        $this->loadModel('SiVeriEncuestas');
        //Objeto a llenar de encuetas
        $encuesta = $this->SiVeriEncuestas->newEntity();
        $encuesta->id_veri_entrega = $verificacion->id;
        $encuesta->id_resultado_llamada = 251;
        $encuesta->status_id = 1;
        $encuesta->creator_id = $this->Auth->user()['id'];
        $this->SiVeriEncuestas->save($encuesta);
    }

    public function edit($id = null)
    {
        //Carga de entidades a usar
        $this->loadModel('SiVeriEntregas');
        $this->loadModel('Persons');
        $this->loadModel('SiLideres');
        $this->loadModel('SiPastores');
        $verificacion = $this->SiVeriEntregas->find('all')->where(['id' => $id])->first();

        if ($this->request->is(['post', 'put'])) {
            $verificacion = $this->SiVeriEntregas->patchEntity($verificacion, $this->request->data);

            $verificacion->modifier_id = $this->Auth->user()['id'];
            if ($this->SiVeriEntregas->save($verificacion)) {
                $this->Flash->success(__('La verificación ha sido editada.'), 'success');
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo editar la verificación.'));
        }

        //Listas que se presentan en el formulario

        $personsdb = $this->Persons->find()->select(['id', 'documento', 'nombres', 'apellidos'])
            ->where(['status_id' => 1])
            ->order(['nombres' => 'ASC']);
        foreach ($personsdb as $person) {
            $lista1[$person['id']] = $person['documento'] . ' | ' . $person['nombres'] . ' ' . $person['apellidos'];
        } //Lista de personas a verificar

        $lideresgt = $this->SiLideres->find()->select(['SiLideres.id', 'Persons.documento', 'Persons.nombres', 'Persons.apellidos'])
            ->where(['SiLideres.id_nivel' => 207, 'SiLideres.status_id' => 1])
            ->contain(['Persons'])
            ->order(['Persons.nombres' => 'ASC']);

        foreach ($lideresgt as $lidergt) {
            $lista2[$lidergt['id']] = $lidergt['person']['documento'] . ' | ' . $lidergt['person']['nombres'] . ' ' . $lidergt['person']['apellidos'];
        } //Lista para Lideres de GT

        $lideresdb = $this->SiLideres->find()->select(['SiLideres.id', 'Persons.documento', 'Persons.nombres', 'Persons.apellidos'])
            ->where(['SiLideres.id_nivel' => 209, 'SiLideres.status_id' => 1])
            ->contain(['Persons'])
            ->order(['Persons.nombres' => 'ASC']);

        foreach ($lideresdb as $lider) {
            $lista3[$lider['id']] = $lider['person']['documento'] . ' | ' . $lider['person']['nombres'] . ' ' . $lider['person']['apellidos'];
        } //Lista para Lideres de acompañamiento

        $pastoresdb = $this->SiPastores->find()->select(['SiPastores.id', 'Persons.documento', 'Persons.nombres', 'Persons.apellidos'])
            ->where(['SiPastores.status_id' => 1])
            ->contain(['Persons'])
            ->order(['Persons.nombres' => 'ASC']);

        foreach ($pastoresdb as $pastor) {
            $lista4[$pastor['id']] = $pastor['person']['documento'] . ' | ' . $pastor['person']['nombres'] . ' ' . $pastor['person']['apellidos'];
        } //Lista para pastores

        $liderconsolida = $this->SiLideres->find()->select(['SiLideres.id', 'Persons.documento', 'Persons.nombres', 'Persons.apellidos'])
            ->where(['SiLideres.id_nivel' => 1179, 'SiLideres.status_id' => 1])
            ->contain(['Persons'])
            ->order(['Persons.nombres' => 'ASC']);

        foreach ($liderconsolida as $liderco) {
            $lista5[$liderco['id']] = $liderco['person']['documento'] . ' | ' . $liderco['person']['nombres'] . ' ' . $liderco['person']['apellidos'];
        } //Lista para encargados de llamada

        $lista6 = $lista1; //Lista para quien lo invito
        $lista7 = $this->properties(219); //Lista para tipo de entrega
        $lista8 = $this->properties(223); //Lista para fase de la entrega

        //Parametros que se envian a la vista
        $this->set(compact('verificacion', 'lista1', 'lista2', 'lista3', 'lista4', 'lista5', 'lista6', 'lista7', 'lista8'));
    }

    public function delete($id)
    {
        $this->loadModel('SiVeriEntregas');
        $this->request->allowMethod(['post', 'delete']);
        $verificacion = $this->SiVeriEntregas->get($id);
        $verificacion->status_id = 3;
        if ($this->SiVeriEntregas->save($verificacion)) {

            //SE ELIMINA LA ENCUESTAS ASOCIADA A LA VERIFICACIÓN
            $this->loadModel('SiVeriEncuestas');
            $encuesta = $this->SiVeriEncuestas->find('all')->where(['id_veri_entrega' => $id])->first();
            $encuesta->status_id = 3;
            $this->SiVeriEncuestas->save($encuesta);

            $this->Flash->success(__('La verificación con el id: {0} ha sido eliminado.', h($id)), 'success');
            return $this->redirect(['action' => 'index']);
        }
    }

    public function datosbasicos()
    {
        $this->loadModel('Persons');
        $this->viewBuilder()->layout();
        $persona = $this->Persons->find('all')->select(['MaPropiedades.valor','Barrio.valor', 'Persons.documento', 'Persons.nombres', 'Persons.apellidos',
            'Persons.direccion', 'Persons.email', 'Persons.telefono1', 'Persons.celular',
            'Persons.fotografia', 'Persons.status_id', 'Persons.edad'])
            ->where(['Persons.id' => $this->request->data['id']])
            ->contain(['MaPropiedades','Barrio'])->first();

        $this->set(compact('persona'));
    }

    public function resultadollamada()
    {
        $this->loadModel('SiVeriEncuestas');
        $this->loadModel('Persons');
        $this->viewBuilder()->layout();
        $encuesta = $this->SiVeriEncuestas->find('all')
            ->select(['Entrega.id_datos_basicos', 'MedioInfoSM.valor', 'ResultadoLlamada.valor', 'Prioridad.valor', 'FaseConsolidacion.valor', 'SiVeriEncuestas.observacion'])
            ->where(['SiVeriEncuestas.id_veri_entrega' => $this->request->data['id']])
            ->contain(['MedioInfoSM', 'ResultadoLlamada', 'Prioridad', 'FaseConsolidacion', 'Entrega'])->first();

        $persona = ($encuesta != '') ? $this->Persons->find('all')->select(['nombres', 'apellidos'])->where(['id' => $encuesta->entrega->id_datos_basicos])->first() : '';

        $this->set(compact('encuesta', 'persona'));
    }

}
