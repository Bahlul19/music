<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MediaComment $mediaComment
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Media Comment'), ['action' => 'edit', $mediaComment->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Media Comment'), ['action' => 'delete', $mediaComment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mediaComment->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Media Comments'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Media Comment'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="mediaComments view large-9 medium-8 columns content">
    <h3><?= h($mediaComment->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $mediaComment->has('user') ? $this->Html->link($mediaComment->user->id, ['controller' => 'Users', 'action' => 'view', $mediaComment->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Comment') ?></th>
            <td><?= h($mediaComment->comment) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($mediaComment->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Media Id') ?></th>
            <td><?= $this->Number->format($mediaComment->media_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($mediaComment->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($mediaComment->modified) ?></td>
        </tr>
    </table>
</div>
