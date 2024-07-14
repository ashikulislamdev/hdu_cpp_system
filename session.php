<?php 

	include "database/config.php";

	$cookie_name =  md5(trim("RsGroupInv"));
	
	if (!isset($_COOKIE[$cookie_name])) {
		echo "<script>location.href='index.php'</script>";
		die();
	}else{
		if(isset($_COOKIE[$cookie_name])){
			$currentAuth = $_COOKIE[$cookie_name];
		}
		
		$dbAuth = "SELECT * FROM `admin` WHERE `auth` = '$currentAuth' AND `status` = 'active'";
		$runAuth = mysqli_query($conn,$dbAuth);
		if(mysqli_num_rows($runAuth) > 0){
			$current_user = mysqli_fetch_assoc($runAuth);
		}else{
			echo "<script>location.href='logout.php'</script>";
			die();
		}
	}

?>