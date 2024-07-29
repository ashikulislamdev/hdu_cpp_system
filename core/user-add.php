<?php

    include 'session.php';

    if(!isset($current_user)){die('Unauthorized Error');}
    if($current_user['usertype'] != 'Developer'){die('You have no permission to access this page.');}


    if(isset($_POST['name']) &&  isset($_POST['phone']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['usertype']) && isset($_POST['status'])){
        $name = trim(htmlentities(addslashes($_POST['name'])));
        $phone = trim(htmlentities(addslashes($_POST['phone'])));
        $username = htmlentities(addslashes($_POST['username']));
        $password = htmlentities(addslashes(md5(trim($_POST['password']))));
        $usertype = htmlentities(addslashes($_POST['usertype']));
        $status = htmlentities(addslashes($_POST['status']));

        $auth = md5(trim($username.$password));

        if(!empty($name) && !empty($phone) && !empty($username) && !empty($password) && !empty($usertype) && !empty($status)){
            $sql = "INSERT INTO `users`(`name`, `phone`, `username`, `password`, `auth`, `usertype`, `status`) VALUES ('$name', '$phone', '$username', '$password', '$auth', '$usertype', '$status')";
            $sql = "INSERT INTO `users`(`name`, `phone`, `username`, `password`, `auth`, `usertype`, `status`) VALUES ('$name', '$phone', '$username', '$password', '$auth', '$usertype', '$status')";
            // die($sql);
            $runSql = mysqli_query($conn, $sql);
			if($runSql == TRUE){
                if($usertype == 'Student'){
                    $getUser = "SELECT * FROM `users` WHERE `username` = '$username'";
                    $getUser = mysqli_query($conn, $getUser);
                    $userInfo = mysqli_fetch_object($getUser);

                    // check if user is not found
                    if($userInfo == FALSE) header('location: ../users.php?action=something_wrong');



                    $studentAdd = "INSERT INTO `students`(`user_id`, `student_id`) VALUES ($userInfo->id, '$userInfo->username')";
                    $initiatStudentAdd = mysqli_query($conn, $studentAdd);

                    if($initiatStudentAdd != TRUE) header('location: ../users.php?action=something_wrong');
                }
                header('location: ../users.php?action=record_added');
            }else{
                header('location: ../users.php?action=something_wrong');
            }
        }else{
			header('location: ../users.php?action=null');
		}
    }
    else{
        echo "something wrong...!";
    }

?>