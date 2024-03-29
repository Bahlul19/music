<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MediaComment Entity
 *
 * @property int $id
 * @property int $media_id
 * @property int $user_id
 * @property string|null $comment
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Media $media
 * @property \App\Model\Entity\User $user
 */
class MediaComment extends Entity
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
        'media_id' => true,
        'user_id' => true,
        'comment' => true,
        'created' => true,
        'modified' => true,
        'media' => true,
        'user' => true
    ];
}
