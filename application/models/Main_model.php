<?php
class Main_model extends CI_Model {
    public function __construct()
    {
      parent::__construct();
      // Your own constructor code
    }

  	var $config = array();
  	var $urlFilter = array(".","/"," ");

  	function loadSocial(){
      $q  = $this->db->query("select * from setting where id='1'");
  		$r  = $q->row();
  		$fb = $r->fb;
  		$tw = $r->tw;
  		$ig = $r->ig;

  		if($fb != '' ){
  			echo '<a href="'.$fb.'"><img src="'.base_url().'images/ico_fb.gif" /></a>';
  		}
  		if($tw != '' ){
  			echo '<a href="'.$tw.'"><img src="'.base_url().'images/ico_tw.gif" /></a>';
  		}
  		if($ig != '' ){
  			echo '<a href="'.$ig.'"><img src="'.base_url().'images/icon-instagram.png" width="20" /></a>';
  		}
  	}

  	function loadIklan($nil){
      $iklan = $this->db->query("select * from iklan where Jenis_iklan='$nil'");
  		$r=$iklan->row();
  		$ukuran=explode("x",$r->ukuran);
  		if($r->tipe_file=="jpg"){
  			if($r->link == '#SS'){
  			echo '<a href="javascript:void(0)" onclick="zoomimage(\'http://wartabandung.com/iklan/'.$r->file.'\')"><img src="'.base_url().'iklan/'.$r->file.'" width="100%" /></a>';
  			} else {
  			echo '<a href="'.$r->link.'" target="_blank"><img src="'.base_url().'iklan/'.$r->file.'" width="100%" class="img-responsive" /></a>';
  			}
  		} else if($r->tipe_file=="swf"){
  			?>
              <a href="<?php echo $r->link ?>" target="_blank">
                <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="<?php echo $ukuran[0] ?>" height="<?php echo $ukuran[1] ?>">
                <param name="movie" value="http://wartabandung.com/iklan/<?php echo base_url()."iklan/".$r->file ?>" />
                <param name="quality" value="high" />
                <param name="allowScriptAccess" value="always" />
                <param name="wmode" value="transparent">
                   <embed src="<?php echo base_url()."iklan/".$r->file ?>"
                    quality="high"
                    type="application/x-shockwave-flash"
                    WMODE="transparent"
                    width="<?php echo $ukuran[0] ?>"
                    height="<?php echo $ukuran[1] ?>"
                    pluginspage="http://www.macromedia.com/go/getflashplayer"
                    allowScriptAccess="always" />
              </object></a>
              <?php
  		} else {
  			$ukuranArray=explode("x",$r->ukuran);
  			echo '<div style="text-align:center; width:'.$ukuran[0].'px; height:'.$ukuran[1].'px; border:1px solid #e7e7e7;"><h1>Iklan tersedia</h1></div>';
  		}
  	}

  	function loadFormReservation(){
  	?>
  	<fieldset style="padding:10px; border-radius:4px; -moz-border-radius:4px; -webkit-border-radius:4px; border:1px solid #e7e7e7;">
  	<legend><h2 style="margin:0">Reserfasi Hotel</h2></legend>
  	<form id="reservasiFrm">
  		Nama Hotel<br>
  		<select name="nama_hotel">
  			<option value="">[ Pilih Hotel ]</option>
  			<?php
  			$qq=$this->db->query("select * from hotel order by nama asc");
  			while($rr=mysql_fetch_array($qq)){
  				echo '<option value="'.$rr['no'].'">'.$rr['nama'].'</option>';
  			}
  			?>
  		</select><br>
  		Nama<br>
  		<input type="text" name="nama" size="20"><br>
  		Alamat<br>
  		<input type="text" name="alamat" size="40"><br>
  		Email<br>
  		<input type="text" name="email" size="20"><br>
  		Tipe Kamar<br>
                  <input type="text" name="tipe" size="20"><br>
                  <input type="radio" name="jns" value="single" > Single<br>
                  <input type="radio" name="jns" value="double" > Double<br>
  		<input type="radio" name="jns" value="tripel" > Tripel<br>
                  Check In<br>
                  <input type="text" name="checkin" size="10" ><br>
                  Check Out<br>
                  <input type="text" name="checkout" size="10" ><br>
                  Permintaan Lain<br>
                  <textarea cols="30" rows="3"></textarea><br>
                  <input type="submit" name="submitReservasi" value="Pesan" >
  	</form>
  	</fieldset>
  	<?php
  	}


