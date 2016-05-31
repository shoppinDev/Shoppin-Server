<?php
	class Role extends CI_Controller {
	private $_data = array();
	function __construct()
	{
		parent::__construct();
		if($this->session->userdata('adminId') == ''){
			redirect($this->config->item('base_url'));
        }
		$this->load->model('role_model');
	}
	function add()
	{
		//$L_strErrorMessage='';
		$form_field = $data = array(  
			
				'role_name' => '',
				'module_id'=>''
			);
		if($this->input->post('action') == 'add_role') 
		{
			foreach($form_field as $key => $value)
			{	
				$data[$key]=$this->input->post($key);	
				
			}
			$this->load->library('validation');
			$rules['role_name'] = "trim|required";
			
			
			$this->validation->set_rules($rules);
			$fields['role_name'] = "Role Name";
			
			$this->validation->set_fields($fields);
	//	 print_r($data); die;
						 $this->role_model->add($data);
						$this->session->set_flashdata('L_strErrorMessage','Role Added Successfully!!!!');
						redirect($this->config->item('base_url').'role/lists');
						
						if ($this->validation->run() == FALSE){
				$data['L_strErrorMessage'] = $this->validation->error_string;
			} 		
		}
	    $data['all_module']=$this->role_model->all_module();
		//print_r($data);die;
		$this->load->view('add_role',$data);
	}
	
    function edit($id)
	{	 
	//echo $id; die;
			if(is_numeric($id))
			{
				 $result = $this->role_model->get_roll($id);  
			//	 print_r($result); die;
				$form_field = $data = array(
						'L_strErrorMessage' => '',
						'role_id'	=> $result[0]->role_id,
						'role_name' =>  $result[0]->role_name,
						'module_id'=>"",
						);	
				if($this->input->post('action') == 'edit_role') 
				{
				//	echo $id; die;
					foreach($data as $key => $value) {  $form_field[$key]=$this->input->post($key);	}
					
					$this->load->library('validation');
					$rules['role_name'] = "trim|required";
					
  					$this->validation->set_rules($rules);
					$fields['role_name']   = "role name";
					$this->validation->set_fields($fields);
					if ($this->validation->run() == FALSE) 
					{
							$data = $form_field;
							$data['L_strErrorMessage'] = $this->validation->error_string;
							$data['role_id'] = $id;
					} 
					else 
					{
							$this->role_model->edit($id, $form_field);
							$this->session->set_flashdata('L_strErrorMessage','Role Updated Successfully!!!!');
							redirect($this->config->item('base_url').'role/lists');
					}
				}
				
			//	$data['role_model_id']=$this->role_model->get_roll_module($id);
				//print_r($data['role_model_id']); die;
				$data['all_module']=$this->role_model->all_module();
				$data['id']=$id;
				$this->load->view('edit_role',$data);
			} 
			else 
			{
				$this->session->set_flashdata('L_strErrorMessage','No Such Categoryy !!!!');
				redirect($this->config->item('base_url').'role/lists');
			}
	}
	//first function calling after pressing coupan tab... 
	function lists()
	{
		$this->load->library('pagination');
		$url_to_paging = $this->config->item('base_url');
		
		$config['base_url'] = $url_to_paging.'role/lists/';
		$config['per_page'] = '10';
		$config['first_url']='0';
		$data = array();
		//using for searching data...
		$data['role_name'] = $this->input->post('role_name');
		$per_page = '1';
		$perpage = '3';
		//below is used in all perpose
		$return = $this->role_model->lists($config['per_page'],$this->uri->segment(3), $data);
		$data['result'] = $return['result'];
		$config['total_rows'] = $return['count'];
		//echo "<pre>";print_r($data);break;
		$this->pagination->initialize($config);
		$this->load->view('list_role', $data);
	}
	
	
	function deletes()
	{
		if(isset($_POST['selected']) && count($_POST['selected']) > 0) {
	
			foreach($_POST['selected'] as $selCheck) {
				if(!$this->role_model->get_role_id($selCheck)){
				if($this->role_model->deletes($selCheck)) {
					$this->session->set_flashdata('flashError','Role Deleted Successfully!!!!');
				}  
				else 
				{
						$this->session->set_flashdata('flashError','Some Errors prevented from Deleting!!!!');
						break;
				}
				} 
				else{
						$this->session->set_flashdata('flashError','Please remove user(s) with this module!!!!');
				}
			}
		}
		redirect($this->config->item('base_url').'role/lists');
	}
 
}
?>