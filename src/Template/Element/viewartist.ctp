<div class="search-artists">
 <div class="container-fluid">
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="title">Search Artists</span>
                </div>

                <div class="panel-body">
                <form id="form1">
                  <div class="form-group">
                        <input type="text" class="form-control" id="contact-list-search" onkeyup="searchArtists();" placeholder="Search">
                      </div>
                <span class="radio-element">
                    <input type="hidden" name="search_criteria" value="">
                      <label class="radio-inline" for="search-criteria--artists">
                          <input type="radio" name="search_criteria" value=" Artists" onclick="searchArtists()" id="search-criteria--artists">Artists
                        </label>
                        <label class="radio-inline" for="search-criteria-songs">
                          <input type="radio" name="search_criteria" value="Songs" onclick="searchArtists()" id="search-criteria-songs">Songs
                        </label>
                        <label class="radio-inline" for="search-criteria-videos">
                          <input type="radio" name="search_criteria" value="Videos" onclick="searchArtists()" id="search-criteria-videos">Videos
                        </label>
                        <label class="radio-inline" for="search-criteria-state">
                          <input type="radio" name="search_criteria" value="State" onclick="searchArtists()" id="search-criteria-state">State
                        </label>
                        <label class="radio-inline" for="search-criteria-country">
                          <input type="radio" name="search_criteria" value="Country" onclick="searchArtists()" id="search-criteria-country">Country
                        </label>
                        <!--
                    <?php echo $this->Form->radio(
                        'search_criteria',
                        [
                            ['value' => ' Artists', 'text' => 'Artists','onclick'=>'searchArtists()' ],
                            ['value' => 'Songs', 'text' => 'Songs','onclick'=>'searchArtists()'],
                            ['value' => 'Videos', 'text' => 'Videos','onclick'=>'searchArtists()'],
                           /* ['value' => 'Albums', 'text' => 'Albums','onclick'=>'searchArtists()'],*/
                            ['value' => 'State', 'text' => 'State','onclick'=>'searchArtists()'],
                            ['value' => 'Country', 'text' => 'Country','onclick'=>'searchArtists()'],
                            /*['value' => 'Genre', 'text' => 'Genre','onclick'=>'searchArtists()'],
                            ['value' => 'Insrument', 'text' => 'Insrument','onclick'=>'searchArtists()'],*/
                           /* ['value' => 'Time', 'text' => 'Time','onclick'=>'searchArtists()'],
                            ['value' => 'Format', 'text' => 'Format','onclick'=>'searchArtists()'],*/
                        ]
                    );
                    ?> -->
                 </span>
                 <ul class="list-group" id="contact-list"></ul>
                </form>
            </div>
        </div>
        </div>
    </div>
    </div>
</div>