  	function listPostHome($kat){
  		$q=$this->db->query("select * from post where kategori='".$kat."' order by tgl desc limit 0 , 6");
  		// $r1=mysql_fetch_array($q);
      $r1 = $q->result_array();
  		// $jml = mysql_num_rows($q);
      $jml = $q->num_rows();
  		if($jml > 0){
  			?>
  		<div id="menuKontenx" class="col-md-4 col-xs-12">
  		<div class="panel panel-default">
      	<div class="panel-heading"><b><?php echo ucwords(strtolower($kat)) ?></b></div>
  			<!-- <div class="panel-bodyx" style="min-height:250px;"> -->
      	<!-- <h4><a href="<?php echo base_url() .'?page=view&amp;id='.$r1['id'] ?>"><?php echo $r1['judul'] ?></a></h4> -->
          <ul class="list-group" style="min-height:265px;">
          	<?php
  					// while($r=mysql_fetch_array($q)){
            foreach ($q->result_array() as $r) {
  						if(strlen($r['judul'])>43){
  						$jdl=substr($r['judul'],0,43) . "...";
  						} else {
  						$jdl=$r['judul'];
  						 }
              $link = base_url() ."berita/lihat/".$this->main_model->generateLinkBerita($r['id'],$r['judul']);
  		        echo '<li class="list-group-item"><a style="font-size:13px;" href="'. $link .'" title="'.$r['judul'].'">'.$jdl.'</a></li>';
  					}
              ?>
          </ul>
  			<!-- </div> -->
  		</div>
  		</div>
      <?php
  		}
  	}

    function generateLinkBerita($id, $judul){
      $find = array(',','.','&','!',':',' ');
      $replace = array('_','_','dan','_','_','_');
      $hasil = $id."_".str_replace($find, $replace, $judul);
      return $hasil;
    }

    function getIdFromLink($link){
      $is = explode("_", $link);
      return $is[0];
    }

    function getCategoryFromPost($id, $link){
      $q = $this->db->query("SELECT kategori FROM post Where id = '{$id}' ");
      $r = $q->row();

      if($link == true){
        return '<a href="'.base_url().'kategori/lihat/'.$r->kategori.'">'.ucwords(strtolower($r->kategori)).'</a>';
      } else {
        return ucwords(strtolower($r->kategori));
      }
    }

    function totalPageRowCategory($kategori){
      $q = $this->db->query("SELECT COUNT(*) as jumlah FROM post WHERE kategori = '{$kategori}'");
      $row = $q->row();
      return $row->jumlah;
    }

    function getTitle(){
      $id = $this->getIdFromLink($this->uri->segment(3));
      if( strlen($id) >= 1){
        $q = $this->db->query("SELECT judul FROM post Where id = '{$id}' ");
        $r = $q->row();
        return $r->judul;
      } else {
        return "Portal Berita Seputar Bandung Raya";
      }

    }

  	// function loadMenuLink(){
  	// 	$q=$this->db->query("select * from kategori where child='0' and publish='1' order by no asc");
  	// 	echo '<div id="smoothmenu1" class="ddsmoothmenu">';
  	// 	echo '<ul>';
  	// 	echo '<li><a href="'.base_url().'">home</a></li>';
  	// 	while($r=mysql_fetch_array($q)){
  	// 		echo '<li><a href="'.base_url().'?page='.$r['kategori'].'">'.$r['kategori'].'</a>';
  	// 			$qq=$this->db->query("select * from kategori where child='".$r[no]."'");
  	// 			$jum=mysql_num_rows($qq);
  	// 			if($jum>0){
  	// 				echo '<ul>';
  	// 				while($rr=mysql_fetch_array($qq)){
  	// 					echo '<li><a href="'.base_url().'?page='.$rr['kategori'].'">'.$rr['kategori'].'</a></li>';
  	// 				}
  	// 				echo '</ul>';
  	// 			}
  	// 		echo'</li>';
  	// 	}
  	// 	echo '</ul>';
  	// 	echo '</div>';
  	// }

