<?php
	class Category extends CI_Controller {
	private $_data = array();
	function __construct()
	{
		parent::__construct();
		if($this->session->userdata('adminId') == ''){
			redirect($this->config->item('base_url'));
        }
		$this->load->model('category_model');
	}
	function add()
	{
		//$L_strErrorMessage='';
		$form_field = $data = array(  
			
				'category_name' => '',
						
			);
			
		if($this->input->post('action') == 'add_category') 
		{
			foreach($form_field as $key => $value)
			{	
				$data[$key]=$this->input->post($key);	
				
			}
			$this->load->library('validation');
			$rules['categoryname'] = "trim|required";
			
			
			$this->validation->set_rules($rules);
			$fields['categoryname'] = "categoryname";
			
			$this->validation->set_fields($fields);
		
						 $this->category_model->add($data);
						$this->session->set_flashdata('L_strErrorMessage','Category Added Successfully!!!!');
						redirect($this->config->item('base_url').'category/lists');
						
						if ($this->validation->run() == FALSE){
				$data['L_strErrorMessage'] = $this->validation->error_string;
			} 
					
		}
	
		//print_r($data);die;
		$this->load->view('add_category',$data);
	}
	
    function edit($id)
	{	 
	//echo $id; die;
			if(is_numeric($id))
			{
				$result = $this->category_model->get_category($id);  
				//print_r($result);die();
				$form_field = $data = array(
						'L_strErrorMessage' => '',
						'category_id'	=> $result[0]->category_id,
						'category_name' =>  $result[0]->category_name
						);
			
				
					
				if($this->input->post('action') == 'edit_category') 
				{
				//	echo $id; die;
					foreach($data as $key => $value) {  $form_field[$key]=$this->input->post($key);	}
					
					$this->load->library('validation');
					$rules['category_name'] = "trim|required";
					
  					$this->validation->set_rules($rules);
					$fields['category_name']   = "category name";
					
				 
					$this->validation->set_fields($fields);
					if ($this->validation->run() == FALSE) 
					{
							$data = $form_field;
							$data['L_strErrorMessage'] = $this->validation->error_string;
							$data['category_id'] = $id;
					} 
					else 
					{
			
			
		
							$this->category_model->edit($id, $form_field);
							$this->session->set_flashdata('L_strErrorMessage','Category Updated Successfully!!!!');
							redirect($this->config->item('base_url').'category/lists');
					}
				}
				
		
				$this->load->view('edit_category',$data);
			} 
			else 
			{
				$this->session->set_flashdata('L_strErrorMessage','No Such Categoryy !!!!');
				redirect($this->config->item('base_url').'category/lists');
			}
	}
	//first function calling after pressing coupan tab... 
	function lists()
	{
		$this->load->library('pagination');
		$url_to_paging = $this->config->item('base_url');
		
		$config['base_url'] = $url_to_paging.'category/lists/';
		$config['per_page'] = '10000';
		$config['first_url']='0';
		$data = array();
		//using for searching data...
		$data['categoryname'] = $this->input->post('categoryname');
		
		$per_page = '1';
		$perpage = '3';
		//below is used in all perpose
		$return = $this->category_model->lists($config['per_page'],$this->uri->segment(3), $data);
		
		$data['result'] = $return['result'];
		$config['total_rows'] = $return['count'];
		//echo "<pre>";print_r($data);break;
		$this->pagination->initialize($config);
		$this->load->view('list_category', $data);
	}
	
	
	function deletes()
	{
		if(isset($_POST['selected']) && count($_POST['selected']) > 0) {
	
			foreach($_POST['selected'] as $selCheck) {
				if(!$this->category_model->get_subcategory_id($selCheck)){
				if($this->category_model->deletes($selCheck)) {
					$this->session->set_flashdata('flashError','Category Deleted Successfully!!!!');
				}  
				else 
				{
						$this->session->set_flashdata('flashError','Some Errors prevented from Deleting!!!!');
						break;
				}
				} 
				else{
						$this->session->set_flashdata('flashError','Could not delete this category. There is a subcategory assigned to this category  !!!!');
				}
			}
		}
		redirect($this->config->item('base_url').'category/lists');
	}
 
}
?>