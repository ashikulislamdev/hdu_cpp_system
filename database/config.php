<?php

	// session_start();

	$serverName = "localhost";
	$userName = "root";
	$password = "";
	$dataBaseName ="cpp_management";

	$site_url = "http://localhost/php_projects/cpp-management-system";

	// $userName = "satkaniacec_ihdu_cpp";
	// $password = "TgywKXs@As!M";
	// $dataBaseName ="satkaniacec_ihdu_cpp";

	// $site_url = "http://ihdu.satkaniacec.com";


	$conn = mysqli_connect($serverName, $userName, $password, $dataBaseName);
	if($conn->connect_error){
		die("Database Connection Filed!");
	}
	
?>