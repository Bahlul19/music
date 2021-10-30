<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MediaMeta $mediaMeta
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Media Meta'), ['action' => 'edit', $mediaMeta->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Media Meta'), ['action' => 'delete', $mediaMeta->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mediaMeta->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Media Metas'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Media Meta'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Cart Items'), ['controller' => 'CartItems', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cart Item'), ['controller' => 'CartItems', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="mediaMetas view large-9 medium-8 columns content">
    <h3><?= h($mediaMeta->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Tag') ?></th>
            <td><?= h($mediaMeta->tag) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Media Link') ?></th>
            <td><?= h($mediaMeta->media_link) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($mediaMeta->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($mediaMeta->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Media Id') ?></th>
            <td><?= $this->Number->format($mediaMeta->media_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ratings') ?></th>
            <td><?= $this->Number->format($mediaMeta->ratings) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Featured') ?></th>
            <td><?= $this->Number->format($mediaMeta->is_featured) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price') ?></th>
            <td><?= $this->Number->format($mediaMeta->price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($mediaMeta->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($mediaMeta->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Active') ?></th>
            <td><?= $mediaMeta->is_active ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($mediaMeta->description)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Cart Items') ?></h4>
        <?php if (!empty($mediaMeta->cart_items)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Cart Id') ?></th>
                <th scope="col"><?= __('Media Meta Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($mediaMeta->cart_items as $cartItems): ?>
            <tr>
                <td><?= h($cartItems->id) ?></td>
                <td><?= h($cartItems->cart_id) ?></td>
                <td><?= h($cartItems->media_meta_id) ?></td>
                <td><?= h($cartItems->created) ?></td>
                <td><?= h($cartItems->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'CartItems', 'action' => 'view', $cartItems->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'CartItems', 'action' => 'edit', $cartItems->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'CartItems', 'action' => 'delete', $cartItems->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cartItems->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
