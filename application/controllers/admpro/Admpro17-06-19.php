<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Admpro extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url' ,'utility_helper','user_helper'));
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('admpro/admin_model');
		$this->load->library('pagination');
		$this->load->helper("file");
		$this->load->helper('email');
	}
	public function index()	{
			$data['subTitle'] = 'Dashboard';
			if(isset($this->session->userdata['login_user'])){	
			 	 $session_data = $this->session->userdata('login_user');
				 $data['user_name'] = $session_data['username'];	
				 $data['total_users'] = $this->admin_model->get_aks_users_rows();				 
				 $user_email = $session_data['email'];
				 $data['getUsersInfo'] = $this->admin_model->usersInInfo($user_email);	
				 $data['access_logs'] = $this->admin_model->users_access_logs();
				 $this->load->view('admin_layout/header',$data);
				 $this->load->view('admpro/dashboard',$data);
				 $this->load->view('admin_layout/footer',$data);
			}else{			     
				  $this->load->view('admpro/index', $data);
			}			
	}
	
	
/*-------------------------------------------------------Dashboard---------------------------------------------------------------*/
	
	
	public function firebaseLogin(){
			$username = $this->input->post('user_name');
			$password = $this->input->post('password');
			$check_user = $this->admin_model->checkuser($username,$password);
			if($check_user == true){
				$session_data = array('username' => $check_user[0]['user_name'], 'password' => $check_user[0]['password'],'user_type' =>  $check_user[0]['type'], 'email' => $check_user[0]['email']);
				$this->session->set_userdata('login_user', $session_data);				
				$user_data = $this->session->userdata('login_user');
				echo 1;			
			}
	}
	

	public function dashboard(){
			$data =array();
			$data['subTitle'] = 'Dashboard';
			$username = $this->input->post('user_name');
			$password = $this->input->post('password');	
			$data['total_users'] = $this->admin_model->get_aks_users_rows();
		
			$this->form_validation->set_rules('user_name', 'Valid Email', 'trim|required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[20]');
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('message_display', validation_errors());	
				redirect('admpro/index',$data);
			}
			if(isset($this->session->userdata['login_user'])){
					$session_data = $this->session->userdata('login_user');
					$data['username'] = $session_data['username'];
					$user_email = $session_data['email'];
					$data['getUsersInfo'] = $this->admin_model->usersInInfo($user_email);
					$data['access_logs'] = $this->admin_model->users_access_logs();
					$this->load->view('admin_layout/header',$data);
					$this->load->view('admpro/dashboard.php',$data);
					$this->load->view('admin_layout/footer',$data);
			  }else{					
					$check_user = $this->admin_model->checkuser($username,$password);
					if($check_user == true){	
						$admin_logs = $this->admin_model->admin_logs($check_user[0]['UserID'],$check_user[0]['email']);					
						$this->db->cache_delete('autoApi', 'get_vehicle_products');
						$this->db->cache_delete('autoApi', 'getyears');
						$this->db->cache_delete('autoApi', 'getmodel');
						$session_data1 = array('login_count' => '');
						$this->session->unset_userdata('users_login_count',$session_data1);
						$session_data = array('username' => $check_user[0]['user_name'], 'password' => $check_user[0]['password'],'user_type' =>  $check_user[0]['type'], 'email' => $check_user[0]['email']);
						$this->session->set_userdata('login_user', $session_data);
						$data['access_logs'] = $this->admin_model->users_access_logs();
						$user_data = $this->session->userdata('login_user');
						$user_email = $user_data['email'];
						$getUsersInfo = $this->admin_model->usersInInfo($user_email);
						$data['getUsersInfo'] = $this->admin_model->usersInInfo($user_email);	
						$options['auth'] = 'tDpktmFrLHJRZIBCoyPUU68ba4gbnQRUhqdn6y9H'; 
						$cSession1 = curl_init();         
						curl_setopt($cSession1,CURLOPT_URL,"https://autopro-75ac3.firebaseio.com/users/".$getUsersInfo[0]['User_uid'].".json?". http_build_query($options));
						curl_setopt($cSession1, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
						curl_setopt($cSession1, CURLOPT_CUSTOMREQUEST, "GET");            
						curl_setopt($cSession1, CURLOPT_POSTFIELDS,''); 
						curl_setopt($cSession1,CURLOPT_RETURNTRANSFER,true);  
						curl_setopt($cSession1, CURLOPT_SSL_VERIFYPEER, false);    
						$result_output1 = curl_exec($cSession1);       
						curl_error($cSession1);                   
						$outputs1 = json_decode($result_output1, true);
						$this->session->set_userdata('login_firebase_user', $outputs1);

						$this->load->view('admin_layout/header',$data);
						if( ($check_user[0]['type'] == 4) || ($check_user[0]['type'] == 3) || ($check_user[0]['type'] == 5)){
							redirect('app-admpro/purchase_history');
						}else if(($check_user[0]['type'] == 7)){
							redirect('app-admpro/feedback');
						}else{
							$this->load->view('admpro/dashboard.php',$data);
						}						
						$this->load->view('admin_layout/footer',$data);
					}else{
						if(isset($this->session->userdata['users_login_count'])){
							$users_login_count = $this->session->userdata('users_login_count');
							$login_count = $users_login_count['login_count'];
						}else{
							$login_count = 1;
						}
						if($login_count == 3){				
							$this->session->set_flashdata('login_count_display', 'Too many attempts');	
							redirect('admpro/index',$data);
						}	
						if($login_count >= 3){
							$session_data1 = array('login_count' => 3);
						}else{
							$session_data1 = array('login_count' => $login_count+1);
						}						
						$this->session->set_userdata('users_login_count', $session_data1);		
						$this->session->set_flashdata('message_display', "Sorry, your details doesn't match.");	
						redirect('admpro/index',$data);
					}
			 }
		}
	
	
/*---------------------------------------------Logout---------------------------------------------------------------*/	


	public function logout(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
		$data['subTitle'] = 'Manage User';
		$session_data = array('username' => '', 'password' => '');
		$this->session->unset_userdata('login_user',$session_data);
		$this->session->unset_userdata('pagination_per_page',$session_data);	
		$this->session->unset_userdata('make_filter',$session_data);
		session_destroy();
		$this->db->cache_delete_all();
		$this->load->view('admpro/index', $data);
		}else{			     
			  $this->load->view('admpro/index');
			}
	}
	public function clear_cache(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
			$this->db->cache_delete_all();
			redirect("admpro/dashboard");
		}else{			     
			  $this->load->view('admpro/index');
			}
	}	
	// public function overview(){
	// 	$data['subTitle'] = 'Overview'; 
	//     if(isset($this->session->userdata['login_user'])){
	// 		$this->load->view('admin_layout/header', $data);
	// 		$this->load->view('admpro/user');
	// 		$this->load->view('admin_layout/footer');
			
	// 	}else{
	// 		redirect('admpro/index');
	// 	}
		
	// }
	
	
/*--------------------------------------Manage User--------------------------------------------*/


	public function manage_user($updated = ""){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
		$data['subTitle'] = 'Admin Access > <strong>Users</strong>';
		$data['getAllUsers'] = $this->admin_model->getAllusers();
		$this->load->view('admin_layout/header',$data);
		$this->load->view('admpro/users', $data);
		$this->load->view('admin_layout/footer');
		}else{			     
				  $this->load->view('admpro/index', $data);
			}	
		
	}
/*----------------------------------Payament------------------------------------------------*/


	public function payments(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
		$data['subTitle'] = 'Payments';
		$this->load->view('admin_layout/header',$data);
		$this->load->view('admpro/payments');
		$this->load->view('admin_layout/footer');
		}else{			     
				  $this->load->view('admpro/index', $data);
			}	
		
	}
	
/*----------------------------------Add User----------------------------------------------------*/


	public function add_user(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
	    $data['subTitle'] = 'Admin Access > <strong>Add New User</strong>';
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/add_user');
			$this->load->view('admin_layout/footer');
		}else{			     
				  $this->load->view('admpro/index', $data);
			}
		
	}
	public function user_add(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){
			$this->form_validation->set_rules('email', 'Valid Email', 'trim|required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[20]');
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('message_display', '<font style="color:red;">'.validation_errors().'</font>');	
				redirect('admpro/add_user',$data);
			}			
			$add_user = $this->admin_model->AddUser();	
			if($add_user > 0 ){			  
				  $this->session->set_flashdata('message_display', 'Data added successfully'.curl_error($cSession));
			}else if($add_user == 0 ){			  
				$this->session->set_flashdata('message_display', '<font style="color:red;">E-mail already exists, please try another.</font>');	
			}else{
				$this->session->set_flashdata('message_display', '<font style="color:red;">Sorry, something went wrong while adding details,please try again</font>');							 
			}							
			redirect('admpro/add_user');
		}else{			     
				  $this->load->view('admpro/index', $data);
			}	
	}
	

	public function check_email(){
		if(isset($this->session->userdata['login_user'])){	
			$this->form_validation->set_rules('email', 'Valid Email', 'trim|required|valid_email');
			if ($this->form_validation->run() == FALSE){
				echo 2;
			}else{
				$email = $this->input->post('email');
				$check_email = $this->admin_model->check_email($email);
				if($check_email == true){
					echo 0;
				}else{
					echo 1;
				}
			}			
		}else{			     
				$this->load->view('admpro/index');
		}	
	}
	
	
	public function edit_users($id){
		if(isset($this->session->userdata['login_user'])){
			$data['subTitle'] = 'Update User';
			$data['id'] = $id;
			$data['getUsersInfo'] = $this->admin_model->getUsersInfo($id);
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/edit_users', $data);
			$this->load->view('admin_layout/footer');
		}else{
			redirect('admpro/index');
		}
	}	


	public function update_user(){
		if(isset($this->session->userdata['login_user'])){
			$data['subTitle'] = 'Update User';	
			$this->form_validation->set_rules('email', 'Valid Email', 'trim|required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[20]');
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('message_display', validation_errors());	
				redirect('admpro/manage_user',$data);
			}			
			$update = $this->admin_model->UpdateUser();
			$id = $this->input->post('userId');
			//$this->session->set_flashdata('message_display', 'Data updated successfully');
			//redirect('admpro/edit_users/'.$id);
		}else{
			redirect('admpro/index');
		}
	}
	
	public function update_user2(){
		if(isset($this->session->userdata['login_user'])){
			$data['subTitle'] = 'Update User';
			$id = $this->input->post('userId');
			$password = $this->input->post('password');
			$this->form_validation->set_rules('email', 'Valid Email', 'trim|required|valid_email');
			if( $password  != ""){
				$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[20]');
			}
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('message_display', validation_errors());	
				redirect('admpro/edit_users/'.$id);
			}	
			$update = $this->admin_model->UpdateUser();			
			$this->session->set_flashdata('message_display', 'Data updated successfully');
			redirect('admpro/edit_users/'.$id);
		}else{
			redirect('admpro/index');
		}
	}
	

	public function deleteUsers($id){	
		$this->session->set_flashdata('message_display', 'Data deleted successfully');
		$result = $this->admin_model->deleteUsers($id);	
		redirect('admpro/manage_user');	

	}	


	public function check_makename(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
		$makesname = $this->input->post('make_name');
		$check_makeName = $this->admin_model->check_MakeName($makesname);
		if($check_makeName == true){
			echo 0;
		}else{
			echo 1;
		}
		}else{			     
				$this->load->view('admpro/index', $data);
			}	
	}

/*------------------------------------------------------------------------Manage Model----------------------------------------------------------------------------------*/
	/*public function manage_model(){
		$data['subTitle'] = 'Vehicles | Models ';
		$config = array();
		$config["base_url"] = base_url() . "/admpro/manage_model";
		$total_row = $this->admin_model->getAllModelRows();
		$config["total_rows"] = $total_row;
		if(isset($this->session->userdata['pagination_per_page'])){
			$per_page = $this->session->userdata['pagination_per_page']; 
			$config["per_page"] = $per_page['per_page'];
		}else{
			$config["per_page"] = 10;
		}		
		$config['use_page_numbers'] = TRUE;
		$config['num_links'] = $total_row;
		$config['cur_tag_open'] = '<a class="current">';
		$config['cur_tag_close'] = '</a>';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';		
		$this->pagination->initialize($config);
		if($this->uri->segment(3)){
			$page = ($this->uri->segment(3));
			$limt_start = ($page - 1)  * $config["per_page"];
		}else{
			$page = 1;
			$limt_start = 10;
		}
	    $data['page'] = $page;
		$data["results"] = $this->admin_model->getAllModel($config["per_page"],$limt_start);
		$str_links = $this->pagination->create_links();
		$data["links"] = explode('&nbsp;',$str_links );
		$this->load->view('admin_layout/header',$data);
		$this->load->view('admpro/manage_model', $data);
		$this->load->view('admin_layout/footer');
		
	}*/
	

/*----------------------------------Key Style ----------------------------------------------*/


	public function keyStyle(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
		$data['subTitle'] = 'Parts > <strong>Key Styles</strong>';
		$data['getAllkeyStyles'] = $this->admin_model->getAllkeyStyles();
		$this->load->view('admin_layout/header',$data);
		$this->load->view('admpro/Key_style', $data);
		$this->load->view('admin_layout/footer');
		}else{			     
		     $this->load->view('admpro/index', $data);
		}
	}

	public function addKeyStyle(){
	     $data =array();
	 	if(isset($this->session->userdata['login_user'])){	
	    $data['subTitle'] = 'Parts > Key Styles > <strong>Add New Key Style</strong>';
		$this->load->view('admin_layout/header',$data);
		$this->load->view('admpro/add_key_style');
		$this->load->view('admin_layout/footer');
		}else{			     
				  $this->load->view('admpro/index', $data);
			}
	}
	public function keyStyleAdd(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
		$add_name = $this->admin_model->keyStyleAdd();	
		if($add_name == true){
		      $this->session->set_flashdata('message_display', 'Data added successfully');
		}else{
			$this->session->set_flashdata('message_display', 'Error in adding user! ');							 
		}							
		redirect('admpro/addKeyStyle');
		}else{			     
				  $this->load->view('admpro/index', $data);
			}	
		}
		

	public function edit_keystyle($id){
		$data =array();
		if(isset($this->session->userdata['login_user'])){
			$data['subTitle'] = 'Parts > Key Styles > <strong>Update Key Style</strong>';
			$data['id'] = $id;
			$data['getKeyStyleInfo'] = $this->admin_model->getKeyStyleInfo($id);
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/edit_keystyle', $data);
			$this->load->view('admin_layout/footer');
		}else{
			redirect('admpro/index');
		}
	}
	public function update_keystyle(){
		$id ="";
		if(isset($this->session->userdata['login_user'])){
			$data['subTitle'] = 'Update Key Style';
			$data['id'] = $id;
			$update = $this->admin_model->EditKeystyle();
			$update = $this->admin_model->EditKeyType();
			if($update == true){
			 		$this->session->set_flashdata('message_display', '<div class="alert alert-info">Data  added successfully </div>');
			}else{
					$this->session->set_flashdata('message_display', '<div class="alert alert-danger"> Name already exits</div>');							 
			}	
				redirect('admpro/keyStyle');
		}else{			     
			  $this->load->view('admpro/index', $data);
			}
	}

	public function deleteKeyStyle($id){		
		$this->session->set_flashdata('message_display', '<div class="alert alert-success">Data deleted successfully</div>');
		$result = $this->admin_model->deletekeystyle($id);	
		redirect('admpro/keyStyle');
	}
	
	public function key_style_sorting(){
		$data['sorting'] = $this->input->post('sorting');
		$data['sorting_by'] = $this->input->post('sorting_by');		
		$data['getAllkeyStyles'] = $this->admin_model->key_style_sorting();
		$this->load->view('admpro/key_style_sorting',$data);
	}
	
	
