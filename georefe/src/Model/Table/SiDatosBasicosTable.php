<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SiDatosBasicos Model
 *
 * @property \App\Model\Table\StatusesTable|\Cake\ORM\Association\BelongsTo $Statuses
 * @property \App\Model\Table\CreatorsTable|\Cake\ORM\Association\BelongsTo $Creators
 * @property \App\Model\Table\ModifiersTable|\Cake\ORM\Association\BelongsTo $Modifiers
 *
 * @method \App\Model\Entity\SiDatosBasico get($primaryKey, $options = [])
 * @method \App\Model\Entity\SiDatosBasico newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SiDatosBasico[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SiDatosBasico|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SiDatosBasico patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SiDatosBasico[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SiDatosBasico findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SiDatosBasicosTable extends Table
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

        $this->setTable('si_datos_basicos');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        //$this->belongsTo('Statuses', [
        //    'foreignKey' => 'status_id',
        //    'joinType' => 'INNER'
        //]);
        //$this->belongsTo('Creators', [
        //    'foreignKey' => 'creator_id',
        //    'joinType' => 'INNER'
        //]);
        //$this->belongsTo('Modifiers', [
        //    'foreignKey' => 'modifier_id'
        //]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->allowEmpty('nombres');

        $validator
            ->requirePresence('apellidos', 'create')
            ->notEmpty('apellidos');

        $validator
            ->integer('id_tipo_documento')
            ->allowEmpty('id_tipo_documento');

        $validator
            ->allowEmpty('documento');

        $validator
            ->email('email')
            ->allowEmpty('email');

        $validator
            ->allowEmpty('direccion');

        $validator
            ->allowEmpty('telefono1');

        $validator
            ->allowEmpty('telefono2');

        $validator
            ->allowEmpty('celular');

        $validator
            ->allowEmpty('fotografia');

        $validator
            ->numeric('map_latitud')
            ->allowEmpty('map_latitud');

        $validator
            ->numeric('map_longitud')
            ->allowEmpty('map_longitud');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['email']));
        //$rules->add($rules->existsIn(['status_id'], 'Statuses'));
        //$rules->add($rules->existsIn(['creator_id'], 'Creators'));
        //$rules->add($rules->existsIn(['modifier_id'], 'Modifiers'));

        return $rules;
    }
}
