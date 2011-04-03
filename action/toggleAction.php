<?php
	require_once 'utils.php';
	$sql = openSQL();
	mysql_select_db("todo", $sql);
	
	$id = $_GET["m"];
	$newStatus = $_GET["status"];
	$q = "UPDATE todos SET done='$newStatus' WHERE todoId='$id'";
	mysql_query($q,$sql);
	
	mysql_close($sql);
	header('location: index.php?u='.$USER_ID);
?>