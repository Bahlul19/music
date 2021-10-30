<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Feedback $feedback
 */
?>
<div class="container">
<div class="row">
<div class="feedbacks view col-lg-8">

    <h4><?= __('Name :') ?>
    <?= h($feedback->name) ?>
        
     <?php 
     if($feedback->status==2){ ?>
        <span class="status">( replied )</span>
    <?php } ?>
    </h4>

    <h4><?= __('Email :') ?>
    <?= h($feedback->email) ?></h4>

    <h4><?= __('Feedback No. :') ?>
    <?= $this->Number->format($feedback->id) ?></h4>
        
    <h4><?= __('Comment') ?></h4>
    <?= $this->Text->autoParagraph(h($feedback->comment)); ?>
    
</div>
<div class="feedbacks reply col-lg-4">
    <?php echo $this->Form->create('UserFeedbackEmail', array('url' => array('controller' => 'feedbacks', 'action' => 'feedbackreply'))); ?>
                    <div class="form-group">
                        <!-- <label>To</label>
                        <input type="email" name="fbRecepient" default="<?= $feedback->email;?>" id="fbRecepient" class="form-control" readonly> -->
                         <?php
                            echo $this->Form->input('fbRecepient', array(
                                'class' => 'form-control',
                                'label' => 'To',
                                'default' => $feedback->email,
                                'readonly' => 'true'
                                )
                            );
                        ?>
                    </div>
                    <div class="form-group">

                        <?php
                            echo $this->Form->input('sender_email', array(
                                'class' => 'form-control',
                                'label' => 'From',
                                'default' => $this->request->getSession()->read('Auth')['User']['email'],
                                'readonly' => 'true'
                                )
                            );
                        ?>
                    </div>
                    <div class="form-group">
                        <?php
                            echo $this->Form->input('subject', array(
                                'class' => 'form-control',
                                'label' => 'Subject',
                                'rows' => 1,
                                'required' => true
                                )
                            );
                        ?>
                    </div>
                    <div class="form-group">
                        <?php
                            echo $this->Form->textarea('content', array(
                                'class' => 'form-control',
                                'label' => 'Content',
                                'rows' => 5,
                                'required' => true
                                )
                            );
                        ?>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <?php
                                echo $this->Form->submit(__('Submit'), array(
                                    'class' => 'btn btn-primary admin-btn',
                                    'div' => false
                                    )
                                );
                            ?>
                        </div>
                    </div>
                    <!-- <input type="hidden" name="fbid" id="fbid" value="" class="form-control"> -->
                     <?php
                            echo $this->Form->input('fbid', array(
                                'type' => 'hidden',
                                'class' => 'form-control',
                                'label' => 'To',
                                'default' => $feedback->id,
                                'readonly' => 'true'
                                )
                            );
                        ?>
                <?php echo $this->Form->end(); ?>
</div>
</div>
</div>
