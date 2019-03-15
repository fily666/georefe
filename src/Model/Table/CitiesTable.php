<?php

namespace App\Model\Table;
use Cake\ORM\Table;

/**
 * Cities Model
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CitiesTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('cities');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
    }

}
