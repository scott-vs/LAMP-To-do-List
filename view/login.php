<?php
if ($_POST["formSubmited"]){
	
	
}


?>

<?php require_once 'view/header.php';?>
<div id="login">
    <h2>Login</h2>
    <div id="newuser_mess"><?php echo($newuser_mess); ?></div>
    <div id="login_error" class="error_mess"><?php echo($login_error); ?></div>
	<form action="index.php" method="post">
		<p>
		<span class="span-2">User Name:</span> <input type="text" name="username" value="<?php echo($username);?>" /><br />
		<span class="span-2">Password:</span> <input type="password" name="password" /><br />
		<input type="hidden" name="loginformSubmited" value="true" />
		<span class="span-2"><input type="submit" value="login" /></span>
		<input type="checkbox" name="remember" checked="checked" /> Remember Me<br />
		</p>
	</form>
	<div id="not_yet">
		Not yet a member? <a href="./index.php?v=signup">Sign up!</a>
	</div>
</div>
<?php require_once 'view/footer.php';?>