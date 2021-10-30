<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MediaTags Model
 *
 * @method \App\Model\Entity\MediaTag get($primaryKey, $options = [])
 * @method \App\Model\Entity\MediaTag newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MediaTag[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MediaTag|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MediaTag saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MediaTag patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MediaTag[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MediaTag findOrCreate($search, callable $callback = null, $options = [])
 */
class MediaTagsTable extends Table
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

        $this->setTable('media_tags');
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
