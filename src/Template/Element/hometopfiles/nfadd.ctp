<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Notification $notification
 */
?>
<div class="notifications form" >
    <?= $this->Form->create('Post', array('url' => '/notifications/add')) ?>
    <fieldset>
        <?php
            echo $this->Form->control('notification',['label'=>false,'required'=>true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
