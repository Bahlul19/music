<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Profile $profile
 */
?>
<?php //debug($profile); ?>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <?php
   // $profile->dobymd = $profile->dob->format('Y-m-d');
     ?><div class="container my-profile">
                <div class="row profile-head">
                    <div class="col-md-4">
                        <div class="profile-img">
                                <div id='profile-img'>
                                <?php if($profile->media->name!=Null){
                                 ?>
                                    <img src="/files\userData/<?php echo $profile->user_id; ?>\profileImg/<?php echo $profile->media->name; ?>" alt="profile-img"/>
                                <?php } else { ?>
                                <img src="/files/avatar.png" alt="avatar"/>
                                <?php } ?>
                                </div>
                                <div class="file btn btn-lg btn-primary">
                                    Change Photo
                                    <input type="file"  name="medias[name]" class="form-control" id="medias-name" onchange="submitData(<?php Print($profile->media->id); ?>,<?php Print($profile->user->id); ?>)" />

                                </div>
                            </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                                    <h5>
                                        <?= h($profile->user->first_name)?> <?=h($profile->user->last_name)?>
                                    </h5>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Additional data</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2" id="editToSave">
                        <!-- <input type="submit" class="profile-edit-btn" value="Edit Profile" onclick="edit();" /> -->
                        <input type="submit" form="userDataEdit" class="profile-save-btn btn btn-primary" value="Save Profile"/>
                    </div>
                </div>

            <?php //debug($profile); ?>
            <?= $this->Form->create($profile,['id'=>'userDataEdit']) ?>
            <?php echo $this->Form->control('id', ['class' => 'id','type'=>'hidden']);?>

                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-work">
                            <p>WORK LINK</p>
                            <a href="">Website Link</a><br/>
                            <a href="">Bootsnipp Profile</a><br/>
                            <a href="">Bootply Profile</a>
                            <p>SKILLS</p>
                            <a href="">Web Designer</a><br/>
                            <a href="">Web Developer</a><br/>
                            <a href="">WordPress</a><br/>
                            <a href="">WooCommerce</a><br/>
                            <a href="">PHP, .Net</a><br/>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade in active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <?= $this->Form->control('users.id', array('value'=>$profile->user->id,'type' => 'hidden')); ?>
                                        <div class="row">

                                            <div class="col-md-6">
                                                <label>First Name</label>
                                            </div>

                                            <div class="col-md-6" >
                                                <!-- <p id="f_name"><?= h($profile->user->first_name) ?></p> -->
                                                <p><?= $this->Form->control('users.first_name',array('value'=>$profile->user->first_name,'class'=>'form-control','label' => false)); ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Last Name</label>
                                            </div>
                                            <div class="col-md-6">
                                                <!-- <p><?= h($profile->user->last_name) ?></p> -->
                                                <?= $this->Form->control('users.last_name',array('value'=>$profile->user->last_name,'class'=>'form-control','label' => false)); ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-6">
                                                <!-- <p><?= h($profile->user->email) ?></p> -->
                                                <?= $this->Form->control('users.email',array('value'=>$profile->user->email,'class'=>'form-control','label' => false)); ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Username</label>
                                            </div>
                                            <div class="col-md-6">
                                                <!-- <p><?= h($profile->user->username) ?></p> -->
                                                <?= $this->Form->control('users.username',array('value'=>$profile->user->username,'class'=>'form-control','label' => false)); ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Address</label>
                                            </div>
                                            <div class="col-md-6">
                                                <!-- <p><?= h($profile->user->address) ?></p> -->
                                                <?= $this->Form->control('users.address',array('value'=>$profile->user->address,'class'=>'form-control','label' => false)); ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>City</label>
                                            </div>
                                            <div class="col-md-6">
                                                <!-- <p><?= h($profile->user->city) ?></p> -->
                                                <?= $this->Form->control('users.city',array('value'=>$profile->user->city,'class'=>'form-control','label' => false)); ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Zip Code</label>
                                            </div>
                                            <div class="col-md-6">
                                                <!-- <p><?= h($profile->user->zipcode) ?></p> -->
                                                <?= $this->Form->control('users.zipcode',array('value'=>$profile->user->zipcode,'class'=>'form-control','label' => false)); ?>
                                            </div>
                                        </div>
                                        <!-- <div class="row">
                                            <div class="col-md-6">
                                                <label>Gender</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?= h($profile->user->gender) ?></p>
                                                <?= $this->Form->control('users.gender',array('value'=>$profile->user->gender,'class'=>'form-control','label' => false)); ?>
                                            </div>
                                        </div> -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Contact No.</label>
                                            </div>
                                            <div class="col-md-6">
                                                <!-- <p><?= h($profile->user->mobie_phone) ?></p> -->
                                                <?= $this->Form->control('users.mobie_phone',array('type'=>'number','value'=>$profile->user->mobie_phone,'class'=>'form-control','label' => false)); ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Country</label>
                                            </div>
                                            <div class="col-md-6">
                                                <!-- <p><?= h($profile->user->country->name) ?></p> -->
                                                <?= $this->Form->control('users.country_id', array('options' => $countries , 'value'=>$profile->user->country_id,'class'=>'form-control','label' => false)); ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>State</label>
                                            </div>
                                            <div class="col-md-6">
                                                <!-- <p><?= h($profile->user->state->name) ?></p> -->
                                                <?= $this->Form->control('users.state_id', array('options' => $states, 'value'=>$profile->user->state_id,'class'=>'form-control','label' => false)); ?>
                                            </div>
                                        </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Short Bio</label>
                                            </div>
                                            <div class="col-md-6">
                                                <!-- <p><?= h($profile->short_bio) ?></p> -->
                                                <?= $this->Form->control('short_bio',array('class'=>'form-control','label' => false)); ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Description</label>
                                            </div>
                                            <div class="col-md-6">
                                                <!-- <p><?= h($profile->description) ?></p> -->
                                                <?= $this->Form->control('description',array('class'=>'form-control','label' => false)); ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Interests</label>
                                            </div>
                                            <div class="col-md-6">
                                                <!-- <p><?= h($profile->interest) ?></p> -->
                                                <?= $this->Form->control('interest',array('class'=>'form-control','label' => false)); ?>
                                            </div>
                                        </div>
                                       <div class="row">
                                            <div class="col-md-6">
                                                <label>Date of birth</label>
                                            </div>
                                            <div class="col-md-6">
                                              <!-- <p><?= h($profile->dob) ?></p> -->
                                                <?= $this->Form->control('dob',array('class'=>'form-control','id'=>'datepicker','label' => false,'type'=>'text')); ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Skills</label>
                                            </div>
                                            <div class="col-md-6">
                                                <!-- <p><?= h($profile->skill) ?></p> -->
                                                <?= $this->Form->control('skill',array('class'=>'form-control','label' => false)); ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Help other people find you</label>
                                            </div>
                                            <div class="col-md-6">
                                                <!-- <p><?= h($profile->tag) ?></p> -->
                                                <?= $this->Form->control('tag',array('class'=>'form-control','label' => false)); ?>
                                            </div>
                                        </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?= $this->Form->end() ?>
        </div>
        <?php
echo $this->fetch('scriptBottom');

?>
<script type="text/javascript">

</script>
