<h2>Post</h2>
<script type="text/javascript">
function valid(nil,id){
	var x = String(nil);
	if(x.length<1){
		document.getElementById(id).innerHTML="<font color='red'> <img src='images/8.png' align='absmiddle'> Field harus diisi tidak boleh kosong</font>";
	} else {
		document.getElementById(id).innerHTML="<font color='green'><img src='images/5.png' align='absmiddle'></font>";
	}
}
function validNum(nil,id){
	if(nil.length<1){
		document.getElementById(id).innerHTML="<font color='red'> <img src='images/8.png' align='absmiddle'> Field harus diisi tidak boleh kosong</font>";
	} else if(isNaN(nil)){
		document.getElementById(id).innerHTML="<font color='red'> <img src='images/8.png' align='absmiddle'> Field harus angka</font>";
	} else {
		document.getElementById(id).innerHTML="<font color='green'><img src='images/5.png' align='absmiddle'></font>";
	}
}

     function openFileBrowser(id){
          fileBrowserlink = "<?php echo BASE_PATH ?>admin/browser/index.php?editor=standalone&returnID=" + id;
          window.open(fileBrowserlink,'pdwfilebrowser', 'width=1000,height=650,scrollbars=no,toolbar=no,location=no');
     }
</script>
<?php
require("../config.php");
$mainClass=new sanzukeClass();
$mainClass->connectDB();

