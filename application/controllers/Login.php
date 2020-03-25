<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_login');
		in_access();
	}

	public function index()
	{
		$this->load->view('login/index.php');
	}
	public function signin()
	{
		$username=$this->input->post('username', TRUE);
		$password=$this->input->post('password', TRUE);
		$cek=$this->M_login->check($username,md5($password))->num_rows();
		if($cek>0){
			$this->session->set_userdata('username',$username);
			redirect('welcome');
		}else{
			$this->session->set_flashdata('error', '1');
			redirect('login');
		}
	}

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */ ?>