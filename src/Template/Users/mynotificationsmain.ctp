<input type="hidden" id="csrf" value="<?php echo $csrf;?>">
 <?php
            if($showNotification == 1)
            {?>
                <div class="container">
                    <div class="row">
                        <?= $this->element('sidebarhome') ?>
                        <div id="main-div" class="col-md-6">
                        <div class="home-top">
                        <?= $this->element('hometop') ?>
                        </div>
                        
                        <?php echo $data;?>

                        <div class="fb-share-button" data-href="http://inthehousemusic.com" data-layout="button_count"></div>

                        </div>  

                        <div class="col-md-3">
                            <div class="chat-app">
                            <?= $this->element('chat') ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }
            else
            { ?>
                    <?= $this->element('mainpage') ?>
           <?php } ?>

 <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.4&appId=241110544128";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>