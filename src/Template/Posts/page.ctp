<div class="middle-section">
	<div class="container">
	 <div id="blog" class="row"> 
       			
	 			<h3 class="blog-list-title blogListText"> Blog List </h3>

	 			<?php foreach ($posts as $key => $post): ?>

                 <div class="col-md-12 blogShort" style="color: black">
                  <br/>
                     <h3><?= h($post->title) ?></h3>
                     
                     <article>
                     	<p>
                       <?= $this->Text->autoParagraph(html_entity_decode($post->content)); ?> 
                       <br/>
                       <?php echo $this->Html->image('/files/images/featuredPostImages/'.$post->media['name'], ['alt' => $post->media['name'], 'width' => '500', 'height' => '300']); ?>
                        </p>
                     </article>
                     <?= $this->Html->link(__('Read More'), ['controller' => 'Posts', 'action' => 'postdetails', $post['slug']],['class' => 'btn btn-blog pull-right marginBottom10 readmore']) ?> 
                 </div>
                  

                  <?php endforeach; ?>
                 
               <div class="col-md-12 gap10"></div>
     </div>
</div>
</div>