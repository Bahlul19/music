<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>

<div class="row">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">

            <?= $this->Form->create('User') ?>

               <div class="row">

                   <div class="col-md-6">
                     <label>New Password</label>
                    </div>

                    <div class="col-md-6">
                       <input type="password" class="form-control" name="password" id="password" placeholder="Please Enter the new password" minlength="5" required="">
                    </div>

               </div>
               
               <br/>

               <div class="row">

                   <div class="col-md-6">
                     <label>Confirm Password</label>
                    </div>

                    <div class="col-md-6">
                       <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Please Enter the confirm password" minlength="5" required="">
                    </div>

               </div>

                 <br/>

               <div class="row">
                        <div class="col-md-6">
                        </div>

                        <div class="col-md-6">
                            <button type="submit" class="btn btn-success btn-lg btn-block">Reset Password</button>
                        </div>
                </div>

                 <?= $this->Form->end(); ?>

                 <br/>

</div>
</div>

 