<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Question $question
 */
?>
<div class="questions form large-9 medium-8 columns content">
    <?= $this->Form->create($question) ?>
    <fieldset>
        <legend><?= __('Edit Question') ?></legend>
        <?php
          echo $this->Form->control('question');
          foreach($question->answers as $answer)
          {
            ?>
            <input type="hidden" name="answerid[]" value="<?= $answer->id ?>">
            <input type="text" name="answer[]" value="<?= $answer->answer; ?>" required="">
          <?php
          echo "<br/><br/>";
          }
            echo $this->Form->control(
                                   'status', [
                                       'label' => 'Enable'
                                   ]
                               );     
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
