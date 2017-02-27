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

$id = $_POST['ID'];
//$sts = $_POST['STS'];
//$change = ($sts ==  '1' ) ? '0' : '1';

$q=mysql_query("SELECT * FROM komentar WHERE id = '".$id."'");
$r=mysql_fetch_row($q);
$change = ($r[6] ==  '1' ) ? '0' : '1';

$sql=mysql_query("UPDATE komentar SET publish='".$change."' WHERE id= '".$id."'");
if($sql){
    echo 'Data berhasil '.($r[6] ==  '1' ) ? 'Unpublish' : 'Publish';;
} else {
    echo mysql_error();
}
?>