<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UserRole $userRole
 */
?>
<div class="userRoles form large-9 medium-8 columns content">
    <?= $this->Form->create($userADD) ?>
    <fieldset>
        <legend><?= __('Add User') ?></legend>
        <div class="row">

                    <div class="col-md-6">
                        <label>First Name</label>
                    </div>

                    <div class="col-md-6" >
                        <p><?= $this->Form->control('first_name',array('class'=>'form-control','label' => false)); ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Last Name</label>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('last_name',array('class'=>'form-control','label' => false)); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Email</label>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('email',array('class'=>'form-control','label' => false)); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Username</label>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('username',array('class'=>'form-control','label' => false)); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Address</label>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('address',array('class'=>'form-control','label' => false)); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>City</label>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('city',array('class'=>'form-control','label' => false)); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Zip Code</label>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('zipcode',array('class'=>'form-control contact','type' => 'number','label' => false)); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Gender</label>
                    </div>
                    <div class="col-md-6">
                    <?php
                    $options2= array(
                        '0' => 'Male',
                        '1' => 'Female',
                    );
                    echo $this->Form->radio('gender', $options2);
                    ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label>Contact No.</label>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('mobie_phone',array('class'=>'form-control contact','type' => 'number','label' => false)); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Country</label>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('country_id', array('options' => $countries , 'class'=>'form-control countryID','label' => false)); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>State</label>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('state_id', array('options' => $states, 'class'=>'form-control stateID','label' => false)); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>User role</label>
                    </div>
                    <div class="col-md-6">
                    <?= $this->Form->control('role_id', array('options' => $roles,'class'=>'form-control','label' => false)); ?>
                    </div>
                </div>
            </div>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
