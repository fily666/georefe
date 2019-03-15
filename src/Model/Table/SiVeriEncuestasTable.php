<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class SiVeriEncuestasTable extends Table {

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('si_veri_encuestas');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Entrega', [
            'className' => 'SiVeriEntregas',
            'foreignKey' => 'id_veri_entrega'
        ]);
     
        $this->belongsTo('MedioInfoSM', [
            'className' => 'MaPropiedades',
            'foreignKey' => 'id_medio_info_sm'
        ]);

        $this->belongsTo('ResultadoLlamada', [
            'className' => 'MaPropiedades',
            'foreignKey' => 'id_resultado_llamada'
        ]);

        $this->belongsTo('Prioridad', [
            'className' => 'MaPropiedades',
            'foreignKey' => 'id_prioridad'
        ]);

        $this->belongsTo('FaseConsolidacion', [
            'className' => 'MaPropiedades',
            'foreignKey' => 'id_fase_consolidacion'
        ]);

        $this->belongsTo('MaStatus', [
            'foreignKey' => 'status_id'
        ]);
    }

}
