<?php
	require_once 'utils.php';
	$sql = openSQL();
	mysql_select_db("todo", $sql);

	$txt = $_POST["text"];
	$txt = strip_tags($txt); // No XSS here!
	$txt = sqlSafe($txt);
	$id = $_POST['message_id'];
	$q = "UPDATE todos SET message='$txt' WHERE todoid='$id'";
	mysql_query($q,$sql);
	
	mysql_close($sql);
	
	header('location: index.php?u='.$USER_ID);
?>