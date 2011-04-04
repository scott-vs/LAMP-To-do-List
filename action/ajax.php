<?php
// Your one-stop shop for all AJAX commands!

require_once '../utils.php';
require_once '../list_renders.php';

$sql = openSQL();
mysql_select_db("todo", $sql);

$response;
$command = $_GET["command"];
$USER_ID = $_GET["userID"];
$ajax = true;
if (!$command) $command = $_POST["command"];


if ($command == "checkname"){
	$name = $_GET['name'];
	$q = "SELECT userId FROM users WHERE username = '$name'";
	$result = mysql_query($q,$sql);
	
	if (mysql_num_rows($result) != 0)
		echo("Username already taken");
} else if ($command == "loadList"){
	if (isset($_GET['todo']))
		echo(renderList(true));
	else
		echo(renderList(false));
} else if ($command == "delete"){
	$id = $_GET["id"];
	$q = "DELETE FROM todos WHERE todoid='$id'";
	mysql_query($q,$sql);
	$response->todo = renderList(true);
	$response->hasdone = renderList(false);
	echo(json_encode($response));
} else if ($command == "add"){
	$txt = $_POST["txt"];
	$txt = strip_tags($txt); // No XSS here!
	$txt = sqlSafe($txt);
	$q = "INSERT INTO todos (userId, message) VALUES ('$USER_ID', '$txt')";
	mysql_query($q,$sql);
	echo(renderList(true));
} else if ($command == "edit"){
	$txt = $_POST["txt"];
	$id = $_GET["id"];
	$txt = strip_tags($txt); // No XSS here!
	$txt = sqlSafe($txt);
	$q = "UPDATE todos SET message='$txt' WHERE todoid='$id'";
	mysql_query($q,$sql);
	$response->todo = renderList(true);
	$response->hasdone = renderList(false);
	echo(json_encode($response));
} else if ($command == "toggle"){
	$response->status = "ok";
	$id = $_GET["id"];
	if ($_GET['check']=="true")
		$newStatus = 1;
	else
		$newStatus = 0;
	$q = "UPDATE todos SET done='$newStatus' WHERE todoid='$id'";
	mysql_query($q,$sql);
	$response->todo = renderList(true);
	$response->hasdone = renderList(false);
	echo(json_encode($response));
	
}

//
//
//if ($command == "add"){
//	$response->status = "ok";
//	$txt = $_POST["text"];
//	$txt = strip_tags($txt); // No XSS here!
//	$txt = sqlSafe($txt);
//	$q = "INSERT INTO todos (userId, message) VALUES ('$userId', '$txt')";
//	mysql_query($q,$sql);
//	$response->todolist = renderList(true);
//	
//} else if ($command == "doitem"){
//	$response->status = "ok";
//	$id = $_GET["id"];
//	$newStatus = $_GET["value"];
//	$q = "UPDATE todos SET done='$newStatus' WHERE todoid='$id'";
//	mysql_query($q,$sql);
//	$response->todolist = renderList(true);
//	$response->hasdonelist = renderList(false);
//	
//} else if ($command == "edit"){
//	$response->status = "ok";
//	$txt = $_POST["text"];
//	$txt = strip_tags($txt); // No XSS here!
//	$txt = sqlSafe($txt);
//	$id = $_POST["id"];
//	$q = "UPDATE todos SET message='$txt' WHERE todoid='$id'";
//	mysql_query($q,$sql);
//	$response->todolist = renderList(true);
//	$response->hasdonelist = renderList(false);
//	
//} else if ($command == "deleteitem"){
//	$response->status = "ok";
//	$id = $_GET["id"];
//	$q = "DELETE FROM todos WHERE todoid='$id'";
//	mysql_query($q,$sql);
//	$response->todolist = renderList(true);
//	$response->hasdonelist = renderList(false);
//	
//} else {
//	$response->status = "error";
//	$response->message = "invalid ajax command";
//}


//echo(json_encode($response));
mysql_close($sql);


