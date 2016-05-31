<?php
	class Deals extends CI_Controller {
	private $_data = array();
	function __construct()
	{
		parent::__construct();
		if($this->session->userdata('adminId') == ''){
			redirect($this->config->item('base_url'));
        }
		$this->load->model('deals_model');
		
	}
	function add()
	{
		//$L_strErrorMessage='';
		$form_field = $data = array(  
					'Merchant_id' => '',
					'Shop_id' => '',
					'deal_category' => '',
					'deal_subcategory' => '',
					'deal_title' => '',	
					'deal_description' => '',
					'deal_startdate' => '',
					'deal_enddate' => '',
					'deal_amount' => '',
					//'d_startdate' => '',
					//'d_enddate' => '',
					'all_days' => '',
					'deal_usage' => '',
					'location' => '',
					'discount_type' => '',
					'discount_value' => '',
					'is_active' => '',
					
			);
			
		if($this->input->post('action') == 'add_deals') 
		{
			foreach($form_field as $key => $value)
			{	
				$data[$key]=$this->input->post($key);	
				
			}
			$this->load->library('validation');
			$rules['deal_title'] = "trim|required";
			
			$this->validation->set_rules($rules);
			$fields['deal_title'] = "Deal Title";
			
			$this->validation->set_fields($fields);
		//	print_r($data); die;
						$this->deals_model->add($data);
						$this->session->set_flashdata('L_strErrorMessage','Deal Added Successfully!!!!');
						redirect($this->config->item('base_url').'deals/lists');
						
						if ($this->validation->run() == FALSE){
				$data['L_strErrorMessage'] = $this->validation->error_string;
			} 
					
		}
		 /**/
	
		 $data['allcategorylist'] = $this->deals_model->allcategory();
		  $data['allmerchant'] = $this->deals_model->allmerchant();
	
		$this->load->view('add_deals',$data);
	}
	
    function edit($id,$approval =false)
	{	 
			if(is_numeric($id))
			{
				$result = $this->deals_model->get_deals_data($id);  
				//print_r($result);die();
				$form_field = $data = array(
				'L_strErrorMessage' => "",
				'deal_id' =>$result[0]->deal_id,
				'merchant_id' => $result[0]->merchant_id,
			    'Shop_id' => $result[0]->shop_id,
				'deal_category' => $result[0]->deal_category,
				'deal_subcategory' => $result[0]->deal_subcategory,
				'deal_title' => $result[0]->deal_title,	
			    'deal_description' => $result[0]->deal_description,
				'deal_startdate' => $result[0]->deal_startdate,					
				'deal_enddate' => $result[0]->deal_enddate,
				'deal_amount' => $result[0]->deal_amount,
					//'d_startdate' => $result[0]->d_startdate,
					//'d_enddate' => $result[0]->d_enddate,
					'all_days' => $result[0]->all_days,
					'deal_usage' => $result[0]->deal_usage,
					'location' => $result[0]->location,
					'discount_type' => $result[0]->discount_type,
					'discount_value' => $result[0]->discount_value,
				'approval'	=> $approval,
						'is_active' => $result[0]->is_active,
						);  
				
				if($this->input->post('action') == 'edit_deals') 
				{
					
					foreach($data as $key => $value) {  $form_field[$key]=$this->input->post($key);	}
					
					$this->load->library('validation');
					$rules['deal_title'] = "trim|required";
					
  					$this->validation->set_rules($rules);
					$fields['deal_title']   = "Deal Title";
					
				 
					$this->validation->set_fields($fields);
					if ($this->validation->run() == FALSE) 
					{
							$data = $form_field;
							$data['L_strErrorMessage'] = $this->validation->error_string;
							$data['subcategory_id'] = $id;
					} 
					else 
					{
	
							$this->deals_model->edit($id, $form_field);
							if($this->input->post('approval')!=''){
								if($data['is_active']==1)
								$this->userstatus($id,0);
								else
								$this->userstatus($id,1);
							}
							$this->session->set_flashdata('L_strErrorMessage','Deal Updated Successfully!!!!');
							redirect($this->config->item('base_url').'deals/lists');
					}
				}
				$data['allcategorylist'] = $this->deals_model->allcategory();
				$data['allmerchant'] = $this->deals_model->allmerchant();
				$data['shop']=$this->deals_model->get_shop_all($result[0]->merchant_id);
				$data['subcategory'] = $this->deals_model->getall_subcategory($result[0]->deal_category);
				$this->load->view('edit_deals',$data);
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
		$config['per_page'] = '10000';
		$config['first_url']='0';
		$data = array();
		//using for searching data...
		$data['deal_title'] = $this->input->post('subcategory_name');
		
		$per_page = '1';
		$perpage = '3';
		//below is used in all perpose
		$return = $this->deals_model->lists($config['per_page'],$this->uri->segment(3), $data);
		
		$data['result'] = $return['result'];
		$config['total_rows'] = $return['count'];
		//echo "<pre>";print_r($data);break;
		$this->pagination->initialize($config);
		$this->load->view('list_deals', $data);
	}
	function deletes()
	{
		if(isset($_POST['selected']) && count($_POST['selected']) > 0) {
	
			foreach($_POST['selected'] as $selCheck) {
				if(!$this->deals_model->get_dealid($selCheck)){
						if(!$this->deals_model->get_dealid_save($selCheck)){
				if($this->deals_model->deletes($selCheck)) {
					$this->session->set_flashdata('L_strErrorMessage','Deals Deleted Successfully!!!!');
				}  
				else 
				{
						$this->session->set_flashdata('flashError','Some Errors prevented from Deleting!!!!');
						break;
				}
				}else{
							
							$this->session->set_flashdata('flashError','Deal is already Save by user  !!!!');
					}
				} 
				else{
						$this->session->set_flashdata('flashError','Deal is already redeem by user  !!!!');
						
					}
			}
		}
		redirect($this->config->item('base_url').'deals/lists');
	}
	function getall_subcategory(){		
		$cid = $_POST['cid'];
       //echo $cid; die;
		$data = $this->deals_model->getall_subcategory($cid);
		//print_r($data); die;
		//exit;			
		$html = '<select name="deal_subcategory" id="subcategoryid" class="form-control jobtext">';
		$html .= "<option value=''>	--Select SubCategory--</option>";
		if($data != '')
		{
		for($i=0;$i<count($data);$i++)
		{
			$html .= "<option value='".$data[$i]->subcategory_id."'>".$data[$i]->subcategory_name."</option>";
		}
		}
		$html .="</select>";
		echo $html;
	}
	
function get_shop_data(){		
		$mid = $_POST['mid'];
       //echo $cid; die;
		$data = $this->deals_model->get_shop_all($mid);
		//print_r($data); die;
		//exit;			
		$html = '<select name="Shop_id" id="Shop_id" class="form-control jobtext">';
		$html .= "<option value=''>	--Select Shop--</option>";
		if($data != '')
		{
		for($i=0;$i<count($data);$i++)
		{
			$html .= "<option value='".$data[$i]->shop_id."'>".$data[$i]->shop_name."</option>";
		}
		}
		$html .="</select>";
		echo $html;
}
function userstatus($id,$value)
	{	
		
		$result=$this->deals_model->updatestatus($id,$value);
		$this->session->set_flashdata('L_strErrorMessage','Deals status Updated');
		redirect($this->config->item('base_url').'deals/lists');
		//$this->load->view('users/list_user', $data);
	}
}
?>