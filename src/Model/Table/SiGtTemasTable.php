<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class SiGtTemasTable extends Table {

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('si_gt_temas');

        $this->addBehavior('Timestamp');

        $this->belongsTo('SiGts', [
            'foreignKey' => 'id_gt'
        ]);

        $this->belongsTo('SiTemas', [
            'foreignKey' => 'id_tema'
        ]);

        $this->belongsTo('MaStatus', [
            'foreignKey' => 'status_id'
        ]);
    }

}
