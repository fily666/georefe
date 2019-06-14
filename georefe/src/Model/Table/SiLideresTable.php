<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class SiLideresTable extends Table {

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('si_lideres');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Persons', [
            'foreignKey' => 'id_datos_basicos'
        ]);

        $this->belongsTo('MaPropiedades', [
            'foreignKey' => 'id_nivel'
        ]);

        $this->belongsTo('MaStatus', [
            'foreignKey' => 'status_id'
        ]);
    }

}
