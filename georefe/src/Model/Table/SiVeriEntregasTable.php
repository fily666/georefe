<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class SiVeriEntregasTable extends Table {

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('si_veri_entregas');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Persona', [
            'className' => 'Persons',
            'foreignKey' => 'id_datos_basicos'
        ]);

        $this->belongsTo('LiderAsignado', [
            'className' => 'SiLideres',
            'foreignKey' => 'id_lider_asignado'
        ]);

        $this->belongsTo('LiderLlamada', [
            'className' => 'SiLideres',
            'foreignKey' => 'id_lider_GT'
        ]);

        $this->belongsTo('LiderConsolida', [
            'className' => 'SiLideres',
            'foreignKey' => 'id_lider_consolida'
        ]);

        $this->belongsTo('PersonaInvito', [
            'className' => 'Persons',
            'foreignKey' => 'id_datos_basicos_invito'
        ]);

        $this->belongsTo('UbicatGt', [
            'className' => 'MaPropiedades',
            'foreignKey' => 'id_ubicar_gt'
        ]);

        $this->belongsTo('TipoEntrega', [
            'className' => 'MaPropiedades',
            'foreignKey' => 'id_tipo_entrega'
        ]);

        $this->belongsTo('Fase', [
            'className' => 'MaPropiedades',
            'foreignKey' => 'id_fase'
        ]);

        $this->belongsTo('EstadoLlamada', [
            'className' => 'MaPropiedades',
            'foreignKey' => 'id_estado_llamada'
        ]);

        $this->belongsTo('Guia', [
            'className' => 'Persons',
            'foreignKey' => 'id_guia'
        ]);


        $this->belongsTo('Pastor', [
            'className' => 'SiPastores',
            'foreignKey' => 'id_pastor'
        ]);


        $this->belongsTo('MaStatus', [
            'foreignKey' => 'status_id'
        ]);
    }

}
