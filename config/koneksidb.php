<?php
	$hostname = "localhost";
	$database = "db_sipp";
	$username = "root";
	$password = "";
	$konekdb = mysql_pconnect($hostname, $username, $password) or trigger_error(mysql_error(),E_USER_ERROR); 	
?>