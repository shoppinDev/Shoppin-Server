<?php	
class Customer_model extends CI_Model {
	private $_data = array();
	function __construct() {
		parent::__construct();
	}

	function get_user($id){

		$this->db->where('customer_id = ',$id);
		$query = $this->db->get('deal_customer');
		if ($query->num_rows() > 0)	{
			$result = $query->result();
			return $result;
		} else {
			return false;
		}
	}

	function add($content) 
	{
		$data['customer_name'] = $content['username'];
		$data['customer_email'] = $content['email'];
		$data['customer_password'] = $content['password'];
		$data['customer_mobile'] = $content['phone'];
		$data['is_active'] = $content['active'];			
		$data['added_date ']  = date('Y-m-d');
	
				
		$this->_data = $data;
		if ($this->db->insert('deal_customer', $this->_data))	{
			return true;
		} else {
			return false;
		}
	}
	function utype_list()
		{
			$sql   = " select * from  usercategory";
			$query = $this->db->query($sql);
			return $query->result();
		}

	function edit($id, $content) {
	//	$data['firstname']  = $content['firstname'];
	//	$data['lastname']  = $content['lastname'];
		$data['customer_name'] = $content['customer_name'];
  		$data['customer_email'] = $content['customer_email'];	
		$data['customer_password'] = $content['customer_password'];
		$data['customer_mobile'] = $content['customer_mobile'];
		$data['is_active'] = $content['is_active'];
	/*	$data['dob'] = $content['dob'];
		$data['company'] = $content['company'];
		$data['website'] = $content['website'];
		$data['state'] = $content['state'];
		$data['city'] = $content['city'];
		$data['address'] = $content['address'];*/
		
	        $this->_data = $data;
		$this->db->where('customer_id', $id);
		if ($this->db->update('deal_customer', $this->_data))	{
			return true;
		} else {
			return false;
		}
	}

        function useredit($id, $content) {
		$data['name']  = $content['name'];
		$data['email']  = $content['email'];
		$data['mobile']  = $content['mobile'];
		$data['agency_name'] = $content['agency_name'];
		$data['contact_no'] = $content['contact_no']; 
		$data['designation'] = $content['designation'];
		$data['office'] = $content['office'];
		$data['email2'] = $content['email2'];
		$data['email3'] = $content['email3'];
		$data['email4'] = $content['email4'];
		$data['land_line'] = $content['land_line'];
		$data['IATA'] = $content['IATA'];
		$data['startdate'] = $content['startdate'];
		$data['enddate'] = $content['enddate'];

	        $this->_data = $data;
		$this->db->where('id', $id);
		if ($this->db->update('user', $this->_data))	{
			return true;
		} else {
			return false;
		}
	}

