<?php 
session_start();
require("../config.php");

if(! $_SESSION['user_name']){
	var_dump($_SESSION);

	echo("<div style='margin:50px; padding:20px; border:1px solid #e5e5e5; background-color:#ccc;'><h1>Maaf anda tidak bisa mengakses langsng halaman ini!</h1></div>");
	exit();
}

require("class/class-sanzuke.php");
//require("class/class-templates.php");
$mainClass=new sanzukeClass();
$mainClass->connectDB();

$id = $_POST['id'];
//$sts = $_POST['STS'];
//$change = ($sts ==  '1' ) ? '0' : '1';

$q=mysql_query("UPDATE polling SET publish='0'");
//$r=mysql_fetch_row($q);
//$change = ($r[6] ==  '1' ) ? '0' : '1';

$sql=mysql_query("UPDATE polling SET publish='1' WHERE id= '".$id."'");
if($sql){
    echo 'Data berhasil';
} else {
    echo mysql_error();
}
?>