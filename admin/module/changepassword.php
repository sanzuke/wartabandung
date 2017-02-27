<?php
session_start();
//require("../config.php");
//require("class/class-sanzuke.php");

$main = new sanzukeClass();
$main->connectDB();
?>
<script type="text/javascript">
function checkPwdLama(pLama){
	if ($("#plama").val()!=pLama){
		$("#pwdLama").html("<img src='images/8.png' align='absmiddle' > Tidak Sesuai");
	} else {
		$("#pwdLama").html("<img src='images/5.png' align='absmiddle' > Sesuai");
	}
}

function checkPwd(){
	if ($("#pbaru").val()!=$("#pbaru2").val()){
		$("#pwd").html("<img src='images/8.png' align='absmiddle' > Tidak Sesuai");
	} else {
		$("#pwd").html("<img src='images/5.png' align='absmiddle' > Sesuai");
	}
}
</script>
<?php
if($_POST['submitChangePwd']){
	$q=mysql_query("update user set pwd='".$_POST['pbaru2']."' where user='".$_SESSION['user_name']."'");
	if($q){
		$msg="<div id='msgBox'><img src='images/5.png' align='absmiddle'> <font color='green'>Data telah dirubah!</font></div>";
		$_SESSION['pwd_member']=$_POST['pbaru2'];
		$_SESSION['id_member']=$r['id'];
		echo $_SESSION['pwd_member'] ." : ". $_SESSION['id_member'];
	} else {
		$msg="<div id='msgBox'><img src='images/8.png' align='absmiddle'> <font color='red'>Data gagal dirubah!</font><br><i>".mysql_error()."</i></div>";
	}
}
?>
<h1>Rubah Password</h1>
<fieldset>
<legend>Rubah Password</legend>
<?php echo $msg ?>
<form action="dashboard.php?page=changepwd" method="post">
	Password Lama <br>
    <input type="password" name="plama" id="plama" onKeyUp="checkPwdLama('<?php echo $_SESSION['pwd_member'] ?>')" > <span id="pwdLama"></span><br>
    Password Baru <br>
    <input type="password" name="pbaru" id="pbaru"><br>
    Password Lagi <br>
    <input type="password" name="pbaru2" id="pbaru2" onKeyUp="checkPwd()"> <span id="pwd"></span><br>
    <input type="submit" name="submitChangePwd" value="Rubah">
</form>
</fieldset>