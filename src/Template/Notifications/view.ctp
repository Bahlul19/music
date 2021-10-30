<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Notification $notification
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Notification'), ['action' => 'edit', $notification->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Notification'), ['action' => 'delete', $notification->id], ['confirm' => __('Are you sure you want to delete # {0}?', $notification->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Notifications'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Notification'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Notification Likes'), ['controller' => 'NotificationLikes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Notification Like'), ['controller' => 'NotificationLikes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="notifications view large-9 medium-8 columns content">
    <h3><?= h($notification->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $notification->has('user') ? $this->Html->link($notification->user->id, ['controller' => 'Users', 'action' => 'view', $notification->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($notification->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($notification->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($notification->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Notification') ?></h4>
        <?= $this->Text->autoParagraph(h($notification->notification)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Notification Likes') ?></h4>
        <?php if (!empty($notification->notification_likes)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Notification Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($notification->notification_likes as $notificationLikes): ?>
            <tr>
                <td><?= h($notificationLikes->id) ?></td>
                <td><?= h($notificationLikes->notification_id) ?></td>
                <td><?= h($notificationLikes->user_id) ?></td>
                <td><?= h($notificationLikes->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'NotificationLikes', 'action' => 'view', $notificationLikes->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'NotificationLikes', 'action' => 'edit', $notificationLikes->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'NotificationLikes', 'action' => 'delete', $notificationLikes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $notificationLikes->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
