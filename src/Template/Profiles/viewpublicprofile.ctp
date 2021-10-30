<font color="black">
<div class="container my-profile">
<hr>
<div class="container bootstrap snippet">
    <div class="row">
        <div class="col-sm-8"><h1><?php echo $profile->user->first_name.' '.$profile->user->last_name; ?></h1></div>
        <div class="col-sm-3" >
        <?php if($showactionbuttons == 1){?>
            <a href="<?php echo $friendreqlink; ?>"><button><?php echo $friendreqtitle; ?></button></a>
            <?php if($hidefollow == 0) { ?>
            <a href="<?php echo $followreqlink; ?>"><button><?php echo $followreqtitle; ?></button></a>
            <?php } ?>
        <?php } elseif($showpendingbuttons == 1) {?>
            <a href="<?php echo $acceptlink;?>"><button>Accept</button></a>
            <a href="<?php echo $rejectlink;?>"><button>Reject</button></a>
        <?php } ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3"><!--left col-->


      <div class="text-center">
            <?php if($profile->media->name!=Null){
                ?>
        <img src="/files/userData/<?php echo $profile->user_id; ?>/profileImg/<?php echo $profile->media->name; ?>" class="avatar img-circle img-thumbnail" alt="profile-img"/>
        <?php } else { ?>
            <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-circle img-thumbnail" alt="avatar">
        <?php } ?>

      </div></hr><br>


          <div class="panel panel-default">
            <div class="panel-heading">Email <i class="fa fa-link fa-1x"></i></div>
            <div class="panel-body"><?php echo $profile->user->email; ?></div>
          </div>


          <ul class="list-group">
            <li class="list-group-item text-muted">Activity <i class="fa fa-dashboard fa-1x"></i></li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Shares</strong></span> 125</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Likes</strong></span> 13</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Posts</strong></span> 37</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Followers</strong></span> 78</li>
          </ul>

          <div class="panel panel-default">
            <div class="panel-heading">Social Media</div>
            <div class="panel-body">
                <i class="fa fa-facebook fa-2x"></i> <i class="fa fa-github fa-2x"></i> <i class="fa fa-twitter fa-2x"></i> <i class="fa fa-pinterest fa-2x"></i> <i class="fa fa-google-plus fa-2x"></i>
            </div>
          </div>

        </div><!--/col-3-->
        <div class="col-sm-8">



          <div class="tab-content">
            <div class="tab-pane active" id="home">
                <hr>
                <div class="row profile-common-details">
                    <?php if($profile->user->first_name && $profile->user->last_name){ ?>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 name">
                            <label ><?php echo $profile->user->first_name." ".$profile->user->last_name; ?></label>
                        </div>
                    <?php }?>
                    
                    <?php if($profile->short_bio){ ?>
                      <div class="form-group">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <label ><h4> Short Bio  : </h4></label><?php echo $profile->short_bio; ?>
                        </div>
                      </div>
                    <?php }?>

                    <?php if($profile->description){ ?>
                      <div class="form-group">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <label ><h4> Description  : </h4></label><?php echo $profile->description; ?>
                        </div>
                      </div>
                    <?php }?>
                </div>
                <?php if($is_friend){ ?>
                  <div class="profilewithdetails">
                  <div class="row profile-details">
                    <?php if($profile->interest){ ?>
                      <div class="form-group">
                         <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                              <label ><h4> Interest  : </h4></label><?php echo $profile->interest; ?>
                          </div>
                      </div>
                    <?php }?>

                    <?php if($profile->dob){ ?>
                      <div class="form-group">
                              <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                              <label ><h4>Date of Birth  : </h4></label><?php echo $profile->dob; ?>
                          </div>
                      </div>
                    <?php }?>

                    <?php if($profile->skill){ ?>
                      <div class="form-group">
                          <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                              <label ><h4> Skills  : </h4></label><?php echo $profile->skill; ?>
                          </div>
                      </div>
                    <?php }?>

                    <?php if($profile->tag){ ?>
                      <div class="form-group">
                          <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <label ><h4> Tag  : </h4></label><?php echo $profile->tag; ?>
                          </div>
                      </div>
                    <?php }?>
                    
                    <div class="form-group">
                          <div class="col-xs-12">
                            <label ><h4>
                              Contact Details:</h4>
                            </label>
                          </div>
                    </div>

                    <?php if($profile->user->country->name){ ?>
                      <div class="form-group">
                          <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <label ><h4> Country  : </h4></label><?php echo $profile->user->country->name; ?>
                          </div>
                      </div>
                    <?php }?>

                    <?php if($profile->user->state->name){ ?>
                      <div class="form-group">
                          <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <label ><h4> State  : </h4></label><?php echo $profile->user->state->name; ?>
                          </div>
                      </div>
                    <?php }?>

                    <?php if($profile->user->city){ ?>
                      <div class="form-group">
                          <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <label ><h4> City  : </h4></label><?php echo $profile->user->city; ?>
                          </div>
                      </div>
                    <?php }?>

                    <?php if($profile->user->address){ ?>
                      <div class="form-group">
                         <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <label ><h4> Address  : </h4></label><?php echo $profile->user->address; ?>
                          </div>
                      </div>
                    <?php }?>

                    <?php if($profile->user->email){ ?>
                      <div class="form-group">
                         <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <label ><h4> Email  : </h4></label><?php echo $profile->user->email; ?>
                          </div>
                      </div>
                    <?php }?>

                    <?php if($profile->user->mobie_phone){ ?>
                      <div class="form-group">
                         <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <label ><h4> Contact No.  : </h4></label><?php echo $profile->user->mobie_phone; ?>
                          </div>
                      </div>
                    </div>
                      <?php if(!empty($my_feed)){ ?>
                        <div class="mynewsfeed">
                          <?php foreach($my_feed as $feed){?>
                              <?php if($feed['notification']){
                                echo "<div class='mynotification'>".$feed['notification']."<div class='date'>".$feed['created']->i18nFormat('MMM dd, yyyy h:mm:ss a z')."</div></div>";
                                }else{  ?>
                              <?php echo "<div class='mymedia'>".$feed['name'];echo $feed['media_metas'][0]->media_link."<div class='date'>".$feed['created']->i18nFormat('MMM dd, yyyy h:mm:ss a z')."</div></div>"; ?>
                              <?php }?>
                          <?php } ?>
                        </div>
                      <?php } ?>
                    <?php }?>
                  </div>
                <?php }else{ ?>
                  <div class="profilewithdetails">
                  <?php if($this->getRequest()->getSession()->read('role')=='prime_member'){ ?>
                    <?php if(!empty($my_feed)){ ?>
                        <div class="mynewsfeed">
                          <?php foreach($my_feed as $feed){?>
                              <?php if($feed['notification']){
                                echo "<div class='mynotification'>".$feed['notification']."<div class='date'>".$feed['created']->i18nFormat('MMM dd, yyyy h:mm:ss a z')."</div></div>";
                                }else{  ?>
                              <?php echo "<div class='mymedia'>".$feed['name'];echo $feed['media_metas'][0]->media_link."<div class='date'>".$feed['created']->i18nFormat('MMM dd, yyyy h:mm:ss a z')."</div></div>"; ?>
                              <?php }?>
                          <?php } ?>
                        </div>
                      <?php } ?>
                    <?php } ?>
                  </div>
                <?php }?>

          </div><!--/tab-content-->

        </div><!--/col-9-->
    </div><!--/row-->
</div>
</font>
<script type="text/javascript">
	function sendFriendRequest(url){
		debugger;
		var res = url.split('\/');
		$.ajax({
			type: "POST",
			url: "/" + res[1] + "/" + res[2],
			data: { id: res[3], profileid: res[4] },
			cache: false,
			beforeSend: function(){
				$('div.friendRequestSpinner').css('display', 'block');
				$('div.friendRequestAlert').css('display', 'none');
			},
			success: function(html){
				$('div.friendRequestSpinner').css('display', 'none');
				$('div.friendRequestAlert').html(html);
				$('div.friendRequestAlert').css('display', 'block');
			},
			error: function(xhr, status, error){
				$('div.friendRequestSpinner').css('display', 'none');
				$('div.friendRequestAlert').css('display', 'none');
				var errorMessage = xhr.status + ': ' + xhr.statusText
				alert('Error - ' + errorMessage);
			}
		});
	}
</script>