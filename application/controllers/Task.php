<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library("form_validation");
        $this->load->library("commonlib");
        $this->load->model("crudm");

        $this->commonlib->is_logged_in();

        $this->load->library('pagination');
    }

    // list tasks
    public function index()
    {

        $search = $this->commonlib->get_post('search_title');
        $conditions['table'] = 'task';
        $conditions['conditions'] = ['task.is_active' => 'Y'];
        
        if($this->session->userdata('role_id') == 2) {
            $my_projects = $this->crudm->get_all('user_project', ['user_id' => $this->session->userdata('user_id')]);
            if(!empty($my_projects)) {
                $conditions['conditions'] = ['task.project_id' => ['in', explode(",", $my_projects[0]->project_id)]];
            }
        }

        $conditions['join'] = [["project","project.project_id = task.project_id"]];
        $conditions['searchKeyword'] = [];
        if($search != '') {
            $conditions['searchKeyword'] = ['title' => $search];
            $this->session->set_userdata('search', $search);
        }
        $conditions['returnType']    = 'count';
        $rowsCount = $this->crudm->get_rows($conditions);
        
        $config['base_url']    = base_url('task/index/');
        $config['uri_segment'] = 3;
        $config['total_rows']  = $rowsCount;
        
        $this->pagination->initialize($config);
        
        $page = $this->uri->segment(3);
        $offset = !$page?0:$page;
        
        $conditions['returnType'] = '';
        $conditions['start'] = $offset;
        $conditions['limit'] = 10;
        $data['tasks'] = $this->crudm->get_rows($conditions);

        $data['total'] = count($this->crudm->get_all('task', ['is_active' => 'Y']));
        $data['inner_template'] = "task/index";

        $user_id = $this->session->userdata('user_id');
        $user_data = $this->crudm->get_all('user',['user_id' => $user_id], ['user_id', 'role_id', 'email', 'full_name']);
        $data['user_data'] = $user_data;
        $data['title'] = 'Task';
        $this->load->view('layout/layout_dashboard.php', $data);

    }

    // add task
    public function add()
    {
        
        if($_POST) 
        {
            header('Content-Type: application/json');

            $tData = [];
            
            $this->form_validation->set_rules('project', 'Project', 'required'); 
            $this->form_validation->set_rules('title', 'Title', 'required'); 
            $this->form_validation->set_rules('desc', 'Description', 'required');
            $this->form_validation->set_rules('duedate', 'Due Date', 'required');
            $this->form_validation->set_rules('priority', 'Priority', 'required');
            $this->form_validation->set_rules('status', 'Status', 'required');

            if($this->form_validation->run() == false){
                die(json_encode(["success" => false, "msg" => "* Marked Fields are Required", 'class' => 'text-danger']));
            }

            $tData = [
                'project_id'  => $this->commonlib->get_post('project'),
                'title'       => $this->commonlib->get_post('title'),
                'description' => $this->commonlib->get_post('desc'),
                'due_date'    => $this->commonlib->get_post('duedate'),
                'priority'    => $this->commonlib->get_post('priority'),
                'status'      => $this->commonlib->get_post('status'),
                'created_by'  => $this->session->userdata('user_id')
            ];

            $check_exist = $this->crudm->is_exists('task', 'title', $tData['title'], ['project_id' => $tData['project_id']]);
            if($check_exist){
                die(json_encode(["success" => false, "msg" => "Task already Exists", 'class' => 'text-danger']));
            }

            $insert_id = $this->crudm->db_insert($tData, 'task');
            if($insert_id){
                die(json_encode(["success" => true, "msg" => "Task is Added Successfully", 'class' => 'text-success']));
            }
        }

        if($this->session->userdata('role_id') == 1) {
            $data['projects'] = $this->crudm->get_all('project', ['is_active' => 'Y']);
        } else {
            ; 
            $data['projects'] = $this->crudm->get_any_data_query('SELECT * FROM `project` WHERE FIND_IN_SET (project_id, (SELECT project_id FROM `user_project` WHERE user_id = "'.$this->session->userdata('user_id').'"))');
        }
        $data['inner_template'] = "task/add";

        $user_id = $this->session->userdata('user_id');
        $user_data = $this->crudm->get_all('user',['user_id' => $user_id], ['user_id', 'role_id', 'email', 'full_name']);
        $data['user_data'] = $user_data;
        $data['title'] = 'Add Task';
        $this->load->view('layout/layout_dashboard.php', $data);

    }

    // edit task
    function edit($id){
        
        $this->commonlib->have_permission();

        if($_POST) {

            header('Content-Type: application/json');
            
            $tData = [];
            
            $this->form_validation->set_rules('project', 'Project', 'required');
            $this->form_validation->set_rules('title', 'Title', 'required'); 
            $this->form_validation->set_rules('desc', 'Description', 'required');
            $this->form_validation->set_rules('duedate', 'Due Date', 'required');
            $this->form_validation->set_rules('priority', 'Priority', 'required');
            $this->form_validation->set_rules('status', 'Status', 'required');

            if($this->form_validation->run() == false){
                die(json_encode(["success" => false, "msg" => "* Marked Fields are Required", 'class' => 'text-danger']));
            }
             
            $tData = [
                'project_id'  => $this->commonlib->get_post('project'),
                'title'       => $this->commonlib->get_post('title'),
                'description' => $this->commonlib->get_post('desc'),
                'due_date'    => $this->commonlib->get_post('duedate'),
                'priority'    => $this->commonlib->get_post('priority'),
                'status'      => $this->commonlib->get_post('status'),
                'created_by'  => $this->session->userdata('user_id')
            ];
            
            $check_exist = $this->crudm->is_exists('task', 'title', $tData['title'], ['task_id !=' => $id, 'project_id' => $tData['project_id']]);
            if(!$check_exist) {
                $update_id = $this->crudm->db_update('task', $tData, ['task_id' => $id]);
                if($update_id) {
                    die(json_encode(['success' => true, 'msg' => 'Task is Updated Successfully', 'class' => 'text-success']));
                }

                die(json_encode(['success' => false, 'msg' => 'Something Went Wrong', 'class' => 'text-danger']));

            }
        }

        $data['projects'] = $this->crudm->get_all('project', ['is_active' => 'Y']);
        $task = $this->crudm->get_all('task', ['task_id' => $id]);
        $data['task'] =  $task[0];
        $data['inner_template'] = "task/edit";

        $user_id = $this->session->userdata('user_id');
        $user_data = $this->crudm->get_all('user',['user_id' => $user_id], ['user_id', 'role_id', 'email', 'full_name']);
        $data['user_data'] = $user_data;
        $data['title'] = 'Edit Task';
        $this->load->view('layout/layout_dashboard.php', $data);

    }

    // delete task
    function delete(){

        $this->commonlib->have_permission();
        
		header('content-type:application/json');
        $id = $this->commonlib->get_post('id');
        if(!empty($id)) {
            $this->crudm->db_update('task', ['is_active' => 'N'], ['task_id' => $id]);
            die(json_encode(['success' => true, 'msg' => 'Task is Deleted Successfully', 'class' => 'text-success']));
        }

    }
}

?>