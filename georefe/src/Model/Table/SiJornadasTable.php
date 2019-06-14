<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class SiJornadasTable extends Table {

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('si_jornadas');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Coordinador', [
            'className' => 'SiLideres',
            'foreignKey' => 'id_coordinador_exd'
        ]);

        $this->belongsTo('MaPropiedades', [
            'foreignKey' => 'id_tipo_jornada'
        ]);       

        $this->belongsTo('MaStatus', [
            'foreignKey' => 'status_id'
        ]);
    }

}
