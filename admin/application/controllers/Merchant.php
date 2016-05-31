<?php
class Merchant extends CI_Controller {
	private $_data = array();
	function __construct()
	{
		parent::__construct();
		if($this->session->userdata('adminId') == ''){
			redirect($this->config->item('base_url'));
        }
		$this->load->model('merchant_model');
		//$this->load->model('state_model');
		//$this->load->model('city_model');
	}
	
	function add()
	{
		//$L_strErrorMessage='';
		$form_field = $data = array(  
				'L_strErrorMessage' => '',  
				'username' => '',
				'email' => '',
				'password' => '',
				'phone' => '',
				'vat' => '',
				'tax' => '',
				'pan' => '',
				'merchant_add' => '',
				'merchant_city' => '',
				'merchant_State' => '',
				'merchant_zip' => '',
				'merchant_country' => '',
				'active' => '',							 
			);
			
		if($this->input->post('action') == 'add_merchant') 
		{
			foreach($form_field as $key => $value)
			{	
				$data[$key]=$this->input->post($key);	
				
			}
			$this->load->library('validation');
			$rules['username'] = "trim|required";
			
			
			$this->validation->set_rules($rules);
			$fields['username'] = "Customer Name";
			
			$this->validation->set_fields($fields);
			
			   if ($this->validation->run() == FALSE){
				$data['L_strErrorMessage'] = $this->validation->error_string;
			   } else {
				
					if(!$this->merchant_model->is_users_already_exist_add($this->input->post('email')))
					{
							 
						if($response = $this->merchant_model->add($data))
						{	
							$this->session->set_flashdata('L_strErrorMessage','Merchant Added Successfully, Pending for approval!!!!');
							redirect($this->config->item('base_url').'merchant/lists');
						}
						else 
						{
							$data['L_strErrorMessage'] = 'Some Errors prevented from adding data,please try later.';
						}
					}	
					else
					{
						$data['L_strErrorMessage'] = 'Register merchant already exist!';
					}
			}
		}
	
		$this->load->view('add_merchant',$data);
	}
	
