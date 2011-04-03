<?php
// Your one-stop shop for all AJAX commands!

require_once 'utils.php';
require_once 'list_renders.php';

$sql = openSQL();
mysql_select_db("todo", $sql);

$response;
$command = $_GET["command"];
$userId = $_COOKIE["userId"];
if (!$command) $command = $_POST["command"];

if ($command == "add"){
	$response->status = "ok";
	$txt = $_POST["text"];
	$txt = strip_tags($txt); // No XSS here!
	$txt = sqlSafe($txt);
	$q = "INSERT INTO todos (userId, message) VALUES ('$userId', '$txt')";
	mysql_query($q,$sql);
	$response->todolist = renderList(true);
	
} else if ($command == "doitem"){
	$response->status = "ok";
	$id = $_GET["id"];
	$newStatus = $_GET["value"];
	$q = "UPDATE todos SET done='$newStatus' WHERE todoid='$id'";
	mysql_query($q,$sql);
	$response->todolist = renderList(true);
	$response->hasdonelist = renderList(false);
	
} else if ($command == "edit"){
	$response->status = "ok";
	$txt = $_POST["text"];
	$txt = strip_tags($txt); // No XSS here!
	$txt = sqlSafe($txt);
	$id = $_POST["id"];
	$q = "UPDATE todos SET message='$txt' WHERE todoid='$id'";
	mysql_query($q,$sql);
	$response->todolist = renderList(true);
	$response->hasdonelist = renderList(false);
	
} else if ($command == "deleteitem"){
	$response->status = "ok";
	$id = $_GET["id"];
	$q = "DELETE FROM todos WHERE todoid='$id'";
	mysql_query($q,$sql);
	$response->todolist = renderList(true);
	$response->hasdonelist = renderList(false);
	
} else {
	$response->status = "error";
	$response->message = "invalid ajax command";
}


echo(json_encode($response));
mysql_close($sql);


