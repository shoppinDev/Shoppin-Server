<?php
	class Role_model extends CI_Model {
	private $_data = array();
	function __construct() {
		parent::__construct();
	}
	  
	function add($content) 
	{
		$L_strErrorMessage='';
		$data['role_name'] = $content['role_name'];
		//$data['module_id'] =$content['module_id']; 
		//print_r($data); die;
		$this->_data = $data;
		if ($this->db->insert('deal_role', $this->_data))	
		{		
		 $last_id = $this->db->insert_id();
		     if($content['module_id']!="")
					   {
								foreach($content['module_id'] as $module_id) 
								{ 	
									$data_model['role_id']=$last_id;
									$data_model['module_id']=$module_id;   
								       $this->_data = $data_model;
									if ($this->db->insert('deal_role_module',$this->_data))	
										{
											
										}	
								}
					   }
			return true;
			 
		} 
		else 
		{
			return false;
		}
	}
		
	function edit($id, $content) 
	{
	//	print_r($content); die;
		$data['role_name'] = $content['role_name'];
		$this->_data = $data;
		$this->db->where('role_id', $id);
		if ($this->db->update('deal_role', $this->_data)){
					$this->db->where('role_id',$id);
					$this->db->delete('deal_role_module');
								foreach($content['module_id'] as $module_id) 
								{ 	
									$data_model['role_id']=$id;
									$data_model['module_id']=$module_id;   
								       $this->_data = $data_model;
									if ($this->db->insert('deal_role_module',$this->_data))	
										{
											
										}	
								}
			
			
			return true;
		} else {
			return false;
		}
	}
    function lists($num, $offset, $content) 
	{
		
		if($offset == '')
		{
			$offset = '0';
		}
		
		$sql = "SELECT * FROM   deal_role where role_id <> 0 ";
		if($content['role_name'] != '') 
		{
			$sql .=	" AND  (role_name like '%".$content['role_name']."%' ) "; 
		}
		if($num!='' || $offset!='')
		{
			$sql .=	"  order by role_id desc limit ".$offset." , ".$num." ";
		}
		
		$query = $this->db->query($sql);
		
		
		
		$sql_count = "SELECT * FROM  deal_role  WHERE role_id <> 0";
		if($content['role_name'] !='')
		{
			$sql_count .= " AND `role_name` like '".$content['role_name']."%'";
		}
		$query1 = $this->db->query($sql_count);
		$ret['result'] = $query->result();
		$ret['count']  = $query1->num_rows();
	    return $ret;
	}
	
 
	
	function deletes($id) 
	{
 		$this->db->where('role_id',$id);
		if ($this->db->delete('deal_role'))	{
			return true;
		} else {
			return false;
		}
	}
	
	function get_roll($id){
		$this->db->where('role_id = ',$id);
		$query = $this->db->get('deal_role');
		if ($query->num_rows() > 0)	{
			$result = $query->result();
			return $result;
		} else {
			return false;
		}
	}
	function all_module(){
		//echo($id);die();		
		$query = $this->db->get('deal_module');
		if ($query->num_rows() > 0)	{
			$result = $query->result();
			return $result;
		} else {
			return false;
		}
	}
		function get_roll_module($id,$roleid){
		$this->db->where('role_id',$roleid);
		$this->db->where('module_id',$id);
		$query = $this->db->get('deal_role_module');
		if ($query->num_rows() > 0)	{
			$result = $query->row();
			return $result->module_id;
		} else {
			return false;
		}
	}
		
	function get_role_id($id){
		$this->db->where('role_id',$id);
		$query = $this->db->get('deal_role_module');
		if ($query->num_rows() > 0)	{
			$result = $query->row();
			return $result;
		} else {
			return false;
		}
	}
}
?>