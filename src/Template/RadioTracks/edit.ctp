<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RadioTrack $radioTrack
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $radioTrack->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $radioTrack->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Radio Tracks'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="radioTracks form large-9 medium-8 columns content">
    <?= $this->Form->create($radioTrack) ?>
    <fieldset>
        <legend><?= __('Edit Radio Track') ?></legend>
        <?php
            echo $this->Form->control('title');
            echo $this->Form->control('track');
            echo $this->Form->control('description');
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('active');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
