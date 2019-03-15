<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class PersonsTable extends Table {

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('si_datos_basicos');

        $this->addBehavior('Timestamp');

        $this->belongsTo('MaPropiedades', [
            'foreignKey' => 'id_tipo_documento'
        ]);

        $this->belongsTo('Barrio', [
            'className' => 'MaPropiedades',
            'foreignKey' => 'id_barrio'
        ]);

        $this->belongsTo('MaStatus', [
            'foreignKey' => 'status_id'
        ]);
    }

    public function validationDefault(Validator $validator) {
        return $validator
                        ->notEmpty('nombres', 'El primer nombre es requerido')
                        ->notEmpty('documento', 'El documento es requerido')
                        ->notEmpty('apellidos', 'El primer apellido es requerido');
    }

}
