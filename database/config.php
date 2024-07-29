<?php

	// session_start();

	$serverName = "localhost";
	$userName = "root";
	$password = "";
	$dataBaseName ="cpp_management";

	$site_url = "http://localhost/php_projects/cpp-management-system";

	$conn = mysqli_connect($serverName, $userName, $password, $dataBaseName);
	if($conn->connect_error){
		die("Database Connection Filed!");
	}
	
?>