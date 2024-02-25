<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assign extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library("form_validation");
        $this->load->library("commonlib");
        $this->load->model("crudm");

        $this->commonlib->is_logged_in();
        $this->commonlib->have_permission();
        
        $this->load->library('pagination');
    }

    // list users
    public function index()
    {

        $search = $this->commonlib->get_post('search_email');
        $conditions['table'] = 'user';
        $conditions['conditions'] = ['is_active' => 'Y', 'role_id' => 2];
        $conditions['join'] = array(array("user_project","user_project.user_id = user.user_id"));
        $conditions['searchKeyword'] = [];
        if($search != '') {
            $conditions['searchKeyword'] = ['email' => $search];
        }
        $conditions['returnType']    = 'count';
        $rowsCount = $this->crudm->get_rows($conditions);
        
        $config['base_url']    = base_url('assign/index/');
        $config['uri_segment'] = 3;
        $config['total_rows']  = $rowsCount;
        
        $this->pagination->initialize($config);
        
        $page = $this->uri->segment(3);
        $offset = !$page?0:$page;
        
        $conditions['returnType'] = '';
        $conditions['start'] = $offset;
        $conditions['limit'] = 10;
        $data['users'] = $this->crudm->get_rows($conditions);
        
        $data['total'] = count($this->crudm->get_all('user', ['is_active' => 'Y', 'role_id' => 2]));
        $data['inner_template'] = "assign/index";

        $user_id = $this->session->userdata('user_id');
        $user_data = $this->crudm->get_all('user',['role_id' => $user_id], ['user_id', 'role_id', 'email', 'full_name']);
        $data['user_data'] = $user_data;
        $data['title'] = 'Assigned Projects';
        $this->load->view('layout/layout_dashboard.php', $data);

    }

    public function assign_projects($id)
    {
        if($_POST) {

            header('Content-Type: application/json');
            
            $aData = [];

            $projects = "";
            if(!empty($this->commonlib->get_post('projects'))) {
                $projects = implode(",", $this->commonlib->get_post('projects'));
            }

            $aData = [
                'user_id'     => $id,
                'project_id'  => $projects
            ];
            
            $update_id = $this->crudm->db_update('user_project', $aData, ['user_id' => $id]);
            if($update_id) {
                die(json_encode(['success' => true, 'msg' => 'Projects are Assigned Successfully', 'class' => 'text-success']));
            }

            die(json_encode(['success' => false, 'msg' => 'Something Went Wrong', 'class' => 'text-danger']));

        }

        $data['user'] = $this->crudm->get_all('user', ['user_id' => $id], ['user_id', 'full_name']);
        $user_projects = $this->crudm->get_all('user_project', ['user_id' => $id], ['project_id']);
        $data['user_projects'] = explode(",", $user_projects[0]->project_id);
        $data['projects'] = $this->crudm->get_all('project', ['is_active' => 'Y']);
        $data['inner_template'] = "assign/assign_projects";

        $user_id = $this->session->userdata('user_id');
        $user_data = $this->crudm->get_all('user',['user_id' => $user_id], ['user_id', 'role_id', 'email', 'full_name']);
        $data['user_data'] = $user_data;
        $data['title'] = 'Assign Projects';
        $this->load->view('layout/layout_dashboard.php', $data);
    }
}
?>