<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Update extends CI_Model
{
	public function update_data($table,$columns,$values,$where_part)
	{
		$columnsPart="";
		for($i=0;$i<count($columns);$i++)
		{
			$columnsPart= $columnsPart."$columns[$i]=?";

		}
		$sql = "UPDATE `$table`
		SET $columnsPart
		WHERE $where_part";

	 if($this->db->query($sql,$values))
	 {
		 return "success";
	 }
	 else
	 {
		 return "failed";
	 }
	}
}//end class
?>