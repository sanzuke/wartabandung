<?php
if($_GET['op']=="del"){
	$q=mysql_query("delete from guestbook where id='".$_GET['id']."'");
		if($q){
			$msg="<div id='msgBox'><img src='images/5.png' align='absmiddle'> <font color='green'>Data telah dihapus!</font></div>";
		} else {
			$msg="<div id='msgBox'><img src='images/8.png' align='absmiddle'> <font color='red'>Data gagal dihapus!</font><br><i>".mysql_error()."</i></div>";
		}
}
echo"<h2 style='margin:0'>Buku Tamu</h2>";
echo $msg;
require("page-number.php");
	$pagenumber = new PageNumber();
	//Show Record
	$pagenumber->limit 	= 20;
	$pagenumber->page 	= $_GET['hal'] ? $_GET['hal'] : 1;
	$pagenumber->query	= "select count(*) from guestbook";
	//Show PageNumber
	$pagenumber->TotalPageNumber 	= 5;
	$pagenumber->GenerateAll();
	echo("<span ><center>Page {$pagenumber->page} / {$pagenumber->TotalPage}  <br/>");
	if($pagenumber->TotalPage > 1){		
		if($pagenumber->page<=1){
			echo("&laquo; Prev");
		}else{
			$prev = $page-1;
			echo("<a href='dashboard.php?page=bukutamu&amp;hal={$pagenumber->prev}' style='color:#0099FF;'>&laquo; Prev</a>");
		}
			
		for($i=$pagenumber->FirstPageNumber;$i<=$pagenumber->LastPageNumber;$i++){
			echo("<a href='dashboard.php?page=bukutamu&amp;hal={$i}' style='color:#0099FF;'> $i </a>");
		}
		if($pagenumber->page==$pagenumber->TotalPage){
			echo("Next&gt;&gt;");
		}else{
			echo("<a href='dashboard.php?page=bukutamu&amp;hal={$pagenumber->next}' style='color:#0099FF;'>Next &raquo;</a></center></span>");
		}
	}
	
	if($pagenumber->TotalRecord){
		$result = mysql_query("select * from guestbook order by id desc limit {$pagenumber->start}, {$pagenumber->limit}");
		if (!$result){
			echo mysql_error();
		}
		$i=1;
		$no=$pagenumber->start+1;
		echo"<table width='100%' cellpadding=\"3\" cellspacing=\"3\"  border=\"0\"><tr align='center' bgcolor='#ccc'>
		<td><strong>nama</strong></td>
		<td><strong>Email</strong></td>
		<td><strong>Phone</strong></td>
		<td><strong>Pesan</strong></td>
		<td><strong>Del</strong></td></tr>";
		while($r = mysql_fetch_array($result)){
			
			if($i % 2){
				echo("<tr bgcolor=\"#FFFFCC\" $bold>");
			}else {
				echo("<tr bgcolor=\"#CCFFFF\" $bold>");
			}
			echo"
			<td>$r[nama]</td>
			<td>$r[email]</td>
			<td>$r[phone]</td>
			<td>$r[pesan]</td>
			<td width=\"12\"><a href='dashboard.php?page=bukutamu&op=del&id=$r[0]'><img src=\"images/8.png\"></a></td></tr>";
			$i++;
			} 
	}
		echo ("</table>");
?>