<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Myprofile $myprofile
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Myprofile'), ['action' => 'edit', $myprofile->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Myprofile'), ['action' => 'delete', $myprofile->id], ['confirm' => __('Are you sure you want to delete # {0}?', $myprofile->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Myprofile'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Myprofile'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="myprofile view large-9 medium-8 columns content">
    <h3><?= h($myprofile->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $myprofile->has('user') ? $this->Html->link($myprofile->user->id, ['controller' => 'Users', 'action' => 'view', $myprofile->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Wall Img Path') ?></th>
            <td><?= h($myprofile->wall_img_path) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Photo Path') ?></th>
            <td><?= h($myprofile->photo_path) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Video') ?></th>
            <td><?= h($myprofile->video) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Music') ?></th>
            <td><?= h($myprofile->music) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($myprofile->id) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('News') ?></h4>
        <?= $this->Text->autoParagraph(h($myprofile->news)); ?>
    </div>
</div>
