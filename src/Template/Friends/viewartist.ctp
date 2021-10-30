 <div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-sm-offset-3 col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading c-list">
                    <span class="title">Search Artists</span>
                </div>

                <div class="row" style="">
                <span class="col-xs-1"></span>
                    <div class="col-xs-10">
                        <div class="input-group c-search">
                            <input type="text" class="form-control" id="contact-list-search" onkeyup="searchArtists();" placeholder="Search">

                        </div>
                    </div>
                <span class="col-xs-1"></span>
                <span class="col-xs-1"></span>
                <span class="col-xs-11" style="padding:20px;"><?php echo $this->Form->radio(
                        'search_criteria',
                        [
                            ['value' => 'Artists', 'text' => 'Artists','onclick'=>'searchArtists()'],
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
                 ?></span>
                <span class="col-xs-1"></span>
                </div>

                <ul class="list-group" id="contact-list">

                </ul>
            </div>
        </div>
    </div>
    </div>

