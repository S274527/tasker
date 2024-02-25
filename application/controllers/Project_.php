<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library("form_validation");
        $this->load->library("commonlib");
        $this->load->model("crudm");

        $this->commonlib->is_logged_in();
    }

    // create project
    public function index()
    {
        $this->commonlib->have_permission();

        $this->load->view('project/index');

    }

    // create project
    public function create()
    {
        $this->commonlib->have_permission();

        $this->load->view('project/create');

    }
}

?>