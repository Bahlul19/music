<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Feedback[]|\Cake\Collection\CollectionInterface $feedbacks
 */
?>

<div class="admin_feedbacks row">
    <h3 class="section_title"><?= __('Feedbacks') ?></h3>
    <div class="table-responsive">
    <table id="admin-feedbacks-index" class="feedbacktable table datatable">
        <thead>
            <tr>
                <th class="header-color"></th>
                <th class="header-color">Serial No:</th>
                <th class="header-color">Name</th>
                <th class="header-color">Email</th>
                <th class="header-color">Comment</th>
                <th class="header-color"></th>
                <th class="header-color actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($feedbacks as $feedback): 
                if ($feedback->status==0) {
                    ?>
                    <script type="text/javascript">
                        
                    </script>
                    <?php
                }
                ?>
            <tr class="fbdata <?php if($feedback->status==0){echo "unread";} ?>">
                <td>
                                    <?php
                                        echo $this->Html->link('', '#', array(
                                            'class' => 'glyphicon glyphicon-envelope sendFeedbackReply',
                                            'data-target' => '#feedbackReplyModel',
                                            'data-toggle' => 'modal',
                                            'data-id' => $feedback->id,
                                            'data-email' => $feedback->email
                                        ));
                                    ?>
                                </td>
                <td><?= $this->Number->format($feedback->id) ?></td>
                <td><?= h($feedback->name) ?></td>
                <td><?= h($feedback->email) ?></td>
                <!-- <td><?= $feedback->has('user') ? $this->Html->link($feedback->user->id, ['controller' => 'Users', 'action' => 'view', $feedback->user->id]) : '' ?></td> -->
                <td><?= h($feedback->comment) ?></td>
                <td><?php if($feedback->status==2){echo "<span class='status glyphicon glyphicon-ok'></span>";} ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $feedback->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $feedback->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $feedback->id], ['confirm' => __('Are you sure you want to delete # {0}?', $feedback->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
</div>
<?php echo $this->element('feedback_reply_modal'); ?>

<!-- DataTables -->
<?= $this->Html->css('../lib/dataTables.bootstrap.min.css', ['block' => 'css']); ?>

<!-- DataTables -->

<?= $this->Html->script('../lib/jquery.dataTables.min.js', ['block' => 'script']); ?>

<?= $this->Html->script('../lib/jquery.dataTables.min.js', ['block' => 'script']); ?>


<?= $this->Html->script('../lib/dataTables.bootstrap.min.js', ['block' => 'script']); ?>

<?php $this->start('scriptBottom'); ?>

<!-- <script>
$(function () {
$('.fbdata<?php echo $feedback->id; ?>').addClass("unread");
});
</script> -->
<?= $this->Html->script('../js/admin.js'); ?>

<?php $this->end(); ?>