<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2009, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Session Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Sessions
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/libraries/sessions.html
 */
class CI_Footer {
	var $CI;

	function CI_Footer() {
			$this->CI =& get_instance();
	}

	/*function footercontent()
	{
		$sql = "SELECT * FROM tickets";
		$query = $this->CI->db->query($sql);

		return $query;
	}*/
	function getadmin($id)
	{
 	   	$sql = "SELECT * FROM  deal_admin_user where admin_id =".$id."";
		$query = $this->CI->db->query($sql);
		return $query->result();
 	}
	function userrole($id)
	{
 	   	$sql = "SELECT module_id FROM deal_role_module where role_id =".$id."";
		$query = $this->CI->db->query($sql);
		return $query->result();
 	}
	
	function model_name($id)
	{
 	   	$sql = "SELECT module_name FROM deal_module where module_id =".$id."";
		$query = $this->CI->db->query($sql);
		$result=$query->row();
		return $result->module_name;
 	}
}
// END Session Class

/* End of file Session.php */
/* Location: ./system/libraries/Session.php */