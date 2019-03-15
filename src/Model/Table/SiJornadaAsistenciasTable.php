<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class SiJornadaAsistenciasTable extends Table {

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('si_jornada_asistencias');

        $this->addBehavior('Timestamp');

        $this->belongsTo('SiJornadaAsistentes', [
            'foreignKey' => 'id_jornada_asistente'
        ]);

        $this->belongsTo('SiJornadaTemas', [
            'foreignKey' => 'id_jornada_tema'
        ]);
    }

}
