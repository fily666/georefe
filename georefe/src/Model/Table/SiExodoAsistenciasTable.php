<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class SiExodoAsistenciasTable extends Table {

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('si_exodo_asistencias');

        $this->addBehavior('Timestamp');

        $this->belongsTo('SiExodoAsistentes', [
            'foreignKey' => 'id_exodo_asistente'
        ]);

        $this->belongsTo('SiExodoTemas', [
            'foreignKey' => 'id_exodo_tema'
        ]);
    }

}
