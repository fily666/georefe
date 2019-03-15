<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class SiParientesTable extends Table {

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('si_parientes');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Persona', [
            'className' => 'Persons',
            'foreignKey' => 'id_datos_basicos'
        ]);

        $this->belongsTo('Pariente', [
            'className' => 'Persons',
            'foreignKey' => 'id_datos_basicos_pariente'
        ]);

        $this->belongsTo('MaPropiedades', [
            'foreignKey' => 'id_tipo_relacion'
        ]);

        $this->belongsTo('MaStatus', [
            'foreignKey' => 'status_id'
        ]);
    }

}
