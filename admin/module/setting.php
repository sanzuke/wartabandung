<?php
require("../config.php");
$mainClass=new sanzukeClass();

$mainClass->connectDB();
switch($_GET['op']){
	case "price-list": $q="Select * from konten where id='1'";
	break;
	case "cara-pesan":$q="Select * from konten where id='2'";
	break;
	case "kontak": $q="Select * from konten where id='3'";
	break;
}

if($_POST['submitSetting']){
	$kon=$_GET['op'];
	$judul=$_POST['judul'];
	$isi=$_POST['isi'];
	switch($kon){
		case "price-list": $qqq="update konten set judul='$judul', isi ='$isi' where id='1'";
		break;
		case "cara-pesan":$qqq="update konten set judul='$judul', isi ='$isi' where id='2'";
		break;
		case "kontak": $qqq="update konten set judul='$judul', isi ='$isi' where id='3'";
		break;
	}
	$result=mysql_query($qqq);
	if($result){
		$msg="<div id='msgBox'><img src='images/5.png' align='absmiddle'> <font color='green'>Data telah disimpan!</font></div>";
	} else {
		$msg="<div id='msgBox'><img src='images/8.png' align='absmiddle'> <font color='red'>Data gagal disimpan!<br>".mysql_error()."</font></div>";
	}
}
$qry=mysql_query($q);
$r=mysql_fetch_array($qry);
?>
<form action="<?php echo $PHP_SELF ?>" method="post">
<?php echo $msg ?> 
<table width="100%">
<tr><td>Judul</td><td> <input type="text" name="judul" value="<?php echo $r[1] ?>"></td></tr>
<!--<tr><td>Kategori</td><td> <input type="text" name="kategori" value="<?php echo $r[2] ?>"></td></tr>-->
<tr><td colspan="2"><textarea name="isi" id="isi"><?php echo $r[3] ?></textarea></td></tr>
<tr><td colspan="2"><input type="submit" name="submitSetting" value="Simpan"></td></tr>
</td>
</form>
<script type="text/javascript">
		CKEDITOR.replace( 'isi',
		{
			filebrowserBrowseUrl : 'browser/index.php?editor=ckeditor',
        	filebrowserImageBrowseUrl : 'browser/index.php?editor=ckeditor&filter=image',
        	filebrowserFlashBrowseUrl : 'browser/index.php?editor=ckeditor&filter=flash',
        	/*filebrowserBrowseUrl : 'ckfinder/ckfinder.html',
			filebrowserImageBrowseUrl : 'ckfinder/ckfinder.html?type=Images',
			filebrowserFlashBrowseUrl : 'ckfinder/ckfinder.html?type=Flash',
			filebrowserUploadUrl : 'ckfinder/core/connector/asp/connector.asp?command=QuickUpload&type=Files',
			filebrowserImageUploadUrl : 'ckfinder/core/connector/asp/connector.asp?command=QuickUpload&type=Images',
			filebrowserFlashUploadUrl : 'ckfinder/core/connector/asp/connector.asp?command=QuickUpload&type=Flash',*/
			filebrowserWindowWidth : '900',
			filebrowserWindowHeight : '700',
			toolbar : 'Custom'

		});
		</script>