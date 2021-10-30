<div class="row">
    <div class="card new-post-wrapper">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#notification" aria-controls="notification" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Post</a>
            </li>
            <li role="presentation">
                <a href="#video" aria-controls="video" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-facetime-video" aria-hidden="true"></span> Add Video</a>
            </li>
            <li role="presentation">
                <a href="#audio" aria-controls="audio" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-music" aria-hidden="true"></span> Add Audio</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="notification">
                <?= $this->element('hometopfiles/nfadd') ?>
            </div>
            <div role="tabpanel" class="tab-pane" id="video">
                <?= $this->element('hometopfiles/videoadd') ?>
            </div>
            <div role="tabpanel" class="tab-pane" id="audio">
                <?= $this->element('hometopfiles/audioadd') ?>
            </div>
        </div>

    </div>
</div>
<div class="row">
   <div role="tabpanel" class="card padding">
        <h1>Get Social</h1>
    </div>
</div>
