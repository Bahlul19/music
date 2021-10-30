<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PostCategory $postCategory
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Post Category'), ['action' => 'edit', $postCategory->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Post Category'), ['action' => 'delete', $postCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $postCategory->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Post Categorys'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Post Category'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Posts'), ['controller' => 'Posts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Post'), ['controller' => 'Posts', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="postCategorys view large-9 medium-8 columns content">
    <h3><?= h($postCategory->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Category') ?></th>
            <td><?= h($postCategory->category) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($postCategory->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Posts') ?></h4>
        <?php if (!empty($postCategory->posts)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Slug') ?></th>
                <th scope="col"><?= __('Title') ?></th>
                <th scope="col"><?= __('Content') ?></th>
                <th scope="col"><?= __('Media Id') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Content Type') ?></th>
                <th scope="col"><?= __('Post Category Id') ?></th>
                <th scope="col"><?= __('Post Tag Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($postCategory->posts as $posts): ?>
            <tr>
                <td><?= h($posts->id) ?></td>
                <td><?= h($posts->slug) ?></td>
                <td><?= h($posts->title) ?></td>
                <td><?= h($posts->content) ?></td>
                <td><?= h($posts->media_id) ?></td>
                <td><?= h($posts->status) ?></td>
                <td><?= h($posts->content_type) ?></td>
                <td><?= h($posts->post_category_id) ?></td>
                <td><?= h($posts->post_tag_id) ?></td>
                <td><?= h($posts->created) ?></td>
                <td><?= h($posts->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Posts', 'action' => 'view', $posts->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Posts', 'action' => 'edit', $posts->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Posts', 'action' => 'delete', $posts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $posts->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
