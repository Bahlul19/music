<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProfileTag $profileTag
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Profile Tag'), ['action' => 'edit', $profileTag->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Profile Tag'), ['action' => 'delete', $profileTag->id], ['confirm' => __('Are you sure you want to delete # {0}?', $profileTag->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Profile Tags'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Profile Tag'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="profileTags view large-9 medium-8 columns content">
    <h3><?= h($profileTag->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Tag') ?></th>
            <td><?= h($profileTag->tag) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($profileTag->id) ?></td>
        </tr>
    </table>
</div>
