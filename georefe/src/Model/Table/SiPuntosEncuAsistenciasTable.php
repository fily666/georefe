<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class SiPuntosEncuAsistenciasTable extends Table {

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('si_puntos_encu_asistencias');

        $this->addBehavior('Timestamp');

        $this->belongsTo('SiPuntosEncuAsistentes', [
            'foreignKey' => 'id_puntencu_asistente'
        ]);

        $this->belongsTo('SiPuntosEncuentroTemas', [
            'foreignKey' => 'id_puntencu_tema'
        ]);
    }

}
