<script type="text/javascript">
function loadUkuran(nil){
	switch(nil){
		case "banneratas1": $("#ukuran").val("467x52"); 
		break;
		case "banneratas2": $("#ukuran").val("999x142"); 
		break;
		case "display1": $("#ukuran").val("300x250"); 
		break;
		case "display2": $("#ukuran").val("300x250"); 
		break;
	}
}
</script>
<h2>Iklan</h2>
<?php

switch($_GET['op']){
	case "add":
	break;
	case "edit":
	/* ================= Simpan Update ===================*/
	if($_POST['submitUpdateIklan']){
		if($_FILES['file']['name']){
			$qry="update iklan set judul='".$_POST['nama']."', 
			file='".$_FILES['file']['name']."', 
			tipe_file='".$_POST['tipe']."', 
			keterangan='".$_POST['ket']."',
			link='".$_POST['link']."'  
			where no='".$_POST['id']."'";
		} else {
			$qry="update iklan set judul='".$_POST['nama']."', 
			tipe_file='".$_POST['tipe']."', 
			keterangan='".$_POST['ket']."',
			link='".$_POST['link']."' 
			where no='".$_POST['id']."'";
		}
		
		$q=mysql_query($qry);
		if($q){
			if($_FILES['file']['name']!=""){
				move_uploaded_file($_FILES['file']['tmp_name'],"../iklan/".$_FILES['file']['name']);
			}
			$msg="Data telah berhasil dirubah!";
			$mainClass->msgBox($msg,1);
		} else {
			$msg="Data gagal dirubah!</font><br><i>".mysql_error()."</i>";
			$mainClass->msgBox($msg,0);
		}
	}
	
	/*=====================  Cari data =====================*/
	$q=mysql_query("select * from iklan where no='".$_GET['id']."'");
	$r=mysql_fetch_array($q);
	
	if(file_exists("../iklan/".$r['file']) and $r['file']!=""){
		$img="<img src='images/5.png' align='absmiddle'> Data tersedia";
	} else {
		$img="<img src='images/Delete.png' align='absmiddle'> Data Tidak tersedia";
	}
	
	if($r['tipe_file']=="swf"){
		$s='checked="checked"';
		$j="";
	} elseif($r['tipe_file']=="jpg") {
		$j='checked="checked"';
		$s="";
	}
	?>
    <?php echo $msg ?> 
    <form action="<?php echo $PHP_SELF ?>" method="post" enctype="multipart/form-data">
    <fieldset>
    <legend>Edit Iklan</legend>
    Judul Iklan<br />
    <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>" />
    <input type="text" name="nama" value="<?php echo $r['judul'] ?>" /><br /><br />
    Ukuran <?php echo "<b>".$r['Jenis_iklan'] . "</b> [ " . $r['ukuran'] ." ]" ?><br />
    <br />
    File<br />
    <input type="file" name="file" /> <?php echo $img ?><br />
    Tipe File 
    <input type="radio" name="tipe" value="jpg" <?php echo $j ?> /> .jpg <input type="radio" name="tipe" value="swf" <?php echo $s ?>  /> .swf<br /><br />
    <input type="text" name="link" value="<?php echo $r['link'] ?>" />
    <textarea name="ket" cols="51" rows="4"><?php echo $r['Keterangan'] ?></textarea><br />
    <input type="submit" name="submitUpdateIklan" value="Simpan" />
    </fieldset>
    </form>
    <br /><br />
    <?php
	break;
	default :
?>
<fieldset id='formatTable'>
<legend>List Iklan</legend>
<table width="100%">
<tr align="center"><td><strong>Judul</strong></td><td><strong>File</strong></td><td><strong>Jenis Iklan</strong></td><td><strong>Ukuran</strong></td><td><strong>Link</strong></td><td><strong>Keterangan</strong></td><td colspan="2"><strong>Opsi</strong></td></tr>
<?php 
$i=1;
$q=mysql_query("select * from iklan");
while($r=mysql_fetch_array($q)){
	if($i % 2){
		echo("<tr bgcolor=\"#FFFFCC\">");
	}else {
		echo("<tr bgcolor=\"#CCFFFF\">");
	}
	echo '<td>'.$r['judul'].'</td>
	<td>'.$r['file'].'</td>
	<td>'.$r['Jenis_iklan'].'</td>
	<td>'.$r['ukuran'].'</td>
	<td>'.$r['link'].'</td>
	<td>'.$r['Keterangan'].'</td>
	<td width="24" align="center"><a href="dashboard.php?page=iklan&op=edit&d='.$r['file'].'&id='.$r['no'].'"><img src="images/12.png"></a></td>
	<td width="24" align="center"><a href="dashboard.php?page=iklan&op=del&id='.$r['no'].'"><img src="images/8.png"></a></td></tr>';
	$i++;
}
?>
</table>
</fieldset>
<?php } ?>