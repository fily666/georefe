<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class SiDatosComplementariosTable extends Table {

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('si_datos_complementarios');

        $this->addBehavior('Timestamp');

        $this->belongsTo('EstadoCivil', [
            'className' => 'MaPropiedades',
            'foreignKey' => 'id_estado_civil'
        ]);

        $this->belongsTo('Genero', [
            'className' => 'MaPropiedades',
            'foreignKey' => 'id_genero'
        ]);

        $this->belongsTo('TipoDocConyugue', [
            'className' => 'MaPropiedades',
            'foreignKey' => 'id_tipo_doc_conyugue'
        ]);

        $this->belongsTo('NivelEstudio', [
            'className' => 'MaPropiedades',
            'foreignKey' => 'id_nivel_estudio'
        ]);


        $this->belongsTo('Profesion', [
            'className' => 'MaPropiedades',
            'foreignKey' => 'id_profesion'
        ]);

        $this->belongsTo('EjerceProfesion', [
            'className' => 'MaPropiedades',
            'foreignKey' => 'id_ejerce_profesion'
        ]);

        $this->belongsTo('Ministerio', [
            'className' => 'MaPropiedades',
            'foreignKey' => 'id_ministerio'
        ]);


        $this->belongsTo('MaStatus', [
            'foreignKey' => 'status_id'
        ]);
    }

}
