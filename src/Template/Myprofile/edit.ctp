<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Myprofile $myprofile
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $myprofile->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $myprofile->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Myprofile'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="myprofile form large-9 medium-8 columns content">
    <?= $this->Form->create($myprofile) ?>
    <fieldset>
        <legend><?= __('Edit Myprofile') ?></legend>
        <?php
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('wall_img_path');
            echo $this->Form->control('photo_path');
            echo $this->Form->control('video');
            echo $this->Form->control('music');
            echo $this->Form->control('news');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
