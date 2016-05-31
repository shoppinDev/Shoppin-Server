<?php
	class Deals_model extends CI_Model {
	private $_data = array();
	function __construct() {
		parent::__construct();
	}
	  
	function add($content) 
	{
		//print_r($content);die;
		$L_strErrorMessage='';
		$data['Merchant_id'] = $content['Merchant_id'];
		$data['shop_id'] = $content['Shop_id'];
		$data['deal_category'] = $content['deal_category'];
		$data['deal_subcategory'] = $content['deal_subcategory'];
		$data['deal_title'] = $content['deal_title'];
		$data['deal_description'] = $content['deal_description'];	
		$data['deal_startdate'] = $content['deal_startdate'];	
		$data['deal_enddate'] = $content['deal_enddate'];	
		$data['deal_amount'] = $content['deal_amount'];
					//$data['d_startdate'] = $content['d_startdate'];	
					//$data['d_enddate'] = $content['d_enddate'];
						if($content['all_days']!=''){	
					$data['all_days'] = implode(',',$content['all_days']);	
						} else {
							$data['all_days']='';
						}
					$data['deal_usage'] = $content['deal_usage'];	
					$data['location'] = $content['location'];	
					$data['discount_type'] = $content['discount_type'];	
					$data['discount_value'] = $content['discount_value'];	
		$data['is_active']='2';
		$data['added_date ']= date('Y-m-d');
		$this->_data = $data;
		//print_r($this->_data); die;
		if ($this->db->insert('deal_deals', $this->_data))	
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
		//print_r($content); die;
		$data['merchant_id'] = $content['merchant_id'];
		$data['shop_id'] = $content['Shop_id'];
		$data['deal_category'] = $content['deal_category'];
		$data['deal_subcategory'] =$content['deal_subcategory'];
		$data['deal_title'] = $content['deal_title'];
		$data['deal_description'] =$content['deal_description'];
		$data['deal_startdate'] =$content['deal_startdate'];
		$data['deal_enddate'] =$content['deal_enddate'];
		$data['deal_amount'] = $content['deal_amount'];
					//$data['d_startdate'] = $content['d_startdate'];	
					//$data['d_enddate'] = $content['d_enddate'];	
					$data['all_days'] = implode(',',$content['all_days']);	
					$data['deal_usage'] = $content['deal_usage'];	
					$data['location'] = $content['location'];	
					$data['discount_type'] = $content['discount_type'];	
					$data['discount_value'] = $content['discount_value'];	
		//$data['is_active'] =$content['is_active'];
		$this->_data = $data;
		$this->db->where('deal_id', $id);
		if ($this->db->update('deal_deals', $this->_data))	{
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
		
		$sql = "SELECT * FROM deal_deals where deal_id <> 0 ";
		if($content['deal_title'] != '') 
		{
			$sql .=	" AND  (deal_title like '%".$content['deal_title']."%' ) "; 
		}
		if($num!='' || $offset!='')
		{
			$sql .=	"  order by deal_id desc limit ".$offset." , ".$num." ";
		}
		//echo $sql; die;
		$query = $this->db->query($sql);
		
		
		
		$sql_count = "SELECT * FROM deal_deals  WHERE deal_id <> 0";
		if($content['deal_title'] !='')
		{
			$sql_count .= " AND `deal_title` like '".$content['deal_title']."%'";
		}
		$query1 = $this->db->query($sql_count);
		$ret['result'] = $query->result();
		$ret['count']  = $query1->num_rows();
	    return $ret;
	}
	
 
	
	function deletes($id) 
	{
 		$this->db->where('deal_id',$id);
		if ($this->db->delete('deal_deals'))	{
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
	
	function get_subcategoryname($id){
		$this->db->where('subcategory_id=',$id);
		$query = $this->db->get('deal_subcategory');
		if ($query->num_rows() > 0)	{
			$result = $query->result();
			//print_r($result); die;
			return $result[0]->subcategory_name;
		} else {
			return false;
		}
	}
	
	
	function get_merchant($id){
		$this->db->where('merchant_id=',$id);
		$query = $this->db->get('deal_merchant');
		if ($query->num_rows() > 0)	{
			$result = $query->result();
			//print_r($result); die;
			return $result[0]->merchant_name;
		} else {
			return false;
		}
	}
	
		function get_shop($id){
		$this->db->where('shop_id=',$id);
		$query = $this->db->get('deal_merchantshops');
		if ($query->num_rows() > 0)	{
			$result = $query->result();
			//print_r($result); die;
			return $result[0]->shop_name;
		} else {
			return false;
		}
	}
	
	
	
 	function get_deals_data($id){
		$this->db->where('deal_id=',$id);
		$query = $this->db->get('deal_deals');
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
	
	
	function allmerchant(){
		//echo($id);die();		
		$query = $this->db->get('deal_merchant');
		if ($query->num_rows() > 0)	{
			$result = $query->result();
			return $result;
		} else {
			return false;
		}
	}
	
function getall_subcategory($id){
	//echo $id; die;
		$this->db->where('category_id=',$id);
		$query = $this->db->get('deal_subcategory');
		if ($query->num_rows() > 0)	{
			$result = $query->result();
			//print_r($result); die;
			return $result;
		} else {
			return false;
		}
	}
	function get_dealid($id){
		$this->db->where('deal_id',$id);
		$query = $this->db->get('deal_order ');
		if ($query->num_rows() > 0)	{
			$result = $query->row();
			return $result;
		} else {
			return false;
		}
	}
	function get_dealid_save($id){
		$this->db->where('deal_id',$id);
		$query = $this->db->get('deal_saveddeals ');
		if ($query->num_rows() > 0)	{
			$result = $query->row();
			return $result;
		} else {
			return false;
		}
	}
	
	function get_shop_all($id){
	//echo $id; die;
		$this->db->where('merchant_id=',$id);
		$query = $this->db->get('deal_merchantshops');
		if ($query->num_rows() > 0)	{
			$result = $query->result();
			//print_r($result); die;
			return $result;
		} else {
			return false;
		}
	}
function updatestatus($id,$is_active)
{
	$sql= "update deal_deals set is_active = '".$is_active."' where deal_id='".$id."' ";
	//$query = $this->db->query($sql);
		if ($query = $this->db->query($sql))	{
			return true;
		} else {
			return false;
			}
}
}
?>