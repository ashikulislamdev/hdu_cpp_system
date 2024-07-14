<?php 

    if(!isset($current_user)){die('Unauthorized Error');}
    $current_user_id = $current_user['id'];
    $current_user_type = $current_user['usertype'];

    // total users
    $TotalUsers = "SELECT COUNT(id) AS TotalUsers FROM `admin` WHERE `usertype` != 'developer'";
    if($current_user_type != 'Developer') $TotalUsers .= " AND `user_id` = '$current_user_id'";
    $TotalUsersCount = mysqli_query($conn, $TotalUsers);
    $TotalUsersCount = mysqli_fetch_assoc($TotalUsersCount);
    $TotalUsersCount = $TotalUsersCount['TotalUsers'];

?>


<div class="row">


    <div class="col-md-6 col-xl-3">
        <div class="card bg-c-pink order-card">
            <div class="card-block">
                <h6 class="m-b-20">Users</h6>
                <h2 class="text-right"><i class="bx bx-line-chart f-left"></i><span><?php echo ($TotalUsersCount ?? null) ?></span></h2>
                <!-- <p class="m-b-0">This Month<span class="f-right">6</span></p> -->
            </div>
        </div>
    </div>   

    
</div>