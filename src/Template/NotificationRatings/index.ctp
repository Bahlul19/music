<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\NotificationRating[]|\Cake\Collection\CollectionInterface $notificationRatings
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Notification Rating'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="notificationRatings index large-9 medium-8 columns content">
    <h3><?= __('Notification Ratings') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('media_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('rating') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($notificationRatings as $notificationRating): ?>
            <tr>
                <td><?= $this->Number->format($notificationRating->id) ?></td>
                <td><?= $this->Number->format($notificationRating->media_id) ?></td>
                <td><?= $notificationRating->has('user') ? $this->Html->link($notificationRating->user->id, ['controller' => 'Users', 'action' => 'view', $notificationRating->user->id]) : '' ?></td>
                <td><?= $this->Number->format($notificationRating->rating) ?></td>
                <td><?= h($notificationRating->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $notificationRating->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $notificationRating->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $notificationRating->id], ['confirm' => __('Are you sure you want to delete # {0}?', $notificationRating->id)]) ?>
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
