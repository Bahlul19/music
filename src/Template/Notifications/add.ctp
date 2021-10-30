<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Notification $notification
 */
?>
<div class="notifications form large-9 medium-8 columns content" style="padding: 40px;">
    <?= $this->Form->create($notification) ?>
    <fieldset>
        <legend style="color:white;"><?= __('Add Notification') ?></legend>
        <?php
            echo $this->Form->control('notification');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
