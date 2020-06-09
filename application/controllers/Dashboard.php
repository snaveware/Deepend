<?php 
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller
{
	function index($section="profiles")
	{
		$id =get_details('id');
		$account_type =strtolower(get_details('account_type'));
		if($id)
		{
			$data = array();
			$data['view'] ="profiles";
			$profiles = array();
			switch (strtolower($section)) 
			{
				case 'jobs':
					$data['view'] = "jobs";
					$data['jobs'] = array();
					if ($account_type == "buyer")
					{
						$data['jobs'] = $this->Select->get_content($rows="*",$table="jobs",
						$where_condition=true,$where_part ="id=$id",
						$order_by ='id DESC',$limit= 10000);
					}
					elseif($account_type == 'seller')
					{
						$data['jobs'] = $this->Select->get_joined_data($columns="",$tables,$joining_columns,
						$order_by =null,$limit=null,	$where_condition= false,
						$where_columns=null);
					}
					break;
				case 'settings':
					$data['view'] = "settings";
					break;
				case 'gigs':
					if(get_details('account_type') =="seller")
					{
						$data['view'] = "gigs";
						break;
					}
				default:
				$data['profiles'] = $this->Select->get_content('id,profile_title','profiles',
				true,"user_id=$id");

				$data['view'] = 'profiles';
				$data['general_profile'] = $this->Select->get_content('*','profiles',true,
				"user_id = $id",'id ASC',1);
				if(count($data['general_profile'])== 1)
				{
					$general_profile_id = $data['general_profile'][0]['id'];
					$data['general_profile_portfolios'] = $this->Select->get_content('id,portfolio_title,images','portfolios',true,
					"user_id = $id and profile_id = $general_profile_id ");
				}
				else
				{
					$data['general_profile_portfolios']=array();
				}
			}
		
			$this->load->view('dashboard',$data);
		}
		else
		{
			$base = base_url();
			header("location: $base");
		}
	}//end index method
}//end class
?>