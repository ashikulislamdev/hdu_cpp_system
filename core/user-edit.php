<?php

include 'session.php';

// Check user authorization
if (!isset($current_user)) {
    die('Unauthorized Error');
}
if ($current_user['usertype'] != 'Developer') {
    die('You have no permission to access this page.');
}

// Check if all required POST variables are set
if (
    isset($_POST['user_edit_id']) &&
    isset($_POST['name']) &&
    isset($_POST['username']) &&
    isset($_POST['phone']) && // Added phone to the list
    isset($_POST['password']) &&
    isset($_POST['usertype']) &&
    isset($_POST['status'])
) {
    // Sanitize and trim user inputs
    $user_edit_id = trim(htmlentities($_POST['user_edit_id']));
    $name = trim(htmlentities($_POST['name']));
    $username = trim(htmlentities($_POST['username']));
    $phone = trim(htmlentities($_POST['phone']));
    $get_password = trim(htmlentities($_POST['password']));
    $password = !empty($get_password) ? md5($get_password) : null;
    $usertype = trim(htmlentities($_POST['usertype']));
    $status = trim(htmlentities($_POST['status']));

    // Prevent user from editing their own information
    if ($current_user['id'] == $user_edit_id) {
        die("You cannot edit your information.");
    }

    // Prepare the SQL query based on whether password is provided
    if (empty($get_password)) {
        // Update only the status when password is not provided
        $update_sql = "UPDATE `users` SET `name`='$name', `username`='$username', `phone`='$phone', `usertype`='$usertype', `status`='$status' WHERE `id` = '$user_edit_id'";
    } else {
        // Update all fields including password
        $auth = md5($username . $password);
        $update_sql = "UPDATE `users` SET `name`='$name', `username`='$username', `phone`='$phone', `password`='$password', `auth`='$auth', `usertype`='$usertype', `status`='$status' WHERE `id` = '$user_edit_id'";
    }

    // Execute the SQL query
    if (mysqli_query($conn, $update_sql)) {
        header('location: ../users.php?action=record_updated');
        exit();
    } else {
        // Log the error and show a generic error message
        error_log("Database Error: " . mysqli_error($conn));
        header('location: ../users.php?action=something_wrong');
        exit();
    }
} else {
    echo "Something went wrong!";
}

?>