  	function loadMenuLink(){
  		$q=$this->db->query("select * from kategori where child='0' and publish='1' order by no asc");
  		echo '<nav class="navbar navbar-default">';
  		echo '<div class="container-fluid">';
  		echo '<div class="navbar-header">
  				      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
  				        <span class="sr-only">Toggle navigation</span>
  				        <span class="icon-bar"></span>
  				        <span class="icon-bar"></span>
  				        <span class="icon-bar"></span>
  				      </button>
  							<a class="navbar-brand" href="'.base_url().'"><i class="fa fa-home"></i></a>
  				    </div>';
  		echo '<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">';
  		echo '<ul class="nav navbar-nav">';
  		//echo '<li class="text-capitalize"><a href="'.base_url().'">home</a></li>';
  		// while($r=mysql_fetch_array($q)){
      foreach ($q->result_array() as $r) {
  				$qq=$this->db->query("select * from kategori where child='".$r['no']."'");
  				$jum=$qq->num_rows();
  				if($jum>0){
  					echo '<li class="dropdown">
  						<a href="'.base_url().'?page='.$r['kategori'].'" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.strtoupper($r['kategori']).' <span class="caret"></span></a>';
  					echo '<ul class="dropdown-menu">';
  					// while($rr=mysql_fetch_array($qq)){
            foreach ($qq->result_array() as $rr) {
  						echo '<li><a href="'.base_url().'?page='.$rr['kategori'].'">'.strtoupper($rr['kategori']).'</a></li>';
  					}
  					echo '</ul>';
  				} else {
            // echo '<li><a href="'.base_url().'?page='.$r['kategori'].'">'.strtoupper($r['kategori']).'</a>';
  					echo '<li><a href="'.base_url().'kategori/lihat/'.$r['kategori'].'">'.strtoupper($r['kategori']).'</a>';

  				}
  			echo'</li>';
  		}
  		echo '</ul>';
  		echo '</div>';
  		echo '</div>'; //container-fluid
  		echo '</nav>';
  	}

  	function sqlLoadTable($qry){
  		$perintah=$this->db->query($qry);
  		$brs=mysql_fetch_array($perintah);
  		return $brs;
  	}

  	function loadMetaKW($id){
  		$q=$this->db->query("select * from post where id='$id'");
  		$r=mysql_fetch_array($q);

  		$array[0]=$r['judul'];
  		$array[1]=substr(strip_tags($r['isi']),0,200);

  		return $array;
  	}

