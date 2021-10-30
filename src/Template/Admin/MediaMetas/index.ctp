<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MediaMeta[]|\Cake\Collection\CollectionInterface $mediaMetas
 */
?>
  <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <!-- /.box -->
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Media Details</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                <table id="admin-mediameta-index" class="table table-bordered table-striped datatable" cellpadding="0" cellspacing="0" >
        <thead>

            <tr> 
                <th class="header-color">Serial No</th>
                <th class="header-color">User</th>
                <th class="header-color">Title</th>
                <th class="header-color">User Email</th>
                <th class="header-color">Channel</th>
                <th class="header-color">Enabled</th>
                <th class="header-color">Created</th>
                <th class="header-color">Modified</th>
                <th class="header-color actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($mediaMetas as $mediaMeta): ?>
            <tr>
                <td><?= $this->Number->format($mediaMeta->id) ?></td>
                <td><?= h($mediaMeta->media->user->first_name." ".$mediaMeta->media->user->last_name) ?></td>
                <td><?= h($mediaMeta->title) ?></td>
                 <td><?= h($mediaMeta->media->user->email) ?></td>
                <td>
                    <?= h($mediaMeta->media->name); ?>
                </td>
                <td>
                   <?php
                   if($mediaMeta['is_active'] == '1')
                   {
                    echo "<span class='status glyphicon glyphicon-ok'></span>";
                   }
                   ?>
                </td>
                <td><?= h($mediaMeta->created) ?></td>
                <td><?= h($mediaMeta->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $mediaMeta->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $mediaMeta->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mediaMeta->id)]) ?>
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

