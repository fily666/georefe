<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class SiGlsTable extends Table
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

        $this->table('si_gls');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Categoria', [
            'className' => 'MaPropiedades',
            'foreignKey' => 'id_categoria'
        ]);

        $this->belongsTo('Lider', [
            'className' => 'SiLideres',
            'foreignKey' => 'id_lider'
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

        $this->belongsTo('MaStatus', [
            'foreignKey' => 'status_id'
        ]);
    }

}
