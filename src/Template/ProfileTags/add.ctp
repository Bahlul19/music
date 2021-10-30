<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProfileTag $profileTag
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Profile Tags'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="profileTags form large-9 medium-8 columns content">
    <?= $this->Form->create($profileTag) ?>
    <fieldset>
        <legend><?= __('Add Profile Tag') ?></legend>
        <?php
            echo $this->Form->control('tag');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
