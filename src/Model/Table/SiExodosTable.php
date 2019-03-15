<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class SiExodosTable extends Table {

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('si_exodos');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Coordinador', [
            'className' => 'SiLideres',
            'foreignKey' => 'id_coordinador_exd'
        ]);

        $this->belongsTo('MaPropiedades', [
            'foreignKey' => 'id_tipo_exodo'
        ]);       

        $this->belongsTo('MaStatus', [
            'foreignKey' => 'status_id'
        ]);
    }

}
