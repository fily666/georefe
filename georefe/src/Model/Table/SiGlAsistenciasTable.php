<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class SiGlAsistenciasTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('si_gl_asistencias');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('SiGlAsistentes', [
            'foreignKey' => 'id_gl_asistente'
        ]);

        $this->belongsTo('SiGlTemas', [
            'foreignKey' => 'id_gl_tema'
        ]);
    }
}
