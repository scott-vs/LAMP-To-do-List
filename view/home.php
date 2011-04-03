<?php
require_once 'utils.php';
require_once 'list_renders.php';

$sql = openSQL();
mysql_select_db("todo", $sql);

$q = "SELECT realname FROM users WHERE userId = '$USER_ID'";
$result = mysql_query($q,$sql);
$userName = mysql_fetch_row($result);
$userName = $userName[0];
?>

<?php require_once 'view/header.php';?>

<div id="welcome">
	<?php echo ("Hello $userName! <a href='../index.php?a=signout'>[Log out]</a>");?>
</div>
<h1>To Do:</h1>
<div id="todolist">
	<?php 
		echo(renderList(true));
	?>	
</div>
<div>
	<form action="./index.php?u=<?php echo($USER_ID); ?>" method="post">
		<p>
			Add a new to-do: <input id="addtolist" name="add_text" type="text"/>
			<input name="addFormSubmit" type="hidden" value="true" />
			<input id="addbtn" type="submit" value="add" />
		</p>
	</form>
</div>
<h1>Done:</h1>
<div id="hasdonelist">
<?php 
	echo(renderList(false));
?>
</div>

<?php require_once 'view/footer.php';?>