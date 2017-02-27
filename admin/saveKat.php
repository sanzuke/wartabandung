<?php
session_start();
require("../config.php");
if(! $_SESSION['user_name']){
	echo("<div style='margin:50px; padding:20px; border:1px solid #e5e5e5; background-color:#ccc;'><h1>Maaf anda tidak bisa mengakses langsung halaman ini!</h1></div>");
	exit();
}

require("class/class-sanzuke.php");
//require("class/class-templates.php");
$mainClass=new sanzukeClass();
$mainClass->connectDB();

$kat=$_POST['kat'];

$q=mysql_query("select * from kategori where kategori='$kat'");
$r=mysql_fetch_array($q);

if($r[home]=='0'){
	$up=mysql_query("update kategori set home='1' where kategori='$kat'");
} else {
	$up=mysql_query("update kategori set home='0' where kategori='$kat'");
}
?>