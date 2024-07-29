<?php



    if(!isset($current_user)){die('Unauthorized Error');}

    

    // if the user is developer then show all users
    if($current_user['usertype'] == 'Developer'){
        $usersSql = "SELECT * FROM `users` ORDER BY `id` DESC";
        $runUsersSql = mysqli_query($conn, $usersSql);
        $usersCount = mysqli_num_rows($runUsersSql);
        if($runUsersSql && $usersCount > 0){
            while ($usersRow = mysqli_fetch_assoc($runUsersSql)) {
                $usersData[] = $usersRow;
            }
        }
    }else{
        $usersSql = "SELECT * FROM `users` WHERE usertype='Student' ORDER BY `id` DESC";

        $runUsersSql = mysqli_query($conn, $usersSql);
        $usersCount = mysqli_num_rows($runUsersSql);
        if($runUsersSql && $usersCount > 0){
            while ($usersRow = mysqli_fetch_assoc($runUsersSql)) {
                $usersData[] = $usersRow;
            }
        }
    }



?>