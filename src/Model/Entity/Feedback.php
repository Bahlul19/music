<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Feedback Entity
 *
 * @property int $id
 * @property string $email
 * @property int $user_id
 * @property string $comment
 * @property string $question
 * @property int $status
 *
 * @property \App\Model\Entity\User $user
 */
class Feedback extends Entity
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
        'email' => true,
        'name' => true,
        'user_id' => true,
        'comment' => true,
        'question' => true,
        'status' => true,
        'user' => true
    ];
}
