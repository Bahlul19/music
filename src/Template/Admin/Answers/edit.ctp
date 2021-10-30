<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Answer $answer
 */
?>

<div class="answers form large-9 medium-8 columns content">
    <?= $this->Form->create($answer) ?>
    <fieldset>
        <legend><?= __('Edit Answer') ?></legend>

        <?php
             echo $this->Form->control('question', array('value' => $answer->question->question));
             echo $this->Form->control('id', array('value' => $answer->question->id));
             echo $this->Form->control('answer'); 
             echo $this->Form->control(
                                   'status', 
                                   array(
                                    'value' => $answer->question->status,
                                    'label' => 'Enable', 'type' => 'checkbox'
                                   )
                               );
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?> 
</div>
