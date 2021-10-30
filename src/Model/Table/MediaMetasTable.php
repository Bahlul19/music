<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MediaMetas Model
 *
 * @property \App\Model\Table\MediaTable|\Cake\ORM\Association\BelongsTo $Media
 * @property \App\Model\Table\CartItemsTable|\Cake\ORM\Association\HasMany $CartItems
 *
 * @method \App\Model\Entity\MediaMeta get($primaryKey, $options = [])
 * @method \App\Model\Entity\MediaMeta newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MediaMeta[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MediaMeta|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MediaMeta saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MediaMeta patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MediaMeta[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MediaMeta findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MediaMetasTable extends Table
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

        $this->setTable('media_metas');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Medias', [
            'foreignKey' => 'media_id',
            'joinType' => 'INNER'
        ]);

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);

        $this->hasMany('CartItems', [
            'foreignKey' => 'media_meta_id'
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
            ->integer('ratings')
            ->requirePresence('ratings', 'create')
            ->allowEmptyString('ratings', false);

        $validator
            ->requirePresence('is_featured', 'create')
            ->allowEmptyString('is_featured', false);

        $validator
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->allowEmptyString('description', false);
/*
        $validator
            ->scalar('tag')
            ->maxLength('tag', 255)
            ->requirePresence('tag', 'create')
            ->allowEmptyString('tag', false);
*/
        $validator
            ->scalar('media_link')
            ->maxLength('media_link', 30000)
            ->requirePresence('media_link', 'create')
            ->allowEmptyString('media_link', false);

        $validator
            ->boolean('is_active')
            ->requirePresence('is_active', 'create')
            ->allowEmptyString('is_active', false);

        $validator
            ->scalar('title')
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->allowEmptyString('title', false);

        $validator
            ->integer('price')
            ->requirePresence('price', 'create')
            ->allowEmptyString('price', false);

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
        $rules->add($rules->existsIn(['media_id'], 'Medias'));

        return $rules;
    }
}
