<div class="hometop-add video-add">
<?= $this->Form->create('Post', array('url' => '/medias/mediainsert')) ?>
    <div class="row">
        <div class="col-md-3">
            <label>Video Upload Medium</label>
        </div>
        <div class="col-md-9">
            <select name="name" class="form-control dropdown">
                <option>Youtube</option>
                <option>Vimeo</option>
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
            <label>Embed Video Link</label>
        </div>
        <div class="col-md-9">
                <textarea class="form-control" name="media_link" rows="5" id="media_link" placeholder="Embed Video link" required></textarea>
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
    <input type="hidden" name="type" value="1">
<?= $this->Form->end() ?>
</div>
