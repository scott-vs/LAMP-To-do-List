<?php
	require_once 'utils.php';
	$sql = openSQL();
	mysql_select_db("todo", $sql);

	$id = $_GET["m"];
	$q = "DELETE FROM todos WHERE todoid='$id'";
	mysql_query($q,$sql);
	
	mysql_close($sql);
	header('location: index.php?u='.$USER_ID);
?>