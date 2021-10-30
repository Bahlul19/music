<div class="middle-section">
	<div class="container">
	 <div id="blog" class="row"> 
       			
	 			<h4 class="blog-list-title">Feature Artist</h4>

	 			<?php foreach ($users as $key => $user): ?>

          <?php  if($user->user_roles['0']->role->name == 'prime_member' && $user->is_featured == '1'): ?>

                 <div class="col-md-10 blogShort">
                     <h4><?= h($user->first_name).' '.h($user->last_name) ?></h4>
                 </div>
                  
                  <?php endif; ?>

                  <?php endforeach; ?>
                 
               <div class="col-md-12 gap10"></div>
     </div>
</div>
</div>