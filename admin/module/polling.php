<?php
$op = $_GET['op'];

switch($op){
	default : 
		if($_POST['submit']){
			$q=mysql_query("INSERT INTO polling VALUES(NULL, '".$_POST['judul']."', '".$_POST['keterangan']."', '".$_POST['catatan']."', '".date("Y-m-d", strtotime($_POST['startdate']))."', '".date("Y-m-d", strtotime($_POST['enddate']))."','".$_POST['publish']."')");
			if($q){
				$msg="Data telah berhasil disimpan!";
				$mainClass->msgBox($msg,1);
			} else {
				$msg="Data gagal disimpan!</font><br><i>".mysql_error()."</i>";
				$mainClass->msgBox($msg,0);
			}
		}
		?>
		<h3>Tambah Polling Baru</h3>
		<form action="" method="post">
			<label style="display: inline-block; width: 120px;">Judul</label><input type="text" name="judul"><br>
			<label style="display: inline-block; width: 120px;">Keterangan</label><input type="text" name="keterangan"><br>
			<label style="display: inline-block; width: 120px;">Foot tag</label><input type="text" name="catatan"><br>
			<label style="display: inline-block; width: 120px;">Tanggal Mulai</label><input type="text" name="startdate" data-date-format="yyyy-mm-dd"><br>
			<label style="display: inline-block; width: 120px;">Tanggal Berakhir</label><input type="text" name="enddate" data-date-format="yyyy-mm-dd"><br>
			<!--<label style="display: inline-block; width: 120px;">Tampilkan</label>
			<select name="publish">
				<option value="">[ Pilih ]</option>
				<option value="1">Tampilkan</option>
				<option value="0">Sembunyikan</option>
			</select>-->
			<br>
			<label style="display: inline-block; width: 120px;"></label><input type="submit" name="submit" value="Simpan">
		</form>
		<script type="text/javascript">
			$(document).ready(function(){
				$("input[name='startdate']").datepicker({format:'yyyy-mm-dd'});
				$("input[name='enddate']").datepicker({format:'yyyy-mm-dd'});
			})
		</script>
		<hr>
		<h3>Daftar Polling</h3>
		<?php
		$mainClass->listpolling();	
	break;
	case "edit" :
	?>
		<fieldset>
		<legend><h2>Ubah Polling</h2></legend>
		<?php
		if($_POST['submitSoc']){
			$id = $_GET['id'];
			$q=mysql_query("update polling set 
				judul_polling='".$_POST['judul']."', 
				keterangan='".$_POST['keterangan']."',
				catatan='".$_POST['catatan']."',
				startdate='".date("Y-m-d", strtotime($_POST['startdate']))."',
				enddate='".date("Y-m-d", strtotime($_POST['enddate']))."',
				publish='".$_POST['publish']."'
				where id='{$id}'");
			if($q){
				$msg="Data telah berhasil dirubah!";
				$mainClass->msgBox($msg,1);
			} else {
				$msg="Data gagal dirubah!</font><br><i>".mysql_error()."</i>";
				$mainClass->msgBox($msg,0);
			}
		}
		$id = $_GET['id'];
		$q=mysql_query("select * from polling where id='{$id}'");
		$r=mysql_fetch_row($q);
		if($r[6]){
			$pil = 'Tampilkan';
		} else {
			$pil = 'Sembunyikan';
		}
		?>
		<form action="<?php echo $PHP_SELF ?>" method="post" >
		
		<label style="display: inline-block; width: 120px;">Judul Polling</label> <input type="text" name="judul" size="80" value="<?php echo $r[1] ?>"><br>
		<label style="display: inline-block; width: 120px;">Keterangan</label> <input type="text" name="keterangan" size="80" value="<?php echo $r[2] ?>"><br>
		<label style="display: inline-block; width: 120px;">Foot tag</label> <input type="text" name="catatan" size="80" value="<?php echo $r[3] ?>"><br>
		<label style="display: inline-block; width: 120px;">Tanggal Mulai</label> <input type="text" name="startdate" size="80" value="<?php echo date("m/d/Y", strtotime($r[4])) ?>"><br>
		<label style="display: inline-block; width: 120px;">Tanggal Berakhir</label> <input type="text" name="enddate" size="80" value="<?php echo date("m/d/Y", strtotime($r[5])) ?>"><br>
		<!-- <label style="display: inline-block; width: 120px;">Tampilkan</label>
			<select name="publish">
				<option value="<?php echo  $r[6] ?>"><?php echo $pil ?></option>
				<option value="">[ Pilih ]</option>
				<option value="1">Tampilkan</option>
				<option value="0">Sembunyikan</option>
			</select> -->
		<input type="submit" name="submitSoc" value="Simpan">
		</form>
		</fieldset>
		<script type="text/javascript">
			$(document).ready(function(){
				$("input[name='startdate']").datepicker({format:'yyyy-mm-dd'});
				$("input[name='enddate']").datepicker({format:'yyyy-mm-dd'});
			})
		</script>
		<hr>
		<h3>Daftar Polling</h3>
		<?php
		$mainClass->listpolling();	

	break;
	case "del":
		$id = $_GET['id'];
		$q = mysql_query("DELETE FROM polling WHERE id = '{$id}'");
		if($q){
			@header("location:dashboard.php?page=polling");
			echo 'data polling berhasil dihapus<br>';
			echo '<a href="dashboard.php?page=polling">Kembali Ke Daftar Polling</a>';
		}
	break;

	// Sub option
	case "add_calon":
		if($_POST['submit']){
			$q=mysql_query("INSERT INTO polling_tanya VALUES(NULL, '".$_GET['polling_id']."', '".$_POST['pertanyaan']."','0')");
			if($q){
				$msg="Data telah berhasil disimpan!";
				$mainClass->msgBox($msg,1);
			} else {
				$msg="Data gagal disimpan!</font><br><i>".mysql_error()."</i>";
				$mainClass->msgBox($msg,0);
			}
		}
		?>
		<h3>Tambah Polling Baru</h3>
		<form action="" method="post">
			<label style="display: inline-block; width: 120px;">Pertanyaan</label><input type="text" name="pertanyaan"><br>
			
			<label style="display: inline-block; width: 120px;"></label><input type="submit" name="submit" value="Simpan">
		</form>
		<hr>
		<h3>Daftar Polling</h3>
		<?php
		$mainClass->listCalonpolling($_GET['polling_id']);	
	break;
	case "edit_calon":
		if($_POST['submit']){
			$q=mysql_query("UPDATE polling_tanya SET pertanyaan = '".$_POST['pertanyaan']."' WHERE id = '".$_POST['id']."'");
			if($q){
				$msg="Data telah berhasil diubah!";
				$mainClass->msgBox($msg,1);
			} else {
				$msg="Data gagal diubah!</font><br><i>".mysql_error()."</i>";
				$mainClass->msgBox($msg,0);
			}
		}
		$qry = mysql_query("SELECT * FROM polling_tanya WHERE polling_id = '".$_GET['polling_id']."' AND id = '".$_GET['id']."'");
		$r = mysql_fetch_row($qry);
		?>
		<h3>Ubah Pertanyaan Baru</h3>
<form action="" method="post">
		<input type="hidden" name="polling_id" value="<?php echo $r[1] ?>"><input type="hidden" name="id" value="<?php echo $r[0] ?>">
			<label style="display: inline-block; width: 120px;">Pertanyaan</label><input type="text" name="pertanyaan" value="<?php echo $r[2] ?>"><br>
			<label style="display: inline-block; width: 120px;"></label><input type="submit" name="submit" value="Simpan">
		</form>
		<hr>
		<h3>Daftar Pertanyaan Polling</h3>
		<?php
		$mainClass->listCalonPolling($_GET['polling_id']);	
	break;
	case "del_calon":   
           $id = $_GET['id'];
           $polling_id = $_GET['polling_id'];
		$q = mysql_query("DELETE FROM polling_tanya WHERE id = '{$id}'");
		if($q){
			@header("location:dashboard.php?page=polling");
			echo 'data polling berhasil dihapus<br>';
			echo '<a href="dashboard.php?page=polling&add_calon&polling_id={$polling_id}">Kembali Ke Daftar Polling</a>';
		}
	break;
	
	case "list":
	echo '<h3>Hasil Polling</h3>';
	$mainClass->listHasilPolling();
	break;
	case "aktif" :
		$id = "";
	break;
}
?>
<script type="text/javascript">
$("input[type='radio']").click(function(){
	$.post("pubPolling.php", {id: $(this).val() }, function(data){
		//alert("Polling sudah diubah");
		alert(data);
	});
	//alert( $(this).val() );
});
</script>