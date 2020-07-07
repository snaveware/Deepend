<?php 
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');
class Profile extends CI_Controller
{
	function index()
	{
		if(get_details('id'))
		{
			$base_url = base_url();
			header("location: $base_url/dashboard/profile");
		}
		else
		{
			$base_url = base_url();
			header("location: $base_url");
		}
	}
	function get()
	{
		$table = isset($_GET['table'])? $_GET['table']:'profiles';
		$id = get_details('id');
		if($id)
		{
			$result = $this->Select->get_content('*',$table,true,"user_id=$id and id=$_GET[id]");
			if($table=='profiles')
			{
				$portfolio = $this->Select->get_content('id,portfolio_title,images','portfolios',true,
				"user_id = $id and profile_id =$_GET[id]");
				array_push($result,$portfolio);
			}
			echo json_encode($result);
		}
	}
	function update()
	{
		$table = isset($_POST['table'])? $_POST['table']:'profiles';
		$id = get_details('id');
		$columns=array($_POST['column']);
		$values=array($_POST['value']);
		$item_id = $_POST['id'];
		$this->Update->update_data($table,$columns,$values,"user_id = $id and id=$item_id");
	}
	function add()
	{
		if(isset($_POST['data']))
		{
			$id = get_details('id');
			$data = json_decode($_POST['data']);
			array_push($data[0],'user_id');
			$columns =implode(',',$data[0]);
			array_push($data[1],$id);
			$values=$data[1];
			$table = $data[2];
			print_r($data);
			$this->Insert->insert_data($table,$columns,$values);
		}
		else
		{
			echo"error";
		}
	}
}
?>