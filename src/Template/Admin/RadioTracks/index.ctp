<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RadioTrack[]|\Cake\Collection\CollectionInterface $radioTracks
 */
?>
<div class="radioTracks index large-9 medium-8 columns content">
    <h3><?= __('Radio Tracks') ?></h3>
    <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped datatable no-footer dataTable">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('active') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($radioTracks as $radioTrack): ?>
            <tr>
                <td><?= $this->Number->format($radioTrack->id) ?></td>
                <td><?= h($radioTrack->title) ?></td>
                <td><?= $radioTrack->has('user') ? $radioTrack->user->first_name.' '.$radioTrack->user->last_name : '' ?></td>
                <td><?= h($radioTrack->created) ?></td>
                <td><?php
                    if($radioTrack->active == 1 )
                        echo 'Yes';
                    else
                        echo 'No';
                    ?></td>
                <td class="actions">
                    <?php if($radioTrack->active == 0) { ?>
                    <?= $this->Form->postLink(__('Activate | '), ['action' => 'updateStatus', $radioTrack->id], ['confirm' => __('Are you sure you want to Set this track for ITH Radio? # {0}?', $radioTrack->id)]) ?>
                    <?php } ?>
                    <?= $this->Html->link(__('Edit | '), ['action' => 'edit', $radioTrack->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $radioTrack->id], ['confirm' => __('Are you sure you want to delete # {0}?', $radioTrack->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
