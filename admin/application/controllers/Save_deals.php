<?php
	class Save_deals extends CI_Controller {
	private $_data = array();
	function __construct()
	{
		parent::__construct();
		if($this->session->userdata('adminId') == ''){
			redirect($this->config->item('base_url'));
        }
		$this->load->model('save_deals_model');
		
	}
	/*
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
			$fields['subcategory_name'] = "save_deals name";
			
			$this->validation->set_fields($fields);
			
		
			
		
			
						 $this->save_deals_model->add($data);
						$this->session->set_flashdata('L_strErrorMessage','Subcategory Added Successfully!!!!');
						redirect($this->config->item('base_url').'save_deals/lists');
						
						if ($this->validation->run() == FALSE){
				$data['L_strErrorMessage'] = $this->validation->error_string;
			} 
					
		}
		 
	
		 $data['allcategorylist'] = $this->save_deals_model->allcategory();
	
		$this->load->view('add_subcategory',$data);
	}
	
    function edit($id)
	{	 
			if(is_numeric($id))
			{
				$result = $this->save_deals_model->get_subcategory($id);  
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
							$this->save_deals_model->edit($id, $form_field);
							$this->session->set_flashdata('L_strErrorMessage','Subcategory Updated Successfully!!!!');
							redirect($this->config->item('base_url').'save_deals/lists');
					}
				}
				$data['allcategorylist'] = $this->save_deals_model->allcategory();
		
				$this->load->view('edit_subcategory',$data);
			} 
			else 
			{
				$this->session->set_flashdata('L_strErrorMessage','No Such Attribute !!!!');
				redirect($this->config->item('base_url').'save_deals/lists');
			}
	}
	*/
	//first function calling after pressing coupan tab... 
	function lists()
	{
		$this->load->library('pagination');
		$url_to_paging = $this->config->item('base_url');
		$config['base_url'] = $url_to_paging.'save_deals/lists/';
		$config['per_page'] = '10';
		$config['first_url']='0';
		$data = array();
		//using for searching data...
		$data['name'] = $this->input->post('name');
		$per_page = '1';
		$perpage = '3';
		//below is used in all perpose
		$return = $this->save_deals_model->lists($config['per_page'],$this->uri->segment(3), $data);
		$data['result'] = $return['result'];
		$config['total_rows'] = $return['count'];
		//echo "<pre>";print_r($data);break;
		$this->pagination->initialize($config);
		$this->load->view('list_save_deals', $data);
	}
	function deletes()
	{
		if(isset($_POST['selected']) && count($_POST['selected']) > 0) {
	
			foreach($_POST['selected'] as $selCheck) {
				if($this->save_deals_model->deletes($selCheck)) {
					$this->session->set_flashdata('flashError','Save Deals Deleted Successfully!!!!');
				}  
				else 
				{
						$this->session->set_flashdata('flashError','Some Errors prevented from Deleting!!!!');
						break;
				}
			}
		}
		redirect($this->config->item('base_url').'save_deals/lists');
	}
 
}
?>