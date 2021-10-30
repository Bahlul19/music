<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Myprofile Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $wall_img_path
 * @property string|null $photo_path
 * @property string|null $video
 * @property string|null $music
 * @property string|null $news
 *
 * @property \App\Model\Entity\User $user
 */
class Myprofile extends Entity
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
        'wall_img_path' => true,
        'photo_path' => true,
        'video' => true,
        'music' => true,
        'news' => true,
        'user' => true
    ];
}
