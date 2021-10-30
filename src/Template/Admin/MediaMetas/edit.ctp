<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MediaMeta $mediaMeta
 */
?>
<div class="mediaMetas form large-9 medium-8 columns content">
    <?= $this->Form->create($mediaMeta) ?>
    <fieldset>
        <legend><?= __('Edit Media Meta') ?></legend>
        <?php
           
            
            echo $this->Form->control('description');
             echo $this->Form->control(
                                    'is_featured',
                                    [
                                       'label' => 'Featured'
                                    ]
                                    );
            echo $this->Form->control('media_link');
            echo $this->Form->control(
                                        'is_active',
                                        [
                                       'label' => 'Approve'
                                   ]);
            echo $this->Form->control('title');
        ?>

    </fieldset>

<div id="mediaupload">
    <?= $mediaMeta['media_link']; ?>
</div>

    <br/>

    <?= $this->Form->button(__('Submit')) ?>

    <?= $this->Form->end() ?>
</div>

