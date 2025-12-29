<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Vehicles extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url' ,'utility_helper','user_helper'));
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('admpro/admin_model');
		$this->load->library('pagination');
		$this->load->helper("file");
		$this->load->helper('email');
		$this->load->database();
	    $this->admin_db = $this->load->database('dev_db', true);
	}	
	public function makes(){
		$data =array();	
		if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = 'Vehicles > <strong>Makes</strong> ';
			$config = array();
			$config["base_url"] = base_url() . "admpro/vehicles/makes";
			 $total_row = $this->admin_model->getAllMakeNamesRows();
			
			$config["total_rows"] = $total_row;						
			$config['use_page_numbers'] = TRUE;
			$config['num_links'] = $total_row;
			$config['cur_tag_open'] = '<a class="current">';
			$config['cur_tag_close'] = '</a>';
			$config['per_page'] = 50;
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
			$data["getAllMakeNames"] = $this->admin_model->getAllMakeNamesDetail($config["per_page"],$limt_start);
			$str_links = $this->pagination->create_links();
			$data["links"] = explode('&nbsp;',$str_links );				
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/makes_user', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			  $this->load->view('admpro/index', $data);
		}
	}	
	public function model(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){
			$data['subTitle'] = 'Vehicles > <strong>Models</strong> ';
			$config = array();
			$config["base_url"] = base_url() . "admpro/vehicles/model";
			$total_row = $this->admin_model->getAllModelRows();
			$config["total_rows"] = $total_row;
			$data['getAllMakeNames'] = $this->admin_model->getAllMakeNames();
			if(isset($this->session->userdata['pagination_per_page'])){
				$per_page = $this->session->userdata['pagination_per_page']; 
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
			$data["totalrows"] = $this->admin_model->getAllModelRows();
			$data['page'] = $page;
			$data["results"] = $this->admin_model->getAllModel($config["per_page"],$limt_start);
			$str_links = $this->pagination->create_links();
			$data["links"] = explode('&nbsp;',$str_links );
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/manage_model', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			  $this->load->view('admpro/index', $data);
		}	
	}
	
