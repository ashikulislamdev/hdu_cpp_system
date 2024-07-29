<nav class="pcoded-navbar">
    <div class="sidebar_toggle">
        <a href="#">
            <i class='bx bx-x bx_large' ></i>
        </a>
    </div>
    <div class="pcoded-inner-navbar main-menu">

        <div class="p-1">
            <div class="text-center  pt-2 pb-3 " style="border: 1px solid #d7d7d7;">
                <img src="<?php echo "assets/images/". $current_user['image'] ?? null; ?>" onerror="this.src='assets/images/logo.png'" class="my-2 rounded"  style="box-shadow: 0px 0px 15px #0000005e; max-width: 150px; max-height: 70px;">
                <h6 class="m-0"><?php echo $current_user['name']; ?></h6>
                <span><?php echo $current_user['usertype']; ?></small>
            </div>
        </div>
        
        <!-- <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation">Layout</div> -->
        <ul class="pcoded-item pcoded-left-item">
            <li class="<?php if($views == "dashboard"){echo 'active';} ?>">
                <a href="dashboard.php" class="py-2 d-flex w-100"> <i class='bx bx-home text-20'></i> &nbsp; Dashboard </a>
            </li>
            <?php if($current_user['usertype'] != 'Student'){ ?>
            <li class="<?php if($views == "users"){echo 'active';} ?>">
                <a href="users.php" class="py-2 d-flex w-100"> <i class='bx bx-user text-20'></i> &nbsp; Users </a>
            </li>
            <li class="<?php if($views == "manage_cpp"){echo 'active';} ?>">
                <a href="manage_cpp.php" class="py-2 d-flex w-100"> <i class='bx bx-cog text-20'></i> &nbsp; Manage CPP </a>
            </li>
            <?php } ?>
        </ul>
    </div>
</nav>