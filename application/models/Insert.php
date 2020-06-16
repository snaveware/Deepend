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
	public function add_user($values)
	{
		$columns = "first_name,last_name,password,email,account_type,created_on,telephone,location,languages,gender,user_description";
		$sql = "INSERT INTO users ($columns)
			VALUES ?,?,?,?,?,?,?,?,?,?,?";
			$this->db->query($sql,$values);
	}
}//end class
?>