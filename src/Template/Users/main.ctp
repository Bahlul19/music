<input type="hidden" id="csrf" value="<?php echo $csrf;?>">
 <?php
            if($showNotification == 1)
            {?>
                <div class="container-fluid">
                    <div class="row">
                     <?php echo $topPageBlock; ?>
                    </div>
                    <div class="" id="sub-nav">
                      <div class="row">
                        <div class="col-sm-12">
                              <nav class="navbar navbar-inverse">
                                  <ul class="nav navbar-nav navbar-left">
                                    <li><a href="/DynamicPage/displaypage/flashbacks">FLASHBACKS</a></li>
                                <li><a href="/DynamicPage/displaypage/desert-island-lists">DESERT ISLAND LISTS</a></li>
                                <li><a href="/DynamicPage/displaypage/living-in-the-house">LIVING IN THE HOUSE</a></li>
                                <li><a href="/DynamicPage/displaypage/r-r-hall-of-shame">R&R HALL OF SHAME</a></li>
                                <li><a href="/DynamicPage/displaypage/gear-heads">GEAR HEADS</a></li>
                                <li><a href="/DynamicPage/displaypage/more">MORE...</a></li>
                                  </ul>
                              </nav>
                            </div>
                          </div>
                        </div>
                    <div class="row no-gutter">
                        <!-- <?= $this->element('sidebarhome') ?> -->
                        <div id="main-div" class="col-md-3">
                        <div class="home-top">
                        <?= $this->element('hometop') ?>
                        </div>
                        <?php echo $data;?>
                        </div>
                        <div class="col-md-6">
                            <div class="">
                                <?= $this->element('viewartist') ?>
                            </div>
                            <div class="mainpage-center-layout padding-lr">
                                <div class="col-sm-6 chat-title"><a href="/friends/viewfriends"><span class=" white-title" style="float: left;">&nbsp;Friends </span></a></div>
                                <div class="col-sm-6 chat-title white-title"><a href="/friends/viewfriendrequest"><span style="float: right;"class=" white-title">&nbsp;Friend Requests</span></a></div>
                            </div>
                            <div class="padding-lr-high">
                                <?= $this->element('grid') ?>
                            </div>
                        </div>
                       <!--  <?= $this->element('grid') ?> -->
                        <div class="col-md-3 no-padding">
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
                            <div class="chat-app">
                            <?= $this->element('chat') ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }
            else
            { ?>
                    <?php echo $mainpageData; ?>
           <?php } ?>
