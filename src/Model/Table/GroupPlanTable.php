<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * GroupPlan Model
 *
 * @method \App\Model\Entity\GroupPlan get($primaryKey, $options = [])
 * @method \App\Model\Entity\GroupPlan newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\GroupPlan[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\GroupPlan|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\GroupPlan saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\GroupPlan patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\GroupPlan[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\GroupPlan findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class GroupPlanTable extends Table
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

        $this->setTable('group_plan');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->scalar('plan')
            ->maxLength('plan', 500)
            ->requirePresence('plan', 'create')
            ->allowEmptyString('plan', false);

        return $validator;
    }
}
