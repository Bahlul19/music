<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MediaTag $mediaTag
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Media Tag'), ['action' => 'edit', $mediaTag->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Media Tag'), ['action' => 'delete', $mediaTag->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mediaTag->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Media Tags'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Media Tag'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="mediaTags view large-9 medium-8 columns content">
    <h3><?= h($mediaTag->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Tag') ?></th>
            <td><?= h($mediaTag->tag) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($mediaTag->id) ?></td>
        </tr>
    </table>
</div>
