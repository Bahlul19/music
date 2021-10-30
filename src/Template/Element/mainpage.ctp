
  <!--main content code-->
		<div class="container-fluid" id="navbar-top">
		  <div class="row no-gutter">
		    <div class="col-sm-3 text-center">
		      <a href="/DynamicPage/displaypage/featured-artist" class="thumbnail yellow">
		        <h3>Featured Artist</h3>
		        <div id="carousel-nav" class="carousel slide" data-ride="carousel">
						  <div class="carousel-inner" role="listbox">
						    <div class="item active">
						      <img src="/files/images/ITHFeaturedartist.jpg" alt="..."  class="img-responsive">
						    </div>
						    <div class="item">
						      <img src="/files/images/ITHFeaturedartist2.jpg" alt="..."  class="img-responsive">
						    </div>
						  </div>
						</div>
				  </a>
				</div>
				<div class="col-sm-3 text-center">
				  <a href="#!" class="thumbnail yellow">
				    <h3>ITH Radio</h3>
				        <div id="carousel-nav" class="carousel slide" data-ride="carousel">
						  <div class="carousel-inner" role="listbox">
						    <div class="item active">
                              <div class="embed-responsive embed-responsive-4by3">
                                <img src="/files/images/boombox3.jpg" alt="..." class="img-responsive">
                                <iframe src="<?php echo $RadioTracks->track.'?'; ?>" id="audio"></iframe>
                                <!--audio id="player" muted autoplay controls>
                                  <source src="<?php echo $RadioTracks->track; ?>" type="audio/mp3">
                                Your browser does not support the audio element.
                                </audio>
                                <embed src="<?php echo $RadioTracks->track; ?>" AutoPlay loop hidden-->
                               </div>
						    </div>
						  </div>
						</div>
				  </a>
				</div>
                <div class="col-sm-3 text-center">
                  <a href="/Posts/page" class="thumbnail yellow">
                    <h3>ITH Spotlight News</h3>
                        <div id="carousel-nav" class="carousel slide" data-ride="carousel">
                          <div class="carousel-inner" role="listbox">
                            <div class="item active">
                              <img src="/files/images/ITHNews.jpg" alt="..."  class="img-responsive">
                            </div>
                            <div class="item">
                              <img src="/files/images/ITHNews2.jpg" alt="..."  class="img-responsive">
                            </div>
                          </div>
                        </div>
                  </a>
                </div>
				<div class="col-sm-3 text-center">
				  <a href="/DynamicPage/displaypage/why-be-in-the-house" class="thumbnail yellow">
				    <h3>Why Be In The House?</h3>
				    <div id="carousel-nav" class="carousel slide" data-ride="carousel">
						  <div class="carousel-inner" role="listbox">
						    <div class="item active">
						      <img src="/files/images/ITHNews2.jpg" alt="..."  class="img-responsive">
						    </div>
						    <!--div class="item">
						      <img src="/files/images/ITHHouseParty2.jpg" alt="..."  class="img-responsive">
						    </div-->
						  </div>
						</div>
				  </a>
				</div>
			</div>
		</div>

    <div class="container-fluid" id="sub-nav">
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

		<div class="container-fluid" id="chat-lg">
		  <div class="row">
	      <div class="col-sm-6" id="grid">
	        <div class="row">
	          <div class="col-sm-3">
	           <a href="#!"><img src="/files/images/grid/ITHAMY.jpg" alt="..." class="img-responsive"></a>
	          </div>
	          <div class="col-sm-3">
	            <a href="#!"><img src="/files/images/grid/ITHFRANK.jpg" alt="..." class="img-responsive"></a>
	          </div>
	          <div class="col-sm-6">
	            <a href="#!"><img src="/files/images/grid/grid-tile-3.jpg" alt="..." class="img-responsive"></a>
	          </div>
	        </div>
	        <div class="row">
	          <div class="col-sm-3">
	           <a href="#!"><img src="/files/images/grid/ITHJOSH.jpg" alt="..." class="img-responsive"></a>
	          </div>
	          <div class="col-sm-6">
	            <a href="#!"><img src="/files/images/grid/grid-tile-5.jpg" alt="..." class="img-responsive"></a>
	          </div>
	          <div class="col-sm-3">
	            <a href="#!"><img src="/files/images/grid/ITHPAUL.jpg" alt="..." class="img-responsive"></a>
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
	      <div class="col-sm-6">
	        <div class="panel panel-primary" id="chat">
            <div class="panel-heading">
              <i class="fa fa-comment" aria-hidden="true"></i> <span>&nbsp;Who’s in the house?</span> <div class="btn-group pull-right"><a class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog" aria-hidden="true"></i></a>
                <ul class="dropdown-menu slidedown">
                  <li><a href="#"><span class="glyphicon glyphicon-refresh">
                  </span>Refresh</a></li>
                  <li><a href="#"><span class="glyphicon glyphicon-ok-sign">
                  </span>Available</a></li>
                  <li><a href="#"><span class="glyphicon glyphicon-remove">
                  </span>Busy</a></li>
                  <li><a href="#"><span class="glyphicon glyphicon-time">
                  </span>Away</a></li>
                  <li class="divider"></li>
                  <li><a href="#"><span class="glyphicon glyphicon-off">
                  </span>Sign Out</a></li>
                </ul>
              </div>
            </div>
            <div class="panel-body">
              <ul class="chat">
                <li class="left clearfix">
                  <span class="chat-img pull-left">
                    <img src="/files/images/maxresdefault2.jpg" alt="User Avatar" class="img-circle img-responsive" />
                  </span>
                  <div class="chat-body clearfix">
                    <div class="header">
                      <strong class="primary-font">Ken Maiuri</strong>
                      <small class="pull-right text-muted"><span class="glyphicon glyphicon-time"></span>12 mins ago</small>
                    </div>
                    <p>List 10 albums that made a lasting impression on you as a teenager<br>
                    INXS – The Swing<br>
                    The Go-Go’s –Talk Show<br>
                    Rush Power Windows… see more</p>
                  </div>
                </li>
                <li class="right clearfix">
                  <span class="chat-img pull-right">
                    <img src="/files/images/event1.jpg" alt="User Avatar" class=" img-responsive img-circle" />
                  </span>
                  <div class="chat-body clearfix">
                    <div class="header">
                      <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>13 mins ago</small>
                      <strong class="pull-right primary-font">Jason Johnson</strong>
                    </div>
                    <p>My Friend Ken’s “10 albums that made an impact on us as a teenager” made me remember how much skin we had in the game, how important bands were to discover out identity. The soundtrack of our lives !! I still love these albums…see more</p>
                  </div>
                </li>
                <li class="left clearfix">
                  <span class="chat-img pull-left">
                      <img src="/files/images/event2.jpg" alt="User Avatar" class="img-responsive img-circle" />
                  </span>
                  <div class="chat-body clearfix">
                    <div class="header">
                      <strong class="primary-font">Dave Duseau</strong> <small class="pull-right text-muted">
                      <span class="glyphicon glyphicon-time"></span>14 mins ago</small>
                    </div>
                    <p>Top 10 – here it is !<br>
                    Bob Dylan - Blood on the tracks<br>
                    U2 – Joshua Tree<br>
                    Marvin Gaye - What’s Going On<br>
                    Led Zeppelin – Led Zeppelin II… see more</p>
                  </div>
                </li>
                <li class="right clearfix">
                  <span class="chat-img pull-right">
                    <img src="http://placehold.it/50/75b36e/fff&text=ME" alt="User Avatar" class="img-circle" />
                  </span>
                  <div class="chat-body clearfix">
                    <div class="header">
                      <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>15 mins ago</small>
                      <strong class="pull-right primary-font">Paul McNamara</strong>
                    </div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.</p>
                  </div>
                </li>
              </ul>
            </div>
            <div class="panel-footer">
              <div class="input-group">
                <input id="btn-input" type="text" class="form-control" placeholder="Type your message here..." />
                <span class="input-group-btn">
                  <button type="button" class="btn btn-warning">Send</button>
                </span>
              </div>
            </div>
	        </div>
			  </div>
		  </div>
		</div>
