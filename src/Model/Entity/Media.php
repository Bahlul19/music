<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Media Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $type
 * @property int $status
 * @property string|null $name
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Comment[] $comments
 * @property \App\Model\Entity\Like[] $likes
 * @property \App\Model\Entity\MediaMeta[] $media_metas
 * @property \App\Model\Entity\Post[] $posts
 * @property \App\Model\Entity\Profile[] $profiles
 */
class Media extends Entity
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
        'type' => true,
        'status' => true,
        'name' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'comments' => true,
        'likes' => true,
        'media_metas' => true,
        'posts' => true,
        'profiles' => true
    ];
}
