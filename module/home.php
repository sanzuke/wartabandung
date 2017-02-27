<div class="col-md-8 col-sm-8 col-xs-12" style="margin:0px; padding:0px;">
  <div class="tabNewsx col-md-6 col-xs-12 hidden-xs" >
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
                foreach ($qterkini->result_array() as $$rterkini) {
      						echo '<a class="list-group-item" href="'.base_url().'?page=view&amp;id='.$rterkini['id'].'">'.substr($rterkini['judul'],0,80).'...</a>';
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
                  echo '<a class="list-group-item" href="'.base_url().'?page=view&amp;id='.$rterkini['id'].'">'.substr($b['judul'],0,70).'...</a>';
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
        $jml = $qHl->num_rows();
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
          <?php $x = 1; while($rHL=mysql_fetch_array($qHL)){ if($x== 1){ $act ='active'; } else { $act = ''; }?>
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
             while($rFoto=mysql_fetch_array($q)){
          ?>
        <div id="isiFotox" class="pull-left" style="height:100px;">
          <a href="?page=foto" title="<?php echo $rFoto['judul'] ?>">
            <img src="upload/<?php echo $rFoto['photo'] ?>" width="100" class="img-thumbnail" /></a><br>
            <?php echo substr($rFoto['judul'],0,10) ?>
          </div>
          <?php
              }
          ?>
          <div id="clear"></div>
      </div>
    </div>

    <div class="tabNewsx col-md-6 col-xs-12 hidden-md hidden" >
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
        					while($rterkini=mysql_fetch_array($qterkini)){
        						echo '<a class="list-group-item" href="'.base_url().'?page=view&amp;id='.$rterkini['id'].'">'.substr($rterkini['judul'],0,80).'...</a>';
        					}
        					?>
                  </div>
                </div>
                <div id="tabs-2" class="tab-pane fade">
                  <div class="list-group">
                	<?php
        					$qTp=$this->db->query("select * from post where jenis='post' order by viewer desc limit 0 , 9");
        					while($b=mysql_fetch_array($qTp)){
                    echo '<a class="list-group-item" href="'.base_url().'?page=view&amp;id='.$rterkini['id'].'">'.substr($b['judul'],0,70).'...</a>';
        						// echo '<a class="list-group-item" href="'.base_url().'?page=view&amp;id='.$rterkini['id'].'">'.substr($b['judul'],0,70).'... <span class="badge pull-right">'.$b['viewer'].' Viewer</span></a>';
        					}
        					?>
                  </div>
                </div>
              </div>
          </div>
      </div>
    <!-- <div class="row"> -->
      <div class="col-md-12">
      	<!--<a href="javascript:void(0)" id="frmreservasion">
          	<div id="reservasi"><h1>Reservasi Hotel</h1></div>
          </a>-->
          <?php $this->loadIklan("bannertengah1"); ?>
      </div>
    <!-- </div> -->
    <div id="clear"></div>

</div>

<div class="iklanx col-md-4 col-sm-4 col-xs-12">
  <!-- ====================================== Banner Iklan Display 1 ======================== -->
  <?php
  $this->loadIklan("display1");
  echo '<div style="height:10px;"></div>';/*$main->loadPolling();*/
  $this->loadIklan("display2"); ?>
</div>
<br>
<div class="row">
    <div id="bgKontenx" class="col-md-12">
            <?php
			$q=$this->db->query("select k.*,
      (SELECT count(p.id) FROM post p WHERE p.kategori = k.kategori) as jml
      from kategori k
      where k.home='1';");
			$i=1;
			while($r=mysql_fetch_array($q)){
        if( $r['jml'] > 0 ){
			?>

              <?php $this->listPostHome($r['kategori']) ?>
            <?php
				if($i==3){
					?>
          <!-- ============== Begin ads tengah ====================== -->
          <!-- <div style="width:956px; margin:0 auto; text-align:center; padding:5px;"> -->
          <div class="col-md-12">
            <div class="col-md-6" ><?php $this->loadIklan("bannertengah2"); ?></div>
            <div class="col-md-6" ><?php $this->loadIklan("bannertengah3"); ?></div>
          </div>
          <div class="clearfix"></div>
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
