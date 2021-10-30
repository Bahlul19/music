<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ArtistInfo[]|\Cake\Collection\CollectionInterface $artistInfo
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Artist Info'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="artistInfo index large-9 medium-8 columns content">
    <h3><?= __('Artist Info') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('performing_right_org') ?></th>
                <th scope="col"><?= $this->Paginator->sort('publisher_with_right_org') ?></th>
                <th scope="col"><?= $this->Paginator->sort('member_of_a_union') ?></th>
                <th scope="col"><?= $this->Paginator->sort('other_union') ?></th>
                <th scope="col"><?= $this->Paginator->sort('music_related_organization') ?></th>
                <th scope="col"><?= $this->Paginator->sort('genre') ?></th>
                <th scope="col"><?= $this->Paginator->sort('record_label') ?></th>
                <th scope="col"><?= $this->Paginator->sort('management_contract') ?></th>
                <th scope="col"><?= $this->Paginator->sort('booking_agency_contract') ?></th>
                <th scope="col"><?= $this->Paginator->sort('artistName') ?></th>
                <th scope="col"><?= $this->Paginator->sort('numberOfMembers') ?></th>
                <th scope="col"><?= $this->Paginator->sort('city') ?></th>
                <th scope="col"><?= $this->Paginator->sort('state') ?></th>
                <th scope="col"><?= $this->Paginator->sort('recordLabel') ?></th>
                <th scope="col"><?= $this->Paginator->sort('recordingsTitle1') ?></th>
                <th scope="col"><?= $this->Paginator->sort('recordingsLabel1') ?></th>
                <th scope="col"><?= $this->Paginator->sort('recordingsDate1') ?></th>
                <th scope="col"><?= $this->Paginator->sort('recordingsTitle2') ?></th>
                <th scope="col"><?= $this->Paginator->sort('recordingsLabel2') ?></th>
                <th scope="col"><?= $this->Paginator->sort('recordingsDate2') ?></th>
                <th scope="col"><?= $this->Paginator->sort('recordingsTitle3') ?></th>
                <th scope="col"><?= $this->Paginator->sort('recordingsLabel3') ?></th>
                <th scope="col"><?= $this->Paginator->sort('recordingsDate3') ?></th>
                <th scope="col"><?= $this->Paginator->sort('playLive') ?></th>
                <th scope="col"><?= $this->Paginator->sort('homeRecordSoftware') ?></th>
                <th scope="col"><?= $this->Paginator->sort('homeRecordHardware') ?></th>
                <th scope="col"><?= $this->Paginator->sort('purchaseSoftware') ?></th>
                <th scope="col"><?= $this->Paginator->sort('purchaseHardware') ?></th>
                <th scope="col"><?= $this->Paginator->sort('purchaseInstruments') ?></th>
                <th scope="col"><?= $this->Paginator->sort('group_plan') ?></th>
                <th scope="col"><?= $this->Paginator->sort('signature') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($artistInfo as $artistInfo): ?>
            <tr>
                <td><?= $this->Number->format($artistInfo->id) ?></td>
                <td><?= $this->Number->format($artistInfo->performing_right_org) ?></td>
                <td><?= $this->Number->format($artistInfo->publisher_with_right_org) ?></td>
                <td><?= $this->Number->format($artistInfo->member_of_a_union) ?></td>
                <td><?= h($artistInfo->other_union) ?></td>
                <td><?= h($artistInfo->music_related_organization) ?></td>
                <td><?= $this->Number->format($artistInfo->genre) ?></td>
                <td><?= h($artistInfo->record_label) ?></td>
                <td><?= h($artistInfo->management_contract) ?></td>
                <td><?= h($artistInfo->booking_agency_contract) ?></td>
                <td><?= h($artistInfo->artistName) ?></td>
                <td><?= $this->Number->format($artistInfo->numberOfMembers) ?></td>
                <td><?= h($artistInfo->city) ?></td>
                <td><?= $this->Number->format($artistInfo->state) ?></td>
                <td><?= h($artistInfo->recordLabel) ?></td>
                <td><?= h($artistInfo->recordingsTitle1) ?></td>
                <td><?= h($artistInfo->recordingsLabel1) ?></td>
                <td><?= h($artistInfo->recordingsDate1) ?></td>
                <td><?= h($artistInfo->recordingsTitle2) ?></td>
                <td><?= h($artistInfo->recordingsLabel2) ?></td>
                <td><?= h($artistInfo->recordingsDate2) ?></td>
                <td><?= h($artistInfo->recordingsTitle3) ?></td>
                <td><?= h($artistInfo->recordingsLabel3) ?></td>
                <td><?= h($artistInfo->recordingsDate3) ?></td>
                <td><?= h($artistInfo->playLive) ?></td>
                <td><?= h($artistInfo->homeRecordSoftware) ?></td>
                <td><?= h($artistInfo->homeRecordHardware) ?></td>
                <td><?= h($artistInfo->purchaseSoftware) ?></td>
                <td><?= h($artistInfo->purchaseHardware) ?></td>
                <td><?= h($artistInfo->purchaseInstruments) ?></td>
                <td><?= $this->Number->format($artistInfo->group_plan) ?></td>
                <td><?= h($artistInfo->signature) ?></td>
                <td><?= h($artistInfo->date) ?></td>
                <td><?= h($artistInfo->created_date) ?></td>
                <td><?= $artistInfo->has('user') ? $this->Html->link($artistInfo->user->id, ['controller' => 'Users', 'action' => 'view', $artistInfo->user->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $artistInfo->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $artistInfo->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $artistInfo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $artistInfo->id)]) ?>
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
