<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class SiJornadaTemasTable extends Table {

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('si_jornada_temas');

        $this->addBehavior('Timestamp');

        $this->belongsTo('SiJornadas', [
            'foreignKey' => 'id_jornada'
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
