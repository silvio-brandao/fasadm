<?php

//-------------------banco de dados---------------------//
	$servername = "fasmanutencao.com.br.mysql";
	$username = "fasmanutencao_com_br";
	$password = "nazadeyse";
	$dbname = "fasmanutencao_com_br";

	// Create connection
	$mysqli  = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($mysqli ->connect_error) {
		die("Connection failed: " . $mysqli ->connect_error);
	}
			
	/* change character set to utf8 */
	if (!$mysqli->set_charset("utf8")) {
		printf("Error loading character set utf8: %s\n", $mysqli->error);
		exit();
	}
	//-------------------banco de dados---------------------//	

?>