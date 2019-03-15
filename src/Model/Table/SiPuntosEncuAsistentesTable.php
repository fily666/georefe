<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class SiPuntosEncuAsistentesTable extends Table {

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('si_puntos_encu_asistentes');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Persona', [
            'className' => 'Persons',
            'foreignKey' => 'id_datos_basicos'
        ]);

        $this->belongsTo('SiPuntoEncuentros', [
            'foreignKey' => 'id_punto_encuentro'
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
