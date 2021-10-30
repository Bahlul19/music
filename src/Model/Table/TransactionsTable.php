<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Transactions Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\BtnsTable|\Cake\ORM\Association\BelongsTo $Btns
 * @property \App\Model\Table\PayersTable|\Cake\ORM\Association\BelongsTo $Payers
 * @property \App\Model\Table\ReceiversTable|\Cake\ORM\Association\BelongsTo $Receivers
 * @property \App\Model\Table\SubscrsTable|\Cake\ORM\Association\BelongsTo $Subscrs
 * @property \App\Model\Table\TxnsTable|\Cake\ORM\Association\BelongsTo $Txns
 *
 * @method \App\Model\Entity\Transaction get($primaryKey, $options = [])
 * @method \App\Model\Entity\Transaction newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Transaction[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Transaction|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Transaction saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Transaction patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Transaction[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Transaction findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TransactionsTable extends Table
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

        $this->setTable('transactions');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Btns', [
            'foreignKey' => 'btn_id'
        ]);
        $this->belongsTo('Payers', [
            'foreignKey' => 'payer_id'
        ]);
        $this->belongsTo('Receivers', [
            'foreignKey' => 'receiver_id'
        ]);
        $this->belongsTo('Subscrs', [
            'foreignKey' => 'subscr_id'
        ]);
        $this->belongsTo('Txns', [
            'foreignKey' => 'txn_id'
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
            ->scalar('business')
            ->maxLength('business', 255)
            ->allowEmptyString('business');

        $validator
            ->scalar('contact_phone')
            ->maxLength('contact_phone', 255)
            ->allowEmptyString('contact_phone');

        $validator
            ->scalar('first_name')
            ->maxLength('first_name', 255)
            ->allowEmptyString('first_name');

        $validator
            ->scalar('item_name')
            ->maxLength('item_name', 255)
            ->allowEmptyString('item_name');

        $validator
            ->scalar('item_number')
            ->maxLength('item_number', 255)
            ->allowEmptyString('item_number');

        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 255)
            ->allowEmptyString('last_name');

        $validator
            ->scalar('mc_currency')
            ->maxLength('mc_currency', 255)
            ->allowEmptyString('mc_currency');

        $validator
            ->numeric('mc_fee')
            ->allowEmptyString('mc_fee');

        $validator
            ->numeric('mc_gross')
            ->allowEmptyString('mc_gross');

        $validator
            ->scalar('option_name')
            ->maxLength('option_name', 255)
            ->allowEmptyString('option_name');

        $validator
            ->scalar('option_selection')
            ->maxLength('option_selection', 255)
            ->allowEmptyString('option_selection');

        $validator
            ->scalar('payer_email')
            ->maxLength('payer_email', 255)
            ->allowEmptyString('payer_email');

        $validator
            ->scalar('payer_status')
            ->maxLength('payer_status', 255)
            ->allowEmptyString('payer_status');

        $validator
            ->scalar('payment_date')
            ->maxLength('payment_date', 255)
            ->allowEmptyString('payment_date');

        $validator
            ->date('end_date')
            ->allowEmptyDate('end_date');

        $validator
            ->numeric('payment_fee')
            ->allowEmptyString('payment_fee');

        $validator
            ->numeric('payment_gross')
            ->allowEmptyString('payment_gross');

        $validator
            ->scalar('payment_status')
            ->maxLength('payment_status', 255)
            ->allowEmptyString('payment_status');

        $validator
            ->scalar('payment_type')
            ->maxLength('payment_type', 255)
            ->allowEmptyString('payment_type');

        $validator
            ->scalar('protection_eligibility')
            ->maxLength('protection_eligibility', 255)
            ->allowEmptyString('protection_eligibility');

        $validator
            ->scalar('receiver_email')
            ->maxLength('receiver_email', 255)
            ->allowEmptyString('receiver_email');

        $validator
            ->scalar('residence_country')
            ->maxLength('residence_country', 255)
            ->allowEmptyString('residence_country');

        $validator
            ->scalar('transaction_subject')
            ->maxLength('transaction_subject', 255)
            ->allowEmptyString('transaction_subject');

        $validator
            ->scalar('txn_type')
            ->maxLength('txn_type', 255)
            ->allowEmptyString('txn_type');

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
        $rules->add($rules->existsIn(['btn_id'], 'Btns'));
        $rules->add($rules->existsIn(['payer_id'], 'Payers'));
        $rules->add($rules->existsIn(['receiver_id'], 'Receivers'));
        $rules->add($rules->existsIn(['subscr_id'], 'Subscrs'));
        $rules->add($rules->existsIn(['txn_id'], 'Txns'));

        return $rules;
    }
}
