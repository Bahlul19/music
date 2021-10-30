<?= $this->Form->control('csrf',['value'=>$csrf,'id'=>'csrf','type'=>'hidden']); ?>
<div id="overlay" class="overlay">
    <div class="overlay-content">
        <div id="video-select">
            <label>Select Options</label>
                <?php
                    echo $this->Form->create('', ['enctype' => 'multipart/form-data','id'=>'form-video','action'=>'changemyprofile']);
                    echo $this->Form->control('', ['id'=>'form-video','name'=>'form-video','type'=>'select','options'=>$MediaMetasvideo]);
                ?>
                 <button onclick="done();" class="btn btn-primary pull-right space">Add</button>&nbsp;&nbsp;
                 <button onclick="cancel();" class="btn btn-primary pull-right space" type="button">Cancel</button>&nbsp;&nbsp;
                <?php echo $this->Form->end(); ?>
        </div>
        <div id="audio-select">
            <label>Select Options</label>
                <?php
                    echo $this->Form->create('', ['enctype' => 'multipart/form-data','id'=>'form-audio','action'=>'changemyprofile']);
                    echo $this->Form->control('', ['id'=>'form-audio','name'=>'form-audio','type'=>'select','options'=>$MediaMetasAudio]);
                ?>
                 <button onclick="done();" class="btn btn-primary pull-right space">Add</button>&nbsp;&nbsp;
                 <button onclick="cancel();" class="btn btn-primary pull-right space" type="button">Cancel</button>&nbsp;&nbsp;
                <?php echo $this->Form->end(); ?>
        </div>

    </div>
