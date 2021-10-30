    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <!-- /.box -->
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Users Details</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                <table id="admin-premium-index" class="table table-bordered table-striped datatable" cellpadding="0" cellspacing="0" >
        <thead>
            <tr>
                <th class="header-color">Serial No: </th>
                <th class="header-color">First Name</th>
                <th class="header-color">Last Name</th>
                <th class="header-color">Email</th>
                <th class="header-color">Username</th>
                <th class="header-color">City</th>
                <th class="header-color">Zipcode</th>
                <th class="header-color">Mobile Phone</th>
                <th class="header-color">State ID</th>
                <th class="header-color">Country ID</th>
                <th class="header-color">Is Active</th>
                <th class="header-color">Is Featured</th>
                <th class="header-color">User Role</th>
                <th class="header-color actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <?php  if($user->user_roles['0']->role->name == 'prime_member'): ?>
            <tr>
                <td><?= $this->Number->format($user->id) ?></td>
                <td><?= h($user->first_name) ?></td>
                <td><?= h($user->last_name) ?></td>
                <td><?= h($user->email) ?></td>
                <td><?= h($user->username) ?></td>
                <td><?= h($user->city) ?></td>
                <td><?= h($user->zipcode) ?></td>
                <td><?= h($user->mobie_phone) ?></td>
                <td><?= $user->has('state') ? $this->Html->link($user->state->name, ['controller' => 'States', 'action' => 'view', $user->state->id]) : '' ?></td>
                <td><?= $user->has('country') ? $this->Html->link($user->country->name, ['controller' => 'Countries', 'action' => 'view', $user->country->id]) : '' ?></td>

               <td><?= $user->is_active ? __('Yes') : __('No'); ?></td>

               <td><?= $user->is_featured ? __('Yes') : __('No'); ?></td>
                <td>

                <?php 
                if( !empty($user->user_roles))
                {
                    foreach($user->user_roles as $roles)
                    {
                        echo $user->user_roles['0']->role->name;
                    }
                }

                else
                {
                    echo "No roles given yet";
                }

                 ?>

                </td>

                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $user->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'editUserData', $user->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
                </td>
            </tr>

        <?php endif; ?>

            <?php endforeach; ?>

        </tbody>
    </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

<?php $this->start('scriptBottom'); ?>

<?php $this->end(); ?>