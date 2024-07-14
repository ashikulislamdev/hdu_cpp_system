<?php

    include 'session.php';

    if(!isset($current_user)){die('Unauthorized Error');}
    if($current_user['usertype'] != 'Developer'){die('You have no permission to access this page.');}


    if(isset($_POST['user_edit_id']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['usertype']) && isset($_POST['status'])){
        $user_edit_id = trim(htmlentities(addslashes($_POST['user_edit_id'])));
        $username = htmlentities(addslashes($_POST['username']));
        $get_password = htmlentities(addslashes($_POST['password']));
        $password = md5(trim($get_password));
        $usertype = htmlentities(addslashes($_POST['usertype']));
        $status = htmlentities(addslashes($_POST['status']));

        if($get_password == null && $status != null){
            $update_sql = "UPDATE `admin` SET `status`='$status' WHERE `id` = '$user_edit_id'";
            // die($update_sql);

            $run_update_sql = mysqli_query($conn, $update_sql);
            
            if($run_update_sql){
                header('location: ../users.php?action=record_updated');
            }else{
                header('location: ../users.php?action=something_wrong');
            }
            die();
        }

        $auth = md5(trim($username.$password));

        if($current_user['id'] == $user_edit_id){ die("You Cannot edit your information."); }

		if ($user_edit_id != null && $username != null && $password != null && $usertype != null && $status != null) {

            $updatePwdQuery = "UPDATE `admin` SET `username`='$username', `password`='$password', `auth`='$auth', `status`='$status' WHERE `id` = '$user_edit_id'";
            // echo $updatePwdQuery; die();

            $runPassUpdateQuery = mysqli_query($conn,$updatePwdQuery);
            if($runPassUpdateQuery){
                header('location: ../users.php?action=record_updated');
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