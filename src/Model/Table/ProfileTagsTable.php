<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProfileTags Model
 *
 * @method \App\Model\Entity\ProfileTag get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProfileTag newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ProfileTag[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProfileTag|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProfileTag saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProfileTag patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProfileTag[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProfileTag findOrCreate($search, callable $callback = null, $options = [])
 */
class ProfileTagsTable extends Table
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

        $this->setTable('profile_tags');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
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
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('tag')
            ->maxLength('tag', 50)
            ->requirePresence('tag', 'create')
            ->allowEmptyString('tag', false);

        return $validator;
    }
}