    function edit($id,$deapproval = false)
	{	 
			if(is_numeric($id))
			{
				$result = $this->merchant_model->get_user($id);  
				//print_r($result);die();
				$form_field = $data = array(
						'L_strErrorMessage' => '',
						'merchant_id'	=> $result[0]->merchant_id,
						'merchant_email' => $result[0]->merchant_email,
						'merchant_name' => $result[0]->merchant_name,
						'merchant_password' => $result[0]->merchant_password,
						'merchant_mobile' => $result[0]->merchant_mobile,
						'merchant_vat' => $result[0]->merchant_vat,
						'merchant_tax' => $result[0]->merchant_tax,
						'merchant_pan' => $result[0]->merchant_pan,
						'merchant_add' => $result[0]->merchant_add,
						'merchant_city' => $result[0]->merchant_city,
						'merchant_State' => $result[0]->merchant_State,
						'merchant_zip' => $result[0]->merchant_zip,
						'merchant_country' => $result[0]->merchant_country,
						'is_approve' => $result[0]->is_approve,
						'deapproval'	=> $deapproval,
					/*	'dob' => $result[0]->dob,
						'company' => $result[0]->company,
						'website' => $result[0]->website,
						'state' => $result[0]->state,
						'city' => $result[0]->city,
						'address' => $result[0]->address,	
					*/						
						); 
			
				if($this->input->post('action') == 'edit_merchant') 
				{
					foreach($data as $key => $value) {  $form_field[$key]=$this->input->post($key);	}
					
					$this->load->library('validation');
					$rules['merchant_name'] = "trim|required";
					
  					$this->validation->set_rules($rules);
					$fields['merchant_name']   = "merchant name";
					
				 
					$this->validation->set_fields($fields);
					if ($this->validation->run() == FALSE) {
					$data = $form_field;
					$data['L_strErrorMessage'] = $this->validation->error_string;
					$data['id'] = $id;

				} 
				else 
				{
					
					if(!$this->merchant_model->is_users_already_exist($this->input->post('email'),$id))
					{
						if($response = $this->merchant_model->edit($id, $form_field)) {
						
							$this->merchant_model->edit($id, $form_field);
							
							if($this->input->post('approval')!=''){
								if($data['is_approve']==1)
								$this->userstatus($id,0);
								else
								$this->userstatus($id,1);
							}
							
							$this->session->set_flashdata('L_strErrorMessage','Register merchant Updated Succcessfully!!!!');
							redirect($this->config->item('base_url').'merchant/lists');
					} else {
							$data['L_strErrorMessage'] = 'Some Errors prevented from update data,please try again later.';
						}
					}
					else
					{
						$data['L_strErrorMessage'] = 'Merchant or Email already exist!';
					}
				}
			}
			//	$data['state_list'] = $this->state_model->state_list();
			//	$data['city_list'] = $this->city_model->city_list();
		//		$data['allusers'] = $this->merchant_model->allusers();
				//$data['coupanattr'] = $this->merchant_model->coupanattr($id); 
				$this->load->view('edit_merchant',$data);
			} 
			else 
			{
				$this->session->set_flashdata('L_strErrorMessage','No Such Attribute !!!!');
				redirect($this->config->item('base_url').'merchant/lists');
			}
	}
	//first function calling after pressing coupan tab... 
	function lists()
	{
		$this->load->library('pagination');
		$url_to_paging = $this->config->item('base_url');
		
		$config['base_url'] = $url_to_paging.'merchant/lists/';
		$config['per_page'] = '10000';
		$config['first_url']='0';
		$data = array();
		//using for searching data...
		$data['name'] = $this->input->post('name');
		
		$per_page = '1';
		$perpage = '3';
		//below is used in all perpose
		$return = $this->merchant_model->list_user($config['per_page'],$this->uri->segment(3), $data);
		
		$data['result'] = $return['result'];
		$config['total_rows'] = $return['count'];
		//echo "<pre>";print_r($data);break;
		$this->pagination->initialize($config);
		$this->load->view('list_merchant', $data);
	}
	
	
	function deletes()
	{
		//echo "yes"; die;
		if(isset($_POST['selected']) && count($_POST['selected']) > 0) {
	
			foreach($_POST['selected'] as $selCheck) {
				if(!$this->merchant_model->get_shop_id($selCheck)){
				if($this->merchant_model->deletes($selCheck)) {
					$this->session->set_flashdata('flashError','Register Merchant Deleted Succcessfully!!!!');
				}  
				else 
				{
						$this->session->set_flashdata('flashError','Some Errors prevented from Deleting!!!!');
						break;
				}
				} 
				else{
						$this->session->set_flashdata('flashError','Delete shop before deleting merchant!!!!');
					}
			}
		}
		redirect($this->config->item('base_url').'merchant/lists');
	}
	/*function reguserenabled(){
		$this->merchant_model->reguserenabled($this->input->post('id'),$this->input->post('enablestatus'));
		echo '1';die;
	}*/
	function userstatus($id,$value)
	{	
		
		//echo $value; die;
		$result=$this->merchant_model->updatestatus($id,$value);
		$this->session->set_flashdata('L_strErrorMessage','Register user status Updated');
		redirect($this->config->item('base_url').'merchant/lists');
		//$this->load->view('users/list_user', $data);
	}
	
	function show_city(){		
		$cid = $_POST['cid'];
		$data = $this->city_model->show_city($cid);
		//exit;
		$html = "<select id='city' name='city'  class='form-control jobtext'>";
		$html .= "<option value=''>Select City</option>";
		if($data != '')
		{

		for($i=0;$i<count($data);$i++)
		{
			$html .= "<option value='".$data[$i]->city_id ."'>".$data[$i]->city_name ."</option>";
		}
		}
		$html .="</select>";
		echo $html;
	}
	
	function download()
	{
		$output = '';
		$planning = $this->merchant_model->allusers();
		
		
		
		
		$output .= 'Sr. No.,Merchant Id,Name,Email,Phone,Vat,Tax,Pancard Number,Address,City,State,Zip,country,Join Date ,Status';
		$output .="\n";
		if($planning != '' && count($planning) > 0) {
			$i=1;
		foreach($planning as $planning) {
		if($planning->is_approve=='1'){ $status="Active";}elseif($planning->is_approve=='0'){ $status="InActive";}else{ $status="Pending Approval"; }
		$output .= '"'.$i.'","'.$planning->merchant_id.'","'.$planning->merchant_name.'","'.$planning->merchant_email.'","'.$planning->merchant_mobile .'","'.$planning->merchant_vat.'","'.$planning->merchant_tax .'","'.$planning->merchant_pan.'","'.$planning->merchant_add .'","'.$planning->merchant_city.'","'.$planning->merchant_State .'","'.$planning->merchant_zip.'","'.$planning->merchant_country .'","'.date('Y/d/m',strtotime($planning->added_date)).'","'.$status.'" ';  
		$output .="\n";
			$i++;}
		}
		$filename = "Merchant_reports.csv";
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$filename);
		echo $output;
		exit;
	}
}
?>