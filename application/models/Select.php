<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Select extends CI_Model
{

	public function get_content($rows="*",$table="users",
	$where_condition=false,$where_part ="id=0",
	$order_by ='id ASC',$limit= 10)
	{
		$my_order_by = $order_by ==""? "id DESC": $order_by;
		$my_limit = $limit == ""? 10:$limit;
		if($where_condition==true)
		{
			$sql = "SELECT $rows from $table
			WHERE $where_part 
			order by $my_order_by 
			limit $my_limit";
		}else
		{
			$sql = "SELECT $rows FROM $table 
			order by $my_order_by
			limit $my_limit ";
		}
		$query = $this->db->query($sql);
		$data= $query->result_array();
		return $data;
	}


	
	public function get_joined_data($columns,$tables,$joining_columns,
	$order_by =null,$limit=null,	$where_condition= false,
	$where_columns=null)
	//all parameters should be passed as array or string of items separated by comma separated by comma
	//each part of the joining column should be passed as the way it is writte in sql without the on keyword eg. order.id=shipping.order_id.
	//make sure the joining columns are arranged according to your tables order
	{
		
		$space = " ";
		$the_columns = is_array($columns) ? implode(',',$columns) : $columns;
		$the_tables = is_array($tables) ? $tables : explode(',',$tables);
		$table_count = count($the_tables);

		$the_joining_columns = is_array($joining_columns) ? $joining_columns :
		explode(',',$joining_columns); 

		$the_order_by= $order_by = ''?null :$order_by;
		$the_limit = $limit=""? null:$limit;
		//where columns
		if($where_condition)
		{
			$type = is_array($where_columns) ? "array" : "string";
			$the_where_columns = $type == 'array' ? $where_columns : 
			explode(',',$where_columns);

			$where_count = count($the_where_columns);
		}

		//dynamically creating the query
		// select part
		$select_part = "SELECT $the_columns ";

		//from part
		$from_part = "FROM $the_tables[0] ";

		//where part
		if($where_condition)
		{
			$where_part = "WHERE ";
			for ($i=0; $i < $where_count ; $i++) 
			{
				$where_part= "$where_part $the_where_columns[$i] ";
			}
		}

		//joins part
		$joins = "";
		for ($i=0; $i < $table_count-1; $i++) 
		{ 
			$table_index =$i+1;  
			$joins = $joins."JOIN $the_tables[$table_index] 
			ON $the_joining_columns[$i]".$space;
		}
		//echo $joins;
		
		if($the_order_by && $the_limit && $where_condition)
		{
			$sql = "$select_part $from_part $joins $where_part $the_order_by $the_limit" ;
		}

		elseif($the_order_by && $the_limit && !$where_condition )
		{
			$sql = "$select_part $from_part $joins $the_order_by $the_limit";
		}
		
		elseif(!$where_condition && !$the_limit && $the_order_by )
		{
			$sql = "$select_part $from_part $joins $the_order_by";
		}

		elseif(!$where_condition && $the_limit && !$the_order_by )
		{
			$sql = "$select_part $from_part $joins $the_limit";
		}

		else
		{
			$sql = "$select_part $from_part $joins";
		}

		// query the database

		$query = $this->db->query($sql);
		$data= $query->result_array();
		return $data;
	}

}//end class

?>