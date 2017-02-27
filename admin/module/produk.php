<!--<input type='button' name='add' value='Tambah Produk' id='addProduk'> | <input type='button' name='view' value='Lihat Produk' id='viewProduk'>-->
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
</script>
<div >
<?php
require("../config.php");
/*//require("class/class-templates.php");*/
//require("class/class-sanzuke.php");
$mainClass=new sanzukeClass();
$mainClass->connectDB();
if($_POST['submitAdd']){
	$q=mysql_query("insert into masterbrg values(NULL,'".$_POST['nama']."','".$_FILES['photo']['name']."','".$_POST['kategori']."','".$_POST['stok']."','".$_POST['hJual']."','".$_POST['hBeli']."',0,'".$_POST['ketAdd']."')");
	if($q){
		$img=move_uploaded_file($_FILES['photo']['tmp_name'],"../uploads/".$_FILES['photo']['name']);
		if($img){
			$msg="<div id='msgBox'><img src='images/5.png' align='absmiddle'> <font color='green'>Data telah disimpan!</font></div>";
		} else {
			$msg="<div id='msgBox'><img src='images/5.png' align='absmiddle'> <font color='green'>Data telah disimpan!</font><br>
			<img src='images/8.png' align='absmiddle'> <font color='red'>Gambar tidak bisa di unggah.<br>".$_FILES['photo']['error']."</font></div>";
		}
	} else {
		$msg="<div id='msgBox'><img src='images/8.png' align='absmiddle'> <font color='red'>Data gagal disimpan!<br>".mysql_error()."</font></div>";
	}
}

