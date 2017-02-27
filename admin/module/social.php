<fieldset>
<legend><h2>Social media </h2></legend>
<?php
if($_POST['submitSoc']){
	$q=mysql_query("update setting set fb='".$_POST['fb']."', tw='".$_POST['tw']."', ig='".$_POST['ig']."' where id='1'");
	if($q){
		$msg="Data telah berhasil dirubah!";
		$mainClass->msgBox($msg,1);
	} else {
		$msg="Data gagal dirubah!</font><br><i>".mysql_error()."</i>";
		$mainClass->msgBox($msg,0);
	}
}
$q=mysql_query("select * from setting where id='1'");
$r=mysql_fetch_array($q);
?>
<form action="<?php echo $PHP_SELF ?>" method="post" >
Masukan link social media anda disini.<br>
<label style="display:inline-block; width:50px;"><i class="fa fa-facebook fa-2x"></i></label> <input type="text" name="fb" size="80" value="<?php echo $r['fb'] ?>"><br>
<label style="display:inline-block; width:50px;"><i class="fa fa-twitter fa-2x"></i></label> <input type="text" name="tw" size="80" value="<?php echo $r['tw'] ?>"><br>
<label style="display:inline-block; width:50px;"><i class="fa fa-instagram fa-2x"></i></label> <input type="text" name="ig" size="80" value="<?php echo $r['ig'] ?>"><br>
<input type="submit" name="submitSoc" value="Simpan">
</form>
</fieldset>