<?php
$blogurl = "http://www.yourblog.com";
$postlink = $_GET['redirect']; 
?>
 
<link rel="stylesheet" href="<?php echo $blogurl ?>/wp-admin/css/login.css" type="text/css" />
 
<div id="login">
 
<form name="loginform" id="loginform" action="<?php echo $blogurl ?>/wp-login.php" method="post">
	<p>
		<label>Username<br />
		<input type="text" name="log" id="user_login" class="input" value="" size="20" tabindex="10" /></label>
	</p>
	<p>
		<label>Password<br />
		<input type="password" name="pwd" id="user_pass" class="input" value="" size="20" tabindex="20" /></label>
 
	</p>
	<p class="forgetmenot"><label><input name="rememberme" type="checkbox" id="rememberme" value="forever" tabindex="90" /> Remember Me</label></p>
	<p class="submit">
		<input type="submit" name="wp-submit" id="wp-submit" value="Log In" tabindex="100" />
		<input type="hidden" name="redirect_to" value="<?php echo $postlink ?>#respond" />
		<input type="hidden" name="testcookie" value="1" />
	</p>
</form>
 
<p id="nav">
<a href="<?php echo $blogurl ?>/wp-login.php?action=lostpassword" title="Password Lost and Found">Lost your password?</a>
</p>
 
</div>
 
<p id="backtoblog"><a href="#" class="lbAction" rel="deactivate">Close</a></p>
 
<script type="text/javascript">
try{document.getElementById('user_login').focus();}catch(e){}
</script>