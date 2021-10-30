<?php
 $role = $this->request->getSession()->read('role');
 $allowed_role = array('superadmin','admin','ITH Staff','Content manager');

 if($loggedIn == true && in_array($role, $allowed_role)== true):?>
		<ul class="sidebar-menu" data-widget="tree">
		  <li class="header">MAIN NAVIGATION</li>
		  <li class="treeview">

		    <a href="#">
		      <i class="fa fa-dashboard"></i> <span>Dashboard</span>
		      <span class="pull-right-container">
		        <i class="fa fa-angle-left pull-right"></i>
		      </span>
		    </a>
		    <ul class="treeview-menu">
		      <li><a href="<?php echo $this->Url->build('/'); ?>"><i class="fa fa-circle-o"></i> User View</a></li>

		    </ul>
		  </li>
		  <!-- <li>
		    <a href="<?php echo $this->Url->build(["controller" => "Posts", "action" => "index"]); ?>">
		      <i class="fa fa-clipboard"></i> <span>Posts</span>
		    </a>
		  </li> -->
		  <li class="treeview">
		    <a href="#">
		      <i class="fa fa-clipboard"></i> <span>Posts</span>
		      <span class="pull-right-container">
		        <i class="fa fa-angle-left pull-right"></i>
		      </span>
		    </a>
		    <ul class="treeview-menu">
		      <li><a href="<?php echo $this->Url->build(["controller" => "Posts", "action" => "index"]); ?>"><i class="fa fa-circle-o"></i>All Posts</a></li>
		      <li><a href="<?php echo $this->Url->build(["controller" => "Posts", "action" => "add"]); ?>"><i class="fa fa-circle-o"></i>Add New Post</a></li>
		    </ul>
		  </li>
		  <?php if($role=='superadmin'){ ?>
		  <li class="treeview">
		    <a href="#">
		      <i class="fa fa-users"></i> <span>Users</span>
		      <span class="pull-right-container">
		        <i class="fa fa-angle-left pull-right"></i>
		      </span>
		    </a>
		    <ul class="treeview-menu">
				 <li><a href="<?php echo $this->Url->build(["controller" => "Users", "action" => "add"]); ?>"><i class="fa fa-circle-o"></i>Add New User</a></li>
				 <li><a href="<?php echo $this->Url->build(["controller" => "Users", "action" => "index"]); ?>"><i class="fa fa-circle-o"></i>All Users</a></li>
				 <li><a href="<?php echo $this->Url->build(["controller" => "Users", "action" => "premiumIndex"]); ?>"><i class="fa fa-circle-o"></i>Premium Users</a></li>
				</ul>
		  </li>
		  <?php } ?>
		  <?php if($role=='superadmin' || $role=='admin' ){ ?>
		  <li class="treeview">
		    <a href="#">
		      <i class="fa fa-comment"></i> <span>Feedbacks</span>
		      <span class="pull-right-container">
		        <i class="fa fa-angle-left pull-right"></i>
		      </span>
		    </a>
		    <ul class="treeview-menu">
		      <li><a href="<?php echo $this->Url->build(["controller" => "Feedbacks", "action" => "index"]); ?>"><i class="fa fa-circle-o"></i>All Feedbacks</a></li>
		      </ul>
		  </li>
		  <?php } ?>
		  <?php if($role=='superadmin' || $role=='admin' || $role=='ITH Staff'){ ?>
		  <li class="treeview">
		    <a href="#">
              <!-- i class="fa fa-music"></i> <span>Entertainment</span -->
		      <i class="fa fa-music"></i> <span>Media</span>
		      <span class="pull-right-container">
		        <i class="fa fa-angle-left pull-right"></i>
		      </span>
		    </a>
		    <ul class="treeview-menu">
		      <li><a href="<?php echo $this->Url->build(["controller" => "MediaMetas", "action" => "index"]); ?>"><i class="fa fa-circle-o"></i>Video/Audio</a></li>
		      </ul>
		  </li>
		  <?php } ?>
		  <?php if($role=='superadmin' || $role=='admin' ){ ?>
		  <li class="treeview">
		    <a href="#">
		      <i class="fa fa-question-circle"></i> <span>Polls</span>
		      <span class="pull-right-container">
		        <i class="fa fa-angle-left pull-right"></i>
		      </span>
		    </a>
		    <ul class="treeview-menu">
		      <li><a href="<?php echo $this->Url->build(["controller" => "Questions", "action" => "pollQuestions"]); ?>"><i class="fa fa-circle-o"></i>Add Quesiton</a></li>
		      <li><a href="<?php echo $this->Url->build(["controller" => "Questions", "action" => "index"]); ?>"><i class="fa fa-circle-o"></i>Polls Records</a></li>

		    </ul>
		  </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-headphones"></i> <span>ITH Radio</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?php echo $this->Url->build(["controller" => "radioTracks", "action" => "index"]); ?>"><i class="fa fa-circle-o"></i>View Records</a></li>
              <li><a href="<?php echo $this->Url->build(["controller" => "radioTracks", "action" => "add"]); ?>"><i class="fa fa-circle-o"></i>Add Records</a></li>

            </ul>
          </li>
		  <?php } ?>
		</ul>
<?php endif; ?>
