<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Commonlib {

    public $ci;

    function __construct(){

        $this->ci =& get_instance();        

        $this->ci->load->helper(array('form','url'));
        $this->ci->load->library('session');
    }     

    // sanitize post variable
    function get_post($key,$altValue='',$rawHtml = false){

		if( !isset( $_POST[$key] ) ){
			return $altValue;
		}
		if (false) {
			$_POST[$key] = is_array($_POST[$key]) ? array_map('stripslashes',$_POST[$key]) :stripslashes( $_POST[$key] );
		}
		if($rawHtml){
				return $_POST[$key];
		} else {
			$var = is_array($_POST[$key]) ? array_map('strip_tags',$_POST[$key]) :strip_tags( $_POST[$key] );
			return $var;
		}
	}

    //encrypt password
    function encrypt_pass($pwd) {

        $pepper = SECRET;
        $pwd_peppered = hash_hmac("sha256", $pwd, $pepper);
        $pwd_hashed = password_hash($pwd_peppered, PASSWORD_ARGON2ID);
        return $pwd_hashed;
    }

    // get decrypted password
    function check_pass($pwd, $pwd_hashed) {

        $pepper = SECRET;
        $pwd_peppered = hash_hmac("sha256", $pwd, $pepper);
        if (password_verify($pwd_peppered, $pwd_hashed)) {
            return true;
        }
        else {
            return false;
        }
    }

    // check if logged in
    function is_logged_in() {

        if(!$this->ci->session->userdata("user_id")) {
            redirect('user/login');
        }
    }

    // check permission
    function have_permission() {

        if($this->ci->session->userdata("role_id") != '1') {
            redirect('dashboard');
        }

    }
}

?>