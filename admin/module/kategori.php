<h2>Kategori</h2>
<div id="listKategori">
<?php
function loadKat(){
	$qryKat=mysql_query("select * from kategori where child='0' order by no asc");
		echo '<ul>';
		while($rr=mysql_fetch_array($qryKat)){
			echo"<li><label>".ucwords(strtolower($rr[kategori]))."</label> <a href='?page=kategori&amp;op=edit&amp;no=".$rr['no']."' title='Edit'><img src='images/12.png'></a> <a href='?page=kategori&amp;op=del&amp;no=".$rr['no']."' title='Hapus'><img src='images/8.png'></a></li>";
			$qq=mysql_query("select * from kategori where child='".$rr[no]."'");
			$jum=mysql_num_rows($qq);
			if($jum>0){
				//$qq=mysql_query("select * from kategori where child='".$rr['no']."' order by no asc");
				echo '<ul>';
				while($rrr=mysql_fetch_array($qq)){
					echo"<li><label>".ucwords(strtolower($rrr[kategori]))."</label> <a href='?page=kategori&amp;op=edit&amp;no=".$rrr['no']."' title='Edit'><img src='images/12.png'></a> <a href='?page=kategori&amp;op=del&amp;no=".$rrr['no']."' title='Hapus'><img src='images/8.png'></a></li>";
				}
				echo '</ul>';
			}
		}
		echo '</ul>';	
}
echo $msg;
switch ($_GET['op']){
	case "add":
		if($_POST['submitKat']){
			$qry=mysql_query("insert into kategori value(NULL,'".$_POST['kat']."','".$_POST['child']."','1')");
			if($qry){
				$msg="Data telah disimpan!</i>";
				$mainClass->msgBox($msg,1);
			} else {
				$msg="Data gagal disimpan!<br><i>".mysql_error()."</i>";
				$mainClass->msgBox($msg,0);
			}	
		}
		
		?>
		<div id="frmAddKat">
        <fieldset>
        <legend>Tambah Kategori</legend>
			<form action="<?php echo $PHP_SELF ?>" method="post">
				<label>Nama Kategori</label> <input type="text" name="kat" size="31" > <br>
                <label>Parent Kategori</label> 
                <select name="child">
                	<option value="0">Parent</option>
                    <?php
					$q=mysql_query("select * from kategori where child='0'");
					while($r=mysql_fetch_array($q)){
						echo '<option value="'.$r['no'].'">'.$r['kategori'].'</option>';
					}
					?>
                </select><font size="-3">Jangan dirubah jika bukan submenu</font><br>
                <input type="submit" name="submitKat" value="Simpan">
			</form>
        </fieldset>
		</div>
        <?php loadKat(); ?>
        <div id="clear"></div>
		<?php
	break;
	case "edit": 
		if($_POST['submitUpdateKat']){
			if($_POST['child']==""){
				$chl="0";
			} else {
				$chl=$_POST['child'];
			}
			$qry=mysql_query("update kategori set kategori='".$_POST['kat']."', child='".$chl."' where no='".$_POST['no']."'");
			if($qry){
				$msg="Data telah disimpan!</i>";
				$mainClass->msgBox($msg,1);
			} else {
				$msg="Data gagal disimpan!<br><i>".mysql_error()."</i>";
				$mainClass->msgBox($msg,0);
			}	
		}
		$q=mysql_query("select * from kategori where no='".$_GET['no']."'");
		$r=mysql_fetch_array($q);
		?>
        <div id="frmAddKat">
        <fieldset>
        <legend>Edit Kategori</legend>
			<form action="<?php echo $PHP_SELF ?>" method="post">
            	<input type="hidden" name="no" value="<?php echo $r['no'] ?>">
				<label>Nama Kategori</label> <input type="text" name="kat" size="31" value="<?php echo $r['kategori'] ?>" > <br>
                <label>Parent Kategori</label> 
                <select name="child">
                	<?php
					$qq=mysql_query("select * from kategori where no='".$r['child']."'");
					$rr=mysql_fetch_array($qq);
					?>
                	<option value="<?php echo $rr['child'] ?>"><?php echo $rr['kategori'] ?></option>
                	<option value="0">Parent</option>
                    <?php
					$q=mysql_query("select * from kategori where child='0'");
					while($r=mysql_fetch_array($q)){
						echo '<option value="'.$r['no'].'">'.$r['kategori'].'</option>';
					}
					?>
                </select><font size="-3">Jangan dirubah jika bukan submenu</font><br>
                <input type="submit" name="submitUpdateKat" value="Update">
			</form>
        </fieldset>
		</div>
        <?php loadKat(); ?>
        <div id="clear"></div>
		<?php
	break;
	case "del":
		$qry=mysql_query("delete from kategori where no='".$_GET['no']."'");
		if($qry){
			$msg="Data telah dihapus";
			$mainClass->msgBox($msg,1);
		} else {
			$msg="Data gagal disimpan!<br><i>".mysql_error()."</i>";
			$mainClass->msgBox($msg,0);
		}	
		loadKat();
	break;
	default:
		loadKat();
}
?>
</div>