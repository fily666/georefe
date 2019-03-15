<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class MapaController extends AppController {
    public function beforeFilter(Event $event) {
        $this->Auth->allow(['pinta','index','index1']);
    }
    public function index() {
        $this->loadModel('Si_gts');
        $this->loadModel('SiDatosBasicos');

        $direcciones = $this->Si_gts->find('all')->contain(['Ciudad','Localidad'])->toArray();
        
        
        $persona = $this->SiDatosBasicos->find('all')->toArray();
        $contador = count($direcciones);
        
       foreach($persona as $value){
        $direcciones[$contador] = $value;
        
        $contador++;
       }
        
       
        $direccion = json_encode($direcciones);
        
       
        $this->set(compact('direccion')); 
    
    }


    public function pinta($id = null) {
        
        
        $a =$this->request->data['dato'];
        $explode = explode("/", $a);
        if($explode[3] == "Si_gts"){
            $this->loadModel('Si_gts');
            $mapa = $this->Si_gts->find('all')->where(['id' => $explode[0]])->first();
            $mapa = $this->Si_gts->patchEntity($mapa, $this->request->data);
            $mapa['map_lat']= $explode[1];
            $mapa['map_lng']= $explode[2];

            if ($this->Si_gts->save($mapa)) {
                /*$this->Flash->success(__(''), 'success'); */
                return $this->redirect(['action' => 'index']);
            }
        }else{
            $this->loadModel('SiDatosBasicos');
            $mapa = $this->SiDatosBasicos->find('all')->where(['id' => $explode[0]])->first();
            @$mapa = $this->SiDatosBasicos->patchEntity($mapa, $this->request->data);
            $mapa['map_latitud']= $explode[1];
            $mapa['map_longitud']= $explode[2];
            
            if ($this->SiDatosBasicos->save($mapa)) {
                //pr($mapa);
                //die; 
                return $this->redirect(['action' => 'index']);
            }//$this->pr($mapa->errors());die;
        }
          
            
            

        
           
    }


    public function index1() {
        $this->loadModel('Si_gts');
        $direcciones = $this->Si_gts->find('all')->contain(['Ciudad','Localidad'])->toArray();
        foreach($direcciones as $key => $value){
            
            
            $direccionesr[$key]['punto']['coordinates'] = $value['map_lng'] .",".$value['map_lat']/*." ".$value['localidad']['valor'] */;
            $direccionesr[$key]['nombre_sede']=$value['direccion'] ." ".$value['ciudad']['valor'];
            $direccionesr[$key]['map_lat'] = $value['map_lat'];
            $direccionesr[$key]['map_lng'] = $value['map_lng'];
            $direccionesr[$key]['id'] = $value['id'];

        } 
        //$direccion = json_encode($direccionesr);

        $response = json_encode($direccionesr); 
        $this->response->type('json');
        $this->response->body($response);
        return $this->response; 
       
        $this->set(compact('direccion')); 
    
    }
}