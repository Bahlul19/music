<form action="<?php echo $this->Url->build(['controller' => 'Users', 'action' => 'login']); ?>" method="post">

  <div class="form-group has-feedback">
    <input type="text" class="form-control" placeholder="E-mail" name="email">
    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
  </div>

  <div class="form-group has-feedback">
    <input type="password" class="form-control" placeholder="Password" name="password">
    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
  </div>
  <div class="row">
    <!-- /.col -->
    <div class="col-xs-4">
      <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
    </div>
    <!-- /.col -->
  </div>
</form>
