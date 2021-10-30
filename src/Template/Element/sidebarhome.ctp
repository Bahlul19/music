<div class="col-md-3">
        <div class="profile-info">
            <div class="profile-pic">
              <?php if($this->request->getSession()->read('profile_img')!=Null){ ?>
                  <img src="/files/userData/<?php echo $user['id']; ?>/profileImg/<?php echo $this->request->getSession()->read('profile_img'); ?>" class = "img-circle" alt="profile-img"/>
              <?php } else { ?>
              <img src="/files/avatar.png" class = "img-circle" alt="avatar" width="10%"/>
              <?php } ?>
            </div>
            <div class="profile-name">
                <?php echo $this->request->getSession()->read('Auth.User.first_name')." ".$this->request->getSession()->read('Auth.User.last_name'); ?>
            </div>
        </div>
         <div class="user-details-information">
              <p>Name:
               <?php echo $this->request->getSession()->read('Auth.User.first_name');?>
               </p>
               <p>State:
                <?php echo $userStateName; ?>
             </p>
             <p>Country Name:
                <?php echo $userCountryName; ?>
             </p>

             <p>Date Of Birth:
                <?php echo $userDOB; ?>
             </p>

             <p>
                <?= $this->Html->link(__('Friends'),['controller' => 'friends', 'action' => 'viewfriends'], ['class' => 'dropdown-item']) ?>
             </p>
             <p>
                <?= $this->Html->link(__('Friend Request'),['controller' => 'friends', 'action' => 'viewfriendrequest'], ['class' => 'dropdown-item']) ?>
             </p>
        </div>
</div>
