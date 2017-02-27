<?php
switch($_GET['op']){
	case "add":
	break;
	case "edit":
	break;
	case "del":
	break;
	default :
	require("page-number.php");
	$pagenumber = new PageNumber();
	//Show Record
	$pagenumber->limit 	= 20;
	$pagenumber->page 	= $_GET['hal'] ? $_GET['hal'] : 1;
	$pagenumber->query	= "select count(*) from gallery";
	//Show PageNumber
	$pagenumber->TotalPageNumber 	= 5;
	$pagenumber->GenerateAll();
	echo("<span ><center>Page {$pagenumber->page} / {$pagenumber->TotalPage}  <br/>");
	if($pagenumber->TotalPage > 1){		
		if($pagenumber->page<=1){
			echo("&laquo; Prev");
		}else{
			$prev = $page-1;
			echo("<a href='dashboard.php?page=gallery&amp;hal={$pagenumber->prev}' style='color:#0099FF;'>&laquo; Prev</a>");
		}
			
		for($i=$pagenumber->FirstPageNumber;$i<=$pagenumber->LastPageNumber;$i++){
			echo("<a href='dashboard.php?page=gallery&amp;hal={$i}' style='color:#0099FF;'> $i </a>");
		}
		if($pagenumber->page==$pagenumber->TotalPage){
			echo("Next&gt;&gt;");
		}else{
			echo("<a href='dashboard.php?page=gallery&amp;hal={$pagenumber->next}' style='color:#0099FF;'>Next &raquo;</a></center></span>");
		}
	}
	
	if($pagenumber->TotalRecord){
		$result = mysql_query("select * from gallery order by id desc limit {$pagenumber->start}, {$pagenumber->limit}");
		if (!$result){
			echo mysql_error();
		}
		$i=1;
		$no=$pagenumber->start+1;
		echo"<table width='100%' cellpadding='3' cellspacing='3'  border='1'>
		<tr align='center' bgcolor='#ccc'>
		<td><strong>Photo</strong></td>
		<td><strong>Deskripsi</strong></td>
		<td><strong>Edit</strong></td>
		<td><strong>Del</strong></td></tr>";
		while($r = mysql_fetch_array($result)){
			if($i % 2){
				echo("<tr bgcolor=\"#FFFFCC\" >");
			}else {
				echo("<tr bgcolor=\"#CCFFFF\" >");
			}
			echo"<td><img src='../upload/$r[photo]' width='80'></td>
			<td>$r[des]</td>
			<td width='12'><a href='dashboard.php?page=gallery&op=edit&id=$r[0]'><img src='images/12.png' width='12' height='12'></a></td>
			<td width='12'><a href='dashboard.php?page=gallery&op=del&id=$r[0]&amp;n=$r[photo]><img src='images/8.png'></a></td></tr>";
			$i++;
		} 
	}
		echo ("</table>");
}
?>