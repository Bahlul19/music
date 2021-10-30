<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MediaComment[]|\Cake\Collection\CollectionInterface $mediaComments
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Media Comment'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="mediaComments index large-9 medium-8 columns content">
    <h3><?= __('Media Comments') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('media_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('comment') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($mediaComments as $mediaComment): ?>
            <tr>
                <td><?= $this->Number->format($mediaComment->id) ?></td>
                <td><?= $this->Number->format($mediaComment->media_id) ?></td>
                <td><?= $mediaComment->has('user') ? $this->Html->link($mediaComment->user->id, ['controller' => 'Users', 'action' => 'view', $mediaComment->user->id]) : '' ?></td>
                <td><?= h($mediaComment->comment) ?></td>
                <td><?= h($mediaComment->created) ?></td>
                <td><?= h($mediaComment->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $mediaComment->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $mediaComment->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $mediaComment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mediaComment->id)]) ?>
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
