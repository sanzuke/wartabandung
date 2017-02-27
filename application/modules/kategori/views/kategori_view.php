<?php
echo '<div class="col-md-8">';
echo '<div id="posPagex">
        <h4><a href="'.base_url().'"><i class="fa fa-home"></i> Home</a> &raquo; '.ucwords(strtolower($page)).'</h4>
      </div>';
// $this->main_model->loadIndexPost(strtolower($page));
echo("<ul class='pagination'>");
echo $pagination;
echo("</ul>");
echo '<div class="clearfix"></div>';
foreach ($datakategori as $row) {
  # code...
  $link = base_url() ."berita/lihat/".$this->main_model->generateLinkBerita($row->id,$row->judul);
  ?>
  <div id="listContent">
    <h4><a href="<?php echo $link ?>"><?php echo $row->judul ?></a></h4>
      <sup><?php echo $this->main_model->generateDate($row->tgl) ?></sup><br>
      <div class="img">
        <img src="<?php echo base_url() .'upload/' . $row->photo ?>" width="80" />
      </div>
      <?php echo substr(strip_tags($row->isi),0,400) ?>...
      <div style="clear:both"></div>
  </div>
  <?php
}
echo '<div class="clearfix"></div>';
echo("<ul class='pagination'>");
echo $pagination;
echo("</ul>");
echo '</div>';

?>
