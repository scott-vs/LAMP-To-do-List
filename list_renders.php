<?php
function renderList($todo){
	global $USER_ID;
	if ($todo){
		$myCurrentStatus = 0;
		$myNextStatus = 1;
		$myMark = "done";
		$myChecked = "";
	} else {
		$myCurrentStatus = 1;
		$myNextStatus = 0;
		$myMark = "to-do";
		$myChecked = "checked";
	} 
	
	$sql = openSQL();
	mysql_select_db("todo", $sql);
	
	$s = "";
	$q = "SELECT * FROM todos WHERE userId = '$USER_ID' AND done = '$myCurrentStatus'";
	$result = mysql_query($q,$sql);
	if (mysql_numrows($result) == 0){
		$s = "nothing here yet...";
	}
	$count = 0;
	while ($row = mysql_fetch_array($result)){
		$id = $row['todoId'];
		$message = $row['message'];
		if (!$todo)
			$message = "<del>".$message."</del>";
		$s .= "<div id='todo_$id'>";
		$s .= "<span class='item'>";
		if ($_GET['ajax'] == "true")
			$s .= "<input type='checkbox' onclick='doItem($id,$myNextStatus)' $myChecked /> ";
		else 
			$s .= ++$count.") ";
		$s .= $message;
		$s .= "</span> ";
		if ($_GET['ajax'] != "true")
			$s .= "<a href='./index.php?u=$USER_ID&amp;a=toggle&amp;status=$myNextStatus&amp;m=$id'>[$myMark]</a>";
		
		$s .= "
				<a href='./index.php?u=$USER_ID&amp;v=edit&amp;m=$id'>[edit]</a>
				<a href='./index.php?u=$USER_ID&amp;a=delete&amp;m=$id' >[x]</a>
			   ";
		$s .= "</div>";
	}
	return $s;
	
}