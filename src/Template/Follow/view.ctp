<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Follow $follow
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Follow'), ['action' => 'edit', $follow->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Follow'), ['action' => 'delete', $follow->id], ['confirm' => __('Are you sure you want to delete # {0}?', $follow->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Follow'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Follow'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="follow view large-9 medium-8 columns content">
    <h3><?= h($follow->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $follow->has('user') ? $this->Html->link($follow->user->id, ['controller' => 'Users', 'action' => 'view', $follow->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($follow->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Followed User') ?></th>
            <td><?= $this->Number->format($follow->followed_user) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($follow->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($follow->created) ?></td>
        </tr>
    </table>
</div>
