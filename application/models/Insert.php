<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Insert extends CI_Model
{
	public function insert_data($table,$columns,$values,$where_condition=false,$where_part=null)
	{
		$sql;
		if($where_condition)
		{
			$sql = "INSERT INTO $table ($columns) 
			VALUES ?
			WHERE $where_part";
			$this->db->query($sql,array($values));
		}
		else
		{
			$sql = "INSERT INTO $table ($columns)
			VALUES ?";
			$this->db->query($sql,array($values));
		}
	}
}//end class
?>