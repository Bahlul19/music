<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ArtistInfo Entity
 *
 * @property int $id
 * @property int|null $performing_right_org
 * @property int|null $publisher_with_right_org
 * @property int|null $member_of_a_union
 * @property string|null $other_union
 * @property string|null $music_related_organization
 * @property int|null $genre
 * @property string|null $record_label
 * @property string|null $management_contract
 * @property string|null $booking_agency_contract
 * @property string|null $artistName
 * @property int|null $numberOfMembers
 * @property string|null $city
 * @property int|null $state
 * @property string|null $recordLabel
 * @property string|null $recordingsTitle1
 * @property string|null $recordingsLabel1
 * @property \Cake\I18n\FrozenDate|null $recordingsDate1
 * @property string|null $recordingsTitle2
 * @property string|null $recordingsLabel2
 * @property \Cake\I18n\FrozenDate|null $recordingsDate2
 * @property string|null $recordingsTitle3
 * @property string|null $recordingsLabel3
 * @property \Cake\I18n\FrozenDate|null $recordingsDate3
 * @property string|null $playLive
 * @property string|null $homeRecordSoftware
 * @property string|null $homeRecordHardware
 * @property string|null $purchaseSoftware
 * @property string|null $purchaseHardware
 * @property string|null $purchaseInstruments
 * @property string|null $producer
 * @property string|null $history
 * @property string|null $career
 * @property int|null $group_plan
 * @property string|null $signature
 * @property \Cake\I18n\FrozenDate|null $date
 * @property \Cake\I18n\FrozenTime $created_date
 * @property int $user_id
 *
 * @property \App\Model\Entity\User $user
 */
class ArtistInfo extends Entity
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
        'performing_right_org' => true,
        'publisher_with_right_org' => true,
        'member_of_a_union' => true,
        'other_union' => true,
        'music_related_organization' => true,
        'genre' => true,
        'record_label' => true,
        'management_contract' => true,
        'booking_agency_contract' => true,
        'artistName' => true,
        'numberOfMembers' => true,
        'city' => true,
        'state' => true,
        'recordLabel' => true,
        'recordingsTitle1' => true,
        'recordingsLabel1' => true,
        'recordingsDate1' => true,
        'recordingsTitle2' => true,
        'recordingsLabel2' => true,
        'recordingsDate2' => true,
        'recordingsTitle3' => true,
        'recordingsLabel3' => true,
        'recordingsDate3' => true,
        'playLive' => true,
        'homeRecordSoftware' => true,
        'homeRecordHardware' => true,
        'purchaseSoftware' => true,
        'purchaseHardware' => true,
        'purchaseInstruments' => true,
        'producer' => true,
        'history' => true,
        'career' => true,
        'group_plan' => true,
        'signature' => true,
        'date' => true,
        'created_date' => true,
        'user_id' => true,
        'user' => true
    ];
}
