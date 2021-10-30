<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ArtistInfo $artistInfo
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $artistInfo->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $artistInfo->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Artist Info'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="artistInfo form large-9 medium-8 columns content">
    <?= $this->Form->create($artistInfo) ?>
    <fieldset>
        <legend><?= __('Edit Artist Info') ?></legend>
        <?php
            echo $this->Form->control('performing_right_org');
            echo $this->Form->control('publisher_with_right_org');
            echo $this->Form->control('member_of_a_union');
            echo $this->Form->control('other_union');
            echo $this->Form->control('music_related_organization');
            echo $this->Form->control('genre');
            echo $this->Form->control('record_label');
            echo $this->Form->control('management_contract');
            echo $this->Form->control('booking_agency_contract');
            echo $this->Form->control('artistName');
            echo $this->Form->control('numberOfMembers');
            echo $this->Form->control('city');
            echo $this->Form->control('state');
            echo $this->Form->control('recordLabel');
            echo $this->Form->control('recordingsTitle1');
            echo $this->Form->control('recordingsLabel1');
            echo $this->Form->control('recordingsDate1', ['empty' => true]);
            echo $this->Form->control('recordingsTitle2');
            echo $this->Form->control('recordingsLabel2');
            echo $this->Form->control('recordingsDate2', ['empty' => true]);
            echo $this->Form->control('recordingsTitle3');
            echo $this->Form->control('recordingsLabel3');
            echo $this->Form->control('recordingsDate3', ['empty' => true]);
            echo $this->Form->control('playLive');
            echo $this->Form->control('homeRecordSoftware');
            echo $this->Form->control('homeRecordHardware');
            echo $this->Form->control('purchaseSoftware');
            echo $this->Form->control('purchaseHardware');
            echo $this->Form->control('purchaseInstruments');
            echo $this->Form->control('producer');
            echo $this->Form->control('history');
            echo $this->Form->control('career');
            echo $this->Form->control('group_plan');
            echo $this->Form->control('signature');
            echo $this->Form->control('date', ['empty' => true]);
            echo $this->Form->control('created_date');
            echo $this->Form->control('user_id', ['options' => $users]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
