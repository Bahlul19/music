<div class="container">
    <div class="panel-heading">
        <div class="panel-title text-center">
                <h5 class="title"><?php echo $pageTitle; ?></h5>
        </div>
    </div>


</div>
<div class="container my-page">
   <font color="black"> <?php echo $pageContent; ?></font>
</div>
<div>
    <audio id="player" class="audio-player" controls>
        <source src="/<?php echo $RadioTracks->track; ?>" type="audio/mp3">
        Your browser does not support the audio element.
    </audio>
</div>

