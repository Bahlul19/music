<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PostTags Model
 *
 * @property \App\Model\Table\PostsTable|\Cake\ORM\Association\HasMany $Posts
 *
 * @method \App\Model\Entity\PostTag get($primaryKey, $options = [])
 * @method \App\Model\Entity\PostTag newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PostTag[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PostTag|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PostTag saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PostTag patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PostTag[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PostTag findOrCreate($search, callable $callback = null, $options = [])
 */
class PostTagsTable extends Table
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

        $this->setTable('post_tags');
        $this->setDisplayField('tag');
        $this->setPrimaryKey('id');

        $this->hasMany('Posts', [
            'foreignKey' => 'post_tag_id'
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
            ->scalar('tag')
            ->maxLength('tag', 50)
            ->requirePresence('tag', 'create')
            ->allowEmptyString('tag', false);

        return $validator;
    }
}
