<?php

namespace App\Model\Table;
use Cake\ORM\Table;

/**
 * Countries Model
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CountriesTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('countries');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
    }

}
