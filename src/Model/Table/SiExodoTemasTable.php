<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class SiExodoTemasTable extends Table {

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('si_exodo_temas');

        $this->addBehavior('Timestamp');

        $this->belongsTo('SiExodos', [
            'foreignKey' => 'id_exodo'
        ]);

        $this->belongsTo('SiTemas', [
            'foreignKey' => 'id_tema'
        ]);

        $this->belongsTo('SiLideres', [
            'foreignKey' => 'id_lider'
        ]);

        $this->belongsTo('MaStatus', [
            'foreignKey' => 'status_id'
        ]);
    }

}
