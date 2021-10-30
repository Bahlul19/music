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
                                    <!-- <?php echo $RadioTracks->track; ?> -->
                                    <!--iframe src="<?php echo $RadioTracks->track.'?'; ?>" style="height: auto !important;top:unset;"></iframe-->
                                    <audio id="player" controls>
                                      <source src="<?php echo $RadioTracks->track; ?>" type="audio/mp3">
                                    Your browser does not support the audio element.
                                    </audio>
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
                          </div>
                        </div>
                  </a>
                </div>
            </div>
        </div>
