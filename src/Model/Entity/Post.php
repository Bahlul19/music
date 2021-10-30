<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Post Entity
 *
 * @property int $id
 * @property string $slug
 * @property string $title
 * @property string $content
 * @property int $media_id
 * @property int $status
 * @property string $content_type
 * @property int $post_category_id
 * @property int $post_tag_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Media $media
 * @property \App\Model\Entity\PostCategory $post_category
 * @property \App\Model\Entity\PostTag $post_tag
 */
class Post extends Entity
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
        'slug' => true,
        'title' => true,
        'content' => true,
        'media_id' => true,
        'status' => true,
        'content_type' => true,
        'post_category_id' => true,
        'post_tag_id' => true,
        'created' => true,
        'modified' => true,
        'media' => true,
        'post_category' => true,
        'post_tag' => true
    ];
}
