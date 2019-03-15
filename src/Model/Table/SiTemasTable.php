<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class SiTemasTable extends Table {

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('si_temas');

        $this->addBehavior('Timestamp');

        $this->belongsTo('MaPropiedades', [
            'foreignKey' => 'tipo_id'
        ]);

        $this->belongsTo('MaStatus', [
            'foreignKey' => 'status_id'
        ]);
    }

}
