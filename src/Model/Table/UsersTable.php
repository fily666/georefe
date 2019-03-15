<?php
namespace App\Model\Table;

use Cake\Event\Event as Event;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Persons
 * @property \Cake\ORM\Association\BelongsTo $MaGroups
 * @property \Cake\ORM\Association\BelongsTo $Creators
 * @property \Cake\ORM\Association\BelongsTo $Statuses
 * @property \Cake\ORM\Association\BelongsToMany $Devices
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
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

        $this->table('users');
        $this->displayField('username');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Persons', [
            'foreignKey' => 'person_id'
        ]);
        $this->belongsTo('MaGroups', [
            'foreignKey' => 'group_id'
        ]);
        $this->belongsTo('MaStatus', [
            'foreignKey' => 'status_id'
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
            ->notEmpty('urlphoto');

        $validator
            ->notEmpty('username');

        // ^ : Inicio de la cadena
        // $ : Fin de la cadena
        // \S* : Cualquier conjunto de caracteres
        // (?=\S{8,}) : M'inimo 8 caracteres
        // (?=\S*[a-z]) : Una Min'uscula
        // (?=\S*[A-Z]) : Una May'uscula
        // (?=\S*[\d]) : Un n'umero
        
        $validator
            ->add('password', 'validFormat', [
               'rule' => array('custom', '/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/'),
               'message' => 'La contraseña debe contener mínimo: Una mayúscula, una minúscula, un número, un caracter válido ($@!%*?&) y una Longitud de mímimo 8 caracteres'
            ]);

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
        $rules->add($rules->isUnique(['username']));
//        $rules->add($rules->existsIn(['persons_id'], 'Persons'));
        $rules->add($rules->existsIn(['group_id'], 'MaGroups'));
        /*$rules->add($rules->existsIn(['creator_id'], 'Creators'));
        $rules->add($rules->existsIn(['status_id'], 'Statuses'));*/

        return $rules;
    }
    
    public function beforeMarshal(Event $event, \ArrayObject $data, \ArrayObject $options) {
        if (isset($data['password']) && empty($data['password'])) {
            unset($data['password']);
        }
    }
}
