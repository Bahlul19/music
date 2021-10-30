<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\GroupPlan $groupPlan
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $groupPlan->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $groupPlan->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Group Plan'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="groupPlan form large-9 medium-8 columns content">
    <?= $this->Form->create($groupPlan) ?>
    <fieldset>
        <legend><?= __('Edit Group Plan') ?></legend>
        <?php
            echo $this->Form->control('plan');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
