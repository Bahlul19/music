<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Organisation $organisation
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Organisation'), ['action' => 'edit', $organisation->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Organisation'), ['action' => 'delete', $organisation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $organisation->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Organisations'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Organisation'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="organisations view large-9 medium-8 columns content">
    <h3><?= h($organisation->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($organisation->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($organisation->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($organisation->created) ?></td>
        </tr>
    </table>
</div>
