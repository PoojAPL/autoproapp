<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Suppliers extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url' ,'utility_helper','user_helper'));
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('home_model');
		$this->load->library('pagination');
	}
	public function index()	{
		if(isset($this->session->userdata['login_supplier'])){
			redirect('suppliers/dashboard',$data);
		}
		$this->load->view('suppliers/index');
	}

	public function login(){
		$data = array();		
		if(isset($this->session->userdata['login_supplier'])){
			redirect('suppliers/products',$data);
		}else{
			$this->form_validation->set_rules('user_name', 'Username', 'trim|required|min_length[5]|max_length[20]');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[20]');
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('message_display', validation_errors());	
				redirect('suppliers/index',$data);
			}
			$username = $this->input->post('user_name');
			$password = $this->input->post('password');					
			$check_supplier = $this->home_model->check_supplier($username,$password);
			if($check_supplier == true){				
				$this->session->unset_userdata('users_login_count',$session_data1);
				$session_data = array('username' => $check_supplier[0]['user_name'], 'password' => $check_supplier[0]['password'],'product_type' => $check_supplier[0]['product_type']);
				$this->session->set_userdata('login_supplier', $session_data);						
				redirect('suppliers/products',$data);
			}else{
				$this->session->set_flashdata('message_display', 'Sorry, details not matched.');
				redirect('suppliers/index',$data);
			}
		}
	}
	public function dashboard(){
		$data =array();
		$data['subTitle'] = 'Dashboard';
		if(isset($this->session->userdata['login_supplier'])){
			$user_data = $this->session->userdata('login_supplier');
			$product_type = $user_data['product_type'];
			$data['all_products'] = $this->home_model->total_products($product_type);
			$this->load->view('suppliers/layout/header',$data);
			$this->load->view('suppliers/dashboard',$data);
			$this->load->view('suppliers/layout/footer',$data);
		}
	}
	public function logout(){
		$data =array();
		if(isset($this->session->userdata['login_supplier'])){
			$session_data = array('username' => '', 'password' => '');
			$this->session->unset_userdata('login_supplier',$session_data);
			session_destroy();
			$this->db->cache_delete_all();
			$this->load->view('suppliers/index', $data);
		}else{			     
			  $this->load->view('suppliers/index');
		}
	}

	public function products(){
		$data =array();
		$data['subTitle'] = 'Products';
		if(isset($this->session->userdata['login_supplier'])){
			if(isset($_POST['product_type'])){
				$_SESSION['product_type'] = trim($_POST['product_type']);
				unset($_SESSION['product_search']);
			}
			if(isset($_POST['product_search'])){
				unset($_SESSION['product_type']);
				$_SESSION['product_search'] = trim($_POST['product_search']);
			}
			
			$user_data = $this->session->userdata('login_supplier');
			$product_type = $user_data['product_type'];
			$config = array();
			$config["base_url"] = base_url() . "suppliers/products";
			$total_row = $this->home_model->total_products($product_type);
			$config["total_rows"] = $total_row;						
			$config['use_page_numbers'] = TRUE;
			$config['num_links'] = $total_row;
			$config['cur_tag_open'] = '<a class="current">';
			$config['cur_tag_close'] = '</a>';
			$config['per_page'] = 50;
			$config['next_link'] = 'Next';
			$config['prev_link'] = 'Previous';		
			$this->pagination->initialize($config);
			if($this->uri->segment(3)){
				$page = ($this->uri->segment(3));
				$limt_start = ($page - 1)  * $config["per_page"];
			}else{
				$page = 1;
				$limt_start = 0;
			}
			if(isset($_POST['active_products'])){
				$cookie = array(
					'name'   => 'active_products',
					'value'  => trim($_POST['active_products']),                            
					'expire' => 60*60*24*30
					);
				$this->input->set_cookie($cookie);
				redirect('suppliers/products/'.$page,$data);
			}
			if(isset($_GET['sort']) && $_GET['sort'] !=""){
				$cookie = array(
					'name'   => 'sort',
					'value'  => $_GET['sort'],                            
					'expire' => 60*60*24*30
					);
				$this->input->set_cookie($cookie);
				redirect('suppliers/products/'.$page,$data);
			}
			if($this->input->cookie('sort',true)){
				$order_by = explode('-',$this->input->cookie('sort',true));
				$data['order_by'] = $order_by[1];
			}
			$_GET['sort'];
			$str_links = $this->pagination->create_links();
			$data["page"] = $page;	
			$data["links"] = explode('&nbsp;',$str_links );			
			$data['result'] = $this->home_model->products($product_type,$config["per_page"],$limt_start);
			$this->load->view('suppliers/layout/header',$data);
			$this->load->view('suppliers/products',$data);
			$this->load->view('suppliers/layout/footer',$data);
		}else{			     
			$this->load->view('suppliers/index');
		}
	}
	
}
