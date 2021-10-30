<br/><br/>

<div class="row">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">

  <?= $this->Form->create($pollQuestion); ?>
                <div class="row">

                   <div class="col-md-4">
                     <label>Please Enter Question</label>
                    </div>

                   <div class="col-md-8">

                     <input type="text" name="question" id="question" class="form-control input-lg" placeholder="Add Your Question" tabindex="1" required="">


                    </div>

               </div>

               <br/>

               <div class="row">

                   <div class="col-md-4">
                     <label>Enable/Disable</label>
                    </div>

                    <div class="col-md-8">
                         <div class="checkbox">
                        <!-- <label><input type="checkbox" value="checked">Enable</label> -->
                        <?php 
                        echo $this->Form->control(
                                   'status', [
                                       'label' => 'Enable'
                                   ]
                               );    
                         ?>
                        </div>
                    </div>

               </div>

                 <br/>

                <div class="row">

                  <div class="col-md-4">

                  <label>Please Enter Answers</label>

                  </div>

                  <div class="col-md-8">

                  <div class="field_wrapper">
                  <div>
                      <input type="text" name="answer[]" value=""/ required="">
                      <br/>
                      <input type="text" name="answer[]" value=""/ required="">

                      <a href="javascript:void(0);" class="add_button" title="Add field">&nbsp<b><span class="fa fa-plus"></span></b></a>
                  </div>
                </div> 
              </div>

              </div>
  

            <br/>

               <div class="row">
                        <div class="col-md-4">
                        </div>

                        <div class="col-md-8">
                            <button type="submit" class="btn btn-success btn-lg btn-block">Submit</button>
                        </div>
                </div>

                  <?= $this->Form->end() ?>

                 <br/>

</div>
</div>

 