<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\GroupPlan[]|\Cake\Collection\CollectionInterface $groupPlan
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Group Plan'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="groupPlan index large-9 medium-8 columns content">
    <h3><?= __('Group Plan') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('plan') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($groupPlan as $groupPlan): ?>
            <tr>
                <td><?= $this->Number->format($groupPlan->id) ?></td>
                <td><?= h($groupPlan->plan) ?></td>
                <td><?= h($groupPlan->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $groupPlan->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $groupPlan->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $groupPlan->id], ['confirm' => __('Are you sure you want to delete # {0}?', $groupPlan->id)]) ?>
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
