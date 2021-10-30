<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MediaMeta Entity
 *
 * @property int $id
 * @property int $media_id
 * @property int $ratings
 * @property int $is_featured
 * @property string $description
 * @property string $tag
 * @property string $media_link
 * @property bool $is_active
 * @property string $title
 * @property int $price
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Media $media
 * @property \App\Model\Entity\CartItem[] $cart_items
 */
class MediaMeta extends Entity
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
        'ratings' => true,
        'is_featured' => true,
        'description' => true,
        'tag' => true,
        'media_link' => true,
        'is_active' => true,
        'title' => true,
        'price' => true,
        'created' => true,
        'modified' => true,
        'media' => true,
        'cart_items' => true
    ];
}