  	function loadPage($page){
  		if(!isset($page)){
  			// include("module/home.php");
        $this->load->view("home", true);
  		} else {
  			// echo '<div style="font-size:12px; border:0px solid #ccc; width:687px; float:left;">';
  			echo '<div class="col-md-8">';
  			switch($page){
  				case "produk": $this->loadProduk($_GET['id']);
  				break;
  				case "post": //$this->loadPost($_GET['id']);
  				break;
  				case "page": $this->loadSinglePage($_GET['id']);
  				break;
  				case "view": $this->loadPost($_GET['id']);
  				break;
  				case "foto": require("module/foto.php");
  				break;
  				case "cari.html":
  					$cari=str_replace(";","",$_POST['cari']);
  					$no=1;
  					$q=$this->db->query("select * from page where isi like '%".$cari."%' or judul like '%".$cari."%'");
  					while($r=mysql_fetch_array($q)){
  						$data[$no]['judul']=$r['judul'];
  						$data[$no]['isi']=$r['isi'];
  						$data[$no]['kat']=$r['kategori'];
  						$data[$no]['id']=$r['id'];
  						$data[$no]['link']=str_replace(" ","-",$r['judul']);
  						$no++;
  						$hal=$no;
  					}
  					$no=1;
  					$q=$this->db->query("select * from post where isi like '%".$cari."%' or judul like '%".$cari."%'");
  					while($r=mysql_fetch_array($q)){
  						$data[$no]['judul']=$r['judul'];
  						$data[$no]['isi']=$r['isi'];
  						$data[$no]['kat']=$r['kategori'];
  						$data[$no]['id']=$r['id'];
  						$data[$no]['link']="post";
  						$no++;
  						$post=$no;
  					}
  					$no=1;
  					$q=$this->db->query("select * from produk where isi like '%".$cari."%' or judul like '%".$cari."%'");
  					while($r=mysql_fetch_array($q)){
  						$data[$no]['judul']=$r['judul'];
  						$data[$no]['isi']=$r['isi'];
  						$data[$no]['kat']=$r['kategori'];
  						$data[$no]['id']=$r['id'];
  						$data[$no]['link']="produk";
  						$no++;
  						$prdk=$no;
  					}

  					$jum=$prdk+$post+$hal-1;
  					$x=1;
  					echo'<div id="isiBerita">
  					<div class="judul" style="color:#D66F38"><img src="'.base_url().'images/green_arrow.png" align="absmiddle" /> Cari Kata : <i>'.$_POST[cari].'</i>, Ditemukan '.$jum.'</div>';
  					while($x<=$jum){
  						echo '<div style="padding:10px; margin-bottom:5px;"><a href="'.base_url().$data[$x]["link"].'/'.$data[$x]["id"].'/'.str_replace(" ","-",$data[$x]["judul"]). '">'.$data[$x][judul].'</a><br>
  						'.substr(strip_tags($data[$x][isi]),0,200).'</div><hr>';
  						$x++;
  					}
  					echo'</div>';
  				break;
  				case "rss":
  				break;
  				default:

  					#$mystring = $page;
  					#$lenght   = strlen($mystring);
  					#$pos = substr($mystring,0, $lenght-5);
  					#$this->loadSinglePage($pos);
  					echo '<div id="posPagex">
  						<h4><a href="'.base_url().'"><i class="fa fa-home"></i> Home</a> &raquo; '.ucwords(strtolower($_GET['page'])).'</h4>
  					</div>';
  					$this->loadIndexPost(strtolower($page));
  			}
  			echo '<div id="clear"></div></div>';
  		}
  	}

  	function loadPosPage(){

  	}

  	function loadPost($idPost){
  		$qr=$this->db->query("select * from post where id='$idPost'");
  		$view=$qr->row();
  		return $view;
  	}

    function loadGaleri(){
      $view=$this->db->query("select * from post where kategori='foto' order by tgl desc limit 0,9");
  		return $view;
    }

  	function addViewer($id,$nilViewer){
  		$nilViewer++;
  		$q=$this->db->query("update post set viewer='$nilViewer' where id='$id'");
  	}

  	function loadProduk($idProduk){
  		$qr=$this->db->query("select * from produk where id='$idProduk'");
  		$view=mysql_fetch_array($qr);
  		echo'<div id="isiBerita">
  		<div class="judul" style="color:#D66F38;"><img src="'.base_url().'images/green_arrow.png" align="absmiddle" /> '.$view[judul] .'</div>
  		<!--<sub style="margin-bottom:15px;"><img src="'.base_url().'images/date-icon.jpg" width="10" align="absmiddle" /> '.date("d-m-Y, H:i:s",strtotime($view[tgl])).' WIB</sub><br>-->
  		';
  		if($view['photo']!=""){
  			echo'<img alt="" src="'.UPLOAD_PATH.$view['photo'].'" style="width: 120px; margin: 10px; float: right;" />';
  		}
  		echo $view[isi];
  		$this->loadGallery($_GET['id']);
  		$this->loadShareIcon();
  		echo '<div id="clear"></div></div>';

  		$this->loadFormKomentar();
  		$this->loadKomentar();
  	}

