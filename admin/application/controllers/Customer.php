<?php
class Customer extends CI_Controller {
	private $_data = array();
	function __construct()
	{
		parent::__construct();
		if($this->session->userdata('adminId') == ''){
			redirect($this->config->item('base_url'));
        }
		$this->load->model('customer_model');
		//$this->load->model('state_model');
		//$this->load->model('city_model');
	}
	
	function add()
	{
		//$L_strErrorMessage='';
		$form_field = $data = array(  
				'L_strErrorMessage' => '',  
				'email' => '',
				'username' => '',
				'password' => '',
				'phone' => '',
				'active' => '',							 
			);
			
		if($this->input->post('action') == 'add_Customer') 
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
				
					if(!$this->customer_model->is_users_already_exist_add($this->input->post('email')))
					{
						if($response = $this->customer_model->add($data))
						{
					  
						$this->session->set_flashdata('L_strErrorMessage','Register Customer Added Succcessfully!!!!');
						redirect($this->config->item('base_url').'customer/lists');
						}
						else 
						{
							$data['L_strErrorMessage'] = 'Some Errors prevented from adding data,please try later.';
						}
					}	
					else
					{
						$data['L_strErrorMessage'] = 'Register Customer already exist!';
					}
			}
		}
	//	 $data['state_list'] = $this->state_model->state_list();
	//	$data['city_list'] = $this->city_model->city_list();
	//	$data['allusers'] = $this->customer_model->allusers();
		//print_r($data);die;
		$this->load->view('add_customer',$data);
	}
	
    function edit($id,$approval =false)
	{	


//echo $approval;die;
	
	// $question_id = $this->uri->segment(4);
	// print_r($question_id);die;
			if(is_numeric($id))
			{
				$result = $this->customer_model->get_user($id);  
				//print_r($result);die();
				$form_field = $data = array(
						'L_strErrorMessage' => '',
						'id'	=> $result[0]->customer_id,
					//	'firstname' =>  $result[0]->firstname,
					//	'lastname' =>  $result[0]->lastname,
						'customer_email' => $result[0]->customer_email,
						'customer_name' => $result[0]->customer_name,
						'customer_password' => $result[0]->customer_password,
						'customer_mobile' => $result[0]->customer_mobile,
						'is_active' => $result[0]->is_active,
						//'is_deactive' => $result[0]->is_active,
						'approval'	=> $approval,
					/*	'dob' => $result[0]->dob,
						'company' => $result[0]->company,
						'website' => $result[0]->website,
						'state' => $result[0]->state,
						'city' => $result[0]->city,
						'address' => $result[0]->address,	
						
					*/						
						); 
			
				if($this->input->post('action') == 'edit_customer') 
				{
					foreach($data as $key => $value) {  $form_field[$key]=$this->input->post($key);	}
					
					$this->load->library('validation');
					$rules['customer_name'] = "trim|required";
					
  					$this->validation->set_rules($rules);
					$fields['customer_name']   = "customer Name";
					
				 
					$this->validation->set_fields($fields);
					if ($this->validation->run() == FALSE) {
					$data = $form_field;
					$data['L_strErrorMessage'] = $this->validation->error_string;
					$data['id'] = $id;

				} 
				else 
				{
					
					
					if(!$this->customer_model->is_users_already_exist($this->input->post('email'),$id))
					{
						if($response = $this->customer_model->edit($id, $form_field)) {
						
							//$this->customer_model->edit($id, $form_field);
							//$idapp=$this->customer_model->getactive($id);
							//if($approval=='approval'){
								//echo $this->input->post('approval');die;
							if($this->input->post('approval')!=''){
								if($data['is_active']==1)
								$this->userstatus($id,0);
								else
								$this->userstatus($id,1);
							}
							
						
							//}
							//print_r($this->input->post('is_active'));die;
							$this->session->set_flashdata('L_strErrorMessage','Register Customer Updated Succcessfully!!!!');
							redirect($this->config->item('base_url').'customer/lists');
					} else {
							$data['L_strErrorMessage'] = 'Some Errors prevented from update data,please try again later.';
						}
					}
					else
					{
						$data['L_strErrorMessage'] = 'Customer or Email already exist!';
					}
				}
			}
			//	$data['state_list'] = $this->state_model->state_list();
			//	$data['city_list'] = $this->city_model->city_list();
		//		$data['allusers'] = $this->customer_model->allusers();
				//$data['coupanattr'] = $this->customer_model->coupanattr($id); 
				$this->load->view('edit_customer',$data);
			} 
			else 
			{
				$this->session->set_flashdata('L_strErrorMessage','No Such Attribute !!!!');
				redirect($this->config->item('base_url').'customer/lists');
			}
	}
	//first function calling after pressing coupan tab... 
	function lists()
	{
	//	echo "yes"; die;
		$this->load->library('pagination');
		$url_to_paging = $this->config->item('base_url');
		
		$config['base_url'] = $url_to_paging.'customer/lists/';
		$config['per_page'] = '10000';
		$config['first_url']='0';
		
		$data = array();
		//using for searching data...
		$data['customer_name']='';
		$data['customer_email']='';
		$data['customer_mobile']='';
		
		if($this->input->post('action') == 'customer_list')
		{
		//using for searching data...
		$data['customer_name'] = $this->input->post('customer_name');
		$data['customer_email'] = $this->input->post('customer_email');
		$data['customer_mobile'] = $this->input->post('customer_mobile');
		}
		$per_page = '1';
		$perpage = '3';
		//below is used in all perpose
		$return = $this->customer_model->list_user($config['per_page'],$this->uri->segment(3), $data);
		
		$data['result'] = $return['result'];
		$config['total_rows'] = $return['count'];
		//echo "<pre>";print_r($data);break;
		$this->pagination->initialize($config);
		$this->load->view('list_customer', $data);
	}
	
	
	function deletes()
	{
		if(isset($_POST['selected']) && count($_POST['selected']) > 0) {
	
			foreach($_POST['selected'] as $selCheck) {
				if($this->customer_model->deletes($selCheck)) {
					$this->session->set_flashdata('flashError','Register User Deleted Succcessfully!!!!');
				}  
				else 
				{
						$this->session->set_flashdata('flashError','Some Errors prevented from Deleting!!!!');
						break;
				}
			}
		}
		redirect($this->config->item('base_url').'Customer/lists');
	}
	/*function reguserenabled(){
		$this->customer_model->reguserenabled($this->input->post('id'),$this->input->post('enablestatus'));
		echo '1';die;
	}*/
	function userstatus($id,$value)
	{	
	//print_r($id);die;
		$result=$this->customer_model->updatestatus($id,$value);
		$this->session->set_flashdata('L_strErrorMessage','Register user status Updated');
		redirect($this->config->item('base_url').'customer/lists');
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
		$planning = $this->customer_model->allusers();
		$output .= 'Sr. No.,customer Id,Name,Email,Phone,Join Date ,Status';
		$output .="\n";
		if($planning != '' && count($planning) > 0) {
			$i=1;
		foreach($planning as $planning) {
			if($planning->is_active=='1'){ $status="Active";}elseif($planning->is_active=='0'){ $status="InActive";}else{ $status="Pending Approval";}
		$output .= '"'.$i.'","'.$planning->customer_id.'","'.$planning->customer_name.'","'.$planning->customer_email.'","'.$planning->customer_mobile .'","'.date('Y/d/m',strtotime($planning->added_date)).'","'.$status.'" ';  
		$output .="\n";
		
		$i++; }
		}
		$filename = "Customer_reports.csv";
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$filename);
		echo $output;
		exit;
	}
	
}
?>