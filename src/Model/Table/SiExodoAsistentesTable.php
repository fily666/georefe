<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class SiExodoAsistentesTable extends Table {

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('si_exodo_asistentes');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Persona', [
            'className' => 'Persons',
            'foreignKey' => 'id_datos_basicos'
        ]);

        $this->belongsTo('SiExodos', [
            'foreignKey' => 'id_exodo'
        ]);

        $this->belongsTo('Guia', [
            'className' => 'Persons',
            'foreignKey' => 'id_guia'
        ]);

        $this->belongsTo('SiPastores', [
            'foreignKey' => 'id_pastor'
        ]);  

        $this->belongsTo('MaPropiedades', [
            'foreignKey' => 'id_tipo_asistente'
        ]);

        $this->belongsTo('MaStatus', [
            'foreignKey' => 'status_id'
        ]);
    }

}
