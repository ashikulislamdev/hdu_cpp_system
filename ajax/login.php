<?php

	include "../database/config.php";

	if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['login_status'])){
		$username = htmlentities(addslashes($_POST['username']));
		$password = htmlentities(addslashes($_POST['password']));
		$login_status = htmlentities(addslashes($_POST['login_status']));

		if(!$username == null && !$password == null && !$login_status == null){
			if($login_status == 'true'){
				
				$password = md5(trim($password));
				$auth = md5(trim($username.$password));

				$sql = "SELECT * FROM `users` WHERE `username` = '$username' AND `password` = '$password'";
				$runSql = mysqli_query($conn, $sql);
				if(mysqli_num_rows($runSql) > 0 ){
					$sql_data = mysqli_fetch_assoc($runSql);
					
					if($sql_data['status'] == 'active'){
						$cookie_name =  md5(trim("RsGroupInv"));
						setcookie($cookie_name,$auth,time()+(86400 * 7),"/");

						echo "<p class='bg-success p-1 rounded'>Login Successfully...</p>";

						echo "<script>location.href = 'dashboard.php'</script>";
					}else{
						echo "<p class='bg-danger p-1 rounded'>Your account status is <b>".$sql_data['status']."</b></p>";
					}

				}else{
					echo "<p class='bg-danger p-1 rounded'>username or password is invalid.</p>";
				}

			}else{
				echo "<p class='bg-danger p-1 rounded'>Sorry! You are Invalid.</p>";
			}
		}else{
			echo "<p class='bg-danger p-1 rounded'><b>Attention!</b> All Field are required.</p>";
		}		

	}else{
		echo "<p class='bg-danger p-1 rounded'>Sorry! Something Wrong.</p>";
	}


?>