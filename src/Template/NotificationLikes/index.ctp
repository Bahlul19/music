<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\NotificationLike[]|\Cake\Collection\CollectionInterface $notificationLikes
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Notification Like'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Notifications'), ['controller' => 'Notifications', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Notification'), ['controller' => 'Notifications', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="notificationLikes index large-9 medium-8 columns content">
    <h3><?= __('Notification Likes') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('notification_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($notificationLikes as $notificationLike): ?>
            <tr>
                <td><?= $this->Number->format($notificationLike->id) ?></td>
                <td><?= $notificationLike->has('notification') ? $this->Html->link($notificationLike->notification->id, ['controller' => 'Notifications', 'action' => 'view', $notificationLike->notification->id]) : '' ?></td>
                <td><?= $notificationLike->has('user') ? $this->Html->link($notificationLike->user->id, ['controller' => 'Users', 'action' => 'view', $notificationLike->user->id]) : '' ?></td>
                <td><?= h($notificationLike->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $notificationLike->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $notificationLike->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $notificationLike->id], ['confirm' => __('Are you sure you want to delete # {0}?', $notificationLike->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
