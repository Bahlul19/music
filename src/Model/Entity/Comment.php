<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Comment Entity
 *
 * @property int $id
 * @property string|null $comment
 * @property int|null $post_id
 * @property int|null $user_id
 *
 * @property \App\Model\Entity\Post $post
 * @property \App\Model\Entity\User $user
 */
class Comment extends Entity
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
        'comment' => true,
        'post_id' => true,
        'user_id' => true,
        'post' => true,
        'user' => true
    ];
}
