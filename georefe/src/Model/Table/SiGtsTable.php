<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class SiGtsTable extends Table {

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('si_gts');

        $this->addBehavior('Timestamp');


        $this->belongsTo('Categoria', [
            'className' => 'MaPropiedades',
            'foreignKey' => 'id_categoria'
        ]);

        $this->belongsTo('Lider1', [
            'className' => 'SiLideres',
            'foreignKey' => 'id_lider_asignado1'
        ]);

        $this->belongsTo('Lider2', [
            'className' => 'SiLideres',
            'foreignKey' => 'id_lider_asignado2'
        ]);

        $this->belongsTo('Lider3', [
            'className' => 'SiLideres',
            'foreignKey' => 'id_lider_asignado3'
        ]);

        $this->belongsTo('Lider4', [
            'className' => 'SiLideres',
            'foreignKey' => 'id_lider_asignado4'
        ]);

        $this->belongsTo('MaStatus', [
            'foreignKey' => 'status_id'
        ]);

        $this->belongsTo('DiaReunion', [
            'className' => 'MaPropiedades',
            'foreignKey' => 'id_dia_reunion'
        ]);

        $this->belongsTo('SiPastores', [
            'foreignKey' => 'id_pastor'
        ]);

        $this->belongsTo('Ciudad', [
            'className' => 'MaPropiedades',
            'foreignKey' => 'id_ciudad'
        ]);

        $this->belongsTo('Localidad', [
            'className' => 'MaPropiedades',
            'foreignKey' => 'id_localidad'
        ]);

        $this->belongsTo('Barrio', [
            'className' => 'MaPropiedades',
            'foreignKey' => 'id_barrio'
        ]);
    }

}