  	function loadSinglePage($pageId){
  		$qr=$this->db->query("select * from post where jenis='page' and id='$pageId'");
  		$view=mysql_fetch_array($qr);

  		echo'<div id="isiBerita">
  		<div class="judul" style="color:#D66F38"><img src="'.base_url().'images/green_arrow.png" align="absmiddle" /> '.$view[judul] .'</div>
  		<!--<sub style="margin-bottom:15px;"><img src="'.base_url().'images/date-icon.jpg" width="10" align="absmiddle" /> '.$view[tgl].'</sub><br>-->
  		'.$view[isi];
  		//$this->loadShareIcon();
  		echo '<div id="clear"></div></div>';
  		if($pageId=="Kuis Al-Mizan" or $pageId=="Pengalaman Mengaji"){
  			$_SESSION['judul']=$view['judul'];
  			$_SESSION['tanya']=$view[isi];
  			$this->loadFormKomentar();
  			//$this->loadKomentar();
  		}
  	}

  	function loadFormKomentar(){
  		require("class/recaptchalib.php");
  		if($_POST['submitKomen']){
  			  $privatekey = "6Lcpl8wSAAAAAErymLhtlwyY71tchLP78dMNcch6";
  			  $resp = recaptcha_check_answer ($privatekey,
  											$_SERVER["REMOTE_ADDR"],
  											$_POST["recaptcha_challenge_field"],
  											$_POST["recaptcha_response_field"]);

  			  if (!$resp->is_valid) {
  				// What happens when the CAPTCHA was entered incorrectly
  				$msg="<div id='msgBox'><img src='images/8.png' align='absmiddle'> <font color='red'>Maaf code yg anda masukan salah, mohon ulangi kembali</font><br><i>".$resp->error."</i></div>";

  			  } else {
  				  date_default_timezone_set("Asia/Jakarta");
  				  $tgl=date("Y-m-d, H:i:s");
  				  switch($_GET['page']){
  				  case "quiz.html": 	$pos="Quiz";
  				  break;
  				  case "Pengalaman Mengaji.html": $pos="Pengalaman Mengaji";
  				  break;
  				  default :
  				  	$pos=$_POST['posisi'];
  				  }
  				  if($_GET['page']=="quiz.html"){
  				  	$msg = $this->sendMailQuiz($_POST['nama'],$tgl,"quiz@almizanpublishing.com",$_POST['email'],$_POST['pesan'],$_SESSION['tanya']);
  				  }else {
  				  	$qry=$this->db->query("insert into komentar value(NULL,'".$_GET['id']."','$tgl','".$_POST['nama']."','".$_POST['email']."','".$_POST['pesan']."','0','".$pos."','".$_POST['judul']."')");

  				  	if($qry){
  						$msg="<div id='msgBox'><img src='admin/images/5.png' align='absmiddle'> <font color='green'>Data telah disimpan!</font></div>";
  						$_POST['nama']="";
  						$_POST['email']="";
  						$_POST['pesan']="";
  				  	} else {
  						$msg="<div id='msgBox'><img src='admin/images/8.png' align='absmiddle'> <font color='red'>Data gagal disimpan!</font><br><i>".mysql_error()."</i></div>";
  			      		}
  			      	}
  			  }

  		}
  		?>
    <div id="isiBeritas" class="panel panel-default">
  		<div class="judulx panel-heading"><img src="<?php echo base_url() ?>images/green_arrow.png" align="absmiddle" /> Kirim Komentar Anda</div>
  		<div class="panel-body">
          	<?php echo $msg ?>
              <form id="formkomentar" action="<?php echo $PHP_SELF ?>" method="post">
  						<div class="form-group">
  	            <label>Nama</label>
  	            <input type="text" class="form-control" name="nama" size="45" value="<?php echo $_POST['nama']?>" />
  						</div>
  						<div class="form-group">
  	            <label>Email</label>
  	            <input type="text" class="form-control" name="email" size="45" value="<?php echo $_POST['email']?>" />
  						</div>
  						<div class="form-group">
  	            <label>Komentar</label>
  	            <textarea name="pesan" class="form-control" rows="5" cols="41"><?php echo $_POST['pesan']?></textarea>
  						</div>
              <?php
              $publickey = "6Lcpl8wSAAAAAB2azzwcZm-fitTCP5MlNjKvCEpV"; // you got this from the signup page
            	echo recaptcha_get_html($publickey);
            	if($_GET['page']=="quiz.html"){
            		$jdl=$_SESSION['judul'];
            	} else {
            		$jdl=$_GET['op'];
            	}
              ?>
              <input type="hidden" name="posisi" value="<?php echo $_GET['page'] ?>" />
              <input type="hidden" name="judul" value="<?php echo $jdl ?>" />
              <button type="submit" name="submitKomen" class="btn btn-default" ><i class="fa fa-save"></i> Kirim</button>
              </form>
          </div>
  			</div>
          <?php
  	}

