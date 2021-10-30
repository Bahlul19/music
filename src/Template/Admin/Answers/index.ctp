<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Answer[]|\Cake\Collection\CollectionInterface $answers
 */
?>

<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <!-- /.box -->
          <div class="box responsive">
            <div class="box-header">
              <h3 class="box-title">Polling Details</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <div class="table-responsive">
            <table id="admin-answers-index" class="table table-bordered table-striped" cellpadding="0" cellspacing="0" >
            <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('Question Name') ?></th>
               
                <th scope="col"><?= $this->Paginator->sort('Question Status') ?></th> 
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Chart Graph') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th> 
            </tr>
            </thead>
            <tbody>
            <?php foreach ($answers as $answer): ?>
            <tr>
                <td><?= $answer->question->question ?></td>
                

                <td>
                    <?php

                    if($answer->question->status == '1')
                    {
                        echo "Enabled";
                    }
                    else
                    {
                        echo "Disabled";
                    }

                    ?>
                    
                </td>         
                 <td><?= h($answer->question->created) ?></td>
                 <td><?= $this->Html->link(__('Chart Details'), ['controller' => 'Polls','action' => 'dynamicChart', $answer->question->id]) ?></td>

                <td class="actions">
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $answer->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $answer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $answer->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
    </div>
</div>
</div>
</div>
</section>

<?= $this->Html->css('../lib/dataTables.bootstrap.min.css', ['block' => 'css']); ?>

<!-- DataTables -->

<?= $this->Html->script('../lib/jquery.dataTables.min.js', ['block' => 'script']); ?>

<?= $this->Html->script('../lib/jquery.dataTables.min.js', ['block' => 'script']); ?>


<?= $this->Html->script('../lib/dataTables.bootstrap.min.js', ['block' => 'script']); ?>

<?php $this->start('scriptBottom'); ?>


<?= $this->Html->script('../js/admin.js'); ?>


<?php $this->end(); ?>
