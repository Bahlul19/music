<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\NotificationComment $notificationComment
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Notification Comment'), ['action' => 'edit', $notificationComment->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Notification Comment'), ['action' => 'delete', $notificationComment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $notificationComment->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Notification Comments'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Notification Comment'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Notifications'), ['controller' => 'Notifications', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Notification'), ['controller' => 'Notifications', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="notificationComments view large-9 medium-8 columns content">
    <h3><?= h($notificationComment->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Notification') ?></th>
            <td><?= $notificationComment->has('notification') ? $this->Html->link($notificationComment->notification->id, ['controller' => 'Notifications', 'action' => 'view', $notificationComment->notification->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $notificationComment->has('user') ? $this->Html->link($notificationComment->user->id, ['controller' => 'Users', 'action' => 'view', $notificationComment->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($notificationComment->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($notificationComment->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($notificationComment->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Comment') ?></h4>
        <?= $this->Text->autoParagraph(h($notificationComment->comment)); ?>
    </div>
</div>
