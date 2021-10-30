<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Post $post
 */
?>
<div class="posts form large-9 medium-8 columns content">
    <?= $this->Form->create($post, ['enctype' => 'multipart/form-data']) ?>
    <fieldset>
        <legend><?= __('Edit Post') ?></legend>
        <?php
            echo $this->Form->control('slug');
            echo $this->Form->control('title');
            echo $this->Form->control('content', ['class' => 'form-control ckeditor']);
            echo $this->Form->control('image', ['type' => 'file']);
            echo $this->Html->image('/files/images/featuredPostImages/'.$post->media['name'], ['alt' => $post->media['name'], 'width' => '200', 'height' => '200', 'class' => 'displayImage']);?>
            <div id="image-holder"> </div><?php
            echo $this->Form->control('status', ['options' => ['0' => 'Draft', '1' => 'Published']]);
            echo $this->Form->control('content_type', ['options' => ['0' => 'Pages', '1' => 'News']]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