switch($_GET['op']){
	case "add":
	if($_POST['submitAddPage']){
		$qry=mysql_query("insert into post values(NULL,
		'".$_POST['nama']."',
		'".$_FILES['photo']['name']."',
		'".$_POST['ketAdd']."',
		'".$_POST['kategori']."',
		'post',
		'".$_POST['tgl']."',
		'".$_POST['publish']."',
		'".$_POST['kw']."',
		'".$_POST['headline']."',
		0)");
		if($qry){
			$msg="Data telah disimpan";
			$img=move_uploaded_file($_FILES['photo']['tmp_name'],"../upload/".$_FILES['photo']['name']);
			if($img){
				$msg.="<br>File gambar berhasil disimpan";
			}else {
				$msg.="<br>File gambar gagal disimpan";
			}
			$mainClass->msgBox($msg,1);
		} else {
			$msg="Data gagal disimpan!<br><i>".mysql_error()."</i>";
			$mainClass->msgBox($msg,0);
		}
	}

	date_default_timezone_set("Asia/Jakarta");
	$tgl=date("Y-m-d H:i:s");
?>
	<?php echo $msg ?>
    <fieldset style="margin-top:10px;">
    <legend><h2>Tambah Halaman Baru</h2></legend>
    <form action="<?php echo $PHP_SELF ?>" method="post" id="saveNewProduct" enctype="multipart/form-data">
    	<table cellpadding="3" cellspacing="3">
        <!--<tr><td>ID</td><td><input type="text" name="id"></td></tr>-->
        <tr><td>Nama Halaman</td><td><input type="text" name="nama" onkeyup="valid(this.value,'namaValidN')" size="40">* <span id="namaValidN"></span></td></tr>
        <tr><td>Foto</td><td><input type="file" name="photo" size="40">* <span id="namaValidP"></span> ukuran 400px X 230px</td></tr>
        <tr><td>Kategori </td><td>
        <select name="kategori" onchange="valid(this.value,'namaValidK')">

        	<option value="">[ Pilih Kategori ]</option>
            <?php
			$qryKat=mysql_query("select * from kategori where child='0' order by no asc");
			while($rr=mysql_fetch_array($qryKat)){
				echo"<option value='$rr[kategori]'>".ucwords(strtolower($rr[kategori]))."</option>";
				$qq=mysql_query("select * from kategori where child='".$rr[no]."'");
				$jum=mysql_num_rows($qq);
				if($jum>0){
					//$qq=mysql_query("select * from kategori where child='".$rr['no']."' order by no asc");
					while($rrr=mysql_fetch_array($qq)){
						echo"<option value='$rrr[kategori]'>--".ucwords(strtolower($rrr[kategori]))."</option>";
					}
				}
			}
			?>
        </select> * <span id="namaValidK"></span>
        </td></tr>
        <tr><td valign="top" colspan="2"><textarea name="ketAdd" id="ketAdd" cols="40" rows="8"></textarea></td></tr>
        <tr><td valign="top" >Tanggal</td><td><input type="text" name="tgl" id="tgl" value="<?php echo $tgl ?>" />*</td></tr>
        <tr><td valign="top" >Publish</td><td><input type="radio" name="publish" value="1" />Publish <input type="radio" name="publish" value="0" />Unpublish*</td></tr>
        <tr><td valign="top" >Headline</td><td><input type="checkbox" name="headline" value="1"/>Headline</td></tr>
        <tr><td valign="top" >Keyword</td><td><input type="text" name="kw" size="100" /><i>isi posisi menu, atau biarkan kosong </i></td></tr>
        <tr><td colspan="2"><sub style="color:#F00;">* harus diisi, tidak boleh kosong</sub>
        <tr><td colspan="2"><input type="submit" name="submitAddPage" value="Simpan"></td></tr>
        </table>
        <script type="text/javascript">
		CKEDITOR.replace( 'ketAdd',
		{
			filebrowserBrowseUrl : 'browser/index.php?editor=ckeditor',
        	filebrowserImageBrowseUrl : 'browser/index.php?editor=ckeditor&filter=image',
        	filebrowserFlashBrowseUrl : 'browser/index.php?editor=ckeditor&filter=flash',
			filebrowserWindowWidth : '1000',
			filebrowserWindowHeight : '700',
			toolbar : 'Full',
			width :'900'
		});
		</script>
    </form>
    </fieldset>
    <?php
	break;
	case "edit":
	if($_POST['submitUpdatePage']){
		if($_POST['headline'] == 'on'){
			$hl = 1;
		} else {
			$hl = 0;
		}
		$qry=mysql_query("update post set judul='".$_POST['nama']."',
		isi='".$_POST['ketAdd']."',
		kategori='".$_POST['kategori']."',
		tgl='".$_POST['tgl']."',
		publish='".$_POST['publish']."',
		tag='".$_POST['kw']."',
		headline='".$hl."' where id='".$_POST['id']."'");
		if($qry){
			$msg="<div id='msgBox'><img src='images/5.png' align='absmiddle'> <font color='green'>Data telah berhasil dirubah!</font></div>";
		} else {
			$msg="<div id='msgBox'><img src='images/8.png' align='absmiddle'> <font color='red'>Data gagal dirubah!</font><br><i>".mysql_error()."</i></div>";
		}
	}

	$qry=mysql_query("select * from post where id='".$_GET['id']."'");
	$brs=mysql_fetch_array($qry);
	if($brs['publish']==1){
		$valPub1='checked="checked"';
		$valPub2='';
	} else {
		$valPub1='';
		$valPub2='checked="checked"';
	}

	if($brs['headline']=="1"){
		$hl='checked="checked"';
		//$valHL='1';
	} else {
		$hl='';
		//$valHL='0';
	}
?>
	<?php echo $msg ?>
    <fieldset style="margin-top:10px;">
    <legend><h2>Edit Halaman</h2></legend>
    <div style="float:right; margin:10px;"><img src="../upload/<?php echo $brs['photo'] ?>" width="100" /></div>
    <form action="<?php echo $PHP_SELF ?>" method="post" id="saveNewProduct" enctype="multipart/form-data">
    	<table cellpadding="3" cellspacing="3">
        <!--<tr><td>ID</td><td><input type="text" name="id"></td></tr>-->
        <tr><td>Nama Halaman</td><td><input type="hidden" name="id" size="40" value="<?php echo $_GET['id'] ?>"><input type="text" name="nama" size="40" value="<?php echo $brs['judul'] ?>">* <span id="namaValid"></span></td></tr>
        <tr><td>Foto</td><td><input type="file" name="photo" size="40">* <span id="namaValidP"></span></td></tr>
        <tr><td>Kategori </td><td>
        <select name="kategori">
        	<option value="<?php echo $brs['kategori'] ?>"><?php echo $brs['kategori'] ?></option>
        	<option value="">===============</option>
            <?php
			$qryKat=mysql_query("select * from kategori");
			while($rr=mysql_fetch_array($qryKat)){
				echo"<option value='$rr[kategori]'>$rr[kategori]</option>";
			}
			?>
        </select> <i>isi untuk menjadikan halaman sub menu, ataw biarkan kosong </i>
        </td></tr>
        <tr><td valign="top" colspan="2"><textarea name="ketAdd" id="ketAdd" cols="40" rows="8"><?php echo $brs['isi'] ?></textarea></td></tr>
        <tr><td valign="top" >Tanggal</td><td><input type="text" name="tgl" id="tgl" value="<?php echo $brs['tgl'] ?>" />*</td></tr>
        <tr><td valign="top" >Publish</td><td><input type="radio" name="publish" value="<?php echo $valPub1 ?>" />Publish <input type="radio" name="publish" value="0" <?php echo $valPub2 ?> />Unpublish*</td></tr>
        <tr><td valign="top" >Headline</td><td><input type="checkbox" name="headline" value="<?php echo $valHL ?>" <?php echo $hl ?>  />Headline</td></tr>
        <tr><td valign="top" >Keyword</td><td><input type="text" name="kw" value="<?php echo $brs['tag'] ?>" size="100" /></td></tr>
        <tr><td colspan="2"><sub style="color:#F00;">* harus diisi, tidak boleh kosong</sub>
        <tr><td colspan="2"><input type="submit" name="submitUpdatePage" value="Simpan"></td></tr>
        </table>
        <script type="text/javascript">
		CKEDITOR.replace( 'ketAdd',
		{
			filebrowserBrowseUrl : 'browser/index.php?editor=ckeditor',
        	filebrowserImageBrowseUrl : 'browser/index.php?editor=ckeditor&filter=image',
        	filebrowserFlashBrowseUrl : 'browser/index.php?editor=ckeditor&filter=flash',

			filebrowserWindowWidth : '1000',
			filebrowserWindowHeight : '700',
			toolbar : 'Full',
			width :'900'
		});
		</script>
    </form>
    </fieldset>
    <?php
	break;
	case "del":

                $qq=mysql_query("select * from post where id='".$_GET['id']."'");
                $r=mysql_fetch_array($qq);
                $phtLama=$r['photo'];
                unlink("../upload/".$phtLama);

                $qry=mysql_query("delete from post where id='".$_GET['id']."'");
		if($qry){
			echo $msg="<div id='msgBox'><img src='images/5.png' align='absmiddle'> <font color='green'>Data telah berhasil dihapus!</font></div>";
			?>
            <script type="text/jscript">
			function redirect(){
				window.location="dashboard.php?page=page&op=view";
			}
			window.onload(setTimeout(redirect(),3000))

			</script>
            <?php
		} else {
			echo $msg="<div id='msgBox'><img src='images/8.png' align='absmiddle'> <font color='red'>Data gagal dihapus!</font><br><i>".mysql_error()."</i></div>";
		}
	break;
	case "view": $mainClass->listPost();
	break;
}
?>
