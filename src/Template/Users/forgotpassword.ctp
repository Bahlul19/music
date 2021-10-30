<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>


<div class="row main">
<div class="panel-heading">
<div class="panel-title text-center">
        <h5 class="title">Forgot Password</h5>
       
</div>
</div>
<div class="main-login main-center accountforgotpassword">
	
    <?= $this->Form->create(); ?>

<div class="form-group">
<label for="email" class="cols-sm-2 control-label">Your Email</label>
<div class="cols-sm-10">
<div class="input-group">
<span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
<input type="email" class="form-control" name="email" id="email"  placeholder="Enter your Email" required="" />
</div>
</div>
</div>

<div class="form-group ">
        <button type="submit" class="btn btn-primary btn-lg btn-block login-button">Send Email</button>
</div>
    <?= $this->Form->end(); ?>

</div>

<br/><br/><br/>

</div>