<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Galeri extends MX_Controller {

  public function index()
  {
		// $data['halaman'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		// $data['id'] = $this->main_model->getIdFromLink($this->uri->segment(3));
		$data['page'] = "Galeri Foto";

    $data["kw"] = "KW";
		$data["des"] = "Des";
    // $data["page"] = $page;

    $data["konten"] = "galeri_view";
  	$data["galeri"] = $this->main_model->loadGaleri();
		$this->load->view('index', $data);
  }
}
