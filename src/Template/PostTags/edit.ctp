<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PostTag $postTag
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $postTag->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $postTag->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Post Tags'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Posts'), ['controller' => 'Posts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Post'), ['controller' => 'Posts', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="postTags form large-9 medium-8 columns content">
    <?= $this->Form->create($postTag) ?>
    <fieldset>
        <legend><?= __('Edit Post Tag') ?></legend>
        <?php
            echo $this->Form->control('tag');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
