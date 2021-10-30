<input type="hidden" id="csrf" value="<?php echo $csrf;?>">
    <?php
     $counter = 1;
     foreach($finalArray as $key => $value) {
     ?>
     <div>
          <div class="row">
     <input type="hidden" id="mediaid" value="<?php echo $lastmedia;?>">
     <input type="hidden" id="user_id" value="<?php echo $user_id;?>">

        <div class="card">
            <div class="card-title p-l p-t">
            <?php if($value['profilepic'] != null || $value['profilepic'] != '') { ?>
                <img class="img-circle img-thumbnail" src="/files/userData/<?php echo $value['user_id']; ?>/profileImg/<?php echo $value['profilepic']; ?>" width="80" height="80" alt="Avatar">
            <?php } else { ?>
                <img class="img-circle img-thumbnail" src="/files/default-profile.jpg" width="80" height="80" alt="Avatar">
                <?php } ?>
                <span class="label label-default"><b><?php echo $value['name']; ?></b> - <em><?php echo $value['created']; ?></em></span>
            </div>
            <div style="text-align:center">
                <?php  if(strpos($value['media_link'], '.mp3') !== false){ ?>
                    <audio id="player" controls class="audio-player">
                        <source src="/<?php echo $value['media_link']; ?>" type="audio/mp3">
                        Your browser does not support the audio element.
                    </audio>
                    <?php }else{
                    echo $value['media_link'];
                    }
                    ?>
                <!-- <?php echo $value['media_link']; ?> -->
            </div>
             <?php if($value['type'] == '0'){
                        $type = 0;
                        $likeid = 'mlikes_';
                    }
                    else
                    {
                        $type = 1;
                        $likeid = 'likes_';
                    } ?>
            <div class="card-block comments-wrapper">
                <p class="card-text"><?php echo $value['description']; ?></p>

<!--new code for facebook start-->

                <div class="col-lg-6">

                    <div class="fb-share-button" data-href="http://inthehousemusic.com?href=<?php echo $value['id'] ?>" data-layout="button_count"></div>
                </div>
<!--new code for facebook finish-->
<br/>

                <hr style="width:100%;">

                <?php
                        if($value['ratingsFound'] == 0)
                        {?>
                        <div id= "ratingbox_<?php echo $value['id']; ?>_<?php echo $type; ?>">
                        <label>Ratings</label>
                         <div class="rating-box">

                     <?php for($i=1;$i<=5;$i++)
                      { ?>
                        <span id="ratingstart_<?php echo $value['id']; ?>_<?php echo $type; ?>_<?php echo $i; ?>" class="rating-star empty-star" onclick="ratepost(this.id,<?php echo $value['id']; ?>,<?php echo $counter; ?>,<?php echo $type; ?>)"></span>
                <?php }  ?>
                </div></div>
                <?php  } ?>
                <label>Comments</label>

                <div class="previous-comments">
                <?php
                    if(count($value['comments']) != 0)
                    {
                        foreach($value['comments'] as $comments => $commentvalue)
                        { ?>
                            <div class="comments">
                            <?php echo $commentvalue['comment'].' - <span class="label label-default"><b> '.$commentvalue['name'].' </b></span>'; ?></div>
                 <?php  }
                    }
                ?>
                </div>

                <div id="latestcomment_<?php echo $value['id']; ?>_<?php echo $type; ?>"></div>


                <div class="card-text">
                    <div class="form-group">
                        <textarea id="comment_<?php echo $value['id']; ?>_<?php echo $type; ?>" class="form-control"></textarea>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <button onclick="comment(<?php echo $counter; ?>,<?php echo $value['id']; ?>,<?php echo $type; ?>)" class="btn btn-primary">Comment</button></a>
                        </div>
                        <div class="col-lg-6">
                            <a class="btn btn-sm btn-primary-outline pull-right"
                                onclick="addlike(<?php echo $counter; ?>,<?php echo $value['id']; ?>,<?php echo $type; ?>);"><i class="fa fa-thumbs-up"></i> <span id="<?php echo $likeid.$value['id']; ?>"><?php echo $value['count']; ?></span></a>
                            <div id="avg-rating" style="float:right;padding-right:10px;">
                                <?php
                                  for($i=1;$i<=5;$i++)
                                  {

                                    if($i <= $value['ratings'])
                                        $class = 'full-star';
                                    else
                                        $class = 'empty-star';
                                  ?>
                                    <span id="lratingstart_<?php echo $value['id']; ?>_<?php echo $type; ?>_<?php echo $i; ?>" class="rating-star-small <?php echo $class; ?>"></span>
                                <?php } ?>
                            </div>

                            <?php
                            if($mynotifications == 1)
                            {
                                if($type == 1)
                                {
                                    ?>

                                    <button type="submit" class="delete-button d-none" onclick = "delete_post(<?php echo $value['id'] ?>);" value="Delete">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                    <?php
                                }
                                else
                                { ?>

                                    <button  type="submit" class="delete-button d-none" onclick = "delete_media(<?php echo $value['mediameta_id'] ?>);" value="Delete">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>

                              <?php  }
                            } ?>
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
    <?php
    $counter++;
     } ?>

<?php

if(count($finalArray) == 0)
{ ?>

<div style="color:white">Sorry, No Notifications</div>

<?php
}
?>
<?= $this->Html->css('/css/notifications.css') ?>
<?php
if($paginated == 0 && count($finalArray) != 0)
{
?>
<?= $this->Html->script('/js/infiniteload.js') ?>
<?php
}
?>


 <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.4&appId=241110544128";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
