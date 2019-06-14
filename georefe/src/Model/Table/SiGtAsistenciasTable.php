<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class SiGtAsistenciasTable extends Table {

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('si_gt_asistencias');

        $this->addBehavior('Timestamp');

        $this->belongsTo('SiGtAsistentes', [
            'foreignKey' => 'id_gt_asistente'
        ]);

        $this->belongsTo('SiGtTemas', [
            'foreignKey' => 'id_gt_tema'
        ]);
    }

}
