<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class SiJornadaAsistentesTable extends Table {

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('si_jornada_asistentes');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Persona', [
            'className' => 'Persons',
            'foreignKey' => 'id_datos_basicos'
        ]);

        $this->belongsTo('SiJornadas', [
            'foreignKey' => 'id_jornada'
        ]);

        $this->belongsTo('Guia', [
            'className' => 'Persons',
            'foreignKey' => 'id_guia'
        ]);

        $this->belongsTo('SiPastores', [
            'foreignKey' => 'id_pastor'
        ]);  
        
        $this->belongsTo('Tutor', [
            'className' => 'Persons',
            'foreignKey' => 'id_tutor_pena'
        ]);       
        	

        $this->belongsTo('MaPropiedades', [
            'foreignKey' => 'id_tipo_asistente'
        ]);

        $this->belongsTo('MaStatus', [
            'foreignKey' => 'status_id'
        ]);
    }

}
