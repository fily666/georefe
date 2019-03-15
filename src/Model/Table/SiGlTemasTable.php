<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class SiGlTemasTable extends Table
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

        $this->table('si_gl_temas');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('MaStatus', [
            'foreignKey' => 'status_id'
        ]);
        
        $this->belongsTo('SiGls', [
            'foreignKey' => 'id_gl'
        ]);

        $this->belongsTo('SiTemas', [
            'foreignKey' => 'id_tema'
        ]);
    }

}
