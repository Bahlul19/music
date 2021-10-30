<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MediaMeta[]|\Cake\Collection\CollectionInterface $mediaMetas
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Media Meta'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Cart Items'), ['controller' => 'CartItems', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Cart Item'), ['controller' => 'CartItems', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="mediaMetas index large-9 medium-8 columns content">
    <h3><?= __('Media Metas') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('media_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ratings') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_featured') ?></th>
                <th scope="col"><?= $this->Paginator->sort('tag') ?></th>
                <th scope="col"><?= $this->Paginator->sort('media_link') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_active') ?></th>
                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                <th scope="col"><?= $this->Paginator->sort('price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($mediaMetas as $mediaMeta): ?>
            <tr>
                <td><?= $this->Number->format($mediaMeta->id) ?></td>
                <td><?= $this->Number->format($mediaMeta->media_id) ?></td>
                <td><?= $this->Number->format($mediaMeta->ratings) ?></td>
                <td><?= $this->Number->format($mediaMeta->is_featured) ?></td>
                <td><?= h($mediaMeta->tag) ?></td>
                <td><?= h($mediaMeta->media_link) ?></td>
                <td><?= h($mediaMeta->is_active) ?></td>
                <td><?= h($mediaMeta->title) ?></td>
                <td><?= $this->Number->format($mediaMeta->price) ?></td>
                <td><?= h($mediaMeta->created) ?></td>
                <td><?= h($mediaMeta->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $mediaMeta->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $mediaMeta->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $mediaMeta->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mediaMeta->id)]) ?>
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
