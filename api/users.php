<?php

    if (!isset($current_user)) {
        die('Unauthorized Error');
    }

    // Prepare SQL query based on usertype
    if ($current_user['usertype'] == 'Developer') {
        // Developers see all users
        $usersSql = "SELECT users.*, cpp_infos.num_of_cpp FROM users LEFT JOIN cpp_infos ON users.id = cpp_infos.user_id ORDER BY users.id DESC";
    } else {
        // Teachers only see students
        $usersSql = "SELECT users.*, cpp_infos.num_of_cpp FROM users LEFT JOIN cpp_infos ON users.id = cpp_infos.user_id WHERE users.usertype = 'Student' ORDER BY users.id DESC";
    }

    $runUsersSql = mysqli_query($conn, $usersSql);
    $usersData = []; // Initialize the array to store users data
    if ($runUsersSql) {
        while ($usersRow = mysqli_fetch_assoc($runUsersSql)) {
            $usersData[] = $usersRow;
        }
    }

?>