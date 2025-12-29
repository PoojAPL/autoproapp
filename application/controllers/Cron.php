<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url' ,'utility_helper','user_helper'));
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('home_model');
	}
	public function index()	{
		$data['aks_customer'] = $this->home_model->get_aks_main_vustomers();
		$data['aks_updated_customer'] = $this->home_model->aks_updated_customer();
		$data['aks_all_customer'] = $this->home_model->aks_all_customer();
		$this->load->view('customer_cron',$data);
	}
}
