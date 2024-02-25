<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library("form_validation");
        $this->load->library("commonlib");
        $this->load->model("crudm");
        
        $this->load->library('pagination');
    }

    // list users for admin
    public function index()
    {

        $this->commonlib->is_logged_in();
        $this->commonlib->have_permission();

        $search = $this->commonlib->get_post('search_email');
        $conditions['table'] = 'user';
        $conditions['conditions'] = ['is_active' => 'Y', 'role_id' => 2];

        $conditions['searchKeyword'] = [];
        if($search != '') {
            $conditions['searchKeyword'] = ['email' => $search];
            $this->session->set_userdata('search', $search);
        }
        $conditions['returnType']    = 'count';
        $rowsCount = $this->crudm->get_rows($conditions);
        
        $config['base_url']    = base_url('user/index/');
        $config['uri_segment'] = 3;
        $config['total_rows']  = $rowsCount;
        
        $this->pagination->initialize($config);
        
        $page = $this->uri->segment(3);
        $offset = !$page?0:$page;
        
        $conditions['returnType'] = '';
        $conditions['start'] = $offset;
        $conditions['limit'] = 10;
        $data['users'] = $this->crudm->get_rows($conditions);

        $data['total'] = count($this->crudm->get_all('user', ['is_active' => 'Y']));
        $data['title'] = 'Users';
        $data['inner_template'] = "user/index";

        $user_id = $this->session->userdata('user_id');
        $user_data = $this->crudm->get_all('user',['user_id' => $user_id], ['user_id', 'role_id', 'email', 'full_name']);
        $data['user_data'] = $user_data;
        $data['title'] = 'User';
        $this->load->view('layout/layout_dashboard.php', $data);
    }

	public function signup()
	{
        $data = $uData = [];
        $data['class'] = 'text-success';
        
        if($this->input->post('signup')) 
        {
            $this->form_validation->set_rules('full_name', 'Full Name', 'required'); 
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email'); 
            $this->form_validation->set_rules('password', 'password', 'required');
            $data['class'] = 'text-danger'; 
 
            if($this->form_validation->run() == true)
            {
 
                $uData = [
                    'full_name'    => $this->commonlib->get_post("full_name"),
                    'email'         => $this->commonlib->get_post("email"),
                    'password'      => $this->commonlib->encrypt_pass($this->commonlib->get_post("password")),
                    'role_id'       => 2
                ];

                $check_exist = $this->crudm->is_exists('user','email',$uData['email']);

                if(!$check_exist) {

                    $insert_id = $this->crudm->db_insert($uData, 'user');
                    if($insert_id){
                        $this->crudm->db_insert(['user_id' => $insert_id], 'user_project');

                        $this->session->set_userdata('success_msg', 'Your Account is Created Successfully. You are Ready to Sign In.'); 
                        redirect(base_url('user/login')); 
                    }else{ 
                        $data['error_msg'] = 'Something Went Wrong';
                    } 
                } else {
                    $data['error_msg'] = 'User already Exists'; 
                }
            }else{ 
                $data['error_msg'] = 'All fields are Required'; 
            } 
        } 
        
        $data['user'] = $uData; 

        $data['title'] = 'Sign Up';
        $data['inner_template'] = "user/signup";
        $this->load->view('layout/layout_login.php', $data);
	}

    public function login()
    {
        $data['class'] = 'text-success';

        if($this->input->post('login'))
        {
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email'); 
            $this->form_validation->set_rules('password', 'password', 'required'); 

            $data['class'] = 'text-danger';
             
            if($this->form_validation->run() == true)
            { 
                $email     = $this->commonlib->get_post("email");
                $password  = $this->commonlib->get_post("password");

                $check_exist = $this->crudm->get_all('user', ['email' => $email, 'is_active' => 'Y'], ['user_id', 'role_id', 'email', 'password']);

                if($check_exist){
                    $check_pass = $this->commonlib->check_pass($password, $check_exist[0]->password);
                    if($check_pass){
                        $this->session->set_userdata('user_id', $check_exist[0]->user_id);
                        $this->session->set_userdata('role_id', $check_exist[0]->role_id);
                        redirect(base_url('dashboard')); 
                    } else {
                        $data['error_msg'] = 'Password is Wrong';
                    }
                }else{ 
                    $data['error_msg'] = 'Username is Wrong'; 
                } 
            }else{ 
                $data['error_msg'] = 'All Fields are Required';
            } 
        }

        $data['inner_template'] = "user/login";
        $data['title'] = 'Sign In';
        $this->load->view('layout/layout_login.php', $data);
    }

    public function logout()
    {
        $this->session->unset_userdata("user_id");
        redirect(base_url('user/login'));
    }

    public function admin_add_user()
    {  
        if($_POST) 
        {
            header('Content-Type: application/json');

            $uData = [];
            
            $this->form_validation->set_rules('name', 'Name', 'required'); 
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if($this->form_validation->run() == false){
                die(json_encode(["success" => false, "msg" => "* Marked Fields are Required", 'class' => 'text-danger']));
            }

            $uData = [
                'full_name'         => $this->commonlib->get_post('name'),
                'email'             => $this->commonlib->get_post('email'),
                'password'          => $this->commonlib->encrypt_pass($this->commonlib->get_post('password')),
                'role_id'           => 2,
                'is_added_by_admin' => 1
            ];

            $check_exist = $this->crudm->is_exists('user', 'email', $uData['email']);
            if($check_exist){
                die(json_encode(["success" => false, "msg" => "User already Exists", 'class' => 'text-danger']));
            }

            $insert_id = $this->crudm->db_insert($uData, 'user');
            if($insert_id){
                $this->crudm->db_insert(['user_id' => $insert_id], 'user_project');
                die(json_encode(["success" => true, "msg" => "User is Added Successfully", 'class' => 'text-success']));
            }
        }

        $data['inner_template'] = "user/admin_add_user";

        $user_id = $this->session->userdata('user_id');
        $user_data = $this->crudm->get_all('user',['user_id' => $user_id], ['user_id', 'role_id', 'email', 'full_name']);
        $data['user_data'] = $user_data;
        $data['title'] = 'Add User';
        $this->load->view('layout/layout_dashboard.php', $data);
    }

    public function admin_edit_user($id)
    {
        $this->commonlib->is_logged_in();
        // $this->commonlib->have_permission();

        if($_POST) {

            header('Content-Type: application/json');

            $uData = [];
            
            $this->form_validation->set_rules('name', 'Name', 'required'); 
            $this->form_validation->set_rules('email', 'Email', 'required');

            if($this->form_validation->run() == false){
                die(json_encode(["success" => false, "msg" => "* Marked Fields are Required", 'class' => 'text-danger']));
            }

            $uData = [
                'full_name'         => $this->commonlib->get_post('name'),
                'email'             => $this->commonlib->get_post('email')
            ];

            $password = $this->commonlib->get_post('password');

            
            $check_exist = $this->crudm->is_exists('user', 'email', $uData['email'], ['user_id !=' => $id]);
            if(!$check_exist) {

                if(!empty($password)) {
                    $uData['password'] = $this->commonlib->encrypt_pass($password);
                }

                $update_id = $this->crudm->db_update('user', $uData, ['user_id' => $id]);
                if($update_id) {
                    if($this->session->userdata('role_id') == 1) {
                        die(json_encode(['success' => true, 'msg' => 'User is Edited Successfully', 'class' => 'text-success', 'redirect' => false]));
                    }
                    die(json_encode(['success' => true, 'msg' => 'Profile is Edited Successfully', 'class' => 'text-success', 'redirect' => 'profile/'.$id]));
                }

                die(json_encode(['success' => false, 'msg' => 'Something Went Wrong', 'class' => 'text-danger']));

            }

            die(json_encode(['success' => false, 'msg' => 'User already Exists', 'class' => 'text-danger']));
        }

        $user = $this->crudm->get_all('user', ['user_id' => $id]);
        $data['user'] =  $user[0];
        $data['inner_template'] = "user/admin_edit_user";

        $user_id = $this->session->userdata('user_id');
        $user_data = $this->crudm->get_all('user',['user_id' => $user_id], ['user_id', 'role_id', 'email', 'full_name']);
        $data['user_data'] = $user_data;
        if($this->session->userdata('role_id') == 1) {
            $data['title'] = 'Edit User';
        } else {
            $data['title'] = 'Profile';
        }
        $this->load->view('layout/layout_dashboard.php', $data);

    }

    public function admin_delete_user()
    {
        $this->commonlib->is_logged_in();
        $this->commonlib->have_permission();

		header('content-type:application/json');
        $id = $this->commonlib->get_post('id');
        if(!empty($id)) {
            $this->crudm->db_update('user', ['is_active' => 'N'], ['user_id' => $id]);
            die(json_encode(['success' => true, 'msg' => 'User is Deleted Successfully', 'class' => 'text-success']));
        }
    }
}