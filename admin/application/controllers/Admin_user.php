<?php
class Admin_user extends CI_Controller {
	private $_data = array();
	function __construct()
	{
		parent::__construct();
		if($this->session->userdata('adminId') == ''){
			redirect($this->config->item('base_url'));
        }
		$this->load->model('admin_user_model');
		//$this->load->model('state_model');
		//$this->load->model('city_model');
	}
	
	function add()
	{
		//$L_strErrorMessage='';
	/*	$form_field = $data = array(  
				'L_strErrorMessage' => '',  
				'role_id'=>'',
				'admin_name' => '',
				'admin_email' => '',
				'admin_password' => '',
				'phone' => '',
				'status' => '',							 
			);
			
		if($this->input->post('action') == 'add_admin_user') 
		{
			foreach($form_field as $key => $value)
			{	
				$data[$key]=$this->input->post($key);	
				
			}
			$this->load->library('validation');
			$rules['admin_name'] = "trim|required";
			
			
			$this->validation->set_rules($rules);
			$fields['admin_name'] = "Admin Name";
			
			$this->validation->set_fields($fields);
			
			   if ($this->validation->run() == FALSE){
				$data['L_strErrorMessage'] = $this->validation->error_string;
			   } else {
				
					if(!$this->admin_user_model->is_users_already_exist_add($this->input->post('admin_email')))
					{
						if($response = $this->admin_user_model->add($data))
						{
					  
						$this->session->set_flashdata('L_strErrorMessage','Admin user added succcessfully!!!!');
						redirect($this->config->item('base_url').'admin_user/lists');
						}
						else 
						{
							$data['L_strErrorMessage'] = 'Some Errors prevented from adding data,please try later.';
						}
					}	
					else
					{
						$data['L_strErrorMessage'] = 'Register Admin User already exist!';
					}
			}
		}
	
			$data['allrole'] = $this->admin_user_model->allrole();
		//print_r($data);die;
		$this->load->view('add_admin_user',$data);*/
		//echo("ddf");die;
			
		
	
        $length=8;
		$pass=$this->generatePassword($length);

				
	
		/*$alreadyexists = $this->admin_user_model->is_users_already_exist_add($content['admin_email']);
		if($alreadyexists != ''){
			//$data['allcategory'] = $this->home_model->allcategory();
			//$data['allproducts'] = $this->home_model->allproducts();
			$data['err_msg'] = 'Email Id already Exists';
			$data['allrole'] = $this->admin_user_model->allrole();
			$this->load->view('add_admin_user',$data);
		}*/
	//	else
	//	{
			if($this->input->post("action")=="add_admin_user")
			{
				$content['role_id']  = $this->input->post("role_id");
		$content['admin_name']  = $this->input->post("admin_name");
		$content['admin_email']	  = $this->input->post("admin_email");
		$content['admin_password']  = $pass;
		$content['admin_mobile']  = $this->input->post("phone");
		
		$content['status'] = $this->input->post("status");
		$alreadyexists = $this->admin_user_model->is_users_already_exist_add($content['admin_email']);
		if($alreadyexists != ''){
			//$data['allcategory'] = $this->home_model->allcategory();
			//$data['allproducts'] = $this->home_model->allproducts();
			//$data['err_msg'] = 'Email Id already Exists';
			$this->session->set_flashdata('L_strErrorMessage','Email Id already Exists!!!');
			$data['allrole'] = $this->admin_user_model->allrole();
			$this->load->view('add_admin_user',$data);
		}
		else
		{
				$userid=$this->admin_user_model->add($content);
					
					$userdata = $this->admin_user_model->adminget(userid); 					
					$this->load->library('session');
						$newuserdata = array(
						'name'  => $userdata->admin_name,
					'email'  => $userdata->admin_email,
					'admin_id'    => $userdata->admin_id,
					//'typeofcompany'     => $userdata->typeofcompany,
					'logged_in' => true
					);
					//print_r($newuserdata);die;
					$check = $this->session->set_userdata($newuserdata);
			
			
				$message = '<div style="width:700px; height:auto; margin:0 auto;">
				
				
				<p>Dear '.$this->input->post("admin_name").' </p>
				<p>Welcome to Shoppin </p>
			    <p>Congratulations! You have successfully created your Account with Shoppin.in .</p>
			    <p>Your Login Details as below: </p>

				<table><tr>
				<td>Name:</td><td>'.$this->input->post("admin_name").'</td></tr>
				<tr><td>Email:</td><td>'.$this->input->post("admin_email").'</td></tr>
				<tr><td>Passoword:</td><td>'.$pass.'</td>
				<tr><td>Mobile:</td><td>'.$this->input->post("phone").'</td></tr>
				</table> 
				<div background:#1a76b9; border-radius:7px; font-size:16px; text-align:center; width:250px; padding:20px; margin:40px auto 0; border:1px solid #000000;>
				<p>Regards</p>
				<p>Shoppin</p>
               
				</div>
				 
				</div>
				';
 
				//echo($message);die;
				$to = $this->input->post('admin_email'); 
				$subject  = 'Thank you for Registering with shoppin.com ';  
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= 'From: shoppin.com<info@ibizsolutions.net>' . "\r\n" .
							'Reply-To: shoppin.com' . "\r\n" .
							'X-Mailer: PHP/' . phpversion();
				 
 				mail($to, $subject, $message, $headers);   
				//mail('amvisolution@gmail.com' , $subject, $message, $headers);
				$this->session->set_flashdata('L_strErrorMessage','Admin user added successfully!!!!');
						redirect($this->config->item('base_url').'admin_user/lists');


			}
		$data['allrole'] = $this->admin_user_model->allrole();
			$this->load->view('add_admin_user',$data);	
		}
	$data['allrole'] = $this->admin_user_model->allrole();
			$this->load->view('add_admin_user',$data);
	}
	