/*--------------------------------------------Chips------------------------------------------------------*/

	public function Chips(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = 'Parts > Chips';
			$config = array();
			$config["base_url"] = base_url() . "admpro/Chips";
			$total_row = $this->admin_model->getAllChipsRows();			
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
			$str_links = $this->pagination->create_links();
			$data["links"] = explode('&nbsp;',$str_links );	
		if(isset($this->session->userdata['chips_filter_session'])){
			$session_data = $this->session->userdata('chips_filter_session');
			 $chip_value = $session_data['chips_filter_val'];
			$data['getAllChips'] = $this->admin_model->getAllChipsByFilter($chip_value);
		}else{
			$data['getAllChips'] = $this->admin_model->getAllChipsDetail($config["per_page"],$limt_start);
		}
		$this->load->view('admin_layout/header',$data);
		$this->load->view('admpro/chips', $data);
		$this->load->view('admin_layout/footer');
		}else{			     
		     $this->load->view('admpro/index', $data);
		}
	}

	public function add_chips(){
	     $data =array();
	 	if(isset($this->session->userdata['login_user'])){	
	    $data['subTitle'] = 'Parts > Chips > <strong> Add New Chip</strong> ';
		$this->load->view('admin_layout/header',$data);
		$this->load->view('admpro/add_chips');
		$this->load->view('admin_layout/footer');
		}else{			     
				  $this->load->view('admpro/index', $data);
			}
	}
	public function Chips_added(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){
		/* $pre_file_name = $_FILES['profileImage']['name'];
		$new_file_name = str_replace(' ', '_', $pre_file_name);
		$config = array(
		'upload_path' => "upload/",
		'allowed_types' => "*",
		'overwrite' => TRUE,
		'max_size' => "2048000", 
		'file_name' => $new_file_name		
		);	
		$this->load->library('upload', $config);
		if($this->upload->do_upload('profileImage')){
			$file_data = $this->upload->data();
			//$this->load->view('upload_success',$data);
			$file_name = $file_data['file_name'];
		}*/
		$file_name = $this->input->post('profileImage');		
		$add_chips = $this->admin_model->ChipsAdd($file_name);	
		if($add_chips == true){
		      $this->session->set_flashdata('message_display', 'Data added successfully');
		}else{
			$this->session->set_flashdata('message_display', 'Error in adding user! ');							 
		}							
		redirect('admpro/add_chips');
		}else{			     
				  $this->load->view('admpro/index', $data);
			}	
		}


	public function edit_chips($id){
		$data =array();
		if(isset($this->session->userdata['login_user'])){
			$data['subTitle'] = 'Update Chips';
			$data['id'] = $id;
			$data['getallChipsInfo'] = $this->admin_model->getallChipsInfo($id);
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/edit_chips', $data);
			$this->load->view('admin_layout/footer');
		}else{
			redirect('admpro/index');
		}
	}
	public function Update_ChipsEdit(){
		$id ="";
		if(isset($this->session->userdata['login_user'])){
			$data['subTitle'] = 'UpdateChips';
			$data['id'] = $id;
			/*$pre_file_name = $_FILES['profileImage']['name'];
			$new_file_name = str_replace(' ', '_', $pre_file_name);
			$config = array(
			'upload_path' => "upload/",
			'allowed_types' => "*",
			'overwrite' => TRUE,
			'max_size' => "2048000", 
			'file_name' => $new_file_name		
		);	
		$this->load->library('upload', $config);
		if($this->upload->do_upload('profileImage')){
			$file_data = $this->upload->data();
			//$this->load->view('upload_success',$data);
			$file_name = $file_data['file_name'];
		}	*/
		$file_name = $this->input->post('profileImage');	
			$update = $this->admin_model->EditChips($file_name);
			if($update == true){
			    $this->session->set_flashdata('message_display', '<div class="alert alert-info">Data  added successfully </div>');
			}else{
					$this->session->set_flashdata('message_display', '<div class="alert alert-danger">Error  data updated</div>');							 
			}							
				redirect('admpro/Chips');
		}else{			     
				  $this->load->view('admpro/index', $data);
			}
			
	}
			


	public function deletechips($id){		
		$result = $this->admin_model->Deletechips($id);		
		if($result == 2){
			$this->session->set_flashdata('message_display', '<div class="alert alert-danger">Data cannot be deleted!</div>');
		}else{
			$this->session->set_flashdata('message_display', '<div class="alert alert-success">Data deleted successfully</div>');
		}
		redirect('admpro/Chips');	
	}
	
	public function get_cloneable_chips(){
		$data = "";
		$this->load->view('admpro/get_cloneable_chips', $data);	
	}
	
	public function get_more_clone_machine(){
		$data = "";
		$this->load->view('admpro/get_more_clone_machine', $data);	
	}
	
/*----------------------------------------------------------Key Type ----------------------------*/


	public function keyType(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
		$data['subTitle'] = 'Parts ><strong> Key Types</strong>';
		$data['getAllkeyType'] = $this->admin_model->getAllkeyType();
		$this->load->view('admin_layout/header',$data);
		$this->load->view('admpro/key_type', $data);
		$this->load->view('admin_layout/footer');
		}else{			     
		     $this->load->view('admpro/index', $data);
		}
	}


	public function addKeytype(){
	     $data =array();
	 	if(isset($this->session->userdata['login_user'])){	
	    $data['subTitle'] = 'Parts > Key Types ><strong> Add New Key Type</strong>';
		$this->load->view('admin_layout/header',$data);
		$this->load->view('admpro/add_key_type');
		$this->load->view('admin_layout/footer');
		}else{			     
				  $this->load->view('admpro/index', $data);
			}
	}
	public function keyTypeAdd(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
		$add_name = $this->admin_model->keyTypeAdd();	
		if($add_name == true){
		      $this->session->set_flashdata('message_display', 'Data added successfully');
		}else{
			$this->session->set_flashdata('message_display', 'Error in adding user! ');							 
		}							
		redirect('admpro/addKeytype');
		}else{			     
				  $this->load->view('admpro/index', $data);
			}	
		}
		

	public function edit_keytype($id){
		$data =array();
		if(isset($this->session->userdata['login_user'])){
			$data['subTitle'] = 'Parts > Key Types > <strong>Update Key Type</strong>';
			$data['id'] = $id;
			$data['getKeyTypeInfo'] = $this->admin_model->getKeyTypeInfo($id);
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/edit_keytype', $data);
			$this->load->view('admin_layout/footer');
		}else{
			redirect('admpro/index');
		}
	}
	public function update_keytype(){
		$id ="";
		$data =array();
		if(isset($this->session->userdata['login_user'])){
			$data['subTitle'] = 'Update Key Type';
			$data['id'] = $id;
			$update = $this->admin_model->EditKeyType();
			if($update == true){
			 		$this->session->set_flashdata('message_display', '<div class="alert alert-info">Data  added successfully </div>');
			}else{
					$this->session->set_flashdata('message_display', '<div class="alert alert-danger"> Name already exits</div>');							 
			}							
				redirect('admpro/keyTYpe');
		}else{			     
			  $this->load->view('admpro/index', $data);
			}
	}

	public function deletekeytype($id){
		$this->session->set_flashdata('message_display','<div class="alert alert-success">Data deleted successfully </div>');
		$result = $this->admin_model->deletetypekey($id);	
		redirect('admpro/keyType');	
	}

	public function pagination(){		
		 $session_data = array('per_page' => $this->input->post('searching'));
		 $this->session->set_userdata('pagination_per_page', $session_data);
	}
	
	public function key_type_sorting(){
		$data['sorting'] = $this->input->post('sorting');
		$data['sorting_by'] = $this->input->post('sorting_by');		
		$data['getAllkeyType'] = $this->admin_model->key_type_sorting();
		$this->load->view('admpro/key_type_sorting',$data);	
	}
	
	
/*----------------------------------------------Manufacturers-----------------------------------------*/


	public function manufacturers(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = 'Tools > <strong>Manufacturers</strong> ';
			$config = array();
			$config["base_url"] = base_url() . "admpro/manufacturers";
			$total_row = $this->admin_model->getAllManufacturersRows();
			$config["total_rows"] = $total_row;						
			$config['use_page_numbers'] = TRUE;
			$config['num_links'] = $total_row;
			$config['cur_tag_open'] = '<a class="current">';
			$config['cur_tag_close'] = '</a>';
			$config['per_page'] = 20;
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
			$data["getAllManufacturer"] = $this->admin_model->getAllManufacturersDetail($config["per_page"],$limt_start);
			$str_links = $this->pagination->create_links();
			$data["links"] = explode('&nbsp;',$str_links );			
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/manufacturer', $data);
			$this->load->view('admin_layout/footer');
			}else{			     
				 $this->load->view('admpro/index', $data);
			}
	}
	

	public function add_manufacturer(){
	     $data =array();
	 	if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = 'Tools > Manufacturers > <strong>Add New Manufacturer</strong>';
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/add_manufacturer');
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	

	public function user_sorting(){	
		$data['sorting'] = $this->input->post('sorting');
		$data['sort_by'] = $this->input->post('sortby');		
		$data['getAllUsers'] = $this->admin_model->user_sorting();
		$this->load->view('admpro/user_sorting',$data);
	}	
	
	public function show_userby_types(){
		$data['getAllUsers'] = $this->admin_model->show_userby_types();
		$this->load->view('admpro/show_userby_types',$data);
	}
	
	public function show_userby_access(){
		$data['getAllUsers'] = $this->admin_model->show_userby_access();
		$this->load->view('admpro/show_userby_types',$data);
	}	

	public function search_admin_users(){
		$data['getAllUsers'] = $this->admin_model->search_admin_users();
		$this->load->view('admpro/show_userby_types',$data);
	}

	public function add_manufacture(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
			$add_name = $this->admin_model->add_manufacture();	
			$this->session->set_flashdata('message_display', '<div class="alert alert-success">Data added successfully!</div>');	
			redirect('admpro/manufacturers');				
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	
	public function edit_manufacturer($id){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
			$data['manu_id'] = $id;
			$data['subTitle'] = 'Tools > Manufacturers > <strong>Update Manufacturer</strong>';
			$data['getManufacturerInfo'] = $this->admin_model->getManufacturerInfo($id);
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/edit_manufacturer');
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}	
	}
	
	public function update_manufacture(){
		$result = $this->admin_model->update_manufacture();	
		$this->session->set_flashdata('message_display', '<div class="alert alert-success">Data updated successfully</div>');
		redirect('admpro/manufacturers');
	}
	
	public function delete_manufacturer($id){		
		$result = $this->admin_model->delete_manufacturer($id);	
		if($result == 2){
			$this->session->set_flashdata('message_display', '<div class="alert alert-danger">Data cannot be deleted!</div>');
		}else{
			$this->session->set_flashdata('message_display', '<div class="alert alert-success">Data deleted successfully</div>');
		}
		redirect('admpro/manufacturers');	
	}
	
	
	public function manufacturers_sorting(){
		$data['sorting'] = $this->input->post('sorting');
		$data['sorting_by'] = $this->input->post('sorting_by');		
		$data['getAllManufacturer'] = $this->admin_model->manufacturers_sorting();
		$this->load->view('admpro/manufacturers_sorting',$data);	
	}
	
	
/*-------------------------------------------------------- Tool Type----------------------------------------------*/

	public function tool_type(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = ' Tools > <strong> Tool Types</strong>';
			$config = array();
			$config["base_url"] = base_url() . "admpro/tool_type";
			$total_row = $this->admin_model->getAllToolTypeRows();
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
			$data["getAllToolType"] = $this->admin_model->getAllToolTypeDetail($config["per_page"],$limt_start);
			$str_links = $this->pagination->create_links();
			$data["links"] = explode('&nbsp;',$str_links);	
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/tool_types', $data);
			$this->load->view('admin_layout/footer');
			}else{			     
				$this->load->view('admpro/index', $data);
			}	
		
	}

	public function add_tool_type(){
	     $data =array();
	 	if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = 'Tools > Tool Types > <strong>Add New Tool Type</strong>';
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/add_tool_type');
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}	
	
	public function tooltype_add(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
			$add_name = $this->admin_model->Add_toolType();	
			if($add_name == true){
				  $this->session->set_flashdata('message_display', 'Data added successfully');
			}else{
				$this->session->set_flashdata('message_display', 'Error in adding user! ');							 
			}							
			redirect('admpro/add_tool_type');
		}else{			     
			$this->load->view('admpro/index', $data);
		}	
	}
	
	
	public function edit_tool_type($id){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
			$data['toolTypeId'] = $id;
			$data['subTitle'] = 'Tools > Tool Types > <strong>Update Tool Type</strong>';
			$data['getToolTypeInfo'] = $this->admin_model->getToolTypeInfo($id);
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/edit_tool_type');
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}	
	}
	
	public function update_tool_type(){
		$result = $this->admin_model->update_tool_type();	
		$this->session->set_flashdata('message_display', '<div class="alert alert-success">Data updated successfully</div>');
		redirect('admpro/tool_type');
	}
	
	
	
	public function deletetooltype($id){		
		$result = $this->admin_model->deletetooltype($id);	
		if($result == 2){
			$this->session->set_flashdata('message_display', '<div class="alert alert-danger">Data cannot be deleted!</div>');
		}else{
			$this->session->set_flashdata('message_display', '<div class="alert alert-success">Data deleted successfully</div>');
		}
		redirect('admpro/tool_type');	
	}
	
	
	public function tool_type_sorting(){
		$data['sorting'] = $this->input->post('sorting');
		$data['getAllToolType'] = $this->admin_model->tool_type_sorting();
		$this->load->view('admpro/tool_type_sorting',$data);
	}
	
	
/*=============================== Manage Toools =============================*/

	public function tools(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = ' Tools > <strong> Tools </strong>';
			
			$config = array();
			$config["base_url"] = base_url() . "admpro/tools";
			$total_row = $this->admin_model->getAllToolsRows();
			$config["total_rows"] = $total_row;
			//$data['getAllMakeNames'] = $this->admin_model->getAllToolsRows();
			if(isset($this->session->userdata['pagination_per_page2'])){
				$per_page = $this->session->userdata['pagination_per_page2']; 
				$config["per_page"] = $per_page['per_page'];
			}else{
				$config["per_page"] = 50;
			}
				
			$config['use_page_numbers'] = TRUE;
			$config['num_links'] = $total_row;
			$config['cur_tag_open'] = '<a class="current">';
			$config['cur_tag_close'] = '</a>';
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
			$data["totalrows"] = $this->admin_model->getAllToolsRows();
			$data['page'] = $page;
			if(isset($this->session->userdata['tools_sorting_session'])){
				$sorting_data = $this->session->userdata['tools_sorting_session']; 
				$sort = $sorting_data['sorting'];
				$sort_col = $sorting_data['column'];
				$data["results"] = $this->admin_model->getSortAllTools($config["per_page"],$limt_start,$sort,$sort_col);
			}else{
				$data["results"] = $this->admin_model->getAllTools($config["per_page"],$limt_start);
			}
			$str_links = $this->pagination->create_links();
			$data["links"] = explode('&nbsp;',$str_links );			
			//$data['getAllTools'] = $this->admin_model->getAllTools();
			$data['getAllToolType'] = $this->admin_model->getAllToolType();
			$data['getAllManufacturer'] = $this->admin_model->getAllManufacturer();
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/tools', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}	
	}
	
	public function add_tools(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = 'Tools > Tools ><strong> Add New Tool</strong>';
			$data['getAllToolType'] = $this->admin_model->getAllToolType();
			$data['getAllManufacturer'] = $this->admin_model->getAllManufacturer();
			$data['getAllTools'] = $this->admin_model->getAllToolsInfo();
			$user_data = $this->session->userdata['login_user'];
			$user_email = $user_data['email'];
			$data['getUsersInfo'] = $this->admin_model->usersInInfo($user_email);
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/add_tools', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}	
	}
	
	public function save_tool(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){
			/*$pre_file_name = $_FILES['toolImage']['name'];
			$new_file_name = str_replace(' ', '_', $pre_file_name);
			$config = array(
			'upload_path' => "upload/",
			'allowed_types' => "*",
			'overwrite' => TRUE,
			'max_size' => "2048000", 
			'file_name' => $new_file_name		
			);	
			$this->load->library('upload', $config);
			if($this->upload->do_upload('toolImage')){
				$file_data = $this->upload->data();
				//$this->load->view('upload_success',$data);
				$file_name = $file_data['file_name'];
			}*/
			$file_name = $this->input->post('toolImage');					
			$query = $this->admin_model->save_tool($file_name);
			$this->session->set_flashdata('message_display', 'Data added successfully');
			redirect('admpro/add_tools');	
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	
	public function delete_tools($id){
		$result = $this->admin_model->delete_tools($id);	
		if($result == 2){
			$this->session->set_flashdata('message_display', '<div class="alert alert-danger">Data cannot be deleted!</div>');
		}else{
			$this->session->set_flashdata('message_display', '<div class="alert alert-success">Data deleted successfully</div>');
		}
		redirect('admpro/tools');
	}
	


	public function tools_sorting(){
		$data['sorting'] = $this->input->post('sorting');
		$session_data = array('sorting' => $this->input->post('sorting'), 'column' => 'Tool_Name' );
		$this->session->set_userdata('tools_sorting_session', $session_data);		
		$data['getAllTools'] = $this->admin_model->tools_sorting();
		$this->load->view('admpro/tools_sorting',$data);	
	}
	
	public function tools_sorting_by_type(){
		$data['sorting'] = $this->input->post('sorting');	
		$session_data = array('sorting' => $this->input->post('sorting'), 'column' => 'Tool_Type_Name' );
		$this->session->set_userdata('tools_sorting_session', $session_data);			
		$data['getAllToolsType'] = $this->admin_model->tools_sorting_by_type();
		$this->load->view('admpro/tools_sorting_by_type',$data);	
	}
	
	public function tools_sorting_by_manufacturer(){
		$data['sorting'] = $this->input->post('sorting');
		$session_data = array('sorting' => $this->input->post('sorting'), 'column' => 'Manufacturer_Name' );
		$this->session->set_userdata('tools_sorting_session', $session_data);		
		$data['getAllToolsType'] = $this->admin_model->tools_sorting_by_manufacturer();
		$this->load->view('admpro/tools_sorting_by_manufacturer',$data);	
	}
	 public function select_tools(){
		$data['getAllTools'] = $this->admin_model->select_tools();
		$this->load->view('admpro/select_tools',$data);		 
	}	
	
	public function tool_pagination(){		
		 $session_data = array('per_page' => $this->input->post('searching'));
		 $this->session->set_userdata('pagination_per_page2', $session_data);
	}
	
	public function search_tools(){
		$data['getAllTools'] = $this->admin_model->search_tools();
		$this->load->view('admpro/search_tools',$data);
	}
	
	
	public function chips_sorting(){
		$data['sorting'] = $this->input->post('sorting');
		$data['sorting_by'] = $this->input->post('sorting_by');				
		$data['getAllChips'] = $this->admin_model->chips_sorting();
		$this->load->view('admpro/chips_sorting',$data);	
	}
	
	
	public function edit_tools($id){
		$data =array();
		$data['toolid'] = $id;		
		if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = 'Tools > Tools ><strong> Update Tool</strong>';
			$data['getAllToolType'] = $this->admin_model->getAllToolType();
			$data['getAllManufacturer'] = $this->admin_model->getAllManufacturer();
			$data['getToolsInfo'] = $this->admin_model->getToolsInfo($id);
			$user_data = $this->session->userdata['login_user'];
			$user_email = $user_data['email'];
			$data['getUsersInfo'] = $this->admin_model->usersInInfo($user_email);
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/edit_tools', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}	
	}
	
	public function update_tool(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){			
			$file_name = $this->input->post('toolImage');					
			$query = $this->admin_model->update_tool($file_name);
			$this->session->set_flashdata('message_display', '<div class="alert alert-success">Data updated successfully</div>');
			redirect('admpro/tools');	
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	} 
	
	public function get_more_tools_type(){		
		$data['getAllToolType'] = $this->admin_model->getAllToolType();			
		$this->load->view('admpro/get_more_tools_type', $data);			
	}
	
/*-------------------------------- T_Batteries Module ---------------------------------------*/
	
	public function batteries(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = 'Parts > <strong>Batteries</strong>';	
			$config = array();
			$config["base_url"] = base_url() . "admpro/batteries";
			$total_row = $this->admin_model->getAllbatteriesRows();
			$config["total_rows"] = $total_row;						
			$config['use_page_numbers'] = TRUE;
			$config['num_links'] = $total_row;
			$config['cur_tag_open'] = '<a class="current">';
			$config['cur_tag_close'] = '</a>';
			$config['per_page'] = 5;
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
			$data["getAllbatteries"] = $this->admin_model->getAllbatteriesDetail($config["per_page"],$limt_start);
			$str_links = $this->pagination->create_links();
			$data["links"] = explode('&nbsp;',$str_links );			
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/batteries', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}	
	}
	
	public function add_battery(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = 'Parts > <strong>Batteries</strong>';			
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/add_battery', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	public function save_battery(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){			
			$file_name = $this->input->post('battery_image');					
			$query = $this->admin_model->save_battery($file_name);
			$this->session->set_flashdata('message_display', 'Data added successfully');
			redirect('admpro/add_battery');
		}else{			     
			$this->load->view('admpro/index', $data);
		}	
	}
	
	public function edit_battery($id){
		$data['batteryId'] = $id;
		if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = 'Parts > <strong>Batteries</strong>';
			$data['batteriesInfo'] = $this->admin_model->getAllbatteriesInfo($id);			
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/edit_battery', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	public function update_battery(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){			
			$file_name = $this->input->post('battery_image');					
			$query = $this->admin_model->update_battery($file_name);
			$this->session->set_flashdata('message_display', '<div class="alert alert-success">Data updated successfully</div>');
			redirect('admpro/batteries');
		}else{			     
			$this->load->view('admpro/index', $data);
		}	
	}
	
	public function battery_sorting(){
		$data['sorting'] = $this->input->post('sorting');
		$data['sorting_by'] = $this->input->post('sorting_by');				
		$data['getAllbatteries'] = $this->admin_model->battery_sorting();
		$this->load->view('admpro/battery_sorting',$data);	
	}
	
	
	public function delete_battery($id){		
		$result = $this->admin_model->delete_battery($id);	
		if($result == 1){
			$this->session->set_flashdata('message_display', '<div class="alert alert-success">Data deleted successfully</div>');			
		}else{
			$returning_result = $result;
			$Remote_Name = $returning_result[0]['Remote_Name'];
			$this->session->set_flashdata('message_display', '<div class="alert alert-danger">Data cannot be deleted, Battery is used in <b>'.$Remote_Name.'</b> Remote.</div>');	
		}
		redirect('admpro/batteries');		
	}

