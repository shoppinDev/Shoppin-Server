<?php
	class Category_model extends CI_Model {
	private $_data = array();
	function __construct() {
		parent::__construct();
	}
	  
	function add($content) 
	{
		$L_strErrorMessage='';
		$data['category_name'] = $content['category_name'];
	
		
		$this->_data = $data;
		if ($this->db->insert('deal_category', $this->_data))	
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
		$data['category_name'] = $content['category_name'];
		
		$this->_data = $data;
		$this->db->where('category_id', $id);
		if ($this->db->update('deal_category', $this->_data))	{
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
		
		$sql = "SELECT * FROM  deal_category where category_id <> 0 ";
		if($content['categoryname'] != '') 
		{
			$sql .=	" AND  (category_name like '%".$content['categoryname']."%' ) "; 
		}
		if($num!='' || $offset!='')
		{
			$sql .=	"  order by category_id desc limit ".$offset." , ".$num." ";
		}
		
		$query = $this->db->query($sql);
		
		
		
		$sql_count = "SELECT * FROM deal_category  WHERE category_id <> 0";
		if($content['categoryname'] !='')
		{
			$sql_count .= " AND `category_name` like '".$content['categoryname']."%'";
		}
		$query1 = $this->db->query($sql_count);
		$ret['result'] = $query->result();
		$ret['count']  = $query1->num_rows();
	    return $ret;
	}
	
 
	
	function deletes($id) 
	{
 		$this->db->where('category_id = ',$id);
		if ($this->db->delete('deal_category'))	{
			return true;
		} else {
			return false;
		}
	}
	
	function get_category($id){
		$this->db->where('category_id = ',$id);
		$query = $this->db->get('deal_category');
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
	
	
		function get_subcategory_id($id){
		$this->db->where('category_id',$id);
		$query = $this->db->get('deal_subcategory');
		if ($query->num_rows() > 0)	{
			$result = $query->row();
			return $result;
		} else {
			return false;
		}
	}
}
?>