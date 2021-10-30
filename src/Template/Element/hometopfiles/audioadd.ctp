<div class="hometop-add audio-add">
<?= $this->Form->create('Post', ['url' => '/medias/addaudio','enctype'=>'multipart/form-data','onsubmit'=>'return validateAudio();']) ?>
    <div class="row" style="display: none;">
        <div class="col-md-3">
            <label>Audio Upload Medium</label>
        </div>
        <div class="col-md-9">
            <select name="name" class="form-control dropdown">
                <option>Soundcloud</option>
                <option>Audiomack</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <label>Description</label>
        </div>
        <div class="col-md-9">
            <textarea class="form-control" name="description" rows="3" id="description" placeholder="Please describe about the video" required></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <label>Audio (mp3)</label>
        </div>
        <div class="col-md-9">
            <input type="file" name="audio" id="audio" class="form-control" accept="audio/*">
                <!--textarea class="form-control" name="media_link" rows="5" id="media_link" placeholder="Embed audio link" required></textarea-->
        </div>
    </div>
        <div class="row">
        <div class="col-md-3">
            <label>Title</label>
        </div>
        <div class="col-md-9">
            <input type="text" name="title" id="title" class="form-control input-lg" placeholder="Please insert title" tabindex="1" required>
        </div>
    </div>
    <div class="row">
                <button type="submit" class="btn btn-success">Submit</button>
    </div>
    <input type="hidden" name="type" value="2">
<?= $this->Form->end() ?>
</div>


