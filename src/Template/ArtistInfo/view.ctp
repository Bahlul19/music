<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ArtistInfo $artistInfo
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Artist Info'), ['action' => 'edit', $artistInfo->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Artist Info'), ['action' => 'delete', $artistInfo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $artistInfo->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Artist Info'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Artist Info'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="artistInfo view large-9 medium-8 columns content">
    <h3><?= h($artistInfo->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Other Union') ?></th>
            <td><?= h($artistInfo->other_union) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Music Related Organization') ?></th>
            <td><?= h($artistInfo->music_related_organization) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Record Label') ?></th>
            <td><?= h($artistInfo->record_label) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Management Contract') ?></th>
            <td><?= h($artistInfo->management_contract) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Booking Agency Contract') ?></th>
            <td><?= h($artistInfo->booking_agency_contract) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ArtistName') ?></th>
            <td><?= h($artistInfo->artistName) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('City') ?></th>
            <td><?= h($artistInfo->city) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('RecordLabel') ?></th>
            <td><?= h($artistInfo->recordLabel) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('RecordingsTitle1') ?></th>
            <td><?= h($artistInfo->recordingsTitle1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('RecordingsLabel1') ?></th>
            <td><?= h($artistInfo->recordingsLabel1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('RecordingsTitle2') ?></th>
            <td><?= h($artistInfo->recordingsTitle2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('RecordingsLabel2') ?></th>
            <td><?= h($artistInfo->recordingsLabel2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('RecordingsTitle3') ?></th>
            <td><?= h($artistInfo->recordingsTitle3) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('RecordingsLabel3') ?></th>
            <td><?= h($artistInfo->recordingsLabel3) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('PlayLive') ?></th>
            <td><?= h($artistInfo->playLive) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('HomeRecordSoftware') ?></th>
            <td><?= h($artistInfo->homeRecordSoftware) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('HomeRecordHardware') ?></th>
            <td><?= h($artistInfo->homeRecordHardware) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('PurchaseSoftware') ?></th>
            <td><?= h($artistInfo->purchaseSoftware) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('PurchaseHardware') ?></th>
            <td><?= h($artistInfo->purchaseHardware) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('PurchaseInstruments') ?></th>
            <td><?= h($artistInfo->purchaseInstruments) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Signature') ?></th>
            <td><?= h($artistInfo->signature) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $artistInfo->has('user') ? $this->Html->link($artistInfo->user->id, ['controller' => 'Users', 'action' => 'view', $artistInfo->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($artistInfo->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Performing Right Org') ?></th>
            <td><?= $this->Number->format($artistInfo->performing_right_org) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Publisher With Right Org') ?></th>
            <td><?= $this->Number->format($artistInfo->publisher_with_right_org) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Member Of A Union') ?></th>
            <td><?= $this->Number->format($artistInfo->member_of_a_union) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Genre') ?></th>
            <td><?= $this->Number->format($artistInfo->genre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('NumberOfMembers') ?></th>
            <td><?= $this->Number->format($artistInfo->numberOfMembers) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('State') ?></th>
            <td><?= $this->Number->format($artistInfo->state) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Group Plan') ?></th>
            <td><?= $this->Number->format($artistInfo->group_plan) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('RecordingsDate1') ?></th>
            <td><?= h($artistInfo->recordingsDate1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('RecordingsDate2') ?></th>
            <td><?= h($artistInfo->recordingsDate2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('RecordingsDate3') ?></th>
            <td><?= h($artistInfo->recordingsDate3) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date') ?></th>
            <td><?= h($artistInfo->date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created Date') ?></th>
            <td><?= h($artistInfo->created_date) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Producer') ?></h4>
        <?= $this->Text->autoParagraph(h($artistInfo->producer)); ?>
    </div>
    <div class="row">
        <h4><?= __('History') ?></h4>
        <?= $this->Text->autoParagraph(h($artistInfo->history)); ?>
    </div>
    <div class="row">
        <h4><?= __('Career') ?></h4>
        <?= $this->Text->autoParagraph(h($artistInfo->career)); ?>
    </div>
</div>
