<div class="row main">
    <div class="panel-heading">
        <div class="panel-title text-center">
                <h5 class="title">Change Password</h5>
        </div>      
    </div>
</div>
<div class="main-login main-center accountchangepassword">
	
    <?= $this->Form->create(); ?>

        <div class="form-group">
            <label for="oldpassword" class="cols-sm-2 control-label">Old Password</label>
            <div class="cols-sm-10">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                    <?= $this->Form->control('oldpassword',array('class'=>'form-control','label' => false,'placeholder'=>"Enter Old Password",'type'=>'password','required'=>'true')); ?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="newpassword" class="cols-sm-2 control-label">New Password</label>
            <div class="cols-sm-10">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                    <?= $this->Form->control('newpassword',array('class'=>'form-control','label' => false,'placeholder'=>"Enter New Password",'minlength'=>'5','type'=>'password','required'=>'true')); ?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="confirmpassword" class="cols-sm-2 control-label">Confirm New Password</label>
            <div class="cols-sm-10">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                    <?= $this->Form->control('confirmpassword',array('class'=>'form-control','label' => false,'placeholder'=>"Confirm New Password",'minlength'=>'5','type'=>'password','required'=>'true')); ?>
                </div>
            </div>
        </div>
        <div class="form-group ">
                <button type="submit" class="btn btn-primary btn-lg btn-block login-button">Save</button>
        </div>
    <?= $this->Form->end() ?>

</div>

<br/><br/><br/>
                                