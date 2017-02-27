<?php
require("../config.php");
$mainClass=new sanzukeClass();
$mainClass->connectDB();

if($_POST['submitUpdate']){
	$qry=mysql_query("update widget set judul='".$_POST['judul']."', isi='".$_POST['isi']."', urut='".$_POST['urut']."', pos='".$_POST['pos']."' where id='".$_GET['id']."'");
	if($qry){
		$msg="<div id='msgBox'><img src='images/5.png' align='absmiddle'> <font color='green'>Data telah disimpan!</font></div>";
	} else {
		$msg="<div id='msgBox'><img src='images/5.png' align='absmiddle'> <font color='red'>Data gagal disimpan!</font></div>";
	}
		
}

if($_POST['submitAdd']){
	$ad=mysql_query("insert into widget values(NULL,'".$_POST['judul']."','".$_POST['isi']."','".$_POST['urut']."','".$_POST['pos']."')");
	if($ad){
		$msg="<div id='msgBox'><img src='images/5.png' align='absmiddle'> <font color='green'>Data telah disimpan!</font></div>";
	} else {
		$msg="<div id='msgBox'><img src='images/5.png' align='absmiddle'> <font color='red'>Data gagal disimpan!</font></div>";
	}
}

if($_GET['op']=="del"){
	$q=mysql_query("delete from widget where id='".$_GET['id']."'");
	if($q){
		$msg="<div id='msgBox'><img src='images/5.png' align='absmiddle'> <font color='green'>Data telah dihapus!</font></div>";
	} else {
		$msg="<div id='msgBox'><img src='images/5.png' align='absmiddle'> <font color='red'>Data gagal dihapus!</font></div>";
	}
}
?>
<div style="float:left; border:1px solid #666; background-color:#CCC; padding:10px; margin-right:5px; cursor:pointer;" onClick="window.location='<?php echo BASE_PATH_ADMIN ?>dashboard.php?page=widget&op=add'"><img src="images/2.png" align="absmiddle"> Tambah Widget</div>
<div style="clear:both"></div>
<?php
echo "<br>";
echo $msg;
switch($_GET['op']){
	case "add":
	?>
        <fieldset>
		<legend>Tambah Widget</legend>
		<form action="<?php echo $PHP_SELF ?>" method="post">
		<table>
		<tr><td width="50">Judul</td><td><input type="text" name="judul" size="31" ></td></tr>
		<tr><td colspan="2"><textarea cols="100" rows="15" name="isi"></textarea></td></tr>
		<tr><td width="50">Urut</td><td><input type="text" name="urut" size="5" ></td></tr>
		<tr><td width="50">Posisi</td><td>
			<select name="pos">
				<option value="">[ Pilih ]</option>
				<option value="kiri">Kiri</option>
				<option value="kanan">Kanan</option>
			</select>
		</td></tr>
		<tr><td colspan="2"><input type="submit" name="submitAdd" value="Simpan"></td></tr>
		</table>
		</form>
		</fieldset>
		<script type="text/javascript">
		CKEDITOR.replace( 'isi',
		{
			filebrowserBrowseUrl : 'browser/index.php?editor=ckeditor',
        		filebrowserImageBrowseUrl : 'browser/index.php?editor=ckeditor&filter=image',
        		filebrowserFlashBrowseUrl : 'browser/index.php?editor=ckeditor&filter=flash',
			filebrowserWindowWidth : '900',
			filebrowserWindowHeight : '600',
			toolbar : 'Custom'
		});
		</script>
    <?php
	break;
	case "edit":
		$qq=mysql_query("select * from widget where id='".$_GET['id']."'");
		$rr=mysql_fetch_array($qq);
		?>
		<fieldset>
		<legend>Edit Widget</legend>
		<form action="<?php echo $PHP_SELF ?>" method="post">
		<table>
		<tr><td width="50">Judul</td><td><input type="text" name="judul" value="<?php echo $rr['judul'] ?>" size="31" ></td></tr>
		<tr><td width="50">Urut</td><td><input type="text" name="urut" size="5" value="<?php echo $rr['urut'] ?>" ></td></tr>
		<tr><td width="50">Posisi</td><td>
			<select name="pos">
				<option value="<?php echo $rr['pos'] ?>"><?php echo $rr['pos'] ?></option>
				<option value="">[ Pilih ]</option>
				<option value="kiri">Kiri</option>
				<option value="kanan">Kanan</option>
			</select>
		</td></tr>
		<tr><td colspan="2"><textarea cols="100" rows="15" name="isi"><?php echo $rr['isi'] ?></textarea></td></tr>
		<tr><td colspan="2"><input type="submit" name="submitUpdate" value="Simpan"></td></tr>
		</table>
		</form>
		</fieldset>
		<script type="text/javascript">
		CKEDITOR.replace( 'isi',
		{
			filebrowserBrowseUrl : 'browser/index.php?editor=ckeditor',
        		filebrowserImageBrowseUrl : 'browser/index.php?editor=ckeditor&filter=image',
        		filebrowserFlashBrowseUrl : 'browser/index.php?editor=ckeditor&filter=flash',
			filebrowserWindowWidth : '1000',
			filebrowserWindowHeight : '700',
			toolbar : 'Custom'
		});
		</script>
		<?php
	break;
	default :
?>
<!--<h1 style="margin:0px;">Widget</h1>
<i><font color="red">Format yang dimasukan berupa HTML atau tulisan biasa</font></i>
<table width="100%" cellpadding="3" cellspacing="3">
<tr bgcolor="#CCCCCC"><td>No</td><td>Judul</td><td>Widget</td><td>No. Urut</td><td>Posisi</td><td>Preview</td><td colspan="2">Option</td></tr>
<?php
$q=mysql_query("select * from widget order by id desc");
$i=1;
while($r=mysql_fetch_array($q)){
	if($i % 2){
				echo("<tr bgcolor=\"#FFFFCC\">");
			}else {
				echo("<tr bgcolor=\"#CCFFFF\">");
			}
	echo"<td>$i</td>
	<td>$r[judul]</td>
	<td>".htmlentities($r[isi])."</td> 
	<td>$r[urut]</td>
	<td>$r[pos]</td>";
	?>
	<td><input type="button" name="lihat<?php echo $i ?>" value="Preview" onclick="$('#preview').dialog('open'); $('#isiWidget').load('preview.php?id=<?php echo $r[id] ?>');"></td>
	<?php
	echo"<td width=\"12\"><a href='?page=widget&op=edit&id=$r[0]'><img src=\"images/12.png\" width=\"12\" height=\"12\"></a></td>
	<td width=\"12\"><a href='?page=widget&op=del&id=$r[0]'><img src=\"images/8.png\"></a></td>
	</tr>";
	$i++;
}
?>
</table>
    <div id="preview">
        <div id="isiWidget"><img src="images/loading.gif" /></div>
    </div>-->
    
    
<?php
	//$handler=BASE_PATH."plugin";
	if ($handle = opendir(BASE_PATH."plugin")) {
   	while (false !== ($file = readdir($handle)))
      {
          if ($file != "." && $file != "..")
	  {
          	$thelist .= '<a href="'.$file.'">'.$file.'</a>';
          }
       }
  	closedir($handle);
  	}
}
?>