/*--------------------------------------------------Add Makes user-------------------------*/
	
	public function add_makes(){
		$data = array();;
		if(isset($this->session->userdata['login_user'])){	
	    $data['subTitle'] = 'Vehicles > Makes > <strong>Add New Make</strong>';
		$this->load->view('admin_layout/header',$data);
		$this->load->view('admpro/add_makes');
		$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	public function makes_user_add(){
		$data = array();;
		if(isset($this->session->userdata['login_user'])){	
		$add_makename = $this->admin_model->MakesName();	
		if($add_makename == true){
		      $this->session->set_flashdata('message_display', 'Data added successfully');
		}else{
			$this->session->set_flashdata('message_display', 'Error in adding vehicles makes! ');							 
		}							
			redirect('admpro/vehicles/add_makes');
		}else{			     
				  $this->load->view('admpro/index', $data);
			}	
	}
	
/*------------------------Delete Makes Name---------------------------*/


	public function deletemakesname($id){		
		$result = $this->admin_model->deleteMake($id);		
		if($result == 2){
			$this->session->set_flashdata('message_display', '<div class="alert alert-danger">Data cannot be deleted!</div>');
		}else{
			$this->session->set_flashdata('message_display', '<div class="alert alert-success">Data deleted successfully</div>');
		}
		redirect('admpro/vehicles/makes');	
	}
	
	
/*---------------------------Edit Makes name-----------------------------------------------------*/

	public function edit_MakeName($id){
		$data = array();;
		if(isset($this->session->userdata['login_user'])){
			$data['subTitle'] = 'Vehicles > Makes > <strong>Update Make</strong>';
			$data['id'] = $id;
			$data['getMakeInfo'] = $this->admin_model->getMakeInfo($id);
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/edit_makesname', $data);
			$this->load->view('admin_layout/footer');
		}else{
			redirect('admpro/index');
		}
	}
	public function MakesName(){
		$id ="";
		if(isset($this->session->userdata['login_user'])){
			$data['subTitle'] = 'Edit user';
			$data['id'] = $id;
			$update = $this->admin_model->EditMAkesNAme();
			if($update == true){
			 $this->session->set_flashdata('message_display', '<div class="alert alert-info">Data  added successfully </div>');
		}else{
			$this->session->set_flashdata('message_display', '<div class="alert alert-danger">Make name already exits</div>');							 
		}							
				redirect('admpro/vehicles/makes');
		}else{			     
				  $this->load->view('admpro/index', $data);
			}	
	}
	
	
	
/*--------------------------- Sort List-------------------------------------*/

	public function makeSortList(){
		   $orderby = $this->input->post('sorting');
		   $angle = $this->input->post('angle');
		   $data['sorting'] = $orderby ;
		   $data['angle'] = $angle ;
		  $makeSortList =$this->admin_model->MakeSortList($orderby);
		  $data['data'] = $makeSortList;
		  $this->load->view('admpro/makes_sort',$data);
		 
	 }
	 
	 
/*-------------------------------Edit model name----------------------------------------------*/



	public function edit_model($id){
		$data = array();;
		if(isset($this->session->userdata['login_user'])){
			$data['subTitle'] = 'Vehicles > Models > <strong>Update Model</strong>';
			$data['id'] = $id;
			$data['getallmakes'] = $this->admin_model->getallmakes();
			$data['results'] = $this->admin_model->vehicle_types();
			$data['getModelInfo'] = $this->admin_model->getModelInfo($id);
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/edit_model', $data);
			$this->load->view('admin_layout/footer');
		}else{
			redirect('admpro/index');
		}
	}
	public function ModelName(){
		$id ="";
		if(isset($this->session->userdata['login_user'])){
			$data['subTitle'] = 'Edit Model';
			$data['id'] = $id;
			$update = $this->admin_model->EditModel();
			if($update == true){
			 	$this->session->set_flashdata('message_display', '<div class="alert alert-info">Data  added successfully </div>');
			}else{
				$this->session->set_flashdata('message_display', '<div class="alert alert-danger">Model name and Make name already exits</div>');							 
			}
				redirect('admpro/vehicles/model');
			}else{					
					redirect('admpro/index');
		    }
	}
/*------------------------------------------------------------------------------Delete Model Name-------------------------------------------*/

	public function deleteModel($id){	
		$this->session->set_flashdata('message_display','<div class="alert alert-success">Data deleted successfully </div>');
		$result = $this->admin_model->deleteModel($id);	
		redirect('admpro/vehicles/model');	
	}
/*------------------------------------------------------------------------------ Add Manage Model-----------------------------------------------*/
	public function add_model(){
	     $data = array();;
	 	if(isset($this->session->userdata['login_user'])){	
		
	    $data['subTitle'] = 'Vehicles > Models > <strong>Add New Model</strong>';
		$data['getAllMakeNames'] = $this->admin_model->getAllMakeNames();
		$data['results'] = $this->admin_model->vehicle_types();
		$this->load->view('admin_layout/header',$data);
		$this->load->view('admpro/add_model');
		$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	public function model_add(){
		$data = array();;
		if(isset($this->session->userdata['login_user'])){	
		$add_name = $this->admin_model->vehicle_types();	
		$add_name = $this->admin_model->modelName();	
		if($add_name == true){
		      $this->session->set_flashdata('message_display', 'Data added successfully');
		}else{
			$this->session->set_flashdata('message_display', 'Error in adding vehicles model! ');							 
		}							
			redirect('admpro/vehicles/add_model');
		}else{			     
				  $this->load->view('admpro/index', $data);
			}	
		}

/*------------------------------------------------------------------------------ model makenameSort List-------------------------------------------------------------------------*/
	public function MakeNamesSorting(){
		   $orderby = $this->input->post('sorting');
		   $angle = $this->input->post('angle');
		   $data['sorting'] = $orderby ;
		   $data['angle'] = $angle ;
		  $makeSortList1 =$this->admin_model->makenamesorting($orderby);
		  $data['data'] = $makeSortList1;
		  $this->load->view('admpro/model_makename_sorting',$data);
	 }	

/*--------------------------------------------------  Code series   --------------------------------------------------------*/

	public function codeseries(){
		$data = array();;
		if(isset($this->session->userdata['login_user'])){	
		$data['subTitle'] = 'Vehicles > <strong> Code Series</strong>';		
		$config = array();
		$config["base_url"] = base_url() . "admpro/vehicles/codeseries";
		$total_row = $this->admin_model->getAllCodeSeriesRows();
		$config["total_rows"] = $total_row;
		$data['getAllMakeNames'] = $this->admin_model->getAllMakeNames();
		if(isset($this->session->userdata['code_series_pagination'])){
			$per_page = $this->session->userdata['code_series_pagination']; 
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
		$data["totalrows"] = $this->admin_model->getAllCodeSeriesRows();
		$data['page'] = $page;
		$data["results"] = $this->admin_model->getAllCodeSeriesData($config["per_page"],$limt_start);
		$str_links = $this->pagination->create_links();
		$data["links"] = explode('&nbsp;',$str_links );		
		$data['getAllCodeSeries'] = $this->admin_model->getAllCodeSeries();
		$data['getAllKeyStyles'] = $this->admin_model->getAllkeyStyles();
		$this->load->view('admin_layout/header',$data);
		$this->load->view('admpro/code', $data);
		$this->load->view('admin_layout/footer');
		}else{			     
		     $this->load->view('admpro/index', $data);
		}
	}
	
	
	public function code_series_pagination(){		
		 $session_data = array('per_page' => $this->input->post('searching'));
		 $this->session->set_userdata('code_series_pagination', $session_data);
	}
	
	
	public function filter_cs_by_kstyle(){
		$data["results"] = $this->admin_model->filter_cs_by_kstyle();
		$this->load->view('admpro/filter_cs_by_kstyle', $data);
	}
	
	public function search_code_series(){
		$data["results"] = $this->admin_model->search_code_series();
		$this->load->view('admpro/filter_cs_by_kstyle', $data);	
	}
	
	
	
/*-------------------------------------------------------------------------Add code----------------------------------------------------------------------------------------------*/
	public function add_code(){
	    $data = array();;
	 	if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = 'Vehicles > Code Series > <strong>Add New Code Series</strong>';
			$data['getAllKeyStyles'] = $this->admin_model->getAllkeyStyles();
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/add_code');
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	public function code_added(){
		
		$data = array();;
		if(isset($this->session->userdata['login_user'])){	
			$add_code= $this->admin_model->AddCode();	
			if($add_code != ""){
				$this->session->set_flashdata('message_display', 'Added the new  <strong>'.$this->input->post('code_series_name').'</strong> code series &nbsp;
				 <a href="'.base_url().'admpro/vehicles/edit_codeSeries/'.$add_code.'">Edit</a>');
			}else if($add_code == false){
				$this->session->set_flashdata('message_display', 'Already exists ');							 
			}							
			redirect('admpro/vehicles/add_code');
		}else{			     
			$this->load->view('admpro/index', $data);
		}	
	}
/*---------------------------Edit CodeSeries-----------------------------------------------------*/
	public function edit_codeSeries($id){
		$data = array();;
		if(isset($this->session->userdata['login_user'])){
			$data['subTitle'] = 'Vehicles > Code Series > <strong>Update Code Series</strong>';
			$data['id'] = $id;
			$data['getAllKeyStyles'] = $this->admin_model->getAllkeyStyles();
			$data['getCodeSeries'] = $this->admin_model->getCodeSeries($id);
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/edit_code_series', $data);
			$this->load->view('admin_layout/footer');
		}else{
			redirect('admpro/index');
		}
	}
	
	public function copy_code($id){
		$data = array();;
		if(isset($this->session->userdata['login_user'])){
			$data['subTitle'] = 'Vehicles > Code Series > <strong>Update Code Series</strong>';
			$data['id'] = $id;
			$data['getAllKeyStyles'] = $this->admin_model->getAllkeyStyles();
			$data['getCodeSeries'] = $this->admin_model->getCodeSeries($id);
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/copy_code', $data);
			$this->load->view('admin_layout/footer');
		}else{
			redirect('admpro/index');
		}
	}
	/*public function Update_code_series(){
		$id ="";
		if(isset($this->session->userdata['login_user'])){
			$data['subTitle'] = 'UpdateChips';
			$data['id'] = $id;
			$update = $this->admin_model->EditcodeSeries();
			if($update == true){
			 		$this->session->set_flashdata('message_display', '<div class="alert alert-info">Data  added successfully </div>');
			}else{
					$this->session->set_flashdata('message_display', '<div class="alert alert-danger">Data already exits</div>');							 
			}							
				redirect('admpro/vehicles/codeseries');
		}else{			     
			  $this->load->view('admpro/index', $data);
			}
	}*/
	
	public function update_code_series(){
		$update = $this->admin_model->update_code_series();
		$this->session->set_flashdata('message_display', '<div class="alert alert-info">Data  updated successfully </div>');
		redirect('admpro/vehicles/codeseries');
	}
	
/*--------------------------------------------------------------Delete code series--------------------------------------------------------------------------------------------*/
	public function deleteCode($id){		
		$result = $this->admin_model->DeleteCodeSeries($id);		
		if($result == 2){
			$this->session->set_flashdata('message_display', '<div class="alert alert-danger">Data cannot be deleted!</div>');
		}else{
			$this->session->set_flashdata('message_display', '<div class="alert alert-success">Data deleted successfully</div>');
		}
		redirect('admpro/vehicles/codeseries');	
	}
	
	
	
/*=========================================== Filter ==============================================*/	

	public function filter_by_makes(){		
		$data['filter_data'] = $this->admin_model->filter_by_makes();
		$this->load->view('admpro/filter_by_makes',$data);
	}  
	
	
	public function search_makes(){			
		$data['filter_data'] = $this->admin_model->search_makes();
		$this->load->view('admpro/filter_by_makes',$data);
	}
	
	public function code_sorting(){
		$data['sorting'] = $this->input->post('sorting');
		$data['getAllCodeSeries'] = $this->admin_model->code_sorting();
		$this->load->view('admpro/code_sorting',$data);
	}
	
	
	public function get_try_out_keys(){
		$this->load->view('admpro/get_try_out_keys');
	}


/*=============================================== Vahicle Module ============================================*/
	
	/*public function vehicles_test(){
		$data['subTitle'] = 'Vehicles > <strong>Vehicles</strong>';	
		$data["results"] = $this->admin_model->getAllvehicles_testData();	
		$this->load->view('admin_layout/header',$data);
		$this->load->view('admpro/vehicles_test', $data);
		$this->load->view('admin_layout/footer');
	}*/
	
	public function vehicle($id = ""){
		$data =array();
		if(isset($this->session->userdata['login_user'])){
			if($_GET['sorting'] !=""){
				$sort_data = explode('__',$_GET['sorting']);
				$sort = $sort_data[1];
				$sorting_by = $sort_data[0];
				$_SESSION['global_sorting'] = $sorting_by." ".$sort;
				$_SESSION['sort'] = $sort;
			}	
			if($id !="" && preg_match('/id_/',$id)){
				$data =array();		
				$data['subTitle'] = 'Vehicles > <strong>Vehicles</strong>';		
				$vehicle_id = str_replace('id_','', $id);
				$data["results"] = $this->admin_model->getAllVehiclesDataInfo($vehicle_id);
			}else{
				$data =array();		
				$data['subTitle'] = 'Vehicles > <strong>Vehicles</strong>';		
				$config = array();
				$config["base_url"] = base_url() . "admpro/vehicles/vehicle";
				if(isset($this->session->userdata['vehicle_filter_missing'])){
					$session_data = $this->session->userdata('vehicle_filter_missing');
					$vehicle_type = $session_data['vehicle_type'];
					if($vehicle_type == ''){
						$total_row = $this->admin_model->getAllVehiclesRows();
					}elseif($vehicle_type == 'All'){
						$total_row = $this->admin_model->getAllVehiclesRows();
					}else{
						$total_row  = $this->admin_model->getAllVehiclesRows_Missing_Rows($vehicle_type);
					}
				}elseif(isset($this->session->userdata['vehicle_filter_type'])){
					$session_data = $this->session->userdata('vehicle_filter_type');
					$vehicle_type = $session_data['vehicle_type'];
					if($vehicle_type == ''){
						$total_row = $this->admin_model->getAllVehiclesRows();
					}elseif($vehicle_type == 'All'){
						$total_row = $this->admin_model->getAllVehiclesRows();
					}else{
						$total_row = $this->admin_model->getAllVehiclesRows2_Rows($vehicle_type);
					}
				}elseif(isset($_SESSION['make_id']) && $_SESSION['make_id'] !=""){	
					$makeId = $_SESSION['make_id'];													
					if($makeId == 'All'){
						$total_row = $this->admin_model->getAllVehiclesRows();
					}else{										
						$total_row = $this->admin_model->getAllmakesRows($makeId);						
					}										
				}else{
					$total_row = $this->admin_model->getAllVehiclesRows();
				}		
				$config["total_rows"] = $total_row;			
				if(isset($this->session->userdata['vehicles_pagination'])){
					$per_page = $this->session->userdata['vehicles_pagination']; 
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
				$data["totalrows"] = $this->admin_model->getAllVehiclesRows();
				
				$data['page'] = $page;
				if(isset($_SESSION['search_key']) && $_SESSION['search_key'] !=""){				
						$data["results"] =  $this->admin_model->getSearchItem($config["per_page"],$limt_start,$_SESSION['search_key']);	
				}elseif(isset($_SESSION['model_id']) && isset($_SESSION['make_id']) && $_SESSION['model_id'] !="" && $_SESSION['make_id'] !=""){					
					$makeId = $_SESSION['make_id'];				
					$modelId =$_SESSION['model_id'];
					if($modelId !=""){
						$data["results"] = $this->admin_model->getmakemodelfilter($config["per_page"],$limt_start,$modelId, $makeId);
					}else{
						$data["results"] = $this->admin_model->getAllVehiclesData($config["per_page"],$limt_start);
					}					
				}elseif(isset($_SESSION['make_id']) && $_SESSION['make_id'] !=""){						
					$makeId = $_SESSION['make_id'];									
					if($makeId == 'All'){
						$data["results"] = $this->admin_model->getAllVehiclesData($config["per_page"],$limt_start);
					}else{										
						$data["results"] = $this->admin_model->getfiltermakes($makeId,$config["per_page"],$limt_start);							
					}										
				}elseif(isset($this->session->userdata['vehicle_filter_missing'])){
					$session_data = $this->session->userdata('vehicle_filter_missing');
					$vehicle_type = $session_data['vehicle_type'];
					if($vehicle_type == ''){
						$data["results"] = $this->admin_model->getAllVehiclesData($config["per_page"],$limt_start);
					}elseif($vehicle_type == 'All'){
						  $data["results"] = $this->admin_model->getAllVehiclesData($config["per_page"],$limt_start);
					}else{
						$data["results"] = $this->admin_model->getAllVehiclesRows_Missing($config["per_page"],$limt_start,$vehicle_type);
					}
				}elseif(isset($this->session->userdata['vehicle_filter_type'])){
					$session_data = $this->session->userdata('vehicle_filter_type');
					$vehicle_type = $session_data['vehicle_type'];
					if($vehicle_type == ''){
						$data["results"] = $this->admin_model->getAllVehiclesData($config["per_page"],$limt_start);
					}elseif($vehicle_type == 'All'){
						  $data["results"] = $this->admin_model->getAllVehiclesData($config["per_page"],$limt_start);
					}else{
						$data["results"] = $this->admin_model->getAllVehiclesData2($config["per_page"],$limt_start,$vehicle_type);
					}
				}else{
					$data["results"] = $this->admin_model->getAllVehiclesData($config["per_page"],$limt_start);
				}
			}
		
			$data["getAllMakeNames"] = $this->admin_model->getAllMakeNames();
			//$data['all_makes'] = $this->admin_model->get_AllMakes2($config["per_page"],$limt_start);			
			$data['all_makes'] = $this->admin_model->get_AllMakes();		
			$str_links = $this->pagination->create_links();
			$data["links"] = explode('&nbsp;',$str_links );			
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/vehicles', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
		     $this->load->view('admpro/index', $data);
		}
	}
	
	public function add_vehicle(){
		$data =array();
		if(isset($this->session->userdata['login_user'])){
			$data['subTitle'] = 'Vehicles > Vehicles > <strong>Add New Vehicle</strong>';
			$data["getAllMakeNames"] = $this->admin_model->getAllMakeNames();
			$data["get_all_vehicles"] = $this->admin_model->get_all_vehicles2();	
			$user_data = $this->session->userdata['login_user'];
			$user_email = $user_data['email'];				
			$data['getUsersInfo'] = $this->admin_model->usersInInfo($user_email);	
			$data['get_t_code_series'] = $this->admin_model->get_t_code_series();	
			$data['getRetainers'] =	$this->admin_model->getRetainers();
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/add_vehicle', $data);
			$this->load->view('admin_layout/footer');
		}else{
			redirect('admpro/index');
		}
	}
	
	public function get_models(){
		$data['get_models'] = $this->admin_model->get_models();
		$data['makeId'] = $this->input->post('makeId');
		$this->load->view('admpro/get_models', $data);
	}
	
	public function get_vehicle_models(){
		unset($_SESSION['search_key']);
		$data['get_models'] = $this->admin_model->get_models();
		$data['makeId'] = $this->input->post('makeId');
		$makeId = $this->input->post('makeId');			
		$_SESSION['make_id'] = $makeId;
		$config = array();
		$config["base_url"] = base_url() . "admpro/vehicles/vehicle";
		$total_row = $this->admin_model->getAllmakesRows($makeId);
		$config["total_rows"] = $total_row;	
		if(isset($this->session->userdata['vehicles_pagination'])){
			$per_page = $this->session->userdata['vehicles_pagination']; 
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
		$str_links = $this->pagination->create_links();
		$data["links"] = explode('&nbsp;',$str_links);
		$data["totalrows"] = $total_row;	
		if($makeId =='All'){
			$data["results"] = $this->admin_model->getAllVehiclesData($config["per_page"],$limt_start);			
		}else{
			$data['results'] = $this->admin_model->vehicle_sort_by_make($config["per_page"],$limt_start);
		}		
		$this->load->view('admpro/get_vehicle_models', $data);
	}
	
	
	
	public function save_vehicle(){
		if($this->input->post('toYear') != ""){
			$year = $this->input->post('fromYear').'-'. $this->input->post('toYear');
		}else{
			$year = $this->input->post('fromYear');
		}
		$make_uuid = $this->input->post('Make_UUID');
		$model_uuid = $this->input->post('Model_UUID');
		$getModelInfo = $this->admin_model->getModelInfo2($model_uuid);
		$getMakeInfo = $this->admin_model->getMakeInfo2($make_uuid);
		$update = $this->admin_model->save_vehicle();
		$this->session->set_flashdata('message_display', 'Added the new <strong>'.$year.' '.$getMakeInfo[0]['Make_Name'].' '.$getModelInfo[0]['Model_Name'].'</strong> vehicle');
		redirect('admpro/vehicles/add_vehicle');
	}
	
	
	public function edit_vehicles($id){
		$data =array();
		if(isset($this->session->userdata['login_user'])){
			$data['vehicleId'] = $id ;
			$data['subTitle'] = 'Vehicles > Vehicles > <strong>Update Vehicle</strong>';
			$data["getAllMakeNames"] = $this->admin_model->getAllMakeNames();	
			$data['get_t_code_series'] = $this->admin_model->get_t_code_series();	
			$data['getRetainers'] =	$this->admin_model->getRetainers();
			$data['getVehiclesInfo'] =	$this->admin_model->getVehiclesInfo($id);
			$user_data = $this->session->userdata['login_user'];
			$user_email = $user_data['email'];				
			$data['getUsersInfo'] = $this->admin_model->usersInInfo($user_email);	
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/edit_vehicles', $data);
			$this->load->view('admin_layout/footer');
		}else{
			redirect('admpro/index');
		}
	}
	
	public function copy_vehicle($id){
		$data =array();
		if(isset($this->session->userdata['login_user'])){
			$data['vehicleId'] = $id ;
			$data['subTitle'] = 'Vehicles > Vehicles > <strong>Update Vehicle</strong>';
			$data["getAllMakeNames"] = $this->admin_model->getAllMakeNames();	
			$data['get_t_code_series'] = $this->admin_model->get_t_code_series();	
			$data['getRetainers'] =	$this->admin_model->getRetainers();
			$data['getVehiclesInfo'] =	$this->admin_model->getVehiclesInfo($id);
			$data["get_all_vehicles"] = $this->admin_model->get_all_vehicles2();
			$user_data = $this->session->userdata['login_user'];
			$user_email = $user_data['email'];				
			$data['getUsersInfo'] = $this->admin_model->usersInInfo($user_email);	
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/copy_vehicle', $data);
			$this->load->view('admin_layout/footer');
		}else{
			redirect('admpro/index');
		}
	}
	
	public function update_vehicle(){
		if(isset($_SESSION['pageNumber'])){
			$page_id =  $_SESSION['pageNumber'];
		}else{
			$page_id = "";
		}
		$update = $this->admin_model->update_vehicle();
		$this->session->set_flashdata('message_display', '<div class="alert alert-success">Data updated successfully</div>');
		redirect('admpro/vehicles/vehicle/'.$page_id);
	}
	
	public function delete_vehicles($id){
		$this->session->set_flashdata('message_display','<div class="alert alert-success">Data deleted successfully </div>');
		$result = $this->admin_model->delete_vehicles($id);	
		redirect('admpro/vehicles/vehicle');
	}
	
	public function filter_vehicle_by_model(){		
		$data['sorting'] = 'DESC';
		$data['sorting_by'] = '';
		$modelId = $this->input->post('modelId');
		$result = $this->admin_model->filter_vehicle_by_model();
		if($result){
			$_SESSION['model_id'] = $modelId;
			$data['results'] = $this->admin_model->filter_vehicle_by_model();
			$this->load->view('admpro/vehicle_sorting_make',$data);
		}else{
			unset($_SESSION['model_id']);
			$data['results'] = $this->admin_model->filter_vehicle_by_model();
			$this->load->view('admpro/vehicle_sorting_make',$data);
		}
	}
	
	public function search_vehicles(){
		$search_key = trim($this->input->post('search_key'));
		$data['sorting'] = 'DESC';
		$data['sorting_by'] = '';
		$result = $this->admin_model->search_vehicles();
		if($result){
			$_SESSION['search_key'] = $search_key;			
		}else{
			unset($_SESSION['search_key']);
		}
		$data['results'] = $result;
		$this->load->view('admpro/vehicle_sorting_make',$data);
	}

	public function searchAvailableVehicles(){
		$data['get_all_vehicles'] = $this->admin_model->search_vehicles();
		$this->load->view('admpro/searchAvailableVehicles',$data);	
	}

	public function searchAvailableVehiclesMethod(){
		$data['get_all_vehicles'] = $this->admin_model->search_vehicles();
		$this->load->view('admpro/searchAvailableVehiclesMethod',$data);	
	}

	public function limitVehicleTransponder(){
		$data['get_all_vehicles'] = $this->admin_model->limitVehicleTransponder();
		$this->load->view('admpro/limitVehicleTransponder',$data);	
	}

	public function searchAvailableVehicles2(){
		$data['get_all_vehicles'] = $this->admin_model->search_vehicles2();
		$this->load->view('admpro/searchAvailableVehicles2',$data);	
	}
	
	public function get_determinator(){
		$data['UUID'] = $this->input->post('uuId');
		$data['dataId'] = $this->input->post('dataId');
		$data['column'] = $this->input->post('column');
		$data['key'] = $this->input->post('key');
		$this->load->view('admpro/get_determinators',$data);
	}	
	
	public function update_determinator(){
		echo $results = $this->admin_model->update_determinator();
	}	
	
	public function HideMachineInfo(){
		$cookies_values = $_POST['remember']; 
		$cookie_name = "MachineInfo_cookie"; 
		if($_POST['remember'] == 1){
			setcookie($cookie_name, $cookies_values, time() + (86400 * 30), "/");
		}else{
			setcookie($cookie_name,'', time() + (86400 * 30), "/");
		}
	}
	
	public function HideDecoders(){
		$cookies_values = $_POST['remember']; 
		$cookie_name = "Decoders_cookie"; 
		if($_POST['remember'] == 1){
			setcookie($cookie_name, $cookies_values, time() + (86400 * 30), "/");
		}else{
			setcookie($cookie_name,'', time() + (86400 * 30), "/");
		}
	}
	
	
	public function get_cs_column_data(){
		$data['input_val'] = $this->input->post('value');
		$data['input_id']= $this->input->post('dataId');
		$data['input_column'] = $this->input->post('ColumnName');
		$this->load->view('admpro/get_cs_column_data',$data);
	}
	
	public function csinput_update(){
		echo $results = $this->admin_model->csinput_update();
	}
	
	
	public function get_cs_keys_data(){
		$data['input_val'] = $this->input->post('value');
		$data['input_id']= $this->input->post('dataId');
		$data['input_column'] = $this->input->post('ColumnName');
		$data['key1'] = $this->input->post('key1');
		$data['key2'] = $this->input->post('key2');
		$this->load->view('admpro/get_cs_keys_data',$data);
	}
	public function cs_keys_data_update(){
		echo $results = $this->admin_model->cs_keys_data_update();
	}
	
	public function get_machine_data(){
		$data['UUID'] = $this->input->post('uuId');
		$data['dataId'] = $this->input->post('dataId');
		$data['column'] = $this->input->post('column');
		$data['key'] = $this->input->post('key');
		$this->load->view('admpro/get_machine_data',$data);
	}
	
	public function update_machine_data(){
		echo $results = $this->admin_model->update_machine_data();
	}
	
	public function get_key_style_data(){
		$data['UUID'] = $this->input->post('uuId');
		$data['dataId'] = $this->input->post('dataId');
		$data['column'] = $this->input->post('column');	
		$data['getAllKeyStyles'] = $this->admin_model->getAllkeyStyles();	
		$this->load->view('admpro/get_key_style_data',$data);
	}
	
	public function update_key_style_data(){
		echo $results = $this->admin_model->update_key_style_data();
	}

/*=========================== Vehicle Page Editing ==========================================*/
	
	public function edit_vh_inputs(){
		$data['UUID'] = $this->input->post('uuId');
		$data['dataId'] = $this->input->post('dataId');
		$data['column'] = $this->input->post('column');
		$data['value'] = $this->input->post('value');
		$this->load->view('admpro/edit_vh_inputs',$data);
	}
	
	public function edit_image_inputs(){
		$data['UUID'] = $this->input->post('uuId');
		$data['dataId'] = $this->input->post('dataId');
		$data['column'] = $this->input->post('column');
		$data['value'] = $this->input->post('value');
		$data['img_uuid'] = $this->input->post('img_uuid'); 
		$user_data = $this->session->userdata['login_user'];
		$user_email = $user_data['email'];				
		$data['getUsersInfo'] = $this->admin_model->usersInInfo($user_email);	
		$this->load->view('admpro/edit_image_inputs',$data);
	}
	
	public function vh_input_update(){
		echo $results = $this->admin_model->vh_input_update();
	}
	
	public function update_vehicle_image1(){
		echo $results = $this->admin_model->update_vehicle_image1();
	}
	
	public function edit_vh_dropbox(){
		$data['UUID'] = $this->input->post('uuId');
		$data['dataId'] = $this->input->post('dataId');
		$data['column'] = $this->input->post('column');
		$data['value'] = $this->input->post('value');
		$data['key'] = $this->input->post('key');
		$data['type'] = $this->input->post('type');
		$data["getAllMakeNames"] = $this->admin_model->getAllMakeNames();	
		$data['get_t_code_series'] = $this->admin_model->get_t_code_series();	
		$data['getRetainers'] =	$this->admin_model->getRetainers();
		$this->load->view('admpro/edit_vh_dropbox',$data);
	}
	
	public function vh_dropbox_update(){
		echo $results = $this->admin_model->vh_dropbox_update();
	}
	
	public function edit_vh_programmers_box(){
		$data['UUID'] = $this->input->post('uuId');
		$data['dataId'] = $this->input->post('dataId');
		$data['column'] = $this->input->post('column');
		$data['value'] = $this->input->post('value');
		$data['key'] = $this->input->post('key');
		$data['type'] = $this->input->post('type');		
		$this->load->view('admpro/edit_vh_programmers_box',$data);
	}
	
	public function edit_vh_multiple_box(){
		$data['UUID'] = $this->input->post('uuId');
		$data['dataId'] = $this->input->post('dataId');
		$data['column'] = $this->input->post('column');
		$data['value'] = $this->input->post('value');
		$data['key'] = $this->input->post('key');
		$data['type'] = $this->input->post('type');		
		$this->load->view('admpro/edit_vh_multiple_box',$data);
	}
	
	public function vh_multiple_dropbox_update(){
		echo $results = $this->admin_model->vh_multiple_dropbox_update();
	}
	
	public function vh_programmers_dropbox_update(){
		echo $results = $this->admin_model->vh_programmers_dropbox_update();
	}	
	
	public function HideAdvancedign(){
		$cookies_values = $_POST['remember']; 
		$cookie_name = "Advanced_cookie"; 
		if($_POST['remember'] == 1){
			setcookie($cookie_name, $cookies_values, time() + (86400 * 30), "/");
		}else{
			setcookie($cookie_name,'', time() + (86400 * 30), "/");
		}
	}
	
	public function HideProlok(){
		$cookies_values = $_POST['remember']; 
		$cookie_name = "Prolok_cookie"; 
		if($_POST['remember'] == 1){
			setcookie($cookie_name, $cookies_values, time() + (86400 * 30), "/");
		}else{
			setcookie($cookie_name,'', time() + (86400 * 30), "/");
		}
	}
	
	public function HideCcode_keyInfo(){
		$cookies_values = $_POST['remember']; 
		$cookie_name = "code_keyInfo_cookie"; 
		if($_POST['remember'] == 1){
			setcookie($cookie_name, $cookies_values, time() + (86400 * 30), "/");
		}else{
			setcookie($cookie_name,'', time() + (86400 * 30), "/");
		}
	}
	
	public function HideAutoProPAD(){
		$cookies_values = $_POST['remember']; 
		$cookie_name = "autopropad_cookie"; 
		if($_POST['remember'] == 1){
			setcookie($cookie_name, $cookies_values, time() + (86400 * 30), "/");
		}else{
			setcookie($cookie_name,'', time() + (86400 * 30), "/");
		}
	}
	
	public function HideHotWire(){
		$cookies_values = $_POST['remember']; 
		$cookie_name = "hotwire_cookie"; 
		if($_POST['remember'] == 1){
			setcookie($cookie_name, $cookies_values, time() + (86400 * 30), "/");
		}else{
			setcookie($cookie_name,'', time() + (86400 * 30), "/");
		}
	}
	
	public function HideTKOSDD(){
		$cookies_values = $_POST['remember']; 
		$cookie_name = "tko_sdd_cookie"; 
		if($_POST['remember'] == 1){
			setcookie($cookie_name, $cookies_values, time() + (86400 * 30), "/");
		}else{
			setcookie($cookie_name,'', time() + (86400 * 30), "/");
		}
	}
	
/*==================== OBD: options ===================================================*/

	public function obp_options(){
		$data = array();
		if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = 'Vehicles > <strong>OBP: Options</strong>';	
			$data['results'] = $this->admin_model->get_obp_options();	
			$data['image_types'] = $this->admin_model->get_image_types();			
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/obp_options', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	public function add_obp_option(){
		$data = array();;
		if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = 'Vehicles > <strong>Add New Option</strong>';			
			$data['get_image'] = $this->admin_model->get_image();	
			$data['obp_option_categories'] = $this->admin_model->get_obp_option_categories();			
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/add_obp_option', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	public function save_obp_options(){
		$data = array();;
		if(isset($this->session->userdata['login_user'])){	
			$query = $this->admin_model->save_obp_options();
			$this->session->set_flashdata('message_display', 'Data added successfully');
			redirect('admpro/vehicles/add_obp_option');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	public function edit_obp_options($id){
		$data = array();;
		if(isset($this->session->userdata['login_user'])){	
			$data['id'] = $id;	
			$data['subTitle'] = 'Vehicles > <strong>Add New Option</strong>';
			$data['obp_options_info'] = $this->admin_model->get_obp_options_info($id);			
			$data['get_image'] = $this->admin_model->get_image();	
			$data['obp_option_categories'] = $this->admin_model->get_obp_option_categories();			
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/edit_obp_options', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	public function update_obp_options(){
		$data = array();;
		if(isset($this->session->userdata['login_user'])){	
			$query = $this->admin_model->update_obp_options();
			$this->session->set_flashdata('message_display', '<div class="alert alert-success">Data updated successfully</div>');
			redirect('admpro/vehicles/obp_options');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	public function delete_obp_options($id){
		$result = $this->admin_model->delete_obp_options($id);	
		$this->session->set_flashdata('message_display', '<div class="alert alert-success">Data deleted successfully</div>');
		redirect('admpro/vehicles/obp_options');
	}
	
	public function obp_options_sorting(){
		$data['sorting'] = $this->input->post('sorting');
		$data['sort_by'] = $this->input->post('sortby');		
		$data['results'] = $this->admin_model->obp_options_sorting();	
		$this->load->view('admpro/obp_options_sorting',$data);
	}
	
	
/*============================ OBP Options Categories ==================================*/
	
	public function obp_options_categories(){
		$data = array();;
		if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = 'Vehicles > <strong>OBP: Options Category</strong>';	
			$data['results'] = $this->admin_model->get_obp_option_categories();			
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/obp_options_categories', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	public function add_obp_options_categories(){
		$data = array();;
		if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = 'Vehicles > <strong>Add New Category</strong>';					
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/add_obp_options_categories', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	public function save_obp_options_category(){
		$data = array();;
		if(isset($this->session->userdata['login_user'])){	
			$query = $this->admin_model->save_obp_options_category();
			$this->session->set_flashdata('message_display', 'Data added successfully');
			redirect('admpro/vehicles/add_obp_options_categories');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	public function edit_obp_options_cat($id){
		$data = array();;
		if(isset($this->session->userdata['login_user'])){
			$data['id'] = $id;	
			$data['subTitle'] = 'Vehicles > <strong>Add New Category</strong>';	
			$data['obp_option_cat_info'] = $this->admin_model->get_obp_option_cat_info($id);						
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/edit_obp_options_cat', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	public function update_obp_options_category(){
		$data = array();;
		if(isset($this->session->userdata['login_user'])){	
			$query = $this->admin_model->update_obp_options_category();
			$this->session->set_flashdata('message_display', '<div class="alert alert-success">Data updated successfully</div>');
			redirect('admpro/vehicles/obp_options_categories');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	public function delete_obp_options_cat($id){
		$result = $this->admin_model->delete_obp_options_cat($id);	
		$this->session->set_flashdata('message_display', '<div class="alert alert-success">Data deleted successfully</div>');
		redirect('admpro/vehicles/obp_options_categories');
	}
	
	
	public function obp_opt_cateogry_sort(){
		$data['sorting'] = $this->input->post('sorting');
		$data['sorting_by'] = $this->input->post('sorting_by');
		$data['results'] = $this->admin_model->obp_opt_cateogry_sort();
		$this->load->view('admpro/obp_opt_cateogry_sort',$data);	
	}


/*============================ OBP remotes ==================================*/
	
	public function obp_remotes(){
		$data = array();;
		if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = 'Vehicles > <strong>OBP: Remotes</strong>';	
			$data['results'] = $this->admin_model->get_obp_remotes();			
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/obp_remotes', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}	
	
	public function add_obp_remotes(){		
		$data = array();;
		if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = 'Vehicles > <strong>OBP: Remotes</strong>';	
			$data["getAllMakeNames"] = $this->admin_model->getAllMakeNames();
			$data['obp_option_categories']	= $this->admin_model->get_obp_option_categories();	
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/add_obp_remotes', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}	
	
	public function get_obp_models(){
		$data['get_models'] = $this->admin_model->get_models();
		$data['makeId'] = $this->input->post('makeId');
		$this->load->view('admpro/get_obp_models', $data);
	}
	
	public function get_obp_models2(){
		$data['get_models'] = $this->admin_model->get_models();
		$data['makeId'] = $this->input->post('makeId');
		$this->load->view('admpro/get_obp_models2', $data);
	}
	
	public function get_obp_vehicles(){
		$data['get_vehicles'] = $this->admin_model->get_vehicles();	
		$data['modelId'] = $this->input->post('ModelId');	
		$this->load->view('admpro/get_obp_vehicles', $data);
	}
	
	public function get_obp_vehicles2(){
		$data['get_vehicles'] = $this->admin_model->get_vehicles();	
		$data['modelId'] = $this->input->post('ModelId');	
		$this->load->view('admpro/get_obp_vehicles2', $data);
	}
	
	public function get_obp_ptions(){
		$data['get_obp_ptions'] = $this->admin_model->get_obp_ptions();	
		$data['catId'] = $this->input->post('catId');	
		$this->load->view('admpro/get_obp_options', $data);
	}	
	
	public function get_obp_image(){
		$data['get_obp_ptions'] = $this->admin_model->get_obp_image();	
		$data['catId'] = $this->input->post('catId');	
		$this->load->view('admpro/get_obp_image', $data);
	}
	
	public function change_obp_image(){
		$data['get_obp_ptions'] = $this->admin_model->change_obp_image();	
		$data['Image_Type_UUID'] = $this->input->post('Image_Type_UUID');	
		$this->load->view('admpro/change_obp_image', $data);
	}
	
	public function get_image_deafult_text(){
		$data['get_obp_ptions'] = $this->admin_model->get_image_deafult_text();	
		$data['Default_Image_UUID'] = $this->input->post('Default_Image_UUID');	
		$this->load->view('admpro/get_image_deafult_text', $data);
	}
	
	public function add_another_procedure(){
		$data['procedure'] = $this->input->post('procedure');
		$data['obp_option_categories']	= $this->admin_model->get_obp_option_categories();		
		$this->load->view('admpro/get_another_procedure', $data);	
	}
	
	public function save_obp_remote(){
		$data = array();
		if(isset($this->session->userdata['login_user'])){	
			$query = $this->admin_model->save_obp_remote();
			$this->session->set_flashdata('message_display', 'Data added successfully');
			redirect('admpro/vehicles/add_obp_remotes');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	public function edit_obp_remotes($uuid){
		$data = array();;
		if(isset($this->session->userdata['login_user'])){
			$data['id'] = $uuid;	
			$data['subTitle'] = 'Vehicles > <strong>OBP: Remotes</strong>';	
			$data["getAllMakeNames"] = $this->admin_model->getAllMakeNames();
			$data['obp_option_categories']	= $this->admin_model->get_obp_option_categories();	
			$data['obp_remote_info']	= $this->admin_model->get_obp_remote_info($uuid);	
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/edit_obp_remotes', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}

/*---------------------------- Add Vehicle Images -----------------------------------------------*/

	public function v_images(){
		$data = array();;
		if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = 'User Submissions > <strong>Images</strong>';
			$data["getAllMakeNames"] = $this->admin_model->getAllMakeNames();
			$data["get_all_vehicles"] = $this->admin_model->get_all_vehicles();	
			$user_data = $this->session->userdata['login_user'];
			$user_email = $user_data['email'];				
			$data['getUsersInfo'] = $this->admin_model->usersInInfo($user_email);					
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/vehicle_images', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	public function vehicle_images($id=""){
		$data = array();;
		if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = 'Vehicles > <strong>Vehicle Images</strong>';	
			$data["getAllMakeNames"] = $this->admin_model->getAllMakeNames();
			$data["get_all_vehicles_images"] = $this->admin_model->get_all_vehicles_images();	
			$data["id"] = $id;							
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/vehicles_images', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}

	public function add_vehicles_images( $id="" ){
		$data = array();;
		if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = 'Vehicles > <strong>Add Vehicle Images</strong>';	
			$data["getAllMakeNames"] = $this->admin_model->getAllMakeNames();
			$data["get_all_vehicles_images"] = $this->admin_model->get_all_vehicles_images();
			$user_data = $this->session->userdata['login_user'];
			$user_email = $user_data['email'];				
			$data['getUsersInfo'] = $this->admin_model->usersInInfo($user_email);	
			$data["id"] = $id;							
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/add_vehicles_images', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}


	public function save_vehicle_images(){
		$data = array();;
		if(isset($this->session->userdata['login_user'])){	
			$query = $this->admin_model->save_vehicle_images();
			$this->session->set_flashdata('message_display', 'Data added successfully');
			redirect('admpro/vehicles/add_vehicles_images');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}

	public function edit_vehicle_image($id){
		$data = array();;
		if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = 'Vehicles > <strong>Upadte Vehicle Images</strong>';	
			$data["getAllMakeNames"] = $this->admin_model->getAllMakeNames();
			$data["vehicles_images_info"] = $this->admin_model->get_vehicles_images_info($id);
			$user_data = $this->session->userdata['login_user'];
			$user_email = $user_data['email'];				
			$data['getUsersInfo'] = $this->admin_model->usersInInfo($user_email);	
			$data["id"] = $id;							
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/edit_vehicle_image', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}	
	}

	public function copy_vehicle_image($id){
		$data = array();
		if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = 'Vehicles > <strong>Upadte Vehicle Images</strong>';	
			$data["getAllMakeNames"] = $this->admin_model->getAllMakeNames();
			$data["vehicles_images_info"] = $this->admin_model->get_vehicles_images_info($id);
			$user_data = $this->session->userdata['login_user'];
			$user_email = $user_data['email'];				
			$data['getUsersInfo'] = $this->admin_model->usersInInfo($user_email);	
			$data["id"] = $id;							
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/copy_vehicle_image', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}	
	}

	public function update_vehicle_images(){
		$data = array();
		if(isset($this->session->userdata['login_user'])){	
			$query = $this->admin_model->update_vehicle_images();
			$this->session->set_flashdata('message_display', 'Data updated successfully');
			redirect('admpro/vehicles/vehicle_images');
		}else{			     
			$this->load->view('admpro/index', $data);
		}	
	}

	public function delete_vehicle_image($id){
		$query = $this->admin_model->delete_vehicle_image($id);
		$this->session->set_flashdata('message_display', 'Data deleted successfully');
		redirect('admpro/vehicles/vehicle_images');
	}
	
	public function add_vh_images(){
		$data = array();
		if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = 'User Submissions > <strong>Images</strong>';			
			$data['get_dev_customer'] = $this->admin_model->get_dev_customer();
			$data["getAllMakeNames"] = $this->admin_model->getAllMakeNames();
			$user_data = $this->session->userdata['login_user'];
			$user_email = $user_data['email'];				
			$data['getUsersInfo'] = $this->admin_model->usersInInfo($user_email);						
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/add_vh_images', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}

	public function vehicles_image_filter_data(){
		$data['get_models'] = $this->admin_model->get_models();
		$data['makeId'] = $this->input->post('makeId');
		$data['modelId'] = $this->input->post('modelId');
		$data['type'] = $this->input->post('type');
		$type =  $this->input->post('type');
		$data['get_years'] = $this->admin_model->filter_vehicle_by_model();	
		if($type == 'modal'){
			$data['get_all_vehicles_images'] = $this->admin_model->vehicles_image_filter_data_make();
		}else if($type =='years'){	
			$data['get_all_vehicles_images'] = $this->admin_model->vehicles_image_filter_data_model();
		}else{
			$data['get_all_vehicles_images'] = $this->admin_model->vehicles_image_filter_data_year();	
		}
		$this->load->view('admpro/vehicles_image_filter_data', $data);
	}

	public function searchVehicleImage(){
		$data['get_models'] = $this->admin_model->get_models();
		$data['makeId'] = $this->input->post('makeId');
		$data['modelId'] = $this->input->post('modelId');
		$data['type'] = $this->input->post('type');
		$data['get_years'] = $this->admin_model->filter_vehicle_by_model();
		$data['sorting'] = 'DESC';
		$data['sorting_by'] = 'Score';
		$data['get_all_vehicles_images'] = $this->admin_model->vehicles_image_filter_data();				
		$this->load->view('admpro/vehicles_image_filter_data', $data);
	}

	public function firebase_update_vehicles_images(){
		$data = array();;
		if(isset($this->session->userdata['login_user'])){			
			$data['subTitle'] = 'Firebase > <strong>Update Vehicle Images</strong>';	
			$data['vehicles_images'] = $this->admin_model->get_all_vehicles_images();			
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/firebase_update_vehicles_images', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}

/*================================= Add Another Code Series ===============================================*/

	public function get_more_code_series(){
		$data['get_t_code_series'] = $this->admin_model->get_t_code_series();
		$this->load->view('admpro/get_more_code_series', $data);
	}
	
	public function update_vehicle_image(){		
		$query = $this->admin_model->update_vehicle_image();
		$this->session->set_flashdata('message_display', 'Data added successfully');
	}





/*--------------------------- Code Series Sorting------------------------------------------*/

	public function code_series_sort(){
		$data['sorting'] = $this->input->post('sorting');
		$data['sorting_by'] = $this->input->post('sorting_by');
		$data['results'] = $this->admin_model->code_series_sort();
		$this->load->view('admpro/code_series_sorting',$data);
	}
	
	public function code_series_uuid_sort(){
		$data['sorting'] = $this->input->post('sorting');
		$data['sorting_by'] = $this->input->post('sorting_by');
		$data['results'] = $this->admin_model->code_series_uuid_sort();
		$this->load->view('admpro/code_series_sorting',$data);
	}
	
	public function HideDMaxcheckbox(){
		$cookies_values = $_POST['remember']; 
		$cookie_name = "dmaxcheckbox_cookie"; 
		if($_POST['remember'] == 1){
			setcookie($cookie_name, $cookies_values, time() + (86400 * 30), "/");
		}else{
			setcookie($cookie_name,'', time() + (86400 * 30), "/");
		}
	}
	
	public function HideImage(){
		$cookies_values = $_POST['remember']; 
		$cookie_name = "hideimage_cookie"; 
		if($_POST['remember'] == 1){
			setcookie($cookie_name, $cookies_values, time() + (86400 * 30), "/");
		}else{
			setcookie($cookie_name,'', time() + (86400 * 30), "/");
		}
	}
	
	public function HideParts(){
		$cookies_values = $_POST['remember']; 
		$cookie_name = "hideParts_cookie"; 
		if($_POST['remember'] == 1){
			setcookie($cookie_name, $cookies_values, time() + (86400 * 30), "/");
		}else{
			setcookie($cookie_name,'', time() + (86400 * 30), "/");
		}
	}
	
	public function HideTypes(){
		$cookies_values = $_POST['remember']; 
		$cookie_name = "hideTypes_cookie"; 
		if($_POST['remember'] == 1){
			setcookie($cookie_name, $cookies_values, time() + (86400 * 30), "/");
		}else{
			setcookie($cookie_name,'', time() + (86400 * 30), "/");
		}
	}
	
	public function show_vehicle_by_type(){
		unset($_SESSION['search_key']);
		unset($_SESSION['model_id']);		
		unset($_SESSION['make_id']);		
		$value = $this->input->post('type');		
		$data['sorting'] = 'DESC';
		$data['sorting_by'] = '';

		$config = array();
		$config["base_url"] = base_url() . "admpro/vehicles/vehicle";
		$total_row = $this->admin_model->show_vehicle_by_type_count($value);
		$config["total_rows"] = $total_row;	
		if(isset($this->session->userdata['vehicles_pagination'])){
			$per_page = $this->session->userdata['vehicles_pagination']; 
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
		$str_links = $this->pagination->create_links();
		$data["links"] = explode('&nbsp;',$str_links);
		$data["totalrows"] = $total_row;

		$result = $this->admin_model->show_vehicle_by_type($config["per_page"],$limt_start);
		if($result){
			$session_data = array('vehicle_type' => $value);
			$this->session->set_userdata('vehicle_filter_type', $session_data);
			$data['results'] = $result;
			$this->load->view('admpro/vehicle_sorting_make',$data);
		}else{
			$session_data = array('vehicle_type' => '');
			$this->session->unset_userdata('vehicle_filter_type', $session_data);
			$this->load->view('admpro/vehicle_sorting_make',$data);
		}
		
		
	}

	public function show_missing_code_series(){
		$value = $this->input->post('type');
		$session_data = array('vehicle_type' => $value);
		$this->session->set_userdata('vehicle_filter_missing', $session_data);
		$data['sorting'] = 'DESC';
		$data['sorting_by'] = '';

		$config = array();
		$config["base_url"] = base_url() . "admpro/vehicles/vehicle";
		$total_row = $this->admin_model->show_missing_code_series_count();
		$config["total_rows"] = $total_row;	
		if(isset($this->session->userdata['vehicles_pagination'])){
			$per_page = $this->session->userdata['vehicles_pagination']; 
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
		$str_links = $this->pagination->create_links();
		$data["links"] = explode('&nbsp;',$str_links);
		$data["totalrows"] = $total_row;
		$data['results'] = $this->admin_model->show_missing_code_series($config["per_page"],$limt_start);
		$this->load->view('admpro/vehicle_sorting_make',$data);
	}

	public function show_missing_images(){
		$value = $this->input->post('type');
		$session_data = array('vehicle_type' => $value);
		$this->session->set_userdata('vehicle_filter_missing', $session_data);
		$data['sorting'] = 'DESC';
		$data['sorting_by'] = '';
		$config = array();
		$config["base_url"] = base_url() . "admpro/vehicles/vehicle";
		$total_row = $this->admin_model->show_missing_images_count();
		$config["total_rows"] = $total_row;	
		if(isset($this->session->userdata['vehicles_pagination'])){
			$per_page = $this->session->userdata['vehicles_pagination']; 
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
		$str_links = $this->pagination->create_links();
		$data["links"] = explode('&nbsp;',$str_links);
		$data["totalrows"] = $total_row;
		$data['results'] = $this->admin_model->show_missing_images($config["per_page"],$limt_start);
		$this->load->view('admpro/vehicle_sorting_make',$data);
	}
	
	public function vehicle_types(){
		$data['subTitle'] = 'Vehicle > <strong>Vehicle Types</strong>';
		$data['results'] = $this->admin_model->vehicle_types();						
		$this->load->view('admin_layout/header',$data);
		$this->load->view('admpro/vehicle_types', $data);
		$this->load->view('admin_layout/footer');	
	}
	
	public function add_vehicle_type(){
		$data['subTitle'] = 'Vehicle > <strong>Add Vehicle Types</strong>';
		$data['results'] = $this->admin_model->vehicle_types();						
		$this->load->view('admin_layout/header',$data);
		$this->load->view('admpro/add_vehicle_type', $data);
		$this->load->view('admin_layout/footer');	
	}
	
	public function save_vehicle_type(){
		$query = $this->admin_model->save_vehicle_type();
		$this->session->set_flashdata('message_display', 'Data added successfully');
		redirect('admpro/vehicles/add_vehicle_type');
	}
	
	public function edit_vehicle_type($id){
		$data['subTitle'] = 'Vehicle > <strong>Update Vehicle Types</strong>';
		$data['id'] = $id;
		$data['vehicle_types_info'] = $this->admin_model->vehicle_types_info($id);						
		$this->load->view('admin_layout/header',$data);
		$this->load->view('admpro/edit_vehicle_type', $data);
		$this->load->view('admin_layout/footer');	
	}
	
	public function update_vehicle_type(){
		$query = $this->admin_model->update_vehicle_type();
		$this->session->set_flashdata('message_display', 'Data updated successfully');
		redirect('admpro/vehicles/vehicle_types');	
	}
	
	public function delete_vehicle_type($id){
		$query = $this->admin_model->delete_vehicle_type($id);
		$this->session->set_flashdata('message_display', 'Data deleted successfully');
		redirect('admpro/vehicles/vehicle_types');
	}
	
/*------------------------- OBP Remotes Vehciles----------------------------------------------*/

	public function get_obp_remote_vehicle(){
		$data = array();;
		if(isset($this->session->userdata['login_user'])){
			$data["getAllMakeNames"] = $this->admin_model->getAllMakeNames();		
			$this->load->view('admpro/get_obp_remote_vehicle', $data);		
		}else{			     
			$this->load->view('admpro/index', $data);
		}	
	}
	
	public function select_obp_more_Models(){
		$data['get_models'] = $this->admin_model->get_models();
		$data['makeId'] = $this->input->post('makeId');
		$this->load->view('admpro/get_obp_more_Models', $data);
	}

	/*----------------------------- Tips Tricks Section -----------------------------*/

	public function tip_tricks(){
		$data = array();;
		if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = 'Vehicles > <strong>Tips & Tricks</strong>';
			$config = array();
			$config["base_url"] = base_url() . "admpro/vehicles/tip_tricks";
			$total_row = $this->admin_model->getAllTipsTricksRows();
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
			if($this->uri->segment(4)){
				$page = ($this->uri->segment(4));
				$limt_start = ($page - 1)  * $config["per_page"];
			}else{
				$page = 1;
				$limt_start = 0;
			}
			$data["totalrows"] = $this->admin_model->getAllTipsTricksRows();
			$data['page'] = $page;	
			$data['results'] = $this->admin_model->get_tip_tricks($config["per_page"],$limt_start);
			$str_links = $this->pagination->create_links();
			$data["links"] = explode('&nbsp;',$str_links );	
			$user_data = $this->session->userdata['login_user'];
			$user_email = $user_data['email'];				
			$data['getUsersInfo'] = $this->admin_model->usersInInfo($user_email);					
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/tip_tricks', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}	
	}

	public function add_tip_tricks($us_id = ""){
		$data = array();;
		if(isset($this->session->userdata['login_user'])){	
			$data['subTitle'] = 'Vehicles > <strong>Add Tips & Tricks</strong>';
			$data['us_id'] = $us_id;	
			$user_data = $this->session->userdata['login_user'];
			$user_email = $user_data['email'];				
			$data['getUsersInfo'] = $this->admin_model->usersInInfo($user_email);						
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/add_tip_tricks', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}

	public function save_tip_tricks(){
		$query = $this->admin_model->save_tip_tricks();
		$this->session->set_flashdata('message_display', 'Data added successfully');
		redirect('admpro/vehicles/tip_tricks');
	}
	
	public function edit_tip_tricks($id){
		$data = array();;
		if(isset($this->session->userdata['login_user'])){	
			$data['id'] = $id;
			$data['subTitle'] = 'Vehicles > <strong>Add Tips & Tricks</strong>';	
			$data['method_info'] = $this->admin_model->get_tip_tricks_info($id);
			$user_data = $this->session->userdata['login_user'];
			$user_email = $user_data['email'];				
			$data['getUsersInfo'] = $this->admin_model->usersInInfo($user_email);						
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/edit_tip_tricks', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}
	}
	
	public function copy_tip_tricks($id){
		$data = array();;
		if(isset($this->session->userdata['login_user'])){	
			$data['id'] = $id;
			$data['subTitle'] = 'Vehicles > <strong>Add Tips & Tricks</strong>';	
			$data['method_info'] = $this->admin_model->get_tip_tricks_info($id);
			$user_data = $this->session->userdata['login_user'];
			$user_email = $user_data['email'];				
			$data['getUsersInfo'] = $this->admin_model->usersInInfo($user_email);						
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/copy_tip_tricks', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
		}	
	}

	public function update_tip_tricks(){
		$query = $this->admin_model->update_tip_tricks();
		$this->session->set_flashdata('message_display', 'Data added successfully');
		redirect('admpro/vehicles/tip_tricks');
	}
	
	public function delete_tip_tricks($id){
		$result = $this->admin_model->delete_tip_tricks($id);	
		$this->session->set_flashdata('message_display', 'Data deleted successfully');
		redirect('admpro/vehicles/tip_tricks');	
	}

	public function search_tips_tricks(){
		$data['sorting'] = 'DESC';
		$data['sorting_by'] = 'Score';
		$data['results'] = $this->admin_model->vehicles_tipTricks_filter_data();				
		$this->load->view('admpro/search_tips_tricks', $data);
	}

	public function tips_tricks_sorting(){
		$data['results'] = $this->admin_model->tips_tricks_sorting();
		$data['sorting'] = $this->input->post('sorting');
		$data['sorting_by'] = $this->input->post('sorting_by');	
		$this->load->view('admpro/search_tips_tricks', $data);	
	}

	public function tipTrick_score_order(){
		$order = $this->input->post('order');
		$id = $this->input->post('id');				
		$data['results'] = $this->admin_model->tipTrick_score_order($order,$id);
	}

	public function searhAksUser(){
		$data['get_all_aks_users'] = $this->admin_model->searhAksUser();
		$this->load->view('admpro/searhAksUser',$data);
	}	

	public function vehicle_common_sorting(){
		$data = array();
		if(isset($this->session->userdata['vehicle_filter_type'])){
			$session_data = $this->session->userdata('vehicle_filter_type');
			$vehicle_type = $session_data['vehicle_type'];
		}	
		if(isset($_SESSION['make_id']) && $_SESSION['make_id'] !=""){	
			$makeId = $_SESSION['make_id'];
		}	
		if(isset($_SESSION['model_id']) && isset($_SESSION['make_id']) && $_SESSION['model_id'] !="" && $_SESSION['make_id'] !=""){					
			$makeId = $_SESSION['make_id'];				
			$modelId =$_SESSION['model_id'];
		}
		if(isset($this->session->userdata['vehicle_filter_missing'])){
			$session_data = $this->session->userdata('vehicle_filter_missing');
			$vehicle_type_missing = $session_data['vehicle_type'];
		}
		//echo $makeId.'---'.$modelId;
		$config = array();
		$config["base_url"] = base_url() . "admpro/vehicles/vehicle";
		if(isset($_SESSION['search_key']) && $_SESSION['search_key'] !=""){
			$total_row = 50;
		}else{
			$total_row = $this->admin_model->vehicle_common_sorting_count($vehicle_type,$makeId,$modelId,$vehicle_type_missing);
		}	
		$config["total_rows"] = $total_row;		
		if(isset($this->session->userdata['vehicles_pagination'])){
			$per_page = $this->session->userdata['vehicles_pagination']; 
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
		$data['totalrows'] = $total_row;
		$data['sorting'] = $this->input->post('sorting');
		$data['sorting_by'] = $this->input->post('sorting_by');
		$sort = $this->input->post('sorting');
		$sorting_by = $this->input->post('sorting_by');
		$_SESSION['global_sorting'] = $sorting_by." ".$sort;
		if(isset($_SESSION['search_key']) && $_SESSION['search_key'] !=""){
			$data['results'] = $this->admin_model->search_vehicles();
		}else{
			$data['results'] = $this->admin_model->vehicle_common_sorting($config["per_page"],$limt_start,$vehicle_type,$makeId,$modelId,$vehicle_type_missing);
		}
		$str_links = $this->pagination->create_links();
		$data["links"] = explode('&nbsp;',$str_links );	
		$this->load->view('admpro/vehicle_sorting_make',$data);
	}


	public function export_csv_reports(){
		$data = array();
		if(isset($this->session->userdata['login_user'])){
			$data["results"] = $this->admin_model->getAllVehiclesDataForCsvReport();	
			$this->load->view('admpro/export_csv_reports', $data);
		}else{			     
			$this->load->view('admpro/index', $data);
	   }
	}

	public function splits_years($id){
		$data = array();
		if(isset($this->session->userdata['login_user'])){
			$data['vehicleId'] = $id;
			$data['subTitle'] = 'Vehicles > Vehicles > <strong>Years</strong>';
			$results =	$this->admin_model->getAllVehiclesDataInfo($id);
						
				foreach($results as $value){
					
					$years = explode(',',$value['Years']);
					for($y = $years[0];  $y <= $years[count($years)-1]; $y++){
						$years_exists = $this->db->query("SELECT id FROM t_Vehicles WHERE Years='".$y."' AND duplicate_of=".(int)$id."");
						if($years_exists->num_rows() > 0){}else{
							//$q = 'INSERT INTO t_Vehicles(customers_id, fc_name) SELECT customers_id, fc_nam FROM t_Vehicles WHERE id=1';
							$query = $this->db->query('INSERT INTO t_Vehicles (UUID, Vehicle_Type, Model_UUID, Years, Code_Series_UUID, Tumblers, Retainer_UUID, Mechanical_Key_UUID, Chip_Key_UUID, Remote_UUID, RHK_UUID, SmartKey_UUID, Parts_Ignition, Parts_Door, Parts_Accessories, OBD_Location_Text, OBD_Location_Image, APP_System, APP_Add_Keys, APP_All_Keys_Lost, PIN_Read, APP_Programs_Remote, APP_Resync_Available,APP_Confirmed_Working, APP_Notes, MVP_System, MVP_Dongle_UUID, MVP_SmartCard, MVP_Software, MVP_PIN_Required, MVP_PIN_Read, MVP_Notes, HW_Key_Prog, HW_Remote_Prog, HW_Misc_Prog, TKOSDD_System, TKOSDD_SDD_Adapter, TKOSDD_SDD_Cable, TKOSDD_TKO_Cable, TKOSDD_Notes, DMax_System, DMax_Method, ProLok_Tool_UUID, ProLok_Linkage, Vehicle_Image, Image_UUID, image_thumb_url, image_url,duplicate_of)  SELECT "'.md5(uniqid(mt_rand(), true)).'", Vehicle_Type, Model_UUID, "'.$y.'", Code_Series_UUID, Tumblers, Retainer_UUID, Mechanical_Key_UUID, Chip_Key_UUID, Remote_UUID, RHK_UUID, SmartKey_UUID, Parts_Ignition, Parts_Door, Parts_Accessories, OBD_Location_Text, OBD_Location_Image, APP_System, APP_Add_Keys, APP_All_Keys_Lost, PIN_Read, APP_Programs_Remote, APP_Resync_Available, APP_Confirmed_Working, APP_Notes, MVP_System, MVP_Dongle_UUID, MVP_SmartCard, MVP_Software, MVP_PIN_Required, MVP_PIN_Read, MVP_Notes, HW_Key_Prog, HW_Remote_Prog, HW_Misc_Prog, TKOSDD_System, TKOSDD_SDD_Adapter, TKOSDD_SDD_Cable, TKOSDD_TKO_Cable, TKOSDD_Notes, DMax_System, DMax_Method, ProLok_Tool_UUID, ProLok_Linkage, Vehicle_Image, Image_UUID, image_thumb_url, image_url,"'.$id.'" FROM t_Vehicles v WHERE v.id='.(int)$id.'');
						}
					}
				}
			$data = array(
				'duplicated' => 1
			);	
			$this->db->where('id', $id);
			$data = $this->security->xss_clean($data);
			$this->db->update('t_Vehicles', $data);
			

			$query_db = $this->db->query("SELECT t_Models.Vehicle_Type_UUID,t_Vehicles.image_url,t_Makes.Make_Name,t_Vehicles.UUID,t_Models.Model_Name,t_Vehicles.id,t_Vehicles.Model_UUID,t_Vehicles.Years,t_Vehicles.Code_Series_UUID,t_Vehicles.Retainer_UUID,t_Vehicles.Mechanical_Key_UUID,t_Vehicles.Chip_Key_UUID,t_Vehicles.Remote_UUID,t_Vehicles.RHK_UUID,t_Vehicles.SmartKey_UUID,t_Vehicles.MVP_System,t_Vehicles.MVP_Dongle_UUID,t_Vehicles.MVP_SmartCard,t_Vehicles.MVP_Software,t_Vehicles.MVP_PIN_Required,t_Vehicles.MVP_PIN_Read,t_Vehicles.ProLok_Tool_UUID,t_Vehicles.ProLok_Linkage,t_Vehicles.Vehicle_Image,t_Vehicles.Image_UUID,t_Vehicles.MVP_Notes,t_Vehicles.APP_System,t_Vehicles.APP_Add_Keys,t_Vehicles.APP_All_Keys_Lost,t_Vehicles.APP_Notes,t_Vehicles.HW_Key_Prog,t_Vehicles.HW_Remote_Prog,t_Vehicles.HW_Misc_Prog,t_Vehicles.TKOSDD_System,t_Vehicles.TKOSDD_SDD_Adapter,t_Vehicles.TKOSDD_SDD_Cable,t_Vehicles.TKOSDD_TKO_Cable,t_Vehicles.TKOSDD_Notes,t_Vehicles.APP_Confirmed_Working,t_Vehicles.DMax_System,t_Vehicles.DMax_Method,t_Vehicles.Parts_Ignition,t_Vehicles.Parts_Door,t_Vehicles.Parts_Accessories,t_Vehicles.Vehicle_Type,t_Vehicles.Tumblers,t_Vehicles.OBD_Location_Text,t_Vehicles.OBD_Location_Image,t_Vehicles.APP_Programs_Remote,t_Vehicles.APP_Resync_Available,t_Vehicles.PIN_Read FROM t_Makes JOIN  t_Models ON t_Makes.UUID = t_Models.Make_UUID JOIN t_Vehicles ON  t_Models.UUID = t_Vehicles.Model_UUID WHERE t_Vehicles.duplicate_of=?   ORDER BY t_Makes.Make_Name,t_Models.Model_Name,t_Vehicles.Years",array($id));

			$data['results'] =	 $query_db->result_array();
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/splits_years', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
	   }
	}

	public function view_splits_years($id){
		$data = array();
		if(isset($this->session->userdata['login_user'])){
			$data['vehicleId'] = $id;
			$data['subTitle'] = 'Vehicles > Vehicles > <strong>Years</strong>';
			$query_db = $this->db->query("SELECT t_Models.Vehicle_Type_UUID,t_Vehicles.image_url,t_Makes.Make_Name,t_Vehicles.UUID,t_Models.Model_Name,t_Vehicles.id,t_Vehicles.Model_UUID,t_Vehicles.Years,t_Vehicles.Code_Series_UUID,t_Vehicles.Retainer_UUID,t_Vehicles.Mechanical_Key_UUID,t_Vehicles.Chip_Key_UUID,t_Vehicles.Remote_UUID,t_Vehicles.RHK_UUID,t_Vehicles.SmartKey_UUID,t_Vehicles.MVP_System,t_Vehicles.MVP_Dongle_UUID,t_Vehicles.MVP_SmartCard,t_Vehicles.MVP_Software,t_Vehicles.MVP_PIN_Required,t_Vehicles.MVP_PIN_Read,t_Vehicles.ProLok_Tool_UUID,t_Vehicles.ProLok_Linkage,t_Vehicles.Vehicle_Image,t_Vehicles.Image_UUID,t_Vehicles.MVP_Notes,t_Vehicles.APP_System,t_Vehicles.APP_Add_Keys,t_Vehicles.APP_All_Keys_Lost,t_Vehicles.APP_Notes,t_Vehicles.HW_Key_Prog,t_Vehicles.HW_Remote_Prog,t_Vehicles.HW_Misc_Prog,t_Vehicles.TKOSDD_System,t_Vehicles.TKOSDD_SDD_Adapter,t_Vehicles.TKOSDD_SDD_Cable,t_Vehicles.TKOSDD_TKO_Cable,t_Vehicles.TKOSDD_Notes,t_Vehicles.APP_Confirmed_Working,t_Vehicles.DMax_System,t_Vehicles.DMax_Method,t_Vehicles.Parts_Ignition,t_Vehicles.Parts_Door,t_Vehicles.Parts_Accessories,t_Vehicles.Vehicle_Type,t_Vehicles.Tumblers,t_Vehicles.OBD_Location_Text,t_Vehicles.OBD_Location_Image,t_Vehicles.APP_Programs_Remote,t_Vehicles.APP_Resync_Available,t_Vehicles.PIN_Read FROM t_Makes JOIN  t_Models ON t_Makes.UUID = t_Models.Make_UUID JOIN t_Vehicles ON  t_Models.UUID = t_Vehicles.Model_UUID WHERE t_Vehicles.duplicate_of=?   ORDER BY t_Makes.Make_Name,t_Models.Model_Name,t_Vehicles.Years",array($id));

			$data['results'] =	 $query_db->result_array();
			$this->load->view('admin_layout/header',$data);
			$this->load->view('admpro/splits_years', $data);
			$this->load->view('admin_layout/footer');
		}else{			     
			$this->load->view('admpro/index', $data);
	   }
	}
	
}
?>