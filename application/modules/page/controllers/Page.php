<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends MX_Controller {

	public function index()
	{

	}

  public function lihat()
  {
		// $data['halaman'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$data['id'] = $this->main_model->getIdFromLink($this->uri->segment(3));
		switch($data['id']){
			case "8":
				$judulhalaman = "Tentang Kami";
			break;
			case "9":
				$judulhalaman = "Redaksi";
			break;
			case "10":
				$judulhalaman = "Kontak";
			break;
			case "11":
				$judulhalaman = "Disclimer";
			break;
		}
		$data['page'] = $judulhalaman;

    $data["kw"] = "KW";
		$data["des"] = "Des";
    // $data["page"] = $page;

    $data["konten"] = "page_view";
  	$data["view"] = $this->main_model->loadPost($data['id']);
		$this->load->view('index', $data);
  }
}
