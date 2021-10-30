<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\GroupPlan $groupPlan
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Group Plan'), ['action' => 'edit', $groupPlan->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Group Plan'), ['action' => 'delete', $groupPlan->id], ['confirm' => __('Are you sure you want to delete # {0}?', $groupPlan->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Group Plan'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Group Plan'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="groupPlan view large-9 medium-8 columns content">
    <h3><?= h($groupPlan->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Plan') ?></th>
            <td><?= h($groupPlan->plan) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($groupPlan->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($groupPlan->created) ?></td>
        </tr>
    </table>
</div>
