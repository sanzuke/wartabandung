<?php
switch($_GET['op']){
	case "addHotel":
	if($_POST['submitHotel']){
		$q=mysql_query("insert into hotel value(NULL,'".$_POST['nama_hotel']."','".$_POST['alamat']."')");
		if($q){
			$msg="<div id='msgBox'><img src='images/5.png' align='absmiddle'> <font color='green'>Data berhasil disimpan.</font></div>";
		} else {
			$msg="<div id='msgBox'><img src='images/8.png' align='absmiddle'> <font color='red'>Data gagal disimpan!</font><br><i>".mysql_error()."</i></div>";
		}
	}
	?>
	<fieldset>
	<?php echo $msg ?>
	<legend>Tambah Nama Hotel</legend>
	<form action="<?php echo $PHP_SELF ?>" method="post">
		Nama Hotel <br>
		<input type="text" name="nama_hotel"><br>
		<input type="text" name="alamat" size="70"><br>
		<input type="submit" name="submitHotel" value="Simpan">
	</form>
	</fieldset>
	<?php
	break;
	case "edit":
		if($_POST['submitUpdate']){
			$q=mysql_query("update reserfasi set nama='".$_POST['nama']."', email='".$_POST['email']."', alamat='".$_POST['alamat']."', tlp='".$_POST['tlp']."', checkin='".$_POST['checkin']."', checkout='".$_POST['checkout']."', adult='".$_POST['adult']."', child='".$_POST['child']."' where id='".$_GET['id']."'");
			if($q){
				$msg="<div id='msgBox'><img src='images/5.png' align='absmiddle'> <font color='green'>Data telah disimpan!</font></div>";
			} else {
				$msg="<div id='msgBox'><img src='images/8.png' align='absmiddle'> <font color='red'>Data gagal disimpan!</font><br><i>".mysql_error()."</i></div>";
			}
		}
		$q=mysql_query("select * from reserfasi where id='".$_GET['id']."'");
		$r=mysql_fetch_array($q);
	?>
        <form action="<?php echo $PHP_SELF ?>" method="post">
        <fieldset>
        <legend><h3 style="margin:0">Edit Reserfasi Online</h3></legend>
        <?php echo $msg ?>
        Nama<br />
        <input type="text" name="nama" size="31"  value="<?php echo $r['nama'] ?>" /><br />
        Email<br />
        <input type="text" name="email" size="31" value="<?php echo $r['email'] ?>"  /><br />
        Alamat<br />
        <textarea name="alamat" cols="48" rows="3"><?php echo $r['alamat'] ?></textarea><br />
        No. Telp<br />
        <input type="text" name="tlp" size="31" value="<?php echo $r['tlp'] ?>"  /><br /><br />
        Check In 
        <input type="text" name="checkin" id="checkin"  value="<?php echo $r['checkin'] ?>"  /> 
        Check Out 
        <input type="text" name="checkout" id="checkout"  value="<?php echo $r['checkout'] ?>" /><br />
        <sup>*Format tanggal Tahun-bulan-hari, jam:menit:detik contoh : 2011-12-31, 24:59:00</sup>
        <br /><br />
        Pesan<br>
        <textarea name="psn" cols="31" rows="4"></textarea>
        </fieldset>
        <br />
        <input type="submit" name="submitUpdate" value="Update"/>
        </form>
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
    <?php
	break;
	case "del": $q=mysql_query("delete from reservasi where no='".$_GET['no']."'");
		if($q){
			$msg="<div id='msgBox'><img src='images/5.png' align='absmiddle'> <font color='green'>Data telah dihapus!</font></div>";
		} else {
			$msg="<div id='msgBox'><img src='images/8.png' align='absmiddle'> <font color='red'>Data gagal dihapus!</font><br><i>".mysql_error()."</i></div>";
		}
	break;
	default :
	require("page-number.php");
	$pagenumber = new PageNumber();
	//Show Record
	$pagenumber->limit 	= 20;
	$pagenumber->page 	= $_GET['hal'] ? $_GET['hal'] : 1;
	$pagenumber->query	= "select count(*) from reservasi";
	//Show PageNumber
	$pagenumber->TotalPageNumber 	= 5;
	$pagenumber->GenerateAll();
	echo("<span ><center>Page {$pagenumber->page} / {$pagenumber->TotalPage}  <br/>");
	if($pagenumber->TotalPage > 1){		
		if($pagenumber->page<=1){
			echo("&laquo; Prev");
		}else{
			$prev = $page-1;
			echo("<a href='dashboard.php?page=reservasi&amp;hal={$pagenumber->prev}&amp;op=view' style='color:#0099FF;'>&laquo; Prev</a>");
		}
			
		for($i=$pagenumber->FirstPageNumber;$i<=$pagenumber->LastPageNumber;$i++){
			echo("<a href='dashboard.php?page=reservasi&amp;hal={$i}&amp;op=view' style='color:#0099FF;'> $i </a>");
		}
		if($pagenumber->page==$pagenumber->TotalPage){
			echo("Next&gt;&gt;");
		}else{
			echo("<a href='dashboard.php?page=reservasi&amp;hal={$pagenumber->next}&amp;op=view' style='color:#0099FF;'>Next &raquo;</a></center></span>");
		}
	}
	
	if($pagenumber->TotalRecord){
		$result = mysql_query("select * from reservasi order by tgl_pesan desc limit {$pagenumber->start}, {$pagenumber->limit}");
		if (!$result){
			echo mysql_error();
		}
		$i=1;
		$no=$pagenumber->start+1;
		echo"<table width='100%' cellpadding=\"3\" cellspacing=\"3\"  border=\"0\"><tr align='center' bgcolor='#ccc'>
		<td><strong>Nama Hotel</strong></td>
                <td><strong>Nama</strong></td>
		<td><strong>Email</strong></td>
		<td><strong>Alamat</strong></td>
		<td><strong>No. Telp</strong></td>
		<td><strong>Tipe Kamar</strong></td>
		<td><strong>Check In</strong></td>
		<td><strong>Check Out</strong></td>
		<!--<td><strong>Edit</strong></td>-->
		<td><strong>Del</strong></td></tr>";
		while($r = mysql_fetch_array($result)){
			
			if($i % 2){
				echo("<tr bgcolor=\"#FFFFCC\" $bold>");
			}else {
				echo("<tr bgcolor=\"#CCFFFF\" $bold>");
			}
			echo"
                        <td>$r[nama_hotel]</td>
			<td>$r[nama]</td>
			<td>$r[email]</td>
			<td>$r[alamat]</td>
			<td>$r[telp]</td>
			<td>$r[tipe_kamar]</td>
			<td>$r[checkin]</td>
			<td>$r[checkout]</td>
			<td>$r[ti]</td>
			<!--<td width=\"12\"><a href='dashboard.php?page=reservasi&op=edit&id=$r[0]'><img src=\"images/12.png\" width=\"12\" height=\"12\"></a></td>-->
			<td width=\"12\"><a href='dashboard.php?page=reservasi&op=del&id=$r[0]'><img src=\"images/8.png\"></a></td></tr>";
			$i++;
			} 
	}
		echo ("</table>");
}
?>