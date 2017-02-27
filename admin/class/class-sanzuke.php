<?php
class sanzukeClass{
	function connectDB(){
		$con=mysql_connect(HOST_SERVER,USER_DB,PASSWORD_DB);
		if (! $con){
			die("Server Tidak ditemukan!");
		} else {
			$db=mysql_select_db(NAME_DB,$con);
			if(! $db){
				die("Database tidak ditemukan");
			}
		}
	}
	
	function msgBox($msg,$s){
		switch ($s){
			case 1 : //sukses
				echo "<div id='msgBox'><img src='images/5.png' align='absmiddle'> <font color='green'>".$msg."</font></div>";
			break;
			case 0: //gagal
				echo "<div id='msgBox'><img src='images/8.png' align='absmiddle'> <font color='red'>".$msg."</font></div>";
			break;
		}
	}
	
	function listProduk(){	
	require("page-number.php");
	$pagenumber = new PageNumber();
	//Show Record
	$pagenumber->limit 	= 20;
	$pagenumber->page 	= $_GET['hal'] ? $_GET['hal'] : 1;
	$pagenumber->query	= "select count(*) from masterbrg";
	//Show PageNumber
	$pagenumber->TotalPageNumber 	= 5;
	$pagenumber->GenerateAll();
	echo("<span ><center>Page {$pagenumber->page} / {$pagenumber->TotalPage}  <br/>");
	if($pagenumber->TotalPage > 1){		
		if($pagenumber->page<=1){
			echo("&laquo; Prev");
		}else{
			$prev = $page-1;
			echo("<a href='produk.html&amp;hal={$pagenumber->prev}&amp;op=view' style='color:#0099FF;'>&laquo; Prev</a>");
		}
			
		for($i=$pagenumber->FirstPageNumber;$i<=$pagenumber->LastPageNumber;$i++){
			echo("<a href='produk.html&amp;hal={$i}&amp;op=view' style='color:#0099FF;'> $i </a>");
		}
		if($pagenumber->page==$pagenumber->TotalPage){
			echo("Next&gt;&gt;");
		}else{
			echo("<a href='produk.html&amp;hal={$pagenumber->next}&amp;op=view' style='color:#0099FF;'>Next &raquo;</a></center></span>");
		}
	}
	
	if($pagenumber->TotalRecord){
		$result = mysql_query("select * from masterbrg order by id desc limit {$pagenumber->start}, {$pagenumber->limit}");
		if (!$result){
			echo mysql_error();
		}
		$i=1;
		$no=$pagenumber->start+1;
		echo"<div id='formatTable'><table width='100%' cellpadding=\"3\" cellspacing=\"3\"  border=\"0\" ><tr align='center' bgcolor='#ccc' >
		<td><strong>No</strong></td>
		<td><strong>ID</strong></td>
		<td><strong>Photo</strong></td>
		<td><strong>Nama</strong></td>
		<td><strong>Kategori</strong></td>
		<td><strong>Stok</strong></td>
		<td><strong>Harga Jual</strong></td>
		<td><strong>Harga Beli</strong></td>
		<td><strong>Keteranagan</strong></td>
		<td colspan='2'><strong>Option</strong></td>
		</tr>";
		while($r = mysql_fetch_array($result)){
			if($i % 2){
				echo("<tr bgcolor=\"#FFFFCC\">");
			}else {
				echo("<tr bgcolor=\"#CCFFFF\">");
			}
			if($r['photo']==""){
				$pht="../uploads/no_image.gif";
			} else {
				$pht="../uploads/".$r['photo'];
			}
			
			echo"<td>".$no++."</td><td width=\"10\">#$r[0]</td>
			<td><img src='$pht' width='80'></td>
			<td>$r[1]</td>
			<td>$r[kategori]</td>
			<td>$r[stok]</td>
			<td>$r[hrgJual]</td>
			<td>$r[hrgBeli]</td>
			<td>$r[ket]</td>
			<td width=\"12\"><a href='dashboard.php?page=produk&op=edit&id=$r[0]'><img src=\"images/12.png\" width=\"12\" height=\"12\"></a></td>
			<td width=\"12\"><a href='dashboard.php?page=produk&op=del&id=$r[0]&n=$r[photo]'><img src=\"images/8.png\"></a></td></tr>";
			$i++;
			} 
	}
		echo ("</table></div>");
		
	}
	
	
	function listPost(){	
	require("page-number.php");
	$pagenumber = new PageNumber();
	//Show Record
	$pagenumber->limit 	= 20;
	$pagenumber->page 	= $_GET['hal'] ? $_GET['hal'] : 1;
	$pagenumber->query	= "select count(*) from post";
	//Show PageNumber
	$pagenumber->TotalPageNumber 	= 10;
	$pagenumber->GenerateAll();
	echo("<span ><center>Page {$pagenumber->page} / {$pagenumber->TotalPage}  <br/>");
	if($pagenumber->TotalPage > 1){		
		if($pagenumber->page<=1){
			echo("&laquo; Prev");
		}else{
			$prev = $page-1;
			echo("<a href='dashboard.php?page=post&op=view&amp;hal={$pagenumber->prev}&amp;op=view' style='color:#0099FF;'>&laquo; Prev</a>");
		}
			
		for($i=$pagenumber->FirstPageNumber;$i<=$pagenumber->LastPageNumber;$i++){
			echo("<a href='dashboard.php?page=post&op=view&amp;hal={$i}&amp;op=view' style='color:#0099FF;'> $i </a>");
		}
		if($pagenumber->page==$pagenumber->TotalPage){
			echo("Next&gt;&gt;");
		}else{
			echo("<a href='dashboard.php?page=post&op=view&amp;hal={$pagenumber->next}&amp;op=view' style='color:#0099FF;'>Next &raquo;</a></center></span>");
		}
	}
	
	if($pagenumber->TotalRecord){
		$result = mysql_query("select * from post where jenis='post' order by id desc limit {$pagenumber->start}, {$pagenumber->limit}");
		if (!$result){
			echo mysql_error();
		}
		$i=1;
		$no=$pagenumber->start+1;
		echo"<div id='formatTable'><table width='100%' cellpadding=\"3\" cellspacing=\"3\"  border=\"0\"><tr align='center' bgcolor='#ccc'>
		<td><strong>Judul Halaman</strong></td>
		<td><strong>Tanggal</strong></td>
		<td><strong>P</strong></td>
		<td><strong>H</strong></td>
		<td><strong>Tag</strong></td>
		<td><strong>Viewer</strong></td>
		<td colspan='2'><strong>Edit</strong></td></tr>";
		while($r = mysql_fetch_array($result)){
			if($i % 2){
				echo("<tr bgcolor=\"#FFFFCC\">");
			}else {
				echo("<tr bgcolor=\"#CCFFFF\">");
			}
			echo"
			<td>$r[judul]</td>
			<td>$r[tgl]</td>
			<td>$r[publish]</td>
			<td>$r[headline]</td>
			<td>$r[tag]</td>
			<td>$r[viewer]</td>
			<td width=\"12\"><a href='dashboard.php?page=post&op=edit&id=$r[0]'><img src=\"images/12.png\" width=\"12\" height=\"12\"></a></td>
			<td width=\"12\"><a href='dashboard.php?page=post&op=del&id=$r[0]'><img src=\"images/8.png\"></a></td></tr>";
			$i++;
			} 
	}
		echo ("</table></div>");
		
	}





function listPolling(){	
	require("page-number.php");
	$pagenumber = new PageNumber();
	//Show Record
	$pagenumber->limit 	= 20;
	$pagenumber->page 	= $_GET['hal'] ? $_GET['hal'] : 1;
	$pagenumber->query	= "select count(*) from polling";
	//Show PageNumber
	$pagenumber->TotalPageNumber 	= 10;
	$pagenumber->GenerateAll();
	echo("<span ><center>Page {$pagenumber->page} / {$pagenumber->TotalPage}  <br/>");
	if($pagenumber->TotalPage > 1){		
		if($pagenumber->page<=1){
			echo("&laquo; Prev");
		}else{
			$prev = $page-1;
			echo("<a href='dashboard.php?page=polling&op=view&amp;hal={$pagenumber->prev}&amp;op=view' style='color:#0099FF;'>&laquo; Prev</a>");
		}
			
		for($i=$pagenumber->FirstPageNumber;$i<=$pagenumber->LastPageNumber;$i++){
			echo("<a href='dashboard.php?page=polling&op=view&amp;hal={$i}&amp;op=view' style='color:#0099FF;'> $i </a>");
		}
		if($pagenumber->page==$pagenumber->TotalPage){
			echo("Next&gt;&gt;");
		}else{
			echo("<a href='dashboard.php?page=polling&op=view&amp;hal={$pagenumber->next}&amp;op=view' style='color:#0099FF;'>Next &raquo;</a></center></span>");
		}
	}
	
	if($pagenumber->TotalRecord){
		$result = mysql_query("select * from polling order by id desc limit {$pagenumber->start}, {$pagenumber->limit}");
		if (!$result){
			echo mysql_error();
		}
		$i=1;
		$no=$pagenumber->start+1;
		echo"<div id='formatTable'><table width='100%' cellpadding=\"3\" cellspacing=\"3\"  border=\"0\"><tr align='center' bgcolor='#ccc'>
		<td><strong>No</strong></td>
		<td><strong>Judul</strong></td>
		<td><strong>Keterangan</strong></td>
		<td><strong>Foot Tag</strong></td>
		<td><strong>Tanggal Mulai</strong></td>
		<td><strong>Tanggal Berakhir</strong></td>
		<td><strong>Publish</strong></td>
		<td><strong>Pilihan</strong></td>
		<td colspan='2'><strong>Edit</strong></td></tr>";
		while($r = mysql_fetch_array($result)){
			if($i % 2){
				echo("<tr bgcolor=\"#FFFFCC\">");
			}else {
				echo("<tr bgcolor=\"#CCFFFF\">");
			}
			if($r['publish'] == '1'){
				//$pub = 'Tampilkan';
				$pub = '<input type="radio" name="pub" value="'.$r[0].'" checked="checked">';
			} else {
				$pub = '<input type="radio" name="pub" value="'.$r[0].'">';
			}
			echo"
			<td>$i</td>
			<td>$r[judul_polling]</td>
			<td>$r[keterangan]</td>
			<td>$r[catatan]</td>
			<td>$r[startdate]</td>
			<td>$r[enddate]</td>
			<td>$pub</td>
			<td><a href='dashboard.php?page=polling&op=add_calon&polling_id=$r[0]'>Tambah</a></td>
			<td width=\"12\"><a href='dashboard.php?page=polling&op=edit&id=$r[0]'><img src=\"images/12.png\" width=\"12\" height=\"12\"></a></td>
			<td width=\"12\"><a href='dashboard.php?page=polling&op=del&id=$r[0]'><img src=\"images/8.png\"></a></td></tr>";
			$i++;
			} 
	}
		echo ("</table></div>");
		
	}
	

