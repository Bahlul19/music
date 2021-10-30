<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PostCategorys Model
 *
 * @property \App\Model\Table\PostsTable|\Cake\ORM\Association\HasMany $Posts
 *
 * @method \App\Model\Entity\PostCategory get($primaryKey, $options = [])
 * @method \App\Model\Entity\PostCategory newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PostCategory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PostCategory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PostCategory saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PostCategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PostCategory[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PostCategory findOrCreate($search, callable $callback = null, $options = [])
 */
class PostCategorysTable extends Table
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

        $this->setTable('post_categorys');
        $this->setDisplayField('category');
        $this->setPrimaryKey('id');

        $this->hasMany('Posts', [
            'foreignKey' => 'post_category_id'
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
            ->scalar('category')
            ->maxLength('category', 50)
            ->requirePresence('category', 'create')
            ->allowEmptyString('category', false);

        return $validator;
    }
}
