<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\NotificationLike $notificationLike
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Notification Like'), ['action' => 'edit', $notificationLike->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Notification Like'), ['action' => 'delete', $notificationLike->id], ['confirm' => __('Are you sure you want to delete # {0}?', $notificationLike->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Notification Likes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Notification Like'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Notifications'), ['controller' => 'Notifications', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Notification'), ['controller' => 'Notifications', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="notificationLikes view large-9 medium-8 columns content">
    <h3><?= h($notificationLike->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Notification') ?></th>
            <td><?= $notificationLike->has('notification') ? $this->Html->link($notificationLike->notification->id, ['controller' => 'Notifications', 'action' => 'view', $notificationLike->notification->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $notificationLike->has('user') ? $this->Html->link($notificationLike->user->id, ['controller' => 'Users', 'action' => 'view', $notificationLike->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($notificationLike->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($notificationLike->created) ?></td>
        </tr>
    </table>
</div>
