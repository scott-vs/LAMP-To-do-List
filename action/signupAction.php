<?php

	require_once ('utils.php');
	
	$username = $_POST['username'];
	$realname = $_POST['realname'];
	$pass = $_POST['password'];
	if ($pass != $_POST['password2']){
		$pass_error = "Passwords do not match";
		require_once 'view/signup.php';
		return;
	} else {
		$sql = openSQL();
		mysql_select_db("todo", $sql);
		
		$q = "SELECT userId FROM users WHERE username = '$username'";
		$result = mysql_query($q,$sql);
		
		if (mysql_num_rows($result) == 0){
			$pass = md5($pass);
			$q = "INSERT INTO users (username, realname, password) VALUES ('$username', '$realname', '$pass')";
			mysql_query($q,$sql);
			$newuser_mess = "New user successfully created. Please log in.";
			require_once 'view/login.php';
		} else {
			$user_error = "Username already taken";
			require_once 'view/signup.php';
			return;
		}
		
		mysql_close($sql);
	}
