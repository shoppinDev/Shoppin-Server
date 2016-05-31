<?php
	class Module extends CI_Controller {
	private $_data = array();
	function __construct()
	{
		parent::__construct();
		if($this->session->userdata('adminId') == ''){
			redirect($this->config->item('base_url'));
        }
		$this->load->model('module_model');
	}
	function add()
	{
		//$L_strErrorMessage='';
		$form_field = $data = array(  
			
				'module_name' => '',
						
			);
			
		if($this->input->post('action') == 'add_module') 
		{
			foreach($form_field as $key => $value)
			{	
				$data[$key]=$this->input->post($key);	
				
			}
			$this->load->library('validation');
			$rules['module_name'] = "trim|required";
			
			
			$this->validation->set_rules($rules);
			$fields['module_name'] = "module_name";
			
			$this->validation->set_fields($fields);
		
						 $this->module_model->add($data);
						$this->session->set_flashdata('L_strErrorMessage','Module Added Successfully!!!!');
						redirect($this->config->item('base_url').'module/lists');
						
						if ($this->validation->run() == FALSE){
				$data['L_strErrorMessage'] = $this->validation->error_string;
			} 
					
		}
	
		//print_r($data);die;
		$this->load->view('add_module',$data);
	}
	
    function edit($id)
	{	 
	//echo $id; die;
			if(is_numeric($id))
			{
				$result = $this->module_model->get_category($id);  
				//print_r($result);die();
				$form_field = $data = array(
						'L_strErrorMessage' => '',
						'module_id'	=> $result[0]->module_id,
						'module_name' =>  $result[0]->module_name
						);
			
				
					
				if($this->input->post('action') == 'edit_module') 
				{
				//	echo $id; die;
					foreach($data as $key => $value) {  $form_field[$key]=$this->input->post($key);	}
					
					$this->load->library('validation');
					$rules['module_name'] = "trim|required";
					
  					$this->validation->set_rules($rules);
					$fields['module_name']   = "module name";
					
				 
					$this->validation->set_fields($fields);
					if ($this->validation->run() == FALSE) 
					{
							$data = $form_field;
							$data['L_strErrorMessage'] = $this->validation->error_string;
							$data['module_id'] = $id;
					} 
					else 
					{
			
			
		
							$this->module_model->edit($id, $form_field);
							$this->session->set_flashdata('L_strErrorMessage','Module Updated Successfully!!!!');
							redirect($this->config->item('base_url').'module/lists');
					}
				}
				
		
				$this->load->view('edit_module',$data);
			} 
			else 
			{
				$this->session->set_flashdata('L_strErrorMessage','No Such Module !!!!');
				redirect($this->config->item('base_url').'module/lists');
			}
	}
	//first function calling after pressing coupan tab... 
	function lists()
	{
		$this->load->library('pagination');
		$url_to_paging = $this->config->item('base_url');
		
		$config['base_url'] = $url_to_paging.'module/lists/';
		$config['per_page'] = '10';
		$config['first_url']='0';
		$data = array();
		//using for searching data...
		$data['module_name'] = $this->input->post('module_name');
		
		$per_page = '1';
		$perpage = '3';
		//below is used in all perpose
		$return = $this->module_model->lists($config['per_page'],$this->uri->segment(3), $data);
		
		$data['result'] = $return['result'];
		$config['total_rows'] = $return['count'];
		//echo "<pre>";print_r($data);break;
		$this->pagination->initialize($config);
		$this->load->view('list_module', $data);
	}
	
	
	function deletes()
	{
		
		
		//print_r($module_id); die;
	    	if(isset($_POST['selected']) && count($_POST['selected']) > 0) {
				
			foreach($_POST['selected'] as $selCheck) {
		      if(!$this->module_model->get_role_model($selCheck))
			  {
			    	if($this->module_model->deletes($selCheck)) {
					$this->session->set_flashdata('flashError','Module Deleted Successfully!!!!');
				}  
				else 
				{
						$this->session->set_flashdata('flashError','Some Errors prevented from Deleting!!!!');
						break;
				}
		  }
		  else{
			  $this->session->set_flashdata('flashError','Module Name is allready Useded!!!');
		  }
			}
		}
		redirect($this->config->item('base_url').'module/lists');
	}
 
}
?>