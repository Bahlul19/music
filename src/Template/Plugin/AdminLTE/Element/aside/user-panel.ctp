<?php
$role = $this->request->getSession()->read('role');
$allowed_role = array('superadmin','admin','ITH Staff','Content manager');
     
if($loggedIn == true && in_array($role, $allowed_role)== true):?>
<div class="user-panel">
    <div class="pull-left image">
     <?php if($this->request->getSession()->read('profile_img')!=Null){ ?>
        <img src="/files/userData/<?php echo $user['id']; ?>/profileImg/<?php echo $this->request->getSession()->read('profile_img'); ?>" class = "img-circle" alt="profile-img"/>
    <?php } else { ?>
    <img src="/files/avatar.png" class = "img-circle" alt="avatar"/>
    <?php } ?>

    </div>
    <div class="pull-left info">
        <p><?= h($user['first_name'])." ".h($user['last_name']);  ?></p>
        <a href="#"><i class="fa fa-user-circle-o"></i><?= h($this->request->getSession()->read('role')); ?></a>
    </div>
</div>
<?php endif; ?>