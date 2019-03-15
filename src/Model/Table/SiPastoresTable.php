<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class SiPastoresTable extends Table {

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('si_pastores');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Persons', [
            'foreignKey' => 'id_datos_basicos'
        ]);

        $this->belongsTo('MaStatus', [
            'foreignKey' => 'status_id'
        ]);
    }

}
