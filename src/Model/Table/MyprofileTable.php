<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Myprofile Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Myprofile get($primaryKey, $options = [])
 * @method \App\Model\Entity\Myprofile newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Myprofile[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Myprofile|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Myprofile saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Myprofile patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Myprofile[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Myprofile findOrCreate($search, callable $callback = null, $options = [])
 */
class MyprofileTable extends Table
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

        $this->setTable('myprofile');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
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
            ->scalar('wall_img_path')
            ->maxLength('wall_img_path', 1000)
            ->allowEmptyString('wall_img_path');

        $validator
            ->scalar('photo_path')
            ->maxLength('photo_path', 1000)
            ->allowEmptyString('photo_path');

        $validator
            ->scalar('video')
            ->maxLength('video', 2000)
            ->allowEmptyString('video');

        $validator
            ->scalar('music')
            ->maxLength('music', 2000)
            ->allowEmptyString('music');

        $validator
            ->scalar('news')
            ->allowEmptyString('news');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
