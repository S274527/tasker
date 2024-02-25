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
        $this->commonlib->have_permission();
        
        $this->load->library('pagination');
    }

    // list projects
    public function index()
    {

        $search = $this->commonlib->get_post('search_name');
        $conditions['table'] = 'project';
        $conditions['conditions'] = ['is_active' => 'Y'];

        $conditions['searchKeyword'] = [];
        if($search != '') {
            $conditions['searchKeyword'] = ['name' => $search];
            $this->session->set_userdata('search', $search);
        }
        $conditions['returnType']    = 'count';
        $rowsCount = $this->crudm->get_rows($conditions);
        
        $config['base_url']    = base_url('project/index/');
        $config['uri_segment'] = 3;
        $config['total_rows']  = $rowsCount;
        
        $this->pagination->initialize($config);
        
        $page = $this->uri->segment(3);
        $offset = !$page?0:$page;
        
        $conditions['returnType'] = '';
        $conditions['start'] = $offset;
        $conditions['limit'] = 10;
        $data['projects'] = $this->crudm->get_rows($conditions);

        $data['total'] = count($this->crudm->get_all('project', ['is_active' => 'Y']));
        $data['inner_template'] = "project/index";

        $user_id = $this->session->userdata('user_id');
        $user_data = $this->crudm->get_all('user',['user_id' => $user_id], ['user_id', 'role_id', 'email', 'full_name']);
        $data['user_data'] = $user_data;
        $data['title'] = 'Project';
        $this->load->view('layout/layout_dashboard.php', $data);

    }

    // create project
    public function create()
    {

        if($_POST) 
        {
            header('Content-Type: application/json');

            $pData = [];
            
            $this->form_validation->set_rules('name', 'Name', 'required'); 
            $this->form_validation->set_rules('desc', 'Description', 'required');

            if($this->form_validation->run() == false){
                die(json_encode(["success" => false, "msg" => "* Marked Fields are Required", 'class' => 'text-danger']));
            }

            $pData = [
                'name' => $this->commonlib->get_post('name'),
                'description' => $this->commonlib->get_post('desc')
            ];

            $check_exist = $this->crudm->is_exists('project', 'name', $pData['name']);
            if($check_exist){
                die(json_encode(["success" => false, "msg" => "Project already Exists", 'class' => 'text-danger']));
            }

            $insert_id = $this->crudm->db_insert($pData, 'project');
            if($insert_id){
                die(json_encode(["success" => true, "msg" => "Project is Created Successfully", 'class' => 'text-success']));
            }
        }

        $data['inner_template'] = "project/create";

        $user_id = $this->session->userdata('user_id');
        $user_data = $this->crudm->get_all('user',['user_id' => $user_id], ['user_id', 'role_id', 'email', 'full_name']);
        $data['user_data'] = $user_data;
        $data['title'] = 'Project';
        $this->load->view('layout/layout_dashboard.php', $data);

    }

    // edit project
    function edit($id)
    {

        if($_POST) {

            header('Content-Type: application/json');

            $pData = [];
            
            $this->form_validation->set_rules('name', 'Name', 'required'); 
            $this->form_validation->set_rules('desc', 'Description', 'required');

            if($this->form_validation->run() == false){
                die(json_encode(["success" => false, "msg" => "* Marked Fields are Required", 'class' => 'text-danger']));
            }

            $pData = [
                'name' => $this->commonlib->get_post('name'),
                'description' => $this->commonlib->get_post('desc')
            ];
            
            $check_exist = $this->crudm->is_exists('project', 'name', $pData['name'], ['project_id !=' => $id]);
            if(!$check_exist) {
                $update_id = $this->crudm->db_update('project', $pData, ['project_id' => $id]);
                if($update_id) {
                    die(json_encode(['success' => true, 'msg' => 'Project is Updated Successfully', 'class' => 'text-success']));
                }

                die(json_encode(['success' => false, 'msg' => 'Something Went Wrong', 'class' => 'text-danger']));

            }
            die(json_encode(['success' => false, 'msg' => 'Project already Exists', 'class' => 'text-danger']));
        }

        $project = $this->crudm->get_all('project', ['project_id' => $id]);
        $data['project'] =  $project[0];
        $data['inner_template'] = "project/edit";

        $user_id = $this->session->userdata('user_id');
        $user_data = $this->crudm->get_all('user',['user_id' => $user_id], ['user_id', 'role_id', 'email', 'full_name']);
        $data['user_data'] = $user_data;
        $data['title'] = 'Project';
        $this->load->view('layout/layout_dashboard.php', $data);

    }

    // delete project
    function delete()
    {

		header('content-type:application/json');
        $id = $this->commonlib->get_post('id');
        if(!empty($id)) {
            $this->crudm->db_update('project', ['is_active' => 'N'], ['project_id' => $id]);
            die(json_encode(['success' => true, 'msg' => 'Project is Deleted Successfully', 'class' => 'text-success']));
        }

    }
}

?>