	function is_users_already_exist_add($regusers)
	{
		$sql ="SELECT * FROM deal_customer WHERE (customer_email ='".$regusers."')";
		$query = $this->db->query($sql);
		$fsql = $query->num_rows();
		if($fsql > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
		
	}
 
	function is_users_already_exist($regusers,$ccid)
	{
		$sql ="SELECT * FROM deal_customer WHERE ( customer_email ='".$regusers."'  AND customer_id != '".$ccid."')";
		 $query = $this->db->query($sql);
		if ($query->num_rows() > 0)	
		{
			return true;
		}
		else
		{
			return false;
		}
	}



	function allusers(){
		
 		$query = $this->db->get('users');
		if ($query->num_rows() > 0)	{
			$result = $query->result();
			return $result;
		} else {
			return false;
		}
	}
	function admin_user($id){
		
 		$this->db->where('id',$id);
		$query = $this->db->get('users');
		if($query->num_rows() > 0)
		{
			$result = $query->result();
 			return $result;
		}
		else
		{
			return false;
		}
	}

         function agentedit($id){
		
 		$this->db->where('id',$id);
		$query = $this->db->get('user');
		if($query->num_rows() > 0)
		{
			$result = $query->result();
 			return $result;
		}
		else
		{
			return false;
		}
	}
	

	function list_user($num, $offset, $content) {
		
		if($offset == ''){
			$offset = '0';
		}
		$sql = "SELECT * FROM deal_customer where customer_id <> 0 ";
		if($content['customer_name'] != '') 
		{
			$sql .=	" AND  (customer_name like '".$content['customer_name']."%' ) "; 
		}
		if($content['customer_email'] != '') 
		{
			$sql .=	" AND  (customer_email like '".$content['customer_email']."%' ) "; 
		}
		if($content['customer_mobile'] != '') 
		{
			$sql .=	" AND  (customer_mobile like '".$content['customer_mobile']."%' ) "; 
		}
		if($num!='' || $offset!='')
		{
			$sql .=	" order by customer_id desc limit ".$offset.",".$num."";
		}
		else
		{
			$sql .=	" order by customer_id desc";
		}

		$query = $this->db->query($sql);
		
		$ret['result'] = $query->result();
		
		$sql_count = "SELECT * FROM deal_customer where customer_id <> 0  ";
		if($content['customer_name'] != '') 
		{
			$sql_count .=	" AND  (customer_name like '".$content['customer_name']."%' ) "; 
		}
		if($content['customer_email'] != '') 
		{
			$sql_count .=	" AND  (customer_email like '".$content['customer_email']."%' ) "; 
		}
		if($content['customer_mobile'] != '') 
		{
			$sql_count .=	" AND  (customer_mobile like '".$content['customer_mobile']."%' ) "; 
		}
		$query1 = $this->db->query($sql_count);
		
		$ret['count']  = $query1->num_rows();
	    return $ret;
	}
	
	function regusers($num, $offset, $content) 
	{
		
		if($offset == ''){
			$offset = '0';
		}
		$sql = "SELECT * FROM `user` where id <> 0  ";
		if($content['fname'] != '') 
		{
			$sql .=	" AND  (fname like '%".$content['fname']."%' ) "; 
		}
		if($content['lname'] != '') 
		{
			$sql .=	" AND  (lname like '%".$content['lname']."%' ) "; 
		}
		if($content['email'] != '') 
		{
			$sql .=	" AND  (email like '%".$content['email']."%' ) "; 
		}
		if($num!='' || $offset!='')
		{
			$sql .=	" order by id desc limit ".$offset.",".$num."";
		}
		else
		{
			$sql .=	" order by id desc";
		}
//echo $sql;die;
		$query = $this->db->query($sql);


		$sql_couint = "SELECT * FROM `user` where id <> 0 ";
		if($content['fname'] != '') 
		{
			$sql_couint .=	" AND  (fname like '%".$content['fname']."%' ) "; 
		}
		if($content['lname'] != '') 
		{
			$sql_couint .=	" AND  (lname like '%".$content['lname']."%' ) "; 
		}
		if($content['email'] != '') 
		{
			$sql_couint .=	" AND  (email like '%".$content['email']."%' ) "; 
		}
		
 		$query1 = $this->db->query($sql_couint);

		$ret['result'] = $query->result();
		$ret['count']  = $query1->num_rows;
	    return $ret;
	}
	function deletes($id) 
	{
		$adid=$this->session->userdata('adminId');
		$sql = "Delete from deal_customer where customer_id=".$id;
		if ($this->db->query($sql))	
		{
			return true;
		} else {
			return false;
		}
	}
	
	function deletesuser($id) 
	{
		 
		$sql = "Delete from deal_customer where customer_id=".$id;
		if ($this->db->query($sql))	
		{
			return true;
		} else {
			return false;
		}
	}
	
	function deletess($id) 
	{
		$adid=$this->session->userdata('adminId');
		$sql = "Delete from user where id=".$id;
		if ($this->db->query($sql))	
		{
			return true;
		} else {
			return false;
		}
	}

	function total_jobs()
	{
		$sql_count = "Select * from jobs ";
		$query = $this->db->query($sql_count);
		$ret = $query->num_rows();
	    return $ret;	
	}
	function total_user()
	{
		$sql_count = "Select * from user ";
		$query = $this->db->query($sql_count);
		$ret = $query->num_rows();
	    return $ret;	
	}


	function appliedjobs()
	{
		$sql   = " select * from applyjob";
		$query = $this->db->query($sql);
		$ret = $query->num_rows();
	   	 return $ret;
	}
	/*function updatestatus($id)
	{
		$sta=$this->get($id);
		if(($sta[0]->status)==0)
		{
			$data['status']  = '1';
		}
		else
		{
			$data['status']  = '0';
		}
		$this->_data = $data;
		$this->db->where('id', $id);
		if ($this->db->update('user', $this->_data))	{
			return true;
		} else {
			return false;
		}
	}*/
	function get($id){

		$this->db->where('id = ',$id);
		$query = $this->db->get('user');
		if ($query->num_rows() > 0)	{
			$result = $query->result();
			return $result;
		} else {
			return false;
		}
	}
	
/*function reguserenabled($id,$enable){
		if($enable=='0'){
			$data['enable'] = '1';
		}else{
			$data['enable'] = '0';
		}
		 
		
	        $this->_data = $data;
		$this->db->where('id', $id);
		if ($this->db->update('users', $this->_data))	{
			return true;
		} else {
			return false;
		}
	}
	*/
function updatestatus($id,$is_active)
{
	$sql= " update deal_customer set is_active = '".$is_active."' where customer_id='".$id."' ";
	//$query = $this->db->query($sql);
		if ($query = $this->db->query($sql))	{
			return true;
		} else {
			return false;
			}
	/*		
	$sql   = " select * from deal_customer where customer_id='".$id."'";
	$query = $this->db->query($sql);
	$ret=$query->row();
	if($ret->is_active == "1")
	{
		$abc= " update deal_customer set is_active = '0' where customer_id='".$id."' ";
		$query = $this->db->query($abc);
		return $query;
	}
	else
	{
		$abc= " update deal_customer set is_active = '1' where customer_id='".$id."' ";
		$query = $this->db->query($abc);
		return $query;
	}*/
}

}
?>