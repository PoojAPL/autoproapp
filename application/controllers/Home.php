<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url' ,'utility_helper','user_helper'));
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('admpro/admin_model');
		$this->load->model('home_model');
	}
	public function index()	{
		$data = "";
		$this->load->view('layout/header', $data);
		$this->load->view('index');
		$this->load->view('layout/footer', $data);
	}
	public function privacy(){		
	  $data['subTitle'] = 'AutoProPAD > <strong>Add Feedback</strong>';
	  $this->load->view('layout/header', $data);
	  $this->load->view('privacy', $data);
	  $this->load->view('layout/footer', $data);
	}
		
	/*public function feedback(){		
	  $data['subTitle'] = 'AutoProPAD > <strong>Add Feedback</strong>';
	  if(isset($_COOKIE['Phone_By_cookie'])){ 
		 $Phone_cookie_value = $_COOKIE['Phone_By_cookie'];
	  }else{
		$Phone_cookie_value = ""; 
	  }
	  $data['get_users_feedback'] = $this->home_model->get_users_feedback($Phone_cookie_value);
	  $this->load->view('layout/header', $data);
	  $this->load->view('users_feedback', $data);
	  $this->load->view('layout/footer', $data);
	}
	
	public function save_feedback(){
		$this->form_validation->set_rules('Vehicle', 'Vehicle', 'required');
		$this->form_validation->set_rules('Phone', 'Phone', 'required');						
		if ($this->form_validation->run() == FALSE){
              $this->session->set_flashdata('message_display', '<font color="#FF0000"><strong>'.validation_errors().'</strong></font>');
			  redirect('feedback');		
        }else{
			$cookies_values = $this->input->post('Submitted_By'); 
			$cookie_name = "Submitted_By_cookie"; 
			setcookie($cookie_name, $cookies_values, time() + (86400 * 30), "/");
			
			$cookies_values1 = $this->input->post('Phone'); 
			$cookie_name1 = "Phone_By_cookie"; 
			setcookie($cookie_name1, $cookies_values1, time() + (86400 * 30), "/");	
					
			$query = $this->home_model->save_feedback();
			$this->session->set_flashdata('message_display', 'YOUR FEEDBACK WAS ACCEPTED. Thank you for helping us improve the XTOOL programming machines. Your feedback is essential to making these products better for everyone.');
			redirect('feedback');
		}
	}
	public function edit_feedback($id){		
	 $data['id'] = $id;
	  if(isset($_COOKIE['Phone_By_cookie'])){ 
		 $Phone_cookie_value = $_COOKIE['Phone_By_cookie'];
	  }else{
		$Phone_cookie_value = ""; 
	  }
	  $data['users_feedback_info'] = $this->home_model->get_users_feedback_info($id);
	  $this->load->view('layout/header', $data);
	  $this->load->view('edit_feedback', $data);
	  $this->load->view('layout/footer', $data);
	}
	
	public function update_feedback(){
	$this->form_validation->set_rules('Vehicle', 'Vehicle', 'required');
		$this->form_validation->set_rules('Phone', 'Phone', 'required');						
		if ($this->form_validation->run() == FALSE){
              $this->session->set_flashdata('message_display', '<font color="#FF0000"><strong>'.validation_errors().'</strong></font>');
			  redirect('feedback');		
        }else{
			$cookies_values = $this->input->post('Submitted_By'); 
			$cookie_name = "Submitted_By_cookie"; 
			setcookie($cookie_name, $cookies_values, time() + (86400 * 30), "/");
			
			$cookies_values1 = $this->input->post('Phone'); 
			$cookie_name1 = "Phone_By_cookie"; 
			setcookie($cookie_name1, $cookies_values1, time() + (86400 * 30), "/");	
					
			$query = $this->home_model->update_feedback();
			$this->session->set_flashdata('message_display', 'Your feedback updated successfully.');
			redirect('feedback');
		}
	}*/

	public function android(){
		header('location: http://autoproapp.com/version_uploads/AutoProAPP-0.6.55.apk');
	}

}
