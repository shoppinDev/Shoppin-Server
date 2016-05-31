<?php
	class Module_model extends CI_Model {
	private $_data = array();
	function __construct() {
		parent::__construct();
	}
	function add($content) 
	{
		$L_strErrorMessage='';
		$data['module_name'] = $content['module_name'];
	
		
		$this->_data = $data;
		if ($this->db->insert('deal_module', $this->_data))	
		{		
		
			return true;
			 
		} 
		else 
		{
			return false;
		}
	}
		
	function edit($id, $content) 
	{
		//echo $id; die;
		$data['module_name'] = $content['module_name'];
		
		$this->_data = $data;
		$this->db->where('module_id', $id);
		if ($this->db->update('deal_module', $this->_data))	{
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
		
		$sql = "SELECT * FROM  deal_module where module_id <> 0 ";
		if($content['module_name'] != '') 
		{
			$sql .=	" AND  (module_name like '%".$content['module_name']."%' ) "; 
		}
		if($num!='' || $offset!='')
		{
			$sql .=	"  order by module_id desc limit ".$offset." , ".$num." ";
		}
		
		$query = $this->db->query($sql);
		
		
		
		$sql_count = "SELECT * FROM deal_module  WHERE module_id <> 0";
		if($content['module_name'] !='')
		{
			$sql_count .= " AND `module_name` like '".$content['module_name']."%'";
		}
		$query1 = $this->db->query($sql_count);
		$ret['result'] = $query->result();
		$ret['count']  = $query1->num_rows();
	    return $ret;
	}
	
 
	
	function deletes($id) 
	{
 		$this->db->where('module_id = ',$id);
		if ($this->db->delete('deal_module'))	{
			return true;
		} else {
			return false;
		}
	}
	
	function get_category($id){
		$this->db->where('module_id = ',$id);
		$query = $this->db->get('deal_module');
		if ($query->num_rows() > 0)	{
			$result = $query->result();
			return $result;
		} else {
			return false;
		}
	}
	
	function allcategory(){
		//echo($id);die();		
		$query = $this->db->get('category');
		if ($query->num_rows() > 0)	{
			$result = $query->result();
			return $result;
		} else {
			return false;
		}
	}
	function get_role_model($id){
		//echo($id);die();		
		$this->db->where('module_id',$id);
		$query = $this->db->get('deal_role_module');
		if ($query->num_rows() > 0)	{
			$result = $query->result();
			return $result;
		} else {
			return false;
		}
	}
}
?>