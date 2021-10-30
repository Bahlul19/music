<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MediaComment $mediaComment
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $mediaComment->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $mediaComment->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Media Comments'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="mediaComments form large-9 medium-8 columns content">
    <?= $this->Form->create($mediaComment) ?>
    <fieldset>
        <legend><?= __('Edit Media Comment') ?></legend>
        <?php
            echo $this->Form->control('media_id');
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('comment');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
