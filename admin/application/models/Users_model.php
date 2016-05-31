<?php	
class Users_model extends CI_Model {
	private $_data = array();
	function __construct() {
		parent::__construct();
	}

	function get_user($id){

		$this->db->where('id = ',$id);
		$query = $this->db->get('super_admin');
		if ($query->num_rows() > 0)	{
			$result = $query->result();
			return $result;
		} else {
			return false;
		}
	}

	function add($content) 
	{
		$data['name']  = $content['name'];
		$data['login']  = $content['login'];
		$data['password'] = $content['password'];
		$data['email'] = $content['email'];
		$data['created_by'] = $this->session->userdata('username') ;
		$data['enabled'] = 1;
		$data['ucategory'] = $content['ucategory']; 
		$data['enabled'] = $content['enabled'];  

		$this->_data = $data;
		if ($this->db->insert('super_admin', $this->_data))	{
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
		$data['name']  = $content['name'];
		$data['login']  = $content['login'];
		$data['password']  = $content['password'];
		$data['email'] = $content['email'];
		$data['ucategory'] = $content['ucategory']; 
		$data['enabled'] = $content['enabled']; 
	        $this->_data = $data;
		$this->db->where('id', $id);
		if ($this->db->update('super_admin', $this->_data))	{
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

	function is_users_already_exist_add($users)
	{
		
		$sql = mysql_query("SELECT * FROM super_admin WHERE (email='".$users."') ");
		$fsql = mysql_num_rows($sql);
		if($fsql > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
		
	}
 
	function is_users_already_exist($users,$ccid)
	{
		$sql ="SELECT * FROM super_admin WHERE ( login='".$users."'  AND id != '".$ccid."')";
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
		
 		$query = $this->db->get('super_admin');
		if ($query->num_rows() > 0)	{
			$result = $query->result();
			return $result;
		} else {
			return false;
		}
	}
	function admin_user($id){
		
 		$this->db->where('id',$id);
		$query = $this->db->get('super_admin');
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

		$sql = "SELECT * FROM super_admin where id <> 0 ";
		if($content['name'] != '') 
		{
			$sql .=	" AND  (name like '".$content['name']."%' ) "; 
		}
		if($num!='' || $offset!='')
		{
			$sql .=	" order by id desc limit ".$offset.",".$num."";
		}
		else
		{
			$sql .=	" order by id desc";
		}

		$query = $this->db->query($sql);
		
		$ret['result'] = $query->result();
		
		$sql_count = "SELECT * FROM super_admin   where id <> 0  ";
		if($content['name'] != '') 
		{
			$sql_count .=	" AND  (name like '".$content['name']."%' ) "; 
		}
		
		$query1 = $this->db->query($sql_count);
		
		$ret['count']  = $query1->num_rows();
	    return $ret;
	}
	
	function users($num, $offset, $content) 
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
		$sql = "Delete from super_admin where id=".$id;
		if ($this->db->query($sql))	
		{
			return true;
		} else {
			return false;
		}
	}
	
	function deletesuser($id) 
	{
		 
		$sql = "Delete from user where id=".$id;
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
	function updatestatus($id)
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
	}
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
}
?>