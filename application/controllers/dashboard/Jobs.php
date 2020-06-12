<?php 
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');
class Jobs extends CI_Controller
{
	function index()
	{
    $id =get_details('id');
		$account_type =strtolower(get_details('account_type'));
		if($id)
		{
      $data['view'] = "jobs";
      $data['jobs'] = array();
      if ($account_type == "buyer")
      {
        $rows = 'id,title,category,job_status,budget,bids';
        $data['jobs'] = $this->Select->get_content($rows,$table="jobs",
        $where_condition=true,$where_part ="id=$id",
        $order_by ='id DESC',$limit= 10000);
      }
      elseif($account_type == 'seller')
      {
        $columns = 'jobs.id,jobs.title,jobs.category,jobs.job_status,users.first_name,employments.employment_amount';
        $tables = array('jobs','users','employments');
        $joining_columns = array('jobs.buyer_user_id = users.id','jobs.id = employments.job_id');
        $where_columns = "employments.seller_user_id = '$id'";
        $data['jobs'] = $this->Select->get_joined_data($columns,$tables,$joining_columns,
        $order_by ='order  by employments.id DESC',$limit='limit 1000000',	$where_condition= true,
        $where_columns);
      }
      $this->load->view('dashboard',$data);
    }
  }
}