<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Myprofile[]|\Cake\Collection\CollectionInterface $myprofile
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Myprofile'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="myprofile index large-9 medium-8 columns content">
    <h3><?= __('Myprofile') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('wall_img_path') ?></th>
                <th scope="col"><?= $this->Paginator->sort('photo_path') ?></th>
                <th scope="col"><?= $this->Paginator->sort('video') ?></th>
                <th scope="col"><?= $this->Paginator->sort('music') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($myprofile as $myprofile): ?>
            <tr>
                <td><?= $this->Number->format($myprofile->id) ?></td>
                <td><?= $myprofile->has('user') ? $this->Html->link($myprofile->user->id, ['controller' => 'Users', 'action' => 'view', $myprofile->user->id]) : '' ?></td>
                <td><?= h($myprofile->wall_img_path) ?></td>
                <td><?= h($myprofile->photo_path) ?></td>
                <td><?= h($myprofile->video) ?></td>
                <td><?= h($myprofile->music) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $myprofile->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $myprofile->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $myprofile->id], ['confirm' => __('Are you sure you want to delete # {0}?', $myprofile->id)]) ?>
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
