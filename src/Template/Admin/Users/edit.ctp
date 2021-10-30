<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>

<div class="users form large-9 medium-8 columns content">
   

                           
    <?= $this->Form->create($user, ['enctype' => 'multipart/form-data']) ?>
    <fieldset>
        <legend><?= __('Edit User') ?></legend>
        <?php
            echo $this->Form->control('first_name');
            echo $this->Form->control('last_name');
            echo $this->Form->control('email');
            echo $this->Form->control('username');
            echo $this->Form->control('address');
            echo $this->Form->control('city');
            echo $this->Form->control('zipcode');
            echo $this->Form->control('mobie_phone');
            echo $this->Form->control('state_id', ['options' => $states]);
            echo $this->Form->control('country_id', ['options' => $countries]);
            echo $this->Form->control('is_active');
            debug($roles);
            ?>
            <select name="roles[]" multiple="true" class="form-control">
                           <?php

                               foreach ($roles as $singleTour) {
                                   $selected = (isset($singleTour['id']) && $singleTour['id'] ==  $user->user_roles[0]['role_id']) ? 'selected' : '';
                                   echo "<option value='$singleTour[id]' $selected >$singleTour[name]</option>";
                               }
                           ?>
                       </select>

    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
