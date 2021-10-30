<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Poll Entity
 *
 * @property int $id
 * @property int|null $question_id
 * @property int|null $answer_id
 * @property int|null $user_id
 *
 * @property \App\Model\Entity\Question $question
 * @property \App\Model\Entity\Answer $answer
 * @property \App\Model\Entity\User $user
 */
class Poll extends Entity
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
        'question_id' => true,
        'answer_id' => true,
        'user_id' => true,
        'question' => true,
        'answer' => true,
        'user' => true
    ];
}
