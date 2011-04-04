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

<div id="welcome" class="span-20 prepend-10">
	<?php echo ("Hello $userName! <a id='signout_btn' href='./index.php?a=signout'>[Log out]</a>");?>
</div>
<div class="pape">
	<h2 class="span-23 prepend-1">To Do:</h2>
	<div class="span-6 prepend-2">
	<div id="todolist" >
		<?php 
			echo(renderList(true));
		?>	
	</div>
	</div>
	<div class="span-24 prepend-2">
		<form id="addform" action="./index.php?u=<?php echo($USER_ID); ?>" method="post">
			<p>
				Add a new to-do: <input id="addtolist" name="add_text" type="text"/>
				<input name="addFormSubmit" type="hidden" value="true" />
				<input id="addbtn" type="submit" value="add" />
			</p>
		</form>
	</div>
</div>
<h2 class="span-23 prepend-1">Done:</h2>
<div class="span-6 prepend-2">
<div id="hasdonelist">
<?php 
	echo(renderList(false));
?>
</div>
</div>
<?php require_once 'view/footer.php';?>