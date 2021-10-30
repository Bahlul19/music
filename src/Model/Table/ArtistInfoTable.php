<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ArtistInfo Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\ArtistInfo get($primaryKey, $options = [])
 * @method \App\Model\Entity\ArtistInfo newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ArtistInfo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ArtistInfo|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ArtistInfo saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ArtistInfo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ArtistInfo[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ArtistInfo findOrCreate($search, callable $callback = null, $options = [])
 */
class ArtistInfoTable extends Table
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

        $this->setTable('artist_info');
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
            ->integer('performing_right_org')
            ->allowEmptyString('performing_right_org');

        $validator
            ->integer('publisher_with_right_org')
            ->allowEmptyString('publisher_with_right_org');

        $validator
            ->integer('member_of_a_union')
            ->allowEmptyString('member_of_a_union');

        $validator
            ->scalar('other_union')
            ->maxLength('other_union', 500)
            ->allowEmptyString('other_union');

        $validator
            ->scalar('music_related_organization')
            ->maxLength('music_related_organization', 500)
            ->allowEmptyString('music_related_organization');

        $validator
            ->integer('genre')
            ->allowEmptyString('genre');

        $validator
            ->scalar('record_label')
            ->maxLength('record_label', 500)
            ->allowEmptyString('record_label');

        $validator
            ->scalar('management_contract')
            ->maxLength('management_contract', 500)
            ->allowEmptyString('management_contract');

        $validator
            ->scalar('booking_agency_contract')
            ->maxLength('booking_agency_contract', 200)
            ->allowEmptyString('booking_agency_contract');

        $validator
            ->scalar('artistName')
            ->maxLength('artistName', 200)
            ->allowEmptyString('artistName');

        $validator
            ->integer('numberOfMembers')
            ->allowEmptyString('numberOfMembers');

        $validator
            ->scalar('city')
            ->maxLength('city', 100)
            ->allowEmptyString('city');

        $validator
            ->integer('state')
            ->allowEmptyString('state');

        $validator
            ->scalar('recordLabel')
            ->maxLength('recordLabel', 200)
            ->allowEmptyString('recordLabel');

        $validator
            ->scalar('recordingsTitle1')
            ->maxLength('recordingsTitle1', 200)
            ->allowEmptyString('recordingsTitle1');

        $validator
            ->scalar('recordingsLabel1')
            ->maxLength('recordingsLabel1', 200)
            ->allowEmptyString('recordingsLabel1');

        $validator
            ->date('recordingsDate1')
            ->allowEmptyDate('recordingsDate1');

        $validator
            ->scalar('recordingsTitle2')
            ->maxLength('recordingsTitle2', 200)
            ->allowEmptyString('recordingsTitle2');

        $validator
            ->scalar('recordingsLabel2')
            ->maxLength('recordingsLabel2', 200)
            ->allowEmptyString('recordingsLabel2');

        $validator
            ->date('recordingsDate2')
            ->allowEmptyDate('recordingsDate2');

        $validator
            ->scalar('recordingsTitle3')
            ->maxLength('recordingsTitle3', 200)
            ->allowEmptyString('recordingsTitle3');

        $validator
            ->scalar('recordingsLabel3')
            ->maxLength('recordingsLabel3', 200)
            ->allowEmptyString('recordingsLabel3');

        $validator
            ->date('recordingsDate3')
            ->allowEmptyDate('recordingsDate3');

        $validator
            ->scalar('playLive')
            ->maxLength('playLive', 200)
            ->allowEmptyString('playLive');

        $validator
            ->scalar('homeRecordSoftware')
            ->maxLength('homeRecordSoftware', 200)
            ->allowEmptyString('homeRecordSoftware');

        $validator
            ->scalar('homeRecordHardware')
            ->maxLength('homeRecordHardware', 200)
            ->allowEmptyString('homeRecordHardware');

        $validator
            ->scalar('purchaseSoftware')
            ->maxLength('purchaseSoftware', 200)
            ->allowEmptyString('purchaseSoftware');

        $validator
            ->scalar('purchaseHardware')
            ->maxLength('purchaseHardware', 200)
            ->allowEmptyString('purchaseHardware');

        $validator
            ->scalar('purchaseInstruments')
            ->maxLength('purchaseInstruments', 200)
            ->allowEmptyString('purchaseInstruments');

        $validator
            ->scalar('producer')
            ->allowEmptyString('producer');

        $validator
            ->scalar('history')
            ->allowEmptyString('history');

        $validator
            ->scalar('career')
            ->allowEmptyString('career');

        $validator
            ->integer('group_plan')
            ->allowEmptyString('group_plan');

        $validator
            ->scalar('signature')
            ->maxLength('signature', 200)
            ->allowEmptyString('signature');

        $validator
            ->date('date')
            ->allowEmptyDate('date');

        $validator
            ->dateTime('created_date')
            ->allowEmptyDateTime('created_date', false);

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
