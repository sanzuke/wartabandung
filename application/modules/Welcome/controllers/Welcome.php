<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MX_Controller {

	public function index()
	{
		$data["kw"] = "KW";
		$data["des"] = "Des";
		$data["page"] = $this->uri->segment(1);

		$data["konten"] = "home";
		$this->load->view('index', $data);
	}

	public function kategoris(){
		
	}
}
