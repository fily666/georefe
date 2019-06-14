<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class SiPuntosEncuentroTemasTable extends Table {

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('si_puntos_encuentro_temas');

        $this->addBehavior('Timestamp');

        $this->belongsTo('SiPuntoEncuentros', [
            'foreignKey' => 'id_punto_encuentro'
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
