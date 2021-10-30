<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Union $union
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Union'), ['action' => 'edit', $union->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Union'), ['action' => 'delete', $union->id], ['confirm' => __('Are you sure you want to delete # {0}?', $union->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Unions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Union'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="unions view large-9 medium-8 columns content">
    <h3><?= h($union->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($union->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($union->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($union->created) ?></td>
        </tr>
    </table>
</div>
