<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends MX_Controller {

	public function index()
	{

	}

  public function lihat()
  {
    $data['page'] = $this->uri->segment(3);
		$data['halaman'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

    $data["kw"] = "KW";
		$data["des"] = "Des";
    // $data["page"] = $page;

    $data["konten"] = "kategori_view";
    $config['base_url'] = base_url().'kategori/lihat/'.$data['page'].'/';//'http://example.com/index.php/test/page/';
    $config['total_rows'] = $this->main_model->totalPageRowCategory($data['page']);
    $config['per_page'] = 20;

    //config for bootstrap pagination class integration
    $config['full_tag_open'] = '<ul class="pagination">';
    $config['full_tag_close'] = '</ul>';
    $config['first_link'] = false;
    $config['last_link'] = false;
    $config['first_tag_open'] = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['prev_link'] = '&laquo';
    $config['prev_tag_open'] = '<li class="prev">';
    $config['prev_tag_close'] = '</li>';
    $config['next_link'] = '&raquo';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';
    $config['last_tag_open'] = '<li>';
    $config['last_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="active"><a href="#">';
    $config['cur_tag_close'] = '</a></li>';
    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';

    $this->pagination->initialize($config);

		//call the model function to get the department data
    $data['datakategori'] = $this->main_model->loadIndexPost($data['page'], $config["per_page"], $data['halaman']);

    $data['pagination'] = $this->pagination->create_links();
		$this->load->view('index', $data);
  }
}
