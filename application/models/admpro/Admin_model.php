<?php
//error_reporting(0);
class Admin_model extends CI_Model {
        public function __construct(){
             $this->load->database();
			 $this->admin_db = $this->load->database('dev_db', true);
        }

		public function checkuser($username,$password ){			 
			 $query = $this->db->select("user_name,type,UserID,email,password,APP_switcher")->where('email', $username)->where('password', md5($password))->where('APP_switcher', 1)->get('add_user');
			 if($query->num_rows() > 0){
				return $query->result_array();
			 }else{
				$password = hash("sha256", $password); 
				$query = $this->db->select("user_name,type,UserID,email,password,APP_switcher")->where('email', $username)->where('password', $password)->where('APP_switcher', 1)->get('add_user');
				return $query->result_array();
			 } 
			 
		}

		public function admin_logs($UserID,$email){
			$data = array(
				'admin_id' => $UserID,
				'email' => $email,				
				'ip' => $_SERVER['REMOTE_ADDR']
			);
			$data = $this->security->xss_clean($data);			
			$this->db->insert('admin_logs', $data);
		}

		public function users_access_logs(){
			$query = $this->db->select("*")->where('DATE(loginTime)', date('Y-m-d'))->get('admin_logs');
			return $query->result_array();
		}
		public function AddUser(){
			$this->db->cache_delete('admpro', 'manage_user');
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$password_encoded = hash("sha256", $password);
			if($this->input->post('admin_access') == 'on'){
				$admin_access = 1;
			}else{
				$admin_access = 0;
			}
			if( $password  == ""){
				$data = array(
					'user_name' => $this->input->post('user_name'),
					'type' => $this->input->post('select_admin'),
					'email' => $this->input->post('email'),					
					'Company' => $this->input->post('company'),
					'User_uid' => $this->input->post('user_uid'),
					'APP_switcher' =>$admin_access 
				);	
			}else{
				$data = array(
					'user_name' => $this->input->post('user_name'),
					'type' => $this->input->post('select_admin'),
					'email' => $this->input->post('email'),
					'password' => $password_encoded,
					'Company' => $this->input->post('company'), 
					'User_uid' => $this->input->post('user_uid'),
					'APP_switcher' => $admin_access
				);	
			}
			$query = $this->db->select("email")->where('email', $email)->get('add_user');		
			if($query->num_rows() > 0){	
				return 0;				
			}else{	
				$data = $this->security->xss_clean($data);			
				$this->db->insert('add_user', $data);	
				return  $this->db->insert_id();		
			}
	}


	public function check_email($email){
	 	$query = $this->db->select("email")->where('email',$email)->get('add_user');
		$query->result_array();
		if($query->num_rows() > 0){
			return false;
		}else{
			return true;	
		}
	}

	public function getAllusers(){
		$query = $this->db->select("user_name,type,email,password,Company,User_uid,APP_switcher,UserID")->order_by('user_name','asc')->get('add_user');
		return $query->result_array();
	}
	
	public function getUsersInfo($id){
		$query = $this->db->select('*')->where('UserID',$id)->get('add_user');
		return $query->result_array();
	}
	
	public function UpdateUser(){
		$this->db->cache_delete('admpro', 'manage_user');
		$this->db->cache_delete('admpro', 'account');
		$userid = $this->input->post('userId');
		$password = $this->input->post('password');
		$password_encoded = hash("sha256", $password);
		
		if($this->input->post('admin_access') == 'on'){
			$admin_access = 1;
		}else{
			$admin_access = 0;
		}
		if( $password  == ""){
			$data = array(
				'user_name' => $this->input->post('user_name'),
				'type' => $this->input->post('select_admin'),
				'email' => $this->input->post('email'),					
				'Company' => $this->input->post('company'),
				'APP_switcher' => $admin_access
			);	
		}else{
			$data = array(
				'user_name' => $this->input->post('user_name'),
				'type' => $this->input->post('select_admin'),
				'email' => $this->input->post('email'),
				'password' => $password_encoded,
				'Company' => $this->input->post('company'),
				'APP_switcher' => $admin_access
			);	
		}
		$this->db->where('UserID', $userid);
		$data = $this->security->xss_clean($data);
		$this->db->update('add_user', $data);
	}
	
	public function deleteUsers($id){
		$this->db->cache_delete('admpro', 'manage_user');
		$this->db->where('UserID', $id);
		$this->db->delete('add_user'); 
	}
	
	
	public function MakesName(){
		$makeUsername = $this->input->post('make_name');
		$uuid =  $this->input->post('uuid');
			$data = array(
				'Make_Name' => $this->input->post('make_name'),
				'UUID'	 => $this->input->post('uuid'),
			);
			$this->db->cache_delete('admpro', 'vehicles');	
			$query = $this->db->select('Make_Name')->where('Make_Name',$makeUsername)->where('UUID',$uuid)->get('t_Makes');
			if($query->num_rows() > 0){
				$this->session->set_flashdata('message_display', 'Email already exits.');	
				return false;				
			}else{
				$data = $this->security->xss_clean($data);
				$this->db->insert('t_Makes', $data);					
				return true;		
			}
	}
	
	
	public function check_MakeName($makesname){
		$query = $this->db->select('*')->where('Make_Name',$makesname)->get('t_Makes');
		$query->result_array();
		if($query->num_rows() > 0){
			return false;
		}else{
			return true;	
		}
	}
	
	
	public function getAllMakeNames(){
		$query = $this->db->select("id,Make_Name,UUID")->order_by('Make_Name','asc')->get('t_Makes');
		return $query->result_array();
	}
	public function getAllMakeNamesRows(){		
		return $this->db->count_all("t_Makes");	
	}
	public function getAllMakeNamesDetail($limit,$limt_start){
		$query = $this->db->select("*")->order_by('Make_Sort','asc')->limit($limit,$limt_start)->get('t_Makes');
		return $query->result_array();
	}
	public function deleteMake($id){
		$this->db->cache_delete('admpro', 'vehicles');
		$query = $this->db->select("*")->where('id',$id)->get('t_Makes');
		$return = $query->result_array();
		$make_uuid = $return[0]['UUID'];
		$query = $this->db->select("*")->where('Make_UUID',$make_uuid)->get('t_Models');
		if($query->num_rows() > 0){
			return 2;
		}else{
			$this->db->where('id', $id);
			$this->db->delete('t_Makes');
		} 
	}
	
	
	public function getMakeInfo($id){
		$query = $this->db->select("*")->where('id',$id)->get('t_Makes');
		return $query->result_array();
	}
	
	
	public function EditMAkesNAme(){
		$this->db->cache_delete('admpro', 'vehicles');
		$make_nameid = $this->input->post('makeID');
		$this->db->cache_delete('admpro', 'vehicles');		
		$data = array(
			'Make_Name' => $this->input->post('make_name')
		);		
		$this->db->where('id', $make_nameid);
		$data = $this->security->xss_clean($data);
		$this->db->update('t_Makes', $data);
		return true;		
	}

    public function getAllModel($limit, $limt_start){
		$query = $this->db->select("*")->order_by('Model_Name','asc')->limit($limit,$limt_start)->get('t_Models');
		return $query->result_array();
	}
	
		
	public function getAllModelRows(){
		return $this->db->count_all("t_Models");
	}
	
	
	public function getModelInfo($id){
		$query = $this->db->select("*")->where('id',(int)$id)->get('t_Models');
		return $query->result_array();
	}
	
	
	public function EditModel(){
		$this->db->cache_delete('admpro', 'vehicles');	
		$modelId = $this->input->post('modelID');						
		$data = array(
			'Model_Name' => $this->input->post('model_name'),
			'Make_UUID' => $this->input->post('make_name'),
			'Vehicle_Type_UUID' => $this->input->post('vehicle_type'),			
		);		
		$this->db->where('id' ,(int)$modelId);
		$data = $this->security->xss_clean($data);
		$this->db->update('t_Models', $data);
		return true;	
		
		
	}

	public function deleteModel($id){
		$this->db->cache_delete('admpro', 'vehicles');
		$this->db->where('id', $id);
		$this->db->delete('t_Models'); 
	}
	
	
	public function MakeSortList($orderby){
		$query = $this->db->select("*")->order_by('Make_Name',$orderby)->get('t_Makes');
		return $query->result_array();
	}
	
	
	public function modelName(){
		$this->db->cache_delete('admpro', 'vehicles');
		$modelId = $this->input->post('model_name');
		$makes = $this->input->post('make_name');
			$data = array(
				'Model_Name' => $this->input->post('model_name'),
				'Make_UUID' => $this->input->post('make_name'),
				'UUID' => md5(uniqid(mt_rand(), true)),
				'Vehicle_Type_UUID' =>$this->input->post('vehicle_type')
			);		
			$query = $this->db->select("*")->where('Model_Name',$modelId)->where('Make_UUID',$makes)->get('t_Models');		
			if($query->num_rows() > 0){
				return false;				
			}else{
				$data = $this->security->xss_clean($data);
				$this->db->insert('t_Models', $data);
				return true;		
			}
	}
	
	
	public function makenamesorting($orderby){
		$query = $this->db->select("*")->order_by('Make_UUID',$orderby)->get('t_Models');	
		return $query->result_array();
	}
	
	
	public function getallmakes(){
			$query = $this->db->select("*")->get('t_Makes');
		 return $query->result_array();
	}
	
	
/*----------------------------------------------Add Code_Series-----------------------------------------------*/


	public function AddCode(){		
		$try_out_keys_UUID = "";
		$this->db->cache_delete('admpro', 'vehicles');
		foreach( $this->input->post('TryOutKeys_UUID') as $TryOutKeys_UUID){
			$try_out_keys_UUID .= $TryOutKeys_UUID.',';
		}
		$code_series_name = $this->input->post('code_series_name');
		$data = array(
					'UUID' => md5(uniqid(mt_rand(), true)),
					'Code_Series_Name' => $this->input->post('code_series_name'),
					
					'Spaces' => $this->input->post('space'),
					
					'Depths' => $this->input->post('depth'),
					
					'MACS' => $this->input->post('macs'),
					
					'Key_Style_UUID' => $this->input->post('key_style_uuid'),
										
					'First_Cut' => $this->input->post('first_cut'),
					
					'Space_Between_Cuts' => $this->input->post('space_between_cuts'),
					
					'Code_Series_Notes' => $this->input->post('notes'),
					
					'Determinator_UUID' => $this->input->post('determinator_uuid'),
					
					'Lishi_UUID' => $this->input->post('lishi_uuid'),	
										
					'Accu-Reader_UUID' => $this->input->post('accu_reader_uuid'),
					
					'EEZ-Reader_UUID' => $this->input->post('eez_reader_uuid'),
					
					'SDKeys_UUID' => $this->input->post('sd_keys_uuid'),	
									
					'HPC_Blitz_Card' => $this->input->post('HPC_Blitz_Card'),
					
					'HPC_Blitz_Cutter' => $this->input->post('HPC_Blitz_Cutter'),
					
					'HPC_Blitz_Position' => $this->input->post('HPC_Blitz_Position'),
					
					'HPC_Blitz_Side' => $this->input->post('HPC_Blitz_Side'),
					
					'Silca_Card' => $this->input->post('Silca_Card'),	
							
					'Silca_Cutter' => $this->input->post('Silca_Cutter'),
					
					'HPC_Blitz_Notes' => $this->input->post('HPC_Blitz_Notes'),
										
					'HPC_Punch_Card' => $this->input->post('HPC_Punch_Card'),
					
					'HPC_Punch_Punch' => $this->input->post('HPC_Punch_Punch'),
					
					'HPC_Punch_Side' => $this->input->post('HPC_Punch_Side'),
					
					'HPC_Punch_Notes' => $this->input->post('HPC_Punch_Notes'),
										
					'HPC_CodeMax_DSD' => $this->input->post('HPC_CodeMax_DSD'),
					
					'HPC_CodeMax_Side' => $this->input->post('HPC_CodeMax_Side'),
					
					'HPC_CodeMax_Position' => $this->input->post('HPC_CodeMax_Position'),
					
					'HPC_CodeMax_Cutter' => $this->input->post('HPC_CodeMax_Cutter'),
					
					'HPC_CodeMax_Notes' => $this->input->post('HPC_CodeMax_Notes'),	
											
					'ITL_ID' => $this->input->post('ITL_ID'),
					
					'ITL_Insert' => $this->input->post('ITL_Insert'),
					
					'ITL_Notes' => $this->input->post('ITL_Notes'),
										
					'Curtis_CamSet' => $this->input->post('Curtis_CamSet'),
					'Curtis_Carriage' => $this->input->post('Curtis_Carriage'),
					'Curtis_Cutter' => $this->input->post('Curtis_Cutter'),
					'Curtis_Notes' => $this->input->post('Curtis_Notes'),
					'Keyline_Ninja_Vice' => $this->input->post('Keyline_Ninja_Vice'),
					'Keyline_Ninja_Side' => $this->input->post('Keyline_Ninja_Side'),
					'Keyline_Ninja_Position' => $this->input->post('Keyline_Ninja_Position'),
					'Keyline_Ninja_Cutter' => $this->input->post('Keyline_Ninja_Cutter'),
					'Pak_QCKit' => $this->input->post('Pak_QCKit'),
					'Pak_Vise' => $this->input->post('Pak_Vise'),
					'Pak_Punch' => $this->input->post('Pak_Punch'),
					'Pak_Die' => $this->input->post('Pak_Die'),
					'Framon_Block' => $this->input->post('Framon_Block'),
					'Framon_Cutter' => $this->input->post('Framon_Cutter'),
					'Framon_FirstCut' => $this->input->post('Framon_FirstCut'),
					'Framon_BetweenCuts' => $this->input->post('Framon_BetweenCuts'),
					'Framon_Notes' => $this->input->post('Framon_Notes'),
					'SW2_SpaceRod' => $this->input->post('SW2_SpaceRod'),
					'SW2_DepthRod' => $this->input->post('SW2_DepthRod'),
					'SW2_Cutter' => $this->input->post('SW2_Cutter'),
					'SW2_Guide' => $this->input->post('SW2_Guide'),
					'SW2_ViseSet' => $this->input->post('SW2_ViseSet'),
					'SW2_Stop' => $this->input->post('SW2_Stop'),
					'LKP_3DX_DSD' => $this->input->post('LKP_3DX_DSD'),
					'LKP_3DX_Jaw' => $this->input->post('LKP_3DX_Jaw'),
					'LKP_3DX_Cutter' => $this->input->post('LKP_3DX_Cutter'),
					'Keyline_994_Vise' => $this->input->post('Keyline_994_Vise'),
					'Keyline_994_Side' => $this->input->post('Keyline_994_Side'),
					'Keyline_994_Position' => $this->input->post('Keyline_994_Position'),
					'Keyline_994_Cutter' => $this->input->post('Keyline_994_Cutter'),
					'Silca_Futura_SSN' => $this->input->post('Silca_Futura_SSN'),
					'Silca_Futura_Card' => $this->input->post('Silca_Futura_Card'),
					'Determinator_UUID' => $this->input->post('Determinator_UUID'),
					'Lishi_UUID' => $this->input->post('Lishi_UUID'),
					'Accu-Reader_UUID' => $this->input->post('Accu-Reader_UUID'),
					'EEZ-Reader_UUID' => $this->input->post('EEZ-Reader_UUID'),
					'SDKeys_UUID' => $this->input->post('SDKeys_UUID'),
					'TryOutKeys_UUID' => $try_out_keys_UUID,
					'A1AutoPicks_UUID' => $this->input->post('A1AutoPicks_UUID'),
					'BuildAKey_UUID' => $this->input->post('BuildAKey_UUID'),
					'LKP_3DX_JawClamp' => $this->input->post('LKP_3DX_JawClamp'),
					'LKP_3DX_Stop' => $this->input->post('LKP_3DX_Stop'),
					'LKP_3DX_Notes' => $this->input->post('LKP_3DX_Notes'),
					'Condor_KeyName' => $this->input->post('Condor_KeyName'),
					'Condor_Cutter' => $this->input->post('Condor_Cutter'),
					'Condor_Jaw' => $this->input->post('Condor_Jaw'),
					'Condor_JawSide' => $this->input->post('Condor_JawSide'),
					'Condor_Stop' => $this->input->post('Condor_Stop'),
					'Condor_Notes' => $this->input->post('Condor_Notes')
		);	
		$exist_query = $this->db->select("*")->where('Code_Series_Name',$code_series_name)->get('t_Code_Series');		
		if($exist_query->num_rows() > 0){
				return false;				
		}else{	
			$data = $this->security->xss_clean($data);	
			$this->db->insert('t_Code_Series', $data);				
		  return  $this->db->insert_id();
		}
	}
	
	public function update_code_series(){
		$this->db->cache_delete('admpro', 'vehicles');
		$code_series_id = $this->input->post('code_series_id');
		$try_out_keys_UUID = "";
		foreach( $this->input->post('TryOutKeys_UUID') as $TryOutKeys_UUID){
			$try_out_keys_UUID .= $TryOutKeys_UUID.',';
		}
		$data = array(					
					'Code_Series_Name' => $this->input->post('code_series_name'),
					
					'Spaces' => $this->input->post('space'),
					
					'Depths' => $this->input->post('depth'),
					
					'MACS' => $this->input->post('macs'),
					
					'Key_Style_UUID' => $this->input->post('key_style_uuid'),
										
					'First_Cut' => $this->input->post('first_cut'),
					
					'Space_Between_Cuts' => $this->input->post('space_between_cuts'),
					
					'Code_Series_Notes' => $this->input->post('notes'),
					
					'Determinator_UUID' => $this->input->post('determinator_uuid'),
					
					'Lishi_UUID' => $this->input->post('lishi_uuid'),	
										
					'Accu-Reader_UUID' => $this->input->post('accu_reader_uuid'),
					
					'EEZ-Reader_UUID' => $this->input->post('eez_reader_uuid'),
					
					'SDKeys_UUID' => $this->input->post('sd_keys_uuid'),	
									
					'HPC_Blitz_Card' => $this->input->post('HPC_Blitz_Card'),
					
					'HPC_Blitz_Cutter' => $this->input->post('HPC_Blitz_Cutter'),
					
					'HPC_Blitz_Position' => $this->input->post('HPC_Blitz_Position'),
					
					'HPC_Blitz_Side' => $this->input->post('HPC_Blitz_Side'),
					
					'Silca_Card' => $this->input->post('Silca_Card'),	
							
					'Silca_Cutter' => $this->input->post('Silca_Cutter'),
					
					'HPC_Blitz_Notes' => $this->input->post('HPC_Blitz_Notes'),
										
					'HPC_Punch_Card' => $this->input->post('HPC_Punch_Card'),
					
					'HPC_Punch_Punch' => $this->input->post('HPC_Punch_Punch'),
					
					'HPC_Punch_Side' => $this->input->post('HPC_Punch_Side'),
					
					'HPC_Punch_Notes' => $this->input->post('HPC_Punch_Notes'),
										
					'HPC_CodeMax_DSD' => $this->input->post('HPC_CodeMax_DSD'),					
					'HPC_CodeMax_Side' => $this->input->post('HPC_CodeMax_Side'),					
					'HPC_CodeMax_Position' => $this->input->post('HPC_CodeMax_Position'),					
					'HPC_CodeMax_Cutter' => $this->input->post('HPC_CodeMax_Cutter'),					
					'HPC_CodeMax_Notes' => $this->input->post('HPC_CodeMax_Notes'),											
					'ITL_ID' => $this->input->post('ITL_ID'),					
					'ITL_Insert' => $this->input->post('ITL_Insert'),					
					'ITL_Notes' => $this->input->post('ITL_Notes'),										
					'Curtis_CamSet' => $this->input->post('Curtis_CamSet'),
					'Curtis_CamSet' => $this->input->post('Curtis_CamSet'),
					'Curtis_Carriage' => $this->input->post('Curtis_Carriage'),
					'Curtis_Cutter' => $this->input->post('Curtis_Cutter'),
					'Curtis_Notes' => $this->input->post('Curtis_Notes'),
					'Keyline_Ninja_Vice' => $this->input->post('Keyline_Ninja_Vice'),
					'Keyline_Ninja_Side' => $this->input->post('Keyline_Ninja_Side'),
					'Keyline_Ninja_Position' => $this->input->post('Keyline_Ninja_Position'),
					'Keyline_Ninja_Cutter' => $this->input->post('Keyline_Ninja_Cutter'),
					'Pak_QCKit' => $this->input->post('Pak_QCKit'),
					'Pak_Vise' => $this->input->post('Pak_Vise'),
					'Pak_Punch' => $this->input->post('Pak_Punch'),
					'Pak_Die' => $this->input->post('Pak_Die'),
					'Framon_Block' => $this->input->post('Framon_Block'),
					'Framon_Cutter' => $this->input->post('Framon_Cutter'),
					'Framon_FirstCut' => $this->input->post('Framon_FirstCut'),
					'Framon_BetweenCuts' => $this->input->post('Framon_BetweenCuts'),
					'Framon_Notes' => $this->input->post('Framon_Notes'),
					'SW2_SpaceRod' => $this->input->post('SW2_SpaceRod'),
					'SW2_DepthRod' => $this->input->post('SW2_DepthRod'),
					'SW2_Cutter' => $this->input->post('SW2_Cutter'),
					'SW2_Guide' => $this->input->post('SW2_Guide'),
					'SW2_ViseSet' => $this->input->post('SW2_ViseSet'),
					'SW2_Stop' => $this->input->post('SW2_Stop'),
					'LKP_3DX_DSD' => $this->input->post('LKP_3DX_DSD'),
					'LKP_3DX_Jaw' => $this->input->post('LKP_3DX_Jaw'),
					'LKP_3DX_Cutter' => $this->input->post('LKP_3DX_Cutter'),
					'Keyline_994_Vise' => $this->input->post('Keyline_994_Vise'),
					'Keyline_994_Side' => $this->input->post('Keyline_994_Side'),
					'Keyline_994_Position' => $this->input->post('Keyline_994_Position'),
					'Keyline_994_Cutter' => $this->input->post('Keyline_994_Cutter'),
					'Silca_Futura_SSN' => $this->input->post('Silca_Futura_SSN'),
					'Silca_Futura_Card' => $this->input->post('Silca_Futura_Card'),
					'Determinator_UUID' => $this->input->post('Determinator_UUID'),
					'Lishi_UUID' => $this->input->post('Lishi_UUID'),
					'Accu-Reader_UUID' => $this->input->post('Accu-Reader_UUID'),
					'EEZ-Reader_UUID' => $this->input->post('EEZ-Reader_UUID'),
					'SDKeys_UUID' => $this->input->post('SDKeys_UUID'),
					'TryOutKeys_UUID' => $try_out_keys_UUID,
					'A1AutoPicks_UUID' => $this->input->post('A1AutoPicks_UUID'),
					'BuildAKey_UUID' => $this->input->post('BuildAKey_UUID'),
					'LKP_3DX_JawClamp' => $this->input->post('LKP_3DX_JawClamp'),
					'LKP_3DX_Stop' => $this->input->post('LKP_3DX_Stop'),
					'LKP_3DX_Notes' => $this->input->post('LKP_3DX_Notes'),
					'Condor_KeyName' => $this->input->post('Condor_KeyName'),
					'Condor_Cutter' => $this->input->post('Condor_Cutter'),
					'Condor_Jaw' => $this->input->post('Condor_Jaw'),
					'Condor_JawSide' => $this->input->post('Condor_JawSide'),
					'Condor_Stop' => $this->input->post('Condor_Stop'),
					'Condor_Notes' => $this->input->post('Condor_Notes')
				);
			$this->db->where('id', $code_series_id);
			$data = $this->security->xss_clean($data);
			$this->db->update('t_Code_Series', $data);
		}
		
		
		
		public function update_determinator(){
			$columnName = $this->input->post('columnName');
			foreach($_POST[$columnName] as $key => $val) {
				$data = array($columnName => $val);
				$this->db->where('id', $key);
				$data = $this->security->xss_clean($data);
				$this->db->update('t_Code_Series', $data);
			}
			$query = $this->db->select("Tool_Name")->where('UUID',$val)->get('t_Tools');
			$return = $query->result_array();
			if(isset($return[0]['Tool_Name'])){
				return $return[0]['Tool_Name'];
			}else{
				return '';
			}			
		}
		
		
		public function getAllCodeSeriesData($limit, $limt_start){
			$query = $this->db->select("*")->order_by('Code_Series_Name','asc')->limit($limit,$limt_start)->get('t_Code_Series');
			return $query->result_array();
		}
		
		public function getAllCodeSeriesRows(){
			return $this->db->count_all("t_Code_Series");
		}
		
		
		public function filter_cs_by_kstyle(){	
			$keyStyleID = $this->input->post('keyStyleID');	
			if($keyStyleID == 'all'){
				$query = $this->db->select("*")->order_by('Code_Series_Name','asc')->get('t_Code_Series');
			}else{	
				$query = $this->db->select("*")->order_by('Code_Series_Name','asc')->where('Key_Style_UUID',$keyStyleID)->get('t_Code_Series');
			}
			return $query->result_array();
		}
		
		public function search_code_series(){
			$search_key = trim($this->input->post('search_key'));
			// $tool_type_id = "";	
			// $manufacturers_query = $this->db->select("*")->like('Manufacturer_Name',$search_key)->get('t_Manufacturers');
			// $manufacturers_query1 = $manufacturers_query->result_array();
			
			// $tool_type_query = $this->db->select("*")->like('Tool_Name',$search_key)->get('t_Tools');
			// $tool_type_query1 = $tool_type_query->result_array();
			
			// if($manufacturers_query->num_rows() > 0){
			// 	$manufacturerer_id = "";
			// 	foreach($manufacturers_query1 as $manufacturerer){
			// 		$manufacturerer_id .= "". $manufacturerer['UUID'].",";
			// 	}
			// 	$manufacturerer_id2 = rtrim($manufacturerer_id,",");
			// 	$query = $this->db->select("*")->where_in('Lishi_UUID',explode(',',$manufacturerer_id2))->get('t_Code_Series');
			// }else if($tool_type_query->num_rows() > 0){
			// 	foreach($tool_type_query1 as $tool_type){
			// 		$tool_type_id .= "". $tool_type['UUID'].",";
			// 	}
			// 	$tool_type2 = rtrim($tool_type_id,",");
			// 	$query = $this->db->select("*")->where_in('SDKeys_UUID',explode(',',$tool_type2))->or_where_in('TryOutKeys_UUID',explode(',',$tool_type2))->get('t_Code_Series');
			// }else{	
			// 	$sql = "SELECT * FROM  t_Code_Series WHERE Code_Series_Name LIKE ? OR HPC_Blitz_Card LIKE  ? OR HPC_Punch_Card LIKE ?";
			// 	$query = $this->db->query($sql, array($search_key, $search_key, $search_key));
			// }
			$sql = "SELECT * FROM  t_Code_Series WHERE Code_Series_Name LIKE '%$search_key%' OR HPC_Blitz_Card LIKE  '%$search_key%' OR HPC_Punch_Card LIKE '%$search_key%'";
			$query = $this->db->query($sql);			
			return $query->result_array();
		}
		

		public function getAllCodeSeries(){
			$query = $this->db->select("*")->order_by('Code_Series_Name','asc')->get('t_Code_Series');
			return $query->result_array();
		}	

		public function getCodeSeries($id){
			$query = $this->db->select("*")->where('id',(int)$id)->get('t_Code_Series');
			return $query->result_array();
		}
		public function EditcodeSeries(){
			$this->db->cache_delete('admpro', 'vehicles');
			$codeId = $this->input->post('codeid');		
			$data = array(
					'Code_Series_Name' => $this->input->post('name'),
					'Spaces'=> $this->input->post('spaces'),
					'Depths'=> $this->input->post('depth'),
					'MACS' => $this->input->post('MACS'),
					'Key_Style_UUID' =>$this->input->post('key_style')
			);		
			$this->db->where('id', $codeId);
			$data = $this->security->xss_clean($data);
			$this->db->update('t_Code_Series', $data);
			return true;
			
		}	
			
/*----------------------------------Delete Code Series--------------------------------------------------------------------*/

    public function DeleteCodeSeries($id){
		$this->db->cache_delete('admpro', 'vehicles');
		$query = $this->db->select("UUID")->where('id',(int)$id)->get('t_Code_Series');
		$return = $query->result_array();
		$code_series_uuid = $return[0]['UUID'];
		$query = $this->db->select("Code_Series_UUID")->where('Code_Series_UUID',$code_series_uuid)->get('t_Vehicles');
		if($query->num_rows() > 0){
			return 2;
		}else{
			$this->db->where('id', $id);
			$this->db->delete('t_Code_Series');
		}  
	}
	
	public function keyStyleAdd(){
		$this->db->cache_delete('admpro', 'keyStyle');
		$name = $this->input->post('name');
		$data = array(
				'Key_Style_Name' => $this->input->post('name'),
				'UUID' => md5(uniqid(mt_rand(), true))
		);		
		$query = $this->db->select("Key_Style_Name")->where('Key_Style_Name',$name)->get('t_Key_Styles');	
		if($query->num_rows() > 0){
			$this->session->set_flashdata('message_display', 'Data already exits.');	
			return false;				
		}else{
			$data = $this->security->xss_clean($data);
			$this->db->insert('t_Key_Styles', $data);				
			return true;		
		}
	}
	
	
	public function getAllkeyStyles(){
		$query = $this->db->select("UUID,Key_Style_Name,id")->order_by('Key_Style_Name','asc')->get('t_Key_Styles');
		return $query->result_array();
	}
	
	
	public function getKeyStyleInfo($id){
		$query = $this->db->select("UUID,Key_Style_Name,id")->where('id',(int)$id)->get('t_Key_Styles');
		return $query->result_array();
	}
	public function EditKeystyle(){
		$this->db->cache_delete('admpro', 'keyStyle');
		$keyStyleID = $this->input->post('keyId');
		$key_style =$this->input->post('keystyle');	
		$data = array(
			'Key_Style_Name' => $this->input->post('keystyle')
		);
		$query = $this->db->select("UUID,Key_Style_Name,id")->where('Key_Style_Name',$key_style)->get('t_Key_Styles');		
		if($query->num_rows() > 0){
			return false;
		}else{
			$this->db->where('id', $keyStyleID);
			$data = $this->security->xss_clean($data);
			$this->db->update('t_Key_Styles', $data);
		}
	}

	public function deletekeystyle($id){
		$this->db->cache_delete('admpro', 'keyStyle');
		$this->db->cache_delete('admpro', 'keyStyle');
		$this->db->where('id', $id);
		$this->db->delete('t_Key_Styles'); 
	}	
	
	public function key_style_sorting(){
		$sort = $this->input->post('sorting');
		$sorting_by = $this->input->post('sorting_by');					
		$query = $this->db->select("UUID,Key_Style_Name,id")->order_by($sorting_by,$sort)->get('t_Key_Styles');
		return $query->result_array();	
	}	
	
	
/*----------------------------------------Add Chips--------------------------------------------------------------*/


	public function ChipsAdd($file_name){
		$this->db->cache_delete('admpro', 'Chips');
		$name = $this->input->post('name');		
		$cloneable = $this->input->post('cloneable');
		$reusable = $this->input->post('reusable');
		$cloning_chip = $this->input->post('cloning_chip');
		$products= $this->input->post('products');
		$products= $this->input->post('products');
		$Clone_With = $this->input->post('Clone_With');
		$clone_With_data = "";
		if( $this->input->post('Clone_With') != ""){
			foreach($Clone_With  as $clone_with){
			     $clone_With_data .= $clone_with.',';
			}			 
		}
		$clone_With_data2 = rtrim($clone_With_data,",");
		
		$Cloning_Machine = $this->input->post('Cloning_Machine');
		$Cloning_Machine_data = "";
		if( $this->input->post('Cloning_Machine') != ""){
			foreach($Cloning_Machine  as $clone_with1){
			     $Cloning_Machine_data .= $clone_with1.',';
			}			 
		}
		$Cloning_Machine_data2 = rtrim($Cloning_Machine_data,",");
		
		$data = array(
				'Chip_Name' => $this->input->post('name'),
				'Chip_Image_Url' => trim($file_name),
				'Clonable' => $this->input->post('cloneable'),
				'Reusable' => $this->input->post('reusable'),
				'CloningChip' => $this->input->post('cloning_chip'),
				'Products' => $this->input->post('products'),
				'UUID' => md5(uniqid(mt_rand(), true)),
				'Cloning_type' => $this->input->post('Cloning_type'),
				'Clone_With' => $clone_With_data2,
				'Cloning_Machine' => $Cloning_Machine_data2,
		);
		$data = $this->security->xss_clean($data);	
		$this->db->insert('t_Chips', $data);
		return true;
	}
	
	public function getAllChips(){
		$query = $this->db->select("*")->order_by('Chip_Name','asc')->get('t_Chips');
		return $query->result_array();
	}
	public function getAllChipsRows(){
  		return $this->db->count_all("t_Chips");	
	}
	public function getAllChipsDetail($limit,$limt_start){
		$query = $this->db->select("*")->order_by('Chip_Name','asc')->limit($limit,$limt_start)->get('t_Chips');
		return $query->result_array();
	}
	
	public function getallChipsInfo($id){
		$query = $this->db->select("*")->where('id',(int)$id)->get('t_Chips');
		return $query->result_array();
	}
	
	public function EditChips($file_name){
		$this->db->cache_delete('admpro', 'Chips');
		$chipsId = $this->input->post('chipsid');
		$Clone_With = $this->input->post('Clone_With');
		$clone_With_data = "";
		if( $this->input->post('Clone_With') != ""){
			foreach($Clone_With  as $clone_with){
			     $clone_With_data .= $clone_with.',';
			}			 
		}
		$clone_With_data2 = rtrim($clone_With_data,",");
		
		$Cloning_Machine = $this->input->post('Cloning_Machine');
		$Cloning_Machine_data = "";
		if( $this->input->post('Cloning_Machine') != ""){
			foreach($Cloning_Machine  as $clone_with1){
			     $Cloning_Machine_data .= $clone_with1.',';
			}			 
		}
		$Cloning_Machine_data2 = rtrim($Cloning_Machine_data,",");
		
		if($file_name == ""){
					$data = array(
					'Chip_Name' => $this->input->post('name'),					
					'Clonable' => $this->input->post('cloneable'),
					'Reusable' => $this->input->post('reusable'),
					'CloningChip' => $this->input->post('cloning_chip'),
					'Products' => $this->input->post('Products'),
					'Cloning_type' => $this->input->post('Cloning_type'),
					'Clone_With' => $clone_With_data2,
				    'Cloning_Machine' => $Cloning_Machine_data2,
			);
		}else{
			$data = array(
					'Chip_Name' => $this->input->post('name'),
					'Chip_Image_Url' => trim($file_name),
					'Clonable' => $this->input->post('cloneable'),
					'Reusable' => $this->input->post('reusable'),
					'CloningChip' => $this->input->post('cloning_chip'),
					'Products' => $this->input->post('Products'),
					'Cloning_type' => $this->input->post('Cloning_type'),
					'Clone_With' => $clone_With_data2,
					'Cloning_Machine' =>$Cloning_Machine_data2,
			);
		}
			$this->db->where('id', $chipsId);
			$data = $this->security->xss_clean($data);
			$this->db->update('t_Chips', $data);
			return true;
	}
	
	
	public function Deletechips($id){
		$this->db->cache_delete('admpro', 'Chips');
		$this->db->where('id', $id);
		$this->db->delete('t_Chips'); 
	}
	
	
/*-----------------------------------------------------Add key Type----------------------------------------------------------*/



	public function keyTypeAdd(){
		$this->db->cache_delete('admpro', 'keyType');
		$name = $this->input->post('name');
		$data = array(
				'Key_Type_Name' => $this->input->post('name'),
				'UUID' => md5(uniqid(mt_rand(), true))
		);		
		$query = $this->db->select("Key_Type_Name")->where('Key_Type_Name',$name)->get('t_Key_Types');		
		if($query->num_rows() > 0){
			$this->session->set_flashdata('message_display', ' key type already exits.');	
			return false;				
		}else{
			$data = $this->security->xss_clean($data);
			$this->db->insert('t_Key_Types', $data);
			return true;		
		}
	}


	public function getAllkeyType(){
		$query = $this->db->select("*")->order_by('Key_Type_Name','asc')->get('t_Key_Types');
		return $query->result_array();
	}
	
	
	public function getKeyTypeInfo($id){
		$query = $this->db->select("*")->where('id',(int)$id)->get('t_Key_Types');
		return $query->result_array();
	}
	public function EditKeyType(){
		$this->db->cache_delete('admpro', 'keyType');
		$keytypeId = $this->input->post('keyId');
		$key_type =	$this->input->post('keystyle');
		$data = array(
			'Key_Type_Name' => $this->input->post('keystyle')
		);	
		$query = $this->db->select("Key_Type_Name")->where('Key_Type_Name',$key_type)->get('t_Key_Types');		
		if($query->num_rows() > 0){
			return false;	
		}else{			
			$this->db->where('id', $keytypeId);
			$data = $this->security->xss_clean($data);
			$this->db->update('t_Key_Types', $data);
			return true;
		}
	}
	
	public function deletetypekey($id){
		$this->db->cache_delete('admpro', 'keyType');
		$this->db->where('id', $id);
		$this->db->delete('t_Key_Types'); 
	}
	
	public function key_type_sorting(){
		$sort = $this->input->post('sorting');
		$sorting_by = $this->input->post('sorting_by');		
		$query = $this->db->select("*")->order_by($sorting_by,$sort)->get('t_Key_Types');
		return $query->result_array();
	}
	
/*--------------------------------------- Search pages--------------------------------------------*/



	public function getallModels($search_pages){
		$query = $this->db->select("*")->limit($search_pages)->get('t_Models');
		return $query->result_array();
	}	
	
	
/*-------------------------------------------Manufacturer---------------------------------------*/


	public function getAllManufacturer(){
		$query = $this->db->select("*")->order_by('Manufacturer_Name','asc')->get('t_Manufacturers');
		return $query->result_array();
	}
	public function getAllManufacturersRows(){  		
		return $this->db->count_all("t_Manufacturers");	
	}
	public function getAllManufacturersDetail($limit,$limt_start){
		$query = $this->db->select("*")->order_by('Manufacturer_Name','asc')->limit($limit,$limt_start)->get('t_Manufacturers');
		return $query->result_array();
	}
	

/*========================================= Filter function =======================*/


	public function filter_by_makes(){
		$make_uuid = $this->input->post('make_uuid');
		if( $make_uuid == 'all'){
			if(isset($this->session->userdata['pagination_per_page'])){
				$per_page = $this->session->userdata['pagination_per_page']; 
				$limit = $per_page['per_page'];
			}else{
				$limit = 50;
			}
			$query = $this->db->select("*")->limit($limit)->get('t_Models');
		}else{
			$query = $this->db->select("*")->where('Make_UUID',$make_uuid)->get('t_Models');
		}
		return $query->result_array();
	}
	
	
	public function search_makes(){
		$makes_id = "";
		$search_key = $this->input->post('search_key');	
		$make_query = $this->db->select("*")->like('Make_Name',$search_key)->get('t_Makes');
		$make_query1 = $make_query->result_array();
		if($make_query->num_rows() > 0){
			foreach($make_query1 as $makes){
				$makes_id .= "". $makes['UUID'].",";
			}
			$makes_id2 = rtrim($makes_id,",");
			$query = $this->db->select("*")->where_in('Make_UUID',explode(',',$makes_id2))->get('t_Models');
		}else{	
			$query = $this->db->select("*")->like('Model_Name',$search_key)->get('t_Models');
		}
		return $query->result_array();
	}
	

/*--------------------------------- User Function ------------------------------------------------*/	
	
	public function user_sorting(){	
		$sort = $this->input->post('sorting');	
		$sortby = $this->input->post('sortby');
		$query = $this->db->select("*")->order_by($sortby, $sort)->get('add_user');		
		return $query->result_array();
	}
	
	public function show_userby_types(){
		$type = $this->input->post('type');
		if($type == 'all'){
			$query = $this->db->select("*")->get('add_user');
		}else{
			$query = $this->db->select("*")->where('type',$type)->get('add_user');
		}
		return $query->result_array();
	}

	public function search_admin_users(){
		$search_key = $this->input->post('search_key');
		$query = $this->db->query("SELECT * FROM add_user WHERE user_name LIKE '%".$search_key."%' OR type LIKE '%".$search_key."%' OR email LIKE '%".$search_key."%' OR Company LIKE '%".$search_key."%' ");
		
		return $query->result_array();
	}
	
	public function show_userby_access(){
		$type = $this->input->post('type');
		if($type == 'all'){
			$query = $this->db->select("*")->get('add_user');;
		}elseif($type == 0){
			$query = $this->db->select("*")->where('APP_switcher',0)->or_where('APP_switcher',NULL,true)->get('add_user');
		}else{
			$query = $this->db->select("*")->where('APP_switcher',$type)->get('add_user');
		}
		return $query->result_array();
	}
	
	
	public function code_sorting(){
		$sort = $this->input->post('sorting');			
		$query = $this->db->select("*")->order_by('Code_Series_Name',$sort)->get('t_Code_Series');
		return $query->result_array();
	}
	
	

/*------------------------------------------------ add_manufacture ------------------------------------*/
		
	public function add_manufacture(){
		$this->db->cache_delete('admpro', 'manufacturers');
		$uuid = md5(uniqid(mt_rand(), true)); 
		$data = array(
				'UUID' => $uuid,
				'Manufacturer_Name'=> $this->input->post('manufacturer_name'),
		);	
		$data = $this->security->xss_clean($data);	
		$this->db->insert('t_Manufacturers', $data);		
	}	
	
	
	public function getManufacturerInfo($id){
		$query = $this->db->select("*")->where('id',(int)$id)->get('t_Manufacturers');
		return $query->result_array();
	}
	
	public function update_manufacture(){
		$this->db->cache_delete('admpro', 'manufacturers');
		$manu_id = $this->input->post('manu_id'); 
		$data = array(				
				'Manufacturer_Name'=> $this->input->post('manufacturer_name')
		);
		$this->db->where('id',$manu_id);
		$data = $this->security->xss_clean($data);
		$this->db->update('t_Manufacturers', $data);
	}
	
	public function delete_manufacturer($id){
		$this->db->cache_delete('admpro', 'manufacturers');
		$query = $this->db->select("UUID")->where('id',(int)$id)->get('t_Manufacturers');
		$return = $query->result_array();
		$manufacturer_uuid = $return[0]['UUID'];
		$query = $this->db->select("Manufacturer_UUID")->where('Manufacturer_UUID',$manufacturer_uuid)->get('t_Tools');
		if($query->num_rows() > 0){
			return 2;
		}else{
			$this->db->where('id', $id);
			$this->db->delete('t_Manufacturers');
		} 	
	}	
	
	public function manufacturers_sorting(){
		$sort = $this->input->post('sorting');
		$sorting_by = $this->input->post('sorting_by');		
		$query = $this->db->select("*")->order_by($sorting_by, $sort)->get('t_Manufacturers');
		return $query->result_array();
	}
	
/*---------------------------------Add tool type--------------------------*/


	public function Add_toolType(){
		$this->db->cache_delete('admpro', 'tool_type');
		$data = array(
				'Tool_Type_Name' => $this->input->post('tooltype_name'),
				'UUID' => md5(uniqid(mt_rand(), true))
		);
		$data = $this->security->xss_clean($data);		
		$this->db->insert('t_Tool_Types', $data);
			return true;		
		}
		
		
/*--------------------------------------------------------Get tool type------------------------------------------*/


	public function getAllToolType(){
		$query = $this->db->select("*")->order_by('Tool_Type_Name', 'asc')->get('t_Tool_Types');
		return $query->result_array();
	}
	
	public function getAllToolTypeRows(){
  		return $this->db->count_all("t_Tool_Types");	
	}
	public function getAllToolTypeDetail($limit,$limt_start){
		$query = $this->db->select("*")->order_by('Tool_Type_Name', 'asc')->limit($limit,$limt_start)->get('t_Tool_Types');
		return $query->result_array();
	}
	
	public function getToolTypeInfo($id){
		$query = $this->db->select("*")->where('id', (int)$id)->get('t_Tool_Types');
		return $query->result_array();
	}
	
	public function update_tool_type(){
		$this->db->cache_delete('admpro', 'tool_type');
		$toolTypeId = $this->input->post('toolTypeId');
		$data = array(
				'Tool_Type_Name' => $this->input->post('tooltype_name')				
		);
		$this->db->where('id',$toolTypeId);
		$data = $this->security->xss_clean($data);
		$this->db->update('t_Tool_Types', $data);
	}
	
		
/*-------------------------------------------------------Delete Tool type----------------------------------------------*/	


	public function deletetooltype($id){
		$this->db->cache_delete('admpro', 'tool_type');
		$query = $this->db->select("*")->where('id', (int)$id)->get('t_Tool_Types');
		$return = $query->result_array();
		$tooltype_uuid = $return[0]['UUID'];
		$query = $this->db->select("Tool_Type_UUID")->where('Tool_Type_UUID', $tooltype_uuid)->get('t_Tools');
		if($query->num_rows() > 0){
			return 2;
		}else{
			$this->db->where('id', $id);
			$this->db->delete('t_Tool_Types');
		} 	
	}
	
	
	public function tool_type_sorting(){
		$sort = $this->input->post('sorting');			
		$query = $this->db->select("*")->order_by('Tool_Type_Name', $sort)->get('t_Tool_Types');
		return $query->result_array();
	}
	
/*=============================== Manage Toools ===========================================*/
	
	public function getAllTools($limit,$limt_start){
		$query = $this->db->select("*")->order_by('Tool_Name', 'asc')->limit($limit,$limt_start)->get('t_Tools');
		return $query->result_array();
	}
	
	public function getSortAllTools($limit,$limt_start,$sort,$sort_col){
		$makes_id = "";
		$makes_id1 = "";
		if( $sort_col == 'Tool_Type_Name' ){
			$query = $this->db->select("*")->order_by('Tool_Type_Name', $sort)->get('t_Tool_Types');
		}elseif( $sort_col == 'Manufacturer_Name' ){
			$query = $this->db->select("*")->order_by('Manufacturer_Name', $sort)->get('t_Manufacturers');
		}else{
			$query = $this->db->select("*")->order_by($sort_col, $sort)->limit($limit,$limt_start)->get('t_Tools');
		}
		return $query->result_array();
	}
	
	public function getAllToolsInfo(){
		$query = $this->db->select("*")->get('t_Tools');
		return $query->result_array();
	}


	public function save_tool($file_name){
		$this->db->cache_delete('admpro', 'tools');
		$Tool_Type_UUID = $this->input->post('Tool_Type_UUID');
		$Tool_Type_UUID_data = "";
		if( $this->input->post('Tool_Type_UUID') != ""){
			foreach($Tool_Type_UUID  as $clone_with){
			     $Tool_Type_UUID_data .= $clone_with.',';
			}			 
		}
		$Tool_Type_UUID_data2 = rtrim($Tool_Type_UUID_data,",");
		$data = array(
				'UUID' => $this->input->post('UUID'),
				'Tool_Type_UUID' => $Tool_Type_UUID_data2,
				'Manufacturer_UUID' => $this->input->post('manufacture'),
				'Tool_Name' => $this->input->post('tool_name'),
				'Tool_Image_Url' => $file_name,
				'Products' => $this->input->post('product'), 
				'Tool_Note' => $this->input->post('tool_note'),
				'Difficulty' => $this->input->post('Difficulty'),
				'Useful_For' => $this->input->post('Useful_For')
		);
		$data = $this->security->xss_clean($data);		
		$this->db->insert('t_Tools', $data);
		return true;		
	}


	public function delete_tools($id){
		$this->db->cache_delete('admpro', 'tools');
		$this->db->where('id', $id);
		$this->db->delete('t_Tools');
	}
	

	public function tools_sorting(){
		$sort = $this->input->post('sorting');			
		$query = $this->db->select("*")->order_by('Tool_Name',$sort)->get('t_Tools');
		return $query->result_array();	
	}	
	
	public function tools_sorting_by_type(){
		$sort = $this->input->post('sorting');			
		$query = $this->db->select("*")->order_by('Tool_Type_Name',$sort)->get('t_Tool_Types');
		return $query->result_array();	
	}
	
	public function tools_sorting_by_manufacturer(){
		$sort = $this->input->post('sorting');			
		$query = $this->db->select("*")->order_by('Manufacturer_Name',$sort)->get('t_Manufacturers');
		return $query->result_array();
	}
	
	public function select_tools(){
		$types = $this->input->post('types');	
		$columnName = $this->input->post('columnName');
		if($types == 'all'){
			$query = $this->db->select("*")->order_by('Tool_Name','asc')->get('t_Tools');
		}else{			
			$query = $this->db->select("*")->like($columnName,$types)->get('t_Tools');
		}
		return $query->result_array();
	}	
	
	
	public function getAllToolsRows(){		
		return $this->db->count_all("t_Tools");
	}	
	
	
	public function search_tools(){
		$makes_id = "";
		$manufacturer_id = "";
		$search_key = $this->input->post('search_key');	
		
		$make_query = $this->db->select("*")->like('Tool_Type_Name',$search_key)->get('t_Tool_Types');
		$make_query1 = $make_query->result_array();
		
		$manufacturer_query = $this->db->select("*")->like('Manufacturer_Name',$search_key)->get('t_Manufacturers');
		$manufacturer_query1 = $manufacturer_query->result_array();
		if($make_query->num_rows() > 0){
			foreach($make_query1 as $makes){
				$makes_id .= "". $makes['UUID'].",";
			}
			$makes_id2 = rtrim($makes_id,",");
			$query = $this->db->select("*")->where_in('Tool_Type_UUID',explode(',',$makes_id2) )->get('t_Tools');
		}else if($manufacturer_query->num_rows() > 0){
			foreach($manufacturer_query1 as $manufacturer){
				$manufacturer_id .= "". $manufacturer['UUID'].",";
			}
			$manufacturer_id2 = rtrim($manufacturer_id,",");
			$query = $this->db->select("*")->where_in('Manufacturer_UUID',explode(',',$manufacturer_id2) )->get('t_Tools');
		}else{	
			$query = $this->db->select("*")->like('Tool_Name',$search_key)
			->or_like('Products', $search_key)
			->get('t_Tools');
		}
		return $query->result_array();
	}
	
	
	public function chips_sorting(){
		$sort = $this->input->post('sorting');
		$sorting_by = $this->input->post('sorting_by');			
		$query = $this->db->select("*")->order_by($sorting_by ,$sort)->get('t_Chips');
		return $query->result_array();	
	}
	
	public function show_chips_filter(){
		$chip = $this->input->post('chip');	
		if($chip == 2){	
			$query = $this->db->select("*")->where('CloningChip' ,1)->get('t_Chips');
		}else if($chip == 1){	
			$query = $this->db->select("*")->where('CloningChip' ,0)->get('t_Chips');
		}else{
			$query = $this->db->select("*")->order_by('Chip_Name' ,'asc')->get('t_Chips');
		}
		return $query->result_array();
	}
	
	public function getAllChipsByFilter($chip_value){
		$chip = $chip_value;	
		if($chip == 2){	
			$query = $this->db->select("*")->where('CloningChip' ,1)->get('t_Chips');
		}else if($chip == 1){	
			$query = $this->db->select("*")->where('CloningChip' ,0)->get('t_Chips');
		}else{
			$query = $this->db->select("*")->order_by('Chip_Name' ,'asc')->get('t_Chips');
		}
		return $query->result_array();
	}
	
		
	public function getToolsInfo($id){
		$query = $this->db->select("*")->where('id' ,(int)$id)->get('t_Tools');
		return $query->result_array();	
	}
	
	public function update_tool($file_name){
		$this->db->cache_delete('admpro', 'tools');
		$toolid = $this->input->post('toolid');
		$Tool_Type_UUID = $this->input->post('Tool_Type_UUID');
		$Tool_Type_UUID_data = "";
		if( $this->input->post('Tool_Type_UUID') != ""){
			foreach($Tool_Type_UUID  as $clone_with){
			     $Tool_Type_UUID_data .= $clone_with.',';
			}			 
		}
		$Tool_Type_UUID_data2 = rtrim($Tool_Type_UUID_data,",");
		$data = array(				
				'Tool_Type_UUID' =>$Tool_Type_UUID_data2,
				'Manufacturer_UUID' => $this->input->post('manufacture'),
				'Tool_Name' => $this->input->post('tool_name'),
				'Tool_Image_Url' => $file_name,
				'Products' => $this->input->post('product'), 
				'Tool_Note' => $this->input->post('tool_note'),
				'Difficulty' => $this->input->post('Difficulty'),
				'Useful_For' => $this->input->post('Useful_For')
		);	
		$this->db->where('id', $toolid);
		$data = $this->security->xss_clean($data);
		$this->db->update('t_Tools', $data);
	}
	
/*-------------------------------- T_Batteries Module ---------------------------------------*/

	public function getAllbatteries(){
		$query = $this->db->select("*")->order_by('Battery_Name' ,'asc')->get('t_Batteries');
		return $query->result_array();	
	}
	
	public function getAllbatteriesRows(){
		return $this->db->count_all("t_Batteries");	
	}
	public function getAllbatteriesDetail($limit,$limt_start){
		$query = $this->db->select("*")->order_by('Battery_Name' ,'asc')->limit($limit,$limt_start)->get('t_Batteries');
		return $query->result_array();	
	}
	public function save_battery($file_name){
		$this->db->cache_delete('admpro', 'batteries');
		$data = array(
				'UUID' => md5(uniqid(mt_rand(), true)),
				'Battery_Name' => $this->input->post('battery_name'),
				'Battery_Image_Url' => $file_name,
				'Battery_Image_CDN' => '',
				'Products' => $this->input->post('products')
		);		
		$data = $this->security->xss_clean($data);
		$this->db->insert('t_Batteries', $data);
		return true;
	}	
	
	
	public function getAllbatteriesInfo($id){
		$query = $this->db->select("*")->where('id' ,(int)$id)->get('t_Batteries');
		return $query->result_array();
	}
	
	
	public function update_battery($file_name){
		$this->db->cache_delete('admpro', 'batteries');
		$batteryId = $this->input->post('batteryId');
		if($file_name == ""){
			$data = array(				
				'Battery_Name' => $this->input->post('battery_name'),						
				'Products' => $this->input->post('products')				
			);					
		}else{
			$data = array(				
				'Battery_Name' => $this->input->post('battery_name'),						
				'Products' => $this->input->post('products'),
				'Battery_Image_Url' => $file_name
			);
		}
				
		$this->db->where('id', $batteryId);
		$data = $this->security->xss_clean($data);
		$this->db->update('t_Batteries', $data);
	}
	
	public function battery_sorting(){
		$sort = $this->input->post('sorting');
		$sorting_by = $this->input->post('sorting_by');					
		$query = $this->db->select("*")->order_by( $sorting_by ,$sort)->get('t_Batteries');
		return $query->result_array();	
	}
	
	
	public function delete_battery($id){
		$this->db->cache_delete('admpro', 'batteries');
		$query = $this->db->select("*")->where('id' ,(int)$id)->get('t_Batteries');
		$return = $query->result_array();
		$tooltype_uuid = $return[0]['UUID'];
		$query1 = $this->db->select("*")->where('Battery_UUID' ,$tooltype_uuid)->get('t_Remotes');
		if($query1->num_rows() > 0){
			return $query1->result_array();
		}else{
			$this->db->where('id', $id);
			$this->db->delete('t_Batteries');
			return 1;
		} 
	}

/*------------------------------------------------ Keys Module ----------------------------------------*/	
	
	public function getAlkeys($limit,$limt_start){
		$query = $this->db->select("*")->order_by('Key_Name' ,'asc')->limit($limit,$limt_start)->get('t_Keys');
		return $query->result_array();
	}
	
	public function getkeys(){
		$query = $this->db->select("*")->order_by('Key_Name' ,'asc')->get('t_Keys');
		return $query->result_array();
	}
	
	
	public function getAllKyesRows(){
		return $this->db->count_all("t_Keys");
	}
	
	public function save_key($file_name){
		$substitute_vals = "";
		$this->db->cache_delete('admpro', 'keys');
		$this->db->cache_delete('admpro', 'edit_key');
		$Substitute_UUID = $this->input->post('Substitute_UUID');
		foreach( $Substitute_UUID as $value){
			$substitute_vals .= $value.',';
		}
		$slock_type_vals = "";
		$lock_types = $this->input->post('lock_type');
		foreach( $lock_types as $lock_type){
			$slock_type_vals .= $lock_type.',';
		}
		$slock_type_vals2 = rtrim($slock_type_vals,",");
		$data = array(
				'UUID' => md5(uniqid(mt_rand(), true)),
				'Chip_UUID' => $this->input->post('chips'),
				'Key_Name' => $this->input->post('key_name'),
				'Key_Image' => $file_name,
				'Key_Image_CDN' => '',
				'Key_Type_UUID' => $this->input->post('key_type'),
				'Products' => $this->input->post('products'),
				'Key_Shell_UUID' => $this->input->post('Key_Shell_UUID'),
				'TestKey_UUID' => $this->input->post('TestKey_UUID'),
				'Alt_Ilco' => $this->input->post('Alt_Ilco'),
				'Alt_Axxess' => $this->input->post('Alt_Axxess'),
				'Alt_Hillman' => $this->input->post('Alt_Hillman'),
				'Alt_Curtis' => $this->input->post('Alt_Curtis'),
				'Alt_ESP' => $this->input->post('Alt_ESP'),
				'Alt_JMA' => $this->input->post('Alt_JMA'),
				'Alt_Jet' => $this->input->post('Alt_Jet'),
				'Alt_Strattec' => $this->input->post('Alt_Strattec'),
				'Alt_Silca' => $this->input->post('Alt_Silca'),
				'Alt_Taylor' => $this->input->post('Alt_Taylor'),
				'Alt_OEM' => $this->input->post('Alt_OEM'),
				'Substitute_UUID' => $substitute_vals,
				'Alt_Other' => $this->input->post('Alt_Other'),
				'lock_type' => $slock_type_vals2,
				'Replacement_blade' => $this->input->post('Replacement_blade'),
				'ez' => $this->input->post('ez')
		);	
		$data = $this->security->xss_clean($data);	
		$this->db->insert('t_Keys', $data);
		return true;
	}
	
	public function getkeysInfo($id){
		$query = $this->db->select("*")->where('id' ,(int)$id)->get('t_Keys');
		return $query->result_array();
	}
	
	
	public function update_key($file_name){
		$this->db->cache_delete('admpro', 'keys');
		$this->db->cache_delete('admpro', 'edit_key');
		$keyid = $this->input->post('keyid');
		$substitute_vals = "";
		if( count($this->input->post('Substitute_UUID')) > 0){
			$Substitute_UUID = $this->input->post('Substitute_UUID');
			foreach( $Substitute_UUID as $value){
				$substitute_vals .= $value.',';
			}
		}
		$slock_type_vals = "";
		$lock_types = $this->input->post('lock_type');
		foreach( $lock_types as $lock_type){
			$slock_type_vals .= $lock_type.',';
		}
		$slock_type_vals2 = rtrim($slock_type_vals,",");
		if($file_name == ""){
			$data = array(				
				'Chip_UUID' => $this->input->post('chips'),
				'Key_Name' => $this->input->post('key_name'),							
				'Key_Type_UUID' => $this->input->post('key_type'),
				'Products' => $this->input->post('products'),
				'Key_Shell_UUID' => $this->input->post('Key_Shell_UUID'),
				'TestKey_UUID' => $this->input->post('TestKey_UUID'),
				'Alt_Ilco' => $this->input->post('Alt_Ilco'),
				'Alt_Axxess' => $this->input->post('Alt_Axxess'),
				'Alt_Hillman' => $this->input->post('Alt_Hillman'),
				'Alt_Curtis' => $this->input->post('Alt_Curtis'),
				'Alt_ESP' => $this->input->post('Alt_ESP'),
				'Alt_JMA' => $this->input->post('Alt_JMA'),
				'Alt_Jet' => $this->input->post('Alt_Jet'),
				'Alt_Strattec' => $this->input->post('Alt_Strattec'),
				'Alt_Silca' => $this->input->post('Alt_Silca'),
				'Alt_Taylor' => $this->input->post('Alt_Taylor'),
				'Alt_OEM' => $this->input->post('Alt_OEM'),
				'Substitute_UUID' => $substitute_vals,
				'Alt_Other' => $this->input->post('Alt_Other'),
				'lock_type' => $slock_type_vals2,
				'Replacement_blade' => $this->input->post('Replacement_blade'),
				'ez' => $this->input->post('ez')			
			);					
		}else{
			$data = array(				
				'Chip_UUID' => $this->input->post('chips'),
				'Key_Name' => $this->input->post('key_name'),
				'Key_Image' => $file_name,				
				'Key_Type_UUID' => $this->input->post('key_type'),
				'Products' => $this->input->post('products'),
				'Key_Shell_UUID' => $this->input->post('Key_Shell_UUID'),
				'TestKey_UUID' => $this->input->post('TestKey_UUID'), 
				'Alt_Ilco' => $this->input->post('Alt_Ilco'),
				'Alt_Axxess' => $this->input->post('Alt_Axxess'),
				'Alt_Hillman' => $this->input->post('Alt_Hillman'),
				'Alt_Curtis' => $this->input->post('Alt_Curtis'),
				'Alt_ESP' => $this->input->post('Alt_ESP'),
				'Alt_JMA' => $this->input->post('Alt_JMA'),
				'Alt_Jet' => $this->input->post('Alt_Jet'),
				'Alt_Strattec' => $this->input->post('Alt_Strattec'),
				'Alt_Silca' => $this->input->post('Alt_Silca'),
				'Alt_Taylor' => $this->input->post('Alt_Taylor'),
				'Alt_OEM' => $this->input->post('Alt_OEM'),
				'Substitute_UUID' => $substitute_vals, 
				'Alt_Other' => $this->input->post('Alt_Other'),
				'lock_type' => $slock_type_vals2,
				'Replacement_blade' => $this->input->post('Replacement_blade'),
				'ez' => $this->input->post('ez')			
			);
		}				
		$this->db->where('id', $keyid);
		$data = $this->security->xss_clean($data);
		$this->db->update('t_Keys', $data);
	}
	
	public function keys_sorting(){
		$sort = $this->input->post('sorting');
		$sorting_by = $this->input->post('sorting_by');	
		$keytype = $this->input->post('keytype');
		$keylocktype = $this->input->post('keylocktype');	
		$searchkey = $this->input->post('searchkey');
		if($keytype =='all' && $keylocktype == 'all'){
			$query = $this->db->select("*")->order_by($sorting_by ,$sort)->get('t_Keys');
		}else if(($keylocktype !="") && ($keytype !="")){
			$query = $this->db->select("*")->where('lock_type' ,$keylocktype)->order_by($sorting_by ,$sort)->get('t_Keys');
		}elseif(($keytype !="") && ($searchkey !="")){			
			$query = $this->db->select("*")->where('Key_Name' ,$searchkey)->order_by($sorting_by ,$sort)->get('t_Keys');
		}elseif($keytype !='all'){
			$query = $this->db->select("*")->where('Key_Type_UUID' ,$keytype)->order_by($sorting_by ,$sort)->get('t_Keys');
		}else{
			$query = $this->db->select("*")->order_by($sorting_by ,$sort)->get('t_Keys');
		}
		return $query->result_array();	
	}
	
	public function show_keysby_types(){
		$typeUuid = $this->input->post('typeUuid');	
		if($typeUuid == 'all'){
			$query = $this->db->select("*")->order_by('Key_Name' ,'asc')->get('t_Keys');
		}else{		
			$query = $this->db->select("*")->where('Key_Type_UUID' ,$typeUuid)->get('t_Keys');
		}
		return $query->result_array();
	}
	public function show_keysby_lock_types(){
		$typeUuid = $this->input->post('typeUuid');	
		$keybytype = $this->input->post('keybytype');
		if($keybytype !="" &&  $typeUuid !=''){
			if($keybytype == 'all'){
				$query = $this->db->select("*")->where('lock_type' ,$typeUuid)->get('t_Keys');
			}else{
				$query = $query = $this->db->select("*")->where('lock_type' ,$typeUuid)->where('Key_Type_UUID',$keybytype)->get('t_Keys');
			}			
		}elseif($typeUuid == 'all'){
			$query = $this->db->select("*")->order_by('Key_Name' ,'asc')->get('t_Keys');
		}else{		
			$query = $this->db->select("*")->where('lock_type' ,$typeUuid)->get('t_Keys');
		}
		return $query->result_array();
	}
	public function show_session_keysby_types($value_key){
		$typeUuid = $value_key;	
		if($typeUuid == 'all'){
			$query = $this->db->select("*")->order_by('Key_Name' ,'asc')->get('t_Keys');
		}else{		
			$query = $query = $this->db->select("*")->where('Key_Type_UUID' ,$typeUuid)->get('t_Keys');
		}
		return $query->result_array();
	}
	
	public function delete_key($id){
		$this->db->cache_delete('admpro', 'keys');
		$this->db->where('id', $id);
		$this->db->delete('t_Keys');
	}
	
	public function search_kyes(){
		$makes_id = "";
		$search_key = trim($this->input->post('search_key'));		
		$make_query = $query = $this->db->select("*")->like('Chip_Name' ,$search_key)->get('t_Chips');
		$make_query1 = $make_query->result_array();		
		if($make_query->num_rows() > 0){
			foreach($make_query1 as $makes){
				$makes_id .= "". $makes['UUID'].",";
			}
			$makes_id2 = rtrim($makes_id,",");
			$query = $query = $this->db->select("*")->where_in('Chip_UUID' ,explode(',',$makes_id2))->get('t_Keys');
		}else{	
			$query = $this->db->query("SELECT * FROM t_Keys WHERE Key_Name LIKE '%".$search_key."%' OR Products LIKE '%".$search_key."%'  OR Alt_Ilco LIKE '%".$search_key."%' OR Alt_Axxess LIKE '%".$search_key."%' OR Alt_Hillman LIKE '%".$search_key."%' OR Alt_Curtis LIKE '%".$search_key."%' OR Alt_ESP LIKE '%".$search_key."%' OR Alt_JMA LIKE '%".$search_key."%' OR Alt_Jet LIKE '%".$search_key."%' OR Alt_Strattec LIKE '%".$search_key."%' OR Alt_Silca LIKE '%".$search_key."%' OR Alt_Taylor LIKE '%".$search_key."%' OR Alt_OEM LIKE '%".$search_key."%' OR Alt_Other LIKE '%".$search_key."%' ");
		}
		return $query->result_array();
	}
	
	
/*============================================= Remotes Module ================================================================*/
	
	
	public function getAllRemotesRows(){		
		return $this->db->count_all("t_Remotes");
	}
	
	public function getAllRemotes($limit,$limt_start){
		$query = $this->db->select("*")->order_by('Remote_Name' ,'asc')->limit($limit,$limt_start)->get('t_Remotes');
		return $query->result_array();
	}
	
	public function getAllRemoteType(){
		$query = $this->db->select("*")->order_by('Remote_Type_Name' ,'asc')->get('t_Remote_Types');
		return $query->result_array();	
	}
	
	public function save_remote($file_name){
		$buttons_val = "";	
		$this->db->cache_delete('admpro', 'remotes');
		$buttons = $this->input->post('Buttons');
		if(isset($buttons)){	
			foreach($this->input->post('Buttons') as $button){
				$buttons_val .= $button.',';
			}
		}
		$emergency_Keys_val = "";	
		$emergency_Keys1 = $this->input->post('Emergency_Key_UUID');
		if(isset($emergency_Keys1)){	
			foreach($this->input->post('Emergency_Key_UUID') as $emergency_Keys){
				$emergency_Keys_val .= $emergency_Keys.',';
			}
		}
		
		$parts_vehicle_uuids = "";
		$parts_vehicle = $this->input->post('parts_vehicle');
		if(isset($parts_vehicle)){
			foreach($parts_vehicle as $vehicle_uid){
				$parts_vehicle_uuids .= $vehicle_uid.',';
			}
		}
		$parts_vehicle_uuids2 = rtrim($parts_vehicle_uuids,",");
		
		$data = array(
				'UUID' => md5(uniqid(mt_rand(), true)),
				'Battery_UUID' => $this->input->post('Battery_UUID'),
				'Remote_Type_UUID' => $this->input->post('Remote_Type_UUID'),
				'Remote_Name' => $this->input->post('Remote_Name'),
				'Remote_Image_Url' => $file_name,
				'FCCID' => $this->input->post('Fcc_ID'),
				'Frequency' => $this->input->post('Frequency'),
				'Products' => $this->input->post('Products'),
				'Chip_UUID' => $this->input->post('Chips_UUID'),
				'Buttons' => $buttons_val,
				'IC' => $this->input->post('IC'),
				'Shell_UUID' => $this->input->post('Shell_UUID'), 
				'TestKey_UUID' => $this->input->post('TestKey_UUID'), 
				'OEM_Part_Number' =>  $this->input->post('OEM_Part_Number'), 
				'Reusable'	=>  $this->input->post('Reusable'),
				'Emergency_Key_UUID' => $emergency_Keys_val,
				'Vehicles_UUID' => $parts_vehicle_uuids2,
				'ez' =>  $this->input->post('ez')				
		);
		$data = $this->security->xss_clean($data);		
		$this->db->insert('t_Remotes', $data);
		return true;
	}
	
	public function getRemotesInfo($id){
		$query = $this->db->select("*")->where('id' ,(int)$id)->get('t_Remotes');
		return $query->result_array();
	}
	
	public function update_remote($file_name){
		$this->db->cache_delete('admpro', 'remotes');
		$buttons_val = "";
		$remoteId = $this->input->post('remoteId');	
		$buttons = $this->input->post('Buttons');
		if(isset($buttons)){			
			foreach($this->input->post('Buttons') as $button){
				$buttons_val .= $button.',';
			}
		}
		$emergency_Keys_val = "";	
		$emergency_Keys1   = $this->input->post('Emergency_Key_UUID');
		if(isset($emergency_Keys1)){
			foreach($this->input->post('Emergency_Key_UUID') as $emergency_Keys){
				$emergency_Keys_val .= $emergency_Keys.',';
			}
		}
		$parts_vehicle_uuids = "";
		$parts_vehicle = $this->input->post('parts_vehicle');
		if(isset($parts_vehicle)){
			foreach($parts_vehicle as $vehicle_uid){
				$parts_vehicle_uuids .= $vehicle_uid.',';
			}
		}
		$parts_vehicle_uuids2 = rtrim($parts_vehicle_uuids,",");
		$data = array(				
				'Battery_UUID' => $this->input->post('Battery_UUID'),
				'Remote_Type_UUID' => $this->input->post('Remote_Type_UUID'),
				'Remote_Name' => $this->input->post('Remote_Name'),
				'Remote_Image_Url' => $file_name,
				'FCCID' => $this->input->post('Fcc_ID'),
				'Frequency' => $this->input->post('Frequency'),				
				'Products' => $this->input->post('Products'),
				'Chip_UUID' => $this->input->post('Chips_UUID'),			
				'Buttons' => $buttons_val,
				'IC' => $this->input->post('IC'),
				'Shell_UUID' => $this->input->post('Shell_UUID'),
				'TestKey_UUID' => $this->input->post('TestKey_UUID'), 
				'OEM_Part_Number' =>  $this->input->post('OEM_Part_Number'), 
				'Reusable'	=>  $this->input->post('Reusable'),
				'Emergency_Key_UUID' => $emergency_Keys_val,
				'Vehicles_UUID' => $parts_vehicle_uuids2,
				'ez' =>  $this->input->post('ez')	
		);
		$this->db->where('id', $remoteId);
		$data = $this->security->xss_clean($data);
		$this->db->update('t_Remotes', $data);	
	}
	
	public function delete_remote($id){
		$this->db->cache_delete('admpro', 'remotes');
		$query = $this->db->select("*")->where('id' ,(int)$id)->get('t_Remotes');
		$return = $query->result_array();
		$tooltype_uuid = $return[0]['UUID'];
		$query1 = $this->db->select("Remote_UUID")->where('Remote_UUID' ,$tooltype_uuid)->get('t_Vehicles');
		if($query1->num_rows() > 0){
			return $query1->result_array();
		}else{
			$this->db->where('id', $id);
			$this->db->delete('t_Remotes');
			return 1;
		} 
	}
	
	public function remote_type_sorting(){		
		$sort = $this->input->post('sorting');
		$sorting_by = $this->input->post('sorting_by');
		$search_key = trim($this->input->post('search_key'));
		$remoteby_types = trim($this->input->post('remoteby_types'));
		if(($remoteby_types !=="") && ($search_key !="")){
			$query2 = $this->db->select("*")->where('Remote_Type_Name' ,$search_key)->get('t_remote_types');
			$results = $query2->result_array();
			if($query2->num_rows()>0){
				$typeUuid =  $results[0]['UUID'];				
				$query = $this->db->select("*")->where('Remote_Type_UUID' ,$typeUuid)->order_by('Remote_Type_UUID','desc')->get('t_Remotes');
			}
		}elseif($remoteby_types =='all'){
			$query = $this->db->select("*")->order_by($sorting_by, $sort)->get('t_Remotes');
		}elseif($remoteby_types !='all'){
			$query = $this->db->select("*")->where('Remote_Type_UUID', $remoteby_types)->get('t_Remotes');
		}else{
			$query = $this->db->select("*")->order_by($sorting_by, $sort)->get('t_Remotes');
		}
		return $query->result_array();
	}
	
	public function show_remoteby_types(){
		 $typeUuid = $this->input->post('typeUuid');
		if($typeUuid == 'all'){
			$query = $this->db->select("*")->order_by('Remote_Name', 'asc')->limit(50)->get('t_Remotes');
		}else{
			$query = $this->db->select("*")->where('Remote_Type_UUID', $typeUuid)->get('t_Remotes');
		}
		return $query->result_array();
	}
	
	public function search_remotes(){
		$vehicle_id = "";
		$chip_id = "";
		$search_key = trim($this->input->post('search_key'));
		$vehicle_query = $this->db->query("SELECT t_Vehicles.UUID FROM  t_Vehicles 
		 JOIN t_Models ON t_Models.UUID = t_Vehicles.Model_UUID
		LEFT JOIN t_Makes ON t_Makes.UUID = t_Models.Make_UUID WHERE t_Makes.Make_Name LIKE '%".$search_key."%' OR t_Models.Model_Name LIKE '%".$search_key."%' or  t_Vehicles.Years LIKE '%".$search_key."%'");
				
		//chip
		$chip_query = $this->db->query("SELECT * FROM t_Chips WHERE Chip_Name LIKE '%".$search_key."%'");
		$chip_query1 = $chip_query->result_array();
		
		if($vehicle_query->num_rows() > 0){
			$vehicle_query1 = $vehicle_query->result_array();
			$query_parts = array();
			foreach($vehicle_query1 as $vehicle){
				$query_parts[] = "'%".($vehicle['UUID'])."%'";
			}			 
			$string = implode(' OR Vehicles_UUID LIKE ', $query_parts);			
			$query = $this->db->query("SELECT * FROM t_Remotes WHERE Vehicles_UUID LIKE {$string}"); 
			if(!empty($query->result_array())){
				$query = $this->db->query("SELECT * FROM t_Remotes WHERE Vehicles_UUID LIKE {$string}"); 
			}else{
				$query = $this->db->query("SELECT * FROM t_Remotes WHERE Remote_Name LIKE '%".$search_key."%' OR Products LIKE '%".$search_key."%' OR  OEM_Part_Number LIKE '%".$search_key."%' OR FCCID LIKE '%".$search_key."%' OR ez LIKE '%".$search_key."%'  ");
			}
			
		}elseif($chip_query->num_rows() > 0){
			foreach($chip_query1 as $chip){
				$chip_id .= "". $chip['UUID'].",";
			}
			$chip_id2 = rtrim($chip_id,",");
			$query = $this->db->select("*")->where_in('Chip_UUID', explode(',',$chip_id2))->get('t_Remotes');
			if(!empty($query->result_array())){
				$query = $this->db->select("*")->where_in('Chip_UUID', explode(',',$chip_id2))->get('t_Remotes');
			}else{
				$query = $this->db->query("SELECT * FROM t_Remotes WHERE Remote_Name LIKE '%".$search_key."%' OR Products LIKE '%".$search_key."%' OR OEM_Part_Number LIKE '%".$search_key."%' OR FCCID LIKE '%".$search_key."%' OR id LIKE '%".$search_key."%' OR ez LIKE '%".$search_key."%' ");
			}
		}else{	
			$query = $this->db->query("SELECT * FROM t_Remotes WHERE Remote_Name LIKE '%".$search_key."%' OR Products LIKE '%".$search_key."%' OR OEM_Part_Number LIKE '%".$search_key."%' OR FCCID LIKE '%".$search_key."%' OR id LIKE '%".$search_key."%' OR ez LIKE '%".$search_key."%' ");
		}
		return $query->result_array();
	}
		

/*=================================== Remote Types Module ================================================================*/	

	public function save_remote_type(){
		$this->db->cache_delete('admpro', 'remote_types');
		$data = array(
				'UUID' => md5(uniqid(mt_rand(), true)),
				'Remote_Type_Name' => $this->input->post('Remote_Type_Name')
		);		
		$data = $this->security->xss_clean($data);
		$this->db->insert('t_Remote_Types', $data);
		return true;	
	}
	
	public function getRemoteTypeInfo($id){
		$query = $this->db->select("*")->where('id', (int)$id)->get('t_Remote_Types');
		return $query->result_array();
	}
	
	public function update_remote_type(){
		$this->db->cache_delete('admpro', 'remote_types');
		$remoteTypeId = $this->input->post('remoteTypeId');
		$data = array(				
				'Remote_Type_Name' => $this->input->post('Remote_Type_Name')
		);
		$this->db->where('id', $remoteTypeId);
		$data = $this->security->xss_clean($data);
		$this->db->update('t_Remote_Types', $data);
	}
	
	
	public function delete_remote_type($id){
		$this->db->cache_delete('admpro', 'remote_types');
		$this->db->where('id', $id);
		$this->db->delete('t_Remote_Types');
	}
	
	public function m_remote_type_sorting(){
		$sort = $this->input->post('sorting');
		$query = $this->db->select("*")->order_by('Remote_Type_Name',$sort)->get('t_Remote_Types');
		return $query->result_array();
	}



/*================================================= Retainers Module  =============================================================*/	
	
	public function getRetainers(){
		$query = $this->db->select("*")->order_by('Retainer_Name','asc')->get('t_Retainers');
		return $query->result_array();
	}
	
	public function save_retainer(){
		$this->db->cache_delete('admpro', 'retainers');
		$data = array(
				'UUID' => md5(uniqid(mt_rand(), true)),
				'Retainer_Name' => $this->input->post('Retainer_Name'),
				'Retainer_Image_Url' => $this->input->post('Retainer_Image_Url'),
		);	
		$data = $this->security->xss_clean($data);	
		$this->db->insert('t_Retainers', $data);
		return true;
	}
	
	public function getRetainersInfo($id){
		$query = $this->db->select("*")->where('id',(int)$id)->get('t_Retainers');
		return $query->result_array();
	}
	
	public function update_retainer(){
		$this->db->cache_delete('admpro', 'retainers');
		$ratainerId = $this->input->post('ratainerId');
		$data = array(				
				'Retainer_Name' => $this->input->post('Retainer_Name'),
				'Retainer_Image_Url' => $this->input->post('Retainer_Image_Url'),
		);
		$this->db->where('id', $ratainerId);
		$data = $this->security->xss_clean($data);
		$this->db->update('t_Retainers', $data);
	}
	
	public function delete_retainer($id){
		$this->db->cache_delete('admpro', 'retainers');
		$query = $this->db->select("*")->where('id',(int)$id)->get('t_Retainers');
		$return = $query->result_array();
		$tooltype_uuid = $return[0]['UUID'];
		$query = $this->db->select("Retainer_UUID")->where('Retainer_UUID',$tooltype_uuid)->get('t_Vehicles');
		if($query->num_rows() > 0){
			return 2;
		}else{
			$this->db->where('id', $id);
			$this->db->delete('t_Retainers');
		}
	}
	
	public function ratainer_sorting(){
		$sort = $this->input->post('sorting');
		$query = $this->db->select("*")->order_by('Retainer_Name',$sort)->get('t_Retainers');
		return $query->result_array();
	}



/*=============================================== Vahicle Module ============================================*/
	
	
	public function getAllVehiclesRows2($vehicle_type){		
		$query = $this->db->query("SELECT * FROM t_Vehicles JOIN  t_Models ON t_Models.UUID = t_Vehicles.Model_UUID JOIN t_Vehicle_Types ON  t_Vehicle_Types.UUID = t_Models.Vehicle_Type_UUID WHERE t_Vehicle_Types.UUID = ? ", array($vehicle_type));
		return $query->result_array();
	}
	public function getAllVehiclesRows2_Rows($vehicle_type){
		$query = $this->db->query("SELECT * FROM t_Vehicles JOIN  t_Models ON t_Models.UUID = t_Vehicles.Model_UUID JOIN t_Vehicle_Types ON  t_Vehicle_Types.UUID = t_Models.Vehicle_Type_UUID WHERE t_Vehicle_Types.UUID = ? AND duplicate_of=? ", array($vehicle_type, 0));
		return $query->num_rows();
	}
	public function getAllVehiclesRows_Missing_Rows($vehicle_type){
		$query = $this->db->query("SELECT t_Vehicles.id FROM t_Vehicles JOIN t_Models ON t_Models.UUID = t_Vehicles.Model_UUID
		LEFT JOIN t_Makes ON t_Makes.UUID = t_Models.Make_UUID WHERE ".$vehicle_type." IS NULL OR ".$vehicle_type."='' OR ".$vehicle_type."='|' AND duplicate_of=0");	
		return $query->num_rows();
	}
	
	public function getAllVehiclesRows_Missing($limit,$limt_start,$vehicle_type){
		if(isset($_SESSION['global_sorting']) && $_SESSION['global_sorting'] !=""){
			$global_sorting = $_SESSION['global_sorting'];
		}else{
			$global_sorting = "t_Makes.Make_Name, t_Models.Model_Name";
		}	
		$query = $this->db->query("SELECT t_Vehicles.gen,t_Vehicles.Parts_Keys,t_Vehicles.Parts_Chips,t_Vehicles.Parts_Batteries,t_Vehicles.gen_notes,t_Vehicles.duplicated,t_Models.Vehicle_Type_UUID,t_Vehicles.image_url,t_Makes.Make_Name,t_Vehicles.UUID,t_Models.Model_Name,t_Vehicles.id,t_Vehicles.Model_UUID,t_Vehicles.Years,t_Vehicles.Code_Series_UUID,t_Vehicles.Retainer_UUID,t_Vehicles.Mechanical_Key_UUID,t_Vehicles.Chip_Key_UUID,t_Vehicles.Remote_UUID,t_Vehicles.RHK_UUID,t_Vehicles.SmartKey_UUID,t_Vehicles.MVP_System,t_Vehicles.MVP_Dongle_UUID,t_Vehicles.MVP_SmartCard,t_Vehicles.MVP_Software,t_Vehicles.MVP_PIN_Required,t_Vehicles.MVP_PIN_Read,t_Vehicles.ProLok_Tool_UUID,t_Vehicles.ProLok_Linkage,t_Vehicles.Vehicle_Image,t_Vehicles.Image_UUID,t_Vehicles.MVP_Notes,t_Vehicles.APP_System,t_Vehicles.APP_Add_Keys,t_Vehicles.APP_All_Keys_Lost,t_Vehicles.APP_Notes,t_Vehicles.HW_Key_Prog,t_Vehicles.HW_Remote_Prog,t_Vehicles.HW_Misc_Prog,t_Vehicles.TKOSDD_System,t_Vehicles.TKOSDD_SDD_Adapter,t_Vehicles.TKOSDD_SDD_Cable,t_Vehicles.TKOSDD_TKO_Cable,t_Vehicles.TKOSDD_Notes,t_Vehicles.APP_Confirmed_Working,t_Vehicles.DMax_System,t_Vehicles.DMax_Method,t_Vehicles.Parts_Ignition,t_Vehicles.Parts_Door,t_Vehicles.Parts_Accessories,t_Vehicles.Vehicle_Type,t_Vehicles.Tumblers,t_Vehicles.OBD_Location_Text,t_Vehicles.OBD_Location_Image,t_Vehicles.APP_Programs_Remote,t_Vehicles.APP_Resync_Available,t_Vehicles.PIN_Read FROM t_Vehicles JOIN t_Models ON t_Models.UUID = t_Vehicles.Model_UUID 		LEFT JOIN t_Makes ON t_Makes.UUID = t_Models.Make_UUID WHERE ".$vehicle_type." IS NULL OR ".$vehicle_type."='' OR ".$vehicle_type."='|' AND duplicate_of=0 ORDER BY ".$global_sorting." LIMIT  ".(int)$limt_start.", ".(int)$limit." ");	
		return $query->result_array();
	}
	
	public function getAllVehiclesRows(){
		return $this->db->where('duplicated',0)->count_all("t_Vehicles");
	}
	
	public function getAllVehicle_makessRows(){
		return $this->db->count_all("t_Makes");
	}
	
	public function getAllVehiclesData($limit,$limt_start){
		if(isset($_SESSION['global_sorting']) && $_SESSION['global_sorting'] !=""){
			$global_sorting = $_SESSION['global_sorting'];
		}else{
			$global_sorting = "t_Makes.Make_Name, t_Models.Model_Name";
		}
		$query = $this->db->query("SELECT t_Vehicles.gen,t_Vehicles.Parts_Keys,t_Vehicles.Parts_Chips,t_Vehicles.Parts_Batteries,t_Vehicles.gen_notes,t_Vehicles.duplicated,t_Makes.Make_Name,t_Models.Vehicle_Type_UUID,t_Vehicles.image_url,t_Vehicles.UUID,t_Models.Model_Name,t_Vehicles.id,t_Vehicles.Model_UUID,t_Vehicles.Years,t_Vehicles.Code_Series_UUID,t_Vehicles.Retainer_UUID,t_Vehicles.Mechanical_Key_UUID,t_Vehicles.Chip_Key_UUID,t_Vehicles.Remote_UUID,t_Vehicles.RHK_UUID,t_Vehicles.SmartKey_UUID,t_Vehicles.MVP_System,t_Vehicles.MVP_Dongle_UUID,t_Vehicles.MVP_SmartCard,t_Vehicles.MVP_Software,t_Vehicles.MVP_PIN_Required,t_Vehicles.MVP_PIN_Read,t_Vehicles.ProLok_Tool_UUID,t_Vehicles.ProLok_Linkage,t_Vehicles.Vehicle_Image,t_Vehicles.Image_UUID,t_Vehicles.MVP_Notes,t_Vehicles.APP_System,t_Vehicles.APP_Add_Keys,t_Vehicles.APP_All_Keys_Lost,t_Vehicles.APP_Notes,t_Vehicles.HW_Key_Prog,t_Vehicles.HW_Remote_Prog,t_Vehicles.HW_Misc_Prog,t_Vehicles.TKOSDD_System,t_Vehicles.TKOSDD_SDD_Adapter,t_Vehicles.TKOSDD_SDD_Cable,t_Vehicles.TKOSDD_TKO_Cable,t_Vehicles.TKOSDD_Notes,t_Vehicles.APP_Confirmed_Working,t_Vehicles.DMax_System,t_Vehicles.DMax_Method,t_Vehicles.Parts_Ignition,t_Vehicles.Parts_Door,t_Vehicles.Parts_Accessories,t_Vehicles.Vehicle_Type,t_Vehicles.Tumblers,t_Vehicles.OBD_Location_Text,t_Vehicles.OBD_Location_Image,t_Vehicles.APP_Programs_Remote,t_Vehicles.APP_Resync_Available,t_Vehicles.PIN_Read FROM t_Vehicles JOIN t_Models ON t_Models.UUID = t_Vehicles.Model_UUID
		LEFT JOIN t_Makes ON t_Makes.UUID = t_Models.Make_UUID WHERE duplicate_of=0
		ORDER BY ".$global_sorting." LIMIT  ".(int)$limt_start.", ".(int)$limit." ");
		return $query->result_array();
	}

	public function getAllVehiclesDataInfo($vehicle_id){
		if(isset($_SESSION['global_sorting']) && $_SESSION['global_sorting'] !=""){
			$global_sorting = $_SESSION['global_sorting'];
		}else{
			$global_sorting = "t_Makes.Make_Name, t_Models.Model_Name";
		}
		$query = $this->db->query("SELECT t_Vehicles.gen,t_Vehicles.Parts_Keys,t_Vehicles.Parts_Chips,t_Vehicles.Parts_Batteries,t_Vehicles.gen_notes,t_Vehicles.duplicated,t_Models.Vehicle_Type_UUID,t_Vehicles.image_url,t_Makes.Make_Name,t_Vehicles.UUID,t_Models.Model_Name,t_Vehicles.id,t_Vehicles.Model_UUID,t_Vehicles.Years,t_Vehicles.Code_Series_UUID,t_Vehicles.Retainer_UUID,t_Vehicles.Mechanical_Key_UUID,t_Vehicles.Chip_Key_UUID,t_Vehicles.Remote_UUID,t_Vehicles.RHK_UUID,t_Vehicles.SmartKey_UUID,t_Vehicles.MVP_System,t_Vehicles.MVP_Dongle_UUID,t_Vehicles.MVP_SmartCard,t_Vehicles.MVP_Software,t_Vehicles.MVP_PIN_Required,t_Vehicles.MVP_PIN_Read,t_Vehicles.ProLok_Tool_UUID,t_Vehicles.ProLok_Linkage,t_Vehicles.Vehicle_Image,t_Vehicles.Image_UUID,t_Vehicles.MVP_Notes,t_Vehicles.APP_System,t_Vehicles.APP_Add_Keys,t_Vehicles.APP_All_Keys_Lost,t_Vehicles.APP_Notes,t_Vehicles.HW_Key_Prog,t_Vehicles.HW_Remote_Prog,t_Vehicles.HW_Misc_Prog,t_Vehicles.TKOSDD_System,t_Vehicles.TKOSDD_SDD_Adapter,t_Vehicles.TKOSDD_SDD_Cable,t_Vehicles.TKOSDD_TKO_Cable,t_Vehicles.TKOSDD_Notes,t_Vehicles.APP_Confirmed_Working,t_Vehicles.DMax_System,t_Vehicles.DMax_Method,t_Vehicles.Parts_Ignition,t_Vehicles.Parts_Door,t_Vehicles.Parts_Accessories,t_Vehicles.Vehicle_Type,t_Vehicles.Tumblers,t_Vehicles.OBD_Location_Text,t_Vehicles.OBD_Location_Image,t_Vehicles.APP_Programs_Remote,t_Vehicles.APP_Resync_Available,t_Vehicles.PIN_Read FROM t_Makes JOIN  t_Models ON t_Makes.UUID = t_Models.Make_UUID JOIN t_Vehicles ON  t_Models.UUID = t_Vehicles.Model_UUID WHERE t_Vehicles.id=? AND  duplicate_of=?  ORDER BY t_Makes.Make_Name,t_Models.Model_Name",array($vehicle_id,0));
		return $query->result_array();
	}

	public function getAllVehiclesDataCSV(){
		$query = $this->db->query("SELECT t_Vehicles.gen,t_Vehicles.Parts_Keys,t_Vehicles.Parts_Chips,t_Vehicles.Parts_Batteries,t_Vehicles.gen_notes,t_Vehicles.id,t_Makes.Make_Name,t_Models.Model_Name,t_Vehicles.Years,t_Vehicles.Code_Series_UUID,t_Vehicles.APP_System,t_Vehicles.APP_Add_Keys,t_Vehicles.APP_All_Keys_Lost,t_Vehicles.PIN_Read,t_Vehicles.APP_Programs_Remote,t_Vehicles.APP_Resync_Available,t_Vehicles.APP_Notes,t_Vehicles.Vehicle_Image FROM t_Makes JOIN  t_Models ON t_Makes.UUID = t_Models.Make_UUID JOIN t_Vehicles ON  t_Models.UUID = t_Vehicles.Model_UUID   ORDER BY t_Makes.Make_Name,t_Models.Model_Name");
		return $query->result_array();
	}

	public function getAllVehiclesData2($limit,$limt_start,$vehicle_type){
		$query = $this->db->query("SELECT * ,t_Makes.Make_Name ,t_Vehicles.id  AS id FROM t_Vehicles JOIN  t_Models ON t_Models.UUID = t_Vehicles.Model_UUID JOIN t_Vehicle_Types ON  t_Vehicle_Types.UUID = t_Models.Vehicle_Type_UUID LEFT JOIN t_Makes ON t_Makes.UUID = t_Models.Make_UUID WHERE t_Vehicle_Types.UUID = ? AND duplicate_of=? LIMIT  ".(int)$limt_start.", ".(int)$limit." ", array($vehicle_type,0));
		return $query->result_array();
	}
	
	public function getAllvehicles_testData(){
		$query = $this->db->query("SELECT t_Makes.Make_Name,t_Models.UUID,t_Models.Model_Name,t_Vehicles.id,t_Vehicles.APP_All_Keys_Lost FROM t_Makes JOIN  t_Models ON t_Makes.UUID = t_Models.Make_UUID JOIN t_Vehicles ON  t_Models.UUID = t_Vehicles.Model_UUID   ORDER BY t_Vehicles.APP_All_Keys_Lost DESC");
		return $query->result_array();
	}
	public function getfiltermakes($makeId,$limit,$limt_start){
		if( isset($_SESSION['global_sorting']) && $_SESSION['global_sorting'] != ""){
			$sort_column = $_SESSION['global_sorting'];
		}else{
			$sort_column ='t_Makes.Make_Name,t_Models.Model_Name';
		}
	
		$query = $this->db->query("SELECT t_Vehicles.gen,t_Vehicles.Parts_Keys,t_Vehicles.Parts_Chips,t_Vehicles.Parts_Batteries,t_Vehicles.gen_notes,t_Vehicles.duplicated,t_Models.Vehicle_Type_UUID,t_Vehicles.image_url,t_Makes.Make_Name,t_Vehicles.UUID,t_Models.Model_Name,t_Vehicles.id,t_Vehicles.Model_UUID,t_Vehicles.Years,t_Vehicles.Code_Series_UUID,t_Vehicles.Retainer_UUID,t_Vehicles.Mechanical_Key_UUID,t_Vehicles.Chip_Key_UUID,t_Vehicles.Remote_UUID,t_Vehicles.RHK_UUID,t_Vehicles.SmartKey_UUID,t_Vehicles.MVP_System,t_Vehicles.MVP_Dongle_UUID,t_Vehicles.MVP_SmartCard,t_Vehicles.MVP_Software,t_Vehicles.MVP_PIN_Required,t_Vehicles.MVP_PIN_Read,t_Vehicles.ProLok_Tool_UUID,t_Vehicles.ProLok_Linkage,t_Vehicles.Vehicle_Image,t_Vehicles.Image_UUID,t_Vehicles.MVP_Notes,t_Vehicles.APP_System,t_Vehicles.APP_Add_Keys,t_Vehicles.APP_All_Keys_Lost,t_Vehicles.APP_Notes,t_Vehicles.HW_Key_Prog,t_Vehicles.HW_Remote_Prog,t_Vehicles.HW_Misc_Prog,t_Vehicles.TKOSDD_System,t_Vehicles.TKOSDD_SDD_Adapter,t_Vehicles.TKOSDD_SDD_Cable,t_Vehicles.TKOSDD_TKO_Cable,t_Vehicles.TKOSDD_Notes,t_Vehicles.APP_Confirmed_Working,t_Vehicles.DMax_System,t_Vehicles.DMax_Method,t_Vehicles.Parts_Ignition,t_Vehicles.Parts_Door,t_Vehicles.Parts_Accessories,t_Vehicles.Vehicle_Type,t_Vehicles.Tumblers,t_Vehicles.OBD_Location_Text,t_Vehicles.OBD_Location_Image,t_Vehicles.APP_Programs_Remote,t_Vehicles.APP_Resync_Available,t_Vehicles.PIN_Read FROM t_Vehicles JOIN t_Models ON t_Models.UUID = t_Vehicles.Model_UUID
		LEFT JOIN t_Makes ON t_Makes.UUID = t_Models.Make_UUID WHERE t_Makes.UUID=? AND  duplicate_of=?  ORDER BY ".$sort_column." LIMIT  ".(int)$limt_start.", ".(int)$limit." ",array($makeId,0));
		return $query->result_array();
	}
	
	public function get_models(){
		$makeId = $this->input->post('makeId');
		if($makeId =='All'){return 0;}else{
		$query = $this->db->query("SELECT * FROM t_Models WHERE Make_UUID = ? ORDER BY Model_Name",array($makeId));
		return $query->result_array();
		}
	}
	public function get_t_code_series(){		
		$query = $this->db->query("SELECT * FROM t_Code_Series ORDER BY Code_Series_Name ");
		return $query->result_array();
	}
	
	public function save_vehicle(){	
		$this->db->cache_delete('admpro', 'vehicles');
		$series_val = "";
		if($this->input->post('toYear') != ""){
			$year = $this->input->post('fromYear').','. $this->input->post('toYear');
		}else{
			$year = $this->input->post('fromYear');
		}		
		if( isset($_POST['Code_Series_UUID'])){
			$cs = 0;
			foreach( $_POST['Code_Series_UUID'] as $series){
				if(isset($_POST['code_note'][$cs])){
					$code_note = $_POST['code_note'][$cs];
					$series_val .= $series.'|'.$code_note.',';
				}else{
					$series_val .= $series.',';
				}
			    $cs++;	
			}
		}
		$series_val1 = rtrim($series_val,",");		
		$machanical_keys_val = "";
		$machanical_keys_val1  = "";	
		if( isset($_POST['Mechanical_Key_UUID'])){
			foreach( $_POST['Mechanical_Key_UUID'] as $machanical_keys){
				$machanical_keys_val .= $machanical_keys.',';
			}
		}
		$machanical_keys_val1 = rtrim($machanical_keys_val,',');
		
		$Chip_Key_UUID_val  = "";	
		if( isset($_POST['Chip_Key_UUID'])){
			foreach( $_POST['Chip_Key_UUID'] as $Chip_Key_UUID){
				$Chip_Key_UUID_val .= $Chip_Key_UUID.',';
			}
		}
		$Chip_Key_UUID_val1 = rtrim($Chip_Key_UUID_val,',');
		
		$Remote_UUID_val  = "";	
		if( isset($_POST['Remote_UUID'])){
			foreach( $_POST['Remote_UUID'] as $Remote_UUID){
				$Remote_UUID_val .= $Remote_UUID.',';
			}
		}
		$Remote_UUID_val1 = rtrim($Remote_UUID_val,',');
		
		$RHK_UUID_val  = "";	
		if( isset($_POST['RHK_UUID'])){
			foreach( $_POST['RHK_UUID'] as $RHK_UUID){
				$RHK_UUID_val .= $RHK_UUID.',';
			}
		}
		$RHK_UUID_val1 = rtrim($RHK_UUID_val,',');
		
		$SmartKey_UUID_val  = "";	
		if( isset($_POST['SmartKey_UUID'])){
			foreach( $_POST['SmartKey_UUID'] as $SmartKey_UUID){
				$SmartKey_UUID_val .= $SmartKey_UUID.',';
			}
		}
		$SmartKey_UUID_val1 = rtrim($SmartKey_UUID_val,',');
				
		$data = array(
				'UUID' => md5(uniqid(mt_rand(), true)),				
				'Model_UUID' => $this->input->post('Model_UUID'),
				'Years' => $year,
				'Code_Series_UUID' => $series_val1,
				'Retainer_UUID' => $this->input->post('Retainer_UUID'),
				'Mechanical_Key_UUID' => $machanical_keys_val1,
				'Chip_Key_UUID' => $Chip_Key_UUID_val1,
				'Remote_UUID' => $Remote_UUID_val1,
				'RHK_UUID' => $RHK_UUID_val1,
				'SmartKey_UUID' => $SmartKey_UUID_val1,							
				'MVP_System' => $this->input->post('System'),
				'MVP_Dongle_UUID' => $this->input->post('Dongle_UUID'),
				'MVP_SmartCard' => $this->input->post('SmartCard'),
				'MVP_Software' => $this->input->post('TCode_Software'),
				'MVP_PIN_Required' => $this->input->post('PIN_Required'),
				'MVP_PIN_Read' => $this->input->post('MVP_PIN_Read'),
				'MVP_10-Minute_Bypass' => $this->input->post('10-Minute_Bypass'),
				'MVP_Notes' => $this->input->post('MVP_Notes'),
				'ProLok_Tool_UUID' => $this->input->post('ProLok_Tool_UUID'),
				'ProLok_Linkage' => $this->input->post('ProLok_Linkage'),
				'Vehicle_Image' => $this->input->post('Vehicle_Image'),
				'APP_System' => $this->input->post('APP_System'),
				'APP_Add_Keys' => $this->input->post('APP_Add_Keys'),
				'APP_All_Keys_Lost' => $this->input->post('APP_All_Keys_Lost'),
				'APP_10-Minute_Bypass' => $this->input->post('APP_10-Minute_Bypass'),
				'APP_Notes' => $this->input->post('APP_Notes'),
				'HW_Key_Prog' => $this->input->post('HW_Key_Prog'),
				'HW_Remote_Prog' => $this->input->post('HW_Remote_Prog'),
				'HW_Misc_Prog' => $this->input->post('HW_Misc_Prog'),
				'TKOSDD_System' => $this->input->post('TKOSDD_System'),
				'TKOSDD_SDD_Adapter' => $this->input->post('TKOSDD_SDD_Adapter'),
				'TKOSDD_SDD_Cable' => $this->input->post('TKOSDD_SDD_Cable'),
				'TKOSDD_TKO_Cable' => $this->input->post('TKOSDD_TKO_Cable'),
				'TKOSDD_Notes' => $this->input->post('TKOSDD_Notes'),
				'APP_Confirmed_Working' => $this->input->post('APP_Confirmed_Working'),
				'DMax_System' => $this->input->post('DMax_System'),
				'DMax_Method' => $this->input->post('DMax_Method'),
				'Parts_Ignition' => $this->input->post('Parts_Ignition'),
				'Parts_Door' => $this->input->post('Parts_Door'),
				'Parts_Accessories' => $this->input->post('Parts_Accessories'),
				'Tumblers' => $this->input->post('Tumblers'),
				'OBD_Location_Text' => $this->input->post('OBD_Location_Text'),
				'OBD_Location_Image' => $this->input->post('OBD_Location_Image'),
				'PIN_Read' => $this->input->post('PIN_Read'),
				'APP_Programs_Remote' => $this->input->post('APP_Programs_Remote'),
				'APP_Resync_Available' => $this->input->post('APP_Resync_Available')
		);		
		$data = $this->security->xss_clean($data);
		$this->db->insert('t_Vehicles', $data);
		return true;
	}
	
	public function getVehiclesInfo($id){
		$query = $this->db->query("SELECT * FROM t_Vehicles WHERE id =? ", array($id));
		return $query->result_array();
	}
	
	public function update_vehicle(){
		$this->db->cache_delete('admpro', 'vehicles');
		$programm_val = "";
		$vehicleId = $this->input->post('vehicleId');
		if($this->input->post('toYear') != ""){
			$year = $this->input->post('fromYear').','. $this->input->post('toYear');
		}else{
			$year = $this->input->post('fromYear');
		}
		
		/*if( isset($_POST['Programmers_UUID'])){
			foreach( $_POST['Programmers_UUID'] as $programm){
				$programm_val .= $programm.',';
			}
		}*/
		$series_val = "";
		if( isset($_POST['Code_Series_UUID'])){
			$cs = 0;
			foreach( $_POST['Code_Series_UUID'] as $series){
				if(isset($_POST['code_note'][$cs])){
					$code_note = $_POST['code_note'][$cs];
					$series_val .= $series.'|'.$code_note.',';
				}else{
					$series_val .= $series.',';
				}
			    $cs++;	
			}
		}
		$series_val1 = rtrim($series_val,",");
		$machanical_keys_val = "";
		$machanical_keys  = "";	
		if( isset($_POST['Mechanical_Key_UUID'])){
			foreach( $_POST['Mechanical_Key_UUID'] as $machanical_keys){
				$machanical_keys_val .= $machanical_keys.',';
			}
		}
		$machanical_keys_val1 = rtrim($machanical_keys_val,',');
		$Chip_Key_UUID_val  = "";	
		if( isset($_POST['Chip_Key_UUID'])){
			foreach( $_POST['Chip_Key_UUID'] as $Chip_Key_UUID){
				$Chip_Key_UUID_val .= $Chip_Key_UUID.',';
			}
		}
		$Chip_Key_UUID_val1 = rtrim($Chip_Key_UUID_val,',');
		
		$Remote_UUID_val  = "";	
		if( isset($_POST['Remote_UUID'])){
			foreach( $_POST['Remote_UUID'] as $Remote_UUID){
				$Remote_UUID_val .= $Remote_UUID.',';
			}
		}
		$Remote_UUID_val1 = rtrim($Remote_UUID_val,',');
		
		$RHK_UUID_val  = "";	
		if( isset($_POST['RHK_UUID'])){
			foreach( $_POST['RHK_UUID'] as $RHK_UUID){
				$RHK_UUID_val .= $RHK_UUID.',';
			}
		}
		$RHK_UUID_val1 = rtrim($RHK_UUID_val,',');
		
		$SmartKey_UUID_val  = "";	
		if( isset($_POST['SmartKey_UUID'])){
			foreach( $_POST['SmartKey_UUID'] as $SmartKey_UUID){
				$SmartKey_UUID_val .= $SmartKey_UUID.',';
			}
		}
		$SmartKey_UUID_val1 = rtrim($SmartKey_UUID_val,',');
		$data = array(						
				'Model_UUID' => $this->input->post('Model_UUID'),
				'Years' => $year,
				'Code_Series_UUID' => $series_val1,
				'Retainer_UUID' => $this->input->post('Retainer_UUID'),
				'Mechanical_Key_UUID' => $machanical_keys_val1,
				'Chip_Key_UUID' => $Chip_Key_UUID_val1,
				'Remote_UUID' => $Remote_UUID_val1,
				'RHK_UUID' => $RHK_UUID_val1,
				'SmartKey_UUID' => $SmartKey_UUID_val1,							
				'MVP_System' => $this->input->post('System'),
				'MVP_Dongle_UUID' => $this->input->post('Dongle_UUID'),
				'MVP_SmartCard' => $this->input->post('SmartCard'),
				'MVP_Software' => $this->input->post('TCode_Software'),
				'MVP_PIN_Required' => $this->input->post('PIN_Required'),
				'MVP_PIN_Read' => $this->input->post('MVP_PIN_Read'),
				'MVP_10-Minute_Bypass' => $this->input->post('10-Minute_Bypass'),
				'MVP_Notes' => $this->input->post('MVP_Notes'),
				'ProLok_Tool_UUID' => $this->input->post('ProLok_Tool_UUID'),
				'ProLok_Linkage' => $this->input->post('ProLok_Linkage'),
				'Vehicle_Image' => $this->input->post('Vehicle_Image'),
				'APP_System' => $this->input->post('APP_System'),
				'APP_Add_Keys' => $this->input->post('APP_Add_Keys'),
				'APP_All_Keys_Lost' => $this->input->post('APP_All_Keys_Lost'),
				'APP_10-Minute_Bypass' => $this->input->post('APP_10-Minute_Bypass'),
				'APP_Notes' => $this->input->post('APP_Notes'),
				'HW_Key_Prog' => $this->input->post('HW_Key_Prog'),
				'HW_Remote_Prog' => $this->input->post('HW_Remote_Prog'),
				'HW_Misc_Prog' => $this->input->post('HW_Misc_Prog'),
				'TKOSDD_System' => $this->input->post('TKOSDD_System'),
				'TKOSDD_SDD_Adapter' => $this->input->post('TKOSDD_SDD_Adapter'),
				'TKOSDD_SDD_Cable' => $this->input->post('TKOSDD_SDD_Cable'),
				'TKOSDD_TKO_Cable' => $this->input->post('TKOSDD_TKO_Cable'),
				'TKOSDD_Notes' => $this->input->post('TKOSDD_Notes'),
				'APP_Confirmed_Working' => $this->input->post('APP_Confirmed_Working'),
				'DMax_System' => $this->input->post('DMax_System'),
				'DMax_Method' => $this->input->post('DMax_Method'),
				'Parts_Ignition' => $this->input->post('Parts_Ignition'),
				'Parts_Door' => $this->input->post('Parts_Door'),
				'Parts_Accessories' => $this->input->post('Parts_Accessories'),
				'Tumblers' => $this->input->post('Tumblers'),
				'OBD_Location_Text' => $this->input->post('OBD_Location_Text'),
				'OBD_Location_Image' => $this->input->post('OBD_Location_Image'),
				'PIN_Read' => $this->input->post('PIN_Read'),
				'APP_Programs_Remote' => $this->input->post('APP_Programs_Remote'),
				'APP_Resync_Available' => $this->input->post('APP_Resync_Available')
		);	
		$this->db->where('id', $vehicleId);
		$data = $this->security->xss_clean($data);
		$this->db->update('t_Vehicles', $data);	
	}
	
	public function delete_vehicles($id){
		$this->db->cache_delete('admpro', 'vehicles');
		$this->db->where('id', $id);
		$this->db->delete('t_Vehicles');
	}
	
	public function vehicle_sorting_make(){
		//$makes_id = "";		
		$sort = $this->input->post('sorting');
		$makeId = $this->input->post('makeId');
		if($makeId != "" && $makeId !='All'){
			$where = "WHERE t_Makes.UUID='".$makeId."'";
		}
		if(isset($_SESSION['global_sorting']) && $_SESSION['global_sorting'] !=""){
			$global_sorting = $_SESSION['global_sorting'];
		}else{
			$global_sorting = "t_Makes.Make_Name, t_Models.Model_Name";
		}
		$query = $this->db->query("SELECT t_Vehicles.gen,t_Vehicles.Parts_Keys,t_Vehicles.Parts_Chips,t_Vehicles.Parts_Batteries,t_Vehicles.gen_notes,t_Models.Vehicle_Type_UUID,t_Vehicles.image_url,t_Makes.Make_Name,t_Vehicles.UUID,t_Models.Model_Name,t_Vehicles.id,t_Vehicles.Model_UUID,t_Vehicles.Years,t_Vehicles.Code_Series_UUID,t_Vehicles.Retainer_UUID,t_Vehicles.Mechanical_Key_UUID,t_Vehicles.Chip_Key_UUID,t_Vehicles.Remote_UUID,t_Vehicles.RHK_UUID,t_Vehicles.SmartKey_UUID,t_Vehicles.MVP_System,t_Vehicles.MVP_Dongle_UUID,t_Vehicles.MVP_SmartCard,t_Vehicles.MVP_Software,t_Vehicles.MVP_PIN_Required,t_Vehicles.MVP_PIN_Read,t_Vehicles.ProLok_Tool_UUID,t_Vehicles.ProLok_Linkage,t_Vehicles.Vehicle_Image,t_Vehicles.Image_UUID,t_Vehicles.MVP_Notes,t_Vehicles.APP_System,t_Vehicles.APP_Add_Keys,t_Vehicles.APP_All_Keys_Lost,t_Vehicles.APP_Notes,t_Vehicles.HW_Key_Prog,t_Vehicles.HW_Remote_Prog,t_Vehicles.HW_Misc_Prog,t_Vehicles.TKOSDD_System,t_Vehicles.TKOSDD_SDD_Adapter,t_Vehicles.TKOSDD_SDD_Cable,t_Vehicles.TKOSDD_TKO_Cable,t_Vehicles.TKOSDD_Notes,t_Vehicles.APP_Confirmed_Working,t_Vehicles.DMax_System,t_Vehicles.DMax_Method,t_Vehicles.Parts_Ignition,t_Vehicles.Parts_Door,t_Vehicles.Parts_Accessories,t_Vehicles.Vehicle_Type,t_Vehicles.Tumblers,t_Vehicles.OBD_Location_Text,t_Vehicles.OBD_Location_Image,t_Vehicles.APP_Programs_Remote,t_Vehicles.APP_Resync_Available,t_Vehicles.PIN_Read FROM t_Makes JOIN  t_Models ON t_Makes.UUID = t_Models.Make_UUID JOIN t_Vehicles ON  t_Models.UUID = t_Vehicles.Model_UUID ".$where." ORDER BY t_Makes.Make_Name ".$sort." LIMIT 50");		
		return $query->result_array();
	}
	
	
	
	
	public function filter_vehicle_by_model(){
		$modelId = $this->input->post('modelId');
		if($modelId!=""){
			$query = $this->db->query("SELECT t_Vehicles.gen,t_Vehicles.Parts_Keys,t_Vehicles.Parts_Chips,t_Vehicles.Parts_Batteries,t_Vehicles.gen_notes,t_Models.Vehicle_Type_UUID,t_Vehicles.image_url,t_Makes.Make_Name,t_Vehicles.UUID,t_Models.Model_Name,t_Vehicles.id,t_Vehicles.Model_UUID,t_Vehicles.Years,t_Vehicles.Code_Series_UUID,t_Vehicles.Retainer_UUID,t_Vehicles.Mechanical_Key_UUID,t_Vehicles.Chip_Key_UUID,t_Vehicles.Remote_UUID,t_Vehicles.RHK_UUID,t_Vehicles.SmartKey_UUID,t_Vehicles.MVP_System,t_Vehicles.MVP_Dongle_UUID,t_Vehicles.MVP_SmartCard,t_Vehicles.MVP_Software,t_Vehicles.MVP_PIN_Required,t_Vehicles.MVP_PIN_Read,t_Vehicles.ProLok_Tool_UUID,t_Vehicles.ProLok_Linkage,t_Vehicles.Vehicle_Image,t_Vehicles.Image_UUID,t_Vehicles.MVP_Notes,t_Vehicles.APP_System,t_Vehicles.APP_Add_Keys,t_Vehicles.APP_All_Keys_Lost,t_Vehicles.APP_Notes,t_Vehicles.HW_Key_Prog,t_Vehicles.HW_Remote_Prog,t_Vehicles.HW_Misc_Prog,t_Vehicles.TKOSDD_System,t_Vehicles.TKOSDD_SDD_Adapter,t_Vehicles.TKOSDD_SDD_Cable,t_Vehicles.TKOSDD_TKO_Cable,t_Vehicles.TKOSDD_Notes,t_Vehicles.APP_Confirmed_Working,t_Vehicles.DMax_System,t_Vehicles.DMax_Method,t_Vehicles.Parts_Ignition,t_Vehicles.Parts_Door,t_Vehicles.Parts_Accessories,t_Vehicles.Vehicle_Type,t_Vehicles.Tumblers,t_Vehicles.OBD_Location_Text,t_Vehicles.OBD_Location_Image,t_Vehicles.APP_Programs_Remote,t_Vehicles.APP_Resync_Available,t_Vehicles.PIN_Read FROM t_Vehicles JOIN t_Models ON t_Models.UUID = t_Vehicles.Model_UUID
		LEFT JOIN t_Makes ON t_Makes.UUID = t_Models.Make_UUID WHERE t_Models.UUID=? ORDER BY t_Makes.Make_Name ".$sort."   LIMIT  0, 50 ",array($modelId));		
		return $query->result_array();
			return $query->result_array();
		}		
	}
	public function search_vehicles2(){
		if(isset($_SESSION['global_sorting']) && $_SESSION['global_sorting'] !=""){
			$global_sorting = $_SESSION['global_sorting'];
		}else{
			$global_sorting = "t_Makes.Make_Name, t_Models.Model_Name";
		}
		$search_key = trim($this->input->post('search_key'));
		$mm_query = $this->db->query("SELECT t_Vehicles.gen,t_Vehicles.Parts_Keys,t_Vehicles.Parts_Chips,t_Vehicles.Parts_Batteries,t_Vehicles.gen_notes,t_Models.Vehicle_Type_UUID,t_Vehicles.image_url,t_Makes.Make_Name,t_Vehicles.UUID,t_Models.Model_Name,t_Vehicles.id,t_Vehicles.Model_UUID,t_Vehicles.Years,t_Vehicles.Code_Series_UUID,t_Vehicles.Retainer_UUID,t_Vehicles.Mechanical_Key_UUID,t_Vehicles.Chip_Key_UUID,t_Vehicles.Remote_UUID,t_Vehicles.RHK_UUID,t_Vehicles.SmartKey_UUID,t_Vehicles.MVP_System,t_Vehicles.MVP_Dongle_UUID,t_Vehicles.MVP_SmartCard,t_Vehicles.MVP_Software,t_Vehicles.MVP_PIN_Required,t_Vehicles.MVP_PIN_Read,t_Vehicles.ProLok_Tool_UUID,t_Vehicles.ProLok_Linkage,t_Vehicles.Vehicle_Image,t_Vehicles.Image_UUID,t_Vehicles.MVP_Notes,t_Vehicles.APP_System,t_Vehicles.APP_Add_Keys,t_Vehicles.APP_All_Keys_Lost,t_Vehicles.APP_Notes,t_Vehicles.HW_Key_Prog,t_Vehicles.HW_Remote_Prog,t_Vehicles.HW_Misc_Prog,t_Vehicles.TKOSDD_System,t_Vehicles.TKOSDD_SDD_Adapter,t_Vehicles.TKOSDD_SDD_Cable,t_Vehicles.TKOSDD_TKO_Cable,t_Vehicles.TKOSDD_Notes,t_Vehicles.APP_Confirmed_Working,t_Vehicles.DMax_System,t_Vehicles.DMax_Method,t_Vehicles.Parts_Ignition,t_Vehicles.Parts_Door,t_Vehicles.Parts_Accessories,t_Vehicles.Vehicle_Type,t_Vehicles.Tumblers,t_Vehicles.OBD_Location_Text,t_Vehicles.OBD_Location_Image,t_Vehicles.APP_Programs_Remote,t_Vehicles.APP_Resync_Available,t_Vehicles.PIN_Read FROM t_Vehicles JOIN t_Models ON t_Models.UUID = t_Vehicles.Model_UUID
		LEFT JOIN t_Makes ON t_Makes.UUID = t_Models.Make_UUID WHERE t_Makes.Make_Name LIKE '%$search_key%' OR t_Models.Model_Name LIKE '%$search_key%'  ORDER BY ".$global_sorting."");
		if($mm_query->num_rows() > 0){
			return $mm_query->result_array();
		}
	}
	public function search_vehicles(){
		if(isset($_SESSION['global_sorting']) && $_SESSION['global_sorting'] !=""){
			$global_sorting = $_SESSION['global_sorting'];
		}else{
			$global_sorting = "t_Makes.Make_Name, t_Models.Model_Name";
		}
		$search_key = trim($this->input->post('search_key'));
		
		// $makes_id = "";
		// $modal_ids = "";						
		//$t_code_series_query = $this->db->query("SELECT * FROM t_Code_Series WHERE Code_Series_Name LIKE '%$search_key%'");
		//$t_code_series_query1 = $t_code_series_query->result_array();		
		//$t_keys_query = $this->db->query("SELECT * FROM t_Keys WHERE Key_Name LIKE '%$search_key%'");
		//$t_keys_query1 = $t_keys_query->result_array();		
		//$t_remotes_query = $this->db->query("SELECT * FROM t_Remotes WHERE Remote_Name LIKE '%$search_key%'");
		//$t_remotes_query1 = $t_remotes_query->result_array();

		$mm_query = $this->db->query("SELECT t_Vehicles.gen,t_Vehicles.Parts_Keys,t_Vehicles.Parts_Chips,t_Vehicles.Parts_Batteries,t_Vehicles.gen_notes,t_Models.Vehicle_Type_UUID,t_Vehicles.image_url,t_Makes.Make_Name,t_Vehicles.UUID,t_Models.Model_Name,t_Vehicles.id,t_Vehicles.Model_UUID,t_Vehicles.Years,t_Vehicles.Code_Series_UUID,t_Vehicles.Retainer_UUID,t_Vehicles.Mechanical_Key_UUID,t_Vehicles.Chip_Key_UUID,t_Vehicles.Remote_UUID,t_Vehicles.RHK_UUID,t_Vehicles.SmartKey_UUID,t_Vehicles.MVP_System,t_Vehicles.MVP_Dongle_UUID,t_Vehicles.MVP_SmartCard,t_Vehicles.MVP_Software,t_Vehicles.MVP_PIN_Required,t_Vehicles.MVP_PIN_Read,t_Vehicles.ProLok_Tool_UUID,t_Vehicles.ProLok_Linkage,t_Vehicles.Vehicle_Image,t_Vehicles.Image_UUID,t_Vehicles.MVP_Notes,t_Vehicles.APP_System,t_Vehicles.APP_Add_Keys,t_Vehicles.APP_All_Keys_Lost,t_Vehicles.APP_Notes,t_Vehicles.HW_Key_Prog,t_Vehicles.HW_Remote_Prog,t_Vehicles.HW_Misc_Prog,t_Vehicles.TKOSDD_System,t_Vehicles.TKOSDD_SDD_Adapter,t_Vehicles.TKOSDD_SDD_Cable,t_Vehicles.TKOSDD_TKO_Cable,t_Vehicles.TKOSDD_Notes,t_Vehicles.APP_Confirmed_Working,t_Vehicles.DMax_System,t_Vehicles.DMax_Method,t_Vehicles.Parts_Ignition,t_Vehicles.Parts_Door,t_Vehicles.Parts_Accessories,t_Vehicles.Vehicle_Type,t_Vehicles.Tumblers,t_Vehicles.OBD_Location_Text,t_Vehicles.OBD_Location_Image,t_Vehicles.APP_Programs_Remote,t_Vehicles.APP_Resync_Available,t_Vehicles.PIN_Read FROM t_Vehicles JOIN t_Models ON t_Models.UUID = t_Vehicles.Model_UUID
		LEFT JOIN t_Makes ON t_Makes.UUID = t_Models.Make_UUID WHERE t_Makes.Make_Name LIKE '%$search_key%' OR t_Models.Model_Name LIKE '%$search_key%'  ORDER BY ".$global_sorting." LIMIT 0, 50");
		if($mm_query->num_rows() > 0){
			return $mm_query->result_array();
		}
		//elseif($t_code_series_query->num_rows() > 0){			
		// 	$modal_ids22 = "";
		// 	$where = "";
		// 	foreach($t_code_series_query1 as $model_idss){				
		// 		//$modal_ids = $model_query12[0]['UUID'];
		// 		$code_uuid = rtrim($model_idss['UUID'],'|');
		// 		$modal_ids22 .= "'". $code_uuid."',";
		// 		$where .= "t_Vehicles.Code_Series_UUID LIKE '%$code_uuid%' OR ";
		// 	}
		// 	$where2 = substr($where,0,-3);
		// 	$modal_ids2 = rtrim($modal_ids22,",");	
		// 	//$query = $this->db->query("SELECT * FROM t_Vehicles WHERE ".$where2."");
		// 	$query = $this->db->query("SELECT t_Models.Vehicle_Type_UUID,t_Vehicles.image_url,t_Makes.Make_Name,t_Vehicles.UUID,t_Models.Model_Name,t_Vehicles.id,t_Vehicles.Model_UUID,t_Vehicles.Years,t_Vehicles.Code_Series_UUID,t_Vehicles.Retainer_UUID,t_Vehicles.Mechanical_Key_UUID,t_Vehicles.Chip_Key_UUID,t_Vehicles.Remote_UUID,t_Vehicles.RHK_UUID,t_Vehicles.SmartKey_UUID,t_Vehicles.MVP_System,t_Vehicles.MVP_Dongle_UUID,t_Vehicles.MVP_SmartCard,t_Vehicles.MVP_Software,t_Vehicles.MVP_PIN_Required,t_Vehicles.MVP_PIN_Read,t_Vehicles.ProLok_Tool_UUID,t_Vehicles.ProLok_Linkage,t_Vehicles.Vehicle_Image,t_Vehicles.Image_UUID,t_Vehicles.MVP_Notes,t_Vehicles.APP_System,t_Vehicles.APP_Add_Keys,t_Vehicles.APP_All_Keys_Lost,t_Vehicles.APP_Notes,t_Vehicles.HW_Key_Prog,t_Vehicles.HW_Remote_Prog,t_Vehicles.HW_Misc_Prog,t_Vehicles.TKOSDD_System,t_Vehicles.TKOSDD_SDD_Adapter,t_Vehicles.TKOSDD_SDD_Cable,t_Vehicles.TKOSDD_TKO_Cable,t_Vehicles.TKOSDD_Notes,t_Vehicles.APP_Confirmed_Working,t_Vehicles.DMax_System,t_Vehicles.DMax_Method,t_Vehicles.Parts_Ignition,t_Vehicles.Parts_Door,t_Vehicles.Parts_Accessories,t_Vehicles.Vehicle_Type,t_Vehicles.Tumblers,t_Vehicles.OBD_Location_Text,t_Vehicles.OBD_Location_Image,t_Vehicles.APP_Programs_Remote,t_Vehicles.APP_Resync_Available,t_Vehicles.PIN_Read FROM t_Makes JOIN  t_Models ON t_Makes.UUID = t_Models.Make_UUID JOIN t_Vehicles ON  t_Models.UUID = t_Vehicles.Model_UUID WHERE ".$where2." ORDER BY ".$global_sorting." LIMIT 0, 50");
		// }else if($t_keys_query->num_rows() > 0){
		// 	$modal_ids22 = "";
		// 	foreach($t_keys_query1 as $model_idss){				
		// 		//$modal_ids = $model_query12[0]['UUID'];
		// 		$modal_ids22 .= "'". $model_idss['UUID']."',";
		// 	}
		// 	$modal_ids2 = rtrim($modal_ids22,",");
		// 	if($modal_ids2 ==""){
		// 		$modal_ids2 = '0';
		// 	}else{
		// 		$modal_ids2 = $modal_ids2;
		// 	}
		// 	//$query = $this->db->query("SELECT * FROM t_Vehicles WHERE Mechanical_Key_UUID IN($modal_ids2)  OR Chip_Key_UUID IN($modal_ids2) ");
		// 	$query = $this->db->query("SELECT t_Models.Vehicle_Type_UUID,t_Vehicles.image_url,t_Makes.Make_Name,t_Vehicles.UUID,t_Models.Model_Name,t_Vehicles.id,t_Vehicles.Model_UUID,t_Vehicles.Years,t_Vehicles.Code_Series_UUID,t_Vehicles.Retainer_UUID,t_Vehicles.Mechanical_Key_UUID,t_Vehicles.Chip_Key_UUID,t_Vehicles.Remote_UUID,t_Vehicles.RHK_UUID,t_Vehicles.SmartKey_UUID,t_Vehicles.MVP_System,t_Vehicles.MVP_Dongle_UUID,t_Vehicles.MVP_SmartCard,t_Vehicles.MVP_Software,t_Vehicles.MVP_PIN_Required,t_Vehicles.MVP_PIN_Read,t_Vehicles.ProLok_Tool_UUID,t_Vehicles.ProLok_Linkage,t_Vehicles.Vehicle_Image,t_Vehicles.Image_UUID,t_Vehicles.MVP_Notes,t_Vehicles.APP_System,t_Vehicles.APP_Add_Keys,t_Vehicles.APP_All_Keys_Lost,t_Vehicles.APP_Notes,t_Vehicles.HW_Key_Prog,t_Vehicles.HW_Remote_Prog,t_Vehicles.HW_Misc_Prog,t_Vehicles.TKOSDD_System,t_Vehicles.TKOSDD_SDD_Adapter,t_Vehicles.TKOSDD_SDD_Cable,t_Vehicles.TKOSDD_TKO_Cable,t_Vehicles.TKOSDD_Notes,t_Vehicles.APP_Confirmed_Working,t_Vehicles.DMax_System,t_Vehicles.DMax_Method,t_Vehicles.Parts_Ignition,t_Vehicles.Parts_Door,t_Vehicles.Parts_Accessories,t_Vehicles.Vehicle_Type,t_Vehicles.Tumblers,t_Vehicles.OBD_Location_Text,t_Vehicles.OBD_Location_Image,t_Vehicles.APP_Programs_Remote,t_Vehicles.APP_Resync_Available,t_Vehicles.PIN_Read FROM t_Makes JOIN  t_Models ON t_Makes.UUID = t_Models.Make_UUID JOIN t_Vehicles ON  t_Models.UUID = t_Vehicles.Model_UUID WHERE t_Vehicles.Mechanical_Key_UUID IN($modal_ids2)  OR t_Vehicles.Chip_Key_UUID IN($modal_ids2) ".$global_sorting." LIMIT 0, 50");
		// }else if($t_remotes_query->num_rows() > 0){		
				
		// 	$modal_ids22 = "";
		// 	foreach($t_remotes_query1 as $model_idss){				
		// 		//$modal_ids = $model_query12[0]['UUID'];
		// 		$modal_ids22 .= "'". $model_idss['UUID']."',";
		// 	}
		// 	$modal_ids2 = rtrim($modal_ids22,",");
		// 	if($modal_ids2 ==""){
		// 		$modal_ids2 = '0';
		// 	}else{
		// 		$modal_ids2 = $modal_ids2;
		// 	}
		// 	//$query = $this->db->query("SELECT * FROM t_Vehicles WHERE Remote_UUID IN($modal_ids2)  OR RHK_UUID IN($modal_ids2) OR SmartKey_UUID IN($modal_ids2) ");
		// 	$query = $this->db->query("SELECT t_Models.Vehicle_Type_UUID,t_Vehicles.image_url,t_Makes.Make_Name,t_Vehicles.UUID,t_Models.Model_Name,t_Vehicles.id,t_Vehicles.Model_UUID,t_Vehicles.Years,t_Vehicles.Code_Series_UUID,t_Vehicles.Retainer_UUID,t_Vehicles.Mechanical_Key_UUID,t_Vehicles.Chip_Key_UUID,t_Vehicles.Remote_UUID,t_Vehicles.RHK_UUID,t_Vehicles.SmartKey_UUID,t_Vehicles.MVP_System,t_Vehicles.MVP_Dongle_UUID,t_Vehicles.MVP_SmartCard,t_Vehicles.MVP_Software,t_Vehicles.MVP_PIN_Required,t_Vehicles.MVP_PIN_Read,t_Vehicles.ProLok_Tool_UUID,t_Vehicles.ProLok_Linkage,t_Vehicles.Vehicle_Image,t_Vehicles.Image_UUID,t_Vehicles.MVP_Notes,t_Vehicles.APP_System,t_Vehicles.APP_Add_Keys,t_Vehicles.APP_All_Keys_Lost,t_Vehicles.APP_Notes,t_Vehicles.HW_Key_Prog,t_Vehicles.HW_Remote_Prog,t_Vehicles.HW_Misc_Prog,t_Vehicles.TKOSDD_System,t_Vehicles.TKOSDD_SDD_Adapter,t_Vehicles.TKOSDD_SDD_Cable,t_Vehicles.TKOSDD_TKO_Cable,t_Vehicles.TKOSDD_Notes,t_Vehicles.APP_Confirmed_Working,t_Vehicles.DMax_System,t_Vehicles.DMax_Method,t_Vehicles.Parts_Ignition,t_Vehicles.Parts_Door,t_Vehicles.Parts_Accessories,t_Vehicles.Vehicle_Type,t_Vehicles.Tumblers,t_Vehicles.OBD_Location_Text,t_Vehicles.OBD_Location_Image,t_Vehicles.APP_Programs_Remote,t_Vehicles.APP_Resync_Available,t_Vehicles.PIN_Read FROM t_Makes JOIN  t_Models ON t_Makes.UUID = t_Models.Make_UUID JOIN t_Vehicles ON  t_Models.UUID = t_Vehicles.Model_UUID WHERE t_Vehicles.Remote_UUID IN($modal_ids2)  OR t_Vehicles.RHK_UUID IN($modal_ids2) OR t_Vehicles.SmartKey_UUID IN($modal_ids2)  ORDER BY ".$global_sorting." LIMIT 0, 50");
		// }else{			
		// 	$query = $this->db->query("SELECT t_Models.Vehicle_Type_UUID,t_Vehicles.image_url,t_Makes.Make_Name,t_Vehicles.UUID,t_Models.Model_Name,t_Vehicles.id,t_Vehicles.Model_UUID,t_Vehicles.Years,t_Vehicles.Code_Series_UUID,t_Vehicles.Retainer_UUID,t_Vehicles.Mechanical_Key_UUID,t_Vehicles.Chip_Key_UUID,t_Vehicles.Remote_UUID,t_Vehicles.RHK_UUID,t_Vehicles.SmartKey_UUID,t_Vehicles.MVP_System,t_Vehicles.MVP_Dongle_UUID,t_Vehicles.MVP_SmartCard,t_Vehicles.MVP_Software,t_Vehicles.MVP_PIN_Required,t_Vehicles.MVP_PIN_Read,t_Vehicles.ProLok_Tool_UUID,t_Vehicles.ProLok_Linkage,t_Vehicles.Vehicle_Image,t_Vehicles.Image_UUID,t_Vehicles.MVP_Notes,t_Vehicles.APP_System,t_Vehicles.APP_Add_Keys,t_Vehicles.APP_All_Keys_Lost,t_Vehicles.APP_Notes,t_Vehicles.HW_Key_Prog,t_Vehicles.HW_Remote_Prog,t_Vehicles.HW_Misc_Prog,t_Vehicles.TKOSDD_System,t_Vehicles.TKOSDD_SDD_Adapter,t_Vehicles.TKOSDD_SDD_Cable,t_Vehicles.TKOSDD_TKO_Cable,t_Vehicles.TKOSDD_Notes,t_Vehicles.APP_Confirmed_Working,t_Vehicles.DMax_System,t_Vehicles.DMax_Method,t_Vehicles.Parts_Ignition,t_Vehicles.Parts_Door,t_Vehicles.Parts_Accessories,t_Vehicles.Vehicle_Type,t_Vehicles.Tumblers,t_Vehicles.OBD_Location_Text,t_Vehicles.OBD_Location_Image,t_Vehicles.APP_Programs_Remote,t_Vehicles.APP_Resync_Available,t_Vehicles.PIN_Read FROM t_Makes JOIN  t_Models ON t_Makes.UUID = t_Models.Make_UUID JOIN t_Vehicles ON  t_Models.UUID = t_Vehicles.Model_UUID ORDER BY ".$global_sorting." LIMIT 0, 50");
		// }		
		//return $query->result_array();
	}

	public function limitVehicleTransponder(){
		$query = $this->db->query("SELECT t_Makes.Make_Name,t_Models.Model_Name,t_Vehicles.id,t_Vehicles.Code_Series_UUID,t_Vehicles.Chip_Key_UUID,t_Vehicles.Model_UUID,t_Vehicles.Years FROM t_Makes JOIN  t_Models ON t_Makes.UUID = t_Models.Make_UUID JOIN t_Vehicles ON  t_Models.UUID = t_Vehicles.Model_UUID ORDER BY t_Makes.Make_Name,t_Models.Model_Name");
		return $query->result_array();
	}
	
	
	public function getModelInfo2($model_uuid){
		$query = $this->db->query("SELECT * FROM t_Models WHERE UUID = ? ",array($model_uuid));
		return $query->result_array();
	}
	
	public function getMakeInfo2($make_uuid){
		$query = $this->db->query("SELECT * FROM t_Makes WHERE UUID = ? ",array($make_uuid));
		return $query->result_array();
	}
	
	public function csinput_update(){
		$this->db->cache_delete('admpro', 'vehicles');
			$column_name = $this->input->post('columnName');
			foreach($_POST[$column_name] as $key => $val) {
				$data = array($column_name => $val);
				$this->db->where('id', $key);
				$data = $this->security->xss_clean($data);
				$this->db->update('t_Code_Series', $data);
			}			
			if(isset($val)){
				return $val;
			}else{
				return '';
			}
	}
	
	public function cs_keys_data_update(){
			$this->db->cache_delete('admpro', 'vehicles');
			$columnName = $this->input->post('columnName');
			foreach($_POST[$columnName] as $key => $val) {
				$data = array($columnName => $val);
				$this->db->where('id', $key);
				$data = $this->security->xss_clean($data);
				$this->db->update('t_Code_Series', $data);
			}
			$query = $this->db->query("SELECT * FROM  t_Tools WHERE UUID = ? ",array($val));
			$return = $query->result_array();
			if(isset($return[0]['Tool_Name'])){
				return $return[0]['Tool_Name'];
			}else{
				return '';
			}			
	}
	public function update_machine_data(){
			
			$columnName = $this->input->post('columnName');
			foreach($_POST[$columnName] as $key => $val) {
				$data = array($columnName => $val);
				$this->db->where('id', $key);
				$data = $this->security->xss_clean($data);
				$this->db->update('t_Code_Series', $data);
			}
			$query = $this->db->query("SELECT * FROM  t_Machines_Info WHERE UUID = ? ",array($val));
			$return = $query->result_array();
			if(isset($return[0]['Name'])){
				return $return[0]['Name'];
			}else{
				return '';
			}			
	}
	
	public function update_key_style_data(){
		$columnName = $this->input->post('columnName');
		foreach($_POST[$columnName] as $key => $val) {
			$data = array($columnName => $val);
			$this->db->where('id', $key);
			$data = $this->security->xss_clean($data);
			$this->db->update('t_Code_Series', $data);
		}
		$query = $this->db->query("SELECT * FROM  t_Key_Styles WHERE UUID = ? ",array($val));
		$return = $query->result_array();
		if(isset($return[0]['Key_Style_Name'])){
			return $return[0]['Key_Style_Name'];
		}else{
			return '';
		}	
	}

/*=========================== Vehicle Page Editing ==========================================*/
	
	public function vh_input_update(){
		$this->db->cache_delete('admpro', 'vehicles');
		$column_name = $this->input->post('columnName');
		foreach($_POST[$column_name] as $key => $val) {
			if($column_name == 'Years'){
				$data = array($column_name => str_replace('-', ',', $val));
			}else{
				$data = array($column_name => $val);
			}
			if($column_name == 'gen'){
				$data = array($column_name => $val,'gen_notes' => $_POST['gen_notes'][$key]);
			}
			$this->db->where('id', $key);
			$data = $this->security->xss_clean($data);
			$this->db->update('t_Vehicles', $data);
		}			
		if(isset($val)){
			if($column_name == 'Years'){
				return str_replace(',', '-', $val);
			}
			if($column_name == 'gen'){
				return $val.'<br>'.$_POST['gen_notes'][$key];
			}
			if($column_name == 'OBD_Location_Image'){
				return '<a href="'.$val.'" target="_blank"><img src="'.$val.'" style="width:50px;"></a>';
			}else{
				return $val;
			}
			
		}else{
			return '';
		}
	}
	
	public function update_vehicle_image1(){
		$this->db->cache_delete('admpro', 'vehicles');
		$column_name = $this->input->post('columnName');
		$id = $this->input->post('id');
		$val = $this->input->post('image_name');
		$data = array($column_name => $val);
		$this->db->where('id', $id);
		$data = $this->security->xss_clean($data);
		$this->db->update('t_Vehicles', $data);
		return $val;
	}
	
	
	
	public function vh_dropbox_update(){
		$this->db->cache_delete('admpro', 'vehicles');
		$columnName = $this->input->post('columnName');
		$tableName = $this->input->post('tableName');
		$tableColName = $this->input->post('tableColName');
		if($columnName == 'Code_Series_UUID'){
			//print_r($_POST['Code_Series_UUID']);
			$series_val = "";
			foreach( $_POST['Code_Series_UUID'] as $key_id => $series){
				$series_val .= $series.',';	
			}	
			$series_val1 = rtrim($series_val,',');		
			$data = array($columnName => $series_val1);
			$this->db->where('id', $this->input->post('vehicle_id'));
			$data = $this->security->xss_clean($data);
			$this->db->update('t_Vehicles', $data);
			$got_series_data = explode(',',$series_val1);
			for( $cs = 0; $cs <= count($got_series_data); $cs++ ){
				$got_series_val = explode('|',$got_series_data[$cs]);
				$code_series_id = $got_series_val[0];
				$code_series_note = $got_series_val[1];
				$get_Code_Series_name = get_Code_Series_name($code_series_id);
				if($code_series_note !=""){
					echo $get_Code_Series_name[0]['Code_Series_Name'].' ('.$code_series_note.')<br>';
				}else{
					echo $get_Code_Series_name[0]['Code_Series_Name'].'<br>';
				}				
			}		
		}else{		
			foreach($_POST[$columnName] as $key => $val) {
				$data = array($columnName => $val);
				$this->db->where('id', $key);
				$data = $this->security->xss_clean($data);
				$this->db->update('t_Vehicles', $data);
			}
			$query = $this->db->query("SELECT * FROM ".$tableName." WHERE UUID =? ",array($val));
			$return = $query->result_array();
			if(isset($return[0][$tableColName])){
				return $return[0][$tableColName];
			}else{
				return '';
			}
		}
	}
	
	public function vh_programmers_dropbox_update(){
		$this->db->cache_delete('admpro', 'vehicles');
		$id = $this->input->post('id');
		$machanical_keys_val  = "";	
		if( isset($_POST['Mechanical_Key_UUID'])){
			foreach( $_POST['Mechanical_Key_UUID'] as $machanical_keys){
				$machanical_keys_val .= $machanical_keys.',';
			}
		}
		$machanical_keys_val1 = rtrim($machanical_keys_val,',');
		$data = array('Mechanical_Key_UUID' => $machanical_keys_val1);
		$this->db->where('id', $id);
		$data = $this->security->xss_clean($data);
		$this->db->update('t_Vehicles', $data);
		$mach_keys_uuids = "";								
		$mach_keys_array = explode(',',$machanical_keys_val1);
		for($i = 0; $i < count($mach_keys_array); $i++ ){
			$value_uuid = $mach_keys_array[$i];
			$get_key_name = $this->db->query("SELECT * FROM t_Keys WHERE UUID = ? ",array($value_uuid));//get_key_name($mach_keys_array[$i]);
			$return = $get_key_name->result_array();
			$mach_keys_uuids .=  $return[0]['Key_Name'].'<br>';
		}		
		return $mach_keys_uuids;
	} 
	
	public function vh_multiple_dropbox_update(){
		$this->db->cache_delete('admpro', 'vehicles');
		$id = $this->input->post('id');
		$columnName =  $this->input->post('columnName');
		$type =  $this->input->post('type');
		$machanical_keys_val  = "";	
		if( isset($_POST[$columnName])){
			foreach( $_POST[$columnName] as $machanical_keys){
				$machanical_keys_val .= $machanical_keys.',';
			}
		}
		$machanical_keys_val1 = rtrim($machanical_keys_val,',');
		$data = array($columnName => $machanical_keys_val1);
		$this->db->where('id', $id);
		$data = $this->security->xss_clean($data);
		$this->db->update('t_Vehicles', $data);
		$mach_keys_uuids = "";
		if($type == 'Keys'){						
			$mach_keys_array = explode(',',$machanical_keys_val1);
			for($i = 0; $i < count($mach_keys_array); $i++ ){
				$value = $mach_keys_array[$i];
				$query2 = $this->db->query("SELECT * FROM t_Keys WHERE UUID = ?  ORDER BY Key_Name",array($value)); 
				$return = $query2->result_array();
				$mach_keys_uuids .=  $return[0]['Key_Name'].'<br>';
			}
		}else if($type == 'Remotes'){
			$mach_keys_uuids = "";								
			$mach_keys_array = explode(',',$machanical_keys_val1);
			for($i = 0; $i < count($mach_keys_array); $i++ ){
				$value = $mach_keys_array[$i];
				$query2 = $this->db->query("SELECT * FROM t_Remotes WHERE UUID = ? ORDER BY Remote_Name" ,array($value)); 
				$return = $query2->result_array();
				$mach_keys_uuids .=  $return[0]['Remote_Name'].'<br>';
			}
		}			
		return $mach_keys_uuids;
	} 

/*================================= Tools Page Editing ================================================*/
	
	public function tools_input_update(){
		
		$column_name = $this->input->post('columnName');
		foreach($_POST[$column_name] as $key => $val) {
			$data = array($column_name => $val);
			$this->db->where('id', $key);
			$data = $this->security->xss_clean($data);
			$this->db->update('t_Tools', $data);
		}			
		if(isset($val)){
			if($column_name == 'Tool_Image_Url'){
				return '<img class="customImage" src ="'.aks_img_url().$val.' ">';
			}else{
				return $val;
			}
		}else{
			return '';
		}
	}
	
	public function tools_dropbox_update(){
		$columnName = $this->input->post('columnName');
		$tableName = $this->input->post('tableName');
		$tableColName = $this->input->post('tableColName');
		foreach($_POST[$columnName] as $key => $val) {
			$data = array($columnName => $val);
			$this->db->where('id', $key);
			$data = $this->security->xss_clean($data);
			$this->db->update('t_Tools', $data);
		}
		$query = $this->db->query("SELECT * FROM ".$tableName." WHERE UUID = '? ",array($val));
		$return = $query->result_array();
		if(isset($return[0][$tableColName])){
			return $return[0][$tableColName];
		}else{
			return '';
		}
	}


/*========================== Update Account =====================================*/	
	
	public function usersInInfo($user_email){
		$query = $this->db->select("UserID,user_name,type,email,password,Company,User_uid,APP_switcher")->where('email',$user_email)->get('add_user');
		return $query->result_array();
	}	


/*======================== Machines Info Module=========================================*/
	
	public function get_machines(){
		$query = $this->db->query("SELECT * FROM  t_Machines_Info ORDER BY Name ");
		return $query->result_array();
	}
	public function get_machinesRows(){		
		return $this->db->count_all("t_Machines_Info");	
	}
	public function get_machinesDetail($limit,$limt_start	){
		$query = $this->db->query("SELECT * FROM  t_Machines_Info ORDER BY Name  LIMIT  ".(int)$limt_start.", ".(int)$limit."  ");
		return $query->result_array();
	}
	
	public function getMachinesTypes(){
		$query = $this->db->query("SELECT * FROM  t_Machines_Info_Types ORDER BY Machines_Info_Type_Name ");
		return $query->result_array();
	}
	
	public function save_machines(){
		$this->db->cache_delete('admpro', 'machines');
		$data = array(
			'UUID' => md5(uniqid(mt_rand(), true)),
			'Type' => $this->input->post('Type'),
			'Name' => $this->input->post('Name'),
			'Products' => $this->input->post('Products')
		);		
		$data = $this->security->xss_clean($data);
		$this->db->insert('t_Machines_Info', $data);
		return true;
	}
	
	public function getMachinesInfo($id){
		$query = $this->db->query("SELECT * FROM  t_Machines_Info WHERE id = ? ",array($id));
		return $query->result_array();
	}
	
	
	public function update_machines(){
		$this->db->cache_delete('admpro', 'machines');
		$id = $this->input->post('id');
		$data = array(			
			'Type' => $this->input->post('Type'),
			'Name' => $this->input->post('Name'),
			'Products' => $this->input->post('Products')
		);
		$this->db->where('id', $id);
		$data = $this->security->xss_clean($data);
		$this->db->update('t_Machines_Info', $data);	
	}
	
	public function delete_machine($id){
		$this->db->cache_delete('admpro', 'machines');
		$this->db->where('id', $id);
		$this->db->delete('t_Machines_Info');
	}

/*======================== Buttons Module=========================================*/
	
	public function get_buttons(){
		$query = $this->db->query("SELECT * FROM  t_Buttons ORDER BY Name ");
		return $query->result_array();
	}
	
	public function save_button(){
		$this->db->cache_delete('admpro', 'buttons');
		$data = array(
			'UUID' => md5(uniqid(mt_rand(), true)),			
			'Name' => $this->input->post('Name')			
		);	
		$data = $this->security->xss_clean($data);	
		$this->db->insert('t_Buttons', $data);
		return true;
	}
	
	public function buttonsInfo($id){
		$query = $this->db->query("SELECT * FROM  t_Buttons WHERE id = ? ",array($id));
		return $query->result_array();
	}
	
	public function update_button(){
		$this->db->cache_delete('admpro', 'buttons');
		$id = $this->input->post('id');
		$data = array(		
			'Name' => $this->input->post('Name'),
		);
		$this->db->where('id', $id);
		$data = $this->security->xss_clean($data);
		$this->db->update('t_Buttons', $data);	
	}
	
	public function delete_buttons($id){
		$this->db->cache_delete('admpro', 'buttons');
		$this->db->where('id', $id);
		$this->db->delete('t_Buttons');
	}
	
	public function buttons_sorting(){
		$sort = $this->input->post('sorting');
		$sorting_by = $this->input->post('sorting_by');		
		$query = $this->db->query("SELECT * FROM t_Buttons ORDER BY $sorting_by $sort");
		return $query->result_array();
	}

/*======================== Key page - Alternative Keys=========================================*/
	
	public function get_substitute_keys(){
		$key_Type_UUID = $this->input->post('key');
		$query = $this->db->query("SELECT * FROM  t_Keys WHERE Key_Type_UUID = ? ORDER BY Key_Name",array($key_Type_UUID));
		return $query->result_array();
	}

/*================================= Keys Page Editing ================================================*/
	
	public function keys_input_update(){
		$this->db->cache_delete('admpro', 'keys');
		$column_name = $this->input->post('columnName');
		foreach($_POST[$column_name] as $key => $val) {
			$data = array($column_name => $val);
			$this->db->where('id', $key);
			$data = $this->security->xss_clean($data);
			$this->db->update('t_Keys', $data);
		}			
		if(isset($val)){
			if($column_name == 'Key_Image'){
				return '<img class="customImage" src ="'.aks_img_url().$val.' ">';
			}else{
				return $val;
			}
		}else{
			return '';
		}
	}
	
	public function keys_dropbox_update(){
		$this->db->cache_delete('admpro', 'keys');
		$columnName = $this->input->post('columnName');
		$tableName = $this->input->post('tableName');
		$tableColName = $this->input->post('tableColName');
		foreach($_POST[$columnName] as $key => $val) {
			$data = array($columnName => $val);
			$this->db->where('id', $key);
			$data = $this->security->xss_clean($data);
			$this->db->update('t_Keys', $data);
		}
		$query = $this->db->query("SELECT * FROM ".$tableName." WHERE UUID = ? " ,array($val));
		$return = $query->result_array();
		if(isset($return[0][$tableColName])){
			return $return[0][$tableColName];
		}else{
			return '';
		}
	}

/*================================= Remote Page Editing ================================================*/

	public function remotes_input_update(){
		$this->db->cache_delete('admpro', 'remotes');
		$column_name = $this->input->post('columnName');
		foreach($_POST[$column_name] as $key => $val) {
			$data = array($column_name => $val);
			$this->db->where('id', $key);
			$data = $this->security->xss_clean($data);
			$this->db->update('t_Remotes', $data);
		}			
		if(isset($val)){
			if($column_name == 'Remote_Image_Url'){
				return '<img class="customImage" src ="'.aks_img_url().$val.' ">';
			}else{
				return $val;
			}
		}else{
			return '';
		}
	}
	
	
	public function remotes_dropbox_update(){
		$this->db->cache_delete('admpro', 'remotes');
		$columnName = $this->input->post('columnName');
		$tableName = $this->input->post('tableName');
		$tableColName = $this->input->post('tableColName');
		foreach($_POST[$columnName] as $key => $val) {
			$data = array($columnName => $val);
			$this->db->where('id', $key);
			$data = $this->security->xss_clean($data);
			$this->db->update('t_Remotes', $data);
		}
		$query = $this->db->query("SELECT * FROM ".$tableName." WHERE UUID = ? ", array($val));
		$return = $query->result_array();
		if(isset($return[0][$tableColName])){
			return $return[0][$tableColName];
		}else{
			return $val;
		}
	}
	
/*=============================== Page Editing Functions ===============================================*/
	
	public function chips_input_update(){
		$this->db->cache_delete('admpro', 'Chips');
		$column_name = $this->input->post('columnName');
		$dataTable = $this->input->post('dataTable');
		$image = $this->input->post('image');
		foreach($_POST[$column_name] as $key => $val) {
			$data = array($column_name => $val);
			$this->db->where('id', $key);
			$data = $this->security->xss_clean($data);
			$this->db->update($dataTable, $data);
		}			
		if(isset($val)){
			if($column_name == $image){
				return '<img class="customImage" src ="'.aks_img_url().$val.' ">';
			}elseif(($column_name == 'Clonable') || ( $column_name == 'Reusable') || ( $column_name == 'CloningChip')){
				if($val == 1){
					return 'Yes';
				}elseif($val == 0){
					return 'No';
				}
			}else{
					return $val;
			}
		}else{
			return '';
		}
	}
	
	public function table_dropbox_update(){
		$this->db->cache_delete('admpro', 'Chips');
		$columnName = $this->input->post('columnName');
		$tableName = $this->input->post('tableName');
		$tableColName = $this->input->post('tableColName');
		$dataTable = $this->input->post('dataTable');		
		foreach($_POST[$columnName] as $key => $val) {
			$data = array($columnName => $val);
			$this->db->where('id', $key);
			$data = $this->security->xss_clean($data);
			$this->db->update($dataTable, $data);
		}
		$query = $this->db->query("SELECT * FROM ".$tableName." WHERE UUID = ? ", array($val));
		$return = $query->result_array();
		if(isset($return[0][$tableColName])){
			return $return[0][$tableColName];
		}else{
			return '';
		}
	}


/*============================== Key Code - Sechedule Module ===============================================*/
	
	public function getAllScheduleRows(){
		return $this->db->count_all("t_Makes");
	}
	public function get_make_schedule(){
		$query = $this->db->query("SELECT * FROM  t_Makes ORDER BY Make_Name ");
		return $query->result_array();
	}
	public function get_make_schedules($limit,$limit_start){
		$query = $this->db->query("SELECT * FROM  t_Makes ORDER BY Make_Name LIMIT ".(int)$limit_start.",". (int)$limit." ");
		return $query->result_array();
	}
	public function update_schedule(){
		$id = $this->input->post('id');
		if($this->input->post('Codes_Available') == 'on'){
			$Codes_Available = 1;
		}else{
			$Codes_Available = 0;
		}
		if($this->input->post('Codes_Afterhours') == 'on'){
			$Codes_Afterhours = 1;
		}else{
			$Codes_Afterhours = 0;
		}
		if($this->input->post('Codes_Refunds') == 'on'){
			$Codes_Refunds = 1;
		}else{
			$Codes_Refunds = 0;
		}
		$data = array(		
			'Codes_Available' => $Codes_Available,
			'Codes_Years' => $this->input->post('Codes_Years'),
			'Codes_Afterhours' => $Codes_Afterhours,
			'Codes_Price_Normal' => $this->input->post('Codes_Price_Normal'),
			'Codes_Price_Afterhours' => $this->input->post('Codes_Price_Afterhours'),
			'Codes_Wait_Time' => $this->input->post('Codes_Wait_Time'),
			'Codes_Refunds' => $Codes_Refunds
		);
		$this->db->where('id', $id);
		$data = $this->security->xss_clean($data);
		$this->db->update('t_Makes', $data);	
	}	
	
	public function machine_sorting(){	
		$sort = $this->input->post('sorting');	
		$sortby = $this->input->post('sortby');
		$query = $this->db->query("SELECT * FROM t_Machines_Info ORDER BY $sortby $sort");
		
		return $query->result_array();
	}
	
	public function select_by_machine(){
		$type_uuid = $this->input->post('type_uuid');
		if( $type_uuid == 'all'){
			$query = $this->db->query("SELECT * FROM t_Machines_Info ORDER BY Name ");	
		}else{
			$query = $this->db->query("SELECT * FROM t_Machines_Info WHERE Type = ? ", array($type_uuid));	
		}
		return $query->result_array();
	}
	
/*=================================== Add Image Types =====================================*/

	
	public function get_image_types(){
		$query = $this->db->query("SELECT * FROM t_Image_Types ORDER BY Name");		
		return $query->result_array();
	}
	
	public function save_image_types(){
		$this->db->cache_delete('admpro', 'images');
		$data = array(
			'UUID' => md5(uniqid(mt_rand(), true)),			
			'Name' => $this->input->post('Name'), 
			'Path' => $this->input->post('Path'), 
			'Date' => date('mdYHms')			
		);		
		$data = $this->security->xss_clean($data);
		$this->db->insert('t_Image_Types', $data);
		return true;
	}
	
	public function get_image_types_info($id){
		$query = $this->db->query("SELECT * FROM t_Image_Types WHERE id = ? ",  array($id));		
		return $query->result_array();
	}
	
	public function update_image_types(){
		$this->db->cache_delete('admpro', 'images');
		$id = $this->input->post('id');
		$data = array(		
			'Name' => $this->input->post('Name'),
			'Path' => $this->input->post('Path'), 
			'Date' => date('mdYHms')
		);
		$this->db->where('id', $id);
		$data = $this->security->xss_clean($data);
		$this->db->update('t_Image_Types', $data);	
	}
	
	public function delete_image_types($id){
		$this->db->cache_delete('admpro', 'images');
		$this->db->where('id', $id);
		$this->db->delete('t_Image_Types');
	}
	
	public function get_image(){
		$query = $this->db->query("SELECT * FROM t_Images");		
		return $query->result_array();
	}
	
	public function save_image($file_name){
		$this->db->cache_delete('admpro', 'images');
		$data = array(
			'UUID' => md5(uniqid(mt_rand(), true)),			
			'Image_Type_UUID' => $this->input->post('Image_Type_UUID'),
			'Filename' => $file_name			
		);		
		$data = $this->security->xss_clean($data);
		$this->db->insert('t_Images', $data);
		return true;
	}
	
	public function get_image_info($id){
		$query = $this->db->query("SELECT * FROM t_Images WHERE id = ? ",  array($id));		
		return $query->result_array();
	}
	
	public function update_image($file_name){
		$this->db->cache_delete('admpro', 'images');
		$id = $this->input->post('id');
		if($file_name == ""){
			 $data = array(						
				'Image_Type_UUID' => $this->input->post('Image_Type_UUID'),
			 );	
		}else{
			$data = array(						
				'Image_Type_UUID' => $this->input->post('Image_Type_UUID'),
				'Filename' => $file_name			
			);
		}
		$this->db->where('id', $id);
		$data = $this->security->xss_clean($data);
		$this->db->update('t_Images', $data);	
	}
	
	public function delete_image($id){
		$this->db->cache_delete('admpro', 'images');
		$this->db->where('id', $id);
		$this->db->delete('t_Images');
	}
	
	public function image_sorting_by_type(){
		$sort = $this->input->post('sorting');	
		$sortby = $this->input->post('sortby');
		$query = $this->db->query("SELECT * FROM t_Images ORDER BY $sortby $sort");
		return $query->result_array();
	}
	
	public function select_image_types(){
		$types = $this->input->post('types');	
		$columnName = $this->input->post('columnName');
		if($types == 'all'){
			$query = $this->db->query("SELECT * FROM t_Images");
		}else{			
			$query = $this->db->query("SELECT * FROM t_Images WHERE $columnName = ? ",  array($types));
		}
		return $query->result_array();
	}


/*==================== OBp: options ===================================================*/
	
	public function get_obp_options(){
		$query = $this->db->query("SELECT * FROM t_OBP_Options ORDER BY Default_Text ");		
		return $query->result_array();	
	}
	
	public function get_obp_option_categories(){
		$query = $this->db->query("SELECT * FROM t_OBP_Option_Categories ORDER BY Name ");		
		return $query->result_array();
	}
	
	public function save_obp_options(){
		$this->db->cache_delete('admpro', 'vehicles');
		$data = array(
			'UUID' => md5(uniqid(mt_rand(), true)),			
			'Default_Image_UUID' => $this->input->post('Default_Image_UUID'),
			'Default_Text' => $this->input->post('Default_Text'),	
			'Category_UUID' => $this->input->post('Category_UUID')		
		);	
		$data = $this->security->xss_clean($data);	
		$this->db->insert('t_OBP_Options', $data);
		return true;
	}
	
	public function get_obp_options_info($id){
		$query = $this->db->query("SELECT * FROM t_OBP_Options WHERE id = ? ",  array($id));		
		return $query->result_array();	
	}
	
	public function update_obp_options(){
		$this->db->cache_delete('admpro', 'vehicles');
		$id = $this->input->post('id');
		$data = array(					
			'Default_Image_UUID' => $this->input->post('Default_Image_UUID'),
			'Default_Text' => $this->input->post('Default_Text'),	
			'Category_UUID' => $this->input->post('Category_UUID')		
		);
		$this->db->where('id', $id);
		$data = $this->security->xss_clean($data);
		$this->db->update('t_OBP_Options', $data);		
	}
	
	public function delete_obp_options($id){
		$this->db->cache_delete('admpro', 'vehicles');
		$this->db->where('id', $id);
		$this->db->delete('t_OBP_Options');
	}
	
	public function obp_options_sorting(){
		$sort = $this->input->post('sorting');	
		$sortby = $this->input->post('sortby');
		$query = $this->db->query("SELECT * FROM t_OBP_Options ORDER BY $sortby $sort");
		return $query->result_array();
	}
	
	

/*============================ OBP Options Categories ==================================*/
	
	public function  save_obp_options_category(){
		$this->db->cache_delete('admpro', 'vehicles');
		$data = array(
			'UUID' => md5(uniqid(mt_rand(), true)),			
			'Name' => $this->input->post('Name')	
		);
		$data = $this->security->xss_clean($data);		
		$this->db->insert('t_OBP_Option_Categories', $data);
		return true;
	}
	
	public function get_obp_option_cat_info($id){
		$query = $this->db->query("SELECT * FROM t_OBP_Option_Categories WHERE id = ? ",  array($id));		
		return $query->result_array();
	}
	
	public function update_obp_options_category(){
		$this->db->cache_delete('admpro', 'vehicles');
		$id = $this->input->post('id');
		$data = array(					
			'Name' => $this->input->post('Name')	
		);
		$this->db->where('id', $id);
		$data = $this->security->xss_clean($data);
		$this->db->update('t_OBP_Option_Categories', $data);	
	}
	
	public function delete_obp_options_cat($id){
		$this->db->cache_delete('admpro', 'vehicles');
		$this->db->where('id', $id);
		$this->db->delete('t_OBP_Option_Categories');
	}

	public function obp_opt_cateogry_sort(){
		$sort = $this->input->post('sorting');
		$sorting_by = $this->input->post('sorting_by');		
		$query = $this->db->query("SELECT * FROM t_OBP_Option_Categories ORDER BY $sorting_by $sort");
		return $query->result_array();	
	}
	
/*============================ OBP remotes ==================================*/
	
	public function get_obp_remotes(){
		$query = $this->db->query("SELECT * FROM t_OBP_Remotes ");		
		return $query->result_array();
	}
	
	public function sort_remote_by_date(){
		$query = $this->db->query("SELECT * FROM t_Remotes ORDER BY id DESC ");		
		return $query->result_array();
	}
	
	public function get_vehicles(){		
		$modelId = $this->input->post('ModelId');
		$query = $this->db->query("SELECT * FROM t_Vehicles WHERE Model_UUID = ? ",  array($modelId));
		return $query->result_array();
	}
	
	public function get_obp_ptions(){
		$catId = $this->input->post('catId');
		$query = $this->db->query("SELECT * FROM t_OBP_Options WHERE Category_UUID = ? ",  array($catId));
		return $query->result_array();	
	}
	
	public function get_obp_image(){
		$catId = $this->input->post('catId');
		$query = $this->db->query("SELECT * FROM t_OBP_Options WHERE UUID = ? ",  array($catId));
		return $query->result_array();	
	}
	
	
	public function change_obp_image(){
		$image_Type_name = $this->input->post('Image_Type_UUID');
		$query = $this->db->query("SELECT * FROM t_Image_Types WHERE Name = ? ",  array($image_Type_name));	
		$return = $query->result_array();
		$Image_Type_UUID = $return[0]['UUID'];	
		$query2 = $this->db->query("SELECT * FROM t_Images WHERE Image_Type_UUID = ? ", array($Image_Type_UUID));	
		return $query2->result_array();
	}
	
	public function get_image_deafult_text(){
		$Default_Image_UUID = $this->input->post('Default_Image_UUID');	
		$query2 = $this->db->query("SELECT * FROM t_OBP_Options WHERE Default_Image_UUID = ? ", array($Default_Image_UUID));	
		return $query2->result_array();
	}
	
	public function save_obp_remote(){
		$this->db->cache_delete('admpro', 'vehicles');
		$vahicles_uid = "";
		$Vehicle_UUID = $this->input->post('Vehicle_UUID');
		foreach($Vehicle_UUID as $vehicle_uid){
			$vahicles_uid .= $vehicle_uid.'|';
		}
		$vahicles_uid2 = rtrim($vahicles_uid,"|");
		$sort_Order1 = $this->input->post('Sort_Order');
		$i = 0;
		foreach($sort_Order1 as $sort_Order){
			if($_POST['Image_UUID'][$i] == ""){
				$Image_UUID = 0;
			}else{
				$Image_UUID = $_POST['Image_UUID'][$i];
			}
			if($_POST['Text'][$i] == ""){
				$Text = 0;
			}else{
				$Text = $_POST['Text'][$i];
			}
			$data = array(
				'UUID' => md5(uniqid(mt_rand(), true)),	
				'unique_id' => $this->input->post('unique_id'),		
				'Vehicle_UUID' => $vahicles_uid2,
				'Image_UUID' => $Image_UUID,
				'Text' => $Text,
				'Procedure_Number' => $_POST['Procedure_Number'][$i],
				'Sort_Order' => $_POST['Sort_Order'][$i]	
			);
			$data = $this->security->xss_clean($data);
			$this->db->insert('t_OBP_Remotes', $data);
		 	$i++;	
		}
		
		return true;	
	}	
	public function get_obp_remote_info($uuid){
		$query = $this->db->query("SELECT * FROM t_OBP_Remotes WHERE unique_id = ? ", array($uuid));	
		return $query->result_array();
	}


/*==================== Add Part Type  ==================================================================*/

	public function get_part_types(){
		$query = $this->db->query("SELECT * FROM t_Lock_Types ORDER BY Name ");	
		return $query->result_array();
	}
	
	public function save_part_type(){
		$this->db->cache_delete('admpro', 'locks_types');
		$data = array(
			'UUID' => md5(uniqid(mt_rand(), true)),			
			'Name' => $this->input->post('Name')	
		);
		$data = $this->security->xss_clean($data);
		$this->db->insert('t_Lock_Types', $data);
	}
	
	public function get_part_type_info($id){
		$query = $this->db->query("SELECT * FROM t_Lock_Types WHERE id = ? ",array($id));	
		return $query->result_array();	
	}
	
	public function update_part_type(){
		$this->db->cache_delete('admpro', 'locks_types');
		$id = $this->input->post('id');
		$data = array(					
			'Name' => $this->input->post('Name')	
		);
		$this->db->where('id', $id);
		$data = $this->security->xss_clean($data);
		$this->db->update('t_Lock_Types', $data);
	}
	
	public function delete_part_type($id){
		$this->db->cache_delete('admpro', 'locks_types');
		$this->db->where('id', $id);
		$this->db->delete('t_Lock_Types');
	}

	public function get_parts(){
		$query = $this->db->query("SELECT * FROM t_Locks ORDER BY Part_Name ");	
		return $query->result_array();
	}
	public function get_partsRows(){		
		return $this->db->count_all("t_Locks");	
	}
	public function get_partsDetail($limit,$limt_start){
		$query = $this->db->query("SELECT * FROM t_Locks ORDER BY Part_Name LIMIT  ".(int)$limt_start.", ".(int)$limit."  ");	
		return $query->result_array();
	}
	public function save_parts(){
		$this->db->cache_delete('admpro', 'locks');
		$parts_vehicle_uuids = "";
		$parts_vehicle = $this->input->post('parts_vehicle');
		if(isset($parts_vehicle)){
			foreach($parts_vehicle as $vehicle_uid){
				$parts_vehicle_uuids .= $vehicle_uid.',';
			}
		}
		$parts_vehicle_uuids2 = rtrim($parts_vehicle_uuids,",");
		$data = array(
			'UUID' => md5(uniqid(mt_rand(), true)),
			'Part_Name' => $this->input->post('Part_Name'),
			'PartType_UUID' => $this->input->post('PartType_UUID'),			
			'Part_Image_Url' => $this->input->post('Part_Image_Url'),
			'Part_Image_CDN' => '',
			'Products' => $this->input->post('Products'),
			'Vehicles_UUID' => $parts_vehicle_uuids2
		);
		$data = $this->security->xss_clean($data);
		$this->db->insert('t_Locks', $data);
	}
	
	public function get_part_info($id){
		$query = $this->db->query("SELECT * FROM t_Locks WHERE id = ? ",array($id));	
		return $query->result_array();
	}
	
	public function update_parts(){
		$this->db->cache_delete('admpro', 'locks');
		$id = $this->input->post('id');
		$parts_vehicle_uuids = "";
		$parts_vehicle = $this->input->post('parts_vehicle');
		foreach($parts_vehicle as $vehicle_uid){
			$parts_vehicle_uuids .= $vehicle_uid.',';
		}
		$parts_vehicle_uuids2 = rtrim($parts_vehicle_uuids,",");
		$data = array(
			'Part_Name' => $this->input->post('Part_Name'),
			'PartType_UUID' => $this->input->post('PartType_UUID'),
			'Part_Image_Url' => $this->input->post('Part_Image_Url'),			
			'Products' => $this->input->post('Products'),
			'Vehicles_UUID' => $parts_vehicle_uuids2
		);
		$this->db->where('id', $id);
		$data = $this->security->xss_clean($data);
		$this->db->update('t_Locks', $data);
		return $parts_vehicle_uuids2;
	}
	
	
	public function delete_parts($id){
		$this->db->where('id', $id);
		$this->db->delete('t_Locks');
	}
	
	
	public function part_type_sorting(){
		$sort = $this->input->post('sorting');
		$sorting_by = $this->input->post('sorting_by');		
		$query = $this->db->query("SELECT * FROM t_Lock_Types ORDER BY $sorting_by $sort");
		return $query->result_array();
	}
	
	public function part_sorting(){
		$sort = $this->input->post('sorting');
		$sorting_by = $this->input->post('sorting_by');		
		$query = $this->db->query("SELECT * FROM t_Locks ORDER BY $sorting_by $sort");
		return $query->result_array();
	}
	
/*---------------------- Manage Methods -------------------------------------------------*/	
	
	public function get_methods(){	
		$query = $this->db->query("SELECT * FROM t_Methods ORDER BY Content ");	
		return $query->result_array();
	}
	public function getmethods($limit,$limit_start){	
		$query = $this->db->query("SELECT * FROM t_Methods ORDER BY Content  LIMIT $limit_start,$limit");	
		return $query->result_array();
	}
	public function getAllMethodRows(){	
		return $this->db->count_all("t_Methods");
	}
	public function save_method(){
		$this->db->cache_delete('admpro', 'vehicles');
		$vehicles_data = $this->input->post('Vehicle_UUID');
		$vehicles_id = "";
		foreach($vehicles_data as $vehicles){
			$vehicles_id .= $vehicles."|";
		}
		$vehicles_id2 = rtrim($vehicles_id,"|");

		$Videos_data = $this->input->post('Videos');
		$Videos_id = "";
		foreach($Videos_data as $Videos){
			$Videos_id .= $Videos."|";
		}
		$Videos_id2 = rtrim($Videos_id,"|");
		if($this->input->post('Image_path') != ""){
			$Image_path = $this->input->post('Image_path');
			$image_id = "";
			foreach($Image_path as $images){
				$image_id .= $images.",";
			}
			$image_id2 = rtrim($image_id,",");
		}else{
			$image_id2 = "";
		}
		$data = array(	
			'UUID' => $this->input->post('UUID'),			
			'Vehicle_UUID' => $vehicles_id2,	
			'Title' => addslashes($this->input->post('Title')),
			'Content' => addslashes($this->input->post('Content')),
			'User_UUID' => $this->input->post('User_UUID'),
			'Images' => $image_id2,
			'Score' => $this->input->post('Score'),
			'Videos' => $Videos_id2
		);
		$data = $this->security->xss_clean($data);
		$this->db->insert('t_Methods', $data);
	}
	
	public function get_method_info($id){
		$query = $this->db->query("SELECT * FROM t_Methods WHERE Id = ? ",array($id));	
		return $query->result_array();	
	}
	
	
	public function update_method(){
		$this->db->cache_delete('admpro', 'vehicles');
		$id = $this->input->post('id');
		$vehicles_data = $this->input->post('Vehicle_UUID');
		$vehicles_id = "";
		foreach($vehicles_data as $vehicles){
			$vehicles_id .= $vehicles."|";
		}
		$vehicles_id2 = rtrim($vehicles_id,"|");

		$Videos_data = $this->input->post('Videos');
		$Videos_id = "";
		foreach($Videos_data as $Videos){
			$Videos_id .= $Videos."|";
		}
		$Videos_id2 = rtrim($Videos_id,"|");
		if($this->input->post('Image_path') != ""){
			$Image_path = $this->input->post('Image_path');
			$image_id = "";
			foreach($Image_path as $images){
				$image_id .= $images.",";
			}
			$image_id2 = rtrim($image_id,",");
		}else{
			$image_id2 = "";
		}
		$data = array(					
			'Vehicle_UUID' => $vehicles_id2,	
			'Title' => addslashes($this->input->post('Title')),
			'Content' => addslashes($this->input->post('Content')),
			'User_UUID' => $this->input->post('User_UUID'),
			'Images' => $image_id2,
			'Score' => $this->input->post('Score'),
			'Videos' => $Videos_id2
		);
		$this->db->where('Id', $id);
		$data = $this->security->xss_clean($data);
		$this->db->update('t_Methods', $data);
	}
	
	public function delete_method($id){
		$this->db->where('Id', $id);
		$this->db->delete('t_Methods');
	}
	
	
/*-------------------------------- Update data to firebase --------------------------------------------*/
	
	public function get_AllMakes(){
		$query = $this->db->query("SELECT * FROM t_Makes ORDER BY Make_Name ");	
		return $query->result_array();
	}
	
	public function get_AllMakes2($limt_start, $limit){
		$query = $this->db->select("*")->limit;
		("SELECT * FROM t_Makes ORDER BY Make_Name LIMIT ".(int)$limt_start.", ".(int)$limit." ");	
		return $query->result_array();
	}
	
	public function get_Firebase_AllMakes(){
		$query = $this->db->query("SELECT * FROM t_Makes ORDER BY Make_Name ");	
		return $query->result_array();
	}
	
	public function get_aks_users($limt_start, $limit){
		$query = $this->db->query("SELECT * FROM t_Users ORDER BY FirstName LIMIT ".(int)$limt_start.", ".(int)$limit." ");	
		return $query->result_array();
	}

	public function get_aks_users_rows(){
		return $this->db->count_all("t_Users");
	}
	
	public function last_aks_results(){
		$query = $this->db->query("SELECT * FROM t_Users WHERE customer = ? ORDER BY Id DESC LIMIT 1",array(1));	
		return $query->result_array();
	}	
	
	public function update_aks_users($outputs){	
		 if(count($outputs) > 0){
			 //print_r($outputs);
			 $i = 1;		
		  foreach($outputs as $key => $users){
			      
				  if(isset($users['User_UUID'])){
				  		$user_UUID = $users['User_UUID'];
				   }else{
				   		$user_UUID = $users['user_UUID'];
				   }
				   if(isset($users['Email'])){
				  		$email = $users['Email'];
				   }else{
				   		$email = $users['email'];
				   }
				    if(isset($users['Password'])){
				  		$password = $users['Password'];
				   }else{
				   		$password = $users['password'];
				   }
				   if(isset($users['PhoneNumber'])){
				  		$phoneNumber = $users['PhoneNumber'];
				   }elseif(isset($users['phoneNumber'])){
				  		$phoneNumber = $users['phoneNumber'];
				   }else{
				   		$phoneNumber = '';
				   }
				   if(isset($users['FirstName'])){
				  		$firstName = $users['FirstName'];
				   }else if(isset($users['firstName'])){
				  		$firstName = $users['firstName'];
				   }else{
				   		$firstName = $users['UserName'];
				   }
				   if(isset($users['LastName'])){
				  		$lastName = $users['LastName'];
				   }else if(isset($users['lastName'])){
				  		$lastName = $users['lastName'];
				   }else{
				   		$lastName = '';
				   }
				   if(isset($users['Referral'])){
				  		$referral = $users['Referral'];
				   }else if(isset($users['referral'])){
				  		$referral = $users['referral'];
				   }else{
				   		$referral = '';
				   }
				   if(isset($users['Subscribe'])){
				  		$subscribe = $users['Subscribe'];
				   }else if(isset($users['subscribe'])){
				  		$subscribe = $users['subscribe'];
				   }else{
				   		$subscribe = '';
				   }
				   if(isset($users['PrivateKey'])){
				  		$privateKey = $users['PrivateKey'];
				   }else if(isset($users['privateKey'])){
				  		$privateKey = $users['privateKey'];
				   }else{
				   		$privateKey = '';
				   }
				   if(isset($users['Status'])){
				  		$status = $users['Status'];
				   }else if(isset($users['status'])){
				  		$status = $users['status'];
				   }else{
				   		$status = 'waiting for approved';
				   }
				  // echo $i.'--'.$lastName.'<br>';
				  $data = array(					
					  'User_UUID' => $user_UUID,				 
					  'Email' =>  $email,
					  'Password' =>  $password,
					  'PhoneNumber' =>  $phoneNumber,
					  'FirstName' =>  $firstName,
					  'LastName' =>  $lastName,
					  'PrivateKey' =>  $privateKey,
					  'Subscribe' =>  $subscribe,
					  'Status' =>  $status
				  );			  
				  $exitsQuery = $this->db->query("SELECT * FROM t_Users WHERE User_UUID = ? ", array($user_UUID));			 
				  if($exitsQuery->num_rows() > 0){
				  }else{
						$data = $this->security->xss_clean($data);
						$return_data =  $this->db->insert('t_Users', $data);
				  }
				$i++;	   
		    }
			return 1;
		}else{
			return 0;
		}
	}
/*------------------------------- AKS Users With FIebase ---------------------------------------*/

	public function change_users_status(){
		$uid = $this->input->post('uid');
		$status = $this->input->post('status');
		$data = array(					
			'Status' => $status
		);
		$this->db->where('Id', $uid);
		$data = $this->security->xss_clean($data);
		$this->db->update('t_Users', $data);	
	}	

/*---------------------- Add Correction Page -------------------------------------------*/
	
	public function get_corrections(){
		$query = $this->db->query("SELECT * FROM t_Corrections WHERE feed_from = ? AND deleted=? GROUP BY UUID ORDER BY id DESC", array('App',0));	
		return $query->result_array();
	}
	
	public function save_correction(){
		$user_type = $this->input->post('user_type');
		if( ($user_type == 0) || ($user_type == 1) || ($user_type == 2) ){
			$status = 'approved';
		}else{
			$status = 'pending';
		}
		$data = array(
			'UUID' => md5(uniqid(mt_rand(), true)),							
			'User_Email' => $this->input->post('email'),	
			'User_Name' => $this->input->post('user_name'),
			'User_Type' => $this->input->post('user_type'),
			'Vehicle_UUID' => $this->input->post('Vehicle_UUID'),
			'Feedback_type' => $this->input->post('feed_type'),
			'Status' => $status,
			'User_Review' => $this->input->post('review')
		);
		$data = $this->security->xss_clean($data);
		$this->db->insert('t_Corrections', $data);
	}
	
	public function get_corrections_info($id){
		$query = $this->db->query("SELECT * FROM t_Corrections WHERE id = ? ",array($id));	
		return $query->result_array();
	}
	
	public function update_correction(){
		$id = $this->input->post('id');
		$data = array(				
			'Vehicle_UUID' => $this->input->post('Vehicle_UUID'),
			'Feedback_type' => $this->input->post('feed_type'),
			'User_Review' => $this->input->post('review')
		);
		$this->db->where('id', $id);
		$data = $this->security->xss_clean($data);
		$this->db->update('t_Corrections', $data);
	}
	
	public function delete_correction($id){
		$this->db->where('id', $id);
		$this->db->delete('t_Corrections');
	}
	
	public function change_feedback_status(){
		$uid = $this->input->post('uid');
		$status = $this->input->post('status');
		$data = array(					
			'Status' => $status
		);
		$this->db->where('id', $uid);
		$data = $this->security->xss_clean($data);
		$this->db->update('t_Corrections', $data);	
	}	
	
	public function show_feedback_types(){
		$types = $this->input->post('types');	
		$columnName = $this->input->post('columnName');
		if($types == 'all'){
			$query = $this->db->query("SELECT * FROM t_Corrections WHERE feed_from = ? AND deleted=? GROUP BY UUID ORDER BY id DESC ", array('App',0));
		}else{			
			$query = $this->db->query("SELECT * FROM t_Corrections WHERE $columnName =? AND feed_from = ? AND deleted=? GROUP BY UUID", array($types,'App',0) );
		}
		return $query->result_array();
	}
	
	public function search_feedback(){
		$searchkey = $this->input->post('searchkey');
		$query = $this->db->query("SELECT * FROM t_Corrections WHERE Info LIKE '%$searchkey%' AND deleted=? GROUP BY UUID ", array(0) );
		return $query->result_array();
	}
	
	
/*=========================Admin website add enable using AutoPro switcher==============*/	
	
	public function enable_app(){
		$uid = $this->input->post('userid');
		$enabled = $this->input->post('value');
		$data = array(					
			'APP_switcher' => $this->input->post('value')
		);
		$this->db->where('UserID', $uid);
		$data = $this->security->xss_clean($data);
		$this->db->update('add_user', $data);
		/*
		$query = $this->db->query("SELECT * FROM add_user WHERE UserID = '$uid' ");		
		$return = $query->result_array();
		$email = $return[0]['email'];
		$cust_query = $this->admin_db->query("SELECT * FROM customers WHERE customers_email_address = '$email'");
		if($cust_query->num_rows() == 0){
			$data = array(
				'customers_firstname' => $return[0]['user_name'],							
				'customers_email_address' => $return[0]['email'],
				'customers_password' => $return[0]['password'],
				'customers_authorization' => $enabled
			);
			$this->admin_db->insert('customers', $data);	
		}else{
			$data = array(				
				'customers_authorization' => $enabled
			);
			$this->admin_db->where('customers_email_address', $email);
			$this->admin_db->update('customers', $data);
		}*/
			
	}
	
	public function get_dev_customer(){
		$query = $this->admin_db->query("SELECT * FROM customers");
		return $query->result_array();
	}
	
	public function get_all_vehicles(){
		$query = $this->db->query("SELECT * FROM t_Vehicles");
		return $query->result_array();
	}
	
	public function get_all_vehicles2(){
		$query = $this->db->query("SELECT * FROM t_Vehicles ORDER BY id DESC");
		return $query->result_array();
	}

/*--------------------------------Vehicle Sorting By Make ---------------------------------------------------------*/

	public function vehicle_sort_by_make($limit,$limt_start){	
		if(isset($_SESSION['global_sorting']) && $_SESSION['global_sorting'] !=""){
			$global_sorting = $_SESSION['global_sorting'];
		}else{
			$global_sorting = "t_Makes.Make_Name, t_Models.Model_Name";
		}	
		$makeId = $this->input->post('makeId');			
		$query = $this->db->query("SELECT t_Vehicles.gen,t_Vehicles.Parts_Keys,t_Vehicles.Parts_Chips,t_Vehicles.Parts_Batteries,t_Vehicles.gen_notes,t_Models.Vehicle_Type_UUID,t_Vehicles.image_url,t_Makes.Make_Name,t_Vehicles.UUID,t_Models.Model_Name,t_Vehicles.id,t_Vehicles.Model_UUID,t_Vehicles.Years,t_Vehicles.Code_Series_UUID,t_Vehicles.Retainer_UUID,t_Vehicles.Mechanical_Key_UUID,t_Vehicles.Chip_Key_UUID,t_Vehicles.Remote_UUID,t_Vehicles.RHK_UUID,t_Vehicles.SmartKey_UUID,t_Vehicles.MVP_System,t_Vehicles.MVP_Dongle_UUID,t_Vehicles.MVP_SmartCard,t_Vehicles.MVP_Software,t_Vehicles.MVP_PIN_Required,t_Vehicles.MVP_PIN_Read,t_Vehicles.ProLok_Tool_UUID,t_Vehicles.ProLok_Linkage,t_Vehicles.Vehicle_Image,t_Vehicles.Image_UUID,t_Vehicles.MVP_Notes,t_Vehicles.APP_System,t_Vehicles.APP_Add_Keys,t_Vehicles.APP_All_Keys_Lost,t_Vehicles.APP_Notes,t_Vehicles.HW_Key_Prog,t_Vehicles.HW_Remote_Prog,t_Vehicles.HW_Misc_Prog,t_Vehicles.TKOSDD_System,t_Vehicles.TKOSDD_SDD_Adapter,t_Vehicles.TKOSDD_SDD_Cable,t_Vehicles.TKOSDD_TKO_Cable,t_Vehicles.TKOSDD_Notes,t_Vehicles.APP_Confirmed_Working,t_Vehicles.DMax_System,t_Vehicles.DMax_Method,t_Vehicles.Parts_Ignition,t_Vehicles.Parts_Door,t_Vehicles.Parts_Accessories,t_Vehicles.Vehicle_Type,t_Vehicles.Tumblers,t_Vehicles.OBD_Location_Text,t_Vehicles.OBD_Location_Image,t_Vehicles.APP_Programs_Remote,t_Vehicles.APP_Resync_Available,t_Vehicles.PIN_Read FROM t_Vehicles JOIN t_Models ON t_Models.UUID = t_Vehicles.Model_UUID 		LEFT JOIN t_Makes ON t_Makes.UUID = t_Models.Make_UUID WHERE t_Makes.UUID = ?  ORDER BY ".$global_sorting." LIMIT  ".(int)$limt_start.", ".(int)$limit." ",array($makeId));
		return $query->result_array();
	}

	public function vehicle_sort_by_make2(){
		$modal_ids = "";
		$makeId = $this->input->post('makeId');
		$model_query22 = $this->db->query("SELECT * FROM t_Models WHERE Make_UUID = ? ",array($makeId));
		$model_query12 = $model_query22->result_array();
		foreach($model_query12 as $model_idss){
			//$modal_ids = $model_query12[0]['UUID'];
			$modal_ids .= "'". $model_idss['UUID']."',";
		}
		$modal_ids2 = rtrim($modal_ids,",");	
		if($modal_ids2 ==""){
			$modal_ids2 = '0';
		}else{
			$modal_ids2 = $modal_ids2;
		}	
		$query = $this->db->query("SELECT * FROM t_Vehicles WHERE Model_UUID IN($modal_ids2) ");
		return $query->result_array();
	}
	
	public function update_vehicle_image(){
		$Vehicle_Image = $this->input->post('Vehicle_Image');
		$vehicle_id = $this->input->post('vehicle_id');
		$data = array(				
			'Vehicle_Image' => $Vehicle_Image
		);
		$this->db->where('id', $vehicle_id);
		$data = $this->security->xss_clean($data);
		$this->db->update('t_Vehicles', $data);
	}
	
	public function user_correction(){
		$status = $this->input->post('status');
		$query = $this->db->query("SELECT * FROM t_Corrections WHERE Status = ? AND deleted=? GROUP BY UUID ",array($status,0));
		return $query->result_array();
	}
	public function get_all_vehicles_images(){
		$query = $this->db->query("SELECT * FROM vehicle_images ORDER BY Image_id DESC ");
		return $query->result_array();
	}
	
	public function vehicle_images(){
		$status = $this->input->post('status');
		$query = $this->db->query("SELECT * FROM vehicle_images WHERE Status = ? ",array($status));
		return $query->result_array();
	}	
	public function us_methods(){
		if($this->input->post('status') == 'pending'){
			$status = 'Waiting for Approval';
		}else{
			$status = ucfirst($this->input->post('status'));
		}
		$query = $this->db->query("SELECT * FROM t_Methods WHERE Status = ? ",array($status));
		return $query->result_array();
	}	
	public function type_user_correction(){		
		$query = $this->db->query("SELECT * FROM t_Corrections WHERE deleted=? ",array(0));
		return $query->result_array();
	}
	public function type_vehicle_images(){		
		$query = $this->db->query("SELECT * FROM vehicle_images");
		return $query->result_array();
	}	
	public function type_us_methods(){		
		$query = $this->db->query("SELECT * FROM t_Methods ");
		return $query->result_array();
	}
	
	
	public function search_user_correction(){
		$search_key = $this->input->post('search_key');
		$query = $this->db->query("SELECT * FROM t_Corrections WHERE Feedback_type LIKE '%$search_key%' OR User_Review LIKE '%$search_key%' OR Info LIKE '%$search_key%' AND deleted='0' GROUP BY UUID");
		return $query->result_array();
	}
	public function search_vehicle_images(){
		$search_key = $this->input->post('search_key');
		$query = $this->db->query("SELECT * FROM vehicle_images WHERE Title LIKE '%$search_key%' ");
		return $query->result_array();
	}	
	public function search_us_methods(){
		$search_key = $this->input->post('search_key');
		$query = $this->db->query("SELECT * FROM t_Methods WHERE  Title LIKE '%$search_key%' OR Content LIKE '%$search_key%' ");
		return $query->result_array();
	}	


/*--------------------------- Code Series Sorting------------------------------------------*/
	
	public function code_series_sort(){	
		$sort = $this->input->post('sorting');
		$sorting_by = $this->input->post('sorting_by');		
		$query = $this->db->query("SELECT * FROM t_Code_Series ORDER BY $sorting_by $sort");
		return $query->result_array();
	}
	
	public function code_series_uuid_sort(){
		$sort = $this->input->post('sorting');
		$sorting_by = $this->input->post('sorting_by');	
		if( $sorting_by == 'Key_Style_UUID' ){	
			$query = $this->db->query("SELECT * FROM t_Code_Series JOIN t_Key_Styles ON t_Code_Series.Key_Style_UUID = t_Key_Styles.UUID ORDER BY t_Key_Styles.Key_Style_Name");
		}else {
			$query = $this->db->query("SELECT * FROM t_Code_Series JOIN t_Machines_Info ON t_Code_Series.$sorting_by = t_Machines_Info.UUID ORDER BY t_Machines_Info.Name");
		}
		return $query->result_array();
	}
	
	public function keys_uuid_sorting(){
		$sort = $this->input->post('sorting');
		$sorting_by = $this->input->post('sorting_by');	
		if($sorting_by == 'Key_Type_UUID' ){
			$query = $this->db->query("SELECT * FROM t_Keys JOIN t_Key_Types ON t_Keys.Key_Type_UUID = t_Key_Types.UUID ORDER BY t_Key_Types.Key_Type_Name");
		}else if($sorting_by == 'Chip_UUID' ){
			$query = $this->db->query("SELECT * FROM t_Keys JOIN t_Chips ON t_Keys.Chip_UUID = t_Chips.UUID ORDER BY t_Chips.Chip_Name");
		}		
		return $query->result_array();
	}

/*--------------------- AutProPAD --------------------------------------------------------------*/
	
	public function get_purchase_history_rows(){
		return $this->db->count_all("t_Machine_Purchases");
	}
	
	public function get_all_purchase_history_rows(){
		$query = $this->db->query("SELECT * FROM t_Machine_Purchases ORDER BY Order_Date DESC");
		return $query->result_array();
	}
	
	public function get_purchase_history($limit,$limt_start){
		$query = $this->db->query("SELECT * FROM t_Machine_Purchases ORDER BY Product ASC, Order_Date ASC LIMIT ".(int)$limt_start.", ".(int)$limit." ");
		return $query->result_array();
	}
	
	public function get_purchase_history_sort($limit,$limt_start,$purchases_sorting,$purchase_sort_order){
		$query = $this->db->query("SELECT * FROM t_Machine_Purchases ORDER BY $purchases_sorting $purchase_sort_order LIMIT  ".(int)$limt_start.", ".(int)$limit." ");
		return $query->result_array();
	}
	
	public function get_purchase_history_sort_search_rows($purchases_sorting,$purchase_sort_order,$purchases_search_val){
		$value = $purchases_search_val;
		if($value == 'all'){
			$query = $this->db->query("SELECT * FROM t_Machine_Purchases ORDER BY $purchases_sorting $purchase_sort_order");
		}else if($value == 'All VVDI Machines'){
			$VVDI = 'VVDI';
			$query = $this->db->query("SELECT * FROM t_Machine_Purchases WHERE Product LIKE '%$VVDI%' ORDER BY $purchases_sorting $purchase_sort_order");
		}else if($value == 'PS80, PS90 & AutoProPAD'){
			$query = $this->db->query("SELECT * FROM t_Machine_Purchases WHERE Product =?  OR Product =?  OR Product =?  ORDER BY $purchases_sorting $purchase_sort_order", array('PS80','PS90','AutoProPAD'));
		}else{
			$query = $this->db->query("SELECT * FROM t_Machine_Purchases WHERE Product = ? ORDER BY $purchases_sorting $purchase_sort_order",array($value));
		}
		//$query = $this->db->query("SELECT * FROM t_Machine_Purchases ORDER BY $purchases_sorting $purchase_sort_order LIMIT  ".(int)$limt_start.", ".(int)$limit." ");
		return $query->result_array();
	}

	public function get_purchase_history_sort_search($limit,$limt_start,$purchases_sorting,$purchase_sort_order,$purchases_search_val){
		$value = $purchases_search_val;
		if($value == 'all'){
			$query = $this->db->query("SELECT * FROM t_Machine_Purchases ORDER BY $purchases_sorting $purchase_sort_order LIMIT  ".(int)$limt_start.", ".(int)$limit." ");
		}else if($value == 'All VVDI Machines'){
			$query = $this->db->query("SELECT * FROM t_Machine_Purchases WHERE Product LIKE 'VVDI%' ORDER BY $purchases_sorting $purchase_sort_order LIMIT  ".(int)$limt_start.", ".(int)$limit." ");
		}else if($value == 'PS80, PS90 & AutoProPAD'){
			$query = $this->db->query("SELECT * FROM t_Machine_Purchases WHERE Product = ? OR Product = ? OR Product = ? ORDER BY $purchases_sorting $purchase_sort_order LIMIT  ".(int)$limt_start.", ".(int)$limit." ",array('PS80','PS90','AutoProPAD'));
		}else{
			$query = $this->db->query("SELECT * FROM t_Machine_Purchases WHERE Product = ? ORDER BY $purchases_sorting $purchase_sort_order LIMIT  ".(int)$limt_start.", ".(int)$limit." ", array($value));
		}
		//$query = $this->db->query("SELECT * FROM t_Machine_Purchases ORDER BY $purchases_sorting $purchase_sort_order LIMIT  ".(int)$limt_start.", ".(int)$limit." ");
		return $query->result_array();
	}
	
	public function save_purchases(){
		$this->db->cache_delete('admpro', 'purchase_history');
		$Order_Date = date('Y-m-d', strtotime($this->input->post('Order_Date')));
		$data = array(						
			'Serial_Number' => ltrim($this->input->post('Serial_Number'), '-'),
			'Order_Number' => $this->input->post('Order_Number'),
			'Order_Date' => $Order_Date,
			'Product' => $this->input->post('Product'),
			'Customer_Name' => $this->input->post('Customer_Name'),
			'Customer_Company' => $this->input->post('Customer_Company'),
			'Customer_Email' => $this->input->post('Customer_Email'),
			'Status' => $this->input->post('Status'),
			'Notes' => $this->input->post('Notes'),
			'Sale_Price' => $this->input->post('Sale_Price'),
			'Support_Paid_Date' => $this->input->post('Support_Paid_Date'),
			'Support_Paid_Amount' => $this->input->post('Support_Paid_Amount')
		);
		$data = $this->security->xss_clean($data);
		$this->db->insert('t_Machine_Purchases', $data);
	}
	
	public function purchase_info($id){
		$query = $this->db->query("SELECT * FROM t_Machine_Purchases WHERE id = ? ",array($id));
		return $query->result_array();
	}
	
	public function update_purchases(){
		$this->db->cache_delete('admpro', 'purchase_history');
		$Order_Date = date('Y-m-d', strtotime($this->input->post('Order_Date')));
		$id = $this->input->post('id');
		$data = array(						
			'Serial_Number' => ltrim($this->input->post('Serial_Number'), '-'),
			'Order_Number' => $this->input->post('Order_Number'),
			'Order_Date' => $Order_Date,
			'Product' => $this->input->post('Product'),
			'Customer_Name' => $this->input->post('Customer_Name'),
			'Customer_Company' => $this->input->post('Customer_Company'),
			'Customer_Email' => $this->input->post('Customer_Email'),
			'Status' => $this->input->post('Status'),
			'Notes' => $this->input->post('Notes'),
			'Sale_Price' => $this->input->post('Sale_Price'),
			'Support_Paid_Date' => $this->input->post('Support_Paid_Date'),
			'Support_Paid_Amount' => $this->input->post('Support_Paid_Amount')
		);
		$this->db->where('id', $id);
		$data = $this->security->xss_clean($data);
		$this->db->update('t_Machine_Purchases', $data);
	}
	
	public function delete_purchases($id){
		$this->db->cache_delete('admpro', 'purchase_history');
		$this->db->where('id', $id);
		$this->db->delete('t_Machine_Purchases');
	}
	
	public function purchases_sorting(){
		$this->db->cache_delete('admpro', 'purchases_sorting');
		$sort = $this->input->post('sorting');
		$sorting_by = $this->input->post('sorting_by');		
		$query = $this->db->query("SELECT * FROM t_Machine_Purchases ORDER BY $sorting_by $sort LIMIT 50");
		return $query->result_array();
	}
	
	public function purchases_sorting_search($purchases_search_val){
		$sort = $this->input->post('sorting');
		$sorting_by = $this->input->post('sorting_by');	
		$value = $purchases_search_val;
		if($value == 'all'){
			$query = $this->db->query("SELECT * FROM t_Machine_Purchases ORDER BY $sorting_by $sort");
		}else if($value == 'PS80, PS90 & AutoProPAD'){
			$query = $this->db->query("SELECT * FROM t_Machine_Purchases WHERE Product = ? OR Product =? OR Product =? ORDER BY $sorting_by $sort LIMIT 50", array('PS80','PS90','AutoProPAD'));
		}else{
			$query = $this->db->query("SELECT * FROM t_Machine_Purchases WHERE Product = ? ORDER BY $sorting_by $sort LIMIT 50",array($value));
		}	
		return $query->result_array();
	}
	
	public function purchase_input_update(){
		$column_name = $this->input->post('columnName');
		if($column_name == 'Support_Paid_Date'){
			$key = $this->input->post('key');
			$data = array('Support_Paid_Date' => $this->input->post('Support_Paid_Date'), 'Support_Paid_Amount' => $this->input->post('Support_Paid_Amount'));			
			$this->db->where('id', $key);
			$data = $this->security->xss_clean($data);
			$this->db->update('t_Machine_Purchases', $data);
			return $this->input->post('Support_Paid_Date').'<br>$'.$this->input->post('Support_Paid_Amount');		
		}else if($column_name == 'Order_Date'){
			foreach($_POST[$column_name] as $key => $val) {
				$data = array($column_name => date('Y-m-d', strtotime($val)) );			
				$this->db->where('id', $key);
				$data = $this->security->xss_clean($data);
				$this->db->update('t_Machine_Purchases', $data);
			}			
			if(isset($val)){			
					return $val;
			}else{
				return '';
			}		
		}else if($column_name == 'Sale_Price'){
			foreach($_POST[$column_name] as $key => $val) {
				$data = array($column_name => (int)$val);			
				$this->db->where('id', $key);
				$data = $this->security->xss_clean($data);
				$this->db->update('t_Machine_Purchases', $data);
			}			
			if(isset($val)){			
					return $val;
			}else{
				return '';
			}		
		}else{
			foreach($_POST[$column_name] as $key => $val) {
				$data = array($column_name => $val);			
				$this->db->where('id', $key);
				$data = $this->security->xss_clean($data);
				$this->db->update('t_Machine_Purchases', $data);
			}			
			if(isset($val)){			
				return $val;
			}else{
				return '';
			}
		}
	}
	
	public function get_purchase_feedback_rows(){
		return $this->db->count_all("t_AutoProPAD_Feedback");
	}
	
	
	
	public function get_purchase_feedbacks($limit,$limt_start){
		$query = $this->db->query("SELECT * FROM t_AutoProPAD_Feedback ORDER BY id DESC LIMIT  ".(int)$limt_start.", ".(int)$limit." ");
		return $query->result_array();
	}
	
	public function get_last_feedback(){
		$query = $this->db->query("SELECT * FROM t_AutoProPAD_Feedback ORDER BY id DESC");
		return $query->result_array();
	}
	
	public function save_feedback(){
		$this->db->cache_delete('admpro', 'autopropad');
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
			'Phone' => $this->input->post('Phone'),			
			'Worked' => $this->input->post('Worked'),
			'Confirmed_Working' => $this->input->post('Confirmed_Working')
		);
		$data = $this->security->xss_clean($data);
		$this->db->insert('t_AutoProPAD_Feedback', $data);
	}
	
	public function feedback_info($id){
		$query = $this->db->query("SELECT * FROM t_AutoProPAD_Feedback WHERE id =? ",array($id));
		return $query->result_array();
	}
	
	public function update_feedback(){
		$this->db->cache_delete('admpro', 'autopropad');
		$Order_Date = date('Y-m-d', strtotime($this->input->post('Date')));
		$id = $this->input->post('id');
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
			'Phone' => $this->input->post('Phone'),
			'Worked' => $this->input->post('Worked'),
			'Confirmed_Working' => $this->input->post('Confirmed_Working')
		);
		$this->db->where('id', $id);
		$data = $this->security->xss_clean($data);
		$this->db->update('t_AutoProPAD_Feedback', $data);
	}
	
	public function delete_feedbacks($id){
		$this->db->cache_delete('admpro', 'autopropad');
		$this->db->where('id', $id);
		$this->db->delete('t_AutoProPAD_Feedback');
	}
	
	public function feedback_sorting(){
		$sort = $this->input->post('sorting');
		$sorting_by = $this->input->post('sorting_by');		
		$query = $this->db->query("SELECT * FROM t_AutoProPAD_Feedback ORDER BY $sorting_by $sort");
		return $query->result_array();
	}
	
	public function feedback_input_update(){
		$column_name = $this->input->post('columnName');
		foreach($_POST[$column_name] as $key => $val) {
			$data = array($column_name => $val);			
			$this->db->where('id', $key);
			$data = $this->security->xss_clean($data);
			$this->db->update('t_AutoProPAD_Feedback', $data);
		}			
		if(isset($val)){			
				return $val;
		}else{
			return '';
		}
	}
	
	public function search_feedbacks(){
		$search_key = $this->input->post('search_key');
	 $query = $this->db->query("SELECT * FROM t_AutoProPAD_Feedback WHERE Vehicle LIKE '%$search_key%' OR Description LIKE '%$search_key%' OR Submitted_By LIKE '%$search_key%'");
		return $query->result_array();
	}

/*--------------------------- E-comm users ---------------------------------------------*/

	public function get_ecomm_users_rows(){
		return $this->admin_db->count_all("customers");
	}
	
	public function get_ecomm_users($limit,$limt_start){
		$query = $this->admin_db->query("SELECT * FROM customers ORDER BY customers_firstname LIMIT  ".(int)$limt_start.", ".(int)$limit." ");
		return $query->result_array();
	}
	
	public function get_aks_users_info($id){
		$query = $this->db->query("SELECT * FROM t_Users WHERE Id = ? ",array($id));
		return $query->result_array();
	}
	
	public function get_aks_users_info2($id){
		$query = $this->db->query("SELECT * FROM t_Users WHERE User_UUID =? ",array($id));
		return $query->result_array();
	}
	
	public function update_aks_db_users(){
		$id = $this->input->post('id');
		$data = array(						 
			'Email' =>  $this->input->post('Email'),			
			'PhoneNumber' =>  $this->input->post('PhoneNumber'),
			'FirstName' =>  $this->input->post('FirstName'),
			'LastName' =>  $this->input->post('LastName'),			
			'Status' =>  $this->input->post('Status')
		);
		$this->db->where('Id', $id);
		$data = $this->security->xss_clean($data);
		$this->db->update('t_Users', $data);
	}
	
	public function update_aks_db_users2(){
		$id = $this->input->post('id');
		$data = array(						 
			'Email' =>  $this->input->post('Email'),			
			'PhoneNumber' =>  $this->input->post('PhoneNumber'),
			'FirstName' =>  $this->input->post('FirstName'),
			'LastName' =>  $this->input->post('LastName'),			
			'Status' =>  $this->input->post('Status')
		);
		$this->db->where('User_UUID', $id);
		$data = $this->security->xss_clean($data);
		$this->db->update('t_Users', $data);
	}
	
	public function purchase_products_filter(){
		$value = $this->input->post('value');
		if($value == 'all'){
			$query = $this->db->query("SELECT * FROM t_Machine_Purchases");
		}else if($value == 'All VVDI Machines'){
			$query = $this->db->query("SELECT * FROM t_Machine_Purchases WHERE Product LIKE '%VVDI%'");
		}else if($value == 'PS80, PS90 & AutoProPAD'){
			$query = $this->db->query("SELECT * FROM t_Machine_Purchases WHERE Product =? OR Product =? OR Product =? ",array('PS80','PS90','AutoProPAD'));
		}else{
			$query = $this->db->query("SELECT * FROM t_Machine_Purchases WHERE Product = ? ",array($value));
		}
		return $query->result_array();
	}
	
	public function purchase_products_filter_sort($purchases_sorting,$purchase_sort_order){
		$value = $this->input->post('value');
		if($value == 'all'){
			$query = $this->db->query("SELECT * FROM t_Machine_Purchases ORDER BY $purchases_sorting $purchase_sort_order");
		}else if($value == 'All VVDI Machines'){
			$query = $this->db->query("SELECT * FROM t_Machine_Purchases WHERE Product LIKE '%VVDI%' ORDER BY $purchases_sorting $purchase_sort_order");
		}else if($value == 'PS80, PS90 & AutoProPAD'){
			$query = $this->db->query("SELECT * FROM t_Machine_Purchases WHERE Product = ? OR Product = ? OR Product = ? ORDER BY $purchases_sorting $purchase_sort_order",array('PS80','PS90','AutoProPAD'));
		}else{
			$query = $this->db->query("SELECT * FROM t_Machine_Purchases WHERE Product = ? ORDER BY $purchases_sorting $purchase_sort_order",array($value));
		}
		return $query->result_array();
	}
	
	public function search_purchases(){
	 $this->db->cache_delete('admpro', 'search_purchases');	
	 $search_key = $this->input->post('search_key');
	 $query = $this->db->query("SELECT * FROM t_Machine_Purchases WHERE Customer_Name LIKE '%$search_key%' OR Order_Number LIKE '%$search_key%' OR Serial_Number LIKE '%$search_key%' OR Notes LIKE '%$search_key%' OR Customer_Email LIKE '%$search_key%'");
		return $query->result_array();
	}
	
	public function search_purchases_sort($purchases_sorting,$purchase_sort_order){
		$search_key = $this->input->post('search_key');
	 $query = $this->db->query("SELECT * FROM t_Machine_Purchases WHERE Customer_Name LIKE '%$search_key%' OR Order_Number LIKE '%$search_key%' OR Serial_Number LIKE '%$search_key%' OR Notes LIKE '%$search_key%' OR Customer_Email LIKE '%$search_key%' ORDER BY $purchases_sorting $purchase_sort_order");
		return $query->result_array();
	}

/*--------------------------- aksDev Customers -------------------------------------*/
	
	public function get_aksdev_customers(){
		$last_inserted = $this->input->post('last_inserted');
		$query = $this->admin_db->query("SELECT * FROM customers WHERE customers_id > $last_inserted");
		//$query = $this->admin_db->query("SELECT customers_id, customers_firstname,customers_lastname,customers_email_address,customers_telephone,customers_password  FROM customers");
		return $query->result_array();
	}
	
	public function feedback_worked_filter(){
		$value = $this->input->post('value');
		if($value == 'all'){
			$query = $this->db->query("SELECT * FROM t_AutoProPAD_Feedback");
		}else{
			$query = $this->db->query("SELECT * FROM t_AutoProPAD_Feedback WHERE Worked = ? ",array($value));
		}
		return $query->result_array();
	}
	
	
/*=============================== Admin Access Page Editing =========================================*/

	public function adminAccess_input_update(){
		$column_name = $this->input->post('columnName');
		foreach($_POST[$column_name] as $key => $val) {
			$data = array($column_name => $val);
			$this->db->where('UserID', $key);
			$data = $this->security->xss_clean($data);
			$this->db->update('add_user', $data);
		}			
		if(isset($val)){
			return $val;
		}else{
			return '';
		}
	}
	
	
	public function get_announcements_rows(){
		return $this->db->count_all("t_AutoProPAD_Announcements");
	}
	
	public function get_announcements($limit,$limt_start){
		$query = $this->db->query("SELECT * FROM t_AutoProPAD_Announcements ORDER BY id DESC LIMIT  ".(int)$limt_start.", ".(int)$limit." ");
		return $query->result_array();
	}
	
	
	public function delete_annoucement($id){
		$this->db->where('id', $id);
		$this->db->delete('t_AutoProPAD_Announcements');	
	}
	
	public function annouce_input_update(){
		$column_name = $this->input->post('columnName');
		foreach($_POST[$column_name] as $key => $val) {
			$data = array($column_name => $val);			
			$this->db->where('id', $key);
			$data = $this->security->xss_clean($data);
			$this->db->update('t_AutoProPAD_Announcements', $data);
		}			
		if(isset($val)){			
				return $val;
		}else{
			return '';
		}
	}
	
	public function save_announcement(){
		$this->db->cache_delete('admpro', 'autopropad');
		$Order_Date = date('Y-m-d', strtotime($this->input->post('Order_Date')));
		$data = array(						
			'Description' => $this->input->post('description'),
			'Submitted_by' => $this->input->post('Submitted_by')
		);
		$data = $this->security->xss_clean($data);
		$this->db->insert('t_AutoProPAD_Announcements', $data);
	}
	
	public function show_vehicle_by_type_count($type){
		$query = $this->db->query("SELECT t_Models.Vehicle_Type_UUID FROM t_Makes JOIN  t_Models ON t_Makes.UUID = t_Models.Make_UUID JOIN t_Vehicles ON  t_Models.UUID = t_Vehicles.Model_UUID WHERE t_Models.Vehicle_Type_UUID = ? ORDER BY t_Makes.Make_Name,t_Models.Model_Name ",array($type));
		return $query->num_rows();
	}

	public function show_vehicle_by_type($limit,$limt_start){
		$type = $this->input->post('type');
		if(isset($_SESSION['global_sorting']) && $_SESSION['global_sorting'] !=""){
			$global_sorting = $_SESSION['global_sorting'];
		}else{
			$global_sorting = "t_Makes.Make_Name, t_Models.Model_Name";
		}
		if($type == 'All'){
			$query = $this->db->query("SELECT t_Vehicles.gen,t_Vehicles.Parts_Keys,t_Vehicles.Parts_Chips,t_Vehicles.Parts_Batteries,t_Vehicles.gen_notes,t_Models.Vehicle_Type_UUID,t_Vehicles.image_url,t_Makes.Make_Name,t_Vehicles.UUID,t_Models.Model_Name,t_Vehicles.id,t_Vehicles.Model_UUID,t_Vehicles.Years,t_Vehicles.Code_Series_UUID,t_Vehicles.Retainer_UUID,t_Vehicles.Mechanical_Key_UUID,t_Vehicles.Chip_Key_UUID,t_Vehicles.Remote_UUID,t_Vehicles.RHK_UUID,t_Vehicles.SmartKey_UUID,t_Vehicles.MVP_System,t_Vehicles.MVP_Dongle_UUID,t_Vehicles.MVP_SmartCard,t_Vehicles.MVP_Software,t_Vehicles.MVP_PIN_Required,t_Vehicles.MVP_PIN_Read,t_Vehicles.ProLok_Tool_UUID,t_Vehicles.ProLok_Linkage,t_Vehicles.Vehicle_Image,t_Vehicles.Image_UUID,t_Vehicles.MVP_Notes,t_Vehicles.APP_System,t_Vehicles.APP_Add_Keys,t_Vehicles.APP_All_Keys_Lost,t_Vehicles.APP_Notes,t_Vehicles.HW_Key_Prog,t_Vehicles.HW_Remote_Prog,t_Vehicles.HW_Misc_Prog,t_Vehicles.TKOSDD_System,t_Vehicles.TKOSDD_SDD_Adapter,t_Vehicles.TKOSDD_SDD_Cable,t_Vehicles.TKOSDD_TKO_Cable,t_Vehicles.TKOSDD_Notes,t_Vehicles.APP_Confirmed_Working,t_Vehicles.DMax_System,t_Vehicles.DMax_Method,t_Vehicles.Parts_Ignition,t_Vehicles.Parts_Door,t_Vehicles.Parts_Accessories,t_Vehicles.Vehicle_Type,t_Vehicles.Tumblers,t_Vehicles.OBD_Location_Text,t_Vehicles.OBD_Location_Image,t_Vehicles.APP_Programs_Remote,t_Vehicles.APP_Resync_Available,t_Vehicles.PIN_Read FROM t_Makes JOIN  t_Models ON t_Makes.UUID = t_Models.Make_UUID JOIN t_Vehicles ON  t_Models.UUID = t_Vehicles.Model_UUID ORDER BY ".$global_sorting." LIMIT  ".(int)$limt_start.", ".(int)$limit." ");	
		}else{
			$query = $this->db->query("SELECT t_Vehicles.gen,t_Vehicles.Parts_Keys,t_Vehicles.Parts_Chips,t_Vehicles.Parts_Batteries,t_Vehicles.gen_notes,t_Models.Vehicle_Type_UUID,t_Vehicles.image_url,t_Makes.Make_Name,t_Vehicles.UUID,t_Models.Model_Name,t_Vehicles.id,t_Vehicles.Model_UUID,t_Vehicles.Years,t_Vehicles.Code_Series_UUID,t_Vehicles.Retainer_UUID,t_Vehicles.Mechanical_Key_UUID,t_Vehicles.Chip_Key_UUID,t_Vehicles.Remote_UUID,t_Vehicles.RHK_UUID,t_Vehicles.SmartKey_UUID,t_Vehicles.MVP_System,t_Vehicles.MVP_Dongle_UUID,t_Vehicles.MVP_SmartCard,t_Vehicles.MVP_Software,t_Vehicles.MVP_PIN_Required,t_Vehicles.MVP_PIN_Read,t_Vehicles.ProLok_Tool_UUID,t_Vehicles.ProLok_Linkage,t_Vehicles.Vehicle_Image,t_Vehicles.Image_UUID,t_Vehicles.MVP_Notes,t_Vehicles.APP_System,t_Vehicles.APP_Add_Keys,t_Vehicles.APP_All_Keys_Lost,t_Vehicles.APP_Notes,t_Vehicles.HW_Key_Prog,t_Vehicles.HW_Remote_Prog,t_Vehicles.HW_Misc_Prog,t_Vehicles.TKOSDD_System,t_Vehicles.TKOSDD_SDD_Adapter,t_Vehicles.TKOSDD_SDD_Cable,t_Vehicles.TKOSDD_TKO_Cable,t_Vehicles.TKOSDD_Notes,t_Vehicles.APP_Confirmed_Working,t_Vehicles.DMax_System,t_Vehicles.DMax_Method,t_Vehicles.Parts_Ignition,t_Vehicles.Parts_Door,t_Vehicles.Parts_Accessories,t_Vehicles.Vehicle_Type,t_Vehicles.Tumblers,t_Vehicles.OBD_Location_Text,t_Vehicles.OBD_Location_Image,t_Vehicles.APP_Programs_Remote,t_Vehicles.APP_Resync_Available,t_Vehicles.PIN_Read FROM t_Makes JOIN  t_Models ON t_Makes.UUID = t_Models.Make_UUID JOIN t_Vehicles ON  t_Models.UUID = t_Vehicles.Model_UUID WHERE  t_Models.Vehicle_Type_UUID = ? ORDER BY ".$global_sorting." LIMIT  ".(int)$limt_start.", ".(int)$limit." ",array($type));
		}		
		return $query->result_array();
	}

	public function show_missing_code_series_count(){
		$query = $this->db->query("SELECT t_Models.Vehicle_Type_UUID FROM t_Makes JOIN  t_Models ON t_Makes.UUID = t_Models.Make_UUID JOIN t_Vehicles ON  t_Models.UUID = t_Vehicles.Model_UUID WHERE Code_Series_UUID IS NULL OR Code_Series_UUID=? OR Code_Series_UUID=? ",array('','|'));		
		return $query->num_rows();
	}

	public function show_missing_code_series($limit,$limt_start){
		if(isset($_SESSION['global_sorting']) && $_SESSION['global_sorting'] !=""){
			$global_sorting = $_SESSION['global_sorting'];
		}else{
			$global_sorting = "t_Makes.Make_Name, t_Models.Model_Name";
		}
		$query = $this->db->query("SELECT t_Vehicles.gen,t_Vehicles.Parts_Keys,t_Vehicles.Parts_Chips,t_Vehicles.Parts_Batteries,t_Vehicles.gen_notes,t_Models.Vehicle_Type_UUID,t_Vehicles.image_url,t_Makes.Make_Name,t_Vehicles.UUID,t_Models.Model_Name,t_Vehicles.id,t_Vehicles.Model_UUID,t_Vehicles.Years,t_Vehicles.Code_Series_UUID,t_Vehicles.Retainer_UUID,t_Vehicles.Mechanical_Key_UUID,t_Vehicles.Chip_Key_UUID,t_Vehicles.Remote_UUID,t_Vehicles.RHK_UUID,t_Vehicles.SmartKey_UUID,t_Vehicles.MVP_System,t_Vehicles.MVP_Dongle_UUID,t_Vehicles.MVP_SmartCard,t_Vehicles.MVP_Software,t_Vehicles.MVP_PIN_Required,t_Vehicles.MVP_PIN_Read,t_Vehicles.ProLok_Tool_UUID,t_Vehicles.ProLok_Linkage,t_Vehicles.Vehicle_Image,t_Vehicles.Image_UUID,t_Vehicles.MVP_Notes,t_Vehicles.APP_System,t_Vehicles.APP_Add_Keys,t_Vehicles.APP_All_Keys_Lost,t_Vehicles.APP_Notes,t_Vehicles.HW_Key_Prog,t_Vehicles.HW_Remote_Prog,t_Vehicles.HW_Misc_Prog,t_Vehicles.TKOSDD_System,t_Vehicles.TKOSDD_SDD_Adapter,t_Vehicles.TKOSDD_SDD_Cable,t_Vehicles.TKOSDD_TKO_Cable,t_Vehicles.TKOSDD_Notes,t_Vehicles.APP_Confirmed_Working,t_Vehicles.DMax_System,t_Vehicles.DMax_Method,t_Vehicles.Parts_Ignition,t_Vehicles.Parts_Door,t_Vehicles.Parts_Accessories,t_Vehicles.Vehicle_Type,t_Vehicles.Tumblers,t_Vehicles.OBD_Location_Text,t_Vehicles.OBD_Location_Image,t_Vehicles.APP_Programs_Remote,t_Vehicles.APP_Resync_Available,t_Vehicles.PIN_Read FROM t_Vehicles JOIN t_Models ON t_Models.UUID = t_Vehicles.Model_UUID 		LEFT JOIN t_Makes ON t_Makes.UUID = t_Models.Make_UUID WHERE Code_Series_UUID IS NULL OR Code_Series_UUID=? OR Code_Series_UUID=? ORDER BY ".$global_sorting." LIMIT  ".(int)$limt_start.", ".(int)$limit." ",array('','|'));		
		return $query->result_array();
	}

	public function show_missing_images_count(){
		$query = $this->db->query("SELECT Vehicle_Image FROM t_Vehicles WHERE Vehicle_Image IS NULL OR Vehicle_Image=? OR Vehicle_Image=? ",array('','|'));		
		return $query->num_rows();
	}
	public function show_missing_images($limit,$limt_start){	
		if(isset($_SESSION['global_sorting']) && $_SESSION['global_sorting'] !=""){
			$global_sorting = $_SESSION['global_sorting'];
		}else{
			$global_sorting = "t_Makes.Make_Name, t_Models.Model_Name";
		}
		$query = $this->db->query("SELECT t_Vehicles.gen,t_Vehicles.Parts_Keys,t_Vehicles.Parts_Chips,t_Vehicles.Parts_Batteries,t_Vehicles.gen_notes,t_Models.Vehicle_Type_UUID,t_Vehicles.image_url,t_Makes.Make_Name,t_Vehicles.UUID,t_Models.Model_Name,t_Vehicles.id,t_Vehicles.Model_UUID,t_Vehicles.Years,t_Vehicles.Code_Series_UUID,t_Vehicles.Retainer_UUID,t_Vehicles.Mechanical_Key_UUID,t_Vehicles.Chip_Key_UUID,t_Vehicles.Remote_UUID,t_Vehicles.RHK_UUID,t_Vehicles.SmartKey_UUID,t_Vehicles.MVP_System,t_Vehicles.MVP_Dongle_UUID,t_Vehicles.MVP_SmartCard,t_Vehicles.MVP_Software,t_Vehicles.MVP_PIN_Required,t_Vehicles.MVP_PIN_Read,t_Vehicles.ProLok_Tool_UUID,t_Vehicles.ProLok_Linkage,t_Vehicles.Vehicle_Image,t_Vehicles.Image_UUID,t_Vehicles.MVP_Notes,t_Vehicles.APP_System,t_Vehicles.APP_Add_Keys,t_Vehicles.APP_All_Keys_Lost,t_Vehicles.APP_Notes,t_Vehicles.HW_Key_Prog,t_Vehicles.HW_Remote_Prog,t_Vehicles.HW_Misc_Prog,t_Vehicles.TKOSDD_System,t_Vehicles.TKOSDD_SDD_Adapter,t_Vehicles.TKOSDD_SDD_Cable,t_Vehicles.TKOSDD_TKO_Cable,t_Vehicles.TKOSDD_Notes,t_Vehicles.APP_Confirmed_Working,t_Vehicles.DMax_System,t_Vehicles.DMax_Method,t_Vehicles.Parts_Ignition,t_Vehicles.Parts_Door,t_Vehicles.Parts_Accessories,t_Vehicles.Vehicle_Type,t_Vehicles.Tumblers,t_Vehicles.OBD_Location_Text,t_Vehicles.OBD_Location_Image,t_Vehicles.APP_Programs_Remote,t_Vehicles.APP_Resync_Available,t_Vehicles.PIN_Read FROM t_Vehicles JOIN t_Models ON t_Models.UUID = t_Vehicles.Model_UUID 		LEFT JOIN t_Makes ON t_Makes.UUID = t_Models.Make_UUID WHERE Vehicle_Image IS NULL OR Vehicle_Image=? OR Vehicle_Image=? ORDER BY ".$global_sorting." LIMIT  ".(int)$limt_start.", ".(int)$limit." ",array('','|'));		
		return $query->result_array();
	}
	
	public function vehicle_types(){
		$query = $this->db->query("SELECT * FROM t_Vehicle_Types ");
		return $query->result_array();
	}
	
	public function save_vehicle_type(){
		$this->db->cache_delete('admpro', 'vehicles');
		$data = array(					
			'type' => $this->input->post('type'),
			'UUID'	 => $this->input->post('uuid'),
		);
		$data = $this->security->xss_clean($data);
		$this->db->insert('t_Vehicle_Types', $data);
	}
	
	public function vehicle_types_info($id){
		$query = $this->db->query("SELECT * FROM t_Vehicle_Types WHERE id = ? ",array($id));
		return $query->result_array();
	}
	
	public function update_vehicle_type(){
		$this->db->cache_delete('admpro', 'vehicles');
		$id = $this->input->post('id');
		$data = array(					
			'type' => $this->input->post('type')			
		);
		$this->db->where('id', $id);
		$data = $this->security->xss_clean($data);
		$this->db->update('t_Vehicle_Types', $data);
	}
	
	public function delete_vehicle_type($id){
		$this->db->cache_delete('admpro', 'vehicles');
		$this->db->where('id', $id);
		$this->db->delete('t_Vehicle_Types');
	}


/*--------------------------- Application Section --------------------------------------------*/

	public function get_applications_rows(){
		return $this->db->count_all("t_AutoProPAD_Applications");
	}
	
	public function get_applications($limit,$limt_start){
		$query = $this->db->query("SELECT * FROM t_AutoProPAD_Applications ORDER BY Make ASC, Model ASC, Year ASC LIMIT  ".(int)$limt_start.", ".(int)$limit." ");
		return $query->result_array();
	}
	
	public function get_applications_info($id){
		$query = $this->db->query("SELECT * FROM t_AutoProPAD_Applications WHERE id = ? ",array($id));
		return $query->result_array();
	}
	
	public function application_input_update(){
		$column_name = $this->input->post('columnName');
		foreach($_POST[$column_name] as $key => $val) {
			$data = array($column_name => $val);			
			$this->db->where('id', $key);
			$data = $this->security->xss_clean($data);
			$this->db->update('t_AutoProPAD_Applications', $data);
		}			
		if(isset($val)){			
				return $val;
		}else{
			return '';
		}
	}
	
	public function save_applications(){
		$make_uuid = $this->input->post('Make');
		$make_query = $this->db->query("SELECT * FROM t_Makes WHERE UUID = ? ",array($make_uuid));
		$make_query1 = $make_query->result_array();
		$make = $make_query1[0]['Make_Name'];		
		$model_uuid = $this->input->post('Model_UUID');
		$modal_query = $this->db->query("SELECT * FROM t_Models WHERE UUID = ? ",array($model_uuid));
		$modal_query1 = $modal_query->result_array();
		$model = $modal_query1[0]['Model_Name'];
		$data = array(						
			'Year' => $this->input->post('Year'),
			'Make' => $make,
			'Model' => $model,
			'System' => $this->input->post('System'),
			'PinRequired' => $this->input->post('PinRequired'),
			'PinRead' => $this->input->post('PinRead'),
			'PinReadPossible' => $this->input->post('PinReadPossible'),
			'10MinBypass' => $this->input->post('10MinBypass'),
			'PinCalculate' => $this->input->post('PinCalculate'),
			'ProgramMaster' => $this->input->post('ProgramMaster'),
			'ProgramValet' => $this->input->post('ProgramValet'),
			'AllKeysLost' => $this->input->post('AllKeysLost'),
			'AddKey' => $this->input->post('AddKey'),
			'EraseKey' => $this->input->post('EraseKey'),
			'AddRemote' => $this->input->post('AddRemote'),
			'EraseRemote' => $this->input->post('EraseRemote'),
			'ResetProx' => $this->input->post('ResetProx'),
			'ResetFunction' => $this->input->post('ResetFunction'),
			'ReplaceFunction' => $this->input->post('ReplaceFunction'),
			'KeyInfo' => $this->input->post('KeyInfo'),
			'FobInfo' => $this->input->post('FobInfo'),
			'MaxKeys' => $this->input->post('MaxKeys'),
			'ProgramType' => $this->input->post('ProgramType'),
			'RegisterSmartAccess' => $this->input->post('RegisterSmartAccess'),
			'IdEngStartBox' => $this->input->post('IdEngStartBox'),
			'IdRegSmartBox' => $this->input->post('IdRegSmartBox'),
			'SpecialFunction' => $this->input->post('SpecialFunction'),
			'2KeysRequired' => $this->input->post('2KeysRequired'),
			'Reusable' => $this->input->post('Reusable'),
			'ComponentsMatch' => $this->input->post('ComponentsMatch'),
			'Possible' => $this->input->post('Possible'),
			'Needed' => $this->input->post('Needed'),
			'Notes' => $this->input->post('Notes'),
			'Testing' => $this->input->post('Testing')
		);
		$data = $this->security->xss_clean($data);
		$this->db->insert('t_AutoProPAD_Applications', $data);
	}
	
	public function update_applications(){
		$id = $this->input->post('id');
		$make_uuid = $this->input->post('Make');
		$make_query = $this->db->query("SELECT * FROM t_Makes WHERE UUID =? ",array($make_uuid));
		$make_query1 = $make_query->result_array();
		$make = $make_query1[0]['Make_Name'];		
		$model_uuid = $this->input->post('Model_UUID');
		$modal_query = $this->db->query("SELECT * FROM t_Models WHERE UUID = ? ",array($model_uuid));
		$modal_query1 = $modal_query->result_array();
		$model = $modal_query1[0]['Model_Name'];
		$data = array(						
			'Year' => $this->input->post('Year'),
			'Make' => $make,
			'Model' => $model,
			'System' => $this->input->post('System'),
			'PinRequired' => $this->input->post('PinRequired'),
			'PinRead' => $this->input->post('PinRead'),
			'PinReadPossible' => $this->input->post('PinReadPossible'),
			'10MinBypass' => $this->input->post('10MinBypass'),
			'PinCalculate' => $this->input->post('PinCalculate'),
			'ProgramMaster' => $this->input->post('ProgramMaster'),
			'ProgramValet' => $this->input->post('ProgramValet'),
			'AllKeysLost' => $this->input->post('AllKeysLost'),
			'AddKey' => $this->input->post('AddKey'),
			'EraseKey' => $this->input->post('EraseKey'),
			'AddRemote' => $this->input->post('AddRemote'),
			'EraseRemote' => $this->input->post('EraseRemote'),
			'ResetProx' => $this->input->post('ResetProx'),
			'ResetFunction' => $this->input->post('ResetFunction'),
			'ReplaceFunction' => $this->input->post('ReplaceFunction'),
			'KeyInfo' => $this->input->post('KeyInfo'),
			'FobInfo' => $this->input->post('FobInfo'),
			'MaxKeys' => $this->input->post('MaxKeys'),
			'ProgramType' => $this->input->post('ProgramType'),
			'RegisterSmartAccess' => $this->input->post('RegisterSmartAccess'),
			'IdEngStartBox' => $this->input->post('IdEngStartBox'),
			'IdRegSmartBox' => $this->input->post('IdRegSmartBox'),
			'SpecialFunction' => $this->input->post('SpecialFunction'),
			'2KeysRequired' => $this->input->post('2KeysRequired'),
			'Reusable' => $this->input->post('Reusable'),
			'ComponentsMatch' => $this->input->post('ComponentsMatch'),
			'Possible' => $this->input->post('Possible'),
			'Needed' => $this->input->post('Needed'),
			'Notes' => $this->input->post('Notes'),
			'Testing' => $this->input->post('Testing')
		);
		$this->db->where('id', $id);
		$data = $this->security->xss_clean($data);
		$this->db->update('t_AutoProPAD_Applications', $data);
	}
	
	public function delete_application($id){
		$this->db->where('id', $id);
		$this->db->delete('t_AutoProPAD_Applications');
	}
	
	public function application_sorting(){
		$sort = $this->input->post('sorting');
		$sorting_by = $this->input->post('sorting_by');		
		$query = $this->db->query("SELECT * FROM t_AutoProPAD_Applications ORDER BY $sorting_by $sort LIMIT 100");
		return $query->result_array();
	}
	
	public function get_application_by_sorting($limit,$limt_start,$application_sorting,$application_sort_order){
		if($application_sorting == '' || $application_sort_order == ''){
			$query = $this->db->query("SELECT * FROM t_AutoProPAD_Applications ORDER BY Make ASC, Model ASC, Year ASC LIMIT  ".(int)$limt_start.", ".(int)$limit." ");
		}else{
			$query = $this->db->query("SELECT * FROM t_AutoProPAD_Applications ORDER BY $application_sorting $application_sort_order LIMIT  ".(int)$limt_start.", ".(int)$limit." ");
		}
		return $query->result_array();
	}	
	
	public function filterApplicationByMake(){
		$filter_key = $this->input->post('makeId');
		$query = $this->db->select("*")->where('Make',$filter_key)->get('t_AutoProPAD_Applications');
		return $query->result_array();
	}
	
	public function searchApplication(){
		$filter_key = $this->input->post('search_key');
		$query = $this->db->select("*")->like('Make',$filter_key)->get('t_AutoProPAD_Applications');
		return $query->result_array();
	}
	public function ez_pages($ezpages_location_val){
		if($ezpages_location_val == "" || $ezpages_location_val == "all"){
			$query = $this->db->select("*")->order_by('Sort_Order','asc')->get('t_EZ_Pages');
		}else{
			$query = $this->db->select("*")->where('Location',$ezpages_location_val)->order_by('Sort_Order','asc')->get('t_EZ_Pages');
		}
		return $query->result_array();
	}

	public function DeleteEZPages($id){
		$this->db->where('id', $id);
		$this->db->delete('t_EZ_Pages');
	}

	public function save_ez_pages(){
		$this->db->cache_delete('admpro', 'home_screen_menus');
		$data = array(
				'Page_Name' => $this->input->post('Page_Name'),
				'Content' => $this->input->post('Content'),
				'Location' => $this->input->post('Location'),
				'Manufacturer_UUID' => $this->input->post('Manufacturer_UUID'),
				'Page_Type' => $this->input->post('Page_Type'),
				'Sort_Order' => $this->input->post('Sort_Order')
		);	
		$data = $this->security->xss_clean($data);
		$this->db->insert('t_EZ_Pages', $data);

	}

	public function ez_page_info($id){
		$query = $this->db->query("SELECT * FROM t_EZ_Pages WHERE id=? ",array($id));
		return $query->result_array();
	}

	public function update_ez_pages(){
		$this->db->cache_delete('admpro', 'home_screen_menus');
		$id  = $this->input->post('id');
		$data = array(
				'Page_Name' => $this->input->post('Page_Name'),
				'Content' => $this->input->post('Content'),
				'Location' => $this->input->post('Location'),
				'Manufacturer_UUID' => $this->input->post('Manufacturer_UUID'),
				'Page_Type' => $this->input->post('Page_Type'),
				'Sort_Order' => $this->input->post('Sort_Order')
		);	
		$this->db->where('id', $id);
		$data = $this->security->xss_clean($data);
		$this->db->update('t_EZ_Pages', $data);
	}

	public function filter_keysby_types($value){
		if( $value == 'all'){
			$query = $this->db->select("*")->order_by('Sort_Order','asc')->get('t_EZ_Pages');
		}else{
		    $query = $this->db->select("*")->where('Location',$value)->order_by('Sort_Order','asc')->get('t_EZ_Pages');
		}
		return $query->result_array();	
	}

	public function filter_ezpages_Manufacturer($value){
		if( $value == 'all'){
			$query = $this->db->query("SELECT * FROM t_EZ_Pages ORDER BY Sort_Order ASC,Location ASC,id ASC");
		}else{
		    $query = $this->db->query("SELECT * FROM t_EZ_Pages WHERE Manufacturer_UUID=? ORDER BY Sort_Order ASC,Location ASC,id ASC",array($value));
		}
		return $query->result_array();
	}

	public function data_sort_order($order,$id){
		$data = array(						
			'Sort_Order' => $order
		);
		$this->db->where('id', $id);
		$data = $this->security->xss_clean($data);
		$this->db->update('t_EZ_Pages', $data);	
	}

	public function search_user_feedbacks(){
		$value =  trim($this->input->post('search_key'));
		$query = $this->db->query("SELECT * FROM t_Corrections WHERE User_Email LIKE '%$value%' OR vehicle LIKE '%$value%' OR title LIKE '%$value%' OR other_vehicle LIKE '%$value%' OR content LIKE '%$value%' AND deleted='0' GROUP BY UUID LIMIT 500");	
		return $query->result_array();
	}

	public function edit_user_feedback($id){
		$query = $this->db->query("SELECT * FROM t_Corrections WHERE UUID=? AND deleted=? GROUP BY UUID ",array($id,0));
		return $query->result_array();
	}

	public function update_user_feedback(){
		$id  = $this->input->post('id');
		$data = array(
				'User_Email' => $this->input->post('User_Email'),
				'Feedback_type' => $this->input->post('Feedback_type'),
				'title' => $this->input->post('title'),
				'vehicle' => $this->input->post('vehicle'),
				'other_vehicle' => $this->input->post('other_vehicle'),
				'Images' => $this->input->post('Images'),
				'status' => $this->input->post('status')
		);	
		$this->db->where('UUID', $id);
		$data = $this->security->xss_clean($data);
		$this->db->update('t_Corrections', $data);	
	}

	public function search_aks_users(){
		$value =  trim($this->input->post('search_key'));
		$valued =  explode(' ',$this->input->post('search_key'));
			$value = $valued[0];
			$value2 = $valued[0];
			$query = $this->db->query("SELECT * FROM t_Users WHERE 
				FirstName LIKE '%$value%' OR LastName LIKE '%$value%' OR Email LIKE '%$value%' OR zipcode LIKE '%$value%' OR 
				FirstName LIKE '%$value2%' OR LastName LIKE '%$value2%' OR Email LIKE '%$value2%' OR zipcode LIKE '%$value2%'");
			return $query->result_array();		
	}

	public function aks_users_sorting(){
		$sort = $this->input->post('sorting');
		$sorting_by = $this->input->post('sorting_by');					
		$query = $this->db->query("SELECT * FROM t_Users ORDER BY $sorting_by $sort");
		return $query->result_array();
	}

	public function search_users_feedbacks(){
		$value =  $this->input->post('search_key');
		$query = $this->db->query("SELECT * FROM t_Feedback WHERE User_Email LIKE '%$value%' OR User_Name LIKE '%$value%' OR feedback LIKE '%$value%' OR subject LIKE '%$value%' ");	
		return $query->result_array();	
	}

	public function delete_user_feedback($id){
		$this->db->cache_delete('admpro', 'user_submissions');
		$data = array(
				'deleted' => 1
		);	
		$this->db->where('id', $id);
		$data = $this->security->xss_clean($data);
		if($this->db->update('t_Corrections', $data)){
			return 1;
		}else{
			return 0;
		}		
	}

	public function show_feedback_by_type(){
		$value =  $this->input->post('page_type');
		if($value == 'All'){
			$query = $this->db->query("SELECT * FROM t_Corrections WHERE deleted=? GROUP BY UUID ORDER BY id DESC LIMIT 100",array(0));
		}else{
			$query = $this->db->query("SELECT * FROM t_Corrections WHERE Feedback_type = ? AND deleted=? GROUP BY UUID  ORDER BY id DESC",array($value,0));
		}	
		return $query->result_array();	
	}
	
	public function getAlluser_submissionsRows(){
		if( isset($_SESSION['user_submissions_status']) && $_SESSION['user_submissions_status'] !="" ){
			$query = $this->db->select("UUID")->where('deleted',0)->where_in('Status', explode(',',$_SESSION['user_submissions_status']) )
			->group_by('UUID')->get('t_Corrections');
		}else if( isset($_SESSION['user_submissions_status']) && $_SESSION['user_submissions_status'] =="" ){
			return 0;
		}else{
			$query = $this->db->query("SELECT DISTINCT UUID FROM t_Corrections WHERE deleted=? GROUP BY UUID ORDER BY id DESC",array(0));
		}	
		return $query->num_rows();
	}
	public function users_contributed_content($limit,$limt_start){
		if( isset($_SESSION['user_submissions_status']) && $_SESSION['user_submissions_status'] !="" ){
			$query = $this->db->select("*")->where('deleted',0)->where_in('Status', explode(',',$_SESSION['user_submissions_status']))
			->group_by('UUID')->order_by('id','desc')->limit($limit,$limt_start)->get('t_Corrections');
		}else if( isset($_SESSION['user_submissions_status']) && $_SESSION['user_submissions_status'] =="" ){
			return array();
		}else{
			$query = $this->db->select("*")->where('deleted',0)->group_by('UUID')->order_by('id','desc')->limit($limit,$limt_start)->get('t_Corrections');
		}		
		return $query->result_array();
	}

	public function ezpages_sorting($ezpages_location_val){
		$sort = $this->input->post('sorting');
		$sorting_by = $this->input->post('sorting_by');	
		if($ezpages_location_val == ""){				
			$query = $this->db->query("SELECT * FROM t_EZ_Pages ORDER BY $sorting_by $sort");
		}else{
			$query = $this->db->query("SELECT * FROM t_EZ_Pages WHERE Location='$ezpages_location_val' ORDER BY $sorting_by $sort");
		}
		return $query->result_array();
	}

	public function search_keymaking_method(){
		$value =  $this->input->post('search_key');
		$query1 = $this->db->query("SELECT * FROM t_Vehicles WHERE Model_UUID = ? ",array($value));
		if($query1->num_rows() > 0){
			return $query1->result_array();
		}else{
			$query = $this->db->query("SELECT * FROM t_Methods WHERE Vehicle_UUID LIKE '%$value%' OR Title LIKE '%$value%' OR Content LIKE '%$value%' OR User_UUID LIKE '%$value%'");	
			return $query->result_array();
		} 
		
	}

	public function keymaking_method_sorting(){
		$sort = $this->input->post('sorting');
		$sorting_by = $this->input->post('sorting_by');					
		$query = $this->db->query("SELECT * FROM t_Methods ORDER BY $sorting_by $sort");
		return $query->result_array();
	}

	public function keymakingMethod_score_order($order,$id){
		$data = array(						
			'Score' => $order
		);
		$this->db->where('Id', $id);
		$data = $this->security->xss_clean($data);
		$this->db->update('t_Methods', $data);		
	}

/*----------------------------- Tips Tricks Section -----------------------------*/
	public function get_tip_tricks($limit,$limt_start){	
		$query = $this->db->query("SELECT * FROM t_Tips ORDER BY Id DESC LIMIT  ".(int)$limt_start.", ".(int)$limit." ");	
		return $query->result_array();
	}
	
	
	public function save_tip_tricks(){
		$this->db->cache_delete('admpro', 'vehicles');
		$vehicles_data = $this->input->post('Vehicle_UUID');
		$vehicles_id = "";
		foreach($vehicles_data as $vehicles){
			$vehicles_id .= $vehicles."|";
		}
		$vehicles_id2 = rtrim($vehicles_id,"|");

		// $Videos_data = $this->input->post('Videos');
		// $Videos_id = "";
		// foreach($Videos_data as $Videos){
		// 	$Videos_id .= $Videos."|";
		// }
		// $Videos_id2 = rtrim($Videos_id,"|");
		if($this->input->post('Image_path') != ""){
			$Image_path = $this->input->post('Image_path');
			$image_id = "";
			foreach($Image_path as $images){
				$image_id .= $images.",";
			}
			$image_id2 = rtrim($image_id,",");
		}else{
			$image_id2 = "";
		}
		$data = array(
			'UUID' => $this->input->post('UUID'),					
			'Vehicle_UUID' => $vehicles_id2,	
			'Title' => $this->input->post('Title'),
			'Content' => $this->input->post('Content'),
			'User_UUID' => $this->input->post('User_UUID'),
			'Images' => $image_id2,
			'Score' => $this->input->post('Score'),
			'Category' => $this->input->post('Category'),
			'Videos' => $this->input->post('Videos')
		);
		$data = $this->security->xss_clean($data);
		$this->db->insert('t_Tips', $data);
	}
	
	public function get_tip_tricks_info($id){
		$query = $this->db->query("SELECT * FROM t_Tips WHERE Id = ? ", array($id));	
		return $query->result_array();	
	}
	
	
	public function update_tip_tricks(){
		$this->db->cache_delete('admpro', 'vehicles');
		$vehicles_data = $this->input->post('Vehicle_UUID');
		$vehicles_id = "";
		foreach($vehicles_data as $vehicles){
			$vehicles_id .= $vehicles."|";
		}
		$vehicles_id2 = rtrim($vehicles_id,"|");
		if($this->input->post('Image_path') != ""){
			$Image_path = $this->input->post('Image_path');
			$image_id = "";
			foreach($Image_path as $images){
				$image_id .= $images.",";
			}
			$image_id2 = rtrim($image_id,",");
		}else{
			$image_id2 = "";
		}
		$id = $this->input->post('id');
		$data = array(					
			'Vehicle_UUID' =>$vehicles_id2,	
			'Title' => $this->input->post('Title'),
			'Content' => $this->input->post('Content'),
			'User_UUID' => $this->input->post('User_UUID'),
			'Images' => $image_id2,
			'Score' => $this->input->post('Score'),
			'Category' => $this->input->post('Category'),
			'Videos' => $this->input->post('Videos')
		);
		$this->db->where('Id', $id);
		$data = $this->security->xss_clean($data);
		$this->db->update('t_Tips', $data);
	}
	
	public function delete_tip_tricks($id){
		$this->db->cache_delete('admpro', 'vehicles');
		$this->db->where('Id', $id);
		$this->db->delete('t_Tips');
	}

	public function search_tips_tricks(){
		$value =  $this->input->post('search_key');
		$query1 = $this->db->query("SELECT * FROM t_Vehicles WHERE Model_UUID = ? ", array($value));
		if($query1->num_rows() > 0){
			return $query1->result_array();
		}else{
			$query = $this->db->query("SELECT * FROM t_Tips WHERE Vehicle_UUID LIKE '%$value%' OR Title LIKE '%$value%' OR Content LIKE '%$value%' OR User_UUID LIKE '%$value%'");	
			return $query->result_array();
		} 
		
	}

	public function tips_tricks_sorting(){
		$sort = $this->input->post('sorting');
		$sorting_by = $this->input->post('sorting_by');					
		$query = $this->db->query("SELECT * FROM t_Tips ORDER BY $sorting_by $sort");
		return $query->result_array();
	}

	public function tipTrick_score_order($order,$id){
		$data = array(						
			'Score' => $order
		);
		$this->db->where('Id', $id);
		$data = $this->security->xss_clean($data);
		$this->db->update('t_Tips', $data);	
	}
	
	public function get_machine_reports($limit,$limit_start){
		$query = $this->db->query("SELECT * FROM t_Success_Reporting WHERE deleted = ? LIMIT $limit_start,$limit ", array(0));	
		return $query->result_array();
	}
	public function getAllMachineReportRows(){
		return $this->db->count_all("t_Success_Reporting");
	}
	public function get_machine_report(){
		$query = $this->db->query("SELECT * FROM t_Success_Reporting WHERE deleted = ? ORDER BY Date DESC",array(0));	
		return $query->result_array();
	}

	public function delete_machine_report($id){
		$data = array(						
			'deleted' =>1
		);
		$this->db->where('id', $id);
		$data = $this->security->xss_clean($data);
		$this->db->update('t_Success_Reporting', $data);
	}

	public function search_machine_reports(){
		$makes_id = "";
		$modal_ids = "";
		$search_key = trim($this->input->post('search_key'));	
		
		$make_query = $this->db->query("SELECT * FROM t_Makes WHERE Make_Name LIKE '%$search_key%'");
		$make_query1 = $make_query->result_array();
		
		$model_query = $this->db->query("SELECT * FROM t_Models WHERE Model_Name LIKE '%$search_key%'");
		$model_query1 = $model_query->result_array();
		if($make_query->num_rows() > 0){
			$makes_id2 = $make_query1[0]['UUID'];
			$model_query22 = $this->db->query("SELECT * FROM t_Models WHERE Make_UUID = ? ",array($makes_id2));
			$model_query12 = $model_query22->result_array();
			foreach($model_query12 as $model_idss){
				//$modal_ids = $model_query12[0]['UUID'];
				$modal_ids .= "'". $model_idss['UUID']."',";
			}
			$modal_ids2 = rtrim($modal_ids,",");			
			$vehicle_query = $this->db->query("SELECT * FROM t_Vehicles WHERE Model_UUID IN($modal_ids2) ");
		}else if($model_query->num_rows() > 0){
			$modal_ids22 = "";
			foreach($model_query1 as $model_idss){				
				//$modal_ids = $model_query12[0]['UUID'];
				$modal_ids22 .= "'". $model_idss['UUID']."',";
			}
			$modal_ids2 = rtrim($modal_ids22,",");			
			$vehicle_query = $this->db->query("SELECT * FROM t_Vehicles WHERE Model_UUID IN($modal_ids2) ");
		}else{
			$vehicle_query = $this->db->query("SELECT * FROM t_Vehicles WHERE Model_UUID IN('zzzzz') ");
		}
		if($vehicle_query->num_rows() > 0){
			$vehicle_query2 = $vehicle_query->result_array();
			$vehicle_ids22 = "";
			foreach($vehicle_query2 as $vehicle_idss){				
				//$modal_ids = $model_query12[0]['UUID'];
				$vehicle_ids22 .= "'". $vehicle_idss['id']."',";
			}
			$vehicle_ids2 = rtrim($vehicle_ids22,",");
			$query = $this->db->query("SELECT * FROM t_Success_Reporting WHERE Vehicle IN($vehicle_ids2) AND deleted=? ORDER BY Date DESC ",array(0));
			return $query->result_array();
		}else{
			$user_query = $this->db->query("SELECT * FROM t_Users WHERE Email LIKE '%$search_key%' OR FirstName LIKE '%$search_key%' OR LastName LIKE '%$search_key%' OR User_UUID LIKE '%$search_key%'");			
			$user_ids = "";
			if($user_query->num_rows() > 0){
				$user_query1 = $user_query->result_array();
				foreach($user_query1 as $user_id){
					$user_ids .= "'". $user_id['User_UUID']."',";
				}
				$user_ids2 = rtrim($user_ids,",");				
				$query = $this->db->query("SELECT * FROM t_Success_Reporting WHERE userid IN ($user_ids2) AND deleted=? ORDER BY Date DESC ",array(0));
			}else{ 
				$query = $this->db->query("SELECT * FROM t_Success_Reporting WHERE Comment LIKE '%$search_key%' AND deleted='0' ORDER BY Date DESC ");
			}
			return $query->result_array();

		}
		
	}

	public function filterMacineReport(){
		$search_key = trim($this->input->post('value'));
		$machine = trim($this->input->post('machine'));
		$result = $this->input->post('result');
		$colname = trim($this->input->post('colname'));
		$type = trim($this->input->post('type'));
		if($type == 'top'){
			if($machine =="all"){
				$where_machine = "";
			}else {
				$where_machine = " AND Machine='".$machine."'";
			}		
			if($result =="all"){
				$where_Result = "";
			}else{
				$where_Result = " AND Result='".$result."'";
			}
			$query = $this->db->query("SELECT * FROM t_Success_Reporting WHERE deleted=? ".$where_machine." ".$where_Result." ORDER BY Date DESC ",array(0));			
		}else if($type == 'top_bar'){
			$query = $this->db->query("SELECT * FROM t_Success_Reporting WHERE deleted=? AND Machine=? AND Result=? ORDER BY Date DESC ",array(0,$machine,$result));			
		}			
		return $query->result_array();
	}

	public function save_success_report(){
		$vehicles_data = $this->input->post('Vehicle_UUID');
		$vehicles_id = "";
		foreach($vehicles_data as $vehicles){
			$vehicles_id .= $vehicles."|";
		}
		$vehicles_id2 = rtrim($vehicles_id,"|");
		$data = array(					
			'UUID' => md5(uniqid(mt_rand(), true)),
			'Date' => time(),	
			'userid' => $this->input->post('User_UUID'),
			'Machine' => $this->input->post('Machine'),
			'Vehicle' => $vehicles_id2,
			'Result' => $this->input->post('Result'),
			'Comment' => $this->input->post('Comment'),
			'added_from' => 'Admin'
		);
		$data = $this->security->xss_clean($data);
		$this->db->insert('t_Success_Reporting', $data);
	}

/*-------------------------------------------- Vehicle Images --------------------------------------*/
	
	public function save_vehicle_images(){
		$this->db->cache_delete('admpro', 'vehicles');
		$vehicles_data = $this->input->post('Vehicle_UUID');
		$vehicles_id = "";
		foreach($vehicles_data as $vehicles){
			$vehicles_id .= $vehicles."|";
		}
		$vehicles_id2 = rtrim($vehicles_id,"|");
		if($this->input->post('Image_path') != ""){
			$Image_path = $this->input->post('Image_path');
			$image_id = "";
			foreach($Image_path as $images){
				$image_id .= $images.",";
			}
			$image_id2 = rtrim($image_id,",");
		}else{
			$image_id2 = "";
		}
		$data = array(					
			'UUID' => $this->input->post('UUID'),	
			'user' => $this->input->post('User_UUID'),
			'vehicles' => $vehicles_id2,
			'Image_path' => $image_id2
		);
		$data = $this->security->xss_clean($data);
		$this->db->insert('vehicle_images', $data);
	}

	public function update_vehicle_images(){
		$this->db->cache_delete('admpro', 'vehicles');
		$vehicles_data = $this->input->post('Vehicle_UUID');
		$vehicles_id = "";
		foreach($vehicles_data as $vehicles){
			$vehicles_id .= $vehicles."|";
		}
		$vehicles_id2 = rtrim($vehicles_id,"|");
		if($this->input->post('Image_path') != ""){
			$Image_path = $this->input->post('Image_path');
			$image_id = "";
			foreach($Image_path as $images){
				$image_id .= $images.",";
			}
			$image_id2 = rtrim($image_id,",");
		}else{
			$image_id2 = "";
		}
		$id = $this->input->post('id');
		$data = array(					
			'UUID' => $this->input->post('UUID'),	
			'user' => $this->input->post('User_UUID'),
			'vehicles' => $vehicles_id2,
			'Image_path' => $image_id2
		);
		$this->db->where('Image_id', $id);
		$data = $this->security->xss_clean($data);
		$this->db->update('vehicle_images', $data);	
	}

	public function get_vehicles_images_info($id){
		$query = $this->db->query("SELECT * FROM vehicle_images WHERE Image_id = ? ",array($id));
		return $query->result_array();
	}

	public function delete_vehicle_image($id){
		$this->db->cache_delete('admpro', 'vehicles');
		$this->db->where('Image_id', $id);
		$this->db->delete('vehicle_images'); 
	}

	public function vehicles_image_filter_data(){
		$value =  $this->input->post('search_key');
		$where = "";
		$vehicle_idss1 = "";
		$makes_id = "";
		$modal_ids = "";
		$search_key = trim($this->input->post('search_key'));		
		$make_query = $this->db->query("SELECT * FROM t_Makes WHERE Make_Name LIKE '%$search_key%'");
		$make_query1 = $make_query->result_array();		
		$model_query = $this->db->query("SELECT * FROM t_Models WHERE Model_Name LIKE '%$search_key%'");
		$model_query1 = $model_query->result_array();
		if($make_query->num_rows() > 0){
			$makes_id2 = $make_query1[0]['UUID'];
			$model_query22 = $this->db->query("SELECT * FROM t_Models WHERE Make_UUID = ? ",array($makes_id2));
			$model_query12 = $model_query22->result_array();
			foreach($model_query12 as $model_idss){
				//$modal_ids = $model_query12[0]['UUID'];
				$modal_ids .= "'". $model_idss['UUID']."',";
			}
			$modal_ids2 = rtrim($modal_ids,",");			
			$query = $this->db->query("SELECT t_Vehicles.id FROM t_Makes JOIN  t_Models ON t_Makes.UUID = t_Models.Make_UUID JOIN t_Vehicles ON  t_Models.UUID = t_Vehicles.Model_UUID WHERE t_Vehicles.Model_UUID IN($modal_ids2)   ORDER BY t_Makes.Make_Name,t_Models.Model_Name");
		}else if($model_query->num_rows() > 0){
			$modal_ids22 = "";
			foreach($model_query1 as $model_idss){				
				//$modal_ids = $model_query12[0]['UUID'];
				$modal_ids22 .= "'". $model_idss['UUID']."',";
			}
			$modal_ids2 = rtrim($modal_ids22,",");			
			//$query = $this->db->query("SELECT * FROM t_Vehicles WHERE Model_UUID IN($modal_ids2) ");
			$query = $this->db->query("SELECT t_Vehicles.id FROM t_Makes JOIN  t_Models ON t_Makes.UUID = t_Models.Make_UUID JOIN t_Vehicles ON  t_Models.UUID = t_Vehicles.Model_UUID WHERE t_Vehicles.Model_UUID IN($modal_ids2)   ORDER BY t_Makes.Make_Name,t_Models.Model_Name");
		}else{
			$query = $this->db->query("SELECT * FROM t_Vehicles WHERE Years LIKE '%$search_key%' ");
		}
		if($query->num_rows() > 0){
			$vehicle_id_found = "";
			$vehicle_query = $query->result_array();
			foreach($vehicle_query as $vehicle_idss){
				//$modal_ids = $model_query12[0]['UUID'];
				$vehicle_idss1 = $vehicle_idss['id'];
				$vehicle_id_found .= $vehicle_idss['id'].',';
				$where .= "vehicles LIKE '%$vehicle_idss1%' OR ";
			}
			$where2 = substr($where,0,-3);
			$vehicle_id_found =rtrim($vehicle_id_found,",");
			$query_search = $this->db->query("SELECT * FROM vehicle_images  WHERE  ".$where2."");
			return array('result' => $query_search->result_array(), 'vehicle' => $vehicle_id_found);
		}else{
			$query_search = $this->db->query("SELECT * FROM vehicle_images WHERE user LIKE '%$value%'");
			return array('result' => $query_search->result_array(), 'vehicle' => '');
		}		
	}

	public function vehicles_image_filter_data_make(){
		$modal_ids = "";
		$where = "vehicles LIKE '%0%' OR ";
		$makeId = $this->input->post('makeId');
		$vehicle_query = $this->db->query("SELECT t_Vehicles.id FROM t_Makes JOIN  t_Models ON t_Makes.UUID = t_Models.Make_UUID JOIN t_Vehicles ON  t_Models.UUID = t_Vehicles.Model_UUID WHERE t_Models.Make_UUID=? ORDER BY t_Makes.Make_Name",array($makeId));
		$vehicle_query2 = $vehicle_query->result_array();
		$vehicle_id_found = "";
		foreach($vehicle_query2 as $vehicle_idss){
			//$modal_ids = $model_query12[0]['UUID'];
			$vehicle_idss1 = $vehicle_idss['id'];
			$vehicle_id_found .= $vehicle_idss['id'].',';
			$where .= "vehicles LIKE '%$vehicle_idss1%' OR ";
		}
		$where2 = substr($where,0,-3);
		$vehicle_idss2 = rtrim($vehicle_idss1,"|");
		$vehicle_id_found =rtrim($vehicle_id_found,",");
		$query = $this->db->query("SELECT * FROM vehicle_images WHERE  ".$where2."");		
		return array('result' => $query->result_array(), 'vehicle' => $vehicle_id_found);
	}

	public function vehicles_image_filter_data_model(){
		$where = "vehicles LIKE '%0%' OR ";
		$modelId = $this->input->post('modelId');
		$vehicle_query = $this->db->query("SELECT * FROM t_Vehicles WHERE Model_UUID =? ",array($modelId));
		$vehicle_query2 = $vehicle_query->result_array();
		$vehicle_id_found = "";
		foreach($vehicle_query2 as $vehicle_idss){
			//$modal_ids = $model_query12[0]['UUID'];
			$vehicle_idss1 = $vehicle_idss['id'];
			$vehicle_id_found .= $vehicle_idss['id'].',';
			$where .= "vehicles LIKE '%$vehicle_idss1%' OR ";
		}
		$where2 = substr($where,0,-3);
		$vehicle_idss2 = rtrim($vehicle_idss1,"|");
		$vehicle_id_found =rtrim($vehicle_id_found,",");
		$query = $this->db->query("SELECT * FROM vehicle_images WHERE  ".$where2."");		
		return array('result' => $query->result_array(), 'vehicle' => $vehicle_id_found);	
	}

	public function vehicles_image_filter_data_year(){
		$where = "vehicles LIKE '%0%' OR ";
		$modelId = str_replace('-',',',$this->input->post('search_key'));
		$vehicle_query = $this->db->query("SELECT * FROM t_Vehicles WHERE Years LIKE '%$modelId%' ");
		$vehicle_query2 = $vehicle_query->result_array();
		$vehicle_id_found = "";
		foreach($vehicle_query2 as $vehicle_idss){
			//$modal_ids = $model_query12[0]['UUID'];
			$vehicle_idss1 = $vehicle_idss['id'];
			$vehicle_id_found .= $vehicle_idss['id'].',';
			$where .= "vehicles LIKE '%$vehicle_idss1%' OR ";
		}
		$where2 = substr($where,0,-3);
		$vehicle_idss2 = rtrim($vehicle_idss1,"|");
		$vehicle_id_found =rtrim($vehicle_id_found,",");
		$query = $this->db->query("SELECT * FROM vehicle_images WHERE  ".$where2."");		
		return array('result' => $query->result_array(), 'vehicle' => $vehicle_id_found);;	
	}

	public function update_user_contribution(){
		$this->db->cache_delete('admpro', 'user_submissions');
		$id = $this->input->post('id');
		$status = $this->input->post('status');
		$data = array(					
			'Status' => $this->input->post('status')
		);
		$this->db->where('id', $id);
		$data = $this->security->xss_clean($data);
		$update = $this->db->update('t_Corrections', $data);
		if($update){
			return 'Success';
		}
	}


	public function search_keymaking_method_make(){
		$modal_ids = "";
		$where = "Vehicle_UUID LIKE '%-%' OR ";
		$vehicle_idss1 = "";
		$makeId = $this->input->post('makeId');
		$model_query22 = $this->db->query("SELECT * FROM t_Models WHERE Make_UUID = ? ",array($makeId));
		$model_query12 = $model_query22->result_array();
		foreach($model_query12 as $model_idss){
			//$modal_ids = $model_query12[0]['UUID'];
			$modal_ids .= "'". $model_idss['UUID']."',";
		}
		$modal_ids2 = rtrim($modal_ids,",");

		$vehicle_query = $this->db->query("SELECT * FROM t_Vehicles WHERE Model_UUID IN($modal_ids2) ");
		$vehicle_query2 = $vehicle_query->result_array();
		$vehicle_id_found = "";
		foreach($vehicle_query2 as $vehicle_idss){
			//$modal_ids = $model_query12[0]['UUID'];
			$vehicle_idss1 = $vehicle_idss['id'];
			$vehicle_id_found .= $vehicle_idss['id'].',';
			$where .= "Vehicle_UUID LIKE '%$vehicle_idss1%' OR ";
		}
		$where2 = substr($where,0,-3);
		$vehicle_idss2 = rtrim($vehicle_idss1,"|");
		$vehicle_id_found =rtrim($vehicle_id_found,","); 
		$query = $this->db->query("SELECT * FROM t_Methods WHERE  ".$where2."");
		return array('result' => $query->result_array(), 'vehicle' => $vehicle_id_found);
	}

	public function search_keymaking_method_model(){
		$where = "Vehicle_UUID LIKE '%-%' OR ";
		$vehicle_idss1 = "";
		$modelId = $this->input->post('modelId');
		$vehicle_query = $this->db->query("SELECT * FROM t_Vehicles WHERE Model_UUID =? ",array($modelId));
		$vehicle_query2 = $vehicle_query->result_array();
		$vehicle_id_found = "";
		foreach($vehicle_query2 as $vehicle_idss){
			//$modal_ids = $model_query12[0]['UUID'];
			$vehicle_idss1 = $vehicle_idss['id'];
			$vehicle_id_found .= $vehicle_idss['id'].',';
			$where .= "Vehicle_UUID LIKE '%$vehicle_idss1%' OR ";
		}
		$where2 = substr($where,0,-3);
		$vehicle_idss2 = rtrim($vehicle_idss1,"|");
		$vehicle_id_found =rtrim($vehicle_id_found,",");
		$query = $this->db->query("SELECT * FROM t_Methods WHERE  ".$where2."");
		return array('result' => $query->result_array(), 'vehicle' => $vehicle_id_found);
	}

	public function search_keymaking_method_year(){
		$where = "Vehicle_UUID LIKE '%-%' OR ";
		$vehicle_idss1 = "";
		$modelId = str_replace('-',',',$this->input->post('search_key'));
		$vehicle_query = $this->db->query("SELECT * FROM t_Vehicles WHERE Years LIKE '%$modelId%' ");
		$vehicle_query2 = $vehicle_query->result_array();
		$vehicle_id_found = "";
		foreach($vehicle_query2 as $vehicle_idss){
			//$modal_ids = $model_query12[0]['UUID'];
			$vehicle_idss1 = $vehicle_idss['id'];
			$vehicle_id_found .= $vehicle_idss['id'].',';
			$where .= "Vehicle_UUID LIKE '%$vehicle_idss1%' OR ";
		}
		$where2 = substr($where,0,-3);
		$vehicle_id_found =rtrim($vehicle_id_found,",");
		$query = $this->db->query("SELECT * FROM t_Methods WHERE  ".$where2."");
		return array('result' => $query->result_array(), 'vehicle' => $vehicle_id_found);	
	}

	public function vehicles_keymak_filter_data(){
		$value =  $this->input->post('search_key');
		$where = "Vehicle_UUID LIKE '%-%' OR ";
		$vehicle_idss1 = "";
		$makes_id = "";
		$modal_ids = "";
		$search_key = trim($this->input->post('search_key'));		
		$make_query = $this->db->query("SELECT * FROM t_Makes WHERE Make_Name LIKE '%$search_key%'");
		$make_query1 = $make_query->result_array();		
		$model_query = $this->db->query("SELECT * FROM t_Models WHERE Model_Name LIKE '%$search_key%'");
		$model_query1 = $model_query->result_array();
		if($make_query->num_rows() > 0){
			$makes_id2 = $make_query1[0]['UUID'];
			$model_query22 = $this->db->query("SELECT * FROM t_Models WHERE Make_UUID = ? ",array($makes_id2));
			$model_query12 = $model_query22->result_array();
			foreach($model_query12 as $model_idss){
				//$modal_ids = $model_query12[0]['UUID'];
				$modal_ids .= "'". $model_idss['UUID']."',";
			}
			$modal_ids2 = rtrim($modal_ids,",");			
			$query = $this->db->query("SELECT t_Vehicles.id FROM t_Makes JOIN  t_Models ON t_Makes.UUID = t_Models.Make_UUID JOIN t_Vehicles ON  t_Models.UUID = t_Vehicles.Model_UUID WHERE t_Vehicles.Model_UUID IN($modal_ids2)   ORDER BY t_Makes.Make_Name,t_Models.Model_Name");
		}else if($model_query->num_rows() > 0){
			$modal_ids22 = "";
			foreach($model_query1 as $model_idss){				
				//$modal_ids = $model_query12[0]['UUID'];
				$modal_ids22 .= "'". $model_idss['UUID']."',";
			}
			$modal_ids2 = rtrim($modal_ids22,",");			
			//$query = $this->db->query("SELECT * FROM t_Vehicles WHERE Model_UUID IN($modal_ids2) ");
			$query = $this->db->query("SELECT t_Vehicles.id FROM t_Makes JOIN  t_Models ON t_Makes.UUID = t_Models.Make_UUID JOIN t_Vehicles ON  t_Models.UUID = t_Vehicles.Model_UUID WHERE t_Vehicles.Model_UUID IN($modal_ids2)   ORDER BY t_Makes.Make_Name,t_Models.Model_Name");
		}else{
			$query = $this->db->query("SELECT * FROM t_Vehicles WHERE Years LIKE '%$search_key%' ");
		}
		if($query->num_rows() > 0){
			$vehicle_id_found = "";
			$vehicle_query = $query->result_array();
			foreach($vehicle_query as $vehicle_idss){
				//$modal_ids = $model_query12[0]['UUID'];
				$vehicle_idss1 = $vehicle_idss['id'];
				$vehicle_id_found .= $vehicle_idss['id'].',';
				$where .= "Vehicle_UUID LIKE '%$vehicle_idss1%' OR ";
			}
			$where2 = substr($where,0,-3);
			$vehicle_id_found =rtrim($vehicle_id_found,","); 
			$query_search = $this->db->query("SELECT * FROM t_Methods  WHERE  ".$where2."");
			return array('result' => $query_search->result_array(), 'vehicle' => $vehicle_id_found);
		}else{
			$query_search = $this->db->query("SELECT * FROM t_Methods WHERE Content LIKE '%$value%'");
			return array('result' => $query_search->result_array(), 'vehicle' => '');
		}		
	}	

/************************* TipS Tricks Filtering data ***************************************************/

	public function vehicles_tipTricks_filter_data(){
		$value =  $this->input->post('search_key');
		$where = "Vehicle_UUID LIKE '%-%' OR ";
		$user_id_found = "";
		$vehicle_idss1 = "";
		$makes_id = "";
		$modal_ids = "";
		$search_key = trim($this->input->post('search_key'));		
		$make_query = $this->db->query("SELECT * FROM t_Makes WHERE Make_Name LIKE '%$search_key%'");
		$make_query1 = $make_query->result_array();		
		$model_query = $this->db->query("SELECT * FROM t_Models WHERE Model_Name LIKE '%$search_key%'");
		$model_query1 = $model_query->result_array();
		if($make_query->num_rows() > 0){
			$makes_id2 = $make_query1[0]['UUID'];
			$model_query22 = $this->db->query("SELECT * FROM t_Models WHERE Make_UUID = ? ",array($makes_id2));
			$model_query12 = $model_query22->result_array();
			foreach($model_query12 as $model_idss){
				//$modal_ids = $model_query12[0]['UUID'];
				$modal_ids .= "'". $model_idss['UUID']."',";
			}
			$modal_ids2 = rtrim($modal_ids,",");			
			$query = $this->db->query("SELECT t_Vehicles.id FROM t_Makes JOIN  t_Models ON t_Makes.UUID = t_Models.Make_UUID JOIN t_Vehicles ON  t_Models.UUID = t_Vehicles.Model_UUID WHERE t_Vehicles.Model_UUID IN($modal_ids2)   ORDER BY t_Makes.Make_Name,t_Models.Model_Name");
		}else if($model_query->num_rows() > 0){
			$modal_ids22 = "";
			foreach($model_query1 as $model_idss){				
				//$modal_ids = $model_query12[0]['UUID'];
				$modal_ids22 .= "'". $model_idss['UUID']."',";
			}
			$modal_ids2 = rtrim($modal_ids22,",");			
			//$query = $this->db->query("SELECT * FROM t_Vehicles WHERE Model_UUID IN($modal_ids2) ");
			$query = $this->db->query("SELECT t_Vehicles.id FROM t_Makes JOIN  t_Models ON t_Makes.UUID = t_Models.Make_UUID JOIN t_Vehicles ON  t_Models.UUID = t_Vehicles.Model_UUID WHERE t_Vehicles.Model_UUID IN($modal_ids2)   ORDER BY t_Makes.Make_Name,t_Models.Model_Name");
		}else{
			$query = $this->db->query("SELECT * FROM t_Vehicles WHERE Years LIKE '%$search_key%' ");
		}
		if($query->num_rows() > 0){
			$vehicle_id_found = "";
			$vehicle_query = $query->result_array();
			foreach($vehicle_query as $vehicle_idss){
				//$modal_ids = $model_query12[0]['UUID'];
				$vehicle_idss1 = $vehicle_idss['id'];
				$vehicle_id_found .= $vehicle_idss['id'].',';
				$where .= "Vehicle_UUID LIKE '%$vehicle_idss1%' OR ";
			}
			$where2 = substr($where,0,-3);
			$vehicle_id_found =rtrim($vehicle_id_found,","); 
			$query_search = $this->db->query("SELECT * FROM t_Tips  WHERE  ".$where2."");
			return array('result' => $query_search->result_array(), 'vehicle' => $vehicle_id_found);
		}else{
			$query_search_user=$this->db->query("SELECT User_UUID FROM t_Users WHERE Email LIKE '%$search_key%'");
			if($query_search_user->num_rows() > 0){
				$vehicle_query = $query_search_user->result_array();
				foreach($vehicle_query as $vehicle_idss){
					$user_id_found .= $vehicle_idss['User_UUID'].',';
				}
				$vehicle_id_found =rtrim($user_id_found,",");
				$query_search = 
				$this->db->query("SELECT * FROM t_Tips  WHERE User_UUID IN( ".$vehicle_id_found." ) ORDER BY Id DESC ");
				return array('result' => $query_search->result_array(), 'vehicle' => '');
			}else{
				$query_search = $this->db->query("SELECT * FROM t_Tips WHERE Content LIKE '%$search_key%' OR Title LIKE '%$search_key%' OR Videos LIKE '%$search_key%' ORDER BY Id DESC ");
				return array('result' => $query_search->result_array(), 'vehicle' => '');
			}			
		}
	}

/*---------------------------------- Admin announcements ------------------------------------------------*/

	public function save_admin_announcement(){
		$this->db->cache_delete('admpro', 'announcements');
		if($this->input->post('Active') == 'on'){
			$Active = 'Yes';
		}else{
			$Active = 'No';
		}
		if($this->input->post('Image_path') !=""){
			$Image_path = $this->input->post('Image_path');
			$image_id = "";
			foreach($Image_path as $images){
				$image_id .= $images.",";
			}
			$image_id2 = rtrim($image_id,",");
		}else{
			$image_id2 = "";
		}
		$data = array(					
			'UUID' => $this->input->post('UUID'),	
			'Title' => $this->input->post('Title'),
			'Message' => $this->input->post('Message'),
			'Version' => $this->input->post('Version'),
			'Image' => $image_id2,
			'Type' => $this->input->post('Type'),
			'Active' => $Active,
			'Priority' => $this->input->post('Priority'),
			'Expiration' => $this->input->post('Expiration')
		);
		$data = $this->security->xss_clean($data);
		$this->db->insert('t_Announcements', $data);
	}

	public function get_admin_announcements(){
		$query_search = $this->db->query("SELECT * FROM t_Announcements ORDER BY id DESC");
		return $query_search->result_array();
	}

	public function get_announcements_info($id){
		$query_search = $this->db->query("SELECT * FROM t_Announcements WHERE id =? ",array($id));
		return $query_search->result_array();
	}

	public function update_admin_announcement(){
		$this->db->cache_delete('admpro', 'announcements');
		$id = $this->input->post('id');
		if($this->input->post('Active') == 'on'){
			$Active = 'Yes';
		}else{
			$Active = 'No';
		}
		if($this->input->post('Image_path') !=""){
			$Image_path = $this->input->post('Image_path');
			$image_id = "";
			foreach($Image_path as $images){
				$image_id .= $images.",";
			}
			$image_id2 = rtrim($image_id,",");
		}else{
			$image_id2 = "";
		}
		$data = array(					
			'UUID' => $this->input->post('UUID'),	
			'Title' => $this->input->post('Title'),
			'Message' => $this->input->post('Message'),
			'Version' => $this->input->post('Version'),
			'Image' => $image_id2,
			'Type' => $this->input->post('Type'),
			'Active' => $Active,
			'Priority' => $this->input->post('Priority'),
			'Expiration' => $this->input->post('Expiration')
		);
		$this->db->where('id', $id);
		$data = $this->security->xss_clean($data);
		$this->db->update('t_Announcements', $data);
	}

	public function delete_admin_announcement($id){
		$this->db->cache_delete('admpro', 'announcements');
		$this->db->where('id', $id);
		$this->db->delete('t_Announcements'); 
	}	

	public function filter_announcements_data(){
		$search_key = $this->input->post('search_key');
		$type = $this->input->post('type');
		if($type == 'types'){
			if($search_key == 'all'){
				$query_search = $this->db->query("SELECT * FROM t_Announcements ORDER BY id DESC");
				return $query_search->result_array();
			}else{
				$query_search = $this->db->query("SELECT * FROM t_Announcements WHERE Type =? ", array($search_key));
				return $query_search->result_array();
			}
		}else{
			$query_search = $this->db->query("SELECT * FROM t_Announcements WHERE Title LIKE '%$search_key%' OR Message LIKE '%$search_key%' OR Version LIKE '%$search_key%' ");
			return $query_search->result_array();
		}
	}

	public function change_activation(){
		$id = $this->input->post('id');
		$Active = $this->input->post('active');
		$data = array(
			'Active' => $Active
		);
		$this->db->where('id', $id);
		$data = $this->security->xss_clean($data);
		$this->db->update('t_Announcements', $data);
	}

/*----------------------------------- Admin Access Users Type ---------------------------------*/
	
	public function get_users_types(){
		$query_search = $this->db->query("SELECT * FROM t_User_Types ORDER BY type");
		return $query_search->result_array();
	}	

	public function check_user_types(){
		$type = $this->input->post('type');
		$query_search = $this->db->query("SELECT * FROM t_User_Types WHERE type=? ", array($type));
		return $query_search->num_rows();
	}

	public function save_user_types(){
		$this->db->cache_delete('admpro', 'users_types');
		$user_data = $this->input->post('user');
		$user_id = "";
		foreach($user_data as $user){
			$user_id .= $user.",";
		}
		$user_id2 = rtrim($user_id,",");

		$content_data = $this->input->post('content');
		$content_id = "";
		foreach($content_data as $content){
			$content_id .= $content.",";
		}
		$content_id2 = rtrim($content_id,",");

		$key_codes_data = $this->input->post('keyCodes');
		$key_codes_id = "";
		foreach($key_codes_data as $key_codes){
			$key_codes_id .= $key_codes.",";
		}
		$key_codes_id2 = rtrim($key_codes_id,",");

		$admin_data = $this->input->post('admin');
		$admin_id = "";
		foreach($admin_data as $admin){
			$admin_id .= $admin.",";
		}
		$admin_id2 = rtrim($admin_id,",");

		$other_data = $this->input->post('other');
		$other_id = "";
		foreach($other_data as $other){
			$other_id .= $other.",";
		}
		$other_id2 = rtrim($other_id,",");

		$data = array(					
			'type' => $this->input->post('type'),
			'user' => $user_id2,
			'content' => $content_id2,
			'key_codes' => $key_codes_id2,
			'admin' => $admin_id2,
			'other' => $other_id2
		);
		$data = $this->security->xss_clean($data);
		$this->db->insert('t_User_Types', $data);
	}

	public function get_users_types_info($id){
		$query_search = $this->db->query("SELECT * FROM t_User_Types WHERE id=? ", array($id));
		return $query_search->result_array();
	}

	public function update_user_types(){
			$this->db->cache_delete('admpro', 'users_types');
		$id = $this->input->post('id');
		$user_data = $this->input->post('user');
		$user_id = "";
		foreach($user_data as $user){
			$user_id .= $user.",";
		}
		$user_id2 = rtrim($user_id,",");

		$content_data = $this->input->post('content');
		$content_id = "";
		foreach($content_data as $content){
			$content_id .= $content.",";
		}
		$content_id2 = rtrim($content_id,",");

		$key_codes_data = $this->input->post('keyCodes');
		$key_codes_id = "";
		foreach($key_codes_data as $key_codes){
			$key_codes_id .= $key_codes.",";
		}
		$key_codes_id2 = rtrim($key_codes_id,",");

		$admin_data = $this->input->post('admin');
		$admin_id = "";
		foreach($admin_data as $admin){
			$admin_id .= $admin.",";
		}
		$admin_id2 = rtrim($admin_id,",");

		$other_data = $this->input->post('other');
		$other_id = "";
		foreach($other_data as $other){
			$other_id .= $other.",";
		}
		$other_id2 = rtrim($other_id,",");

		$data = array(					
			'type' => $this->input->post('type'),
			'user' => $user_id2,
			'content' => $content_id2,
			'key_codes' => $key_codes_id2,
			'admin' => $admin_id2,
			'other' => $other_id2
		);
		
		$this->db->where('id', $id);
		$data = $this->security->xss_clean($data);
		$this->db->update('t_User_Types', $data);
	}

	public function delete_user_types($id){
			$this->db->cache_delete('admpro', 'users_types');
		$this->db->where('id', $id);
		$this->db->delete('t_User_Types'); 
	}

/*---------------------------- Avtars ----------------------*/

	public function avatars(){
		$query_search = $this->db->query("SELECT * FROM t_Avatars ORDER BY Sort_Order");
		return $query_search->result_array();
	}

	public function save_avatars(){
			$this->db->cache_delete('admpro', 'avatars');
		if($this->input->post('Image_path') !=""){
			$Image_path = $this->input->post('Image_path');
			$image_id = "";
			foreach($Image_path as $images){
				$image_id .= $images.",";
			}
			$image_id2 = rtrim($image_id,",");
		}else{
			$image_id2 = "";
		}
		$data = array(					
			'UUID' => $this->input->post('UUID'),	
			'Sort_Order' => $this->input->post('Sort_Order'),
			'Image_Path' => $image_id2
		);
		$data = $this->security->xss_clean($data);
		$this->db->insert('t_Avatars', $data);
	}

	public function delete_avtars($id){
		$this->db->cache_delete('admpro', 'avatars');
		$this->db->where('id', $id);
		$this->db->delete('t_Avatars'); 
	}

	public function avatars_sort_order($order,$id){
		$data = array(						
			'Sort_Order' => $order
		);
		$this->db->where('id', $id);
		$data = $this->security->xss_clean($data);
		$this->db->update('t_Avatars', $data);	
	}

	public function searhAksUser(){
		$search_key = trim($this->input->post('search_key'));
		$query = $this->db->query("SELECT Email,User_UUID FROM t_Users WHERE FirstName LIKE '%$search_key%' OR LastName LIKE '%$search_key%' OR Email LIKE '%$search_key%' OR User_UUID LIKE '%$search_key%' ORDER BY Email ");
		if($query->num_rows() > 0){
		 	return $query->result_array();
	  	}else{
		   return 0;
	    }
	}

	public function all_input_update(){
		$column_name = $this->input->post('columnName');
		$tableName = $this->input->post('tableName');
		foreach($_POST[$column_name] as $key => $val) {
			$data = array($column_name => $val);			
			$this->db->where('id', $key);
			$data = $this->security->xss_clean($data);
			$this->db->update($tableName, $data);
		}			
		if(isset($val)){
				if($column_name == 'Code_Series_UUID'){
					$query_code = $this->db->query("SELECT Code_Series_Name FROM t_Code_Series WHERE UUID = ? ", array($val));
					$query_code_data = $query_code->result_array();
					return $query_code_data[0]['Code_Series_Name'];
				}else{			
					return $val;
				}
		}else{
			return '';
		}
	}

/*--------------------------- code_conversion --------------------------------------*/
	
	public function code_conversion(){
		$query_search = $this->db->query("SELECT * FROM cs_auto_codes_headers ORDER BY id");
		return $query_search->result_array();
	}
	public function code_conversionRows(){		
		return $this->db->count_all("cs_auto_codes_headers");
	}
	public function code_conversionDetail($limit,$limt_start){
		$query_search = $this->db->query("SELECT * FROM cs_auto_codes_headers ORDER BY id LIMIT  ".(int)$limt_start.", ".(int)$limit." ");
		return $query_search->result_array();
	}
	public function code_conversion_info($id){
		$query_search = $this->db->query("SELECT * FROM cs_auto_codes_headers WHERE id = ? ", array($id));
		return $query_search->result_array();
	}	

	public function update_code_conversion(){
		$this->db->cache_delete('admpro', 'code_series_list');
		$id = $this->input->post('id');
		$data = array(
			'Title' => $this->input->post('Title'),
			'Code_Range__Start' => $this->input->post('Code_Range__Start'),
			'Code_Range__End' => $this->input->post('Code_Range__End'),
			'Notes' => $this->input->post('Notes'),
			'Code_Series_UUID' => $this->input->post('Code_Series_UUID'),
			'Lock_Type' => $this->input->post('Lock_Type')
		);
		$this->db->where('id', $id);
		$data = $this->security->xss_clean($data);
		$this->db->update('cs_auto_codes_headers', $data);
	}

	public function save_code_conversion(){
		$this->db->cache_delete('admpro', 'code_series_list');
		$data = array(
			'Auto_Num' => time(),
			'Title' => $this->input->post('Title'),
			'Code_Range__Start' => $this->input->post('Code_Range__Start'),
			'Code_Range__End' => $this->input->post('Code_Range__End'),
			'Notes' => $this->input->post('Notes'),
			'Code_Series_UUID' => $this->input->post('Code_Series_UUID'),
			'Lock_Type' => $this->input->post('Lock_Type')
		);
		$data = $this->security->xss_clean($data);
		$this->db->insert('cs_auto_codes_headers', $data);
	}

	public function search_code_list(){
		$search_key = trim($this->input->post('search_key'));
		$query_search = $this->db->query("SELECT * FROM cs_auto_codes_headers WHERE Title LIKE '%$search_key%' OR Code_Series_UUID LIKE '%$search_key%' OR Code_Range__Start LIKE '%$search_key%' OR Code_Range__End LIKE '%$search_key%' OR Notes LIKE '%$search_key%' ");
		return $query_search->result_array();
	}

	public function get_ls_connect($limit,$limt_start){
		$query_search = $this->db->query("SELECT * FROM cs_ls_key_grids ORDER BY AutoNum,Grid_Title LIMIT  ".(int)$limt_start.", ".(int)$limit." ");
		return $query_search->result_array();
	}

	public function getAllLsConnectsRows(){		
		return $this->db->count_all("cs_ls_key_grids");
	}

	public function ls_complete(){
		$uid = $this->input->post('uid');
		$status = $this->input->post('status');
		$data = array(					
			'COMPLETE' => $status
		);
		$this->db->where('AutoNum', $uid);
		$data = $this->security->xss_clean($data);
		$this->db->update('cs_ls_key_grids', $data);	
	}

	public function machine_worked_status(){
		$uid = $this->input->post('uid');
		$status = $this->input->post('status');
		$data = array(					
			'Result' => $status
		);
		$this->db->where('id', $uid);
		$data = $this->security->xss_clean($data);
		$this->db->update('t_Success_Reporting', $data);
	}

	public function search_Ls_connect(){
		$this->db->cache_delete('admpro', 'search_Ls_connect');
		$search_key = trim($this->input->post('search_key'));
		$query_search = $this->db->query("SELECT * FROM cs_ls_key_grids WHERE Grid_Title LIKE '%$search_key%'");
		return $query_search->result_array();
	}

	public function search_convert_code_list(){
		$search_key = trim($this->input->post('search_key'));
		$search_key_A = substr($search_key, 0, 1);
		$sentence = $search_key;
        $string = '0'; 
        $position = '1';
		$code2 = substr_replace( $sentence, $string, $position, 0 );
		$code3 = substr_replace( $sentence, '00', $position, 0 ); 
        $code4 = substr_replace( $sentence, '000', $position, 0 );
        $code5 = substr_replace( $sentence, '0000', $position, 0 );
        $code6 = substr_replace( $sentence, '00000', $position, 0 ); 
		$query_search = $this->db->query("SELECT h.Auto_Num,h.Title,c.The_Code,c.The_Cut,h.Code_Range__Start,h.Code_Range__End,h.Code_Series_UUID FROM cs_auto_codes_headers as h JOIN cs_auto_codes_cuts c ON h.Auto_Num = c.Header_ID WHERE c.The_Code='".$search_key."' OR c.The_Code='".$code2."' OR c.The_Code='".$code3."' OR c.The_Code='".$code4."' OR c.The_Code='".$code5."' OR c.The_Code='".$code6."'");
		return $query_search->result_array();
	}

	public function autopro_app_updates(){
		$query_search = $this->db->query("SELECT * FROM t_Updates ORDER BY id DESC");
		return $query_search->result_array();
	}

	public function save_autoproapp_version($filename){
		$data = array(	
			'versionName' => $this->input->post('versionName'),
			'Download_Path' => $filename,
			'version_code' => $this->input->post('version_code'),
			'version_message' => $this->input->post('version_message')
		);
		$data = $this->security->xss_clean($data);
		$return = $this->db->insert('t_Updates', $data);
		if($return){
			return 1;
		}else{
			return 0;
		}
	}

	public function autoproapp_vesrion_info($id){
		$query_search = $this->db->query("SELECT * FROM t_Updates WHERE id = ? ",array($id));
		return $query_search->result_array();
	}

	public function delete_autoproapp_vesrion($id){
		$this->db->where('id', $id);
		$this->db->delete('t_Updates'); 
	}

	public function getAllTipsTricksRows(){		
		return $this->db->count_all("t_Tips");
	}

/*-------------------------- Testmonials ----------------------*/

	public function get_testimonials_rows(){
		return $this->db->count_all("t_AutoProPAD_Testimonials");
	}

	public function get_testimonials($limit,$limt_start){
		$query = $this->db->query("SELECT * FROM t_AutoProPAD_Testimonials ORDER BY sortOrder LIMIT  ".(int)$limt_start.", ".(int)$limit." ");
		return $query->result_array();
	}

	public function save_testimonials(){
		$this->db->cache_delete('admpro', 'autopropad');
		$Order_Date = date('Y-m-d', strtotime($this->input->post('Order_Date')));
		$data = array(						
			'testimonial' => $this->input->post('testimonial'),
			'authorName' => $this->input->post('authorName'),
			'businessName' => $this->input->post('businessName'),
			'location' => $this->input->post('location'),
			'sortOrder' => $this->input->post('sortOrder')
		);
		$data = $this->security->xss_clean($data);
		$this->db->insert('t_AutoProPAD_Testimonials', $data);
	}

	public function update_testimonials(){
		$this->db->cache_delete('admpro', 'autopropad');
		$id = $this->input->post('id');
		$data = array(						
			'testimonial' => $this->input->post('testimonial'),
			'authorName' => $this->input->post('authorName'),
			'businessName' => $this->input->post('businessName'),
			'location' => $this->input->post('location'),
			'sortOrder' => $this->input->post('sortOrder')
		);
		$this->db->where('id', $id);
		$data = $this->security->xss_clean($data);
		$this->db->update('t_AutoProPAD_Testimonials', $data);
	}

	public function testimonials_info($id){
		$query = $this->db->query("SELECT * FROM t_AutoProPAD_Testimonials WHERE id=? ",array($id));
		return $query->result_array();
	}

	public function delete_testimonials($id){
		$this->db->cache_delete('admpro', 'autopropad');
		$this->db->where('id', $id);
		$this->db->delete('t_AutoProPAD_Testimonials');
	}

	public function testimonials_sort_order($order,$id){
		$data_table = $this->input->post('data_table');
		$data = array(						
			'sortOrder' => $order
		);
		$this->db->where('id', $id);
		$data = $this->security->xss_clean($data);
		$this->db->update($data_table, $data);	
	}
/*---------------------- Videos --------------------------------------*/

	public function get_videos_rows(){
		return $this->db->count_all("t_AutoProPAD_Videos");
	}	

	public function get_videos($limit,$limt_start){
		$query = $this->db->query("SELECT * FROM t_AutoProPAD_Videos ORDER BY sortOrder LIMIT  ".(int)$limt_start.", ".(int)$limit." ");
		return $query->result_array();
	}

	public function save_videos(){		
		$this->db->cache_delete('admpro', 'autopropad');
		$data = array(						
			'category' => $this->input->post('category'),
			'make' => $this->input->post('make'),
			'title' => $this->input->post('title'),
			'youtubeid' => $this->input->post('youtubeid'),
			'sortOrder' => $this->input->post('sortOrder')
		);
		$data = $this->security->xss_clean($data);
		$this->db->insert('t_AutoProPAD_Videos', $data);
	}

	public function videos_info($id){
		$query = $this->db->query("SELECT * FROM t_AutoProPAD_Videos WHERE id=? ",array($id));
		return $query->result_array();
	}

	public function update_videos(){
		
$this->db->cache_delete('admpro', 'autopropad');
		$id = $this->input->post('id');
		$data = array(						
			'category' => $this->input->post('category'),
			'make' => $this->input->post('make'),
			'title' => $this->input->post('title'),
			'youtubeid' => $this->input->post('youtubeid'),
			'sortOrder' => $this->input->post('sortOrder')
		);
		$this->db->where('id', $id);
		$data = $this->security->xss_clean($data);
		$this->db->update('t_AutoProPAD_Videos', $data);
	}

	public function delete_videos($id){
		
		$this->db->cache_delete('admpro', 'autopropad');
		$this->db->where('id', $id);
		$this->db->delete('t_AutoProPAD_Videos');
	}

/*-------------------------- FAQs ---------------------*/
	
	public function get_faqs_rows(){
		return $this->db->count_all("t_AutoProPAD_FAQs");
	}	

	public function get_faqs($limit,$limt_start){
		$query = $this->db->query("SELECT * FROM t_AutoProPAD_FAQs ORDER BY sortOrder LIMIT  ".(int)$limt_start.", ".(int)$limit." ");
		return $query->result_array();
	}	

	public function save_faqs(){
		$this->db->cache_delete('admpro', 'autopropad');
		$data = array(
			'title' => $this->input->post('title'),
			'content' => $this->input->post('content'),
			'sortOrder' => $this->input->post('sortOrder')
		);
		$data = $this->security->xss_clean($data);
		$this->db->insert('t_AutoProPAD_FAQs', $data);
	}

	public function faqs_info($id){
		$query = $this->db->query("SELECT * FROM t_AutoProPAD_FAQs WHERE id=? ",array($id));
		return $query->result_array();
	}

	public function update_faqs(){
		$this->db->cache_delete('admpro', 'autopropad');
		$id = $this->input->post('id');
		$data = array(
			'title' => $this->input->post('title'),
			'content' => $this->input->post('content'),
			'sortOrder' => $this->input->post('sortOrder')
		);
		$this->db->where('id', $id);
		$data = $this->security->xss_clean($data);
		$this->db->update('t_AutoProPAD_FAQs', $data);
	}

	public function delete_faqs($id){
		$this->db->cache_delete('admpro', 'autopropad');
		$this->db->where('id', $id);
		$this->db->delete('t_AutoProPAD_FAQs');
	}
/*-------------------------- 'Distributors ---------------------*/
	
	public function get_distributors_rows(){
		return $this->db->count_all("t_AutoProPAD_Distributors");
	}	

	public function get_distributors($limit,$limt_start){
		$query = $this->db->query("SELECT * FROM t_AutoProPAD_Distributors ORDER BY sortOrder LIMIT  ".(int)$limt_start.", ".(int)$limit." ");
		return $query->result_array();
	}	

	public function save_distributors($imagePath){
		$this->db->cache_delete('admpro', 'autopropad');
		$data = array(
			'imagePath' => $imagePath,
			'content' => $this->input->post('content'),
			'sortOrder' => $this->input->post('sortOrder'),
			'show1' => 1
		);
		$data = $this->security->xss_clean($data);
		$this->db->insert('t_AutoProPAD_Distributors', $data);
	}

	public function distributors_info($id){
		$query = $this->db->query("SELECT * FROM t_AutoProPAD_Distributors WHERE id=? ",array($id));
		return $query->result_array();
	}

	public function update_distributors($imagePath){
		$this->db->cache_delete('admpro', 'autopropad');
		$id = $this->input->post('id');
		if($imagePath !=""){
			$data = array(
				'imagePath' => $imagePath,
				'content' => $this->input->post('content'),
				'sortOrder' => $this->input->post('sortOrder')
			);
		}else{
			$data = array(
				'content' => $this->input->post('content'),
				'sortOrder' => $this->input->post('sortOrder')
			);
		}
		
		$this->db->where('id', $id);
		$data = $this->security->xss_clean($data);
		$this->db->update('t_AutoProPAD_Distributors', $data);
	}

	public function delete_distributors($id){
		$this->db->cache_delete('admpro', 'autopropad');
		$this->db->where('id', $id);
		$this->db->delete('t_AutoProPAD_Distributors');
	}

	public function show_on_autopad(){
		$uid = $this->input->post('uid');
		$status = $this->input->post('status');
		$data = array(					
			'show1' => $status
		);
		$this->db->where('id', $uid);
		$data = $this->security->xss_clean($data);
		$this->db->update('t_AutoProPAD_Distributors', $data);	
	}	

/*-------------------------- 'Distributors ---------------------*/
	
	public function get_content_rows(){
		return $this->db->count_all("t_AutoProPAD_Content");
	}	

	public function get_content($limit,$limt_start){
		$query = $this->db->query("SELECT * FROM t_AutoProPAD_Content ORDER BY id LIMIT  ".(int)$limt_start.", ".(int)$limit." ");
		return $query->result_array();
	}	

	public function save_content(){
		$this->db->cache_delete('admpro', 'autopropad');
		$data = array(
			'Description' => $this->input->post('Description'),
			'Content' => $this->input->post('Content')
		);
		$data = $this->security->xss_clean($data);
		$this->db->insert('t_AutoProPAD_Content', $data);
	}

	public function content_info($id){
		$query = $this->db->query("SELECT * FROM t_AutoProPAD_Content WHERE id=? ",array($id));
		return $query->result_array();
	}

	public function update_content(){
		$this->db->cache_delete('admpro', 'autopropad');
		$id = $this->input->post('id');
		$data = array(
			'Description' => $this->input->post('Description'),
			'Content' => $this->input->post('Content')
		);
		$this->db->where('id', $id);
		$data = $this->security->xss_clean($data);
		$this->db->update('t_AutoProPAD_Content', $data);
	}

	public function delete_content($id){
		$this->db->cache_delete('admpro', 'autopropad');
		$this->db->where('id', $id);
		$this->db->delete('t_AutoProPAD_Content');
	}	

/*-----------------*/
public function getSearchItem($limit,$limt_start,$search_key){
		if(isset($_SESSION['global_sorting']) && $_SESSION['global_sorting'] !=""){
			$global_sorting = $_SESSION['global_sorting'];
		}else{
			$global_sorting = "t_Makes.Make_Name, t_Models.Model_Name";
		}
		$makes_id = "";
		$modal_ids = "";
		
		$make_query = $this->db->query("SELECT * FROM t_Makes WHERE Make_Name LIKE '%$search_key%'");
		$make_query1 = $make_query->result_array();
		
		$model_query = $this->db->query("SELECT * FROM t_Models WHERE Model_Name LIKE '%$search_key%'");
		$model_query1 = $model_query->result_array();		
		
		$t_code_series_query = $this->db->query("SELECT * FROM t_Code_Series WHERE Code_Series_Name LIKE '%$search_key%'");
		$t_code_series_query1 = $t_code_series_query->result_array();
		
		$t_keys_query = $this->db->query("SELECT * FROM t_Keys WHERE Key_Name LIKE '%$search_key%'");
		$t_keys_query1 = $t_keys_query->result_array();
		
		$t_remotes_query = $this->db->query("SELECT * FROM t_Remotes WHERE Remote_Name LIKE '%$search_key%'");
		$t_remotes_query1 = $t_remotes_query->result_array();
		
		if($make_query->num_rows() > 0){
			$makes_id2 = $make_query1[0]['UUID'];
			$model_query22 = $this->db->query("SELECT * FROM t_Models WHERE Make_UUID =? ",array($makes_id2));
			$model_query12 = $model_query22->result_array();
			foreach($model_query12 as $model_idss){
				//$modal_ids = $model_query12[0]['UUID'];
				$modal_ids .= "'". $model_idss['UUID']."',";
			}
			$modal_ids2 = rtrim($modal_ids,",");			
			$query = $this->db->query("SELECT t_Vehicles.gen,t_Vehicles.Parts_Keys,t_Vehicles.Parts_Chips,t_Vehicles.Parts_Batteries,t_Vehicles.gen_notes,t_Vehicles.duplicated,t_Models.Vehicle_Type_UUID,t_Vehicles.image_url,t_Makes.Make_Name,t_Vehicles.UUID,t_Models.Model_Name,t_Vehicles.id,t_Vehicles.Model_UUID,t_Vehicles.Years,t_Vehicles.Code_Series_UUID,t_Vehicles.Retainer_UUID,t_Vehicles.Mechanical_Key_UUID,t_Vehicles.Chip_Key_UUID,t_Vehicles.Remote_UUID,t_Vehicles.RHK_UUID,t_Vehicles.SmartKey_UUID,t_Vehicles.MVP_System,t_Vehicles.MVP_Dongle_UUID,t_Vehicles.MVP_SmartCard,t_Vehicles.MVP_Software,t_Vehicles.MVP_PIN_Required,t_Vehicles.MVP_PIN_Read,t_Vehicles.ProLok_Tool_UUID,t_Vehicles.ProLok_Linkage,t_Vehicles.Vehicle_Image,t_Vehicles.Image_UUID,t_Vehicles.MVP_Notes,t_Vehicles.APP_System,t_Vehicles.APP_Add_Keys,t_Vehicles.APP_All_Keys_Lost,t_Vehicles.APP_Notes,t_Vehicles.HW_Key_Prog,t_Vehicles.HW_Remote_Prog,t_Vehicles.HW_Misc_Prog,t_Vehicles.TKOSDD_System,t_Vehicles.TKOSDD_SDD_Adapter,t_Vehicles.TKOSDD_SDD_Cable,t_Vehicles.TKOSDD_TKO_Cable,t_Vehicles.TKOSDD_Notes,t_Vehicles.APP_Confirmed_Working,t_Vehicles.DMax_System,t_Vehicles.DMax_Method,t_Vehicles.Parts_Ignition,t_Vehicles.Parts_Door,t_Vehicles.Parts_Accessories,t_Vehicles.Vehicle_Type,t_Vehicles.Tumblers,t_Vehicles.OBD_Location_Text,t_Vehicles.OBD_Location_Image,t_Vehicles.APP_Programs_Remote,t_Vehicles.APP_Resync_Available,t_Vehicles.PIN_Read FROM t_Vehicles JOIN t_Models ON t_Models.UUID = t_Vehicles.Model_UUID
		LEFT JOIN t_Makes ON t_Makes.UUID = t_Models.Make_UUID WHERE t_Vehicles.Model_UUID IN($modal_ids2) AND duplicate_of=0   ORDER BY ".$global_sorting." ");
	

		}else if($model_query->num_rows() > 0){
			$modal_ids22 = "";
			foreach($model_query1 as $model_idss){				
				//$modal_ids = $model_query12[0]['UUID'];
				$modal_ids22 .= "'". $model_idss['UUID']."',";
			}
			$modal_ids2 = rtrim($modal_ids22,",");			
			//$query = $this->db->query("SELECT * FROM t_Vehicles WHERE Model_UUID IN($modal_ids2) ");
			$query = $this->db->query("SELECT t_Models.Vehicle_Type_UUID,t_Vehicles.image_url,t_Makes.Make_Name,t_Vehicles.UUID,t_Models.Model_Name,t_Vehicles.id,t_Vehicles.Model_UUID,t_Vehicles.Years,t_Vehicles.Code_Series_UUID,t_Vehicles.Retainer_UUID,t_Vehicles.Mechanical_Key_UUID,t_Vehicles.Chip_Key_UUID,t_Vehicles.Remote_UUID,t_Vehicles.RHK_UUID,t_Vehicles.SmartKey_UUID,t_Vehicles.MVP_System,t_Vehicles.MVP_Dongle_UUID,t_Vehicles.MVP_SmartCard,t_Vehicles.MVP_Software,t_Vehicles.MVP_PIN_Required,t_Vehicles.MVP_PIN_Read,t_Vehicles.ProLok_Tool_UUID,t_Vehicles.ProLok_Linkage,t_Vehicles.Vehicle_Image,t_Vehicles.Image_UUID,t_Vehicles.MVP_Notes,t_Vehicles.APP_System,t_Vehicles.APP_Add_Keys,t_Vehicles.APP_All_Keys_Lost,t_Vehicles.APP_Notes,t_Vehicles.HW_Key_Prog,t_Vehicles.HW_Remote_Prog,t_Vehicles.HW_Misc_Prog,t_Vehicles.TKOSDD_System,t_Vehicles.TKOSDD_SDD_Adapter,t_Vehicles.TKOSDD_SDD_Cable,t_Vehicles.TKOSDD_TKO_Cable,t_Vehicles.TKOSDD_Notes,t_Vehicles.APP_Confirmed_Working,t_Vehicles.DMax_System,t_Vehicles.DMax_Method,t_Vehicles.Parts_Ignition,t_Vehicles.Parts_Door,t_Vehicles.Parts_Accessories,t_Vehicles.Vehicle_Type,t_Vehicles.Tumblers,t_Vehicles.OBD_Location_Text,t_Vehicles.OBD_Location_Image,t_Vehicles.APP_Programs_Remote,t_Vehicles.APP_Resync_Available,t_Vehicles.PIN_Read FROM t_Makes JOIN  t_Models ON t_Makes.UUID = t_Models.Make_UUID JOIN t_Vehicles ON  t_Models.UUID = t_Vehicles.Model_UUID WHERE t_Vehicles.Model_UUID IN($modal_ids2)   ORDER BY ".$global_sorting." ");
		}else if($t_code_series_query->num_rows() > 0){
			$modal_ids22 = "";
			$where = "";
			foreach($t_code_series_query1 as $model_idss){				
				//$modal_ids = $model_query12[0]['UUID'];
				$code_uuid = rtrim($model_idss['UUID'],'|');
				$modal_ids22 .= "'". $code_uuid."',";
				$where .= "t_Vehicles.Code_Series_UUID LIKE '%$code_uuid%' OR ";
			}
			$where2 = substr($where,0,-3);
			$modal_ids2 = rtrim($modal_ids22,",");	
			//$query = $this->db->query("SELECT * FROM t_Vehicles WHERE ".$where2."");
			$query = $this->db->query("SELECT t_Vehicles.gen,t_Vehicles.Parts_Keys,t_Vehicles.Parts_Chips,t_Vehicles.Parts_Batteries,t_Vehicles.gen_notes,t_Models.Vehicle_Type_UUID,t_Vehicles.image_url,t_Makes.Make_Name,t_Vehicles.UUID,t_Models.Model_Name,t_Vehicles.id,t_Vehicles.Model_UUID,t_Vehicles.Years,t_Vehicles.Code_Series_UUID,t_Vehicles.Retainer_UUID,t_Vehicles.Mechanical_Key_UUID,t_Vehicles.Chip_Key_UUID,t_Vehicles.Remote_UUID,t_Vehicles.RHK_UUID,t_Vehicles.SmartKey_UUID,t_Vehicles.MVP_System,t_Vehicles.MVP_Dongle_UUID,t_Vehicles.MVP_SmartCard,t_Vehicles.MVP_Software,t_Vehicles.MVP_PIN_Required,t_Vehicles.MVP_PIN_Read,t_Vehicles.ProLok_Tool_UUID,t_Vehicles.ProLok_Linkage,t_Vehicles.Vehicle_Image,t_Vehicles.Image_UUID,t_Vehicles.MVP_Notes,t_Vehicles.APP_System,t_Vehicles.APP_Add_Keys,t_Vehicles.APP_All_Keys_Lost,t_Vehicles.APP_Notes,t_Vehicles.HW_Key_Prog,t_Vehicles.HW_Remote_Prog,t_Vehicles.HW_Misc_Prog,t_Vehicles.TKOSDD_System,t_Vehicles.TKOSDD_SDD_Adapter,t_Vehicles.TKOSDD_SDD_Cable,t_Vehicles.TKOSDD_TKO_Cable,t_Vehicles.TKOSDD_Notes,t_Vehicles.APP_Confirmed_Working,t_Vehicles.DMax_System,t_Vehicles.DMax_Method,t_Vehicles.Parts_Ignition,t_Vehicles.Parts_Door,t_Vehicles.Parts_Accessories,t_Vehicles.Vehicle_Type,t_Vehicles.Tumblers,t_Vehicles.OBD_Location_Text,t_Vehicles.OBD_Location_Image,t_Vehicles.APP_Programs_Remote,t_Vehicles.APP_Resync_Available,t_Vehicles.PIN_Read FROM t_Makes JOIN  t_Models ON t_Makes.UUID = t_Models.Make_UUID JOIN t_Vehicles ON  t_Models.UUID = t_Vehicles.Model_UUID WHERE ".$where2." ORDER BY ".$global_sorting." ");
		}else if($t_keys_query->num_rows() > 0){
			$modal_ids22 = "";
			foreach($t_keys_query1 as $model_idss){				
				//$modal_ids = $model_query12[0]['UUID'];
				$modal_ids22 .= "'". $model_idss['UUID']."',";
			}
			$modal_ids2 = rtrim($modal_ids22,",");
			//$query = $this->db->query("SELECT * FROM t_Vehicles WHERE Mechanical_Key_UUID IN($modal_ids2)  OR Chip_Key_UUID IN($modal_ids2) ");
			$query = $this->db->query("SELECT t_Vehicles.gen,t_Vehicles.Parts_Keys,t_Vehicles.Parts_Chips,t_Vehicles.Parts_Batteries,t_Vehicles.gen_notes,t_Models.Vehicle_Type_UUID,t_Vehicles.image_url,t_Makes.Make_Name,t_Vehicles.UUID,t_Models.Model_Name,t_Vehicles.id,t_Vehicles.Model_UUID,t_Vehicles.Years,t_Vehicles.Code_Series_UUID,t_Vehicles.Retainer_UUID,t_Vehicles.Mechanical_Key_UUID,t_Vehicles.Chip_Key_UUID,t_Vehicles.Remote_UUID,t_Vehicles.RHK_UUID,t_Vehicles.SmartKey_UUID,t_Vehicles.MVP_System,t_Vehicles.MVP_Dongle_UUID,t_Vehicles.MVP_SmartCard,t_Vehicles.MVP_Software,t_Vehicles.MVP_PIN_Required,t_Vehicles.MVP_PIN_Read,t_Vehicles.ProLok_Tool_UUID,t_Vehicles.ProLok_Linkage,t_Vehicles.Vehicle_Image,t_Vehicles.Image_UUID,t_Vehicles.MVP_Notes,t_Vehicles.APP_System,t_Vehicles.APP_Add_Keys,t_Vehicles.APP_All_Keys_Lost,t_Vehicles.APP_Notes,t_Vehicles.HW_Key_Prog,t_Vehicles.HW_Remote_Prog,t_Vehicles.HW_Misc_Prog,t_Vehicles.TKOSDD_System,t_Vehicles.TKOSDD_SDD_Adapter,t_Vehicles.TKOSDD_SDD_Cable,t_Vehicles.TKOSDD_TKO_Cable,t_Vehicles.TKOSDD_Notes,t_Vehicles.APP_Confirmed_Working,t_Vehicles.DMax_System,t_Vehicles.DMax_Method,t_Vehicles.Parts_Ignition,t_Vehicles.Parts_Door,t_Vehicles.Parts_Accessories,t_Vehicles.Vehicle_Type,t_Vehicles.Tumblers,t_Vehicles.OBD_Location_Text,t_Vehicles.OBD_Location_Image,t_Vehicles.APP_Programs_Remote,t_Vehicles.APP_Resync_Available,t_Vehicles.PIN_Read FROM t_Makes JOIN  t_Models ON t_Makes.UUID = t_Models.Make_UUID JOIN t_Vehicles ON  t_Models.UUID = t_Vehicles.Model_UUID WHERE t_Vehicles.Mechanical_Key_UUID IN($modal_ids2)  OR t_Vehicles.Chip_Key_UUID IN($modal_ids2) ORDER BY ".$global_sorting." ");
		}else if($t_remotes_query->num_rows() > 0){			
			$modal_ids22 = "";
			foreach($t_remotes_query1 as $model_idss){				
				//$modal_ids = $model_query12[0]['UUID'];
				$modal_ids22 .= "'". $model_idss['UUID']."',";
			}
			$modal_ids2 = rtrim($modal_ids22,",");
			//$query = $this->db->query("SELECT * FROM t_Vehicles WHERE Remote_UUID IN($modal_ids2)  OR RHK_UUID IN($modal_ids2) OR SmartKey_UUID IN($modal_ids2) ");
			$query = $this->db->query("SELECT t_Vehicles.gen,t_Vehicles.Parts_Keys,t_Vehicles.Parts_Chips,t_Vehicles.Parts_Batteries,t_Vehicles.gen_notes,t_Models.Vehicle_Type_UUID,t_Vehicles.image_url,t_Makes.Make_Name,t_Vehicles.UUID,t_Models.Model_Name,t_Vehicles.id,t_Vehicles.Model_UUID,t_Vehicles.Years,t_Vehicles.Code_Series_UUID,t_Vehicles.Retainer_UUID,t_Vehicles.Mechanical_Key_UUID,t_Vehicles.Chip_Key_UUID,t_Vehicles.Remote_UUID,t_Vehicles.RHK_UUID,t_Vehicles.SmartKey_UUID,t_Vehicles.MVP_System,t_Vehicles.MVP_Dongle_UUID,t_Vehicles.MVP_SmartCard,t_Vehicles.MVP_Software,t_Vehicles.MVP_PIN_Required,t_Vehicles.MVP_PIN_Read,t_Vehicles.ProLok_Tool_UUID,t_Vehicles.ProLok_Linkage,t_Vehicles.Vehicle_Image,t_Vehicles.Image_UUID,t_Vehicles.MVP_Notes,t_Vehicles.APP_System,t_Vehicles.APP_Add_Keys,t_Vehicles.APP_All_Keys_Lost,t_Vehicles.APP_Notes,t_Vehicles.HW_Key_Prog,t_Vehicles.HW_Remote_Prog,t_Vehicles.HW_Misc_Prog,t_Vehicles.TKOSDD_System,t_Vehicles.TKOSDD_SDD_Adapter,t_Vehicles.TKOSDD_SDD_Cable,t_Vehicles.TKOSDD_TKO_Cable,t_Vehicles.TKOSDD_Notes,t_Vehicles.APP_Confirmed_Working,t_Vehicles.DMax_System,t_Vehicles.DMax_Method,t_Vehicles.Parts_Ignition,t_Vehicles.Parts_Door,t_Vehicles.Parts_Accessories,t_Vehicles.Vehicle_Type,t_Vehicles.Tumblers,t_Vehicles.OBD_Location_Text,t_Vehicles.OBD_Location_Image,t_Vehicles.APP_Programs_Remote,t_Vehicles.APP_Resync_Available,t_Vehicles.PIN_Read FROM t_Makes JOIN  t_Models ON t_Makes.UUID = t_Models.Make_UUID JOIN t_Vehicles ON  t_Models.UUID = t_Vehicles.Model_UUID WHERE t_Vehicles.Remote_UUID IN($modal_ids2)  OR t_Vehicles.RHK_UUID IN($modal_ids2) OR t_Vehicles.SmartKey_UUID IN($modal_ids2)  ORDER BY ".$global_sorting." ");
		}else{	
			$query =$this->db->query("SELECT * FROM t_Remotes WHERE Remote_Name LIKE '%$search_key%' OR Products LIKE '%$search_key%' OR FCCID LIKE '%$search_key%'  ");
		}
		return $query->result_array();
	}	
	public function getmakemodelfilter($limit,$limt_start,$modelId, $makeId){
		$makes_id = "";	
		if(isset($_SESSION['global_sorting']) && $_SESSION['global_sorting'] !=""){
			$global_sorting = $_SESSION['global_sorting'];
		}else{
			$global_sorting = "t_Makes.Make_Name, t_Models.Model_Name";
		}
		if($makeId =='All'){
			$query = $this->db->query("SELECT t_Vehicles.gen,t_Vehicles.Parts_Keys,t_Vehicles.Parts_Chips,t_Vehicles.Parts_Batteries,t_Vehicles.gen_notes,t_Vehicles.duplicated,t_Models.Vehicle_Type_UUID,t_Vehicles.image_url,t_Makes.Make_Name,t_Vehicles.UUID,t_Models.Model_Name,t_Vehicles.id,t_Vehicles.Model_UUID,t_Vehicles.Years,t_Vehicles.Code_Series_UUID,t_Vehicles.Retainer_UUID,t_Vehicles.Mechanical_Key_UUID,t_Vehicles.Chip_Key_UUID,t_Vehicles.Remote_UUID,t_Vehicles.RHK_UUID,t_Vehicles.SmartKey_UUID,t_Vehicles.MVP_System,t_Vehicles.MVP_Dongle_UUID,t_Vehicles.MVP_SmartCard,t_Vehicles.MVP_Software,t_Vehicles.MVP_PIN_Required,t_Vehicles.MVP_PIN_Read,t_Vehicles.ProLok_Tool_UUID,t_Vehicles.ProLok_Linkage,t_Vehicles.Vehicle_Image,t_Vehicles.Image_UUID,t_Vehicles.MVP_Notes,t_Vehicles.APP_System,t_Vehicles.APP_Add_Keys,t_Vehicles.APP_All_Keys_Lost,t_Vehicles.APP_Notes,t_Vehicles.HW_Key_Prog,t_Vehicles.HW_Remote_Prog,t_Vehicles.HW_Misc_Prog,t_Vehicles.TKOSDD_System,t_Vehicles.TKOSDD_SDD_Adapter,t_Vehicles.TKOSDD_SDD_Cable,t_Vehicles.TKOSDD_TKO_Cable,t_Vehicles.TKOSDD_Notes,t_Vehicles.APP_Confirmed_Working,t_Vehicles.DMax_System,t_Vehicles.DMax_Method,t_Vehicles.Parts_Ignition,t_Vehicles.Parts_Door,t_Vehicles.Parts_Accessories,t_Vehicles.Vehicle_Type,t_Vehicles.Tumblers,t_Vehicles.OBD_Location_Text,t_Vehicles.OBD_Location_Image,t_Vehicles.APP_Programs_Remote,t_Vehicles.APP_Resync_Available,t_Vehicles.PIN_Read FROM t_Vehicles JOIN t_Models ON t_Models.UUID = t_Vehicles.Model_UUID
		LEFT JOIN t_Makes ON t_Makes.UUID = t_Models.Make_UUID WHERE duplicate_of=0  ORDER BY ".$global_sorting." LIMIT  ".(int)$limt_start.", ".(int)$limit." ");
		}else{
			$query = $this->db->query("SELECT t_Vehicles.gen,t_Vehicles.Parts_Keys,t_Vehicles.Parts_Chips,t_Vehicles.Parts_Batteries,t_Vehicles.gen_notes,t_Vehicles.duplicated,t_Models.Vehicle_Type_UUID,t_Vehicles.image_url,t_Makes.Make_Name,t_Vehicles.UUID,t_Models.Model_Name,t_Vehicles.id,t_Vehicles.Model_UUID,t_Vehicles.Years,t_Vehicles.Code_Series_UUID,t_Vehicles.Retainer_UUID,t_Vehicles.Mechanical_Key_UUID,t_Vehicles.Chip_Key_UUID,t_Vehicles.Remote_UUID,t_Vehicles.RHK_UUID,t_Vehicles.SmartKey_UUID,t_Vehicles.MVP_System,t_Vehicles.MVP_Dongle_UUID,t_Vehicles.MVP_SmartCard,t_Vehicles.MVP_Software,t_Vehicles.MVP_PIN_Required,t_Vehicles.MVP_PIN_Read,t_Vehicles.ProLok_Tool_UUID,t_Vehicles.ProLok_Linkage,t_Vehicles.Vehicle_Image,t_Vehicles.Image_UUID,t_Vehicles.MVP_Notes,t_Vehicles.APP_System,t_Vehicles.APP_Add_Keys,t_Vehicles.APP_All_Keys_Lost,t_Vehicles.APP_Notes,t_Vehicles.HW_Key_Prog,t_Vehicles.HW_Remote_Prog,t_Vehicles.HW_Misc_Prog,t_Vehicles.TKOSDD_System,t_Vehicles.TKOSDD_SDD_Adapter,t_Vehicles.TKOSDD_SDD_Cable,t_Vehicles.TKOSDD_TKO_Cable,t_Vehicles.TKOSDD_Notes,t_Vehicles.APP_Confirmed_Working,t_Vehicles.DMax_System,t_Vehicles.DMax_Method,t_Vehicles.Parts_Ignition,t_Vehicles.Parts_Door,t_Vehicles.Parts_Accessories,t_Vehicles.Vehicle_Type,t_Vehicles.Tumblers,t_Vehicles.OBD_Location_Text,t_Vehicles.OBD_Location_Image,t_Vehicles.APP_Programs_Remote,t_Vehicles.APP_Resync_Available,t_Vehicles.PIN_Read FROM t_Vehicles JOIN t_Models ON t_Models.UUID = t_Vehicles.Model_UUID
		LEFT JOIN t_Makes ON t_Makes.UUID = t_Models.Make_UUID WHERE t_Vehicles.Model_UUID=? AND t_Models.Make_UUID=? AND duplicate_of=?   ORDER BY ".$global_sorting." LIMIT  ".(int)$limt_start.", ".(int)$limit." ", array($modelId, $makeId,0));
		}
		return $query->result_array();
	}
	public function getsearchkey($search_key){
		$makes_id = "";		
		$make_query = $this->db->query("SELECT * FROM t_Chips WHERE Chip_Name LIKE '%$search_key%'");
		$make_query1 = $make_query->result_array();
		
		if($make_query->num_rows() > 0){
			foreach($make_query1 as $makes){
				$makes_id .= "'". $makes['UUID']."',";
			}
			$makes_id2 = rtrim($makes_id,",");
			$query = $this->db->query("SELECT * FROM t_Keys WHERE Chip_UUID IN($makes_id2)");
		}else{	
			$query = $this->db->query("SELECT * FROM t_Keys WHERE Key_Name LIKE '%$search_key%' OR Products LIKE '%$search_key%'  OR Alt_Ilco LIKE '%$search_key%' OR Alt_Axxess LIKE '%$search_key%' OR Alt_Hillman LIKE '%$search_key%' OR Alt_Curtis LIKE '%$search_key%' OR Alt_ESP LIKE '%$search_key%' OR Alt_JMA LIKE '%$search_key%' OR Alt_Jet LIKE '%$search_key%' OR Alt_Strattec LIKE '%$search_key%' OR Alt_Silca LIKE '%$search_key%' OR Alt_Taylor LIKE '%$search_key%' OR Alt_OEM LIKE '%$search_key%' OR Alt_Other LIKE '%$search_key%' ");
		}
		return $query->result_array();
	}
	public function getlockerfilter($typeUuid){			
		$query = $this->db->query("SELECT * FROM t_Keys WHERE lock_type = ? ",array($typeUuid));
		return $query->result_array();
	}
	public function getromtefilter(){
		$query = $this->db->query("SELECT * FROM t_Remotes ORDER BY id DESC ");		
		return $query->result_array();
	}
	public function filterromotebysearchkey($search_key){
		$makes_id = "";		
		$make_query = $this->db->query("SELECT * FROM t_Chips WHERE Chip_Name LIKE '%$search_key%'");
		$make_query1 = $make_query->result_array();
		if($make_query->num_rows() > 0){
			foreach($make_query1 as $makes){
				$makes_id .= "'". $makes['UUID']."',";
			}
			$makes_id2 = rtrim($makes_id,",");
			$query = $this->db->query("SELECT * FROM t_Remotes WHERE Chip_UUID IN($makes_id2)");
		}else{	
			$query = $this->db->query("SELECT * FROM t_Remotes WHERE Remote_Name LIKE '%$search_key%' OR Products LIKE '%$search_key%' OR FCCID LIKE '%$search_key%'  ");
		}
		return $query->result_array();
	}
	public function getremotetypefilter($limt_start, $limit,$sessid){	
		if($sessid == 'all'){ 
			$query = $this->db->query("SELECT * FROM t_Remotes ORDER BY Remote_Name LIMIT  ".(int)$limt_start.", ".(int)$limit."  ");			
		}else{
			$query = $this->db->query("SELECT * FROM t_Remotes WHERE Remote_Type_UUID = ? ",array($sessid));
			
		}
		return $query->result_array();
	}
	public function getCashBackRequest(){
		$query = $this->db->query("SELECT * FROM spring_promotion_cashback ORDER BY id DESC");		
		return $query->result_array();
	}
	public function delete_cashback_request($id){
		$this->db->cache_delete('admpro', 'autopropad');
		$this->db->where('id', $id);
		$this->db->delete('spring_promotion_cashback');
	}	
	public function getCashbackDetail($id){
		$query = $this->db->query("SELECT * FROM spring_promotion_cashback WHERE id=? ", array($id));		
		return $query->result_array();		
	}
	public function update_cashback_request(){
		$this->db->cache_delete('admpro', 'autopropad');
		$id = $this->input->post('Requestid');
		$data = array(
						"first_name" =>$this->input->post('first_name'),
						"last_name" =>$this->input->post('last_name'),				
						"company_name" =>$this->input->post('company_name'),
						"address1" =>$this->input->post('address1'),
						"address2" =>$this->input->post('address2'),
						"city" =>$this->input->post('city'),
						"state" =>$this->input->post('state'),
						"zip_code" =>$this->input->post('zip_code'),						
						"email" =>$this->input->post('email'),						
						"payment_entity"=>$this->input->post('payment_entity'),
						"phone" =>$this->input->post('phone'),
						"checktype" =>$this->input->post('checktype'),
						"serial_number" =>$this->input->post('serial_number'),
						"purchase_date" =>$this->input->post('purchase_date'),
						"distributor_purchased" =>$this->input->post('distributor_purchased'),
						"checktype2" =>$this->input->post('checktype2'),
						"serial_number2" =>$this->input->post('serial_number2'),
						"purchase_date2" =>$this->input->post('purchase_date2'),
						"distributor_purchased2" =>$this->input->post('distributor_purchased2'),
				);
			
			$this->db->where('id', $id);
			$data = $this->security->xss_clean($data);
			$this->db->update('spring_promotion_cashback', $data);
	}

	public function getAllmakesRows($makeId){
		if($makeId =='All'){
			$where = " WHERE 1 ";
		}else{
			$where = "WHERE t_Makes.UUID='".$makeId."'";
		}		
		$query = $this->db->query("SELECT t_Vehicles.PIN_Read FROM t_Vehicles JOIN t_Models ON t_Models.UUID = t_Vehicles.Model_UUID 		LEFT JOIN t_Makes ON t_Makes.UUID = t_Models.Make_UUID ".$where." AND duplicate_of =0 ");
		return $query->num_rows();
	}

	public function vehicle_common_sorting_count($vehicle_type,$makeId,$modelId,$vehicle_type_missing){
		$where = "";
		if($makeId !="" && $makeId !="All" && $modelId !="" && $modelId !="All"){
			$where = "AND t_Makes.UUID='".$makeId."' AND t_Models.Make_UUID='".$modelId."'";
		}else if($makeId !="" && $makeId !="All"){
			$where = "AND t_Makes.UUID='".$makeId."'";
		}
		if($vehicle_type !="" && $vehicle_type !="All"){
			$where .= " AND t_Models.Vehicle_Type_UUID='".$vehicle_type."'";
		}
		$query = $this->db->query("SELECT t_Models.Vehicle_Type_UUID FROM t_Makes JOIN  t_Models ON t_Makes.UUID = t_Models.Make_UUID JOIN t_Vehicles ON  t_Models.UUID = t_Vehicles.Model_UUID WHERE 1 ".$where." ");	
		return $query->num_rows();
	}
	public function vehicle_common_sorting($limit,$limt_start,$vehicle_type,$makeId,$modelId,$vehicle_type_missing){		
		$sort = $this->input->post('sorting');
		$sorting_by = $this->input->post('sorting_by');
		$where = "";
		if($makeId !="" && $makeId !="All" && $modelId !="" && $modelId !="All"){
			$where = "AND t_Makes.UUID='".$makeId."' AND t_Models.UUID='".$modelId."'";
		}else if($makeId !="" && $makeId !="All"){
			$where = "AND t_Makes.UUID='".$makeId."'";
		}
		if($vehicle_type !="" && $vehicle_type !="All"){
			$where .= " AND t_Models.Vehicle_Type_UUID='".$vehicle_type."'";
		}		
		if(isset($_SESSION['global_sorting']) && $_SESSION['global_sorting'] !=""){
			$global_sorting = $_SESSION['global_sorting'];
		}else{
			$global_sorting = "t_Makes.Make_Name, t_Models.Model_Name";
		}
		$query = $this->db->query("SELECT t_Vehicles.gen,t_Vehicles.Parts_Keys,t_Vehicles.Parts_Chips,t_Vehicles.Parts_Batteries,t_Vehicles.gen_notes,t_Models.Vehicle_Type_UUID,t_Vehicles.image_url,t_Makes.Make_Name,t_Vehicles.UUID,t_Models.Model_Name,t_Vehicles.id,t_Vehicles.Model_UUID,t_Vehicles.Years,t_Vehicles.Code_Series_UUID,t_Vehicles.Retainer_UUID,t_Vehicles.Mechanical_Key_UUID,t_Vehicles.Chip_Key_UUID,t_Vehicles.Remote_UUID,t_Vehicles.RHK_UUID,t_Vehicles.SmartKey_UUID,t_Vehicles.MVP_System,t_Vehicles.MVP_Dongle_UUID,t_Vehicles.MVP_SmartCard,t_Vehicles.MVP_Software,t_Vehicles.MVP_PIN_Required,t_Vehicles.MVP_PIN_Read,t_Vehicles.ProLok_Tool_UUID,t_Vehicles.ProLok_Linkage,t_Vehicles.Vehicle_Image,t_Vehicles.Image_UUID,t_Vehicles.MVP_Notes,t_Vehicles.APP_System,t_Vehicles.APP_Add_Keys,t_Vehicles.APP_All_Keys_Lost,t_Vehicles.APP_Notes,t_Vehicles.HW_Key_Prog,t_Vehicles.HW_Remote_Prog,t_Vehicles.HW_Misc_Prog,t_Vehicles.TKOSDD_System,t_Vehicles.TKOSDD_SDD_Adapter,t_Vehicles.TKOSDD_SDD_Cable,t_Vehicles.TKOSDD_TKO_Cable,t_Vehicles.TKOSDD_Notes,t_Vehicles.APP_Confirmed_Working,t_Vehicles.DMax_System,t_Vehicles.DMax_Method,t_Vehicles.Parts_Ignition,t_Vehicles.Parts_Door,t_Vehicles.Parts_Accessories,t_Vehicles.Vehicle_Type,t_Vehicles.Tumblers,t_Vehicles.OBD_Location_Text,t_Vehicles.OBD_Location_Image,t_Vehicles.APP_Programs_Remote,t_Vehicles.APP_Resync_Available,t_Vehicles.PIN_Read FROM t_Makes JOIN  t_Models ON t_Makes.UUID = t_Models.Make_UUID JOIN t_Vehicles ON  t_Models.UUID = t_Vehicles.Model_UUID WHERE 1 ".$where." ORDER BY ".$global_sorting." LIMIT  ".(int)$limt_start.", ".(int)$limit."");	
		return $query->result_array();
	}

	public function delete_product_to_machine_purchase($id){
		$this->db->cache_delete('admpro', 'purchase_history');
		$this->db->where('id', $id);
		$this->db->delete('purchases_machine');
	}
	public function save_product_to_machine_purchase(){
		$this->db->cache_delete('admpro', 'purchase_history');
		$data = array(
			'machine' => $this->input->post('purchases_machine')
		);
		$data = $this->security->xss_clean($data);
		$this->db->insert('purchases_machine', $data);
	}

	public function update_users_feedbacks(){
		$this->db->cache_delete('admpro', 'user_submissions');
		$this->db->cache_delete('admpro', 'users_feedbacks');
		$id = $this->input->post('id');
		$status = $this->input->post('status');
		$data = array(					
			'status' => $this->input->post('status')
		);
		$this->db->where('id', $id);
		$data = $this->security->xss_clean($data);
		$update = $this->db->update('t_Feedback', $data);
		if($update){
			return 'Success';
		}
	}

	public function search_batteries(){
		$search_key = trim($this->input->post('search_global_key'));	
		$query = $this->db->query("SELECT * FROM t_Batteries WHERE Battery_Name LIKE '%".$search_key."%' OR Products LIKE '%".$search_key."%'");
		return $query->result_array();
	}
	public function search_locks(){
		$search_key = trim($this->input->post('search_global_key'));	
		$query = $this->db->query("SELECT * FROM t_Locks WHERE Part_Name LIKE '%".$search_key."%' OR Products LIKE '%".$search_key."%'");
		return $query->result_array();
	}
	public function search_machines_info(){
		$search_key = trim($this->input->post('search_global_key'));	
		$query = $this->db->query("SELECT * FROM t_Machines_Info WHERE Name LIKE '%".$search_key."%' OR Products LIKE '%".$search_key."%'");
		return $query->result_array();
	}
	public function search_chips(){
		$search_key = trim($this->input->post('search_global_key'));	
		$query = $this->db->query("SELECT * FROM t_Chips WHERE Chip_Name LIKE '%".$search_key."%' OR Products LIKE '%".$search_key."%' OR Cloning_type LIKE '%".$search_key."%'");
		return $query->result_array();
	}
	

/*----------------------------------Tool > software -----------------------------*/
	public function get_software_rows(){
		return $this->db->count_all("t_Tools_Software");
	}
	public function get_software($limit,$limt_start){
		$query = $this->db->query("SELECT * FROM t_Tools_Software ORDER BY id LIMIT  ".(int)$limt_start.", ".(int)$limit." ");
		return $query->result_array();
	}
	public function save_software($file_name){
		$this->db->cache_delete('admpro', 'software');
		$parts_vehicle_uuids = "";
		$parts_vehicle = $this->input->post('parts_vehicle');
		if(isset($parts_vehicle)){
			foreach($parts_vehicle as $vehicle_uid){
				$parts_vehicle_uuids .= $vehicle_uid.',';
			}
		}
		$parts_vehicle_uuids2 = rtrim($parts_vehicle_uuids,",");
		$Order_Date = date('Y-m-d', strtotime($this->input->post('Order_Date')));
		$data = array(						
			'type' => $this->input->post('type'),
			'name' => $this->input->post('name'),
			'vehicles' => $parts_vehicle_uuids2,
			'image' => $file_name,
			'part' => $this->input->post('part'),
			'products' => $this->input->post('products')
		);
		$data = $this->security->xss_clean($data);
		$this->db->insert('t_Tools_Software', $data);
	}
	public function update_software($file_name){
		$this->db->cache_delete('admpro', 'software');
		$id = $this->input->post('id');
		$parts_vehicle_uuids = "";
		$parts_vehicle = $this->input->post('parts_vehicle');
		if(isset($parts_vehicle)){
			foreach($parts_vehicle as $vehicle_uid){
				$parts_vehicle_uuids .= $vehicle_uid.',';
			}
		}
		$parts_vehicle_uuids2 = rtrim($parts_vehicle_uuids,",");
		if($file_name == ""){
			$data = array(						
				'type' => $this->input->post('type'),
				'name' => $this->input->post('name'),
				'vehicles' => $parts_vehicle_uuids2,
				'part' => $this->input->post('part'),
				'products' => $this->input->post('products')
			);
		}else{
			$data = array(						
				'type' => $this->input->post('type'),
				'name' => $this->input->post('name'),
				'vehicles' => $parts_vehicle_uuids2,
				'image' => $file_name,
				'part' => $this->input->post('part'),
				'products' => $this->input->post('products')
			);
		}
		
		$this->db->where('id', $id);
		$data = $this->security->xss_clean($data);
		$this->db->update('t_Tools_Software', $data);
	}
	public function software_info($id){
		$query = $this->db->query("SELECT * FROM t_Tools_Software WHERE id=? ",array($id));
		return $query->result_array();
	}
	public function delete_software($id){
		$this->db->cache_delete('admpro', 'software');
		$this->db->where('id', $id);
		$this->db->delete('t_Tools_Software');
	}
	public function search_software(){
		$search_key = trim($this->input->post('search_global_key'));	
		$query = $this->db->query("SELECT * FROM t_Tools_Software WHERE name LIKE '%".$search_key."%' OR products LIKE '%".$search_key."%' OR type LIKE '%".$search_key."%'");
		return $query->result_array();
	}
/*----------------------------------Tool > accessories -----------------------------*/
	public function get_accessories_rows(){
		return $this->db->count_all("t_Tools_accessories");
	}
	public function get_accessories($limit,$limt_start){
		$query = $this->db->query("SELECT * FROM t_Tools_accessories ORDER BY id LIMIT  ".(int)$limt_start.", ".(int)$limit." ");
		return $query->result_array();
	}
	public function save_accessories($file_name){
		$this->db->cache_delete('admpro', 'accessories');
		$parts_vehicle_uuids = "";
		$parts_vehicle = $this->input->post('parts_vehicle');
		if(isset($parts_vehicle)){
			foreach($parts_vehicle as $vehicle_uid){
				$parts_vehicle_uuids .= $vehicle_uid.',';
			}
		}
		$parts_vehicle_uuids2 = rtrim($parts_vehicle_uuids,",");
		$Order_Date = date('Y-m-d', strtotime($this->input->post('Order_Date')));
		$data = array(						
			'type' => $this->input->post('type'),
			'name' => $this->input->post('name'),
			'vehicles' => $parts_vehicle_uuids2,
			'image' => $file_name,
			'part' => $this->input->post('part'),
			'products' => $this->input->post('products')
		);
		$data = $this->security->xss_clean($data);
		$this->db->insert('t_Tools_accessories', $data);
	}
	public function update_accessories($file_name){
		$this->db->cache_delete('admpro', 'accessories');
		$id = $this->input->post('id');
		$parts_vehicle_uuids = "";
		$parts_vehicle = $this->input->post('parts_vehicle');
		if(isset($parts_vehicle)){
			foreach($parts_vehicle as $vehicle_uid){
				$parts_vehicle_uuids .= $vehicle_uid.',';
			}
		}
		$parts_vehicle_uuids2 = rtrim($parts_vehicle_uuids,",");
		if($file_name == ""){
			$data = array(						
				'type' => $this->input->post('type'),
				'name' => $this->input->post('name'),
				'vehicles' => $parts_vehicle_uuids2,
				'part' => $this->input->post('part'),
				'products' => $this->input->post('products')
			);
		}else{
			$data = array(						
				'type' => $this->input->post('type'),
				'name' => $this->input->post('name'),
				'vehicles' => $parts_vehicle_uuids2,
				'image' => $file_name,
				'part' => $this->input->post('part'),
				'products' => $this->input->post('products')
			);
		}
		
		$this->db->where('id', $id);
		$data = $this->security->xss_clean($data);
		$this->db->update('t_Tools_accessories', $data);
	}
	public function accessories_info($id){
		$query = $this->db->query("SELECT * FROM t_Tools_accessories WHERE id=? ",array($id));
		return $query->result_array();
	}
	public function delete_accessories($id){
		$this->db->cache_delete('admpro', 'accessories');
		$this->db->where('id', $id);
		$this->db->delete('t_Tools_accessories');
	}
	public function search_accessories(){
		$search_key = trim($this->input->post('search_global_key'));	
		$query = $this->db->query("SELECT * FROM t_Tools_accessories WHERE name LIKE '%".$search_key."%' OR products LIKE '%".$search_key."%' OR type LIKE '%".$search_key."%'");
		return $query->result_array();
	}
		
/*--------------------------------------- Software Type------------------------------------*/	
	public function getAllSoftwareType(){
		$query = $this->db->select("*")->order_by('Software_Type_Name', 'asc')->get('t_Software_Types');
		return $query->result_array();
	}
	public function getAllSoftwareTypeRows(){
		return $this->db->count_all("t_Software_Types");	
	}
	public function getAllSoftwareTypeDetail($limit,$limt_start){
		$query = $this->db->select("*")->order_by('Software_Type_Name', 'asc')->limit($limit,$limt_start)->get('t_Software_Types');
		return $query->result_array();
	}
	public function Add_SoftwareType(){
		$this->db->cache_delete('admpro', 'software_type');
		$data = array(
			'Software_Type_Name' => $this->input->post('Software_Type_Name'),
			'UUID' => md5(uniqid(mt_rand(), true))
		);
		$data = $this->security->xss_clean($data);		
		$this->db->insert('t_Software_Types', $data);
		return true;		
	}
	public function getSoftwareTypeInfo($id){
		$query = $this->db->select("*")->where('id', (int)$id)->get('t_Software_Types');
		return $query->result_array();
	}
	public function update_Software_type(){
		$this->db->cache_delete('admpro', 'software_type');
		$SoftwareTypeId = $this->input->post('softwareTypeId');
		$data = array(
				'Software_Type_Name' => $this->input->post('Software_Type_Name')				
		);
		$this->db->where('id',$SoftwareTypeId);
		$data = $this->security->xss_clean($data);
		$this->db->update('t_Software_Types', $data);
	}
	public function deletesoftwaretype($id){
		$this->db->cache_delete('admpro', 'software_type');
		$this->db->where('id', $id);
		$this->db->delete('t_Software_Types');
	}
	
/*--------------------------------------- Accessories Type------------------------------------*/	
	public function getAllaccessoriesType(){
		$query = $this->db->select("*")->order_by('accessories_Type_Name', 'asc')->get('t_accessories_Types');
		return $query->result_array();
	}
	public function getAllaccessoriesTypeRows(){
		return $this->db->count_all("t_accessories_Types");	
	}
	public function getAllaccessoriesTypeDetail($limit,$limt_start){
		$query = $this->db->select("*")->order_by('accessories_Type_Name', 'asc')->limit($limit,$limt_start)->get('t_accessories_Types');
		return $query->result_array();
	}
	public function Add_accessoriesType(){
		$this->db->cache_delete('admpro', 'accessories_type');
		$data = array(
			'accessories_Type_Name' => $this->input->post('accessories_Type_Name'),
			'UUID' => md5(uniqid(mt_rand(), true))
		);
		$data = $this->security->xss_clean($data);		
		$this->db->insert('t_accessories_Types', $data);
		return true;		
	}
	public function getaccessoriesTypeInfo($id){
		$query = $this->db->select("*")->where('id', (int)$id)->get('t_accessories_Types');
		return $query->result_array();
	}
	public function update_accessories_type(){
		$this->db->cache_delete('admpro', 'accessories_type');
		$accessoriesTypeId = $this->input->post('accessoriesTypeId');
		$data = array(
				'accessories_Type_Name' => $this->input->post('accessories_Type_Name')				
		);
		$this->db->where('id',$accessoriesTypeId);
		$data = $this->security->xss_clean($data);
		$this->db->update('t_accessories_Types', $data);
	}
	public function deleteaccessoriestype($id){
		$this->db->cache_delete('admpro', 'accessories_type');
		$this->db->where('id', $id);
		$this->db->delete('t_accessories_Types');
	}
	
	public function export_all_vehicle_info(){
		$global_sorting = "t_Makes.Make_Name, t_Models.Model_Name";
		$query = $this->db->query("SELECT t_Vehicles.gen,t_Vehicles.Parts_Keys,t_Vehicles.Parts_Chips,t_Vehicles.Parts_Batteries,t_Vehicles.gen_notes,t_Makes.Make_Name,t_Models.Vehicle_Type_UUID,t_Vehicles.image_url,t_Vehicles.UUID,t_Models.Model_Name,t_Vehicles.id,t_Vehicles.Model_UUID,t_Vehicles.Years,t_Vehicles.Code_Series_UUID,t_Vehicles.Retainer_UUID,t_Vehicles.Mechanical_Key_UUID,t_Vehicles.Chip_Key_UUID,t_Vehicles.Remote_UUID,t_Vehicles.RHK_UUID,t_Vehicles.SmartKey_UUID,t_Vehicles.MVP_System,t_Vehicles.MVP_Dongle_UUID,t_Vehicles.MVP_SmartCard,t_Vehicles.MVP_Software,t_Vehicles.MVP_PIN_Required,t_Vehicles.MVP_PIN_Read,t_Vehicles.ProLok_Tool_UUID,t_Vehicles.ProLok_Linkage,t_Vehicles.Vehicle_Image,t_Vehicles.Image_UUID,t_Vehicles.MVP_Notes,t_Vehicles.APP_System,t_Vehicles.APP_Add_Keys,t_Vehicles.APP_All_Keys_Lost,t_Vehicles.APP_Notes,t_Vehicles.HW_Key_Prog,t_Vehicles.HW_Remote_Prog,t_Vehicles.HW_Misc_Prog,t_Vehicles.TKOSDD_System,t_Vehicles.TKOSDD_SDD_Adapter,t_Vehicles.TKOSDD_SDD_Cable,t_Vehicles.TKOSDD_TKO_Cable,t_Vehicles.TKOSDD_Notes,t_Vehicles.APP_Confirmed_Working,t_Vehicles.DMax_System,t_Vehicles.DMax_Method,t_Vehicles.Parts_Ignition,t_Vehicles.Parts_Door,t_Vehicles.Parts_Accessories,t_Vehicles.Vehicle_Type,t_Vehicles.Tumblers,t_Vehicles.OBD_Location_Text,t_Vehicles.OBD_Location_Image,t_Vehicles.APP_Programs_Remote,t_Vehicles.APP_Resync_Available,t_Vehicles.PIN_Read FROM t_Vehicles JOIN t_Models ON t_Models.UUID = t_Vehicles.Model_UUID
		LEFT JOIN t_Makes ON t_Makes.UUID = t_Models.Make_UUID ORDER BY ".$global_sorting." ");
		return $query->result_array();
	}

	public function export_all_Keys_info(){
		$query = $this->db->select("*")->order_by('Key_Name' ,'asc')->get('t_Keys');
		return $query->result_array();
	}

	public function export_all_remotes_info(){
		$query = $this->db->select("*")->order_by('Remote_Name' ,'asc')->get('t_Remotes');
		return $query->result_array();
	}
	public function import_remotes() {
	  $file_data = $this->csvimport->get_array($_FILES["csv_file"]["tmp_name"]);		
	  $this->db->cache_delete('admpro', 'remotes');	 
	  $count = 0;
	  foreach($file_data as $value){			  
			$fccid = "";
			$ic ="";
			$ContinentalId="";
			if(isset($value['FCC/IC/Continental IDs'])){
				$fccid_IC_Continental =  explode('/',$value['FCC/IC/Continental IDs']);
				$fccid = $fccid_IC_Continental[0];
				$ic = $fccid_IC_Continental[1];
				$ContinentalId = $fccid_IC_Continental[2];			
			}				
			$OEM_Part_Number ="";
			if($value['OEM Part Number'] !=""){			
				$OEM_Part_Number = ",OEM_Part_Number='".$value['OEM Part Number']."'";
			}
			$fccid2 ="";			
			if($fccid !=""){
				$fccid2 = ",FCCID='".$fccid."' ";
			}
			$ic2 ="";			
			if($ic !=""){
				$ic2 = ",IC='".$ic."' ";
			}			
			$ContinentalId2 ="";			
			if($ContinentalId !=""){
				$ContinentalId2 = ",Continental_ID='".$ContinentalId."' ";
			}
			$Remote_Name ="";
			if($value['Name'] !=""){			
				$Remote_Name = ",Remote_Name='".$value['Name']."'";
			}			
			$query.$count = "UPDATE t_Remotes SET 			
								Products='".$value['Products']."' 
								".$OEM_Part_Number."
								".$fccid2."
								".$ic2."
								".$ContinentalId2."	
								".$Remote_Name."
								WHERE id='".$value['ID']."'";	
				$this->db->query($query.$count);						
				$count++;	
		  }		
	  }
	  public function import_key_to_database() {
		  $file_data = $this->csvimport->get_array($_FILES["key_csv_file"]["tmp_name"]);
		  $data =  array();			
		  $this->db->cache_delete('admpro', 'keys');
		  $this->db->cache_delete('admpro', 'edit_key');
		  $count = 0;		  
		  foreach($file_data as $value){
				$id =  $value['ID'];
				$Alt_Ilco="";
				if($value['Ilco'] !=""){					
					$Alt_Ilco = ",Alt_Ilco='".trim($value['Ilco'])."' ";
				}
				$Alt_Axxess="";
				if($value['Axxess'] !=""){				
					$Alt_Axxess = ",Alt_Axxess='".trim($value['Axxess'])."' ";
				}
				$Alt_Curtis="";
				if($value['Curtis'] !=""){				
					$Alt_Curtis = ",Alt_Curtis='".trim($value['Curtis'])."' ";
				}				
				$Alt_ESP="";
				if($value['ESP'] !=""){				
					$Alt_ESP = ",Alt_ESP='".trim($value['ESP'])."' ";
				}
				$Alt_Hillman="";
				if($value['Hillman'] !=""){				
					$Alt_Hillman = ",Alt_Hillman='".trim($value['Hillman'])."' ";
				}					
				$Alt_Jet="";
				if($value['Jet'] !=""){				
					$Alt_Jet = ",Alt_Jet='".trim($value['Jet'])."' ";
				}
				$Alt_JMA="";
				if($value['JMA'] !=""){				
					$Alt_JMA = ",Alt_JMA='".trim($value['JMA'])."' ";
				}
				$Alt_Silca="";
				if($value['Silca'] !=""){				
					$Alt_Silca = ",Alt_Silca ='".trim($value['Silca'])."' ";
				}				
				$Alt_Taylor="";
				if($value['Taylor'] !=""){				
					$Alt_Taylor = ",Alt_Taylor='".trim($value['Taylor'])."' ";
				}
				$Alt_Strattec="";
				if($value['Strattec'] !=""){				
					$Alt_Strattec = ",Alt_Strattec='".trim($value['Strattec'])."' ";
				}
				$Alt_OEM="";
				if($value['OEM'] !=""){				
					$Alt_OEM = ",Alt_OEM='".trim($value['OEM'])."' ";
				}
				$Alt_Other="";
				if($value['Other'] !=""){				
					$Alt_Other = ",Alt_Other='".trim($value['Other'])."' ";
				}					
				$slock_type_vals = "";
				$lock_type="";
				if($value['Lock Type'] !=""){
					$lock_types = explode(',',$value['Lock Type']);
					foreach( $lock_types as $lock_type){
						$slock_type_vals .= $lock_type.',';
					}
					$slock_type_vals2 = rtrim($slock_type_vals,",");						
					$lock_type = ",lock_type='".trim($slock_type_vals2)."' ";				
				}
				$key_name ="";
				if($value['Name'] !=""){
					$key_name = ",Key_Name='".trim($value['Name'])."' ";
				}				
				$query.$count = "UPDATE t_Keys SET 
								Products='".$value['Products']."' 
								".$key_name." 
								".$Alt_Ilco." 
								".$Alt_Axxess."
								".$Alt_Curtis."
								".$Alt_ESP."
								".$Alt_Hillman."
								".$Alt_Jet."
								".$Alt_JMA."
								".$Alt_Silca."
								".$Alt_Taylor."
								".$Alt_Strattec."
								".$Alt_OEM."
								" .$Alt_Other."
								" .$lock_type."
								WHERE id='".$value['ID']."'";	
				$this->db->query($query.$count);						
				$count++;				
		  }
	}

	public function getAllVehiclesDataForCsvReport(){
		$global_sorting = "t_Makes.Make_Name, t_Models.Model_Name";
		$query = $this->db->query("SELECT t_Vehicles.id as VID, t_Makes.Make_Name,t_Models.Model_Name,t_Vehicles.Years,t_Vehicles.Mechanical_Key_UUID,t_Vehicles.Chip_Key_UUID  FROM t_Vehicles JOIN t_Models ON t_Models.UUID = t_Vehicles.Model_UUID
		LEFT JOIN t_Makes ON t_Makes.UUID = t_Models.Make_UUID WHERE duplicate_of=0 ORDER BY ".$global_sorting." ");
		return $query->result_array();
	}
	public function export_all_tools_info(){
		$query = $this->db->select("*")->order_by('Tool_Name' ,'asc')->get('t_Tools');
		return $query->result_array();
	}
	public function export_all_codeseries_info(){
		$query = $this->db->select("*")->order_by('Code_Series_Name' ,'asc')->get('t_Code_Series');
		return $query->result_array();
	}


	public function quick_updates_vehicles_data(){
		$modelId = $this->input->post('Model_UUID');
		if($modelId!=""){
			$query = $this->db->query("SELECT t_Vehicles.UUID as Vehicle_UUID,t_Vehicles.gen,t_Vehicles.Parts_Keys,t_Vehicles.Parts_Chips,t_Vehicles.Parts_Batteries,t_Vehicles.gen_notes,t_Models.Vehicle_Type_UUID,t_Vehicles.image_url,t_Makes.Make_Name,t_Vehicles.UUID,t_Models.Model_Name,t_Vehicles.id,t_Vehicles.Model_UUID,t_Vehicles.Years,t_Vehicles.Code_Series_UUID,t_Vehicles.Retainer_UUID,t_Vehicles.Mechanical_Key_UUID,t_Vehicles.Chip_Key_UUID,t_Vehicles.Remote_UUID,t_Vehicles.RHK_UUID,t_Vehicles.SmartKey_UUID,t_Vehicles.MVP_System,t_Vehicles.MVP_Dongle_UUID,t_Vehicles.MVP_SmartCard,t_Vehicles.MVP_Software,t_Vehicles.MVP_PIN_Required,t_Vehicles.MVP_PIN_Read,t_Vehicles.ProLok_Tool_UUID,t_Vehicles.ProLok_Linkage,t_Vehicles.Vehicle_Image,t_Vehicles.Image_UUID,t_Vehicles.MVP_Notes,t_Vehicles.APP_System,t_Vehicles.APP_Add_Keys,t_Vehicles.APP_All_Keys_Lost,t_Vehicles.APP_Notes,t_Vehicles.HW_Key_Prog,t_Vehicles.HW_Remote_Prog,t_Vehicles.HW_Misc_Prog,t_Vehicles.TKOSDD_System,t_Vehicles.TKOSDD_SDD_Adapter,t_Vehicles.TKOSDD_SDD_Cable,t_Vehicles.TKOSDD_TKO_Cable,t_Vehicles.TKOSDD_Notes,t_Vehicles.APP_Confirmed_Working,t_Vehicles.DMax_System,t_Vehicles.DMax_Method,t_Vehicles.Parts_Ignition,t_Vehicles.Parts_Door,t_Vehicles.Parts_Accessories,t_Vehicles.Vehicle_Type,t_Vehicles.Tumblers,t_Vehicles.OBD_Location_Text,t_Vehicles.OBD_Location_Image,t_Vehicles.APP_Programs_Remote,t_Vehicles.APP_Resync_Available,t_Vehicles.PIN_Read FROM t_Vehicles JOIN t_Models ON t_Models.UUID = t_Vehicles.Model_UUID
			LEFT JOIN t_Makes ON t_Makes.UUID = t_Models.Make_UUID WHERE t_Models.UUID=? ORDER BY t_Makes.Make_Name ".$sort."  ",array($modelId));		
			return $query->result_array();
		}		
	}


	public function getVehiclesProducts($limt_start){
        $limt_start = $limt_start * 500;
        $query = $this->db->query("SELECT t_Vehicles.id,t_Makes.Make_Name,t_Models.Model_Name,t_Vehicles.Years FROM t_Makes JOIN  t_Models ON t_Makes.UUID = t_Models.Make_UUID JOIN t_Vehicles ON  t_Models.UUID = t_Vehicles.Model_UUID   ORDER BY t_Makes.Make_Name,t_Models.Model_Name LIMIT  ".(int)$limt_start.", 500");
		return $query->result_array();
    }

	public function getVehiclesProducts2($id){
        $sorting = 'default';   
        $product_sorting = array('name-ascending'=>'pd.products_name-asc','name-descending'=>'pd.products_name-DESC','price-ascending'=>'p.products_price-asc','price-descending'=>'p.products_price-desc','created-ascending'=>'p.products_id-asc','created-descending'=>'p.products_id-desc','default'=>'pd.products_name-asc');
        if(isset($product_sorting[$sorting])){
            $order_by = str_replace('-',' ',$product_sorting[$sorting]);
        }else{
            $order_by = str_replace('-',' ',$product_sorting['default']);
        }
        // $sql = "SELECT 
		// 	t_Makes.Make_Name,t_Models.Model_Name,
        //     GROUP_CONCAT(DISTINCT k.Products) AS Mechanical_Key_Products,
        //     GROUP_CONCAT(DISTINCT rb.Products) AS Replacement_Blade_Products,
        //     GROUP_CONCAT(DISTINCT ck.Products) AS Chip_Key_Products,
        //     GROUP_CONCAT(DISTINCT ks.Products) AS Key_Shell_Products,
        //     GROUP_CONCAT(DISTINCT tc.Products) AS Transponder_Chip_Products,
        //     GROUP_CONCAT(DISTINCT cc.Products) AS Cloning_Chip_Products,
        //     GROUP_CONCAT(DISTINCT r.Products) AS Remote_Products,
        //     GROUP_CONCAT(DISTINCT rs.Products) AS Remote_Shell_Products,
        //     GROUP_CONCAT(DISTINCT b.Products) AS Battery_Products,
        //     GROUP_CONCAT(DISTINCT ek.Products) AS Emergency_Key_Products
        // FROM t_Vehicles vh
        // LEFT JOIN t_Keys k ON FIND_IN_SET(k.UUID, vh.Mechanical_Key_UUID)
        // LEFT JOIN t_Keys rb ON FIND_IN_SET(rb.UUID, k.Replacement_blade)
        // LEFT JOIN t_Keys ck ON FIND_IN_SET(ck.UUID, vh.Chip_Key_UUID)
        // LEFT JOIN t_Keys ks ON FIND_IN_SET(ks.UUID, ck.Key_Shell_UUID)
        // LEFT JOIN t_Chips tc ON tc.UUID = ck.Chip_UUID
        // LEFT JOIN t_Chips cc ON FIND_IN_SET(cc.UUID, tc.Clone_With)
        // LEFT JOIN t_Remotes r ON FIND_IN_SET(vh.UUID, r.Vehicles_UUID)
        // LEFT JOIN t_Remotes rs ON FIND_IN_SET(rs.UUID, r.Shell_UUID)
        // LEFT JOIN t_Remotes b ON FIND_IN_SET(b.UUID, r.Battery_UUID)
        // LEFT JOIN t_Keys ek ON FIND_IN_SET(ek.UUID, r.Emergency_Key_UUID)
		// JOIN t_Models ON t_Models.UUID = vh.Model_UUID 
		// LEFT JOIN t_Makes ON t_Makes.UUID = t_Models.Make_UUID
        // WHERE vh.id = ".$id;

		$sql = "SELECT 
        t_Makes.Make_Name,
        t_Models.Model_Name,
        vh.Years,
        GROUP_CONCAT(DISTINCT k.Products) AS Mechanical_Key_Products,
        GROUP_CONCAT(DISTINCT rb.Products) AS Replacement_Blade_Products,
        GROUP_CONCAT(DISTINCT ck.Products) AS Chip_Key_Products,
        GROUP_CONCAT(DISTINCT ks.Products) AS Key_Shell_Products,
        GROUP_CONCAT(DISTINCT tc.Products) AS Transponder_Chip_Products,
        GROUP_CONCAT(DISTINCT cc.Products) AS Cloning_Chip_Products,
        GROUP_CONCAT(DISTINCT r.Products) AS Remote_Products,
        GROUP_CONCAT(DISTINCT rs.Products) AS Remote_Shell_Products,
        GROUP_CONCAT(DISTINCT b.Products) AS Battery_Products,
        GROUP_CONCAT(DISTINCT ek.Products) AS Emergency_Key_Products,
        GROUP_CONCAT(DISTINCT r_head.Products) AS Remote_Head_Key_Products,
        GROUP_CONCAT(DISTINCT r_shell.Products) AS Remote_Head_Shell_Products,
        GROUP_CONCAT(DISTINCT smk.Products) AS Smart_Key_Products,
        GROUP_CONCAT(DISTINCT smk_shell.Products) AS Smart_Key_Shell_Products,
        GROUP_CONCAT(DISTINCT ign.Products) AS Ignition_Products,
        GROUP_CONCAT(DISTINCT dl.Products) AS Door_Lock_Products,
        GROUP_CONCAT(DISTINCT la.Products) AS Lock_Accessory_Products,
        GROUP_CONCAT(DISTINCT lck.Products) AS Lock_Products,
        GROUP_CONCAT(DISTINCT t.Products) AS Tool_Products,
        GROUP_CONCAT(DISTINCT ts.Products) AS Software_Products,
		GROUP_CONCAT(DISTINCT ta.Products) AS Tool_Accessories_Products
		FROM t_Vehicles vh
		LEFT JOIN t_Keys k ON FIND_IN_SET(k.UUID, vh.Mechanical_Key_UUID)
		LEFT JOIN t_Keys rb ON FIND_IN_SET(rb.UUID, k.Replacement_blade)
		LEFT JOIN t_Keys ck ON FIND_IN_SET(ck.UUID, vh.Chip_Key_UUID)
		LEFT JOIN t_Keys ks ON FIND_IN_SET(ks.UUID, ck.Key_Shell_UUID)
		LEFT JOIN t_Chips tc ON tc.UUID = ck.Chip_UUID
		LEFT JOIN t_Chips cc ON FIND_IN_SET(cc.UUID, tc.Clone_With)
		LEFT JOIN t_Remotes r ON FIND_IN_SET(vh.UUID, r.Vehicles_UUID)
		LEFT JOIN t_Remotes rs ON FIND_IN_SET(rs.UUID, r.Shell_UUID)
		LEFT JOIN t_Remotes b ON FIND_IN_SET(b.UUID, r.Battery_UUID)
		LEFT JOIN t_Keys ek ON FIND_IN_SET(ek.UUID, r.Emergency_Key_UUID)
		LEFT JOIN t_Remotes r_head ON FIND_IN_SET(r_head.UUID, vh.RHK_UUID)
		LEFT JOIN t_Remotes r_shell ON FIND_IN_SET(r_shell.UUID, r_head.Shell_UUID)
		LEFT JOIN t_Remotes smk ON FIND_IN_SET(smk.UUID, vh.SmartKey_UUID)
		LEFT JOIN t_Remotes smk_shell ON FIND_IN_SET(smk_shell.UUID, smk.Shell_UUID)
		LEFT JOIN t_Locks ign ON FIND_IN_SET(ign.UUID, vh.Parts_Ignition)
		LEFT JOIN t_Locks dl ON FIND_IN_SET(dl.UUID, vh.Parts_Door)
		LEFT JOIN t_Locks la ON FIND_IN_SET(la.UUID, vh.Parts_Accessories)
		LEFT JOIN t_Locks lck ON FIND_IN_SET(lck.UUID, vh.UUID)
		LEFT JOIN t_Code_Series cs ON FIND_IN_SET(cs.UUID, vh.Code_Series_UUID)
		LEFT JOIN t_Tools t ON t.UUID = cs.Lishi_UUID
		LEFT JOIN t_Tools ts ON ts.UUID = cs.`Accu-Reader_UUID`
		LEFT JOIN t_Tools ta ON ta.UUID = cs.`EEZ-Reader_UUID`
		LEFT JOIN t_Tools_Software tsf ON FIND_IN_SET(tsf.vehicles, vh.UUID)
		LEFT JOIN t_Tools_accessories ta1 ON FIND_IN_SET(ta1.vehicles, vh.UUID)
		JOIN t_Models ON t_Models.UUID = vh.Model_UUID
		LEFT JOIN t_Makes ON t_Makes.UUID = t_Models.Make_UUID
		WHERE vh.id = ".$id;
		$result = $this->db->query($sql);

		return $vh_value = $result->row_array();
    }
	
}				
?>