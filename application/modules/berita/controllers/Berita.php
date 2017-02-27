<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berita extends MX_Controller {

	public function index()
	{

	}

  public function lihat()
  {
		$data['halaman'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$data['id'] = $this->main_model->getIdFromLink($this->uri->segment(3));
		$data['page'] = $this->main_model->getCategoryFromPost($data['id'], true);

    $data["kw"] = "KW";
		$data["des"] = "Des";
    // $data["page"] = $page;

    $data["konten"] = "berita_view";
  	$data["view"] = $this->main_model->loadPost($data['id']);
		$this->load->view('index', $data);
  }
}
