<?php
	class Subcategory extends CI_Controller {
	private $_data = array();
	function __construct()
	{
		parent::__construct();
		if($this->session->userdata('adminId') == ''){
			redirect($this->config->item('base_url'));
        }
		$this->load->model('subcategory_model');
		
	}
	function add()
	{
		//$L_strErrorMessage='';
		$form_field = $data = array(  
			   'category_id' => '',
				'subcategory_name' => ''			
			);
			
		if($this->input->post('action') == 'add_subcategory') 
		{
			foreach($form_field as $key => $value)
			{	
				$data[$key]=$this->input->post($key);	
				
			}
			$this->load->library('validation');
			$rules['subcategory_name'] = "trim|required";
			
			
			$this->validation->set_rules($rules);
			$fields['subcategory_name'] = "subcategory name";
			
			$this->validation->set_fields($fields);
			
		
			
		
			
						 $this->subcategory_model->add($data);
						$this->session->set_flashdata('L_strErrorMessage','Subcategory Added Successfully!!!!');
						redirect($this->config->item('base_url').'subcategory/lists');
						
						if ($this->validation->run() == FALSE){
				$data['L_strErrorMessage'] = $this->validation->error_string;
			} 
					
		}
		 /**/
	
		 $data['allcategorylist'] = $this->subcategory_model->allcategory();
	
		$this->load->view('add_subcategory',$data);
	}
	
    function edit($id)
	{	 
			if(is_numeric($id))
			{
				$result = $this->subcategory_model->get_subcategory($id);  
				//print_r($result);die();
				$form_field = $data = array(
						'L_strErrorMessage' => '',
						'subcategory_id'	=> $result[0]->subcategory_id,
						'subcategory_name' =>  $result[0]->subcategory_name,
						'category_id' =>  $result[0]->category_id,
						);  
					
				if($this->input->post('action') == 'edit_subcategory') 
				{
					foreach($data as $key => $value) {  $form_field[$key]=$this->input->post($key);	}
					
					$this->load->library('validation');
					$rules['subcategory_name'] = "trim|required";
					
  					$this->validation->set_rules($rules);
					$fields['subcategory_name']   = "subcategoryname";
					
				 
					$this->validation->set_fields($fields);
					if ($this->validation->run() == FALSE) 
					{
							$data = $form_field;
							$data['L_strErrorMessage'] = $this->validation->error_string;
							$data['subcategory_id'] = $id;
					} 
					else 
					{
	
							$this->subcategory_model->edit($id, $form_field);
							$this->session->set_flashdata('L_strErrorMessage','Subcategory Updated Successfully!!!!');
							redirect($this->config->item('base_url').'subcategory/lists');
					}
				}
				$data['allcategorylist'] = $this->subcategory_model->allcategory();
		
				$this->load->view('edit_subcategory',$data);
			} 
			else 
			{
				$this->session->set_flashdata('L_strErrorMessage','No Such Attribute !!!!');
				redirect($this->config->item('base_url').'subcategory/lists');
			}
	}
	//first function calling after pressing coupan tab... 
	function lists()
	{
		$this->load->library('pagination');
		$url_to_paging = $this->config->item('base_url');
		
		$config['base_url'] = $url_to_paging.'subcategory/lists/';
		$config['per_page'] = '10';
		$config['first_url']='0';
		$data = array();
		//using for searching data...
		$data['subcategory_name'] = $this->input->post('subcategory_name');
		
		$per_page = '1';
		$perpage = '3';
		//below is used in all perpose
		$return = $this->subcategory_model->lists($config['per_page'],$this->uri->segment(3), $data);
		
		$data['result'] = $return['result'];
		$config['total_rows'] = $return['count'];
		//echo "<pre>";print_r($data);break;
		$this->pagination->initialize($config);
		$this->load->view('list_subcategory', $data);
	}
	function deletes()
	{
		if(isset($_POST['selected']) && count($_POST['selected']) > 0) {
	
			foreach($_POST['selected'] as $selCheck) {
					if(!$this->subcategory_model->get_deal_id($selCheck)){
				if($this->subcategory_model->deletes($selCheck)) {
					$this->session->set_flashdata('flashError','Subcategory Deleted Successfully!!!!');
				}  
				else 
				{
						$this->session->set_flashdata('flashError','Some Errors prevented from Deleting!!!!');
						break;
				}
				} 
				else{
						$this->session->set_flashdata('flashError','Could not delete subcategory, its assigned to some deals.!!!!');
				}
			}
		}
		redirect($this->config->item('base_url').'subcategory/lists');
	}
 
}
?>