<div class="row">
        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">

                <div class="loadingContent">

                        <div class="col-xs-12 col-sm-12 col-md-12">
                                <h2 style="text-align:center">Please Sign Up </h2>
                        </div>
                        <?= $this->Form->create($alluser, ['id' => 'formRegistration']) ?>
                        <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">
                                                <label>First Name<span class="mandatory">*</span></label>
                                                <input type="text" name="first_name" id="first_name" class="form-control input-lg" placeholder="First Name" value="<?= isset($this->request->data['first_name'])?$this->request->data['first_name']:'' ?>" tabindex="1" required>
                                        </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                <label>Last Name<span class="mandatory">*</span></label>
                                                        <input type="text" name="last_name" id="last_name" class="form-control input-lg" placeholder="Last Name" value="<?= isset($this->request->data['last_name'])?$this->request->data['last_name']:'' ?>" tabindex="2" required>
                                                </div>
                                </div>
                        </div>

                        <div class="form-group">
                                <label>Email<span class="mandatory">*</span></label>
                                <input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email Address" value="<?= isset($this->request->data['email'])?$this->request->data['email']:'' ?>" tabindex="4" required>
                        </div>


                        <div class="form-group">
                                <label>Username<span class="mandatory">*</span></label>
                                <input type="text" name="username" id="username" class="form-control input-lg" placeholder="Username" value="<?= isset($this->request->data['username'])?$this->request->data['username']:'' ?>" tabindex="4" required>
                        </div>


                        <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">
                                                <label>Password<span class="mandatory">*</span></label>
                                                <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="5" minlength="5" required>
                                        </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">
                                                <label>Confirm Password<span class="mandatory">*</span></label>
                                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-lg" placeholder="Confirm Password" tabindex="6" minlength="5" required>
                                        </div>
                                </div>
                        </div>

                        <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">
                                                <label>Address<span class="mandatory">*</span></label>
                                                <input type="text" name="address" id="address" class="form-control input-lg" placeholder="Address" value="<?= isset($this->request->data['address'])?$this->request->data['address']:'' ?>" tabindex="5" required>
                                        </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">
                                                <label>City<span class="mandatory">*</span></label>
                                                <input type="text" name="city" id="city" class="form-control input-lg" placeholder="City" value="<?= isset($this->request->data['city'])?$this->request->data['city']:'' ?>"tabindex="6" required>
                                        </div>
                                </div>
                        </div>
                        
                        <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">
                                                <label>Zip Code<span class="mandatory">*</span></label>
                                                <input type="number" name="zipcode" id="zipcode" class="form-control input-lg" placeholder="Zip Code" value="<?= isset($this->request->data['zipcode'])?$this->request->data['zipcode']:'' ?>" tabindex="5" required>
                                        </div>
                                </div>
                                <label>Gender<span class="mandatory">*</span></label>
                                <div class="col-xs-12 col-sm-6 col-md-6">

                                        <label class="radio-inline">
                                        <input type="radio" name="gender" value="0" id="genderm" checked>Male
                                        </label>
                                        <label class="radio-inline">
                                        <input type="radio" name="gender" value="1" id="genderf" >Female
                                        </label>
                                </div>
                        </div>

                        <div class="form-group">
                                <label>Mobile<span class="mandatory">*</span></label>
                                <input type="number" name="mobie_phone" id="mobie_phone" class="form-control input-lg" value="<?= isset($this->request->data['mobie_phone'])?$this->request->data['mobie_phone']:'' ?>" placeholder="Mobile" tabindex="4" required>
                        </div>
                        <div class="form-group">
                                <label>Country<span class="mandatory">*</span></label>
                                <?php echo $this->Form->control('country_id', ['type'=>'select','options' => $countries, 'class' => 'form-control countryID','label' => false]); ?>
                        </div>

                        <div class="form-group">
                                <label>State<span class="mandatory">*</span></label>        
                                <?php echo $this->Form->control('state_id', ['type'=>'select','options' => $states, 'class' => 'form-control signup stateID','label' => false]);?>
                        </div>

                        <div class="form-group">
                                <div class="col-lg-4 policy-agree">
                                        <div class="g-recaptcha" data-callback="captcha_onclick" data-sitekey="<?php echo SITE_KEY ?>"></div>
                                        <input type="hidden" name="recaptcha" id="recaptchaValidator" />
                                </div>
                        </div>
                        <br/>

                        <div class="row">
                                <div class="col-xs-12 col-md-12">
                                        <input type="submit" class="btn btn-primary btn-lg btn-block" id="btnRegistration" value="Register">
                                </div>
                        </div>

                        <?php $this->Form->unlockField('g-recaptcha-response'); ?>
                        <?= $this->Form->end() ?>

                        <br/><br/>
                        Signup with
                        <?php 
                        echo $this->Form->postLink(
                                '',
                                [
                                'prefix' => false,
                                'plugin' => 'ADmad/SocialAuth',
                                'controller' => 'Auth',
                                'action' => 'login',
                                'provider' => 'google',
                                '?' => ['redirect' => $this->request->getQuery('redirect')]
                                ],
                                ['class' => 'fa fa-google',]
                        );
                        echo $this->Form->postLink(
                                '',
                                [
                                        'prefix' => false,
                                        'plugin' => 'ADmad/SocialAuth',
                                        'controller' => 'Auth',
                                        'action' => 'login',
                                        'provider' => 'facebook',
                                        '?' => ['redirect' => $this->request->getQuery('redirect')]
                                ],
                                ['class' => 'fa fa-facebook',]
                        );
                        echo $this->Form->postLink(
                        '',
                        [
                                'prefix' => false,
                                'plugin' => 'ADmad/SocialAuth',
                                'controller' => 'Auth',
                                'action' => 'login',
                                'provider' => 'twitter',
                                '?' => ['redirect' => $this->request->getQuery('redirect')]
                        ],
                        ['class' => 'fa fa-twitter',]
                        );
                        ?>
                </div>
        </div>
</div>

<script>
function captcha_onclick(response) {
    document.getElementById('recaptchaValidator').value = grecaptcha.getResponse();
}
$('#formRegistration').validate();
</script>