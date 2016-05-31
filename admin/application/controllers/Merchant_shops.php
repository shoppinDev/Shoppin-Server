<?php
class Merchant_shops extends CI_Controller {
	private $_data = array();
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		if($this->session->userdata('adminId') == ''){
			redirect($this->config->item('base_url'));
        }
		$this->load->model('merchant_shops_model');
		//$this->load->model('state_model');
		//$this->load->model('city_model');
	}
	
	function add($id)
	{
		 $this->session->set_userdata('m_id',$id);
		//echo $this->session->userdata('m_id'); die;
		//$L_strErrorMessage='';
		$form_field = $data = array(  
				'L_strErrorMessage' => '',  
				'merchant_id' => '',  
				'shopname' => '',
			    'Shop_address' => '',
				'Latitude' => '',
				'Longitude' => '',
				'email' => '',
				'phone' => '',
			//	'shop_add' => '',
				'shop_city' => '',
				'shop_State' => '',
				'shop_zip' => '',
				'shop_country' => '',
				'active' => '',							 
			);
			
		if($this->input->post('action') == 'add_merchant_shop') 
		{
			foreach($form_field as $key => $value)
			{	
				$data[$key]=$this->input->post($key);	
				
			}
			$this->load->library('validation');
			$rules['shopname'] = "trim|required";
			
			
			$this->validation->set_rules($rules);
			$fields['shopname'] = "Shop Name";
			
			$this->validation->set_fields($fields);
			
			   if ($this->validation->run() == FALSE){
				$data['L_strErrorMessage'] = $this->validation->error_string;
			   } else {
				
					//if(!$this->merchant_shops_model->is_users_already_exist_add($this->input->post('email')))
					//{
						//print_r($data); die;
						if($response = $this->merchant_shops_model->add($data))
						{  
							include 'application/views/qrcode/qrlib.php'; 
							$filename = $this->config->item('upload').'qrcode_image/'.$id.$response.'code.png';
							QRcode::png($id.$response,$filename); // creates file
							$data['id']=$response;
							$data['image']=$id.$response."code.png";
							if($this->merchant_shops_model->add_qrcode($data))
							{
								
							}
							//QRcode::png('some othertext 1234'); // creates code image and outputs it directly into browser
					
						$this->session->set_flashdata('L_strErrorMessage','Register Shop Added Succcessfully!!!!');
						redirect($this->config->item('base_url').'merchant_shops/lists/'.$this->session->userdata['m_id']);
						}
						else 
						{
							$data['L_strErrorMessage'] = 'Some Errors prevented from adding data,please try later.';
						}
					/*}	
					else
					{
						$data['L_strErrorMessage'] = 'Register Shop already exist!';
					}*/
			}
		}
	//	 $data['state_list'] = $this->state_model->state_list();
	//	$data['city_list'] = $this->city_model->city_list();
	//	$data['allusers'] = $this->merchant_shops_model->allusers();
		//print_r($data);die;
		$this->load->view('add_merchant_shops',$data);
	}
	
    function edit($id,$mid,$approval =false)
	{	 

			if(is_numeric($id))
			{
				$result = $this->merchant_shops_model->get_shop($id,$mid);  
			//	print_r($result);die();
				$form_field = $data = array(
						'L_strErrorMessage' => '',
						'shop_id'	=> $result[0]->shop_id,
						'merchant_id'	=> $result[0]->merchant_id,
						'shop_name' => $result[0]->shop_name,
						'shop_addres' => $result[0]->shop_addres,
						'shop_latitude' => $result[0]->shop_latitude,
						'shop_longitude' => $result[0]->shop_longitude,
						'shop_email' => $result[0]->shop_email,
						'shop_mobile' => $result[0]->shop_mobile,
							//'shop_add' => $result[0]->shop_add,
							'shop_city' => $result[0]->shop_city,
							'shop_State' => $result[0]->shop_state,
							'shop_zip' => $result[0]->shop_zip,
							'shop_country' => $result[0]->shop_country,
						'approval'	=> $approval,
						'is_active' => $result[0]->is_active,
					/*	'dob' => $result[0]->dob,
						'company' => $result[0]->company,
						'website' => $result[0]->website,
						'state' => $result[0]->state,
						'city' => $result[0]->city,
						'address' => $result[0]->address,	
					*/						
						); 
			
				if($this->input->post('action') == 'edit_merchant_shop') 
				{
					foreach($data as $key => $value) {  $form_field[$key]=$this->input->post($key);	}
					
					$this->load->library('validation');
					$rules['shop_name'] = "trim|required";
					
  					$this->validation->set_rules($rules);
					$fields['shop_name']   = "Shop name";
					
				 
					$this->validation->set_fields($fields);
					if ($this->validation->run() == FALSE) {
					$data = $form_field;
					$data['L_strErrorMessage'] = $this->validation->error_string;
					$data['id'] = $id;

				} 
				else 
				{
					
				//	if(!$this->merchant_shops_model->is_users_already_exist($this->input->post('shop_email'),$id))
				//	{
						if($response = $this->merchant_shops_model->edit($id, $form_field)) {
						
						//	$this->merchant_shops_model->edit($id, $form_field);
							if($this->input->post('approval')!=''){
								if($data['is_active']==1)
								$this->userstatus($id,$mid,0);
								else
								$this->userstatus($id,$mid,1);
							}
							
							$this->session->set_flashdata('L_strErrorMessage','Register Shop Updated Succcessfully!!!!');
							redirect($this->config->item('base_url').'merchant_shops/lists/'.$mid);
					} else {
							$data['L_strErrorMessage'] = 'Some Errors prevented from update data,please try again later.';
						}
				/*	}
					else
					{
						$data['L_strErrorMessage'] = 'Shop or Email already exist!';
					}*/
				}
			}
			//	$data['state_list'] = $this->state_model->state_list();
			//	$data['city_list'] = $this->city_model->city_list();
		//		$data['allusers'] = $this->merchant_shops_model->allusers();
				//$data['coupanattr'] = $this->merchant_shops_model->coupanattr($id); 
				$data['mid'] = $mid;
				$this->load->view('edit_merchant_shops',$data);
			} 
			else 
			{
				$this->session->set_flashdata('L_strErrorMessage','No Such Attribute !!!!');
				redirect($this->config->item('base_url').'merchant_shops/lists/'.$mid);
			}
	}
	//first function calling after pressing coupan tab... 
	function lists($id)
	{
		
		
	    $this->session->set_userdata('m_id',$id);
		$this->load->library('pagination');
		$url_to_paging = $this->config->item('base_url');
		$config['base_url'] = $url_to_paging.'merchant_shops/lists/'.$id;
		$config['per_page'] = '10';
		$config['first_url']='0';
		$data = array();
		//using for searching data...
		$data['name'] = $this->input->post('name');
		$per_page = '1';
		$perpage = '3';
		//below is used in all perpose
		$return = $this->merchant_shops_model->list_user($id,$config['per_page'],$this->uri->segment(4),$data);
		$data['result'] = $return['result'];
		$config['total_rows'] = $return['count'];
		//echo "<pre>";print_r($data);break;
		$this->pagination->initialize($config);
	
		$this->load->view('list_merchant_shops',$data);
	}
	
	function deletes($id)
	{
		//echo $id; die;
		
		if(isset($_POST['selected']) && count($_POST['selected']) > 0) {
	
			foreach($_POST['selected'] as $selCheck) {
				if(!$this->merchant_shops_model->get_shop_id($selCheck)){
				if($this->merchant_shops_model->deletes($selCheck,$id)) {
					$this->session->set_flashdata('flashError','Register Shop Deleted Succcessfully!!!!');
				}  
				else 
				{
						$this->session->set_flashdata('flashError','Some Errors prevented from Deleting!!!!');
						break;
				}
				} 
				else{
						$this->session->set_flashdata('flashError','Could not delete Shop, its assigned to some deals.!!!!');
				}
			}
		}
		redirect($this->config->item('base_url').'merchant_shops/lists/'.$id);
	}
	/*function reguserenabled(){
		$this->merchant_shops_model->reguserenabled($this->input->post('id'),$this->input->post('enablestatus'));
		echo '1';die;
	}*/
	
	function userstatus($id,$mid,$value)
	{	
		
		$result=$this->merchant_shops_model->updatestatus($id,$value);
		$this->session->set_flashdata('L_strErrorMessage','Merchant Shop status Updated');
		redirect($this->config->item('base_url').'merchant_shops/lists/'.$mid);
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
		$planning = $this->merchant_shops_model->allusers();
		$output .= 'First name, Last name, Email, Phone, Username, Password, Join date ';
		$output .="\n";
		if($planning != '' && count($planning) > 0) {
		foreach($planning as $planning) {
		$output .= '"'.$planning->firstname.'","'.$planning->lastname.'","'.$planning->email.'","'.$planning->phone.'","'.$planning->username .'","'.$planning->password.'","'.$planning->joindate .'" ';  
		$output .="\n";
			}
		}
		$filename = "User_reports.csv";
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$filename);
		echo $output;
		exit;
	}
}
?>