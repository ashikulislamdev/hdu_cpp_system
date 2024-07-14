<?php

    include 'session.php';

    if(!isset($current_user)){die('Unauthorized Error');}
    if($current_user['usertype'] != 'Developer'){die('You have no permission to access this page.');}


    if(isset($_POST['name']) && isset($_POST['email']) &&  isset($_POST['phone']) && isset($_POST['address']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['usertype']) && isset($_POST['status'])){
        $name = trim(htmlentities(addslashes($_POST['name'])));
        $email = trim(htmlentities(addslashes($_POST['email'])));
        $phone = trim(htmlentities(addslashes($_POST['phone'])));
        $address = trim(htmlentities(addslashes($_POST['address'])));
        $username = htmlentities(addslashes($_POST['username']));
        $password = htmlentities(addslashes(md5(trim($_POST['password']))));
        $usertype = htmlentities(addslashes($_POST['usertype']));
        $status = htmlentities(addslashes($_POST['status']));

        $auth = md5(trim($username.$password));

        if(!empty($name) && !empty($email) && !empty($phone) && !empty($address) && !empty($username) && !empty($password) && !empty($usertype) && !empty($status)){
            $sql = "INSERT INTO `admin`(`name`, `email`, `phone`, `address`, `username`, `password`, `auth`, `usertype`, `status`) VALUES ('$name','$email', '$phone', '$address', '$username', '$password', '$auth', '$usertype', '$status')";
            // die($sql);
            $runSql = mysqli_query($conn, $sql);
			if($runSql == TRUE){
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