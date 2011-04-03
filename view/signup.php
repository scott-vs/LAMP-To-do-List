<?php require_once 'view/header.php';?>
<div id="signup">
    <h2>Sign Up</h2>
	<form action="index.php?v=signup" method="post">
		<p>
		User Name: <input type="text" name="username" value="<?php echo($username);?>" /><span id="user_error"><?php echo($user_error);?></span><br />
		Real Name: <input type="text" name="realname" value="<?php echo($realname);?>" /><br />
		Password: <input type="password" name="password" /><span id="pass_error"><?php echo($pass_error);?></span><br />
		Confirm Password: <input type="password" name="password2" /><br />
		<input type="hidden" name="signupformSubmited" value="true" />
		<input type="submit" value="Sign up!" />
		</p>
	</form>
</div>
<?php require_once 'view/footer.php';?>