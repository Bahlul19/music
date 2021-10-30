    <nav class="navbar navbar-inverse navbar-fixed-top">

<!--  <nav class="navbar navbar-inverse"> -->
		  <div class="container-fluid">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <!-- <a class="navbar-brand" href="index.html"> -->
				  <?php
				  	echo $this->Html->link(
						$this->Html->image('/files/images/logo-nav.png', ['alt' => 'MTB']),
						['controller' => 'Users', 'action' => 'main'],
						['escapeTitle' => false, 'title' => 'MTB']
					);
				  ?>
		    </div>
		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      <ul class="nav navbar-nav">

		      </ul>
		      <ul class="nav navbar-nav navbar-right">
			  <?php if(!$auth) { ?>
					<!--li>
						<?= $this->Html->link('MTB', '#', array(
												'data-target' => '#mtb',
												'data-toggle' => 'modal',
											));
					?>
					<?php echo $this->element('mtb'); ?>
					</li-->
				<?php }?>
            	<!--li><?= $this->Html->link(__('Search Artists'),['controller' => 'friends', 'action' => 'viewartist']) ?></li>
            	<!-- li>
				<?= $this->Html->link(__('MY TIMELINE'),['controller' => 'users', 'action' => 'mynotificationsmain']) ?>
                </li -->
				<!-- li><?= $this->Html->link(__('ITH NEWS'),['controller' => 'posts', 'action' => 'page'], ['class' => 'ith-news']) ?></li-->
				<?php if($auth) { ?>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					my account
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?= $this->Html->link(__('my profile'),['controller' => 'profiles', 'action' => 'editMyProfile'], ['class' => 'dropdown-item']) ?>
						<?= $this->Html->link(__('my account'),['controller' => 'profiles', 'action' => 'myaccount'], ['class' => 'dropdown-item']) ?>
						<?= $this->Html->link(__('friend list'),['controller' => 'friends', 'action' => 'viewfriends'], ['class' => 'dropdown-item']) ?>
						<?= $this->Html->link(__('friend request'),['controller' => 'friends', 'action' => 'viewfriendrequest'], ['class' => 'dropdown-item']) ?>
						<?= $this->Html->link(__('change password'),['controller' => 'Users', 'action' => 'changepassword'], ['class' => 'dropdown-item']) ?>
						<?= $this->Html->link(__('logout'),['controller' => 'Users', 'action' => 'logout'], ['class' => 'dropdown-item']) ?>
					</div>
				</li>
				<?php } else { ?>
				<li><?= $this->Html->link(__('Sign Up'),['controller'=>'Users','action'=>'signup']) ?></li>
				<li><a href="#!" class="custom-button" data-toggle="modal" data-target="#myModal">Login</a></li>
				<?php } ?>
				<li><?= $this->Html->link(__('Support'),['controller'=>'Feedbacks','action'=>'contact']) ?></li>

		      </ul>
		    </div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>

		<div>
		<?php
		echo $this->element('/signed-view/login');
		?>
		</div>
