<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Question[]|\Cake\Collection\CollectionInterface $questions
 */
?>
  <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <!-- /.box -->
          <div class="box responsive">
            <div class="box-header">
              <h3 class="box-title">Questions Details</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="admin-polls-index" class="table table-bordered table-striped datatable" cellpadding="0" cellspacing="0" >
        <thead>
            <tr>
               <th class="header-color">Questions</th>
                <th class="header-color">Status</th>
                <th class="header-color">Created</th>
                <th class="header-color">Chart Graph</th>
                <th class="header-color actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($questions as $question): ?>
            <tr>
                <td><?= h($question->question) ?></td>

                <td>
                <?php
                if($question->status == '1')
                {
                    echo "Enabled";
                }
                else
                {
                    echo "Disabled";
                }
                ?>
                </td>

                <td><?= h($question->created) ?></td>
                 <td><?= $this->Html->link(__('Chart Details'), ['controller' => 'Polls','action' => 'dynamicChart', $question->id]) ?></td>
                <td class="actions">
                    
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $question->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $question->id], ['confirm' => __('Are you sure you want to delete # {0}?', $question->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
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
