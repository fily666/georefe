<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MaActions Model
 *
 * @property \Cake\ORM\Association\BelongsTo $MaControllers
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $MaGeneral
 *
 * @method \App\Model\Entity\MaAction get($primaryKey, $options = [])
 * @method \App\Model\Entity\MaAction newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MaAction[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MaAction|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MaAction patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MaAction[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MaAction findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MaActionsTable extends Table
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

        $this->table('ma_actions');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('MaControllers', [
            'foreignKey' => 'controller_id'
        ]);        
        $this->belongsTo('MaStatus', [
            'foreignKey' => 'status_id'
        ]);
        $this->belongsToMany('MaGroups',[
            'joinTable' => 'ma_actions_groups',
            'foreignKey' => 'action_id',
            'targetForeignKey' => 'group_id'
            ]);
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
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->requirePresence('url', 'create')
            ->notEmpty('url');

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
        $rules->add($rules->existsIn(['controller_id'], 'MaControllers'));
        $rules->add($rules->existsIn(['status_id'], 'MaGeneral'));

        return $rules;
    }
}
