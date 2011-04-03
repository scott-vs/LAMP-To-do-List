<?php
	require_once 'utils.php';
	$sql = openSQL();
	mysql_select_db("todo", $sql);

	$txt = $_POST["add_text"];
	$txt = strip_tags($txt); // No XSS here!
	$txt = sqlSafe($txt);
	$q = "INSERT INTO todos (userId, message) VALUES ('$USER_ID', '$txt')";
	mysql_query($q,$sql);
	
	mysql_close($sql);
	
	header('location: index.php?u='.$USER_ID);
?>