<?php
session_start();
if (isset($_SESSION['user_name'])){
	header("location:dashboard.php");
}
require("../config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login Admin</title>
<script type="text/javascript" src="<?php echo BASE_PATH_ADMIN ?>js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_PATH_ADMIN ?>js/app.js"></script>
<link rel="stylesheet" href="<?php echo BASE_PATH_ADMIN ?>css/styles.css" />
<script type="text/javascript">
$(document).ready(function(e) {
	$("#frmLogin").submit(function(){
		$.ajax({
			type	:"POST",
			url		:$(this).attr("action"),
			data	:$(this).serialize(),
			success : function(){
				window.location="<?php echo BASE_PATH_ADMIN ?>dashboard.php"
			}
		})
		return false;
	})
});
</script>
</head>
<body>
<div id="overlay"></div>
<div id="popupmsg"></div>
<div id="container">
    <div id="login">
        <div class="header">Login</div>
        <div class="frm">
            <form id="frmLogin" action="cekuser.php" method="POST">
                <table align="center">
                <tr><td>Username</td><td><input type="text" name="username"  /></td></tr>
                <tr><td>Password</td><td><input type="password" name="passwd" /></td></tr>
                <tr><td></td><td align="right"><input type="submit" name="login" value="Login" /></td></tr>
                </table>
            </form>
        </div>
        <div style="background-color:#CCC; text-align:right; font-size:10px;"><a href="http://sanzuke.com/">Sanzuke Panel v1.0</a></div>
    </div>

</div>
</body>
</html>