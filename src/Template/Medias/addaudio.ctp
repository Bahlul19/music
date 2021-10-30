<br/><br/>

<div class="row">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">


            <?= $this->Form->create($media) ?>

                <div class="row">

                   <div class="col-md-6">
                     <label>Audio Upload Medium</label>
                    </div>

                  <!--  <div class="col-md-6">
                       <input type="text" name="name" id="name" class="form-control input-lg" placeholder="Please Insert Name" tabindex="1">
                   </div> -->

                   <div class="col-md-6">

                        <select name="name" class="form-control">
                            <option>Soundcloud</option>
                            <option>Audiomack</option>
                        </select>

                    </div>

               </div>

               <br/>

               <div class="row">

                   <div class="col-md-6">
                     <label>Description</label>
                    </div>

                    <div class="col-md-6">
                       <textarea class="form-control" name="description" rows="3" id="description" placeholder="Please describe about the video" required=""></textarea>
                    </div>

               </div>

                 <br/>

<!--
               <div class="row">

                   <div class="col-md-6">
                     <label>Tag</label>
                    </div>

                    <div class="col-md-6">
                        <input type="text" name="tag" id="tag" class="form-control input-lg" placeholder="Please Insert Tag" tabindex="1" required="">
                    </div>

               </div>

                 <br/>

-->

                <div class="row">

                   <div class="col-md-6">
                     <label>Please Upload Embeded Audio Link</label>
                    </div>

                    <div class="col-md-6">
                         <textarea class="form-control" name="media_link" rows="5" id="media_link" placeholder="Please insert embeded audio link" required=""></textarea>
                    </div>

               </div>

                 <br/>

                 <div class="row">

                   <div class="col-md-6">
                     <label>Title</label>
                    </div>

                    <div class="col-md-6">
                        <input type="text" name="title" id="title" class="form-control input-lg" placeholder="Please insert title" tabindex="1" required="">
                    </div>

               </div>

            <br/>

               <div class="row">
                        <div class="col-md-6">
                        </div>

                        <div class="col-md-6">
                            <button type="submit" class="btn btn-success btn-lg btn-block">Submit</button>
                        </div>
                </div>

                <input type="hidden" name="type" value="2">

                 <?= $this->Form->end() ?>

                 <br/>

</div>
</div>

 