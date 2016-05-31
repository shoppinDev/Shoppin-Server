<?php	
class Admin_user_model extends CI_Model {
	private $_data = array();
	function __construct() {
		parent::__construct();
	}

	function get_admin_user($id){

		$this->db->where('admin_id = ',$id);
		$query = $this->db->get('deal_admin_user');
		if ($query->num_rows() > 0)	{
			$result = $query->result();
			return $result;
		} else {
			return false;
		}
	}
function adminget($id)
   	{
		$this->db->where('admin_id = ',$id);
    	$query = $this->db->get('deal_admin_user');
   		if ($query->num_rows() > 0)	{
   			$result = $query->row();
   			return $result;
   		} else {
   			return false;
   		}
   	}
	function getpswd($id)
	{
		//print_r($id);die;
		$sql = "SELECT * FROM deal_admin_user where admin_id='".$id."' ";
		
		$query = $this->db->query($sql);

		if ($query->num_rows() > 0)
		{
			$result = $query->row()->admin_password;
			return $result;
		}
	
	}
	function updateautogen_status($id,$is_active)
{
	$sql= " update deal_admin_user set autogen_status = '".$is_active."' where admin_id='".$id."' ";
	
		if ($query = $this->db->query($sql))	{
			return true;
		} else {
			return false;
			}
	
}
	function password_edit($id, $content) {
		//print_r($content);die;
		$data['admin_password']  = $content['password'];
		$this->_data = $data;
		$this->db->where('admin_id', $id);
		if ($this->db->update('deal_admin_user', $this->_data))	{
			return true;
		} else {
			return false;
		}
	}
	function add($content) 
	{
		$data['role_id'] = $content['role_id'];
		$data['admin_name'] = $content['admin_name'];
		$data['admin_email'] = $content['admin_email'];
		$data['admin_password'] = $content['admin_password'];
		$data['admin_mobile'] = $content['admin_mobile'];
		$data['status'] = $content['status'];			
		$data['added_date']  = date('Y-m-d');
		$this->db->insert('deal_admin_user',$data);

		return $this->db->insert_id();
		//$this->_data = $data;
		//if ($this->db->insert('deal_admin_user', $this->_data))	{
			   // $last_id = $this->db->insert_id();
			//return  $last_id;
		//} else {
			return false;
		//}
	}


	function edit($id, $content) {
		$data['role_id'] = $content['admin_role_id'];
  		$data['admin_name'] = $content['admin_name'];	
		$data['admin_email'] = $content['admin_email'];
		//$data['admin_password'] = $content['admin_password'];
		$data['admin_mobile'] = $content['phone'];
		//$data['status'] = $content['status'];	
	        $this->_data = $data;
		$this->db->where('admin_id', $id);
		if ($this->db->update('deal_admin_user', $this->_data))	{
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

	function is_users_already_exist_add($admin_email)
	{
		$sql ="SELECT * FROM deal_admin_user WHERE (admin_email ='".$admin_email."')";
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
		$sql ="SELECT * FROM deal_admin_user WHERE (admin_email ='".$regusers."'  AND admin_id != '".$ccid."')";
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



	function allrole(){
		
 		$query = $this->db->get('deal_role');
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

		$sql = "SELECT * FROM deal_admin_user where admin_id <> 0 ";
		if($content['name'] != '') 
		{
			$sql .=	" AND  (admin_name like '".$content['name']."%' ) "; 
		}
		if($num!='' || $offset!='')
		{
			$sql .=	" order by admin_id desc limit ".$offset.",".$num."";
		}
		else
		{
			$sql .=	" order by admin_id desc";
		}

		$query = $this->db->query($sql);
		
		$ret['result'] = $query->result();
		
		$sql_count = "SELECT * FROM deal_admin_user where admin_id <> 0  ";
		if($content['name'] != '') 
		{
			$sql_count .=	" AND  (admin_name like '".$content['name']."%' ) "; 
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
		$sql = "Delete from deal_admin_user where admin_id=".$id;
		if ($this->db->query($sql))	
		{
			return true;
		} else {
			return false;
		}
	}
	
	function deletesuser($id) 
	{
		 
		$sql = "Delete from deal_admin_user where admin_id=".$id;
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
	$sql= " update deal_admin_user set status = '".$is_active."' where admin_id='".$id."' ";
	//$query = $this->db->query($sql);
		if ($query = $this->db->query($sql))	{
			return true;
		} else {
			return false;
			}
	
}
	 function updatestatus1($id)
{
	$sql   = " select * from deal_admin_user where admin_id='".$id."'";
	$query = $this->db->query($sql);
	$ret=$query->row();
	if($ret->status== "1")
	{
		$abc= " update deal_admin_user set status = '0' where admin_id='".$id."' ";
		$query = $this->db->query($abc);
		return $query;
	}
	else
	{
		$abc= " update deal_admin_user set status= '1' where admin_id='".$id."' ";
		$query = $this->db->query($abc);
		return $query;
	}
}

	function get_role($id){
		
 		$this->db->where('role_id',$id);
		$query = $this->db->get('deal_role');
		if($query->num_rows() > 0)
		{
			$result = $query->result();
 			return $result[0]->role_name;
		}
		else
		{
			return false;
		}
	}

}
?>