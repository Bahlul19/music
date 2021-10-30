
<?php if($userDetails != null ) { ?>
<?= $this->Form->control('csrf',['value'=>$csrf,'id'=>'csrf','type'=>'hidden']); ?>
<div class="container-fluid negetive-margin" id="header">
    <div class="row">
        <div class="col-sm-12 no-padding">
                <?php if($userDetails == null || $userDetails->wall_img_path == null){ ?>
                    <img src='/files/images/bill-band2.jpg' class="img-responsive center-block img-adjust">
                <?php }else{ ?>
                    <img src='<?php echo $userDetails->wall_img_path; ?>' class="img-responsive center-block img-adjust">
                <?php } ?>
                <?php if($FriendsQuery != null){?>
                        <?php if($friendRequestSent == 1){?>
                            <label for="file-wall" class="custom-file-upload btn btn-primary btn-lg login-button align-left" id="change-wall-button">
                               <a href="#"> Friend Request Sent</a>
                            </label>
                        <?php }?>
                        <?php if($showFriend == 1){?>
                            <label for="file-wall" class="custom-file-upload btn btn-primary btn-lg login-button align-left" id="change-wall-button">
                               <a href="/profiles/sendfriendrequest/<?= h($user_id)?>"> Send Friend Request</a>
                            </label>
                        <?php }?>
                        <?php if($showUnfriend == 1){?>
                            <label for="file-wall" class="custom-file-upload btn btn-primary btn-lg login-button align-left" id="change-wall-button">
                               <a href="/profiles/unfriend/<?= h($user_id)?>">Unfriend</a>
                            </label>
                        <?php }?>
                    <?php }else{?>
                        <label for="file-wall" class="custom-file-upload btn btn-primary btn-lg login-button align-left" id="change-wall-button">
                            <a href="/profiles/sendfriendrequest/<?= h($user_id)?>">Send Friend Request</a>
                        </label>
                <?php }?>
        </div>
    </div>

          <div class="row" id="topics">
                <div class="col-sm-4 padding-right">
                    <div class="row">
                        <div class="col-sm-7 col-sm-offset-2 edit-profile-img-row">
                            <div class="edit-profile-img-container">
                                <div class="panel-body">
                                    <?php  if($profileData == null){ ?>
                                        <img src="<?php echo '/files/images/default-profile.jpg' ?>" class="edit-profile-img">
                                    <?php }else { ?>
                                    <img src="<?php echo '/files/userData/'.$user_id.'/profileImg/'.$profileData->name; ?>" class="edit-profile-img">
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3" >
                            <?php if($showUnfriend == 1){?>
                                <a href=""><button>Unfriend</button></a>
                            <?php }?>
                            </div>
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
                        <h1>Get Social</h1>
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

                                   <?php  } ?>
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
                          </div>
                      </div>
                  </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel-heading">
                                <h3>PHOTOS</h3>
                              </div>
                              <?php if($userDetails == null || $userDetails->photo_path == null){ ?>
                                <h4>No Photos Uploaded</h4>
                              <?php }else{ ?>
                              <img src="<?php echo $userDetails->photo_path; ?>" class="img-responsive img-photos">
                              <?php } ?>
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


<?php }

else{

 ?>

        <div class="container-fluid no-padding negetive-margin" id="header">
          <div class="row">
        <div class="col-sm-12 no-padding">
           <img src='/files/images/bill-band2.jpg' class="img-responsive center-block img-adjust">
                           <?php if($FriendsQuery != null){?>
                            <?php if($friendRequestSent == 1){?>
                                <label for="file-wall" class="custom-file-upload btn btn-primary btn-lg login-button align-left-view" id="change-wall-button">
                                   <a href="#"> Friend Request Sent</a>
                                </label>
                            <?php }?>
                            <?php if($showFriend == 1){?>
                                <label for="file-wall" class="custom-file-upload btn btn-primary btn-lg login-button align-left-view" id="change-wall-button">
                                   <a href="/profiles/sendfriendrequest/<?= h($user_id)?>"> Send Friend Request</a>
                                </label>
                            <?php }?>
                            <?php if($showUnfriend == 1){?>
                                <label for="file-wall" class="custom-file-upload btn btn-primary btn-lg login-button align-left-view" id="change-wall-button">
                                   <a href="/profiles/unfriend/<?= h($user_id)?>">Unfriend</a>
                                </label>
                            <?php }?>
                        <?php }else{?>
                            <label for="file-wall" class="custom-file-upload btn btn-primary btn-lg login-button align-left-view" id="change-wall-button">
                                <a href="/profiles/sendfriendrequest/<?= h($user_id)?>">Send Friend Request</a>
                            </label>
                    <?php }?>
        </div>
            <div class="row">
                <div class="col-sm-3" >

                </div>
            </div>
        </div>
          <div class="row" id="topics">
            <div class="col-sm-6">
              <div class="row">
                <div class="col-sm-6">
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
                  <div class="col-sm-6">
                    <div class="panel panel-default shows">
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
              <div class="row">
                <div class="col-sm-12">
                  <div class="panel panel-default msg">
                    <div class="panel-body">
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
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="row">
                <div class="col-sm-6">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h3>VIDEOS</h3>
                    </div>
                    <div class="embed-container">
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>PHOTOS</h3>
                      </div>
                      <img src='/files/images/bill-band2.jpg'  class="img-responsive img-photos">

                    </div>
                </div>
                <div class="col-sm-6">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h3>MUSIC PLAYER</h3>
                    </div>
                    <div class="embed-container">
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h3>NEWS</h3>
                    </div>
                      <img src="/files/images/bill-band.jpg" class="img-responsive">
                    </div>
                </div>
              </div>
            </div>
          </div>

        <?php if($RadioTracks != null){ ?>
          <div class="row">
            <div class="col-sm-12">
            <a href="#!" class="btn btn-primary btn-block" data-toggle="modal" data-target="#radio">
                      <img class="img-responsive center-block" src="/files/images/boombox5.png" alt="boombox">
                    </a>
                    <div class="iframe-container">
    <audio id="player" class="audio-player" controls>
        <source src="/<?php echo $RadioTracks->track; ?>" type="audio/mp3">
        Your browser does not support the audio element.
    </audio>
                            <!-- <?php echo $RadioTracks->track; ?> -->

                    </div>
            </div>
          </div>
         <?php } ?>
        </div>
<?php } ?>
