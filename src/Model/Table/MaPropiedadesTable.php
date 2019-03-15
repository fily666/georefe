<?php

namespace App\Model\Table;

use Cake\ORM\Table;

/**
 * MaStatus Model
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MaPropiedadesTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('ma_propiedades');
        $this->displayField('value');
        $this->primaryKey('id');
        
         $this->belongsTo('MaStatus', [
            'foreignKey' => 'status_id'
        ]);

        $this->addBehavior('Timestamp');
    }

}
