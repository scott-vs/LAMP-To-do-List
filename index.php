<?php
	
	// Establish global variable USER_ID
	if (isset($_GET['u']))
		$USER_ID =  $_GET['u'];
	else if(isset($_COOKIE['userId']))
		$USER_ID =  $_COOKIE['userId'];
		
	// Application controller.
	if ($_POST["signupformSubmited"])
		require_once 'action/signupAction.php';
	else if ($_POST["loginformSubmited"])
		require_once 'action/loginAction.php';
	else if ($_POST["addFormSubmit"])
		require_once 'action/addAction.php';
	else if ($_POST["editFormSubmit"])
		require_once 'action/editAction.php';	
	else if($_GET['a'] == "signout")
		require_once 'action/signoutAction.php';
	else if($_GET['a'] == "delete")
		require_once 'action/deleteAction.php';
	else if($_GET['a'] == "toggle")
		require_once 'action/toggleAction.php';
	else if($_GET['v'] == "signup")
		require_once 'view/signup.php';
	else if($_GET['v'] == "edit")
		require_once 'view/edit.php';
		
	else if(isset($USER_ID))
		require_once 'view/home.php';
	else 
		require_once 'view/login.php';
?>
