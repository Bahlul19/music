<?php
    $user1->profile->tag=json_decode($user1->profile->tag);
    $user1->profile->skill=json_decode($user1->profile->skill);
    $user1->profile->interest=json_decode($user1->profile->interest);
 ?>
<div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                <?= $this->Form->create($user1,array('type' => 'file','id'=>'adminUserDataEdit')) ?>
                <?= $this->Form->control('media.id',array('value'=>$user1->medias['0']['id'],'class'=>'form-control','label' => false)); ?>
                    <div class="card-body">
                        <div class="card-title mb-4">
                            <div class="d-flex justify-content-start">
                                <div class="image-container">
                                    <?php if($user1->medias['0']['name']!=Null){ ?>
                                        <img src="/files/userData/<?php echo $user1->id; ?>/profileImg/<?php echo $user1->medias['0']['name']; ?>" alt="profile-img"/>
                                    <?php } else { ?>
                                    <img src="/files/avatar.png" alt="avatar"/>
                                    <?php } ?>

                                    <div class="middle">
                                        <!-- <input type="button" class="btn btn-secondary" id="btnChangePicture" value="Change" />
                                        <input type="file" style="display: none;" id="profilePicture" name="media[name]" /> -->
                                        Change Photo
                                        <input type="file"  name="media[file]" class="form-control" id="medias-name" accept="image/png, image/jpeg"/>
                                    </div>
                                </div>
                                <div class="userData">
                                    <h2 class="d-block"><?= h($user1->first_name) ?> <?= h($user1->last_name) ?></h2>
                                    <h6 class="d-block"><?= h($user1->email) ?></h6>
                                    <h6 class="d-block"><?= h($user1->user_roles['0']['role']->name) ?></h6>
                                </div>
                                <div class="admin-save-changes">
                                    <input type="submit" form="adminUserDataEdit" class="btn btn-primary d-none" id="adminUserDataSave" onclick = "return validateImage();"value="Save Changes" />
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-lg-12">
                                <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="basicInfo-tab" data-toggle="tab" href="#basicInfo" role="tab" aria-controls="basicInfo" aria-selected="true">Basic Info</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="connectedServices-tab" data-toggle="tab" href="#connectedServices" role="tab" aria-controls="connectedServices" aria-selected="false">Additional Info</a>
                                    </li>
                                </ul>
                                <div class="tab-content ml-1" id="myTabContent">
                                    <div class="tab-pane fade active in" id="basicInfo" role="tabpanel" aria-labelledby="basicInfo-tab">
                                        <div class="user-edit-form-fields">

                                             <div class="col-md-4">
                                                 <label>First Name</label>
                                             </div>

                                             <div class="col-md-8" >
                                                 <!-- <p id="f_name"><?= h($user1->first_name) ?></p> -->
                                                 <p><?= $this->Form->control('first_name',array('class'=>'form-control','label' => false)); ?></p>
                                             </div>
                                         </div>
                                         <div class="user-edit-form-fields">
                                             <div class="col-md-4">
                                                 <label>Last Name</label>
                                             </div>
                                             <div class="col-md-8">
                                                 <!-- <p><?= h($user1->last_name) ?></p> -->
                                                 <?= $this->Form->control('last_name',array('class'=>'form-control','label' => false)); ?>
                                             </div>
                                         </div>
                                         <div class="user-edit-form-fields">
                                             <div class="col-md-4">
                                                 <label>Email</label>
                                             </div>
                                             <div class="col-md-8">
                                                 <!-- <p><?= h($user1->email) ?></p> -->
                                                 <?= $this->Form->control('email',array('class'=>'form-control','label' => false)); ?>
                                             </div>
                                         </div>
                                         <div class="user-edit-form-fields">
                                             <div class="col-md-4">
                                                 <label>Username</label>
                                             </div>
                                             <div class="col-md-8">
                                                 <!-- <p><?= h($username) ?></p> -->
                                                 <?= $this->Form->control('username',array('class'=>'form-control','label' => false)); ?>
                                             </div>
                                         </div>
                                         <div class="user-edit-form-fields">
                                             <div class="col-md-4">
                                                 <label>Address</label>
                                             </div>
                                             <div class="col-md-8">
                                                 <!-- <p><?= h($user1->address) ?></p> -->
                                                 <?= $this->Form->control('address',array('class'=>'form-control','label' => false)); ?>
                                             </div>
                                         </div>
                                         <div class="user-edit-form-fields">
                                             <div class="col-md-4">
                                                 <label>City</label>
                                             </div>
                                             <div class="col-md-8">
                                                 <!-- <p><?= h($user1->city) ?></p> -->
                                                 <?= $this->Form->control('city',array('class'=>'form-control','label' => false)); ?>
                                             </div>
                                         </div>
                                         <div class="user-edit-form-fields">
                                             <div class="col-md-4">
                                                 <label>Zip Code</label>
                                             </div>
                                             <div class="col-md-8">
                                                 <!-- <p><?= h($user1->zipcode) ?></p> -->
                                                 <?= $this->Form->control('zipcode',array('class'=>'form-control','label' => false)); ?>
                                             </div>
                                         </div>
                                          <div class="user-edit-form-fields">
                                             <div class="col-md-4">
                                                 <label>Gender</label>
                                             </div>
                                             <div class="col-md-8">
                                                <?php
                                                $options2= array(
                                                    '0' => 'Male',
                                                    '1' => 'Female',
                                                );
                                                $attributes2 = array(
                                                    'legend' => false,
                                                    'value' => $user1->gender,
                                                );
                                                echo $this->Form->radio('gender', $options2, $attributes2);
                                                ?>
                                             </div>
                                         </div>

                                         <div class="user-edit-form-fields">
                                             <div class="col-md-4">
                                                 <label>Contact No.</label>
                                             </div>
                                             <div class="col-md-8">
                                                 <!-- <p><?= h($user1->mobie_phone) ?></p> -->
                                                 <?= $this->Form->control('mobie_phone',array('value'=>$user1->mobie_phone,'class'=>'form-control','label' => false)); ?>
                                             </div>
                                         </div>
                                         <div class="user-edit-form-fields">
                                             <div class="col-md-4">
                                                 <label>Country</label>
                                             </div>
                                             <div class="col-md-8">
                                                 <!-- <p><?= h($user1->country->name) ?></p> -->
                                                 <?= $this->Form->control('country_id', array('options' => $countries , 'class'=>'form-control countryID','label' => false)); ?>
                                             </div>
                                         </div>
                                         <div class="user-edit-form-fields">
                                             <div class="col-md-4">
                                                 <label>State</label>
                                             </div>
                                             <div class="col-md-8">
                                                 <!-- <p><?= h($user1->state->name) ?></p> -->
                                                 <?= $this->Form->control('state_id', array('options' => $states, 'class'=>'form-control stateID','label' => false)); ?>
                                             </div>
                                         </div>
                                         <div class="user-edit-form-fields">
                                            <div class="col-md-4">
                                                <label>User role</label>
                                            </div>
                                            <div class="col-md-8">
                                            <?= $this->Form->control('user_roles.0.role_id', array('value'=>$user1->user_roles['0']->role_id,'options' => $roles,'class'=>'form-control','label' => false)); ?>
                                            </div>
                                        </div>
                                        <!-- display option feature only for prime members -->
                                        <?php if($user1->user_roles[0]->role_id==4) { ?>         
                                        <div class="user-edit-form-fields">
                                             <div class="col-md-4">
                                                 <label>Feature Artist</label>
                                             </div>
                                             <div class="col-md-8">
                                               <?php echo $this->Form->control(
                                                    'is_featured', [
                                                        'label' => false
                                                    ]
                                                ); 
                                                ?>
                                             </div>
                                         </div>
                                            <?php } ?>


                                    </div>
                                    <div class="tab-pane fade" id="connectedServices" role="tabpanel" aria-labelledby="ConnectedServices-tab">

                                        <!-- <?= $this->Form->control('profile.id',array('value'=>$user1->profile->id,'class'=>'form-control','label' => false)); ?>
                                            -->
                                       <div class="user-edit-form-fields">
                                            <div class="col-md-4">
                                                <label>Short Bio</label>
                                            </div>
                                            <div class="col-md-8">
                                                <!-- <p><?= h($user1->profile->short_bio) ?></p> -->
                                                <?= $this->Form->control('profile.short_bio',array('value'=>$user1->profile->short_bio,'class'=>'form-control','label' => false)); ?>
                                            </div>
                                        </div>
                                        <div class="user-edit-form-fields">
                                            <div class="col-md-4">
                                                <label>Description</label>
                                            </div>
                                            <div class="col-md-8">
                                                <!-- <p><?= h($user1->profile->description) ?></p> -->
                                                <?= $this->Form->control('profile.description',array('value'=>$user1->profile->description,'class'=>'form-control','label' => false)); ?>
                                            </div>
                                        </div>
                                        <div class="user-edit-form-fields">
                                            <div class="col-md-4">
                                                <label>Interests</label>
                                            </div>
                                            <div class="col-md-8">
                                                <!-- <p><?= h($user1->profile->interest) ?></p> -->
                                                <?php //debug($user);
                                                echo $this->Form->control('interests', array(
                                                    'multiple' => 'multiple',
                                                    'type' => 'select',
                                                    'label' => false,
                                                    'value' => $user1->profile->interest,
                                                ));?>
                                                </div>
                                        </div>
                                       <div class="user-edit-form-fields">
                                            <div class="col-md-4">
                                                <label>Date of birth</label>
                                            </div>
                                            <div class="col-md-8">
                                                <!-- <p><?= h($user1->profile->dob) ?></p> -->
                                                <?= $this->Form->control('profile.dob',array('value'=>$user1->profile->dob,'class'=>'form-control datepicker','label' => false,'type'=>'text')); ?>
                                            </div>
                                        </div>
                                        <div class="user-edit-form-fields">
                                            <div class="col-md-4">
                                                <label>Skills</label>
                                            </div>
                                            <div class="col-md-8">
                                                <!-- <p><?= h($user->profile->skill) ?></p> -->
                                                <?php echo $this->Form->control('skills', array(
                                                    'multiple' => 'multiple',
                                                    'type' => 'select',
                                                    'label' => false,
                                                    'value' => $user1->profile->skill,
                                                ));?>

                                               </div>
                                        </div>
                                        <div class="user-edit-form-fields">
                                            <div class="col-md-4">
                                                <label>Help other people find you</label>
                                            </div>
                                            <div class="col-md-8">
                                                <!-- <p><?= h($user1->profile->tag) ?></p> -->
                                                <?php echo $this->Form->control('tags', array(
                                                    'multiple' => 'multiple',
                                                    'type' => 'select',
                                                    'label' => false,
                                                    'value' => $user1->profile->tag,
                                                ));?>
                                                </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>


                    </div>
                    <?= $this->Form->end(); ?>

                </div>
            </div>
        </div>
    </div>
<!-- files of date picker -->
<?php echo $this->Html->script('https://code.jquery.com/jquery-1.12.4.js'); ?>
<?php echo $this->Html->script('https://code.jquery.com/ui/1.12.1/jquery-ui.js'); ?>
<?php echo $this->Html->css('https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css'); ?>
<?php echo $this->Html->script('/js/customAdmin.js'); ?>

