<?php 
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');
class Proposals extends CI_Controller
{
	function index()
	{
    $id =get_details('id');
		$account_type =strtolower(get_details('account_type'));
		if($id)
		{
      $columns = "jobs.id as job_id,bids.seller_user_id,bids.cover_letter,bids.bid_status,bids.bid_amount,jobs.title,jobs.budget,users.first_name,users.last_name";
      $tables = array('bids','jobs','users');
      if($account_type == "buyer")
      {
        $joining_columns = array('bids.job_id = jobs.id','bids.seller_user_id = users.id');
        $where_columns = array("jobs.buyer_user_id = '$id'");
      }
      else
      {
        $joining_columns = array('bids.job_id = jobs.id','jobs.buyer_user_id = users.id');
        $where_columns = array("bids.seller_user_id = '$id'");
      }
      
      $order_by = 'order by jobs.created_on DESC';
      $limit = "limit 1000";

      $data['proposals']= $this->Select->get_joined_data($columns,$tables,$joining_columns,$order_by,$limit,
			true,$where_columns);
      $data['view'] = "proposals";
      $this->load->view('dashboard',$data);
    }
    else
    {
      $home = base_url();
      header("location: $home");
    }
  }
}//end class
?>