/*------------------------------------------------ Keys Module ----------------------------------------*/

	public function keys(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = 'Parts > <strong>Keys</strong>';
			$config = array();
			$config["base_url"] = base_url() . "admpro/keys";
			$total_row = $this->admin_model->getAllKyesRows();
			$config["total_rows"] = $total_row;
			//$data['getAllMakeNames'] = $this->admin_model->getAllToolsRows();
			if(isset($this->session->userdata['keys_pagination'])){
				$per_page = $this->session->userdata['keys_pagination']; 
				$config["per_page"] = $per_page['per_page'];
			}else{
				$config["per_page"] = 50;
			}				
			$config['use_page_numbers'] = TRUE;
			$config['num_links'] = $total_row;
			$config['cur_tag_open'] = '<a class="current">';
			$config['cur_tag_close'] = '</a>';
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
			$data["totalrows"] = $this->admin_model->getAllKyesRows();
			$data['page'] = $page;
			$_SESSION['keys_page_number'] = $page;
			if(isset($_SESSION['search_keys'])){
				unset($_SESSION['lock_types']);
				$result =   $this->admin_model->getsearchkey($_SESSION['search_keys']);	
				$data["results"] =  $this->admin_model->getsearchkey($_SESSION['search_keys']);	
				$data["totalrows"] = count($result);
			}elseif(isset($_SESSION['lock_types'])){
				if($_SESSION['lock_types'] == 'all'){
					$data["results"] = $this->admin_model->getAlkeys($config["per_page"],$limt_start);
				}else{	
				$data["results"] = $this->admin_model->getlockerfilter($_SESSION['lock_types']);
				}
			}elseif(isset($this->session->userdata['show_keysby_types'])){
				$value_key1 = $this->session->userdata['show_keysby_types'];
				$value_key =  $value_key1['key_types'];
				if($value_key == 'all'){
					$data["results"] = $this->admin_model->getAlkeys($config["per_page"],$limt_start);
				}else{
					$data["results"] = $this->admin_model->show_session_keysby_types($value_key);
				}
			}else{
				$data["results"] = $this->admin_model->getAlkeys($config["per_page"],$limt_start);
			}			
			$str_links = $this->pagination->create_links();
			$data["links"] = explode('&nbsp;',$str_links );	
			//$data['getkeys'] = $this->admin_model->getkeys();	
			$data['getAllkeyType'] = $this->admin_model->getAllkeyType();		
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/keys', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	public function add_key(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = 'Parts > <strong>Add New Key</strong>';
			$data['getkeys'] = $this->admin_model->getkeys();
			$data['getAllChips'] = $this->admin_model->getAllChips();
			$data['getAllkeyType'] = $this->admin_model->getAllkeyType();			
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/add_key', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	
	public function save_key(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){				
			$file_name = $this->input->post('key_image');				
			$query = $this->admin_model->save_key($file_name);
			$this->session->set_flashdata('message_display', 'Data added successfully');
			redirect('admpro/add_key');
		}else{			     
			$this->load->view('admpro/index', $data);
		}	
	}
	
	public function edit_key($id){
		$data['keyid'] = $id;
		if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = 'Parts > <strong>Update Key</strong>';
			$data['getkeysInfo'] = $this->admin_model->getkeysInfo($id);
			$data['getAllChips'] = $this->admin_model->getAllChips();
			$data['getAllkeyType'] = $this->admin_model->getAllkeyType();
			$data['result'] = $this->admin_model->get_substitute_keys();				
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/edit_key', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	public function copy_key($id){
		$data['keyid'] = $id;
		if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = 'Parts > <strong>Update Key</strong>';
			$data['getkeysInfo'] = $this->admin_model->getkeysInfo($id);
			$data['getAllChips'] = $this->admin_model->getAllChips();
			$data['getAllkeyType'] = $this->admin_model->getAllkeyType();			
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/copy_key', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	
	public function update_key(){
		$data =array();
		if(isset($_SESSION['keys_page_number'])){
		$page_id =  $_SESSION['keys_page_number'];
		}else{
			$page_id ="";
		}
		if(isset($this->session->userdata['login_user'])){			
			$file_name = $this->input->post('key_image');				
			$query = $this->admin_model->update_key($file_name);
			$this->session->set_flashdata('message_display', '<div class="alert alert-success">Data updated successfully</div>');
			redirect('admpro/keys/'.$page_id);
		}else{			     
			$this->load->view('admpro/index', $data);
		}	
	}	
	
	public function keys_sorting(){
		$data['sorting'] = $this->input->post('sorting');
		$data['sorting_by'] = $this->input->post('sorting_by');		
		$data['results'] = $this->admin_model->keys_sorting();
		$this->load->view('admpro/keys_sorting',$data);	
	}
	
	public function show_keysby_types(){
		unset($_SESSION['lock_types']);
		$keyresult = $this->admin_model->show_keysby_types();
		if($keyresult){
			$session_data = array('key_types' => $this->input->post('typeUuid'));
			$this->session->set_userdata('show_keysby_types', $session_data);
		}else{
			$session_data = array('key_types' => '');
			$this->session->unset_userdata('show_keysby_types', $session_data);
		}
		$data['getkeys'] = $this->admin_model->show_keysby_types();
		$this->load->view('admpro/show_keysby_types',$data);	
	}
	public function show_keysby_lock_types(){
		unset($_SESSION['search_keys']);		
		$data['getkeys'] = $this->admin_model->show_keysby_types();		
		$typeUuid = $this->input->post('typeUuid');
		$locktyperesult = $this->admin_model->show_keysby_lock_types();
		if($locktyperesult){
			$_SESSION['lock_types'] = $typeUuid;
		}else{
			unset($_SESSION['lock_types']);
		}
		$data['getkeys'] = $this->admin_model->show_keysby_lock_types();
		$this->load->view('admpro/show_keysby_types',$data);	
	}
	
	public function delete_key($id){		
		$result = $this->admin_model->delete_key($id);	
		$this->session->set_flashdata('message_display', '<div class="alert alert-success">Data deleted successfully</div>');
		redirect('admpro/keys');		
	}
	
	public function search_kyes(){
		$search_key = $this->input->post('search_key');
		$result = $this->admin_model->search_kyes();
		if($result){
			$_SESSION['search_keys'] = $search_key;
			$data['getkeys'] = $this->admin_model->search_kyes();
			$this->load->view('admpro/search_kyes',$data);
		}else{
			unset($_SESSION['search_keys']);
			$data['getkeys'] = $this->admin_model->search_kyes();
			$this->load->view('admpro/search_kyes',$data);
		}
	}
	
	public function keys_pagination(){		
		 $session_data = array('per_page' => $this->input->post('searching'));
		 $this->session->set_userdata('keys_pagination', $session_data);
	}


/*============================================= Remotes Module ================================================================*/


	public function remotes(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = 'Parts > <strong>Remotes</strong>';
			$config = array();
			$config["base_url"] = base_url() . "admpro/remotes";
			$total_row = $this->admin_model->getAllRemotesRows();
			$config["total_rows"] = $total_row;
			//$data['getAllMakeNames'] = $this->admin_model->getAllToolsRows();
			if(isset($this->session->userdata['remotes_pagination'])){
				$per_page = $this->session->userdata['remotes_pagination']; 
				$config["per_page"] = $per_page['per_page'];
			}else{
				$config["per_page"] = 50;
			}
				
			$config['use_page_numbers'] = TRUE;
			$config['num_links'] = $total_row;
			$config['cur_tag_open'] = '<a class="current">';
			$config['cur_tag_close'] = '</a>';
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
			$data["totalrows"] = $this->admin_model->getAllRemotesRows();
			$data['page'] = $page;
			$_SESSION['remote_page_number'] = $page;
			if(isset($_SESSION['search_remote_key']) && $_SESSION['search_remote_key'] !="" ){
				$data["results"] = $this->admin_model->filterromotebysearchkey($_SESSION['search_remote_key']);
			}elseif(isset($_SESSION['remotebytype'])){			
				$data["results"]	= $this->admin_model->getremotetypefilter($limt_start,$config["per_page"],$_SESSION['remotebytype']);
				
			}elseif(isset($_SESSION['filtermotebydate'])){
				$data["results"] = $this->admin_model->getromtefilter($config["per_page"],$limt_start);
			}else{
				$data["results"] = $this->admin_model->getAllRemotes($config["per_page"],$limt_start);
			}
			$str_links = $this->pagination->create_links();
			$data["links"] = explode('&nbsp;',$str_links );	
			$data['getAllRemoteType'] = $this->admin_model->getAllRemoteType();					
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/remotes', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	} 
	
	
	public function add_remote(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = 'Parts > <strong>Add New Remote</strong>';		
			$data['getAllbatteries'] = $this->admin_model->getAllbatteries();	
			$data['getAllChips'] = $this->admin_model->getAllChips();	
			$data['getAllRemoteType'] = $this->admin_model->getAllRemoteType();	
			$data["getAllMakeNames"] = $this->admin_model->getAllMakeNames();			
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/add_remote', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	
	public function save_remote(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){				
			$file_name = $this->input->post('Remote_Image_Url');				
			$query = $this->admin_model->save_remote($file_name);
			$this->session->set_flashdata('message_display', 'Data added successfully');
			redirect('admpro/add_remote');
		}else{			     
			$this->load->view('admpro/index', $data);
		}		
	}
	
	public function edit_remote($id){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = 'Parts > <strong>Update Remote</strong>';
			$data['remoteId'] = $id;			
			$data['getRemotesInfo'] = $this->admin_model->getRemotesInfo($id);			
			$data['getAllbatteries'] = $this->admin_model->getAllbatteries();	
			$data['getAllChips'] = $this->admin_model->getAllChips();	
			$data['getAllRemoteType'] = $this->admin_model->getAllRemoteType();	
			$data["getAllMakeNames"] = $this->admin_model->getAllMakeNames();			
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/edit_remote', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	public function copy_remote($id){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = 'Parts > <strong>Update Remote</strong>';
			$data['remoteId'] = $id;			
			$data['getRemotesInfo'] = $this->admin_model->getRemotesInfo($id);			
			$data['getAllbatteries'] = $this->admin_model->getAllbatteries();	
			$data['getAllChips'] = $this->admin_model->getAllChips();	
			$data['getAllRemoteType'] = $this->admin_model->getAllRemoteType();	
			$data["getAllMakeNames"] = $this->admin_model->getAllMakeNames();			
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/copy_remote', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}

	public function update_remote(){
		$data =array();
		if(isset($_SESSION['remote_page_number'])){
		$page_id =  $_SESSION['remote_page_number'];
		}else{
			$page_id ="";
		}
		if(isset($this->session->userdata['login_user'])){			
			$file_name = $this->input->post('Remote_Image_Url');				
			$query = $this->admin_model->update_remote($file_name);
			$this->session->set_flashdata('message_display', '<div class="alert alert-success">Data updated successfully</div>');
			redirect('admpro/remotes/'.$page_id);
		}else{			     
			$this->load->view('admpro/index', $data);
		}	
	}
	
	public function delete_remote($id){
		$result = $this->admin_model->delete_remote($id);	
		if($result == 1){
			$this->session->set_flashdata('message_display', '<div class="alert alert-success">Data deleted successfully</div>');
		}else{
			$get_vehicles = $result;
			$years = explode(',',$get_vehicles[0]['Years']);
			$get_models_name = get_models_name($get_vehicles[0]['Model_UUID']);
			$get_make_name = get_make_name($get_vehicles[0]['Model_UUID']);
			$vehilcle = $get_make_name[0]['Make_Name'].' '.$get_models_name[0]['Model_Name'].', '.$years[0].'-'.$years[count($years)-1];
			$this->session->set_flashdata('message_display', '<div class="alert alert-danger">Data cannot be deleted, Remote is used in <b>'.$vehilcle.'</b> vehicle.</div>');
			
		}
		redirect('admpro/remotes');	
	}
	
	public function remotes_pagination(){		
		$session_data = array('per_page' => $this->input->post('searching'));
		$this->session->set_userdata('remotes_pagination', $session_data);
	}
	
	public function remote_type_sorting(){
		$data['sorting'] = $this->input->post('sorting');
		$data['sorting_by'] = $this->input->post('sorting_by');				
		$data['results'] = $this->admin_model->remote_type_sorting();
		// echo "<pre>";
		// print_r($result);
			// echo "<pre>";
		
		// die();
		$this->load->view('admpro/remote_type_sorting',$data);
	}	
	
	public function show_remoteby_types(){
		unset($_SESSION['search_remote_key']);
		unset($_SESSION['filtermotebydate']);
		$data['sorting'] = 'DESC';	
		$data['sorting_by'] = '';	
		$result = $this->admin_model->show_remoteby_types();
		if($result){
			$_SESSION['remotebytype'] = $this->input->post('typeUuid');		
		}else{
			unset($_SESSION['remotebytype']);
		}
		$data['results'] = $this->admin_model->show_remoteby_types();
		$this->load->view('admpro/remote_type_sorting',$data);
	}	
	
	public function search_remotes(){
		unset($_SESSION['filtermotebydate']);
		$data['sorting'] = 'DESC';	
		$data['sorting_by'] = '';	
		$search_key = $this->input->post('search_key');
		
		$result = $this->admin_model->search_remotes();
		if($result){
			$_SESSION['search_remote_key'] = $search_key;			
		}else{
			unset($_SESSION['search_remote_key']);			
		}
		$data['results'] = $this->admin_model->search_remotes();
		$this->load->view('admpro/remote_type_sorting',$data);
	}


/*============================================= Remote Types Module ================================================================*/	

	public function remote_types(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = 'Parts > <strong>Remote Types</strong>';				
			$data['getAllRemoteType'] = $this->admin_model->getAllRemoteType();					
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/remote_types', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	public function add_remote_type(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = 'Parts > <strong>Add New Remote Type</strong>';					
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/add_remote_type', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	public function save_remote_type(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){
			$query = $this->admin_model->save_remote_type();
			$this->session->set_flashdata('message_display', 'Data added successfully');
			redirect('admpro/add_remote_type');
		}else{			     
			$this->load->view('admpro/index', $data);
		}	
	}
	
	public function edit_remote_type($id){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = 'Parts > <strong>Add New Remote Type</strong>';
			$data['remoteTypeId'] = $id;	
			$data['getRemoteTypeInfo'] = $this->admin_model->getRemoteTypeInfo($id);								
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/edit_remote_type', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	
	public function update_remote_type(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){
			$query = $this->admin_model->update_remote_type();
			$this->session->set_flashdata('message_display', '<div class="alert alert-success">Data updated successfully</div>');
			redirect('admpro/remote_types');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	public function delete_remote_type($id){
		$result = $this->admin_model->delete_remote_type($id);	
		$this->session->set_flashdata('message_display', '<div class="alert alert-success">Data deleted successfully</div>');
		redirect('admpro/remote_types');
	}
	
	public function m_remote_type_sorting(){
		$data['sorting'] = $this->input->post('sorting');		
		$data['getAllRemoteType'] = $this->admin_model->m_remote_type_sorting();
		$this->load->view('admpro/m_remote_type_sorting',$data);
	}



/*================================================= Retainers Module  =============================================================*/
	
	public function retainers(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = 'Parts > <strong>Remote Types</strong>';				
			$data['getRetainers'] = $this->admin_model->getRetainers();					
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/retainers', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	public function add_retainer(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = 'Parts > <strong>Add New Retainer</strong>';					
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/add_retainer', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	public function save_retainer(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){
			$query = $this->admin_model->save_retainer();
			$this->session->set_flashdata('message_display', 'Data added successfully');
			redirect('admpro/add_retainer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	public function edit_retainer($id){
		$data =array();
		if(isset($this->session->userdata['login_user'])){
			$data['ratainerId'] = $id;	
			$data['subTitle'] = 'Parts > <strong>Update Retainer</strong>';	
			$data['getRetainersInfo'] = $this->admin_model->getRetainersInfo($id);					
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/edit_retainer', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	
	public function update_retainer(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){
			$query = $this->admin_model->update_retainer();
			$this->session->set_flashdata('message_display', '<div class="alert alert-success">Data updated successfully</div>');
			redirect('admpro/retainers');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	public function delete_retainer($id){
		$result = $this->admin_model->delete_retainer($id);	
		if($result == 2){
			$this->session->set_flashdata('message_display', '<div class="alert alert-danger">Data cannot be deleted!</div>');
		}else{
			$this->session->set_flashdata('message_display', '<div class="alert alert-success">Data deleted successfully</div>');
		}
		redirect('admpro/retainers');	
	}
	
	public function ratainer_sorting(){
		$data['sorting'] = $this->input->post('sorting');		
		$data['getRetainers'] = $this->admin_model->ratainer_sorting();
		$this->load->view('admpro/ratainer_sorting',$data);
	}
	
	
	public function get_remote_shells(){
		$data['data_type'] = $this->input->post('data_type');
		$this->load->view('admpro/get_remote_shells',$data);
	}

	public function get_remote_keys(){
		$data['data_type'] = $this->input->post('data_type');
		$this->load->view('admpro/get_remote_keys',$data);
	}

/*================================= Tools Page Editing ================================================*/

 	public function edit_tools_inputs(){
		$data['UUID'] = $this->input->post('uuId');
		$data['dataId'] = $this->input->post('dataId');
		$data['column'] = $this->input->post('column');
		$data['value'] = $this->input->post('value');
		$this->load->view('admpro/edit_tools_inputs',$data);
	}	
	
	public function tools_input_update(){
		echo $results = $this->admin_model->tools_input_update();
	}	
	
	public function edit_tools_dropbox(){
		$data['UUID'] = $this->input->post('uuId');
		$data['dataId'] = $this->input->post('dataId');
		$data['column'] = $this->input->post('column');
		$data['value'] = $this->input->post('value');
		$data['key'] = $this->input->post('key');
		$data['type'] = $this->input->post('type');
		$data['getAllToolType'] = $this->admin_model->getAllToolType();
		$data['getAllManufacturer'] = $this->admin_model->getAllManufacturer();
		$this->load->view('admpro/edit_tools_dropbox',$data);
	}
	
	public function tools_dropbox_update(){
		echo $results = $this->admin_model->tools_dropbox_update();
	}

/*========================== Update Account =====================================*/

	public function account(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){
			$user_data = $this->session->userdata['login_user'];
			$user_email = $user_data['email'];
			$data['getUsersInfo'] = $this->admin_model->usersInInfo($user_email);
			$data['subTitle'] = 'Admin Access > <strong>'.$user_data['username'].'</strong>';	
			
			$data['id'] = $data['getUsersInfo'][0]['UserID'];					
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/edit_account', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	public function update_account(){
		if(isset($this->session->userdata['login_user'])){
			$data['subTitle'] = 'Update User';			
			$update = $this->admin_model->UpdateUser();
			$id = $this->input->post('userId');
			$this->session->set_flashdata('message_display', 'Data updated successfully');
			redirect('admpro/account');
		}else{
			redirect('admpro/index');
		}
	}

/*======================== Machines Info Module=========================================*/

	public function machines(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = 'Tools > <strong>Machines Info</strong>';	
			$config = array();
			$config["base_url"] = base_url() . "admpro/machines";
			$total_row = $this->admin_model->get_machinesRows();
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
			$data["results"] = $this->admin_model->get_machinesDetail($config["per_page"],$limt_start);
			$str_links = $this->pagination->create_links();
			$data["links"] = explode('&nbsp;',$str_links );
			//$data['results'] = $this->admin_model->get_machines();			
			$data['getMachinesTypes'] = $this->admin_model->getMachinesTypes();					
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/machines', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}

	public function add_machines(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = 'Tools > <strong>Add New Machine Info</strong>';	
			$data['getMachinesTypes'] = $this->admin_model->getMachinesTypes();				
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/add_machines', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	public function save_machines(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){
			$query = $this->admin_model->save_machines();
			$this->session->set_flashdata('message_display', 'Data added successfully');
			redirect('admpro/add_machines');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	
	public function edit_machine($id){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
			$data['id'] = $id;
			$data['subTitle'] = 'Tools > <strong>Update Machine</strong>';	
			$data['getMachinesInfo'] = $this->admin_model->getMachinesInfo($id);
			$data['getMachinesTypes'] = $this->admin_model->getMachinesTypes();					
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/edit_machine', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	public function update_machines(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){
			$query = $this->admin_model->update_machines();
			$this->session->set_flashdata('message_display', '<div class="alert alert-success">Data updated successfully</div>');
			redirect('admpro/machines');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	public function delete_machine($id){
		$result = $this->admin_model->delete_machine($id);	
		$this->session->set_flashdata('message_display', '<div class="alert alert-success">Data deleted successfully</div>');
		redirect('admpro/machines');
	}



/*======================== Buttons Module=========================================*/
	
	public function buttons(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = 'Parts > <strong>Buttons</strong>';	
			$data['results'] = $this->admin_model->get_buttons();				
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/buttons', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	public function add_buttons(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = 'Parts > <strong>Add New Button</strong>';	
			$data['results'] = $this->admin_model->get_buttons();				
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/add_buttons', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	public function save_button(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){
			$query = $this->admin_model->save_button();
			$this->session->set_flashdata('message_display', 'Data added successfully');
			redirect('admpro/add_buttons');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	public function edit_buttons($id){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
			$data['id'] = $id;
			$data['subTitle'] = 'Parts > <strong>Add New Button</strong>';	
			$data['buttonsInfo'] = $this->admin_model->buttonsInfo($id);				
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/edit_buttons', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	public function update_button(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){
			$query = $this->admin_model->update_button();
			$this->session->set_flashdata('message_display', '<div class="alert alert-success">Data updated successfully</div>');
			redirect('admpro/buttons');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	public function delete_buttons($id){
		$result = $this->admin_model->delete_buttons($id);	
		$this->session->set_flashdata('message_display', '<div class="alert alert-success">Data deleted successfully</div>');
		redirect('admpro/buttons');
	}
	
	public function buttons_sorting(){
		$data['sorting'] = $this->input->post('sorting');
		$data['sorting_by'] = $this->input->post('sorting_by');		
		$data['results'] = $this->admin_model->buttons_sorting();
		$this->load->view('admpro/buttons_sorting',$data);	
	}


/*======================== Key page - Alternative Keys=========================================*/
	
	public function HideAlternativeKeys(){
		$cookies_values = $_POST['remember']; 
		$cookie_name = "AlternativeKeys_cookie"; 
		if($_POST['remember'] == 1){
			setcookie($cookie_name, $cookies_values, time() + (86400 * 30), "/");
		}else{
			setcookie($cookie_name,$cookies_values, time() + (86400 * 30), "/");
		}
	}	
	
	public function get_substitute_keys(){
		$data['result'] = $this->admin_model->get_substitute_keys();	
		$this->load->view('admpro/get_substitute_keys',$data);
	}
	
	public function add_another_substitute(){
		$data['result'] = $this->admin_model->get_substitute_keys();
		$this->load->view('admpro/add_another_substitute',$data);
	}

/*================================= Keys Page Editing ================================================*/
	
	public function edit_keys_inputs(){
		$data['UUID'] = $this->input->post('uuId');
		$data['dataId'] = $this->input->post('dataId');
		$data['column'] = $this->input->post('column');
		$data['value'] = $this->input->post('value');
		$this->load->view('admpro/edit_keys_inputs',$data);
	}	
	
	public function keys_input_update(){
		echo $results = $this->admin_model->keys_input_update();
	}	
	
	public function edit_keys_dropbox(){
		$data['UUID'] = $this->input->post('uuId');
		$data['dataId'] = $this->input->post('dataId');
		$data['column'] = $this->input->post('column');
		$data['value'] = $this->input->post('value');
		$data['key'] = $this->input->post('key');
		$data['type'] = $this->input->post('type');
		$data['getkeys'] = $this->admin_model->getkeys();
		$data['getAllChips'] = $this->admin_model->getAllChips();
		$data['getAllkeyType'] = $this->admin_model->getAllkeyType();	
		$this->load->view('admpro/edit_keys_dropbox',$data);
	}
	
	public function keys_dropbox_update(){
		echo $results = $this->admin_model->keys_dropbox_update();
	}


/*================================= Remote Page Editing ================================================*/


	public function edit_remotes_inputs(){
		$data['UUID'] = $this->input->post('uuId');
		$data['dataId'] = $this->input->post('dataId');
		$data['column'] = $this->input->post('column');
		$data['value'] = $this->input->post('value');
		$this->load->view('admpro/edit_remotes_inputs',$data);
	}	
	
	public function remotes_input_update(){
		echo $results = $this->admin_model->remotes_input_update();
	}
	
	public function edit_remotes_dropbox(){
		$data['UUID'] = $this->input->post('uuId');
		$data['dataId'] = $this->input->post('dataId');
		$data['column'] = $this->input->post('column');
		$data['value'] = $this->input->post('value');
		$data['key'] = $this->input->post('key');
		$data['type'] = $this->input->post('type');
		$data['getAllbatteries'] = $this->admin_model->getAllbatteries();	
		$data['getAllChips'] = $this->admin_model->getAllChips();	
		$data['getAllRemoteType'] = $this->admin_model->getAllRemoteType();		
		$this->load->view('admpro/edit_remotes_dropbox',$data);
	}
	
	public function remotes_dropbox_update(){
		echo $results = $this->admin_model->remotes_dropbox_update();
	}
	
/*=============================== Page Editing Functions ===============================================*/
	
	public function edit_chips_inputs(){
		$data['UUID'] = $this->input->post('uuId');
		$data['dataId'] = $this->input->post('dataId');
		$data['column'] = $this->input->post('column');
		$data['value'] = $this->input->post('value');
		$data['dataTable'] = $this->input->post('dataTable');
		$data['image'] = $this->input->post('image');
		$this->load->view('admpro/edit_chips_inputs',$data);
	}
	
	public function chips_input_update(){
		echo $results = $this->admin_model->chips_input_update();
	}
	
	public function edit_table_dropbox(){		
		$data['dataId'] = $this->input->post('dataId');
		$data['column'] = $this->input->post('column');
		$data['value'] = $this->input->post('value');
		$data['dataTable'] = $this->input->post('dataTable');
		$data['dataType'] = $this->input->post('dataType');
		$data['image'] = $this->input->post('image');
		$data['getMachinesTypes'] = $this->admin_model->getMachinesTypes();	
		$data['getallmakes'] = $this->admin_model->getallmakes();		
		$this->load->view('admpro/edit_table_dropbox',$data);
	}
	
	public function table_dropbox_update(){
		echo $results = $this->admin_model->table_dropbox_update();
	}

/*============================== Key Code - Sechedule Module ===============================================*/

	public function schedule(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = 'Key Codes > <strong>Schedule</strong>';	
			$config = array();
			$config["base_url"] = base_url() . "admpro/schedule";
			$total_row = $this->admin_model->getAllScheduleRows();
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
			$data["results"] = $this->admin_model->get_make_schedules($config["per_page"],$limt_start);
			$str_links = $this->pagination->create_links();
			$data["links"] = explode('&nbsp;',$str_links );													
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/schedule', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	public function update_schedule(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){
			$query = $this->admin_model->update_schedule();
			echo '<div class="alert alert-success">Data updated successfully</div>';			
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	public function machine_sorting(){
		$data['sorting'] = $this->input->post('sorting');
		$data['sort_by'] = $this->input->post('sortby');		
		$data['results'] = $this->admin_model->machine_sorting();
		$this->load->view('admpro/machine_sorting',$data);
	}	
	
	public function select_by_machine(){
		$data['sorting'] = 'DESC';
		$data['sort_by'] = '';		
		$data['results'] = $this->admin_model->select_by_machine();
		$this->load->view('admpro/machine_sorting',$data);
	}	


/*=================================== Add Image Types =====================================*/

	public function image_types(){	
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = 'Other > <strong>Image Types</strong>';	
			$data['results'] = $this->admin_model->get_image_types();				
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/image_types', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}	
	
	public function add_image_types(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = 'Other > <strong>Add New Image Types</strong>';	
			$data['results'] = $this->admin_model->get_image_types();				
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/add_image_types', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	public function save_image_types(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
			$query = $this->admin_model->save_image_types();
			$this->session->set_flashdata('message_display', 'Data added successfully');
			redirect('admpro/add_image_types');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	public function edit_image_types($id){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = 'Other > <strong>Update Image Types</strong>';	
			$data['id'] = $id;	
			$data['image_types_info'] = $this->admin_model->get_image_types_info($id);				
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/edit_image_types', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	public function update_image_types(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
			$query = $this->admin_model->update_image_types();
			$this->session->set_flashdata('message_display', '<div class="alert alert-success">Data updated successfully</div>');
			redirect('admpro/image_types');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	public function delete_image_types($id){
		$result = $this->admin_model->delete_image_types($id);	
		$this->session->set_flashdata('message_display', '<div class="alert alert-success">Data deleted successfully</div>');
		redirect('admpro/image_types');
	}
	
	public function images(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = 'Other > <strong>Images</strong>';	
			$data['results'] = $this->admin_model->get_image();	
			$data['image_types'] = $this->admin_model->get_image_types();			
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/images', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	public function add_image(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = 'Other > <strong>Add New Image</strong>';	
			$data['results'] = $this->admin_model->get_image();	
			$data['image_types'] = $this->admin_model->get_image_types();				
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/add_image', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	public function save_image(){
			$data =array();
			if(isset($this->session->userdata['login_user'])){	
				$pre_file_name = $_FILES['Filename']['name'];
				$new_file_name = str_replace(' ', '_', $pre_file_name);
				$config = array(
					'upload_path' => "images/",
					'allowed_types' => "*",
					'overwrite' => TRUE,
					'max_size' => "2048000", 
					'file_name' => $new_file_name		
				);	
			$this->load->library('upload', $config);
			if($this->upload->do_upload('Filename')){
				$file_data = $this->upload->data();
				//$this->load->view('upload_success',$data);
				$file_name = $file_data['file_name'];
			}
			$query = $this->admin_model->save_image($file_name);
			$this->session->set_flashdata('message_display', 'Data added successfully');
			redirect('admpro/add_image');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	public function edit_image($id){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
			$data['id'] = $id;	
			$data['subTitle'] = 'Other > <strong>Update Image</strong>';	
			$data['image_info'] = $this->admin_model->get_image_info($id);	
			$data['image_types'] = $this->admin_model->get_image_types();				
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/edit_image', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	public function update_image(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){
			$pre_file_name = $_FILES['Filename']['name'];
			$new_file_name = str_replace(' ', '_', $pre_file_name);
			$config = array(
				'upload_path' => "images/",
				'allowed_types' => "*",
				'overwrite' => TRUE,
				'max_size' => "2048000", 
				'file_name' => $new_file_name		
			);	
			$this->load->library('upload', $config);
			if($this->upload->do_upload('Filename')){
				$file_data = $this->upload->data();
				//$this->load->view('upload_success',$data);
				$file_name = $file_data['file_name'];
			}	
			$query = $this->admin_model->update_image($file_name);
			$this->session->set_flashdata('message_display', '<div class="alert alert-success">Data updated successfully</div>');
			redirect('admpro/images');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	public function delete_image($id){
		$result = $this->admin_model->delete_image($id);	
		$this->session->set_flashdata('message_display', '<div class="alert alert-success">Data deleted successfully</div>');
		redirect('admpro/images');
	}
	
	public function image_sorting_by_type(){
		$data['sorting'] = $this->input->post('sorting');
		$data['sort_by'] = $this->input->post('sortby');		
		$data['results'] = $this->admin_model->image_sorting_by_type();	
		$this->load->view('admpro/image_sorting',$data);
	}
	
	public function select_image_types(){
		$data['sorting'] = 'DESC';	
		$data['sort_by'] = '';		
		$data['results'] = $this->admin_model->select_image_types();	
		$this->load->view('admpro/image_sorting',$data);
	}


	public function sort_remote_by_date(){
		unset($_SESSION['search_remote_key']);
		$data['sorting'] = 'DESC';
		$data['sorting_by'] = '';	
		$result = $this->admin_model->sort_remote_by_date();	
		if($result){
			$_SESSION['filtermotebydate'] = "Date added";
		}else{
			unset($_SESSION['filtermotebydate']);
		}		
		$data['results'] = $this->admin_model->sort_remote_by_date();	
		$this->load->view('admpro/remote_type_sorting',$data);
	}
	
	
/*==================== Add Part Type  ==================================================================*/

	public function locks_types(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = 'Parts > <strong>Lock Types</strong>';	
			$data['results'] = $this->admin_model->get_part_types();				
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/part_types', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
		
	public function add_lock_types(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = 'Parts > <strong>Add Lock Types</strong>';	
			$data['results'] = $this->admin_model->get_part_types();				
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/add_part_types', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	
	public function save_part_type(){	
		$query = $this->admin_model->save_part_type();
		$this->session->set_flashdata('message_display', 'Data added successfully');
		redirect('admpro/add_lock_types');
	}
	
	public function edit_lock_type($id){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
			$data['id'] = $id;
			$data['subTitle'] = 'Parts > <strong>Update Lock Types</strong>';	
			$data['part_type_info'] = $this->admin_model->get_part_type_info($id);				
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/edit_part_type', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	public function update_part_type(){
		$query = $this->admin_model->update_part_type();
		$this->session->set_flashdata('message_display', 'Data updated successfully');
		redirect('admpro/locks_types');
	}
	
	public function delete_part_type($id){
		$result = $this->admin_model->delete_part_type($id);	
		$this->session->set_flashdata('message_display', 'Data deleted successfully');
		redirect('admpro/locks_types');
	}
	
	
	public function Locks(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = 'Parts > <strong>Locks</strong>';
			$config = array();
			$config["base_url"] = base_url() . "admpro/Locks";
			$total_row = $this->admin_model->get_partsRows();
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
			$data["results"] = $this->admin_model->get_partsDetail($config["per_page"],$limt_start);
			$str_links = $this->pagination->create_links();
			$data["links"] = explode('&nbsp;',$str_links );					
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/locks', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	public function add_locks(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = 'Parts > <strong>Locks</strong>';	
			$data['results'] = $this->admin_model->get_part_types();
			$data["getAllMakeNames"] = $this->admin_model->getAllMakeNames();				
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/add_parts', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}	
	}
	
	public function save_parts(){
		$query = $this->admin_model->save_parts();
		$this->session->set_flashdata('message_display', 'Data added successfully');
		redirect('admpro/add_locks');
	}
	
	public function edit_locks($id){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
			$data['id'] = $id;
			$data['subTitle'] = 'Parts > <strong>Update Locks</strong>';	
			$data['results'] = $this->admin_model->get_part_types();
			$data['part_info'] = $this->admin_model->get_part_info($id);
			$data["getAllMakeNames"] = $this->admin_model->getAllMakeNames();					
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/edit_parts', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}	
	}
	
	public function copy_locks($id){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
			$data['id'] = $id;
			$data['subTitle'] = 'Parts > <strong>Copy Locks</strong>';	
			$data['results'] = $this->admin_model->get_part_types();
			$data['part_info'] = $this->admin_model->get_part_info($id);
			$data["getAllMakeNames"] = $this->admin_model->getAllMakeNames();					
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/copy_parts', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}	
	}
	
	
	
	public function update_parts(){
		$query = $this->admin_model->update_parts();
		$this->session->set_flashdata('message_display', 'Data updated successfully');
		redirect('admpro/locks');
	}
	
	public function delete_parts($id){
		$result = $this->admin_model->delete_parts($id);	
		$this->session->set_flashdata('message_display', 'Data deleted successfully');
		redirect('admpro/locks');
	}
	
	public function part_type_sorting(){
		$data['sorting'] = $this->input->post('sorting');
		$data['sorting_by'] = $this->input->post('sorting_by');		
		$data['results'] = $this->admin_model->part_type_sorting();
		$this->load->view('admpro/part_type_sorting',$data);	
	}
	
	public function part_sorting(){
		$data['sorting'] = $this->input->post('sorting');
		$data['sorting_by'] = $this->input->post('sorting_by');		
		$data['results'] = $this->admin_model->part_sorting();
		$this->load->view('admpro/part_sorting',$data);	
	}
	
/*---------------------- Manage Users -------------------------------------------------*/

	public function users(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = '<strong>Users</strong>';
			
			/*------------------ Pagination -------------------------------*/
			
			$config = array();
			$config["base_url"] = base_url() . "admpro/users";
			$total_row = $this->admin_model->get_aks_users_rows();
			$config["total_rows"] = $total_row;
			//$data['getAllMakeNames'] = $this->admin_model->getAllToolsRows();
			if(isset($this->session->userdata['remotes_pagination'])){
				$per_page = $this->session->userdata['remotes_pagination']; 
				$config["per_page"] = $per_page['per_page'];
			}else{
				$config["per_page"] = 200;
			}
				
			$config['use_page_numbers'] = TRUE;
			$config['num_links'] = $total_row;
			$config['cur_tag_open'] = '<a class="current">';
			$config['cur_tag_close'] = '</a>';
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
			$data["totalrows"] = $total_row;
			$data['page'] = $page;
			//$data["results"] = $this->admin_model->get_ecomm_users($config["per_page"],$limt_start);
			$str_links = $this->pagination->create_links();
			$data["links"] = explode('&nbsp;',$str_links );	
			$data['last_aks_results'] = $this->admin_model->last_aks_results();		
			$data['aks_results'] = $this->admin_model->get_aks_users($limt_start,$config["per_page"]);	
			$user_data = $this->session->userdata['login_user'];
			$user_email = $user_data['email'];				
			$data['getUsersInfo'] = $this->admin_model->usersInInfo($user_email);
					
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/aks_users', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}	
	}
	
	public function edit_aks_users($id){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
			$data['id'] = $id;
			$data['subTitle'] = 'Manage Users > <strong>Update Users</strong>';
			$data['aks_users_info'] = $this->admin_model->get_aks_users_info($id);				
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/edit_aks_users', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	public function edit_aks_users2($id){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
			$data['id'] = $id;
			$data['subTitle'] = 'Manage Users > <strong>Update Users</strong>';
			$data['aks_users_info'] = $this->admin_model->get_aks_users_info2($id);				
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/edit_aks_users2', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	public function update_aks_db_users(){
		$this->form_validation->set_rules('FirstName', 'FirstName', 'required');				
		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('message_display', '<font color="#FF0000"><strong>'.validation_errors().'</strong></font>');
			redirect('admpro/users');		
        }else{
		  $query = $this->admin_model->update_aks_db_users();
		  $this->session->set_flashdata('message_display', 'Data updated successfully');
		  redirect('admpro/users');
		}
	}
	
	public function update_aks_db_users2(){
		$this->form_validation->set_rules('FirstName', 'FirstName', 'required');				
		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('message_display', '<font color="#FF0000"><strong>'.validation_errors().'</strong></font>');
			redirect('admpro/users');		
        }else{
		  $query = $this->admin_model->update_aks_db_users2();
		  $this->session->set_flashdata('message_display', 'Data updated successfully');
		  redirect('admpro/users');
		}
	}
	
/*---------------------- Manage Methods -------------------------------------------------*/	
	
	
	public function methods(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = 'Manage Methods > <strong>Methods</strong>';	
			$data['results'] = $this->admin_model->get_methods();	
			$data["getAllMakeNames"] = $this->admin_model->getAllMakeNames();
			$user_data = $this->session->userdata['login_user'];
			$user_email = $user_data['email'];				
			$data['getUsersInfo'] = $this->admin_model->usersInInfo($user_email);				
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/methods', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	public function keymaking_methods(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = 'Vehicles > <strong>Keymaking Methods</strong>';	
			$config = array();
			$config["base_url"] = base_url() . "admpro/keymaking_methods";
			$total_row = $this->admin_model->getAllMethodRows();
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
			$data["results"] = $this->admin_model->getmethods($config["per_page"],$limt_start);
			$str_links = $this->pagination->create_links();
			$data["links"] = explode('&nbsp;',$str_links );			
			$data["getAllMakeNames"] = $this->admin_model->getAllMakeNames();
			$user_data = $this->session->userdata['login_user'];
			$user_email = $user_data['email'];				
			$data['getUsersInfo'] = $this->admin_model->usersInInfo($user_email);					
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/methods', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	public function add_method($us_id = ""){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = 'Vehicles > <strong>Add Keymaking Methods</strong>';	
			$data['us_id'] = $us_id;
			//$data['results'] = $this->admin_model->get_methods();
			//$data['image_types'] = $this->admin_model->get_image_types();								
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/add_method', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	
	public function save_method(){
		$query = $this->admin_model->save_method();
		$this->session->set_flashdata('message_display', 'Data added successfully');
		redirect('admpro/keymaking_methods');
	}
	
	public function edit_method($id){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
			$data['id'] = $id;
			$data['subTitle'] = 'Vehicles > <strong>Update Keymaking Methods</strong>';	
			$data['method_info'] = $this->admin_model->get_method_info($id);
			$data['image_types'] = $this->admin_model->get_image_types();
			$user_data = $this->session->userdata['login_user'];
			$user_email = $user_data['email'];				
			$data['getUsersInfo'] = $this->admin_model->usersInInfo($user_email);						
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/edit_method', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}

	public function copy_method($id){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
			$data['id'] = $id;
			$data['subTitle'] = 'Vehicles > <strong>Add Keymaking Methods</strong>';	
			$data['method_info'] = $this->admin_model->get_method_info($id);
			$data['image_types'] = $this->admin_model->get_image_types();
			$user_data = $this->session->userdata['login_user'];
			$user_email = $user_data['email'];				
			$data['getUsersInfo'] = $this->admin_model->usersInInfo($user_email);						
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/copy_method', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	
	public function update_method(){
		$query = $this->admin_model->update_method();
		$this->session->set_flashdata('message_display', 'Data added successfully');
		redirect('admpro/keymaking_methods');
	}
	
	public function delete_method($id){
		$result = $this->admin_model->delete_method($id);	
		$this->session->set_flashdata('message_display', 'Data deleted successfully');
		redirect('admpro/keymaking_methods');	
	}


	
/*------------------- Update data to firebase --------------------------------------------*/

	public function firebase(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){			
			$data['subTitle'] = '<strong>Firebase Updates</strong>';	
			$data['all_makes'] = $this->admin_model->get_AllMakes();			
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/firebase', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}	
	}
	
	public function update_vehicle(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){			
			$data['subTitle'] = 'Firebase > <strong>Update Vehicle Category</strong>';	
			$data['all_makes'] = $this->admin_model->get_Firebase_AllMakes();			
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/update_vehicle_category', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}

	public function update_vehicle_info(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
			$this->db->cache_delete_all();		
			$data['subTitle'] = 'Firebase > <strong>Update Vehicle Info</strong>';	
			$data['all_makes'] = $this->admin_model->get_Firebase_AllMakes();	
			$data['part'] = 1;		
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/vehicle_info', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}	
	}

	public function vehicle_info_ajax($part){
		$data['part'] = $part;
		$this->load->view('admpro/vehicle_info_ajax', $data);
	}

	public function vehicle_info_part2(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){			
			$data['subTitle'] = 'Firebase > <strong>Update Vehicle Info</strong>';	
			$data['all_makes'] = $this->admin_model->get_Firebase_AllMakes();			
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/vehicle_info_part2', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}	
	}
	
	public function update_code_series_info(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){
			$data['subTitle'] = 'Firebase > <strong>Update Code Series</strong>';			
			$data['getAllCodeSeries'] = $this->admin_model->getAllCodeSeries();		
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/update_code_series', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}	
	}
	

/*------------------------------- AKS Users With FIebase ---------------------------------------*/


	public function update_aks_users(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){			
			  $options['auth'] = 'tDpktmFrLHJRZIBCoyPUU68ba4gbnQRUhqdn6y9H'; 
			  $cSession = curl_init(); 				
			  curl_setopt($cSession,CURLOPT_URL,"https://autopro-75ac3.firebaseio.com/users.json?". http_build_query($options));
			  curl_setopt($cSession, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));	
			  curl_setopt($cSession, CURLOPT_CUSTOMREQUEST, "GET");						
			  curl_setopt($cSession, CURLOPT_POSTFIELDS,''); 
			  curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);	
			  curl_setopt($cSession, CURLOPT_SSL_VERIFYPEER, false);		 
			  $result_output = curl_exec($cSession);			 
			  curl_error($cSession);			  						
			  $outputs = json_decode($result_output, true);
			  echo $result = $this->admin_model->update_aks_users($outputs);	 
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	public function change_users_status(){
		$result = $this->admin_model->change_users_status();	
	}

/*---------------------- Add Correction Page -------------------------------------------*/

	public function corrections(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = 'User Submissions > <strong>Customer Feedback</strong>';	
			$data['results'] = $this->admin_model->get_corrections();
			$user_data = $this->session->userdata['login_user'];
			$user_email = $user_data['email'];				
			$data['getUsersInfo'] = $this->admin_model->usersInInfo($user_email);					
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/corrections', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	public function add_correction(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = 'User Submissions > <strong>Add correction</strong>';
			$data["getAllMakeNames"] = $this->admin_model->getAllMakeNames();									
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/add_correction', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	public function save_correction(){
		$this->form_validation->set_rules('user_name', 'User name', 'required');		
		$this->form_validation->set_rules('user_type', 'User Type', 'required');
		$this->form_validation->set_rules('feed_type', 'Feedback Type', 'required');
		$this->form_validation->set_rules('Vehicle_UUID', 'Vehicle Section', 'required');				
		if ($this->form_validation->run() == FALSE){
              $this->session->set_flashdata('message_display', '<font color="#FF0000"><strong>'.validation_errors().'</strong></font>');
			  redirect('admpro/add_correction');		
        }else{
			$query = $this->admin_model->save_correction();
			$this->session->set_flashdata('message_display', 'Data added successfully');
			redirect('admpro/add_correction');
		}
	}
	
	public function edit_correction($id){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = 'User Submissions > <strong>Update correction</strong>';
			$data['id'] = $id;
			$data["getAllMakeNames"] = $this->admin_model->getAllMakeNames();
			$data['get_corrections_info'] = $this->admin_model->get_corrections_info($id);								
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/edit_correction', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	public function update_correction(){		
		$this->form_validation->set_rules('feed_type', 'Feedback Type', 'required');
		$this->form_validation->set_rules('Vehicle_UUID', 'Vehicle Section', 'required');				
		if ($this->form_validation->run() == FALSE){
              $this->session->set_flashdata('message_display', '<font color="#FF0000"><strong>'.validation_errors().'</strong></font>');
			  redirect('admpro/corrections');		
        }else{
			$query = $this->admin_model->update_correction();
			$this->session->set_flashdata('message_display', 'Data updated successfully');
			redirect('admpro/corrections');
		}
	}
	
	public function delete_correction($id){
		$result = $this->admin_model->delete_correction($id);	
		$this->session->set_flashdata('message_display', 'Data deleted successfully');
		redirect('admpro/corrections');
	}
	
	public function change_feedback_status(){
		$result = $this->admin_model->change_feedback_status();	
	}
	
	public function show_feedback_types(){
		$data['results'] = $this->admin_model->show_feedback_types();
		$this->load->view('admpro/show_feedback_types',$data);		 
	}
	
	public function search_feedback(){
		$data['results'] = $this->admin_model->search_feedback();
		$this->load->view('admpro/show_feedback_types',$data);
	}
	
	
/*=========================Admin website add enable using AutoPro switcher==============*/	
	
	public function enable_app(){
		$app_switcher = $this->admin_model->enable_app();
		if($app_switcher){
			echo 'Success';
		}			
	}

/*---------------------------- Upadte Apps ---------------------------------------------*/
	
	public function update_aaps(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = '<strong>Push App Updates</strong>';
			$data["getAllMakeNames"] = $this->admin_model->getAllMakeNames();
			$user_data = $this->session->userdata['login_user'];
			$user_email = $user_data['email'];				
			$data['getUsersInfo'] = $this->admin_model->usersInInfo($user_email);									
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/update_aaps', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	public function add_update_version(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = 'Add iOS or Android App version';
			$data["getAllMakeNames"] = $this->admin_model->getAllMakeNames();
			$user_data = $this->session->userdata['login_user'];
			$user_email = $user_data['email'];				
			$data['getUsersInfo'] = $this->admin_model->usersInInfo($user_email);									
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/add_update_version', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
/*----------------------------User Submissions-----------------------------------------*/
	
	public function user_submissions(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = '<strong>User-Contributed Content</strong>';
			$config = array();
			$config["base_url"] = base_url() . "admpro/user_submissions";
			$total_row = $this->admin_model->getAlluser_submissionsRows();
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
			$str_links = $this->pagination->create_links();
			$data["links"] = explode('&nbsp;',$str_links );
			$data['users_contributed_content']	= $this->admin_model->users_contributed_content($config["per_page"],$limt_start);				
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/firebase_images', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	public function us_by_status(){
		$data['user_correction'] = $this->admin_model->user_correction();
		$data['vehicle_images'] = $this->admin_model->vehicle_images();	
		$data['methods'] = $this->admin_model->us_methods();					
		$this->load->view('admpro/us_by_status', $data);
	}
	
	public function us_by_type(){
		$data['user_correction'] = $this->admin_model->type_user_correction();
		$data['vehicle_images'] = $this->admin_model->type_vehicle_images();	
		$data['methods'] = $this->admin_model->type_us_methods();
		$data['type'] = $this->input->post('status');					
		$this->load->view('admpro/us_by_type', $data);
	}
	
	public function search_submissions(){
		$data['user_correction'] = $this->admin_model->search_user_correction();
		$data['vehicle_images'] = $this->admin_model->search_vehicle_images();	
		$data['methods'] = $this->admin_model->search_us_methods();					
		$this->load->view('admpro/us_by_status', $data);
	}
	
	
/*------------------------ Sorting on All Columns -----------------------------------------------*/
	
	public function keys_uuid_sorting(){
		$data['sorting'] = $this->input->post('sorting');
		$data['sorting_by'] = $this->input->post('sorting_by');		
		$data['results'] = $this->admin_model->keys_uuid_sorting();
		$this->load->view('admpro/keys_sorting',$data);	
	}


/*--------------------- AutProPAD --------------------------------------------------------------*/

	public function purchase_history(){
		$data['subTitle'] = '<strong>Machine Purchases</strong>';
			$config = array();
			$config["base_url"] = base_url() . "admpro/purchase_history";
			if(isset($this->session->userdata['purchases_sorting_sess'])){
				 $session_data = $this->session->userdata('purchases_sorting_sess');
				 $purchases_sorting = $session_data['purchases_sorting'];
				 $purchase_sort_order = $session_data['purchase_sort_order'];
				 if(isset($this->session->userdata['purchases_search'])){
				   $session_data = $this->session->userdata('purchases_search');
				   $purchases_search_val = $session_data['purchases_search_val'];
				    $data["results"] = $this->admin_model->get_purchase_history_sort_search_rows($purchases_sorting,$purchase_sort_order,$purchases_search_val);
				    $total_row = count($data["results"]);
				 }else{
					 $data["results"] = $this->admin_model->get_purchase_history_sort_search_rows($purchases_sorting,$purchase_sort_order,$purchases_search_val);
					 $total_row = count($data["results"]);
				 }				
			}else if(isset($this->session->userdata['purchases_search'])){
					$purchases_sorting = 'Product';
				 	$purchase_sort_order = 'ASC';
				   	$session_data = $this->session->userdata('purchases_search');
				    $purchases_search_val = $session_data['purchases_search_val'];
				    $data["results"] = $this->admin_model->get_purchase_history_sort_search_rows($purchases_sorting,$purchase_sort_order,$purchases_search_val);
				    $total_row = count($data["results"]);
			}else{
				$total_row = $this->admin_model->get_purchase_history_rows();
			}
			
			$config["total_rows"] = $total_row;
			//$data['getAllMakeNames'] = $this->admin_model->getAllToolsRows();
			if(isset($this->session->userdata['remotes_pagination'])){
				$per_page = $this->session->userdata['remotes_pagination']; 
				$config["per_page"] = $per_page['per_page'];
			}else{
				$config["per_page"] = 50;
			}
				
			$config['use_page_numbers'] = TRUE;
			$config['num_links'] = $total_row;
			$config['cur_tag_open'] = '<a class="current">';
			$config['cur_tag_close'] = '</a>';
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
			$data["totalrows"] = $this->admin_model->get_purchase_history_rows();
			$data['get_all_purchase_history_rows'] = $this->admin_model->get_all_purchase_history_rows();
			$data['page'] = $page;
			if(isset($this->session->userdata['purchases_sorting_sess'])){
				 $session_data = $this->session->userdata('purchases_sorting_sess');
				 $purchases_sorting = $session_data['purchases_sorting'];
				 $purchase_sort_order = $session_data['purchase_sort_order'];
				 if(isset($this->session->userdata['purchases_search'])){
				   $session_data = $this->session->userdata('purchases_search');
				   $purchases_search_val = $session_data['purchases_search_val'];
				    $data["results"] = $this->admin_model->get_purchase_history_sort_search($config["per_page"],$limt_start,$purchases_sorting,$purchase_sort_order,$purchases_search_val);
				 }else{
					 $data["results"] = $this->admin_model->get_purchase_history_sort($config["per_page"],$limt_start,$purchases_sorting,$purchase_sort_order);
				 }
				
			}else if(isset($this->session->userdata['purchases_search'])){
					$purchases_sorting = 'Product';
				 	$purchase_sort_order = 'ASC';
				   	$session_data = $this->session->userdata('purchases_search');
				    $purchases_search_val = $session_data['purchases_search_val'];
				    $data["results"] = $this->admin_model->get_purchase_history_sort_search($config["per_page"],$limt_start,$purchases_sorting,$purchase_sort_order,$purchases_search_val);
			}else{
				$data["results"] = $this->admin_model->get_purchase_history($config["per_page"],$limt_start);
			}
			$str_links = $this->pagination->create_links();
			$data["links"] = explode('&nbsp;',$str_links );					
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/purchase_history', $data);
			$this->load->view('admin_layout/footer');
	}	
	
	public function add_purchase_history(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){
			$data['subTitle'] = '<strong>Add Machine Purchases</strong>';
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/add_purchase_history', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	public function save_purchases(){
		$this->form_validation->set_rules('Order_Number', 'Order Number', 'required');						
		if ($this->form_validation->run() == FALSE){
              $this->session->set_flashdata('message_display', '<font color="#FF0000"><strong>'.validation_errors().'</strong></font>');
			  redirect('admpro/add_purchase_history');		
        }else{
			$query = $this->admin_model->save_purchases();
			$this->session->set_flashdata('message_display', 'Data added successfully');
			redirect('admpro/add_purchase_history');
		}
	}	
	
	public function edit_purchases($id){
		$data =array();
		if(isset($this->session->userdata['login_user'])){
			$data['subTitle'] = '<strong>Update Machine Purchases</strong>';
			$data['purchase_info'] = $this->admin_model->purchase_info($id); 
			$data['id'] = $id; 
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/edit_purchase_history', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	public function update_purchases(){
		$this->form_validation->set_rules('Order_Number', 'Order Number', 'required');						
		if ($this->form_validation->run() == FALSE){
              $this->session->set_flashdata('message_display', '<font color="#FF0000"><strong>'.validation_errors().'</strong></font>');
			  redirect('admpro/purchase_history');		
        }else{
			$query = $this->admin_model->update_purchases();
			$this->session->set_flashdata('message_display', 'Data updated successfully');
			redirect('admpro/purchase_history');
		}
	}
	
	public function delete_purchases($id){
		$result = $this->admin_model->delete_purchases($id);	
		$this->session->set_flashdata('message_display', 'Data deleted successfully');
		redirect('admpro/purchase_history');	
	}
	
	public function purchases_sorting(){
		$session_data = array('purchases_sorting' => $this->input->post('sorting_by'),'purchase_sort_order' => $this->input->post('sorting'));
		$this->session->set_userdata('purchases_sorting_sess', $session_data);
		$data['sorting'] = $this->input->post('sorting');
		$data['sorting_by'] = $this->input->post('sorting_by');	
		$data['search'] = 0;
		if(isset($this->session->userdata['purchases_search'])){
			 $session_data = $this->session->userdata('purchases_search');
			 $purchases_search_val = $session_data['purchases_search_val'];
			 $data['results'] = $this->admin_model->purchases_sorting_search($purchases_search_val);
		}else{			
			$data['results'] = $this->admin_model->purchases_sorting();
		}
		$this->load->view('admpro/purchases_sorting',$data);	
	}	
	
	public function edit_purchase_inputs(){
		$data['UUID'] = $this->input->post('uuId');
		$data['dataId'] = $this->input->post('dataId');
		$data['column'] = $this->input->post('column');
		$data['value'] = $this->input->post('value');
		$this->load->view('admpro/edit_purchase_inputs',$data);
	}
	
	public function purchase_input_update(){
		echo $results = $this->admin_model->purchase_input_update();
	}
	
	public function feedback(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){
		    $data['subTitle'] = 'AutoProPAD > <strong>Feedback</strong>';
			$config = array();
			$config["base_url"] = base_url() . "admpro/feedback";
			$total_row = $this->admin_model->get_purchase_feedback_rows();
			$config["total_rows"] = $total_row;
			//$data['getAllMakeNames'] = $this->admin_model->getAllToolsRows();
			if(isset($this->session->userdata['remotes_pagination'])){
				$per_page = $this->session->userdata['remotes_pagination']; 
				$config["per_page"] = $per_page['per_page'];
			}else{
				$config["per_page"] = 50;
			}
				
			$config['use_page_numbers'] = TRUE;
			$config['num_links'] = $total_row;
			$config['cur_tag_open'] = '<a class="current">';
			$config['cur_tag_close'] = '</a>';
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
			$data["totalrows"] = $this->admin_model->get_purchase_feedback_rows();
			$data['page'] = $page;
			$data["results"] = $this->admin_model->get_purchase_feedbacks($config["per_page"],$limt_start);
			$str_links = $this->pagination->create_links();
			$data["links"] = explode('&nbsp;',$str_links );					
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/feedback', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}	
	}
	
	public function add_feedback(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){
			$data['subTitle'] = 'AutoProPAD > <strong>Add Feedback</strong>';
			$user_data = $this->session->userdata['login_user'];
			$user_email = $user_data['email'];			
			$data['getUsersInfo'] = $this->admin_model->usersInInfo($user_email);
			$data["get_last_feedback"] = $this->admin_model->get_last_feedback();
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/add_feedback', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	
	
	public function save_feedback(){
		$this->form_validation->set_rules('Vehicle', 'Vehicle', 'required');						
		if ($this->form_validation->run() == FALSE){
              $this->session->set_flashdata('message_display', '<font color="#FF0000"><strong>'.validation_errors().'</strong></font>');
			  redirect('admpro/add_feedback');		
        }else{
			
			$cookies_values = $this->input->post('Submitted_By'); 
			$cookie_name = "db_Submitted_By_cookie"; 
			setcookie($cookie_name, $cookies_values, time() + (86400 * 30), "/");
			
			$cookies_values1 = $this->input->post('Phone'); 
			$cookie_name1 = "db_Phone_By_cookie"; 
			setcookie($cookie_name1, $cookies_values1, time() + (86400 * 30), "/");	
			
			$query = $this->admin_model->save_feedback();
			$this->session->set_flashdata('message_display', 'Data added successfully');
			redirect('admpro/add_feedback');
		}
	}
	
	public function edit_feedback($id){
		$data =array();
		if(isset($this->session->userdata['login_user'])){
			$data['subTitle'] = 'AutoProPAD > <strong>Update Feedback</strong>';
			$data['feedback_info'] = $this->admin_model->feedback_info($id); 
			$data['id'] = $id; 
			$user_data = $this->session->userdata['login_user'];
			$user_email = $user_data['email'];			
			$data['getUsersInfo'] = $this->admin_model->usersInInfo($user_email);
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/edit_feedback', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	public function update_feedback(){
		$this->form_validation->set_rules('Vehicle', 'Vehicle', 'required');				
		if ($this->form_validation->run() == FALSE){
              $this->session->set_flashdata('message_display', '<font color="#FF0000"><strong>'.validation_errors().'</strong></font>');
			  redirect('admpro/feedback');		
        }else{
			$query = $this->admin_model->update_feedback();
			$this->session->set_flashdata('message_display', 'Data updated successfully');
			redirect('admpro/feedback');
		}
	}
	
	public function delete_feedbacks($id){
		$result = $this->admin_model->delete_feedbacks($id);	
		$this->session->set_flashdata('message_display', 'Data deleted successfully');
		redirect('admpro/feedback');	
	}
	
	public function feedback_sorting(){
		$data['sorting'] = $this->input->post('sorting');
		$data['sorting_by'] = $this->input->post('sorting_by');		
		$data['results'] = $this->admin_model->feedback_sorting();
		$this->load->view('admpro/feedback_sorting',$data);	
	}
	
	public function edit_feedback_inputs(){
		$data['UUID'] = $this->input->post('uuId');
		$data['dataId'] = $this->input->post('dataId');
		$data['column'] = $this->input->post('column');
		$data['value'] = $this->input->post('value');
		$this->load->view('admpro/edit_feedback_inputs',$data);
	}
	
	public function feedback_input_update(){
		echo $results = $this->admin_model->feedback_input_update();
	}
	
	public function search_feedbacks(){
		$data['sorting'] = 'DESC';
		$data['sorting_by'] = '';		
		$data['results'] = $this->admin_model->search_feedbacks();
		$this->load->view('admpro/feedback_sorting',$data);	
	}
	
	public function feedback_worked_filter(){
		$data['sorting'] = 'DESC';
		$data['sorting_by'] = '';		
		$data['results'] = $this->admin_model->feedback_worked_filter();
		$this->load->view('admpro/feedback_sorting',$data);	
	}
	
	public function HideAddressed(){
		$cookies_values = $_POST['remember']; 
		$cookie_name = "Addressed_cookie"; 
		if($_POST['remember'] == 1){
			setcookie($cookie_name, $cookies_values, time() + (86400 * 30), "/");
		}else{
			setcookie($cookie_name,'', time() + (86400 * 30), "/");
		}
	}
	
	public function HideCancelReturns(){
		$cookies_values = $_POST['remember']; 
		$cookie_name = "CancelReturns_cookie"; 
		if($_POST['remember'] == 1){
			setcookie($cookie_name, $cookies_values, time() + (86400 * 30), "/");
		}else{
			setcookie($cookie_name,'', time() + (86400 * 30), "/");
		}
	}
	
	public function HideSupportPaid(){
		$cookies_values = $_POST['remember']; 
		$cookie_name = "SupportPaid_cookie"; 
		if($_POST['remember'] == 1){
			setcookie($cookie_name, $cookies_values, time() + (86400 * 30), "/");
		}else{
			setcookie($cookie_name,'', time() + (86400 * 30), "/");
		}
	}
	
	public function purchase_products_filter(){
		$value = $this->input->post('value');
		$session_data = array('purchases_search_val' => $value);
		$this->session->set_userdata('purchases_search', $session_data);
		$data['sorting'] = 'DESC';
		$data['sorting_by'] = '';
		$data['search'] = 0;
		if(isset($this->session->userdata['purchases_sorting_sess'])){
			 $session_data = $this->session->userdata('purchases_sorting_sess');
			 $purchases_sorting = $session_data['purchases_sorting'];
			 $purchase_sort_order = $session_data['purchase_sort_order'];
			 $data['results'] = $this->admin_model->purchase_products_filter_sort($purchases_sorting,$purchase_sort_order);
		}else{
			$data['results'] = $this->admin_model->purchase_products_filter();
		}
		$this->load->view('admpro/purchases_sorting',$data);	
	}
	
	public function search_purchases(){
		$data['sorting'] = 'DESC';
		$data['sorting_by'] = '';
		$data['search'] = 1;
		if(isset($this->session->userdata['purchases_sorting_sess'])){
			 $session_data = $this->session->userdata('purchases_sorting_sess');
			 $purchases_sorting = $session_data['purchases_sorting'];
			 $purchase_sort_order = $session_data['purchase_sort_order'];
			 $data['results'] = $this->admin_model->search_purchases_sort($purchases_sorting,$purchase_sort_order);
		}else{
			$data['results'] = $this->admin_model->search_purchases();
		}
		$this->load->view('admpro/purchases_sorting',$data);
	}
	
/*--------------------------- aksDev Customers -------------------------------------*/
	
	public function get_aksdev_customers(){
		$data['results'] = $this->admin_model->get_aksdev_customers();
		$this->load->view('admpro/get_aksdev_customers',$data);	
	}
	
	
	

/*=============================== Admin Access Page Editing =========================================*/


	public function edit_adminAccess_inputs(){
		$data['UUID'] = $this->input->post('uuId');
		$data['dataId'] = $this->input->post('dataId');
		$data['column'] = $this->input->post('column');
		$data['value'] = $this->input->post('value');
		$this->load->view('admpro/edit_adminAccess_inputs',$data);
	}	
	
	public function adminAccess_input_update(){
		$column_name = $this->input->post('columnName');
		$results = $this->admin_model->adminAccess_input_update();
		if($column_name == 'type'){
			$get_users_type = array('Administrator','American Key Supply','AutoProAPP Moderator','KeyLogic','Laser Key Products','LogiKey','WH Software','XTool');;
			foreach( $get_users_type as $key => $user_type){
			  if($results == $key){
				echo $user_type;
			  }
			}
		}else{
			echo $results;
		}
	}	

/*--------------------------------- Part Vehicle Section --------------------------------------*/
	
	public function selectPartsModels(){		
		$data['get_models'] = $this->admin_model->get_models();
		$data['makeId'] = $this->input->post('makeId');
		$this->load->view('admpro/selectPartsModels', $data);
	}
	
	public function select_parts_vehicles_years(){
		$data['get_vehicles'] = $this->admin_model->get_vehicles();	
		$data['modelId'] = $this->input->post('ModelId');	
		$this->load->view('admpro/get_parts_vehicles_years', $data);
	}	
	
	
/*--------------------- Vehicle Firebase Images ----------------------------------*/

	/*public function firebase_images(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){
			$data['subTitle'] = 'Firebae > <strong> Firebase Images</strong>';
					
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/firebase_images', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}*/
	
	public function show_chips_filter(){
		$value = $this->input->post('chip');
		$session_data = array('chips_filter_val' => $value);
		$this->session->set_userdata('chips_filter_session', $session_data);
		$data['sorting'] = 'DESC';
		$data['sorting_by'] = 'Chip_Name';				
		$data['getAllChips'] = $this->admin_model->show_chips_filter();
		$this->load->view('admpro/chips_sorting',$data);	
	}
	
	public function update_vehicle_info_test(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){			
			$data['subTitle'] = 'Firebase > <strong>Update Vehicle Info</strong>';	
			$data['all_makes'] = $this->admin_model->get_Firebase_AllMakes();			
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/update_vehicle_info_test', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}	
	}
	
	
	public function update_NissanBCM5(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){			
			$data['subTitle'] = 'Firebase > <strong>Update Vehicle Info</strong>';	
			$data['all_makes'] = $this->admin_model->get_Firebase_AllMakes();			
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/update_NissanBCM5', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}	
	}

	public function home_screen_menus(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){			
			$data['subTitle'] = '<strong>Home Screen Menus</strong>';
			$ezpages_location_val = "";
			if(isset($this->session->userdata['ezpages_location_session'])){
			 $value_key1 = $this->session->userdata['ezpages_location_session'];
			 $ezpages_location_val =  $value_key1['ezpages_location_val'];
			}
			$data['getAllManufacturer'] = $this->admin_model->getAllManufacturer();	
			$data['all_ez_pages'] = $this->admin_model->ez_pages($ezpages_location_val);			
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/ez_pages', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}	
	}

	public function add_ez_pages(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){
			$data['subTitle'] = 'EZ Pages';
			$data['getAllManufacturer'] = $this->admin_model->getAllManufacturer();
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/add_ez_pages', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}

	public function DeleteEZPages($id){
		$this->session->set_flashdata('message_display', 'Data deleted successfully');
		$result = $this->admin_model->DeleteEZPages($id);	
		redirect('admpro/home_screen_menus');		

	}

	public function save_ez_pages(){
		$this->form_validation->set_rules('Page_Name', 'Page_Name', 'required');						
		if ($this->form_validation->run() == FALSE){
              $this->session->set_flashdata('message_display', '<font color="#FF0000"><strong>'.validation_errors().'</strong></font>');
			  redirect('admpro/add_ez_pages');		
        }else{
			$query = $this->admin_model->save_ez_pages();
			$this->session->set_flashdata('message_display', 'Data added successfully');
			redirect('admpro/home_screen_menus');
		}	

	}

	public function edit_ez_pages($id){
		$data =array();
		if(isset($this->session->userdata['login_user'])){
			$data['subTitle'] = 'Home Screen Menus';
			$data['id'] = $id;
			$data['ez_page_info'] = $this->admin_model->ez_page_info($id);
			$data['getAllManufacturer'] = $this->admin_model->getAllManufacturer();
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/edit_ez_pages', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}

	public function update_ez_pages(){
		$this->session->set_flashdata('message_display', 'Data updated successfully');
		$result = $this->admin_model->update_ez_pages();	
		redirect('admpro/home_screen_menus');	

	}
	public function update_ez_pages_content(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){			
			$data['subTitle'] = 'Firebase > <strong>Update EZ Pages Content</strong>';	
			$data['all_ez_pages'] = $this->admin_model->ez_pages('all');			
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/update_ez_pages_content', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}	
	}

	public function update_keys(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){			
			$data['subTitle'] = 'Firebase > <strong>Update Keys</strong>';	
			$data['all_keys'] = $this->admin_model->getkeys();			
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/update_keys', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}

	public function filter_keysby_types(){
		$value = $this->input->post('location');
		$session_data = array('ezpages_location_val' => $value);
		$this->session->set_userdata('ezpages_location_session', $session_data);
		$data['sorting'] = 'DESC';
		$data['sorting_by'] = 'Sort_Order';				
		$data['all_ez_pages'] = $this->admin_model->filter_keysby_types($value);
		$this->load->view('admpro/filter_keysby_types',$data);
	}

	public function filter_ezpages_Manufacturer(){
		$value = $this->input->post('location');
		$data['sorting'] = 'DESC';
		$data['sorting_by'] = 'Sort_Order';				
		$data['all_ez_pages'] = $this->admin_model->filter_ezpages_Manufacturer($value);
		$this->load->view('admpro/filter_keysby_types',$data);	
	}

	public function data_sort_order(){
		$order = $this->input->post('order');
		$id = $this->input->post('id');				
		$data['all_ez_pages'] = $this->admin_model->data_sort_order($order,$id);	
	}

	public function addMoreLockType(){				
		$data['all_ez_pages'] = '';
		$this->load->view('admpro/add_more_lock_type',$data);	
	}

	public function select_page_types(){
		$data['page_type'] = $this->input->post('page_type');
		$this->load->view('admpro/select_page_types',$data);	
	}

	public function search_user_feedbacks(){
		$data['outputs1'] = $this->admin_model->search_user_feedbacks();				
		$this->load->view('admpro/search_feedbacks', $data);
	}


	public function search_aks_users(){
		$data['aks_results'] = $this->admin_model->search_aks_users();	
		$data['sorting'] = 'DESC';
		$data['sorting_by'] = 'FirstName';				
		$this->load->view('admpro/search_aks_users', $data);
	} 

	public function edit_user_feedback($id,$vid){
		$data =array();
		if(isset($this->session->userdata['login_user'])){			
			$data['subTitle'] = 'User Submissions';	
			$data['id'] = $id;
			$data['all_feedbacks'] = $this->admin_model->edit_user_feedback($id);			
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/edit_user_feedback', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}	
	}
	
	public function update_user_feedback(){
		$this->session->set_flashdata('message_display', 'Data updated successfully');
		$result = $this->admin_model->update_user_feedback();	
		redirect('admpro/user_submissions');	
	}	

	public function aks_users_sorting(){
		$data['aks_results'] = $this->admin_model->aks_users_sorting();
		$data['sorting'] = $this->input->post('sorting');
		$data['sorting_by'] = $this->input->post('sorting_by');	
		$this->load->view('admpro/search_aks_users', $data);		
	}

	public function users_feedbacks(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){			
			$data['subTitle'] = '<strong>User Feedback</strong>';	
			//$data['all_ez_pages'] = $this->admin_model->ez_pages($var);			
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/users_feedbacks', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}	
	}

	public function search_users_feedbacks(){
		$data['get_user_feedbacks'] = $this->admin_model->search_users_feedbacks();	
		$data['sorting'] = 'DESC';
		$data['sorting_by'] = 'FirstName';				
		$this->load->view('admpro/search_users_feedbacks', $data);	
	}

	public function delete_user_feedback($id,$vid){
		$this->session->set_flashdata('message_display', 'Data updated successfully');
		$result = $this->admin_model->delete_user_feedback($id);	
		redirect('admpro/user_submissions');	
	}

	public function show_feedback_by_type(){
		$data['outputs1'] = $this->admin_model->show_feedback_by_type();				
		$this->load->view('admpro/search_feedbacks', $data);
	}

	public function ezpages_sorting(){
		$ezpages_location_val = "";
		if(isset($this->session->userdata['ezpages_location_session'])){
		 $value_key1 = $this->session->userdata['ezpages_location_session'];
		 $ezpages_location_val =  $value_key1['ezpages_location_val'];
		}
		$data['all_ez_pages'] = $this->admin_model->ezpages_sorting($ezpages_location_val);
		$data['sorting'] = $this->input->post('sorting');
		$data['sorting_by'] = $this->input->post('sorting_by');	
		$this->load->view('admpro/filter_keysby_types', $data);		
	}

	public function search_keymaking_method(){
		$data['sorting'] = 'DESC';
		$data['sorting_by'] = 'Score';
		$data['results'] = $this->admin_model->vehicles_keymak_filter_data();				
		$this->load->view('admpro/search_keymaking_method', $data);
	}

	public function get_keymaking_methods_models(){
		$data['get_models'] = $this->admin_model->get_models();
		$data['makeId'] = $this->input->post('makeId');
		$data['modelId'] = $this->input->post('modelId');
		$data['type'] = $this->input->post('type');
		$type =  $this->input->post('type');
		$data['get_years'] = $this->admin_model->filter_vehicle_by_model();
		if($type == 'modal'){
			$data['results'] = $this->admin_model->search_keymaking_method_make();
		}else if($type =='years'){	
			$data['results'] = $this->admin_model->search_keymaking_method_model();
		}else{
			$data['results'] = $this->admin_model->search_keymaking_method_year();	
		}
		
		$this->load->view('admpro/get_keymaking_methods_models', $data);
	}

	public function keymaking_method_sorting(){
		$data['results'] = $this->admin_model->keymaking_method_sorting();
		$data['sorting'] = $this->input->post('sorting');
		$data['sorting_by'] = $this->input->post('sorting_by');	
		$this->load->view('admpro/search_keymaking_method', $data);		
	}

	public function keymakingMethod_score_order(){
		$order = $this->input->post('order');
		$id = $this->input->post('id');				
		$data['all_ez_pages'] = $this->admin_model->keymakingMethod_score_order($order,$id);	
	}

	public function firebase_update_remotes(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){			
			$data['subTitle'] = 'Firebase > <strong>Update Remote</strong>';	
			$data['all_remotes'] = $this->admin_model->sort_remote_by_date();			
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/firebase_update_remotes', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}	
	}

	public function firebase_update_keymakingMethod(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){			
			$data['subTitle'] = 'Firebase > <strong>Update Keymaking Method</strong>';	
			$data['results'] = $this->admin_model->get_methods();		
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/firebase_update_keymakingMethod', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}	
	}

	public function firebase_update_tipTricks(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){			
			$data['subTitle'] = 'Firebase > <strong>Update Tip & Tricks</strong>';	
			$data['results'] = $this->admin_model->get_tip_tricks();		
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/firebase_update_tipTricks', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}	
	}

	public function firebase_update_tools(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){			
			$data['subTitle'] = 'Firebase > <strong>Update Tools</strong>';	
			$data["results"] = $this->admin_model->getAllToolsInfo();
			$data['getAllToolType'] = $this->admin_model->getAllToolType();
			$data['getAllManufacturer'] = $this->admin_model->getAllManufacturer();	
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/firebase_update_tools', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}		
	}

/*------------------------------- Machine Report -------------------------*/
	
	public function success_reporting(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){			
			$data['subTitle'] = '<strong>Success Rates</strong>';
			$config = array();
			$config["base_url"] = base_url() . "admpro/success_reporting";
			$total_row = $this->admin_model->getAllMachineReportRows();
			
			$config["total_rows"] = $total_row;		
			if(isset($this->session->userdata['success_reporting_pagination'])){
				$per_page = $this->session->userdata['success_reporting_pagination']; 
				$config["per_page"] = $per_page['per_page'];
			}else{
				$config["per_page"] = 50;
			}				
			$config['use_page_numbers'] = TRUE;
			$config['num_links'] = $total_row;
			$config['cur_tag_open'] = '<a class="current">';
			$config['cur_tag_close'] = '</a>';
			$config['next_link'] = 'Next';
			$config['prev_link'] = 'Previous';		
			$this->pagination->initialize($config);
			if($this->uri->segment(3)){
				$page = ($this->uri->segment(3));
				$limt_start = ($page - 1)  * $config["per_page"];
			}else{
				$page = 1;
				$limt_start = 1;
			}
			$data["totalrows"] = $total_row;
			$data['page'] = $page;
			$_SESSION['keys_page_number'] = $page;
			$data["results"] = $this->admin_model->get_machine_reports($config["per_page"],$limt_start);									
			$str_links = $this->pagination->create_links();
			$data["links"] = explode('&nbsp;',$str_links );			
			$str_links = $this->pagination->create_links();
			$data["links"] = explode('&nbsp;',$str_links );	
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/machine_report', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	public function success_reporting_pagination(){		
		 $session_data = array('per_page' => $this->input->post('searching'));
		 $this->session->set_userdata('success_reporting_pagination', $session_data);
	}

	public function add_success_report(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){			
			$data['subTitle'] = '<strong>Success Rates</strong>';	
			$data["results"] = $this->admin_model->get_machine_report();
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/add_success_report', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}

	public function save_success_report(){
		$result = $this->admin_model->save_success_report();
		$this->session->set_flashdata('message_display', 'Data added successfully');	
		redirect('admpro/success_reporting');
	}
	
	public function delete_machine_report($id){
		$this->session->set_flashdata('message_display', 'Data deleted successfully');
		$result = $this->admin_model->delete_machine_report($id);	
		redirect('admpro/success_reporting');
	}

	public function search_machine_reports(){
		$data['sorting'] = 'DESC';
		$data['sorting_by'] = 'Score';
		$data['results'] = $this->admin_model->search_machine_reports();				
		$this->load->view('admpro/search_machine_reports', $data);	
	}

	public function filterMacineReport(){
		$data['sorting'] = 'DESC';
		$data['sorting_by'] = 'Score';
		$data['results'] = $this->admin_model->filterMacineReport();				
		$this->load->view('admpro/search_machine_reports', $data);	
	}

	public function update_aks_users_with_aks(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){			
			$data['subTitle'] = '<strong>Update Users With AKS</strong>';
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/update_aks_users_with_aks', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}	
	}

	public function aks_users_activity($id){
		$data =array();
		if(isset($this->session->userdata['login_user'])){			
			$data['subTitle'] = '<strong>User Activity</strong>';
			$data['aks_users_info'] = $this->admin_model->get_aks_users_info($id);
			$data['id'] = $id;
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/aks_users_activity', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}	
	}
/*--------------------------------- Export CSV ---------------------------------------------------------*/
	
	public function export_csv(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){			
			$data['subTitle'] = '<strong>Export CSV</strong>';
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/export_csv', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}	
	}

	public function explort_vehicles_info(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){			
			$data['subTitle'] = '<strong>Update Users With AKS</strong>';
			$data['getAllVehiclesDataCSV'] = $this->admin_model->getAllVehiclesDataCSV();
			$this->load->view('admpro/explort_vehicles_info', $data);
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}

	public function update_user_contribution(){
		$data['results'] = $this->admin_model->update_user_contribution();
		//$this->load->view('admpro/get_aksdev_customers',$data);	
	}

/*---------------------------------- Admin announcements ------------------------------------------------*/
	
	public function announcements(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){			
			$data['subTitle'] = 'Admin > <strong>Announcements</strong>';
			$data['announcements'] = $this->admin_model->get_admin_announcements();
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/admin_announcements', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}

	public function add_announcements(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){			
			$data['subTitle'] = 'Admin > <strong>Add Announcements</strong>';
			$user_data = $this->session->userdata['login_user'];
			$user_email = $user_data['email'];				
			$data['getUsersInfo'] = $this->admin_model->usersInInfo($user_email);
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/admin_add_announcements', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}	
	}

	public function save_admin_announcement(){
		$this->session->set_flashdata('message_display', 'Data added successfully');
		$result = $this->admin_model->save_admin_announcement();	
		redirect('admpro/add_announcements');		
	}

	public function edit_announcements($id){
		$data =array();
		if(isset($this->session->userdata['login_user'])){			
			$data['subTitle'] = 'Admin > <strong>Add Announcements</strong>';
			$user_data = $this->session->userdata['login_user'];
			$user_email = $user_data['email'];				
			$data['getUsersInfo'] = $this->admin_model->usersInInfo($user_email);
			$data['id'] = $id;
			$data['announcements_info'] = $this->admin_model->get_announcements_info($id);
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/edit_admin_announcements', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}	
	}

	public function update_admin_announcement(){
		$this->session->set_flashdata('message_display', 'Data updated successfully');
		$result = $this->admin_model->update_admin_announcement();	
		redirect('admpro/announcements');
	}

	public function delete_admin_announcement($id){
		$this->session->set_flashdata('message_display', 'Data deleted successfully');
		$result = $this->admin_model->delete_admin_announcement($id);	
		redirect('admpro/announcements');

	}

	public function filter_announcements_data(){
		$data['announcements'] = $this->admin_model->filter_announcements_data();
		$data['sorting'] = '';
		$data['sorting_by'] = '';	
		$this->load->view('admpro/filter_announcements_data', $data);	
	}

	public function firebase_update_announcements(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){			
			$data['subTitle'] = 'Firebase > <strong>Announcements</strong>';
			$data['announcements'] = $this->admin_model->get_admin_announcements();
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/firebase_update_announcements', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}

	public function change_activation(){
		$result = $this->admin_model->change_activation();
	}

/*----------------------------------- Admin Access Users Type ---------------------------------*/
	
	public function users_types(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){			
			$data['subTitle'] = 'Admin Access > <strong>User Types</strong>';
			$data['results'] = $this->admin_model->get_users_types();
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/users_types', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}

	public function add_user_type(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){			
			$data['subTitle'] = 'Admin Access > <strong>Add New User Type</strong>';
			$data['results'] = $this->admin_model->get_users_types();
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/add_user_type', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}

	public function check_user_types(){
		echo $data = $this->admin_model->check_user_types();
	}

	public function save_user_types(){
		$this->session->set_flashdata('message_display', 'Data added successfully');
		$result = $this->admin_model->save_user_types();	
		redirect('admpro/users_types');
	}

	public function edit_user_types($id){
		$data =array();
		if(isset($this->session->userdata['login_user'])){			
			$data['subTitle'] = 'Admin Access > <strong>Update User Type</strong>';
			$data['type_info'] = $this->admin_model->get_users_types_info($id);
			$data['id'] = $id;
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/edit_user_types', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}

	public function copy_user_types($id){
		$data =array();
		if(isset($this->session->userdata['login_user'])){			
			$data['subTitle'] = 'Admin Access > <strong>Update User Type</strong>';
			$data['type_info'] = $this->admin_model->get_users_types_info($id);
			$data['id'] = $id;
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/copy_user_types', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}

	public function update_user_types(){
		$this->session->set_flashdata('message_display', 'Data updated successfully');
		$result = $this->admin_model->update_user_types();	
		redirect('admpro/users_types');
	}
	public function delete_user_types($id){
		$this->session->set_flashdata('message_display', 'Data deleted successfully');
		$result = $this->admin_model->delete_user_types($id);	
		redirect('admpro/users_types');
	}

/*---------------------------- Avtars ----------------------*/
	
	public function avatars(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){			
			$data['subTitle'] = 'App Admin > <strong>Avatars</strong>';
			$data['results'] = $this->admin_model->avatars();
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/avatars', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}	

	public function add_avtars(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){			
			$data['subTitle'] = 'App Admin > <strong>Add Avatars</strong>';
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/add_avtars', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}

	public function save_avatars(){
		$this->session->set_flashdata('message_display', 'Data added successfully');
		$result = $this->admin_model->save_avatars();	
		redirect('admpro/add_avtars');	
	}

	public function delete_avtars($id){
		$this->session->set_flashdata('message_display', 'Data deleted successfully');
		$result = $this->admin_model->delete_avtars($id);	
		redirect('admpro/avatars');
	}

	public function firebase_update_avtars(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){			
			$data['subTitle'] = 'App Admin > <strong>Avatars</strong>';
			$data['results'] = $this->admin_model->avatars();
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/firebase_update_avatars', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}

	public function avatars_sort_order(){
		$order = $this->input->post('order');
		$id = $this->input->post('id');				
		$data['all_ez_pages'] = $this->admin_model->avatars_sort_order($order,$id);	
	}


	public function edit_all_inputs(){		
		$data['UUID'] = $this->input->post('uuId');
		$data['dataId'] = $this->input->post('dataId');
		$data['column'] = $this->input->post('column');
		$data['value'] = $this->input->post('value');
		$data['tableName'] = $this->input->post('tablename');
		$data['get_t_code_series'] = $this->admin_model->get_t_code_series();
		$this->load->view('admpro/edit_all_inputs',$data);	
	}

	public function all_input_update(){
		echo $results = $this->admin_model->all_input_update();
	}

/*--------------------------- code_conversion --------------------------------------*/

	public function code_series_list(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){			
			$data['subTitle'] = 'Code Conversions > <strong>Code Series List</strong>';
			$config = array();
			$config["base_url"] = base_url() . "admpro/code_series_list";
			$total_row = $this->admin_model->code_conversionRows();
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
			$data["results"] = $this->admin_model->code_conversionDetail($config["per_page"],$limt_start);
			$str_links = $this->pagination->create_links();	
			$data["links"] = explode('&nbsp;',$str_links );
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/code_conversion', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}

	public function edit_code_conversion($id){
		$data =array();
		if(isset($this->session->userdata['login_user'])){			
			$data['subTitle'] = 'Code Conversions > <strong>Code Series List</strong>';
			$data['results'] = $this->admin_model->code_conversion_info($id);
			$data['get_t_code_series'] = $this->admin_model->get_t_code_series();
			$data['id'] = $id;
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/edit_code_conversion', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}

	public function update_code_conversion(){
		$this->session->set_flashdata('message_display', 'Data updated successfully');
		$result = $this->admin_model->update_code_conversion();	
		redirect('admpro/code_series_list');
	}

	public function copy_code_conversion($id){
		$data =array();
		if(isset($this->session->userdata['login_user'])){			
			$data['subTitle'] = 'Code Conversions > <strong>Code Series List</strong>';
			$data['results'] = $this->admin_model->code_conversion_info($id);
			$data['get_t_code_series'] = $this->admin_model->get_t_code_series();
			$data['id'] = $id;
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/copy_code_conversion', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}

	public function save_code_conversion(){
		$this->session->set_flashdata('message_display', 'Data updated successfully');
		$result = $this->admin_model->save_code_conversion();	
		redirect('admpro/code_series_list');
	}

	public function convert_code(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){			
			$data['subTitle'] = 'Code Conversions > <strong>Convert Code</strong>';
			$data['results'] = $this->admin_model->code_conversion();
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/convert_code', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}

	public function search_code_list(){
		$data['results'] = $this->admin_model->search_code_list();
		$this->load->view('admpro/search_code_list',$data);
	}

	public function ls_connect(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){			
			$data['subTitle'] = 'Code Conversions > <strong>LS Connect Vehicles</strong>';
			$config = array();
			$config["base_url"] = base_url() . "admpro/ls_connect";
			$total_row = $this->admin_model->getAllLsConnectsRows();
			$config["total_rows"] = $total_row;
			if(isset($this->session->userdata['pagination_per_page2'])){
				$per_page = $this->session->userdata['pagination_per_page2']; 
				$config["per_page"] = $per_page['per_page'];
			}else{
				$config["per_page"] = 20;
			}
				
			$config['use_page_numbers'] = TRUE;
			$config['num_links'] = $total_row;
			$config['cur_tag_open'] = '<a class="current">';
			$config['cur_tag_close'] = '</a>';
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
			$data["totalrows"] = $this->admin_model->getAllLsConnectsRows();
			$data['page'] = $page;
			$data['results'] = $this->admin_model->get_ls_connect($config["per_page"],$limt_start);
			$str_links = $this->pagination->create_links();
			$data["links"] = explode('&nbsp;',$str_links );	
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/ls_connect', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}

	public function ls_complete(){
		$result = $this->admin_model->ls_complete();
	}

	public function machine_worked_status(){
		$result = $this->admin_model->machine_worked_status();
	}

	public function search_Ls_connect(){
		$data['results'] = $this->admin_model->search_Ls_connect();
		$this->load->view('admpro/search_Ls_connect',$data);
	}

	public function search_convert_code_list(){
		$data['search_key'] = trim($this->input->post('search_key'));
		$data['results'] = $this->admin_model->search_convert_code_list();
		$search_key = trim($this->input->post('search_key'));
		//echo $search_key_A = substr($search_key, 0, 2);
		$this->load->view('admpro/search_convert_code_list',$data);
	}

	public function autopro_app_updates(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){			
			$data['subTitle'] = 'App Admin > <strong>AutoProAPP Updates</strong>';
			$data['results'] = $this->admin_model->autopro_app_updates();
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/autopro_app_updates', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}

	public function add_autoproapp_version(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){			
			$data['subTitle'] = 'App Admin > <strong>Add AutoProAPP Updates</strong>';
			$data['results'] = $this->admin_model->autopro_app_updates();
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/add_autoproapp_version', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}

	public function save_autoproapp_version(){
		$allowed =  array('apk','jpg');
		$filename = $_FILES['Download_Path']['name'];
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		if(!in_array($ext,$allowed) ) {
		    echo '<div class="alert alert-info"><font color="red">File is not valid, please only upload .apk file</font>';
		}else{
			$target_path = "version_uploads/";
			$target_path = $target_path . basename( $_FILES['Download_Path']['name']);
			if (file_exists($target_path)) {
			    echo '<div class="alert alert-info"><font color="red">Sorry, file already exists.</font></div>';
			    $uploadOk = 0;
			}else{ 
				$new_file_name = $_FILES['Download_Path']['name'];
				$config = array(
				'upload_path' => "version_uploads/",
				'allowed_types' => "*",
				'overwrite' => TRUE,
				'max_size' => "2048000", 
				'file_name' => $new_file_name		
				);	
				$this->load->library('upload', $config);
				if($this->upload->do_upload('Download_Path')){
					$file_data = $this->upload->data();
					$file_name = $file_data['file_name'];				
				    $save_autoproapp_version= $this->admin_model->save_autoproapp_version($file_name);
				    if($save_autoproapp_version == 1){
				    	echo '<div class="alert alert-info">Data added successfully.</div>';
				    }
				    $versionCode = $this->input->post('version_code');
				    $updateMessage = $this->input->post('version_message');
				    $version_code =  array('url' => base_url().'version_uploads/'.$file_name,
					    				'versionCode'=>(int)$versionCode,
					    				'updateMessage'=>$updateMessage
					    			);
				    $json = json_encode($version_code, JSON_UNESCAPED_SLASHES);
				    $file = fopen('version_uploads/update.json','w');
				    fwrite($file, $json);
				    fclose($file);
				} else{
					echo '<div class="alert alert-info"><font color="red">There was an error uploading the file, please try again!</font></div>';
			    	//redirect('admpro/add_autoproapp_version');
				}
			}
		}
	}

	public function delete_autoproapp_vesrion($id){
		$vesrion_info = $this->admin_model->autoproapp_vesrion_info($id);
		$path = 'version_uploads/'.$vesrion_info[0]['Download_Path'];
		if (unlink($path)){
			$delete_autoproapp_vesrion = $this->admin_model->delete_autoproapp_vesrion($id);
			$this->session->set_flashdata('message_display', 'Data deleted successfully');
			redirect('admpro/autopro_app_updates');
		}else{
			$delete_autoproapp_vesrion = $this->admin_model->delete_autoproapp_vesrion($id);
			$this->session->set_flashdata('message_display', 'Data deleted successfully');
			redirect('admpro/autopro_app_updates');
		}		
	}

	public function getUserContribution(){
		$data = "";
		$this->load->view('admpro/getUserContribution', $data);
	}

	public function firebase_update_machines(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){			
			$data['subTitle'] = 'Firebase > <strong>Update Machines</strong>';
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/firebase_update_machines', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}

	}

	public function aks_products_excel(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){			
			$data['subTitle'] = 'AKS Products Excel';
			$this->load->view('admpro/aks_products_excel', $data);
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}

/*-------------------------- Get Firebase Updates -----------------------------*/
	public function get_firebase_updates(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){			
			$data['subTitle'] = 'Firebase > <strong>Updates</strong>';
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/get_firebase_updates', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}	

	public function firebase_feedback(){
		    $options['auth'] = 'PomxyBl1zWE3q6fUAlVL6BhpntIWGwFmD47NlWbe'; 
				$cSession1 = curl_init(); 				
				curl_setopt($cSession1,CURLOPT_URL,"https://autoproapp2017.firebaseio.com/feedbacks.json?". http_build_query($options));
				curl_setopt($cSession1, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));	
				curl_setopt($cSession1, CURLOPT_CUSTOMREQUEST, "GET");						
				curl_setopt($cSession1, CURLOPT_POSTFIELDS,''); 
				curl_setopt($cSession1,CURLOPT_RETURNTRANSFER,true);	
				curl_setopt($cSession1, CURLOPT_SSL_VERIFYPEER, false);		 
				$result_output1 = curl_exec($cSession1);			 
				curl_error($cSession1);			  						
				$outputs1 = json_decode($result_output1, true);
				foreach ($outputs1 as $key => $value) {	
					$uuid = $key;
					$email =  $value['email'].'--';
					$feedback =  $value['feedback'];
					$firstName =  $value['firstName'];
					$lastName =  $value['lastName'];
					$subject =  $value['subject'];
					$imageURL = '';
					foreach ($value['attachments'] as $key1 => $value1) {
						$imageURL .=  $value1.',';
					}
					$imageURL = rtrim($imageURL,',');
					if( isset($value['status']) && $value['status'] != ""){
						$status = $value['status'];
					}else{
						$status = 'pending';
					}
					$userid = $value['userid'];
					$add_user_feedback = add_user_feedback($uuid,$email,$feedback,$firstName,$lastName,$subject,$imageURL,$status,$userid);
				}
				$this->session->set_flashdata('message_display', 'Firebase Data updated successfully');
			  redirect('admpro/get_firebase_updates');
	}

	public function firebase_contribution(){
				$options['auth'] = 'PomxyBl1zWE3q6fUAlVL6BhpntIWGwFmD47NlWbe'; 
				$cSession1 = curl_init(); 				
				curl_setopt($cSession1,CURLOPT_URL,"https://autoproapp2017.firebaseio.com/submitted_feedback.json?". http_build_query($options));
				curl_setopt($cSession1, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));	
				curl_setopt($cSession1, CURLOPT_CUSTOMREQUEST, "GET");						
				curl_setopt($cSession1, CURLOPT_POSTFIELDS,''); 
				curl_setopt($cSession1,CURLOPT_RETURNTRANSFER,true);	
				curl_setopt($cSession1, CURLOPT_SSL_VERIFYPEER, false);		 
				$result_output1 = curl_exec($cSession1);			 
				curl_error($cSession1);			  						
				$outputs1 = json_decode($result_output1, true);
				foreach($outputs1 as $key => $value){
					//echo $key .'=>'. $value.'<br>';
					foreach($value as $key1 => $value1){
						$type = $key1;
						foreach($value1 as $image_key => $image_value){
							//echo $image_value['approved'].'<br>';
							  if( $image_value['status']=='approved' ){
								  $disabled = '';
								  $Status = 'approved';
								  $rejected_hide = '';
								  $approved_hide = 'approved hide';
								  $pending_hide = '';
							  }else if( $image_value['status']=='rejected'){
								  $disabled = '';
								  $Status = 'rejected';
								  $rejected_hide = 'rejected_hide hide';
								  $approved_hide = '';
								  $pending_hide = '';
							  }else{
								  $disabled = '';
								  $Status = 'pending';
								  $rejected_hide = '';
								  $approved_hide = '';
								  $pending_hide = 'pending'; 
							  } 
							  $date = $image_value['date'];
							  $UUID = $image_key;
							  $VehicleID = $image_value['vehicleID'];
							  //$key = $VehicleID;
							  $User_Email = $image_value['userID'];
							  $User_Name = '';
							  $User_Type = '';
							  $Vehicle_UUID = $image_value['vehicleName'];
							  $Feedback_type = $type;
							  $User_Review = '';							  
							  $User_UUID = '';
							  $vehcile_info = $image_value['vehicleName']; 
							  //echo '<br>';
							  $imagepaths = "";
							  if (isset($image_value['imagepaths']) && $image_value['imagepaths'] != "") {
							  	$Image_path_data = $image_value['imagepaths'];
							  	foreach ($Image_path_data as $key => $images) {
								  	$imagepaths .= $images.',';
								  }
								  $full_path = rtrim($imagepaths,',');
							  }else if (isset($image_value['imagePaths']) && $image_value['imagePaths'] != "") {
							  	$Image_path_data = $image_value['imagePaths'];
							  	foreach ($Image_path_data as $key => $images) {
								  	$imagepaths .= $images.',';
								  }
								  $full_path = rtrim($imagepaths,',');
							  }else{
								  $Image_path_data = explode(',',$image_value['imagePath']);
								  foreach ($Image_path_data as $key => $images) {
								  	$imagepaths .= $images.',';
								  }
								  $full_path = rtrim($imagepaths,',');
							  }
							  //echo $full_path.'<br>';
							  $Title = $image_value['title'];
							  $videospaths = "";
							  $video_path_data = $image_value['video'];
						  	  foreach ($video_path_data as $key => $videos) {
							  	$videospaths .= $videos.',';
							  }
							  $video = rtrim($videospaths,',');;
							  $CorrectionID = '';
							  $other_vehicle = $image_value['otherVehicles'];
							  if($Feedback_type == 'key_making'){
								  $content = $image_value['content'];
							  }else{
							  	  $content = $image_value['content'];
							  }
							  $category = $image_value['category'];
							  if( isset($image_value['range']) && $image_value['range'] != ""){
							  	$year_range = $image_value['range'];
							  }else{
							  	$year_range = $image_value['yearRange'];
							  }
							  
							  //$save_vehicle_images = save_vehicle_images($UUID,$VehicleID,$Image_path,$Title,$Status,$CorrectionID);
							  if($Feedback_type == 'vehicle_tips_tricks' || $Feedback_type == 'key_making'){
							  	$likes = 0; 
								$dislikes = 0; 
								$info = '';
								$save_app_corrections2 = save_app_corrections2($UUID,$User_Email,$User_Name,$User_Type,$Feedback_type,$Status,$User_UUID,$likes,$dislikes,$info, $full_path,$Title,$other_vehicle,$content,$VehicleID,$Vehicle_UUID,$date,$category,$video,$year_range);
							  }else{
							  	$save_app_corrections = save_app_corrections($UUID,$User_Email,$User_Name,$User_Type,$Vehicle_UUID,$Feedback_type,$Status,$User_Review,$full_path,$User_UUID,$vehcile_info,$Title,$other_vehicle,$content,$VehicleID,$date,$category,$video,$year_range);
							  }
						 }
						 $saved = 1;
					}
				}
			$this->session->set_flashdata('message_display', 'Firebase Data updated successfully');
			redirect('admpro/get_firebase_updates');
	}

	public function firebase_success_rate(){
		if( isset($this->session->userdata['success_reporting_pagination'])){
			$per_page1 = $this->session->userdata['success_reporting_pagination'];
			$per_page = $per_page1['per_page'];
		}else{
			$per_page = "";
		}
		$options['auth'] = 'PomxyBl1zWE3q6fUAlVL6BhpntIWGwFmD47NlWbe'; 
		$cSession1 = curl_init();         
		curl_setopt($cSession1,CURLOPT_URL,"https://autoproapp2017.firebaseio.com/keyprogramming_ratings.json?". http_build_query($options));
		curl_setopt($cSession1, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
		curl_setopt($cSession1, CURLOPT_CUSTOMREQUEST, "GET");            
		curl_setopt($cSession1, CURLOPT_POSTFIELDS,''); 
		curl_setopt($cSession1,CURLOPT_RETURNTRANSFER,true);  
		curl_setopt($cSession1, CURLOPT_SSL_VERIFYPEER, false);    
		$result_output1 = curl_exec($cSession1);       
		curl_error($cSession1);                   
		$outputs1 = json_decode($result_output1, true);
		foreach ($outputs1 as $key => $value) {            
			foreach ($value as $key1 => $value1) {
				//echo $key1 .'--'. $value1.'<br>';
				foreach ($value1 as $key2 => $value2) {
					$uuid = $value2['key'];
					$comment =  $value2['comment'];
					$programmer =  $value2['programmer'];
					if($value2['result'] == 'working' || $value2['result'] == 'Yes' || $value2['result'] == 'yes'){
						$result =  'Yes';
					}else{
						$result =  'No';
					}                
					$time =  $value2['time'];
					$userID =  $value2['userID'];
					$userName =  $value2['userName'];
					$vehicleID =  $value2['vehicleID'];
					$add_success_rating = add_success_rating($uuid,$comment,$programmer,$result,$time,$userID,$userName,$vehicleID);
				}
			}
		}
		$this->session->set_flashdata('message_display', 'Firebase Data updated successfully');
		redirect('admpro/get_firebase_updates');
}

	
}
?>