<?php	
class Merchant_shops_model extends CI_Model {
	private $_data = array();
	function __construct() {
		parent::__construct();
	}

	function get_shop($id,$mid){

	   $this->db->where('merchant_id = ',$mid);
		$this->db->where('shop_id = ',$id);
		$query = $this->db->get('deal_merchantshops');
		if ($query->num_rows() > 0)	{
			$result = $query->result();
			return $result;
		} else {
			return false;
		}
	}

	function add($content) 
	{
		//print_r($content); die;
		$data['merchant_id'] = $content['merchant_id'];
		$data['shop_name'] = $content['shopname'];
		$data['shop_addres'] = $content['Shop_address'];
		$data['shop_latitude'] = $content['Latitude'];
		$data['shop_longitude'] = $content['Longitude'];
		//$data['shop_email'] = $content['email'];
		$data['shop_mobile'] = $content['phone'];
			//$data['shop_add'] = $content['shop_add'];
			$data['shop_city'] = $content['shop_city'];
			$data['shop_state'] = $content['shop_State'];
			$data['shop_zip'] = $content['shop_zip'];
			$data['shop_country'] = $content['shop_country'];
		$data['is_active'] = '2';			
		$data['added_date']  = date('Y-m-d');
	
				
		$this->_data = $data;
		if ($this->db->insert('deal_merchantshops', $this->_data))	{
			return $this->db->insert_id();
		} else {
			return false;
		}
	}
function add_qrcode($content) 
	{
		$id= $content['id'];	
		$data['qr_image'] = $content['image'];
		$this->_data = $data;
		$this->db->where('shop_id',$id);
		if ($this->db->update('deal_merchantshops', $this->_data))	{
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

	function edit($id,$content) {
		
		$data['shop_name'] = $content['shop_name'];	
		$data['shop_addres'] = $content['shop_addres'];
		$data['shop_latitude'] = $content['shop_latitude'];
		$data['shop_longitude'] = $content['shop_longitude'];
  		//$data['shop_email'] = $content['shop_email'];	
		$data['shop_mobile'] = $content['shop_mobile'];
		//$data['shop_add'] = $content['shop_add'];
			$data['shop_city'] = $content['shop_city'];
			$data['shop_State'] = $content['shop_State'];
			$data['shop_zip'] = $content['shop_zip'];
			$data['shop_country'] = $content['shop_country'];
		//$data['is_active'] = $content['is_active'];
	    $this->_data = $data;
		$this->db->where('shop_id',$id);
		if ($this->db->update('deal_merchantshops', $this->_data))	{
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
		$sql ="SELECT * FROM  deal_merchantshops WHERE (shop_email ='".$regusers."')";
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
		$sql ="SELECT * FROM deal_merchantshops WHERE (shop_email ='".$regusers."'  AND shop_id != '".$ccid."')";
		//echo $sql; die;
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
	
	function list_user($id,$num, $offset, $content) 
	{
		//echo $offset; die;
		if($offset == ''){
			$offset = '0';
		}
		$sql = "SELECT * FROM deal_merchantshops where merchant_id =".$id;
		if($content['name'] != '') 
		{
			$sql .=	" AND  (shop_name like '".$content['name']."%' ) "; 
		}
		if($num!='' || $offset!='')
		{
			$sql .=	" order by shop_id desc limit ".$offset.",".$num."";
		}
		else
		{
			$sql .=	" order by shop_id desc";
		}
 //echo $sql; die;
		$query = $this->db->query($sql);
		$ret['result'] = $query->result();	
//	print_r($ret['result']);die;
		$sql_count = "SELECT * FROM deal_merchantshops where merchant_id =".$id;
		if($content['name'] != '') 
		{
			$sql_count .=	" AND  ( 	 like '".$content['name']."%' ) "; 
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
	function deletes($id,$mid) 
	{ 
		$adid=$this->session->userdata('adminId');
		$sql = "Delete from  deal_merchantshops where shop_id=".$id." and merchant_id=".$mid;
		if ($this->db->query($sql))	
		{
			return true;
		} else {
			return false;
		}
	}
	
	function deletesuser($id) 
	{
		 
		$sql = "Delete from deal_merchant where customer_id=".$id;
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
		$sql = "Delete from deal_merchantshops where id=".$id;
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
	$sql= "update deal_merchantshops set is_active = '".$is_active."' where shop_id='".$id."' ";
	//$query = $this->db->query($sql);
		if ($query = $this->db->query($sql))	{
			return true;
		} else {
			return false;
			}
			/*
	$sql   = "select * from   deal_merchantshops where shop_id ='".$id."'";
	$query = $this->db->query($sql);
	$ret=$query->row();
	if($ret->is_active == "1")
	{
		$abc= " update deal_merchantshops set is_active = '0' where shop_id='".$id."' ";
		$query = $this->db->query($abc);
		return $query;
	}
	else
	{
		$abc= " update deal_merchantshops set is_active = '1' where shop_id='".$id."' ";
		$query = $this->db->query($abc);
		return $query;
	}*/
}

function get_shop_id($id){
		$this->db->where('shop_id',$id);
		$query = $this->db->get('deal_deals');
		if ($query->num_rows() > 0)	{
			$result = $query->row();
			return $result;
		} else {
			return false;
		}
	}
	
function get_merchant_name($id){
		$this->db->where('merchant_id',$id);
		$query = $this->db->get('deal_merchant');
		if ($query->num_rows() > 0)	{
			$result = $query->row();
			return $result->merchant_name;
		} else {
			return false;
		}
	}
}
?>