<?php

include 'session.php';

if (!isset($current_user)) {
    die('Unauthorized Error');
}

if($current_user['usertype'] == 'Student'){
    die('You have no permission to access this page.');
}

if (isset($_POST['name']) && isset($_POST['phone']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['usertype']) && isset($_POST['status'])) {
    // Sanitize and validate input
    $name = trim(htmlspecialchars($_POST['name']));
    $phone = trim(htmlspecialchars($_POST['phone']));
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars(md5(trim($_POST['password'])));
    $usertype = htmlspecialchars($_POST['usertype']);
    $status = htmlspecialchars($_POST['status']);

    $auth = md5(trim($username . $password));

    // Check if any required field is empty
    if (!empty($name) && !empty($phone) && !empty($username) && !empty($password) && !empty($usertype) && !empty($status)) {
        // Insert into users table
        $sql = "INSERT INTO `users`(`name`, `phone`, `username`, `password`, `auth`, `usertype`, `status`) 
                VALUES ('$name', '$phone', '$username', '$password', '$auth', '$usertype', '$status')";
        
        if (mysqli_query($conn, $sql)) {
            // if ($usertype == 'Student') {
            //     // Fetch the user to get the ID
            //     $getUser = "SELECT * FROM `users` WHERE `username` = '$username'";
            //     $result = mysqli_query($conn, $getUser);

            //     if ($result && mysqli_num_rows($result) > 0) {
            //         $userInfo = mysqli_fetch_object($result);

            //         // Insert into students table
            //         $studentAdd = "INSERT INTO `students`(`user_id`, `student_id`) VALUES ($userInfo->id, '$userInfo->username')";
            //         if (!mysqli_query($conn, $studentAdd)) {
            //             header('location: ../users.php?action=something_wrong');
            //             exit;
            //         }
            //     } else {
            //         header('location: ../users.php?action=something_wrong');
            //         exit;
            //     }
            // }
            header('location: ../users.php?action=record_added');
        } else {
            error_log(mysqli_error($conn));
            header('location: ../users.php?action=something_wrong');
        }
    } else {
        header('location: ../users.php?action=null');
    }
} else {
    echo "Something went wrong...!";
}
?>
