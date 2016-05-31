<?php
class Admin extends CI_Model {
	private $_data = array();
	function __construct() {
		parent::__construct();
	}
	function check_login($data) {
		$where_array = array(
						'admin_email' => $data['username'],
						'admin_password' => $data['password'],
						'status' => '1',
				);
		$query = $this->db->get_where('deal_admin_user', $where_array);
		if ($query->num_rows() > 0)	{
			$row = $query->row();
			return $row;
		} else {
			return false;
		}
	}
	function getpswd($id)
	{
		$sql = "SELECT * FROM deal_admin_user where admin_id='".$id."' ";
		
		$query = $this->db->query($sql);

		if ($query->num_rows() > 0)
		{
			$result = $query->row()->admin_password;
			return $result;
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
	
	function password_edit($id, $content) {
		$data['admin_password']  = $content['password'];
		$this->_data = $data;
		$this->db->where('admin_id', $id);
		if ($this->db->update('deal_admin_user', $this->_data))	{
			return true;
		} else {
			return false;
		}
	}
	function followupdate(){
		$sql = "select * from followup where `added_date` = '".date('Y-m-d')."'";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	function todayenquiry(){
		$sql = "select * from enquiry where added_date = '".date('Y-m-d')."'";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	
	function list_customers()
	{
		$sql_count = "Select * from deal_customer";
		$query = $this->db->query($sql_count);
		$ret = $query->num_rows();
	    return $ret;	
	}		
	
	function currentuser()
	{		
	$sql = "select * from deal_customer order by customer_id desc limit 0,5";	
	$query = $this->db->query($sql);
	if ($query->num_rows() > 0)	{	
	$result = $query->result();
	return $result;		
	} else 
	{			
     return false;	
	}	
	}	
function list_merchant()	
{	
	$sql_count = "Select * from deal_merchant ";		
	$query = $this->db->query($sql_count);		
	$ret = $query->num_rows();	    return $ret;
	}	
	
	
	function list_admin()
	{	
	$sql_count = "Select * from deal_admin_user ";	
	$query = $this->db->query($sql_count);		
	$ret = $query->num_rows();	    return $ret;		}	 	
}
?>