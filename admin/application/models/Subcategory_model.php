<?php
	class Subcategory_model extends CI_Model {
	private $_data = array();
	function __construct() {
		parent::__construct();
	}
	  
	function add($content) 
	{
		//print_r($content);die;
		$L_strErrorMessage='';
		$data['category_id'] = $content['category_id'];
		$data['subcategory_name'] = $content['subcategory_name'];	
		$this->_data = $data;
		if ($this->db->insert('deal_subcategory', $this->_data))	
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
		
		$data['subcategory_name'] = $content['subcategory_name'];
		$data['category_id'] = $content['category_id'];
		$this->_data = $data;
		$this->db->where('subcategory_id', $id);
		if ($this->db->update('deal_subcategory', $this->_data))	{
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
		
		$sql = "SELECT * FROM deal_subcategory where subcategory_id <> 0 ";
		if($content['subcategory_name'] != '') 
		{
			$sql .=	" AND  (subcategory_name like '%".$content['subcategory_name']."%' ) "; 
		}
		if($num!='' || $offset!='')
		{
			$sql .=	"  order by subcategory_id desc limit ".$offset." , ".$num." ";
		}
		
		$query = $this->db->query($sql);
		
		
		
		$sql_count = "SELECT * FROM deal_subcategory  WHERE subcategory_id <> 0";
		if($content['subcategory_name'] !='')
		{
			$sql_count .= " AND `subcategory_name` like '".$content['subcategory_name']."%'";
		}
		$query1 = $this->db->query($sql_count);
		$ret['result'] = $query->result();
		$ret['count']  = $query1->num_rows();
	    return $ret;
	}
	
 
	
	function deletes($id) 
	{
 		$this->db->where('subcategory_id',$id);
		if ($this->db->delete('deal_subcategory'))	{
			return true;
		} else {
			return false;
		}
	}
	
	function get_categoryname($id){
		$this->db->where('category_id =',$id);
		$query = $this->db->get('deal_category');
		if ($query->num_rows() > 0)	{
			$result = $query->result();
			//print_r($result); die;
			return $result[0]->category_name;
		} else {
			return false;
		}
	}
	
 	function get_subcategory($id){
		$this->db->where('subcategory_id=',$id);
		$query = $this->db->get('deal_subcategory');
		if ($query->num_rows() > 0)	{
			$result = $query->result();
			//print_r($result); die;
			return $result;
		} else {
			return false;
		}
	}
 
	function allcategory(){
		//echo($id);die();		
		$query = $this->db->get('deal_category');
		if ($query->num_rows() > 0)	{
			$result = $query->result();
			return $result;
		} else {
			return false;
		}
	}
	function get_deal_id($id){
		$this->db->where('deal_subcategory',$id);
		$query = $this->db->get('deal_deals');
		if ($query->num_rows() > 0)	{
			$result = $query->row();
			return $result;
		} else {
			return false;
		}
	}
}
?>