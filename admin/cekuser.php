<?php
session_start();
require("../config.php");
require("class/class-sanzuke.php");

$main = new sanzukeClass();
$main->connectDB();

$user=$_POST['username'];
$pwd=$_POST['passwd'];

$q=mysql_query("select * from user where user='$user' and pwd='$pwd' limit 1");
$r=mysql_num_rows($q);

if($r!=0){
	$_SESSION['user_name']=$user;
	$_SESSION['pwd_member']=$pwd;
} else {
	echo mysql_error();
}
	
?>