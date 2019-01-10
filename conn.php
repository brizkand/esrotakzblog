<?php
    $server_con = "localhost";
    $usename_con = "brizkand";
    $password_con = "bevinishel05";
    $database_con = "esrotakz_db";

    $conn = new mysqli($server_con, $usename_con, $password_con, $database_con);
    if($conn->connect_error){
        die($conn->connect_error);
    }
    
    //echo "Connection successfull!";
    
    //FOR VALIDATION OF DATA
	function test_input($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
    }
?>