  	function loadKomentar(){
  		?>
  		<div id="isiBeritax" class="panel panel-default">
  		<div class="judulx panel-heading"><img src="<?php echo base_url() ?>images/green_arrow.png" align="absmiddle" /> Komentar Anda</div>
  			<div class="panel-body">
              	<?php
              	$qw=$this->db->query("select * from komentar where id_komen='".$_GET['id']."' and publish='1' order by id desc limit 0 , 6");
                  $iw=1;
  				$w=mysql_num_rows($qw);

  				if($w>0){
  				echo '<table width="100%">';
  					while($rw=mysql_fetch_array($qw)){
  						if($i % 2){
  							echo"<tr bgcolor='#ffffff'>";
  						}else {
  							echo"<tr bgcolor='#ffffff'>";
  						}
  						echo"<td align='center' valign='top' width='55'><img src='".base_url()."images/comment22.png' width='50'></td><td valign='top'>
  						<div style='border:dotted 2px #ccc;padding:2px; -moz-border-radius:5px; border-radius:5px; background-color:#FCEAAA;'>
  						$rw[nama]<br><sup style='color:#999;'>".date("d-m-Y, H:i:s",strtotime($rw[tgl]))." WIB</sup><br>".strip_tags($rw[pesan])."
  						</div>
  						</td></tr>";
  						$iw++;
  					}
  					echo"</table>";
  				}
  				?>
  			</div>
      </div>
      <?php
  	}

  	function loadShareIcon(){
  	?>
      	<br />
      	<fieldset style="border:1px solid #e6e6e6;">
          <legend>Share Me</legend>
  		<!-- AddThis Button BEGIN -->
          <div class="addthis_toolbox addthis_default_style ">
          <a class="addthis_button_preferred_1"></a>
          <a class="addthis_button_preferred_2"></a>
          <a class="addthis_button_preferred_3"></a>
          <a class="addthis_button_preferred_4"></a>
          <a class="addthis_button_preferred_5"></a>
          <a class="addthis_button_preferred_6"></a>
          <a class="addthis_button_preferred_7"></a>
          <a class="addthis_button_preferred_8"></a>
          <a class="addthis_button_compact"></a>
          <a class="addthis_counter addthis_bubble_style"></a>
          </div>
          <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4e23bba62bfccd7b"></script>
          <!-- AddThis Button END -->
          </fieldset>
      <?php
  	}

  	function loadOtherPost($kon, $id){
  		?>
      <div id="isiBeritax" class="panel panel-default">
  		<div class="judulx panel-heading"><img src="<?php echo base_url() ?>images/green_arrow.png" align="absmiddle" /> Artikel Lain</div>
  		<!-- <fieldset style="border:1px solid #e6e6e6; margin:10px 0px;"> -->
          	<ul class="list-group">
              <?php
              $q=$this->db->query("SELECT kategori FROM post WHERE id='".$id."'");
              $r=$q->row();
      				$q1=$this->db->query("select id, judul, kategori from post where kategori='".$r->kategori."' order by id desc limit 1 ,5");
      				// while($rr=mysql_fetch_array($q1)){
              // print_r($q1->result_array());
              foreach ($q1->result_array() as $row) {
      					//echo "<li><a href='".base_url() . "post/". $rr['id']."/". str_replace(" ","-",$rr['judul'])."' title='$rr[judul]'>".$rr['judul']."</a></li>";
                $link = base_url() ."berita/lihat/".$this->main_model->generateLinkBerita($row['id'],$row['judul']);
                echo "<li class='list-group-item'><a href='".$link."'>".$row['judul']."</a></li>";
      				}
      			  ?>
              </ul>
          <!-- </fieldset> -->
          </div>
          <?php
  	}

