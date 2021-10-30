<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Transaction Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $btn_id
 * @property string|null $business
 * @property string|null $contact_phone
 * @property string|null $first_name
 * @property string|null $item_name
 * @property string|null $item_number
 * @property string|null $last_name
 * @property string|null $mc_currency
 * @property float|null $mc_fee
 * @property float|null $mc_gross
 * @property string|null $option_name
 * @property string|null $option_selection
 * @property string|null $payer_email
 * @property string|null $payer_id
 * @property string|null $payer_status
 * @property string|null $payment_date
 * @property \Cake\I18n\FrozenDate|null $end_date
 * @property float|null $payment_fee
 * @property float|null $payment_gross
 * @property string|null $payment_status
 * @property string|null $payment_type
 * @property string|null $protection_eligibility
 * @property string|null $receiver_email
 * @property string|null $receiver_id
 * @property string|null $residence_country
 * @property string|null $subscr_id
 * @property string|null $transaction_subject
 * @property string|null $txn_id
 * @property string|null $txn_type
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Btn $btn
 * @property \App\Model\Entity\Payer $payer
 * @property \App\Model\Entity\Receiver $receiver
 * @property \App\Model\Entity\Subscr $subscr
 * @property \App\Model\Entity\Txn $txn
 */
class Transaction extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'user_id' => true,
        'btn_id' => true,
        'business' => true,
        'contact_phone' => true,
        'first_name' => true,
        'item_name' => true,
        'item_number' => true,
        'last_name' => true,
        'mc_currency' => true,
        'mc_fee' => true,
        'mc_gross' => true,
        'option_name' => true,
        'option_selection' => true,
        'payer_email' => true,
        'payer_id' => true,
        'payer_status' => true,
        'payment_date' => true,
        'end_date' => true,
        'payment_fee' => true,
        'payment_gross' => true,
        'payment_status' => true,
        'payment_type' => true,
        'protection_eligibility' => true,
        'receiver_email' => true,
        'receiver_id' => true,
        'residence_country' => true,
        'subscr_id' => true,
        'transaction_subject' => true,
        'txn_id' => true,
        'txn_type' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'btn' => true,
        'payer' => true,
        'receiver' => true,
        'subscr' => true,
        'txn' => true
    ];
}