if($_POST['submitUpdate']){
	if($_FILES['photo']['name']==""){
		$isi="update masterbrg set nama='".$_POST['nama']."', kategori='".$_POST['kategori']."', stok='".$_POST['stok']."', hrgJual='".$_POST['hJual']."', hrgBeli='".$_POST['hBeli']."', ket='".$_POST['ket']."' where id='".$_POST['id']."'";
	} else {
		$isi="update masterbrg set nama='".$_POST['nama']."', photo='".$_FILES['photo']['name']."', kategori='".$_POST['kategori']."', stok='".$_POST['stok']."', hrgJual='".$_POST['hJual']."', hrgBeli='".$_POST['hBeli']."', ket='".$_POST['ket']."' where id='".$_POST['id']."'";
	}
	$q=mysql_query($isi);
	if($q){
		if(! file_exists("../uploads/".$_FILES['photo']['name'])){
			$img=move_uploaded_file($_FILES['photo']['tmp_name'],"../uploads/".$_FILES['photo']['name']);
			if($img){
				$msg="<div id='msgBox'><img src='images/5.png' align='absmiddle'> <font color='green'>Data telah disimpan!</font></div>";
			} else {
				$msg="<div id='msgBox'><img src='images/5.png' align='absmiddle'> <font color='green'>Data telah disimpan!</font><br>
				<img src='images/8.png' align='absmiddle'> <font color='red'>Gambar tidak bisa di unggah.<br>".$_FILES['photo']['error']."</font></div>";
			}
		} else {
			$msg="<div id='msgBox'><img src='images/5.png' align='absmiddle'> <font color='green'>Data telah disimpan!</font><br>
				<img src='images/8.png' align='absmiddle'> <font color='red'>Gambar sudah ada.</font></div>";
		}
	} else {
		$msg="<div id='msgBox'><img src='images/8.png' align='absmiddle'> <font color='red'>Data gagal disimpan!<br>".mysql_error()."</font></div>";
	}
}
switch($_GET['op']){
	case "add": 
	?>
    <?php echo $msg ?> 
    <fieldset style="margin-top:10px;">
    <legend><h2>Tambah Produk Baru</h2></legend>
    <form action="<?php echo $PHP_SELF ?>" method="post" id="saveNewProduct" enctype="multipart/form-data">
    	<table cellpadding="3" cellspacing="3">
        <!--<tr><td>ID</td><td><input type="text" name="id"></td></tr>-->
        <tr><td>Nama Barang</td><td><input type="text" name="nama" onkeyup="valid(this.value,'namaValid')">* <span id="namaValid"></span></td></tr>
        <tr><td>Photo</td><td><input type="file" name="photo">* </td></tr>
        <tr><td>Kategori</td><td>
        <select name="kategori" onchange="valid(this.value,'kat')">
        	<option value="">[ Pilih ]</option>
            <?php
			$qryKat=mysql_query("select * from sub_page");
			while($rr=mysql_fetch_array($qryKat)){
				echo"<option value='$rr[nama]'>$rr[nama]</option>";
			}
			?>
        </select>* <span id="kat"></span>
        </td></tr>
        <tr><td>Stok</td><td><input type="text" name="stok" size="7" maxlength="5" onkeyup="validNum(this.value,'stok')">* <span id="stok"></span></td></tr>
        <tr><td>Harga Jual</td><td><input type="text" name="hJual" size="15" > <span id="jual"></span></td></tr>
        <tr><td>Harga Beli</td><td><input type="text" name="hBeli" size="15" > <span id="beli"></span></td></tr>
        <tr><td valign="top">Keterangan</td><td><textarea name="ketAdd" id="ketAdd" cols="40" rows="8"></textarea></td></tr>
        <tr><td colspan="2"><sub style="color:#F00;">* harus diisi, tidak boleh kosong</sub>
        <tr><td colspan="2"><input type="submit" name="submitAdd" value="Simpan"></td></tr>
        </table>
        <script type="text/javascript">
		/*CKEDITOR.replace( 'ketAdd',
		{
			filebrowserBrowseUrl : '/ckfinder/ckfinder.html',
			filebrowserImageBrowseUrl : '/ckfinder/ckfinder.html?type=Images',
			filebrowserFlashBrowseUrl : '/ckfinder/ckfinder.html?type=Flash',
			filebrowserUploadUrl : '/ckfinder/core/connector/asp/connector.asp?command=QuickUpload&type=Files',
			filebrowserImageUploadUrl : '/ckfinder/core/connector/asp/connector.asp?command=QuickUpload&type=Images',
			filebrowserFlashUploadUrl : '/ckfinder/core/connector/asp/connector.asp?command=QuickUpload&type=Flash',
			filebrowserBrowseUrl : 'browser/index.php?editor=ckeditor',
        	filebrowserImageBrowseUrl : 'browser/index.php?editor=ckeditor&filter=image',
        	filebrowserFlashBrowseUrl : 'browser/index.php?editor=ckeditor&filter=flash',
			filebrowserWindowWidth : '1000',
			filebrowserWindowHeight : '700',
			toolbar : 'Custom'
		});*/
		</script>
    </form>
    </fieldset>
    <?php
	break;
	case "edit":
	$qq=mysql_query("select * from masterbrg where id='".$_GET['id']."'");
	$b=mysql_fetch_array($qq);
	?>
    <form action="<?php echo $PHP_SELF ?>" method="post" id="updateNewProduct" enctype="multipart/form-data">
    	<table cellpadding="3" cellspacing="3">
        <tr><td>ID</td><td><?php echo $b['id'] ?><input type="hidden" name="id" value="<?php echo $b['id'] ?>"></td></tr>
        <tr><td>Nama Barang</td><td><input type="text" name="nama" value="<?php echo $b['nama'] ?>"></td></tr>
        <tr><td>Photo</td><td><input type="file" name="photo"> <div style="float:right; position:absolute; margin-left:300px;"><img src="../uploads/<?php echo $b[photo] ?>" width="80" /></div></td></tr>
        <tr><td>Kategori</td><td>
        <select name="kategori">
        	<option value="<?php echo $b['kategori'] ?>"><?php echo $b['kategori'] ?></option>
        	<option value="">===============</option>
            <?php
			$qryKat=mysql_query("select * from sub_page");
			while($rr=mysql_fetch_array($qryKat)){
				echo"<option value='$rr[nama]'>$rr[nama]</option>";
			}
			?>
        </select>
        </td></tr>
        <tr><td>Stok</td><td><input type="text" name="stok" size="5" value="<?php echo $b['stok'] ?>"></td></tr>
        <tr><td>Harga Jual</td><td><input type="text" name="hJual" size="15" value="<?php echo $b['hrgJual'] ?>"></td></tr>
        <tr><td>Harga Beli</td><td><input type="text" name="hBeli" size="15" value="<?php echo $b['hrgBeli'] ?>"></td></tr>
        <tr><td>Keterangan</td><td><textarea name="ket" id="ket"><?php echo $b['ket'] ?></textarea></td></tr>
        <tr><td colspan="2"><input type="submit" name="submitUpdate" value="Simpan"></td></tr>
        </table>
        <script type="text/javascript">
		/*CKEDITOR.replace( 'ket',
		{
			filebrowserBrowseUrl : '/ckfinder/ckfinder.html',
			filebrowserImageBrowseUrl : '/ckfinder/ckfinder.html?type=Images',
			filebrowserFlashBrowseUrl : '/ckfinder/ckfinder.html?type=Flash',
			filebrowserUploadUrl : '/ckfinder/core/connector/asp/connector.asp?command=QuickUpload&type=Files',
			filebrowserImageUploadUrl : '/ckfinder/core/connector/asp/connector.asp?command=QuickUpload&type=Images',
			filebrowserFlashUploadUrl : '/ckfinder/core/connector/asp/connector.asp?command=QuickUpload&type=Flash',
			filebrowserBrowseUrl : 'browser/index.php?editor=ckeditor',
        	filebrowserImageBrowseUrl : 'browser/index.php?editor=ckeditor&filter=image',
        	filebrowserFlashBrowseUrl : 'browser/index.php?editor=ckeditor&filter=flash',
			filebrowserWindowWidth : '1000',
			filebrowserWindowHeight : '700',
			toolbar : 'Custom'
		});*/
		</script>
    </form>
    <?php
	break;
	case "view": 
		?>
        <fieldset>
        <legend><h2>Data Produk</h2></legend>
		<?php $mainClass->listProduk(); ?>
        </fieldset>
        <?php
	break;
	case "del": 
		$qry=mysql_query("delete from masterbrg where id='".$_GET['id']."'");
		if($qry){
			$imgDel=unlink("../uploads/".$_GET['n']);
			if($imgDel){
				$msg="<div id='msgBox'><img src='images/5.png' align='absmiddle'> <font color='green'>Data telah dihapus! halaman akan dialihkan..</font></div>";
				echo $msg;
				?>
                <script type="text/javascript">
				function delayer(){
					window.location="dashboard.php?page=produk&op=view";
				}
				window.setTimeout(delayer(),5000);
				</script>
                <?php
			} else {
				$msg="<div id='msgBox'><img src='images/5.png' align='absmiddle'> <font color='green'>Data telah dihapus!</font><br>
				<img src='images/8.png' align='absmiddle'> <font color='red'>Gambar tidak bisa di hapus.</font></div>";
				echo $msg;
			}
		} else {
			$msg="<div id='msgBox'><img src='images/8.png' align='absmiddle'> <font color='red'>Data tidak dihapus.</font></div>";
			echo $msg;
		}
		
	break;
	case "kat":
	if($_POST['submitKategori']){
		$qry=mysql_query("insert into sub_page values('4','".str_replace(" ","-",$_POST['kat'])."','-',NULL)");
		if($qry){
			$msg="<div id='msgBox'><img src='images/5.png' align='absmiddle'> <font color='green'>Data telah disimpan!</font></div>";
		} else {
			$msg="<div id='msgBox'><img src='images/8.png' align='absmiddle'> <font color='red'>Data gagal disimpan!</font><br><i>".mysql_error()."</i></div>";
		}	
	}
	?>
    <?php echo $msg  ?> 
    <fieldset>
        <legend ><h1 style="margin:0">Tambah Kategori</h1></legend>
        <form action="<?php echo $PHP_SELF ?>" method="post">
        <table>
        <tr><td>Nama Kategori</td><td><input type="text" name="kat" size="30" /></td></tr>
        <tr><td colspan="2"><input type="submit" name="submitKategori" value="simpan" /></td></tr>
        </table>
        </form>
    </fieldset>
    <?php
	break;
	case "editKat":
	if($_POST['submitEditKategori']){
		$u=mysql_query("update sub_page set nama='".$_POST['kat']."' where no='".$_POST['idKat']."'");
		if($u){
			$msg="<div id='msgBox'><img src='images/5.png' align='absmiddle'> <font color='green'>Data telah dirubah!</font></div>";
		} else {
			$msg="<div id='msgBox'><img src='images/8.png' align='absmiddle'> <font color='red'>Data gagal dirubah!</font><br><i>".mysql_error()."</i></div>";
		}
	
	}
	
	if($_GET['del']){
		$d=mysql_query("delete from sub_page where no='".$_GET['del']."'");
		if($d){
			$msg="<div id='msgBox'><img src='images/5.png' align='absmiddle'> <font color='green'>Data telah dihapus!</font></div>";
		} else {
			$msg="<div id='msgBox'><img src='images/8.png' align='absmiddle'> <font color='red'>Data gagal dihapus!</font><br><i>".mysql_error()."</i></div>";
		}
	}
	?>
	<h1 style="margin:2px;">Edit Kategori</h1>
    	<?php echo $msg  ?>
	<?php
	$q=mysql_query("select * from sub_page order by no asc");
	echo"<table><tr bgcolor='#ccc'><td>Nama</td><td colspan='2'>Option</td></tr>";
	$i=1;
	while($r=mysql_fetch_array($q)){
		if($i % 2){
			echo"<tr bgcolor='#e5e5e5'>";
		} else {
			echo"<tr bgcolor='#f8f8f8'>";
		}
		?>
		<td><?php echo $r[1] ?></td>
		<td><a href="#" onclick="$('#editKategori').slideDown(300); $('#kategori').val('<?php echo $r[1] ?>'); $('#idKat').val('<?php echo $r['no'] ?>');"><img src='images/12.png' ></a></td>
		<td><a href="dashboard.php?page=produk&op=editKat&del=<?php echo $r['no'] ?>"><img src='images/8.png'></a></td></tr>
		<?php
		$i++;	
	}
	echo"</table>";
	?>	
    <div id="editKategori" style="display:none;"> 
    <fieldset>
        <legend ><h1 style="margin:0">Edit Kategori</h1></legend>
        <form action="<?php echo $PHP_SELF ?>" method="post">
        <table>
        <tr><td>Nama Kategori</td><td><input type="text" name="kat" size="30" id="kategori" /><input type="hidden" name="idKat" size="30" id="idKat" /></td></tr>
        <tr><td colspan="2"><input type="submit" name="submitEditKategori" value="simpan" /></td></tr>
        </table>
        </form>
    </fieldset>
    </div>
    <?php
	break;
	default: //$mainClass->listProduk();
	
}
?>
</div>
