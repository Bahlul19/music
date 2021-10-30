<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Post $post
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Posts'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Post Tags'), ['controller' => 'PostTags', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Post Tag'), ['controller' => 'PostTags', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="posts form large-9 medium-8 columns content">
    <?= $this->Form->create($post) ?>
    <fieldset>
        <legend><?= __('Add Post') ?></legend>
        <?php
            echo $this->Form->control('slug');
            echo $this->Form->control('title');
            echo $this->Form->control('content');
            echo $this->Form->control('media_id');
            echo $this->Form->control('status');
            echo $this->Form->control('content_type');
            echo $this->Form->control('post_category_id');
            echo $this->Form->control('post_tag_id', ['options' => $postTags]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
