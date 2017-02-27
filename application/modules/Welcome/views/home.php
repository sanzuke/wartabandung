<div class="col-md-8 col-sm-8 col-xs-12" style="margin:0px; padding:0px;">
  <div class="tabNewsx col-md-6 col-xs-12 hidden-xs" >
        <div id="liveclock"></div>
        <div id="tabsx" >
            <ul class="nav nav-tabs">
                <li role="presentation" class="active"><a data-toggle="tab" href="#tabs-1"><b><i class="fa fa-newspaper-o"></i> Terkini</b></a></li>
                <li role="presentation"><a data-toggle="tab" href="#tabs-2"><b><i class="fa fa-bookmark"></i> Terpopuler</b></a></li>
            </ul>

            <div class="tab-content">
              <div id="tabs-1" class="tab-pane fade in active">
                <div class="list-group">
              	<?php
      					$qterkini=$this->db->query("select * from post where jenis='post' and publish='1' and kategori not in ('foto') order by tgl desc limit 0 , 9");
      					// while($rterkini=mysql_fetch_array($qterkini)){
                foreach ($qterkini->result_array() as $rterkini) {
		  if($rterkini['judul'] > 60){
		  	$jdl = substr($rterkini['judul'],0,60)."...";
		  } else {
		  	$jdl = $rterkini['judul'];
		  }
                  $link = base_url() ."berita/lihat/".$this->main_model->generateLinkBerita($rterkini['id'],$rterkini['judul']);
      		  echo '<a class="list-group-item" title="'.$rterkini['judul'].'" href="'.$link.'" style="font-size:13px;">'.$jdl.'</a>';
      					}
      					?>
                </div>
              </div>
              <div id="tabs-2" class="tab-pane fade">
                <div class="list-group">
              	<?php
      					$qTp=$this->db->query("select * from post where jenis='post' order by viewer desc limit 0 , 9");
      					// while($b=mysql_fetch_array($qTp)){
                foreach ($qTp->result_array() as $b) {
                  $link = base_url() ."berita/lihat/".$this->main_model->generateLinkBerita($b['id'],$b['judul']);
                  echo '<a class="list-group-item" title="'.$b['judul'].'" href="'.$link.'" style="font-size:13px;">'.substr($b['judul'],0,70).'...</a>';
      						// echo '<a class="list-group-item" href="'.base_url().'?page=view&amp;id='.$rterkini['id'].'">'.substr($b['judul'],0,70).'... <span class="badge pull-right">'.$b['viewer'].' Viewer</span></a>';
      					}
      					?>
                </div>
              </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xs-12">
      <div style="min-height:270px; overflow:hidden;">
      <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <?php
        $qHL=$this->db->query("select * from post where headline='1' and kategori not in ('foto') order by tgl desc limit 0,5");
        // $jml = mysql_num_rows($qHL);
        $jml = $qHL->num_rows();
        ?>
        <!-- Indicators -->
        <ol class="carousel-indicators">
          <?php
          for ($i=1; $i <= $jml; $i++) {
            # code...
            if($i == 1){
              echo '<li data-target="#myCarousel" data-slide-to="'.$i.'" class="active"></li>';
            } else {
              echo '<li data-target="#myCarousel" data-slide-to="'.$i.'"></li>';
            }
          }
          ?>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
          <?php $x = 1;
            // while($rHL=mysql_fetch_array($qHL)){
            foreach ($qHL->result_array() as $rHL) {
              if($x== 1){ $act ='active'; } else { $act = '';
            }
          ?>
          <div class="item <?php echo $act ?>">
            <img src="upload/<?php echo $rHL['photo'] ?>" alt="<?php echo $rHL['judul'] ?>">
            <div class="carousel-caption">
              <h3><?php echo $rHL['judul'] ?></h3>
              <!-- <p>The atmosphere in Chania has a touch of Florence and Venice.</p> -->
            </div>
          </div>
          <?php $x++; } ?>
        </div>

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
      </div>

      <div id="foto">
        <div class="rss"><a href="#"><img src="images/ico_rss_1.gif" /></a></div>
          <div class="title">Foto</div>
          <?php
             $q=$this->db->query("select * from post where kategori='foto' order by tgl desc limit 0,6");
            //  while($rFoto=mysql_fetch_array($q)){
            foreach ($q->result_array() as $rFoto) {
          ?>
        <div id="isiFotox" class="pull-left" style="height:100px;">
          <a href="<?php echo base_url() . "galeri" ?>" title="<?php echo $rFoto['judul'] ?>">
            <img src="upload/<?php echo $rFoto['photo'] ?>" width="100" class="img-thumbnail" /></a><br>
            <?php echo substr($rFoto['judul'],0,10) ?>
          </div>
          <?php
              }
          ?>
          <div id="clear"></div>
      </div>
    </div>

    <div class="tabNewsx col-md-6 col-xs-12 hidden-md " >
          <div id="liveclock"></div>
          <div id="tabsx" >
              <ul class="nav nav-tabs">
                  <li role="presentation" class="active"><a data-toggle="tab" href="#tabs-1"><i class="fa fa-newspaper-o"></i> Terkini</a></li>
                  <li role="presentation"><a data-toggle="tab" href="#tabs-2"><i class="fa fa-bookmark"></i> Terpopuler</a></li>
              </ul>

              <div class="tab-content">
                <div id="tabs-1" class="tab-pane fade in active">
                  <div class="list-group">
                	<?php
        					$qterkini=$this->db->query("select * from post where jenis='post' and publish='1' and kategori not in ('foto') order by tgl desc limit 0 , 9");
        					// while($rterkini=mysql_fetch_array($qterkini)){
                  foreach ($qterkini->result_array() as $rterkini) {
                    $link = base_url() ."berita/lihat/".$this->main_model->generateLinkBerita($rterkini['id'],$rterkini['judul']);
        						echo '<a class="list-group-item" href="'.$link.'">'.substr($rterkini['judul'],0,80).'...</a>';
        					}
        					?>
                  </div>
                </div>
                <div id="tabs-2" class="tab-pane fade">
                  <div class="list-group">
                	<?php
        					$qTp=$this->db->query("select * from post where jenis='post' order by viewer desc limit 0 , 9");
        					// while($b=mysql_fetch_array($qTp)){
                  foreach ($qTp->result_array() as $b) {
                    $link = base_url() ."berita/lihat/".$this->main_model->generateLinkBerita($rterkini['id'],$rterkini['judul']);
                    echo '<a class="list-group-item" href="'.$link.'">'.substr($b['judul'],0,70).'...</a>';
        						// echo '<a class="list-group-item" href="'.base_url().'?page=view&amp;id='.$rterkini['id'].'">'.substr($b['judul'],0,70).'... <span class="badge pull-right">'.$b['viewer'].' Viewer</span></a>';
        					}
        					?>
                  </div>
                </div>
              </div>
          </div>
      </div>
      
      <div class="clearfix"></div>
    <!-- <div class="row"> -->
      <div class="col-md-12">
          <?php $this->main_model->loadIklan("bannertengah1"); ?>
      </div>
    <!-- </div> -->
    <div id="clear"></div>