	function listCalonPolling($id_poll){	
	require("page-number.php");
	$pagenumber = new PageNumber();
	//Show Record
	$pagenumber->limit 	= 20;
	$pagenumber->page 	= $_GET['hal'] ? $_GET['hal'] : 1;
	$pagenumber->query	= "select count(*) from polling_tanya";
	//Show PageNumber
	$pagenumber->TotalPageNumber 	= 10;
	$pagenumber->GenerateAll();
	echo("<span ><center>Page {$pagenumber->page} / {$pagenumber->TotalPage}  <br/>");
	if($pagenumber->TotalPage > 1){		
		if($pagenumber->page<=1){
			echo("&laquo; Prev");
		}else{
			$prev = $page-1;
			echo("<a href='dashboard.php?page=polling&op=add_calon&amp;hal={$pagenumber->prev}&amp;op=view' style='color:#0099FF;'>&laquo; Prev</a>");
		}
			
		for($i=$pagenumber->FirstPageNumber;$i<=$pagenumber->LastPageNumber;$i++){
			echo("<a href='dashboard.php?page=polling&op=add_calon&amp;hal={$i}&amp;op=view' style='color:#0099FF;'> $i </a>");
		}
		if($pagenumber->page==$pagenumber->TotalPage){
			echo("Next&gt;&gt;");
		}else{
			echo("<a href='dashboard.php?page=polling&op=add_calon&amp;hal={$pagenumber->next}&amp;op=view' style='color:#0099FF;'>Next &raquo;</a></center></span>");
		}
	}
	
	if($pagenumber->TotalRecord){
		$result = mysql_query("select * from polling_tanya WHERE polling_id = '".$id_poll."' limit {$pagenumber->start}, {$pagenumber->limit}");
		if (!$result){
			echo mysql_error();
		}
		$i=1;
		$no=$pagenumber->start+1;
		echo"<div id='formatTable'><table width='100%' cellpadding=\"3\" cellspacing=\"3\"  border=\"0\"><tr align='center' bgcolor='#ccc'>
		<td><strong>No</strong></td>
		<td><strong>Pertanyaan</strong></td>
		<td colspan='2'><strong>Edit</strong></td></tr>";
		while($r = mysql_fetch_array($result)){
			if($i % 2){
				echo("<tr bgcolor=\"#FFFFCC\">");
			}else {
				echo("<tr bgcolor=\"#CCFFFF\">");
			}

			echo"
			<td>$i</td>
			<td>$r[pertanyaan]</td>
			<td width=\"12\"><a href='dashboard.php?page=polling&op=edit_calon&polling_id=$r[1]&id=$r[0]'><img src=\"images/12.png\" width=\"12\" height=\"12\"></a></td>
			<td width=\"12\"><a href='dashboard.php?page=polling&op=del_calon&polling_id=$r[1]&id=$r[0]'><img src=\"images/8.png\"></a></td></tr>";
			$i++;
			} 
	}
		echo ("</table></div>");
		
	}

