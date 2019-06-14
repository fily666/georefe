<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class SiGlAsistentesTable extends Table
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

        $this->table('si_gl_asistentes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('MaStatus', [
            'foreignKey' => 'status_id'
        ]);

        $this->belongsTo('Persona', [
            'className' => 'Persons',
            'foreignKey' => 'id_datos_basicos'
        ]);

        $this->belongsTo('SiGls', [
            'foreignKey' => 'id_gl'
        ]);	

        $this->belongsTo('MaPropiedades', [
            'foreignKey' => 'id_tipo_asistente'
        ]);
        
    }

}
