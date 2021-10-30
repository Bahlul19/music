<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Post[]|\Cake\Collection\CollectionInterface $posts
 */
?>
<?php //debug($posts);?>
<div class="posts index large-9 medium-8 columns content">
    <h3><?= __('Posts') ?></h3>
    <div class="table-responsive">
    <table id="admin-posts-index" cellpadding="0" class="table table-bordered table-striped datatable" cellspacing="0">
        <thead>
            <tr>
                <th class="header-color">Serial No</th>
                <th class="header-color">Slug</th>
                <th class="header-color">Title</th>
                <th class="header-color">Status</th>
                <th class="header-color">Content type</th>
                <th class="header-color">Created</th>
                <th class="header-color">Modified</th>
                <th class="header-color actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($posts as $post):?>
            <tr>
                <td><?= $this->Number->format($post->id) ?></td>
                <td><?= h($post->slug) ?></td>
                <td><?= h($post->title) ?></td>
                <?php if($post->status==1){ ?>
                    <td>Published</td>
                <?php }
                 else if($post->status==0){ ?>
                    <td>Draft</td>
                <?php } ?>
                <?php if($post->content_type==1){ ?>
                    <td>News</td>
                <?php }
                 else if($post->content_type==0){ ?>
                    <td>Page</td>
                <?php } ?>
                <td><?= h($post->created) ?></td>
                <td><?= h($post->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $post->slug]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $post->slug], ['confirm' => __('Are you sure you want to delete {0}?', $post->title)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
    <!-- <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div> -->
</div>
<!-- DataTables -->
<?= $this->Html->css('../lib/dataTables.bootstrap.min.css', ['block' => 'css']); ?>

<!-- DataTables -->

<?= $this->Html->script('../lib/jquery.dataTables.min.js', ['block' => 'script']); ?>

<?= $this->Html->script('../lib/jquery.dataTables.min.js', ['block' => 'script']); ?>


<?= $this->Html->script('../lib/dataTables.bootstrap.min.js', ['block' => 'script']); ?>

<?php $this->start('scriptBottom'); ?>


<?= $this->Html->script('../js/admin.js'); ?>

<?php $this->end(); ?>