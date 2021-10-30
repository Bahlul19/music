<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MediaMeta $mediaMeta
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Media Metas'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Cart Items'), ['controller' => 'CartItems', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Cart Item'), ['controller' => 'CartItems', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="mediaMetas form large-9 medium-8 columns content">
    <?= $this->Form->create($mediaMeta) ?>
    <fieldset>
        <legend><?= __('Add Media Meta') ?></legend>
        <?php
            echo $this->Form->control('media_id');
            echo $this->Form->control('ratings');
            echo $this->Form->control('is_featured');
            echo $this->Form->control('description');
            echo $this->Form->control('tag');
            echo $this->Form->control('media_link');
            echo $this->Form->control('is_active');
            echo $this->Form->control('title');
            echo $this->Form->control('price');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
