<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RadioTrack $radioTrack
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Radio Track'), ['action' => 'edit', $radioTrack->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Radio Track'), ['action' => 'delete', $radioTrack->id], ['confirm' => __('Are you sure you want to delete # {0}?', $radioTrack->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Radio Tracks'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Radio Track'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="radioTracks view large-9 medium-8 columns content">
    <h3><?= h($radioTrack->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($radioTrack->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $radioTrack->has('user') ? $this->Html->link($radioTrack->user->id, ['controller' => 'Users', 'action' => 'view', $radioTrack->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($radioTrack->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Active') ?></th>
            <td><?= $this->Number->format($radioTrack->active) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($radioTrack->created) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Track') ?></h4>
        <?= $this->Text->autoParagraph(h($radioTrack->track)); ?>
    </div>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($radioTrack->description)); ?>
    </div>
</div>
