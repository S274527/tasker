<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library("form_validation");
        $this->load->library("commonlib");
        $this->load->model("crudm");
    }

	public function index()
	{
        $data['inner_template'] = "home";
        $this->load->view('layout/layout_main.php', $data);
	}
}