  	function loadGallery($id){
  	?>
      <script type="text/javascript">
  	function loadKonten(img,no){
  		myDivObj = document.getElementById("ket"+no);
  		jQuery("#imgSlide").html("<a href='<?php echo UPLOAD_PATH ?>"+ img +"' rel='lightbox'><img src='<?php echo UPLOAD_PATH ?>"+ img +"' width='249'></a>")
  		jQuery("#ketSlide").html(myDivObj.textContent)
  		///alert(myDivObj.textContent)
  	}
  	</script>
      <fieldset style="margin-top:20px; border-radius:5px; -moz-border-radius:5px; border:1px solid #e7e7e7;">
      <legend style="color:#D66F38;"><strong>Gambar Lain</strong></legend>
      <div style="width:100%; ">
      	<?php
  		$e=$this->db->query("select * from sub_imagesproduk where id='".$_GET['id']."' order by no asc");
  		$t=mysql_fetch_array($e);

  		?>
          <div style="border:1px solid #e7e7e7e;">
              <div style="width:39%; float:left; border:0px solid #e7e7e7;" id="imgSlide">
              <a href="<?php echo UPLOAD_PATH.$t['photo'] ?>" rel="lightbox"><img src="<?php echo UPLOAD_PATH.$t['photo'] ?>" width="249" /></a></div>
              <div style="width:60%; float:right; border:0px solid #e7e7e7;" id="ketSlide"><?php echo strip_tags($t['ket']) ?>
              </div>
              <div style="clear:both;"></div>
          </div>
          <?php
  		$qSlideImg=$this->db->query("select * from sub_imagesproduk where id='".$_GET['id']."' order by no asc");
  		$iS=1;
  		while($rS=mysql_fetch_array($qSlideImg)){
  		?>
          	<div style="border:1px solid #e7e7e7; padding:3px; margin:3px; float:left; cursor:pointer;" onmousemove="loadKonten('<?php echo $rS['photo'] ?>','<?php echo $iS ?>')">
              	<a href="<?php echo UPLOAD_PATH.$rS['photo'] ?>" rel='lightbox' >
              	<img src="<?php echo UPLOAD_PATH.$rS['photo'] ?>" width="90" id="imgS<?php echo $iS ?>">
              	</a>
                  <div id="ket<?php echo $iS ?>" style="display:none;"><?php echo $rS['ket'] ?></div>
              </div>
          <?php
  			$iS++;
  		}
  		?>
      </div>
      </fieldset>
      <?php
  	}


  	function sendMailQuiz($nama,$tgl,$email,$emailMember,$jawaban,$pertanyaan){
  		$subject="Jawaban Kuis Al-Mizan";

  		$header = "From: quiz@almizanpublishing\r\n";
  		$header .= "Content-type: text/html\r\n";

  		$body='
  		<strong>Pertanyaan :</strong><br>
  		'.$pertanyaan.'<br><br>
  		<hr>
  		Nama  : '.$nama.'<br>
  		Tanggal: '.$tgl.'<br>
  		Email : '.$emailMember.'<br>
  		<strong>Jawaban</strong><br>
  		'.$jawaban;

  		$success = mail($email, $subject, $body, $header);
  		if($success){
  			$msg="<div id='msgBox'><img src='admin/images/5.png' align='absmiddle'> <font color='green'>Data telah kami simpan!</font></div>";
  		} else {
  			$msg="<div id='msgBox'><img src='admin/images/8.png' align='absmiddle'> <font color='red'>Data gagal disimpan!</font></div>";
  		}
  		return $msg;
  	}

