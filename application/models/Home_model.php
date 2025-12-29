<?php
class Home_model extends CI_Model {

	public function __construct(){
	   $this->load->database();
	   $this->admin_db = $this->load->database('dev_db', true);
	}
	
	public function save_feedback(){
		$Order_Date = date('Y-m-d', strtotime($this->input->post('Date')));
		if($this->input->post('Addressed') == 'on'){
			$Addressed = 'Yes';
		}else{
			$Addressed = 'No';
		}
		$data = array(						
			'Date' => $Order_Date,
			'Vehicle' => $this->input->post('Vehicle'),
			'Description' => $this->input->post('Description'),
			'Submitted_By' => $this->input->post('Submitted_By'),
			'Addressed' => $Addressed,
			'Phone' => $this->input->post('Phone')
		);
		$this->db->insert('t_AutoProPAD_Feedback', $data);
   }
   
   public function get_users_feedback($Phone_cookie_value){
		$query = $this->db->select("*")->where('Phone',$Phone_cookie_value)->order_by('id'.'desc')->get('t_AutoProPAD_Feedback');
		return $query->result_array();    
   }	
   
   public function get_users_feedback_info($id){
		$query = $this->db->select("*")->where('id',$id)->get('t_AutoProPAD_Feedback');
	  return $query->result_array();  
   }
   
   public function update_feedback(){
	    $id = $this->input->post('id');
	    $Order_Date = date('Y-m-d', strtotime($this->input->post('Date')));
		if($this->input->post('Addressed') == 'on'){
			$Addressed = 'Yes';
		}else{
			$Addressed = 'No';
		}
		$data = array(						
			'Date' => $Order_Date,
			'Vehicle' => $this->input->post('Vehicle'),
			'Description' => $this->input->post('Description'),
			'Submitted_By' => $this->input->post('Submitted_By'),
			'Addressed' => $Addressed,
			'Phone' => $this->input->post('Phone')
		);
		$this->db->where('id', $id);
		$this->db->update('t_AutoProPAD_Feedback', $data);
   }
   
   public function get_aks_main_vustomers(){
		$query = $this->db->select("*")->where('customer',1)->order_by('Id','desc')->get('t_Users');
		$return = $query->result_array();
		if($query->num_rows() > 0){
			$last_inserted = $return[0]['User_UUID'];
			$cust_query = $this->db->select("customers.customers_id,customers.customers_referral,customers.customers_password,customers.customers_telephone, customers.customers_email_address,customers.customers_firstname, customers.customers_lastname,customers_info.customers_info_date_account_last_modified")
			->from('customers')
			->join('customers_info', 'customers.customers_id = customers_info.customers_info_id')
			->where('customers.customers_id >', $last_inserted)->get();	
			
		}else{
			$cust_query = $this->db->select("customers.customers_id,customers.customers_referral,customers.customers_password,customers.customers_telephone, customers.customers_email_address,customers.customers_firstname, customers.customers_lastname,customers_info.customers_info_date_account_last_modified")
			->from('customers')
			->join('customers_info', 'customers.customers_id = customers_info.customers_info_id')
			->order_by('customers.customers_id', 'asc')->get();
		}
		return $cust_query->result_array();
   }
   
   public function aks_updated_customer(){
	   $query = $this->db->select("*")->where('customer',1)->get('t_Users');
	   return $query->result_array();
   }
   
   public function aks_all_customer(){
		$cust_query = $this->db->select("customers.customers_id,customers.customers_referral,customers.customers_password,customers.customers_telephone, customers.customers_email_address,customers.customers_firstname, customers.customers_lastname,customers_info.customers_info_date_account_last_modified")
		->from('customers')
		->join('customers_info', 'customers.customers_id = customers_info.customers_info_id')
		->order_by('customers.customers_id', 'asc')->get();
		return $cust_query->result_array(); 
  }

/*------------------------------------ Suppliers Section ----------------------------------------*/

	public function check_supplier($username,$password){
		$query = $this->db->select("*")->where('user_name',$username)->where('password',$password)->get('suppliers');
		return $query->result_array();
	}
	public function total_products ($product_type) {
		$where = '';
		$product_type = explode(',',$product_type);
		for($i = 0; $i < count($product_type); $i++){
			$where .= " p.products_model LIKE '".$product_type[$i]."%' OR";
		}
		$where = rtrim($where,'OR');
		if(isset($_SESSION['product_type']) && $_SESSION['product_type'] !=""){
			$where = " p.products_model LIKE '".$_SESSION['product_type']."%'";
		}
		if(isset($_SESSION['product_search']) && $_SESSION['product_search'] !=""){
			return 0;
		}
		if($this->input->cookie('active_products',true) > 0){
			$active_products = " AND p.products_status = '0'";
		}else{
			$active_products = " AND p.products_status = '1'";
		}
		if($where !=""){
			$query = $this->admin_db->query("SELECT pd.products_id,m.manufacturers_name,p.products_model,pd.products_description,pd.products_name,p.products_price,p.products_cost,p.products_quantity FROM products_description pd JOIN products p ON p.products_id = pd.products_id JOIN manufacturers m ON p.manufacturers_id=m.manufacturers_id WHERE (".$where.") ".$active_products." ");
			return $query->num_rows();
		}else{
			return 0;
		}
		
	}
	public function products ($product_type,$limit,$limt_start) {
		$where = '';
		$product_type = explode(',',$product_type);
		for($i = 0; $i < count($product_type); $i++){
			$where .= " p.products_model LIKE '".$product_type[$i]."%' OR";
		}
		$where = rtrim($where,'OR');
		if(isset($_SESSION['product_type']) && $_SESSION['product_type'] !=""){
			$where = " p.products_model LIKE '".$_SESSION['product_type']."%'";
		}
		if($this->input->cookie('active_products',true) > 0){
			$active_products = " AND p.products_status = '0'";
		}else{
			$active_products = " AND p.products_status = '1'";
		}
		$order_by = 'pd.products_name';
		if( $this->input->cookie('sort',true)){
			$order_by = str_replace('-',' ',$this->input->cookie('sort',true));
		}
		if(isset($_SESSION['product_search']) && $_SESSION['product_search'] !=""){
			$search_where = "(pd.products_name LIKE '%".$_SESSION['product_search']."%' OR 
			pd.products_id LIKE '%".$_SESSION['product_search']."%' OR p.products_model LIKE '%".$_SESSION['product_search']."%' )";			
			$query = $this->admin_db->query("SELECT p.products_status,pd.products_id,m.manufacturers_name,p.products_model,pd.products_description,pd.products_name,p.products_price,p.products_cost,p.products_quantity FROM products_description pd JOIN products p ON p.products_id = pd.products_id JOIN manufacturers m ON p.manufacturers_id=m.manufacturers_id WHERE pd.products_id IN ( SELECT p.products_id FROM products p WHERE (".$where.") ".$active_products." ) AND ".$search_where." ORDER BY ".$order_by."");
			return $query->result_array();
		}
		if($where !=""){
			$query = $this->admin_db->query("SELECT p.products_status,pd.products_id,m.manufacturers_name,p.products_model,pd.products_description,pd.products_name,p.products_price,p.products_cost,p.products_quantity FROM products_description pd JOIN products p ON p.products_id = pd.products_id JOIN manufacturers m ON p.manufacturers_id=m.manufacturers_id WHERE (".$where.") ".$active_products." ORDER BY ".$order_by." LIMIT  ".(int)$limt_start.", ".(int)$limit." ");
			return $query->result_array();
		}else{
			return array();
		}
		
	}
}				
?>