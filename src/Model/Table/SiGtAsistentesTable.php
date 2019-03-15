<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class SiGtAsistentesTable extends Table {

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('si_gt_asistentes');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Persona', [
            'className' => 'Persons',
            'foreignKey' => 'id_datos_basicos'
        ]);

        $this->belongsTo('SiGts', [
            'foreignKey' => 'id_gt'
        ]);	

        $this->belongsTo('MaPropiedades', [
            'foreignKey' => 'id_tipo_asistente'
        ]);

        $this->belongsTo('MaStatus', [
            'foreignKey' => 'status_id'
        ]);
    }

}
