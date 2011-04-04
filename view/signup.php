<?php require_once 'view/header.php';?>
<div id="signup">
    <h2>Sign Up</h2>
	<form action="index.php?v=signup" method="post">
		<p>
		<span class="span-3">User Name:</span> <input type="text" id="signup_username" name="username" value="<?php echo($username);?>" /> <span id="user_error" class="error_mess"><?php echo($user_error);?></span><br />
		<span class="span-3">Real Name:</span> <input type="text" name="realname" value="<?php echo($realname);?>" /><br />
		<span class="span-3">Password:</span> <input type="password" name="password" /><span id="pass_error" class="error_mess"><?php echo($pass_error);?></span><br />
		<span class="span-3">Confirm Password:</span> <input type="password" name="password2" /><br />
		<input type="hidden" name="signupformSubmited" value="true" />
		<input type="submit" value="Sign up!" />
		</p>
	</form>
</div>
<?php require_once 'view/footer.php';?>