</div>

<div class="iklanx col-md-4 col-sm-4 col-xs-12"><br>
  <!-- ====================================== Banner Iklan Display 1 ======================== -->
  <?php
  $this->main_model->loadIklan("display1");
  echo '<div style="height:10px;"></div>';/*$main->loadPolling();*/
  $this->main_model->loadIklan("display2"); 
  echo '<div style="height:20px;" class="clearfix"></div>'; ?><br>
</div>
<br>
<div class="row">
    <div id="bgKontenx" class="col-md-12"><br>
            <?php
			$q=$this->db->query("select k.*,
      (SELECT count(p.id) FROM post p WHERE p.kategori = k.kategori) as jml
      from kategori k
      where k.home='1';");
			$i=1;
			// while($r=mysql_fetch_array($q)){
      foreach ($q->result_array() as $r) {
        if( $r['jml'] > 0 ){
			?>
              <?php $this->main_model->listPostHome($r['kategori']) ?>
            <?php
				if($i==3){
					?>
          <!-- ============== Begin ads tengah ====================== -->
          <!-- <div style="width:956px; margin:0 auto; text-align:center; padding:5px;"> -->
          <!--<div class="col-md-12 hidden-md hidden-lg">
            <div class="row"><div class="col-md-6 col-xs-12 col-sm-12" ><?php $this->main_model->loadIklan("bannertengah2"); ?></div></div>
<div class="hidden-md hidden-lg" style="height:20px;"></div>
            <div class="row"><div class="col-md-6 col-xs-12" ><?php $this->main_model->loadIklan("bannertengah3"); ?></div></div>
          </div>-->
          <div class="col-md-12 hidden-smx hidden-xsx">
            <div class="col-md-6 col-xs-12 col-sm-12" ><?php $this->main_model->loadIklan("bannertengah2"); ?></div>
<div class="hidden-md hidden-lg" style="height:20px;"></div>
            <div class="col-md-6 col-xs-12" ><?php $this->main_model->loadIklan("bannertengah3"); ?></div>
          </div>
          <br>
          <!-- ============== End ads tengah ====================== -->
          <?php
				}
        $i++;
      }


			}
			?>

            <!-- <div id="clear"></div> -->
  </div>
</div>
