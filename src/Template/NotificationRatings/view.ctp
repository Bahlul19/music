<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\NotificationRating $notificationRating
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Notification Rating'), ['action' => 'edit', $notificationRating->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Notification Rating'), ['action' => 'delete', $notificationRating->id], ['confirm' => __('Are you sure you want to delete # {0}?', $notificationRating->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Notification Ratings'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Notification Rating'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="notificationRatings view large-9 medium-8 columns content">
    <h3><?= h($notificationRating->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $notificationRating->has('user') ? $this->Html->link($notificationRating->user->id, ['controller' => 'Users', 'action' => 'view', $notificationRating->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($notificationRating->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Media Id') ?></th>
            <td><?= $this->Number->format($notificationRating->media_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rating') ?></th>
            <td><?= $this->Number->format($notificationRating->rating) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($notificationRating->created) ?></td>
        </tr>
    </table>
</div>
