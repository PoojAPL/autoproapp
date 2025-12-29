<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Autopropad extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url' ,'utility_helper','user_helper'));
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('admpro/admin_model');
		$this->load->library('pagination');
	}
	public function feedback(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){
		    $data['subTitle'] = 'AutoProPAD > <strong>Feedback</strong>';
			$config = array();
			$config["base_url"] = base_url() . "admpro/autopropad/feedback";
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
			if($this->uri->segment(4)){
				$page = ($this->uri->segment(4));
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
	
	public function announcements(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){
		    $data['subTitle'] = 'AutoProPAD > <strong>Announcements</strong>';
			$config = array();
			$config["base_url"] = base_url() . "admpro/autopropad/announcements";
			$total_row = $this->admin_model->get_announcements_rows();
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
			if($this->uri->segment(4)){
				$page = ($this->uri->segment(4));
				$limt_start = ($page - 1)  * $config["per_page"];
			}else{
				$page = 1;
				$limt_start = 0;
			}
			$data["totalrows"] = $this->admin_model->get_announcements_rows();
			$data['page'] = $page;
			$data["results"] = $this->admin_model->get_announcements($config["per_page"],$limt_start);
			$str_links = $this->pagination->create_links();
			$data["links"] = explode('&nbsp;',$str_links );					
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/announcements', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}	
		
	}
	
	public function add_announcement(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){
			$data['subTitle'] = 'AutoProPAD > <strong> Add Announcement</strong>';
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/add_announcement', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	public function save_announcement(){
		$this->form_validation->set_rules('description', 'Description', 'required');						
		if ($this->form_validation->run() == FALSE){
              $this->session->set_flashdata('message_display', '<font color="#FF0000"><strong>'.validation_errors().'</strong></font>');
			  redirect('admpro/autopropad/add_announcement');		
        }else{
			$query = $this->admin_model->save_announcement();
			$this->session->set_flashdata('message_display', 'Data added successfully');
			redirect('admpro/autopropad/add_announcement');		
		}
	}	
	
	public function delete_annoucement($id){
		$result = $this->admin_model->delete_annoucement($id);	
		$this->session->set_flashdata('message_display', 'Data deleted successfully');
		redirect('admpro/autopropad/announcements');	
	}
	
	public function edit_announcements_input(){		
		$data['UUID'] = $this->input->post('uuId');
		$data['dataId'] = $this->input->post('dataId');
		$data['column'] = $this->input->post('column');
		$data['value'] = $this->input->post('value');
		$this->load->view('admpro/edit_announcements_input',$data);	
	}
	public function annouce_input_update(){
		echo $results = $this->admin_model->annouce_input_update();
	}
	
	/*------------------------------Applications Section ---------------------------------------------*/
	
	public function applications(){		
		$data =array();
		if(isset($this->session->userdata['login_user'])){
		    $data['subTitle'] = 'AutoProPAD > <strong>Applications</strong>';
			$config = array();
			$config["base_url"] = base_url() . "admpro/autopropad/applications";
			$total_row = $this->admin_model->get_applications_rows();
			$config["total_rows"] = $total_row;
			//$data['getAllMakeNames'] = $this->admin_model->getAllToolsRows();
			if(isset($this->session->userdata['remotes_pagination'])){
				$per_page = $this->session->userdata['remotes_pagination']; 
				$config["per_page"] = $per_page['per_page'];
			}else{
				$config["per_page"] = 100;
			}
				
			$config['use_page_numbers'] = TRUE;
			$config['num_links'] = $total_row;
			$config['cur_tag_open'] = '<a class="current">';
			$config['cur_tag_close'] = '</a>';
			$config['next_link'] = 'Next';
			$config['prev_link'] = 'Previous';		
			$this->pagination->initialize($config);
			if($this->uri->segment(4)){
				$page = ($this->uri->segment(4));
				$limt_start = ($page - 1)  * $config["per_page"];
			}else{
				$page = 1;
				$limt_start = 0;
			}
			$data["totalrows"] = $this->admin_model->get_applications_rows();
			$data['page'] = $page;
			if(isset($this->session->userdata['application_sorting_sess'])){
				 $session_data = $this->session->userdata('application_sorting_sess');
				 $application_sorting = $session_data['application_sorting'];
				 $application_order = $session_data['application_order'];
				 $data["results"] = $this->admin_model->get_application_by_sorting($config["per_page"],$limt_start,$application_sorting,$application_order);
			}else{
				$data["results"] = $this->admin_model->get_applications($config["per_page"],$limt_start);
			}
			$data["getAllMakeNames"] = $this->admin_model->getAllMakeNames();
			$str_links = $this->pagination->create_links();
			$data["links"] = explode('&nbsp;',$str_links );					
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/applications', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}	
	}
	
	public function edit_application_cols(){		
		$data['UUID'] = $this->input->post('uuId');
		$data['dataId'] = $this->input->post('dataId');
		$data['column'] = $this->input->post('column');
		$data['value'] = $this->input->post('value');
		$this->load->view('admpro/edit_application_cols',$data);	
	}
	
	public function application_input_update(){
		echo $results = $this->admin_model->application_input_update();
	}
	
	public function add_applications(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){
			$data['subTitle'] = 'AutoProPAD > <strong> Add Application</strong>';
			$data["getAllMakeNames"] = $this->admin_model->getAllMakeNames();	
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/add_applications', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	public function save_applications(){
		$this->form_validation->set_rules('Make', 'Make', 'required');	
		$this->form_validation->set_rules('Model_UUID', 'Model', 'required');	
		$this->form_validation->set_rules('Year', 'Year', 'required');						
		if ($this->form_validation->run() == FALSE){
              $this->session->set_flashdata('message_display', '<font color="#FF0000"><strong>'.validation_errors().'</strong></font>');
			  redirect('admpro/autopropad/add_applications');		
        }else{
			$query = $this->admin_model->save_applications();
			$this->session->set_flashdata('message_display', 'Data added successfully');
			redirect('admpro/autopropad/add_applications');		
		}
	}
	
	public function edit_application($id){
		$data =array();
		if(isset($this->session->userdata['login_user'])){
			$data['subTitle'] = 'AutoProPAD > <strong> Add Application</strong>';
			$data['id'] = $id;
			$data["getAllMakeNames"] = $this->admin_model->getAllMakeNames();
			$data['get_applications_info'] = $this->admin_model->get_applications_info($id);	
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/edit_application', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	public function copy_application($id){
		$data =array();
		if(isset($this->session->userdata['login_user'])){
			$data['subTitle'] = 'AutoProPAD > <strong> Add Application</strong>';
			$data['id'] = $id;
			$data["getAllMakeNames"] = $this->admin_model->getAllMakeNames();
			$data['get_applications_info'] = $this->admin_model->get_applications_info($id);	
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/copy_application', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	
	public function update_applications(){
		$this->form_validation->set_rules('Make', 'Make', 'required');	
		$this->form_validation->set_rules('Model_UUID', 'Model', 'required');	
		$this->form_validation->set_rules('Year', 'Year', 'required');						
		if ($this->form_validation->run() == FALSE){
              $this->session->set_flashdata('message_display', '<font color="#FF0000"><strong>'.validation_errors().'</strong></font>');
			  redirect('admpro/autopropad/applications');		
        }else{
			$query = $this->admin_model->update_applications();
			$this->session->set_flashdata('message_display', 'Data updated successfully');
			redirect('admpro/autopropad/applications');		
		}
	}
	
	public function delete_application($id){
		$result = $this->admin_model->delete_application($id);	
		$this->session->set_flashdata('message_display', 'Data deleted successfully');
		redirect('admpro/autopropad/applications');	
	}
	
	public function applications_sorting(){
		$config = array();
		$config["base_url"] = base_url() . "admpro/autopropad/applications";
		$total_row = $this->admin_model->get_applications_rows();
		$config["total_rows"] = $total_row;
		//$data['getAllMakeNames'] = $this->admin_model->getAllToolsRows();
		if(isset($this->session->userdata['remotes_pagination'])){
			$per_page = $this->session->userdata['remotes_pagination']; 
			$config["per_page"] = $per_page['per_page'];
		}else{
			$config["per_page"] = 100;
		}			
		$config['use_page_numbers'] = TRUE;
		$config['num_links'] = $total_row;
		$config['cur_tag_open'] = '<a class="current">';
		$config['cur_tag_close'] = '</a>';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';		
		$this->pagination->initialize($config);
		$str_links = $this->pagination->create_links();
		$data["links"] = explode('&nbsp;',$str_links );	
		$session_data = array('application_sorting' => $this->input->post('sorting_by'),'application_order' => $this->input->post('sorting'));
		$this->session->set_userdata('application_sorting_sess', $session_data);
		$data['sorting'] = $this->input->post('sorting');
		$data['sorting_by'] = $this->input->post('sorting_by');	
		$data['results'] = $this->admin_model->application_sorting();
		$this->load->view('admpro/applications_sorting',$data);	
	}
	
	public function filterApplicationByMake(){	
		$data["links"] = '';		
		$data['sorting'] = '';
		$data['sorting_by'] = '';		
		$data['results'] = $this->admin_model->filterApplicationByMake();
		$this->load->view('admpro/applications_sorting',$data);	
	}
	
	public function searchApplication(){
		$data["links"] = '';		
		$data['sorting'] = '';
		$data['sorting_by'] = '';		
		$data['results'] = $this->admin_model->searchApplication();
		$this->load->view('admpro/applications_sorting',$data);	
	}

/*------------------ testimonials ------------------------------*/
	
	public function testimonials(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){
		    $data['subTitle'] = 'AutoProPAD > <strong>Testimonials</strong>';
			$config = array();
			$config["base_url"] = base_url() . "admpro/autopropad/testimonials";
			$total_row = $this->admin_model->get_testimonials_rows();
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
			if($this->uri->segment(4)){
				$page = ($this->uri->segment(4));
				$limt_start = ($page - 1)  * $config["per_page"];
			}else{
				$page = 1;
				$limt_start = 0;
			}
			$data["totalrows"] = $this->admin_model->get_testimonials_rows();
			$data['page'] = $page;
			$data["results"] = $this->admin_model->get_testimonials($config["per_page"],$limt_start);
			$str_links = $this->pagination->create_links();
			$data["links"] = explode('&nbsp;',$str_links );					
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/testimonials', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}

	public function add_testimonials(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){
			$data['subTitle'] = 'AutoProPAD > <strong> Add Testimonials</strong>';
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/add_testimonials', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}

	public function save_testimonials(){
		$this->form_validation->set_rules('testimonial', 'Testimonial', 'required');						
		if ($this->form_validation->run() == FALSE){
              $this->session->set_flashdata('message_display', '<font color="#FF0000"><strong>'.validation_errors().'</strong></font>');
			  redirect('admpro/autopropad/add_testimonials');		
        }else{
			$query = $this->admin_model->save_testimonials();
			$this->session->set_flashdata('message_display', 'Data added successfully');
			redirect('admpro/autopropad/testimonials');		
		}
	}

	public function edit_testimonials($id){
		$data =array();
		if(isset($this->session->userdata['login_user'])){
			$data['id'] = $id;
			$data["testimonials_info"] = $this->admin_model->testimonials_info($id);
			$data['subTitle'] = 'AutoProPAD > <strong> Update Testimonials</strong>';
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/edit_testimonials', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}

	public function update_testimonials(){
		$query = $this->admin_model->update_testimonials();
		$this->session->set_flashdata('message_display', 'Data updated successfully');
		redirect('admpro/autopropad/testimonials');
	}

	public function delete_testimonials($id){
		$result = $this->admin_model->delete_testimonials($id);	
		$this->session->set_flashdata('message_display', 'Data deleted successfully');
		redirect('admpro/autopropad/testimonials');
	}

	public function testimonials_sort_order(){
		$order = $this->input->post('order');
		$id = $this->input->post('id');				
		$data['all_ez_pages'] = $this->admin_model->testimonials_sort_order($order,$id);	
	}

/*------------------------ Videos ---------------------------*/
	public function videos(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){
		    $data['subTitle'] = 'AutoProPAD > <strong>Videos</strong>';
			$config = array();
			$config["base_url"] = base_url() . "admpro/autopropad/videos";
			$total_row = $this->admin_model->get_videos_rows();
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
			if($this->uri->segment(4)){
				$page = ($this->uri->segment(4));
				$limt_start = ($page - 1)  * $config["per_page"];
			}else{
				$page = 1;
				$limt_start = 0;
			}
			$data["totalrows"] = $this->admin_model->get_videos_rows();
			$data['page'] = $page;
			$data["results"] = $this->admin_model->get_videos($config["per_page"],$limt_start);
			$str_links = $this->pagination->create_links();
			$data["links"] = explode('&nbsp;',$str_links );					
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/videos_autopropad', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}

	public function add_video(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){
			$data['subTitle'] = 'AutoProPAD > <strong> Add Video</strong>';
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/add_video', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}

	public function save_videos(){
		$query = $this->admin_model->save_videos();
		$this->session->set_flashdata('message_display', 'Data added successfully');
		redirect('admpro/autopropad/videos');
	}

	public function edit_videos($id){
		$data =array();
		if(isset($this->session->userdata['login_user'])){
			$data['id'] = $id;
			$data["videos_info"] = $this->admin_model->videos_info($id);
			$data['subTitle'] = 'AutoProPAD > <strong> Update Videos</strong>';
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/edit_videos', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}

	public function update_videos(){
		$query = $this->admin_model->update_videos();
		$this->session->set_flashdata('message_display', 'Data updated successfully');
		redirect('admpro/autopropad/videos');
	}

	public function delete_videos($id){
		$result = $this->admin_model->delete_videos($id);	
		$this->session->set_flashdata('message_display', 'Data deleted successfully');
		redirect('admpro/autopropad/videos');
	}

/*---------------------------- FAQs ------------------------------------*/
	
	public function faqs(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){
		    $data['subTitle'] = 'AutoProPAD > <strong>FAQs</strong>';
			$config = array();
			$config["base_url"] = base_url() . "admpro/autopropad/faqs";
			$total_row = $this->admin_model->get_faqs_rows();
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
			if($this->uri->segment(4)){
				$page = ($this->uri->segment(4));
				$limt_start = ($page - 1)  * $config["per_page"];
			}else{
				$page = 1;
				$limt_start = 0;
			}
			$data["totalrows"] = $this->admin_model->get_faqs_rows();
			$data['page'] = $page;
			$data["results"] = $this->admin_model->get_faqs($config["per_page"],$limt_start);
			$str_links = $this->pagination->create_links();
			$data["links"] = explode('&nbsp;',$str_links );					
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/faqs_autopropad', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}

	public function add_faqs(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){
			$data['subTitle'] = 'AutoProPAD > <strong> Add FAQ</strong>';
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/add_faqs', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}	

	public function save_faqs(){
		$query = $this->admin_model->save_faqs();
		$this->session->set_flashdata('message_display', 'Data added successfully');
		redirect('admpro/autopropad/faqs');
	}
	public function edit_faqs($id){
		$data =array();
		if(isset($this->session->userdata['login_user'])){
			$data['id'] = $id;
			$data["faqs_info"] = $this->admin_model->faqs_info($id);
			$data['subTitle'] = 'AutoProPAD > <strong> Update FAQ</strong>';
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/edit_faqs', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}

	public function update_faqs(){
		$query = $this->admin_model->update_faqs();
		$this->session->set_flashdata('message_display', 'Data updated successfully');
		redirect('admpro/autopropad/faqs');
	}

	public function delete_faqs($id){
		$result = $this->admin_model->delete_faqs($id);	
		$this->session->set_flashdata('message_display', 'Data deleted successfully');
		redirect('admpro/autopropad/faqs');
	}

/*---------------------------- Distributors ------------------------------------*/
	
	public function distributors(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){
		    $data['subTitle'] = 'AutoProPAD > <strong>Distributors</strong>';
			$config = array();
			$config["base_url"] = base_url() . "admpro/autopropad/distributors";
			$total_row = $this->admin_model->get_distributors_rows();
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
			if($this->uri->segment(4)){
				$page = ($this->uri->segment(4));
				$limt_start = ($page - 1)  * $config["per_page"];
			}else{
				$page = 1;
				$limt_start = 0;
			}
			$data["totalrows"] = $this->admin_model->get_distributors_rows();
			$data['page'] = $page;
			$data["results"] = $this->admin_model->get_distributors($config["per_page"],$limt_start);
			$str_links = $this->pagination->create_links();
			$data["links"] = explode('&nbsp;',$str_links );					
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/distributors', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}

	public function add_distributors(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){
			$data['subTitle'] = 'AutoProPAD > <strong> Add Distributors</strong>';
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/add_distributors', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}	

	public function save_distributors(){
		$imagePath = '';
		$target_dir = "assets/distributor/";		
		if(isset($_FILES["imagePath"]["name"]) && $_FILES["imagePath"]["name"] !="") {
			$target_file = $target_dir . basename($_FILES["imagePath"]["name"]);
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			$check = getimagesize($_FILES["imagePath"]["tmp_name"]);
			if($check !== false) {					
				$uploadOk = 1;
			} else {
				$uploadOk = 0;
			}	
			if ($uploadOk == 0) {
				$err_msg =  "Sorry, your file was not uploaded.";
			} else {
				if (move_uploaded_file($_FILES["imagePath"]["tmp_name"], $target_file)) {
					$err_msg =  "The file ". basename( $_FILES["imagePath"]["name"]). " has been uploaded.";
				} else {
					$err_msg =  "Sorry, there was an error uploading your file.";
				}
			}
			if($imageFileType != ""){
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
					$err_msg =  'Sorry, only JPG, JPEG, PNG & GIF files are allowed.';
					$uploadOk = 0;
				}
			}			
			if($uploadOk == 0){
				$this->session->set_flashdata('message_display', $err_msg);
			}else{
				$imagePath = $_FILES["imagePath"]["name"];
				$query = $this->admin_model->save_distributors($imagePath);
				$this->session->set_flashdata('message_display', 'Data added successfully');
			}
		}else{
			$query = $this->admin_model->save_distributors($imagePath);
			$this->session->set_flashdata('message_display', 'Data added successfully');
		}		
		redirect('admpro/autopropad/distributors');
	}
	public function edit_distributors($id){
		$data =array();
		if(isset($this->session->userdata['login_user'])){
			$data['id'] = $id;
			$data["distributors_info"] = $this->admin_model->distributors_info($id);
			$data['subTitle'] = 'AutoProPAD > <strong> Update Distributors</strong>';
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/edit_distributors', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}

	public function update_distributors(){
		$imagePath = '';
		$target_dir = "assets/distributor/";		
		if(isset($_FILES["imagePath"]["name"]) && $_FILES["imagePath"]["name"] !="") {
			$target_file = $target_dir . basename($_FILES["imagePath"]["name"]);
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			$check = getimagesize($_FILES["imagePath"]["tmp_name"]);
			if($check !== false) {					
				$uploadOk = 1;
			} else {
				$uploadOk = 0;
			}	
			if ($uploadOk == 0) {
				$err_msg =  "Sorry, your file was not uploaded.";
			} else {
				if (move_uploaded_file($_FILES["imagePath"]["tmp_name"], $target_file)) {
					$err_msg =  "The file ". basename( $_FILES["imagePath"]["name"]). " has been uploaded.";
				} else {
					$err_msg =  "Sorry, there was an error uploading your file.";
				}
			}
			if($imageFileType != ""){
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
					$err_msg =  'Sorry, only JPG, JPEG, PNG & GIF files are allowed.<a href="'.zen_href_link(FILENAME_DISTRIBUTOR_TOOLS).'">Back</a>';
					$uploadOk = 0;
				}
			}			
			if($uploadOk == 0){
				$this->session->set_flashdata('message_display', $err_msg);
			}else{
				$imagePath = $_FILES["imagePath"]["name"];
				$query = $this->admin_model->update_distributors($imagePath);
				$this->session->set_flashdata('message_display', 'Data added successfully');
			}
		}else{
			$query = $this->admin_model->update_distributors($imagePath);
			$this->session->set_flashdata('message_display', 'Data added successfully');
		}
		$this->session->set_flashdata('message_display', 'Data updated successfully');
		redirect('admpro/autopropad/distributors');
	}

	public function delete_distributors($id){
		$result = $this->admin_model->delete_distributors($id);	
		$this->session->set_flashdata('message_display', 'Data deleted successfully');
		redirect('admpro/autopropad/distributors');
	}

	public function show_on_autopad(){
		$result = $this->admin_model->show_on_autopad();	
	}

/*---------------------------- Home Page Content ------------------------------------*/
	
	public function content(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){
		    $data['subTitle'] = 'AutoProPAD > <strong>Content</strong>';
			$config = array();
			$config["base_url"] = base_url() . "admpro/autopropad/content";
			$total_row = $this->admin_model->get_content_rows();
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
			if($this->uri->segment(4)){
				$page = ($this->uri->segment(4));
				$limt_start = ($page - 1)  * $config["per_page"];
			}else{
				$page = 1;
				$limt_start = 0;
			}
			$data["totalrows"] = $this->admin_model->get_content_rows();
			$data['page'] = $page;
			$data["results"] = $this->admin_model->get_content($config["per_page"],$limt_start);
			$str_links = $this->pagination->create_links();
			$data["links"] = explode('&nbsp;',$str_links );					
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/content', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}

	public function add_content(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){
			$data['subTitle'] = 'AutoProPAD > <strong> Add Distributors</strong>';
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/add_content', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}	

	public function save_content(){
		$query = $this->admin_model->save_content();
		$this->session->set_flashdata('message_display', 'Data added successfully');
		redirect('admpro/autopropad/content');
	}
	public function edit_content($id){
		$data =array();
		if(isset($this->session->userdata['login_user'])){
			$data['id'] = $id;
			$data["content_info"] = $this->admin_model->content_info($id);
			$data['subTitle'] = 'AutoProPAD > <strong> Update Distributors</strong>';
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/edit_content', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}

	public function update_content(){
		$query = $this->admin_model->update_content();
		$this->session->set_flashdata('message_display', 'Data updated successfully');
		redirect('admpro/autopropad/content');
	}

	public function delete_content($id){
		$result = $this->admin_model->delete_content($id);	
		$this->session->set_flashdata('message_display', 'Data deleted successfully');
		redirect('admpro/autopropad/content');
	}
	public function cash_back_request_detail(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){
			$data['subTitle'] = 'AutoProPAD > <strong>Cash Back Request Detail </strong>';
			$data['getCashBackRequest'] =  $this->admin_model->getCashBackRequest();
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/cash_back_request_detail', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}	
	public function delete_cashback_request($id){
		$result = $this->admin_model->delete_cashback_request($id);	
		$this->session->set_flashdata('message_display', 'Data deleted successfully');
		redirect('admpro/autopropad/cash_back_request_detail');
	}
	public function edit_cashback_request($id){
		$data =array();
		if(isset($this->session->userdata['login_user'])){
			$data['id'] = $id;
			$data["getCashbackDetail"] = $this->admin_model->getCashbackDetail($id);
			$data['subTitle'] = 'AutoProPAD > <strong> Update Cash back Request Detail</strong>';
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/edit_cashback_request', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	public function update_cashback_request(){
	 $name = $this->input->post('first_name');
		$data =array();
		if(isset($this->session->userdata['login_user'])){
			$id = $this->input->post('Requestid');
			
			$query = $this->admin_model->update_cashback_request();			
			$this->session->set_flashdata('message_display', 'Data updated successfully');
			redirect('admpro/autopropad/cash_back_request_detail');
			}else{
				$this->session->set_flashdata('message_display', 'Data cannot updated');
				redirect('admpro/autopropad/cash_back_request_detail');
			}
		
		}
	
	
}
?>