</div>
<div class="container-fluid negetive-margin" id="header">
    <div class="row">
        <div class="col-sm-12 no-padding">
            <?php
                echo $this->Form->create('', ['enctype' => 'multipart/form-data','id'=>'form-wall','action'=>'changemyprofile']); ?>
                <?php if($userDetails == null || $userDetails->wall_img_path == null){ ?>
                    <img src='/files/images/bill-band2.jpg' class="img-responsive center-block img-adjust">
                <?php }else{ ?>
                    <img src='<?php echo $userDetails->wall_img_path; ?>' class="img-responsive center-block img-adjust">
                <?php } ?>
                <div class="edit-profile-button">
                <label for="file-wall" class="custom-file-upload btn btn-primary btn-lg login-button full-width" id="change-wall-button">
                    Change Wall
                </label>
                <input id="file-wall" name ="file-wall" type="file" style="display:none;" class="submit-file"/>
                </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>

          <div class="row" id="topics">
                <div class="col-sm-4 padding-right">
                    <?php
                        echo $this->Form->create('', ['enctype' => 'multipart/form-data','id'=>'form-profile-img','action'=>'uploadProfileImage']); ?>
                    <div class="row">
                        <div class="col-sm-7 col-sm-offset-2 edit-profile-img-row">
                            <div class="edit-profile-img-container">
                                <div class="panel-body">
                                    <?php  if($profileData == null){ ?>
                                        <img src="<?php echo '/files/images/default-profile.jpg' ?>" class="edit-profile-img">
                                    <?php }else { ?>
                                    <img src="<?php echo '/files/userData/'.$user_id.'/profileImg/'.$profileData->name; ?>" class="edit-profile-img">
                                    <?php } ?>
                                    <div class="width-extra">
                                        <label for="file-profile-image" class="custom-file-upload btn btn-primary btn-lg login-button full-width" id="change-profile-button">
                                            Change Profile Image
                                        </label>
                                        <input id="file-profile-image" name ="file-profile-image" type="file" style="display:none;" class="submit-file"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php echo $this->Form->end(); ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <?php if($progressBarPercentage < 70 && $disableProgressBar == '') { ?>
                                <!--div class="row progress-bar-card"-->
                                <div class="row no-gutter">
                                    <div class="col-sm-12 card new-post-wrapper progress-bar-card">
                                        <div class="row padding-lr">
                                            <div class="container col-sm-10">
                                             <h4>Profile Completion</h4>
                                            </div>
                                            <div class="col-sm-2">
                                                <span class="white-title" style="float: right;">
                                                    <button type="button" class="close white-title" aria-label="Close">
                                                      <span aria-hidden="true" class="white-title" onclick="closeProgressBar();">&times;</span>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="row padding-lr">
                                            <div class="container col-sm-8">
                                              <div class="progress">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $progressBarPercentage; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $progressBarPercentage; ?>%">

                                                </div>
                                              </div>
                                            </div>
                                            <div class="col-sm-2"><a href="/profiles/profileUpdate"><span class="">Complete </span></a></div>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-default bios">
                                <div class="panel-heading yellow">
                                  <h3>BIO</h3>
                                </div>
                                <div class="panel-body">
                                    <p><?php echo $profileDetails->short_bio; ?></p>
                                    <div class="social-icons text-center">
                                        <a href="#!"><i class="fa fa-facebook-square fa-3x"></i></a>
                                        <a href="#!"><i class="fa fa-twitter-square fa-3x"></i></a>
                                        <a href="#!"><i class="fa fa-google-plus-square fa-3x"></i></a>
                                        <a href="#!"><i class="fa fa-youtube-square fa-3x"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--div class="row">
                        <div class="col-sm-12 ">
                            <div class="panel panel-body">
                                  <div class="form-group">
                                    <label>Message Artist</label>
                                  <div class="input-group">
                                    <input id="btn-input" type="text" class="form-control" placeholder="Type your message here...">
                                    <span class="input-group-btn">
                                      <button type="button" class="btn btn-warning">Send</button>
                                    </span>
                                  </div>
                                </div>
                              </div>
                        </div>
                    </div-->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-default">
                              <div class="panel-heading yellow">
                                <h3>UPCOMMING SHOWS</h3>
                              </div>
                              <div class="panel-body">
                                    <ul>
                                        <li>3/17/17 Whistlers<br> Austin, TX</li>
                                        <li>3/19/17 House Of Blues<br> Austin, TX</li>
                                        <li>3/22/17 House Concert<br> Houston, TX</li>
                                        <li>3/25/17 Jake’s Tavern<br> Nashville, TN</li>
                                        <li>3/26/17 Jake’s Tavern<br> Nashville, TN</li>
                                    </ul>
                              </div>
                          </div>
                        </div>
                    </div>

                </div>

                <div class="col-sm-4 inner-padding panel">
                    <div id="main-div">
                        <div class="home-top">
                            <?= $this->element('hometop') ?>
                        </div>
                    </div>
                    <div id="myProfile">
                        <?php echo $data;?>
                    </div>
                </div>

                <div class="col-sm-4 padding-left">
                    <div class="row">
                        <div class="col-sm-12">
                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <h3>MUSIC PLAYER</h3>
                            </div>
                            <div class="embed-container">

                                <?php
                                 if($userDetails == null || $userDetails->music == null){ ?>
                                    <h4>No Music Uploaded</h4>
                                     <?php }else{ ?>
                                     <audio controls>
                                  <source src="/<?php echo $userDetails->music; ?>" type="audio/ogg">
                                  <source src="/<?php echo $userDetails->music; ?>" type="audio/mpeg">
                                Your browser does not support the audio element.
                                </audio>

                                   <?php  }

                                  ?>
                            </div>
                            <div>
                                <label for="file-audio-trigger" class="custom-file-upload btn btn-primary btn-lg login-button full-width" id="file-audio-trigger-label">
                                        Change Cover Music
                                </label>
                                <input id="file-audio-trigger" name ="file-audio" type="text" style="display:none;" class="submit-file"/>
                            </div>
                          </div>
                      </div>
                  </div>

                    <div class="row">
                        <div class="col-sm-12">
                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <h3>VIDEOS</h3>
                            </div>
                            <div class="embed-container"><?php

                                 if($userDetails == null || $userDetails->video == null){ ?>
                                        <h4>No Video Uploaded</h4>
                                     <?php }else{
                                         echo $userDetails->video;
                                     }

                                  ?>
                            </div>
                                 <div>
                                    <label for="file-video-trigger" class="custom-file-upload btn btn-primary btn-lg login-button full-width"  id="file-video-trigger-label">
                                        Change Cover Video
                                    </label>
                                    <input id="file-video-trigger" name ="file-photo" type="text" style="display:none;" class="submit-file"/>
                                </div>
                          </div>
                      </div>
                  </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel-heading">
                                <h3>PHOTOS</h3>
                              </div>
                              <?php
                                echo $this->Form->create('', ['enctype' => 'multipart/form-data','id'=>'form-photo','action'=>'changemyprofile']); ?>
                              <?php if($userDetails == null || $userDetails->photo_path == null){ ?>
                                <h4>No Photos Uploaded</h4>
                              <?php }else{ ?>
                              <img src="<?php echo $userDetails->photo_path; ?>" class="img-responsive img-photos">
                              <?php } ?>

                                    <div>
                                    <label for="file-photo" class="custom-file-upload btn btn-primary btn-lg login-button full-width"  id="file-photo-trigger-label">
                                        Change Photo
                                    </label>
                                    <input id="file-photo" name ="file-photo" type="file" style="display:none;" class="submit-file"/>
                                    </div>
                                <?php echo $this->Form->end(); ?>
                            </div>
                      </div>
                  </div>

            </div>
          </div>
         <?php if($RadioTracks != null){ ?>
          <!--div class="row">
            <div class="col-sm-12">
            <a href="#!" class="btn btn-primary btn-block" data-toggle="modal" data-target="#radio">
                      <img class="img-responsive center-block" src="/files/images/boombox5.png" alt="boombox">
                    </a>
                    <div class="iframe-container">

                            <?php echo $RadioTracks->track; ?>

                    </div>
            </div>
          </div-->
    <?php } ?>
</div>

