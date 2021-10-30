<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <!-- <h4 class="modal-title">Modal Header</h4> -->
      </div>
      <div class="modal-body">

        <div class="row main">
<div class="panel-heading">
<div class="panel-title text-center">
        <h5 class="title">Login Form</h5> 
</div>
</div>
<div class="main-login main-center">
    <?= $this->Form->create(); ?>

<div class="form-group">
<label for="email" class="cols-sm-2 control-label">Your Email</label>
<div class="cols-sm-10">
<div class="input-group">
<span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
<input type="text" class="form-control" name="email" id="email"  placeholder="Enter your Email" required="" />
</div>
</div>
</div>

<div class="form-group">
<label for="password" class="cols-sm-2 control-label">Password</label>
<div class="cols-sm-10">
<div class="input-group">
        <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
        <input type="password" class="form-control" name="password" id="password"  placeholder="Enter your Password" required="" />
</div>
</div>
</div>

<div class="form-group ">
        <button type="submit" class="btn btn-primary btn-lg btn-block login-button">Login</button>
</div>
    <?= $this->Form->end() ?>

    <div class="login-register">
        <?= $this->Html->link(__('Registration'), ['controller' => 'Users', 'action' => 'add']); ?>
        
         <?= $this->Html->link(__('Forgot Password'), ['controller' => 'Users', 'action' => 'forgotpassword']); ?>      

    </div>

</div>

<br/>
</div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>