<div class="middle-section">
	<div class="container">
	 <div id="blog" class="row"> 
       			
	 			<h3 class="blog-list-title"> Blog List </h3>

                 <div class="col-md-10 blogShort">
                    <?php if($post){ ?>
                       <h3> <?= h($post->title) ?> </h3>
                    
                     <article>
                        <p>
                        <?= $this->Text->autoParagraph(html_entity_decode($post->content)); ?><br/>
                        <?php echo $this->Html->image('/files/images/featuredPostImages/'.$post->media['name'], ['alt' => $post->media['name'], 'width' => '500', 'height' => '300']); ?>   
                        </p>
                     </article>
                     <br/>

                     <div>
                     <label>Comments</label>
                        <br/>
                        
                      <?php 
                      foreach($getQuery as $query)
                      {
                        echo $query->comment. " - ". "<b>" .$query->user['first_name']. " " .$query->user['last_name']."</b>"."<br/>";
                      }

                       ?>

                     </div>

                     <?= $this->Form->create(null,[ 
                    'url' => ['controller' => 'Comments', 'action' => 'addCommentsOnTheBlog']]); ?>
                    <br/>

                    
                    <label>COMMENT</label>

                     <textarea class="form-control" name="comment" rows="6" cols="45" id="comments" placeholder="Please add a comment" required></textarea><br/>

                     <input type="hidden" name="post_id" value="<?php echo $post->id ?>">

                     <button type="submit" class="btn btn-success">Submit</button><br/><br/>

                     <?= $this->Form->end() ?>
                   <?php } else{echo "<p style='font-size:30px; color: orange; font-weight: bold; text-align:center'>404! Post is not found</p>";} ?>

                     <div>

                     </div>
                    
                 </div>   
                 
               <div class="col-md-12 gap10"></div>
     </div>
</div>
</div>


