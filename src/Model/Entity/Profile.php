<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Profile Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $media_id
 * @property string|null $short_bio
 * @property string|null $description
 * @property string|null $interest
 * @property \Cake\I18n\FrozenDate|null $dob
 * @property string|null $skill
 * @property string|null $tag
 * @property bool $is_active
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Media $media
 */
class Profile extends Entity
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
        'media_id' => true,
        'short_bio' => true,
        'description' => true,
        'interest' => true,
        'dob' => true,
        'skill' => true,
        'tag' => true,
        'is_active' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'media' => true
    ];
}
