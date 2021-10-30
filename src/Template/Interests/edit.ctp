<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Interest $interest
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $interest->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $interest->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Interests'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="interests form large-9 medium-8 columns content">
    <?= $this->Form->create($interest) ?>
    <fieldset>
        <legend><?= __('Edit Interest') ?></legend>
        <?php
            echo $this->Form->control('interest');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
