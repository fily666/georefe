<?php

namespace App\Model\Table;
use Cake\ORM\Table;

/**
 * Deparments Model
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DepartmentsTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('departments');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
    }

}
