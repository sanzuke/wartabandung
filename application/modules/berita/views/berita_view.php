<?php
echo '<div class="col-md-8">';
echo '<div id="posPagex">
        <h4><a href="'.base_url().'"><i class="fa fa-home"></i> Home</a> &raquo; '.ucwords(strtolower($page)).'</h4>
      </div>';
echo'<div id="isiBerita" >
<h2 style="padding:0px; font-weight:bold;">'.$view->judul .'</h2>
<sub style="margin-bottom:15px;"><i class="fa fa-calendar"></i> '.$this->main_model->generateDate($view->tgl).'</sub><br>
';
if($view->photo!=""){
  echo'<div style="background-color:#e8e8e8; margin-bottom:10px;">
      <img alt="'.$view->judul.'" src="'.base_url() .'upload/'.$view->photo.'" class="thumbnail" style="width:100%; margin: 5px 0;" />
      <div style="padding:4px 0;"></div>
    </div>';
}
echo str_replace("<hr />","",$view->isi);
echo $this->main_model->loadShareIcon();
echo '<div id="clear"></div></div>';
echo $this->main_model->loadOtherPost($view->kategori, $id);
//$this->loadFormKomentar();
//$this->addViewer($view->id,$view->viewer);
//$this->loadKomentar();
//echo "Kategori : ".$view['kategori'];
echo '</div>';

?>