  	/* =========================== Generate Date =========================*/
  	function generateDate($d){
  		$hari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
  		$bulan = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");

  		$h=date("w",strtotime($d));
  		$b=date("m",strtotime($d));

  		$hasil=$hari[$h] .", ".date("d-m-Y H:i",strtotime($d)) ." WIB" ;

  		return $hasil;

  	}


  	/*=================================================== load index post ==========================*/
    function loadIndexPost($kategori, $limit, $start)
    {
        $sql = "select * from post where kategori='".$kategori."' and publish='1' order by tgl desc limit " . $start . ', ' . $limit;
        $query = $this->db->query($sql);
        return $query->result();
    }

  function loadPolling(){
  ?>
  <div id="menuKonten" style="width:278px; height:420px; margin:0px 0px 5px 0px; background-color:#FF6600; font-weight:bold;">
  			<div class="title">Poling Pilkada</div>
  			<form id="myForm">
  			<div id="polling">
  <?php
       $qPool = $this->db->query("SELECT * FROM polling
  			WHERE CURDATE() BETWEEN startdate
  			AND enddate AND publish = '1'");
  		while ($r = mysql_fetch_array($qPool)) {
  			# code...
  			echo '<p>'.$r['keterangan'].'</p>';
  			//echo '<br>';
  			$qTanya = $this->db->query("SELECT * FROM polling_tanya WHERE polling_id = '".$r['id']."' ");
  			while ($b = mysql_fetch_array($qTanya)) {
  			# code...
  				echo '<input type="radio" name="poll" value="'.$b['id'].'"> '.$b['pertanyaan'].'<br>';
  			}
  			echo '<br>';
  			echo $r['catatan'];
  		}
  ?>
  </div>
  			<div class="panel-footer" style="margin-top:5px; border-top:1px solid #aaa; padding-top:5px;">
  				<button class="btn btn-primary">Vote</button>
  			</div>
  			</form>
  		</div>
  	<script type="text/javascript">
  		$(document).ready(function(){
  			$("#myForm").submit(function(){
  				$.ajax({
  					type : "POST",
  					url  : "proses.php",
  					data : $(this).serialize(),
  					success : function(data){
  						if(data === 'true'){
  							alert("Terima kasih atas partisipasi anda.");
  							localStorage['im_in_vote'] = true;
  							$.cookie('im_in_vote', 'true');
  							window.location.reload();


  						}
  						//alert(data);
  					},
  					error : function(){
  						alert("Kesalahan pada server");
  					}
  				});
  				return false;
  			});

  			var GetVote = localStorage['im_in_vote'];
  			if( GetVote === 'true' || $.cookie('im_in_vote') === 'true' ){
  				//$.post("proses.php", {op:'list'}, function(data){
  				$.post("proses.php", {op:'grafik'}, function(data){
  					var d = JSON.parse(data);
  					$('#polling').highcharts({
  					        chart: {
  					            type: 'bar'
  					        },
  					        title: {
  					            text: d[0].judul
  					        },
  					        xAxis: {
  					            categories: [d[0].judul],
  					            title: {
  					                text: null
  					            },
              					    labels : { rotation: -90 }
  					        },
  					        yAxis: {
  					            min: 0,
  					            title: {
  					                text: 'Vote',
  					                align: 'high'
  					            },
  					            labels: {
  					                overflow: 'justify'
  					            }
  					        },
  					        tooltip: {
  					            valueSuffix: ' Vote'
  					        },
  					        plotOptions: {
  					            bar: {
  					                dataLabels: {
  					                    enabled: true
  					                }
  					            }
  					        },
  					        legend: {
  					            layout: 'vertical',
  					            align: 'right',
  					            verticalAlign: 'top',
  					            x: 0,
  					            y: 20,
  					            floating: true,
  					            borderWidth: 1,
  					            backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
  					            shadow: true
  					        },
  					        credits: {
  					            enabled: false
  					        },
  					        series: JSON.parse(d[0].data)
  					    });
  					    console.log(d[0].judul);
  					//$("#polling").html(data);
  					$(".btn").attr("disabled","disabled").css("display","none");
  				})

  			}

  		});
  	</script>
  <?php

  }
}
