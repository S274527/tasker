<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->library("form_validation");
        $this->load->library("commonlib");
        $this->load->model("crudm");

        $this->commonlib->is_logged_in();
    }

	public function index()
	{

        // show totals as per admin and standard user
        if($this->session->userdata('role_id') == 2) { 
            redirect('task');
        }

        $data['projects_total'] = count($this->crudm->get_all('project', ['is_active' => 'Y']));
        $data['tasks_total'] = count($this->crudm->get_all('task', ['is_active' => 'Y']));
        $data['users_total'] = count($this->crudm->get_all('user', ['is_active' => 'Y']));

        $user_id = $this->session->userdata('user_id');
        $user_data = $this->crudm->get_all('user',['user_id' => $user_id], ['user_id', 'role_id', 'email', 'full_name']);
        $data['user_data'] = $user_data;
        $data['title'] = 'Dashboard';
        $data['inner_template'] = "dashboard";
        $this->load->view('layout/layout_dashboard.php', $data);
    }
}

?>