<?php
require("config.php");
require("class/mainclass.php");

$main = new MainClass();

$main->connectDB();

switch($_POST['op']){
	default :
	$id = $_POST['poll'];
	$qry = mysql_query("SELECT jumlah FROM polling_tanya WHERE id = '{$id}'");
	$jml = mysql_fetch_row($qry);
	$seq = $jml[0]+1;
	///print_r($jml);
	$up = mysql_query("UPDATE polling_tanya SET jumlah = {$seq} WHERE id = {$id} ");
	
	if($up){
		echo 'true';
		//setcookie("im_in_vote", "true", time() - 3600);
	} else {
		echo 'Polling anda gagal disimpan ('.mysql_error().')';
	}
	break;
	
	case "list":
	$qPool = mysql_query("SELECT * FROM polling 
			WHERE CURDATE() BETWEEN startdate
			AND enddate AND publish = '1'");
	while ($r = mysql_fetch_array($qPool)) {
		# code...
		echo '<p>'.$r['keterangan'].'</p>';
		echo '<ul>';
		$qSum = mysql_query("SELECT sum(jumlah) FROM polling_tanya WHERE polling_id = '".$r['id']."' ");
		$rSum = mysql_fetch_row($qSum);
		$totVote = $rSum[0];
		
		$qTanya = mysql_query("SELECT * FROM polling_tanya WHERE polling_id = '".$r['id']."' ");
		while ($b = mysql_fetch_array($qTanya)) {
		# code...
			$persen = ($b['jumlah'] / $totVote )* 100;
			//echo '<li>'.$b['pertanyaan'] .' (Voted : '.$persen.'% Jumlah : '.$b['jumlah'].') </li>';
			echo '<li>'.$b['pertanyaan'] .' (Voted : '. round($persen,2).'% ) </li>';
		}
		echo '</ul><br>';
		echo $r['catatan'];
	}
	break;	
	case "grafik" :
		$data = array(); $result = array();
		$val = array();
		$judul = '';
		$qPool = mysql_query("SELECT * FROM polling 
				WHERE CURDATE() BETWEEN startdate
				AND enddate AND publish = '1'");
		while ($r = mysql_fetch_array($qPool)) {
			# code...
			//echo '<p>'.$r['keterangan'].'</p>';
			//echo '<ul>';
			$qSum = mysql_query("SELECT sum(jumlah) FROM polling_tanya WHERE polling_id = '".$r['id']."' ");
			$rSum = mysql_fetch_row($qSum);
			$totVote = $rSum[0];
			$judul = $r['judul_polling'];
			$qTanya = mysql_query("SELECT * FROM polling_tanya WHERE polling_id = '".$r['id']."' ");
			while ($b = mysql_fetch_array($qTanya)) {
			# code...
				$persen = ($b['jumlah'] / $totVote )* 100;
				//echo '<li>'.$b['pertanyaan'] .' (Voted : '.$persen.'% Jumlah : '.$b['jumlah'].') </li>';
				//echo '<li>'.$b['pertanyaan'] .' (Voted : '. round($persen,2).'% ) </li>';
				$rec['name'] = $b['pertanyaan'];
				$rec['data'] = array($b['jumlah']);
				//$rec['persen'] = round($persen,2);
				$data[] = $rec;
			}
			//echo '</ul><br>';
			//echo $r['catatan'];
			
			$record['judul'] = $judul;
			$record['data'] = json_encode($data, JSON_NUMERIC_CHECK);
			$result[] = $record;
			
		}
		
		echo json_encode($result);
	break;
	
}

?>