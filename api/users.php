<?php



    if(!isset($current_user)){die('Unauthorized Error');}

    $usersSql = "SELECT * FROM `admin` ORDER BY `id` DESC";

    $runUsersSql = mysqli_query($conn, $usersSql);
    $usersCount = mysqli_num_rows($runUsersSql);
    if($runUsersSql && $usersCount > 0){
        while ($usersRow = mysqli_fetch_assoc($runUsersSql)) {
            $usersData[] = $usersRow;
        }
    }



?>