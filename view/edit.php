<?php
	$messID = $_GET['m'];
	require_once 'utils.php';
	
	$sql = openSQL();
	mysql_select_db("todo", $sql);
	
	$q = "SELECT message FROM todos WHERE todoId = ".$messID;
	$result = mysql_query($q,$sql);
	$message = mysql_fetch_row($result);
	$message = $message[0];
	
	mysql_close($sql);


?>

<div id="edit_message">
	<h2>Edit To-do</h2>
	<form action="./index.php?u=<?php echo($USER_ID);?>" method="post">
		<p>
		<input name="text" type="text" value="<?php echo($message); ?>" />
		<input name="message_id" type="hidden" value="<?php echo($messID);?>" />
		<input name="editFormSubmit" type="hidden" value="true" />
		<input type="submit" value="edit" />
		</p>
	</form>
</div>