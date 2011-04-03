<?php
	require_once 'utils.php';
	$sql = openSQL();
	mysql_select_db("todo", $sql);
	
	$username = $_POST["username"];
	$password = md5($_POST["password"]);
	
	// check password
	$q = "SELECT userId FROM users WHERE username = '$username' AND password = '$password'";
	$result = mysql_query($q,$sql);
	if (mysql_num_rows($result) == 0){
		$login_error = "Invalid username or password.";
		require_once 'view/login.php';
	} else {
		$myID = mysql_fetch_row($result);
		$myID = $myID[0];
		if ($_POST['remember'] == 'on')
			setcookie('userId', $myID); 
		header("location: ./index.php?u=".$myID); 
	}
		
	mysql_close($sql);
?>