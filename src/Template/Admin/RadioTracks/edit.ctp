<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RadioTrack $radioTrack
 */
?>
<div class="radioTracks form large-9 medium-8 columns content">
    <?= $this->Form->create($radioTrack) ?>
    <fieldset>
        <legend><?= __('Edit Radio Track') ?></legend>
        <?php
            echo $this->Form->control('title',['required'=>true]);
            echo $this->Form->control('track',['label'=>['text'=>'Embeded Code'],'required'=>true]);
            echo $this->Form->control('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
