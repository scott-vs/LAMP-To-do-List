<?php
	
	// Open MySQL database
	function openSQL(){
		require 'db_config.php';
		$sql = mysql_connect($DB_URL, $DB_USERNAME, $DB_PASSWORD) OR DIE ('Unable to connect to database! Please change settings in utils.php.');
		// Check to see if we need to create the DB
		if (mysql_query("CREATE DATABASE todo",$sql)) {
			mysql_select_db("todo", $sql);
			
			$q = "CREATE TABLE users (userId INT NOT NULL AUTO_INCREMENT,username VARCHAR(20),realname VARCHAR(20),password VARCHAR(32), PRIMARY KEY(userId))";
			mysql_query($q,$sql);
			$q = "CREATE TABLE todos (todoId INT NOT NULL AUTO_INCREMENT, userId INT NOT NULL, message VARCHAR(100),done TINYINT DEFAULT '0', PRIMARY KEY(todoId))";
			mysql_query($q,$sql);
				
		}
		
		return $sql;
	}
	
	// Makes string safe to be sent to MySQL
	function sqlSafe($str) {
		$output = '';
		
		for ($c = 0; $c < strlen($str); ++$c) {
			if (($str[$c]=='\\') || ($str[$c]=="'"))
				$output.='\\';
			$output.=$str[$c];
		}
		
		return $output;
	}
	
?>