	function listHasilPolling(){	
	require("page-number.php");
	$pagenumber = new PageNumber();
	//Show Record
	$pagenumber->limit 	= 20;
	$pagenumber->page 	= $_GET['hal'] ? $_GET['hal'] : 1;
	$pagenumber->query	= "select count(*) from polling";
	//Show PageNumber
	$pagenumber->TotalPageNumber 	= 10;
	$pagenumber->GenerateAll();
	echo("<span ><center>Page {$pagenumber->page} / {$pagenumber->TotalPage}  <br/>");
	if($pagenumber->TotalPage > 1){		
		if($pagenumber->page<=1){
			echo("&laquo; Prev");
		}else{
			$prev = $page-1;
			echo("<a href='dashboard.php?page=polling&op=list&amp;hal={$pagenumber->prev}&amp;op=view' style='color:#0099FF;'>&laquo; Prev</a>");
		}
			
		for($i=$pagenumber->FirstPageNumber;$i<=$pagenumber->LastPageNumber;$i++){
			echo("<a href='dashboard.php?page=polling&op=list&amp;hal={$i}&amp;op=view' style='color:#0099FF;'> $i </a>");
		}
		if($pagenumber->page==$pagenumber->TotalPage){
			echo("Next&gt;&gt;");
		}else{
			echo("<a href='dashboard.php?page=polling&op=list&amp;hal={$pagenumber->next}&amp;op=view' style='color:#0099FF;'>Next &raquo;</a></center></span>");
		}
	}
	
	if($pagenumber->TotalRecord){
		$result = mysql_query("select * from polling  limit {$pagenumber->start}, {$pagenumber->limit}");
		if (!$result){
			echo mysql_error();
		}
		$i=1;
		$no=$pagenumber->start+1;
		echo"<div id='formatTable'><table width='100%' cellpadding=\"3\" cellspacing=\"3\"  border=\"0\"><tr align='center' bgcolor='#ccc'>
		<td><strong>Pertanyaan</strong></td>
		<td><strong>Tanggal</strong></td>
		<td><strong>Tampilkan</strong></td>
		<td ><strong>Hasil</strong></td></tr>";
		while($r = mysql_fetch_array($result)){
			if($i % 2){
				echo("<tr bgcolor=\"#FFFFCC\">");
			}else {
				echo("<tr bgcolor=\"#CCFFFF\">");
			}
			if($r['publish'] == '1'){
				$pub = 'Aktif';
			} else {
				$pub = 'Tidak Aktif';
			}

$qSum = mysql_query("SELECT sum(jumlah) FROM polling_tanya WHERE polling_id = '".$r[0]."' ");
		$rSum = mysql_fetch_row($qSum);
		$totVote = $rSum[0];

			$qq = mysql_query("SELECT * FROM polling_tanya WHERE polling_id = '$r[0]' ");
			$ul = '<ul>';
			while($b = mysql_fetch_array($qq) ){
                                $persen = ($b['jumlah'] / $totVote )* 100;
				$ul .= '<li>'.$b['pertanyaan'].' <br>(Voted : '. round($persen,2).'% - Jumlah : '.$b['jumlah'].')</li>';
			}
			$ul .= '</ul>';
			echo"
			<td>".$r[2]."</td>
			<td>Tanggal Mulai : ".$r[4]."<br>Tanggal Akhir : ".$r[5]."</td>
			<td>$pub</td>
			<td>$ul</td>
                        </tr>"; $i++;
			} 
	}
		echo ("</table></div>");
		
	}
	
}






/* ==================================== Watermark ================================ */
function createWatermark($file_name,$path,$water_img){
	$img_ar=GetImageSize ($path); // reading source image size
	$img_wt_ar=GetImageSize ($water_img); // reading water image size
	$location_height=$img_ar[1]-$img_wt_ar[1]-80; // Location of water mark
	$location_width=$img_ar[0]-$img_wt_ar[0]-80; // Location of water mark
	$im=ImageCreateFromJpeg($path); // for main image
	$water_img1=ImageCreateFrompng($water_img); // for water image
	$newimage=imagecreatetruecolor($img_ar[0],$img_ar[1]);//
	imageCopyResized($newimage,$im,0,0,0,0,$img_ar[0],$img_ar[1],
	$img_ar[0],$img_ar[1]);
	$t=ImageCopy($newimage,$water_img1,$location_width,$location_height,0,0,$img_wt_ar[0],$img_wt_ar[1]);
	//ImageJpeg($newimage,$path,100);
	ImageJpeg($newimage,$path,100);
	chmod("$path",0666);
}
?>