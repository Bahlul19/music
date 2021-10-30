<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\NotificationLike $notificationLike
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $notificationLike->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $notificationLike->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Notification Likes'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Notifications'), ['controller' => 'Notifications', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Notification'), ['controller' => 'Notifications', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="notificationLikes form large-9 medium-8 columns content">
    <?= $this->Form->create($notificationLike) ?>
    <fieldset>
        <legend><?= __('Edit Notification Like') ?></legend>
        <?php
            echo $this->Form->control('notification_id', ['options' => $notifications]);
            echo $this->Form->control('user_id', ['options' => $users]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
