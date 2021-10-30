<div class="container">
<div class="row">
  <?php foreach($medias as $item){ ?>
  <div class="col-sm-8">
    <?php
      echo '<div class="media-item">'.$item->media_metas['0']->media_link.'</div>';
      echo '<div class="media-item-title">'.$item->media_metas['0']->title.'</div>';
      echo '<div class="media-item-description">'.$item->media_metas['0']->description.'</div><br/>';
    ?>
    
    <div>

      	<br/>
  </div>
  <?php } ?>
</div>
</div>
