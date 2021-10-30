<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Feedbacks Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Feedback get($primaryKey, $options = [])
 * @method \App\Model\Entity\Feedback newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Feedback[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Feedback|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Feedback saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Feedback patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Feedback[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Feedback findOrCreate($search, callable $callback = null, $options = [])
 */
class FeedbacksTable extends Table
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

        $this->setTable('feedbacks');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
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
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('name')
            ->requirePresence('name', 'create','Please Enter your name')
            ->maxLength('name', 50)
            ->allowEmptyString('name', false);

        $validator
            ->email('email')
            ->requirePresence('email', 'create','Please Enter your email id')
            ->allowEmptyString('email', false);

        $validator
            ->scalar('comment')
            ->requirePresence('comment', 'create','Please add your comment')
            ->allowEmptyString('comment', false);

        $validator
            ->allowEmpty('status', 'create');

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
        //$rules->add($rules->isUnique(['email']));
        //$rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