	function generatePassword($length) {
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $count = mb_strlen($chars);

    for ($i = 0, $result = ''; $i < $length; $i++) {
        $index = rand(0, $count - 1);
        $result .= mb_substr($chars, $index, 1);
    }

    return $result;
}
    function edit($id,$approval =false)
	{	 
			if(is_numeric($id))
			{
				$result = $this->admin_user_model->get_admin_user($id);  
				//print_r($result);die();
				$form_field = $data = array(
						'L_strErrorMessage' => '',
						'admin_id'	=> $result[0]->admin_id,
						'admin_role_id' => $result[0]->role_id,
						'admin_name' => $result[0]->admin_name,
						'admin_email' => $result[0]->admin_email,
						//'admin_password' => $result[0]->admin_password,	
						'phone' => $result[0]->admin_mobile,	
						'status' => $result[0]->status,	
						'approval'	=> $approval,						
						); 
			
				if($this->input->post('action') == 'edit_admin_user') 
				{
					foreach($data as $key => $value) {  $form_field[$key]=$this->input->post($key);	}
					
					$this->load->library('validation');
					$rules['admin_name'] = "trim|required";
					
  					$this->validation->set_rules($rules);
					$fields['admin_name']   = "admin_user Name";
					
				 
					$this->validation->set_fields($fields);
					if ($this->validation->run() == FALSE) {
					$data = $form_field;
					$data['L_strErrorMessage'] = $this->validation->error_string;
					$data['id'] = $id;

				} 
				else 
				{
					
					if(!$this->admin_user_model->is_users_already_exist($this->input->post('admin_email'),$id))
					{
						if($response = $this->admin_user_model->edit($id, $form_field)) {
						
							//$this->admin_user_model->edit($id, $form_field);
							if($this->input->post('approval')!=''){
								if($data['status']==1)
								$this->userstatus($id,0);
								else
								$this->userstatus($id,1);
							}
							$this->session->set_flashdata('L_strErrorMessage','Register Admin user updated successfully!!!!');
							redirect($this->config->item('base_url').'admin_user/lists');
					} else {
							$data['L_strErrorMessage'] = 'Some Errors prevented from update data,please try again later.';
						}
					}
					else
					{
						$data['L_strErrorMessage'] = 'Admin User or Email Id already exist!';
					}
				}
			}
		
				$data['allrole'] = $this->admin_user_model->allrole();
				$this->load->view('edit_admin_user',$data);
			} 
			else 
			{
				$this->session->set_flashdata('L_strErrorMessage','No Such Attribute !!!!');
				redirect($this->config->item('base_url').'admin_user/lists');
			}
	}
	function chngepassword() {
    $id = $this->session->userdata('adminId');
	$data['err_msg'] = '';
				$data['userget'] = $this->admin_user_model->adminget($id);
				$this->load->view('admin_change_password',$data);
	
}



function change_pwd()
	{
		$id = $this->session->userdata('adminId');
		//print_r($id);die;
		if(is_numeric($id)) {
			$result = $this->admin_user_model->adminget($id);
		//	print_r($result);die;
 			$form_field = $data = array(
						'L_strErrorMessage' => '',
						'id'	=> $result->admin_id,
						 
						'password' => $result->admin_password,
						'repassword'=>'',
						 
			);
			
			if($this->input->post('action') == 'change_password') {
				
				foreach($data as $key => $value) {  
					$form_field[$key] = $this->input->post($key);	
				}
					$this->load->library('validation');
				$rules['password']   = "password|Password|trim|required|matches[repassword]";
				$rules['repassword']   = "password|Password Confirmation|required";
				
				$this->validation->set_rules($rules);
				 
				$fields['password']   = "Password";
				$fields['repassword']   = "Password Confirmation";
				 
				
				
				$this->validation->set_fields($fields);

				if ($this->validation->run() == FALSE) {
					$data = $form_field;
					$data['L_strErrorMessage'] = $this->validation->error_string;
					$data['id'] = $id;
					//print_r($data['id']);die;
 				} 
				else 
				{
					//print_r($form_field);die;
					if($response = $this->admin_user_model->password_edit($id, $form_field)) {
							$this->session->set_flashdata('L_strErrorMessage','Password updated successfully!!!!');
							//$data['userget'] = $this->admin_user_model->adminget($id);
							$value=1;
									 $id = $this->session->userdata('adminId');
									$result=$this->admin_user_model->updateautogen_status($id,$value);
						redirect($this->config->item('base_url').'home');
						
					} else {
						$data['L_strErrorMessage'] = 'Some Errors prevented from update data,please try again later.';
					}
				}
			}
 
				$data['err_msg'] = '';
				$data['userget'] = $this->admin_user_model->adminget($id);
				$this->load->view('admin_change_password',$data);
	
			} else {
			
				$data['err_msg'] = '';
				 
				$data['userget'] = $this->admin_user_model->adminget($id);
				$this->load->view('admin_change_password',$data);
			}
	}
	function userstatus($id,$value)
	{	
	//print_r($id);die;
		$result=$this->admin_user_model->updatestatus($id,$value);
		$this->session->set_flashdata('L_strErrorMessage','Admin user status updated');
		redirect($this->config->item('base_url').'admin_user/lists');
		//$this->load->view('users/list_user', $data);
	}
	//first function calling after pressing coupan tab... 
	function lists()
	{
		$this->load->library('pagination');
		$url_to_paging = $this->config->item('base_url');
		
		$config['base_url'] = $url_to_paging.'admin_user/lists/';
		$config['per_page'] = '10000';
		$config['first_url']='0';
		$data = array();
		//using for searching data...
		$data['name'] = $this->input->post('name');
		$per_page = '1';
		$perpage = '3';
		//below is used in all perpose
		$return = $this->admin_user_model->list_user($config['per_page'],$this->uri->segment(3), $data);
		
		$data['result'] = $return['result'];
		$config['total_rows'] = $return['count'];
		//echo "<pre>";print_r($data);break;
		$this->pagination->initialize($config);
		$this->load->view('list_admin_user', $data);
	}
	
	
	function deletes()
	{
		if(isset($_POST['selected']) && count($_POST['selected']) > 0) {
	
			foreach($_POST['selected'] as $selCheck) {
				if($this->admin_user_model->deletes($selCheck)) {
					$this->session->set_flashdata('flashError','Register user deleted successfully!!!!');
				}  
				else 
				{
						$this->session->set_flashdata('flashError','Some Errors prevented from Deleting!!!!');
						break;
				}
			}
		}
		redirect($this->config->item('base_url').'admin_user/lists');
	}
	/*function reguserenabled(){
		$this->admin_user_model->reguserenabled($this->input->post('id'),$this->input->post('enablestatus'));
		echo '1';die;
	}*/
	function adminstatus($id)
	{	
		$result=$this->admin_user_model->updatestatus($id);
		$this->session->set_flashdata('L_strErrorMessage','Register admin user status updated');
		redirect($this->config->item('base_url').'admin_user/lists');
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
		$planning = $this->admin_user_model->allusers();
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