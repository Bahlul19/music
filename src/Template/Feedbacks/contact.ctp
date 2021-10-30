<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Feedback $feedback
 */
?>
<div class="row main contact-form">
<div class="panel-heading">

<h3 class="text-center">Contact us</h3><br />

<div class="container">
  <div class="feedbacks col-md-8">
      <?= $this->Form->create($feedback) ?>
        <?= $this->Form->control('fbname',array( 'class'=>'form-control','placeholder'=>'Name...','label' => false,'required' => true)); ?><br /><br />
        <?= $this->Form->control('fbemail',array( 'class'=>'form-control','placeholder'=>'Email...','label' => false,'required' => true,'type' => 'email')); ?><br /><br />
        <?= $this->Form->control('comment',array( 'class'=>'form-control','placeholder'=>'How can we help you?','label' => false,'required' => true,'style'=>'height:150px;'));?>
        <div class="form-group">
          <div class="col-lg-9 policy-agree">
            <div class="g-recaptcha" data-callback="captcha_onclick" data-sitekey="<?php echo SITE_KEY ?>"></div>
            <input type="hidden" name="recaptcha" id="recaptchaValidator" />
          </div>
          <div class="col-lg-3">
          <?= $this->Form->button(__('Send'),['class'=>'contact-form-submit btn btn-primary']) ?>
          </div>
	        </div>
      <?= $this->Form->end() ?>
  </div>
  <div class="col-md-4">
    <b>Customer service:</b> <br />
    Phone: +1 129 209 291<br />
    E-mail: <a href="mailto:support@mysite.com">support@mysite.com</a><br />
    <br /><br />
    <b>Headquarter:</b><br />
    Company Inc, <br />
    Las vegas street 201<br />
    55001 Nevada, USA<br />
    Phone: +1 145 000 101<br />
    <a href="mailto:usa@mysite.com">usa@mysite.com</a><br />


    <br /><br />
    <b>Hong kong:</b><br />
    Company HK Litd, <br />
    25/F.168 Queen<br />
    Wan Chai District, Hong Kong<br />
    Phone: +852 129 209 291<br />
    <a href="mailto:hk@mysite.com">hk@mysite.com</a><br />


  </div>
</div>
</div>
</div>
<script>
function captcha_onclick(response) {
    document.getElementById('recaptchaValidator').value = grecaptcha.getResponse();
}
</script>