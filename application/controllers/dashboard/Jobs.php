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
      $data['jobs']['view'] = "jobs";
      $data['jobs']['jobs'] = array();
      if ($account_type == "buyer")
      {
        $rows = 'id,title,category,job_status,budget,bids';
        $data['jobs'] = $this->Select->get_content($rows,$table="jobs",
        $where_condition=true,$where_part ="buyer_user_id=$id",
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
    else
    {
      $home = base_url();
      header("location: $home");
    }
  }
  public function new()
  {
    $id =get_details('id');
		$account_type =strtolower(get_details('account_type'));
    if($id && $account_type == "buyer")
		{
      $data['view'] = 'jobs';
      $data['jobs']['view'] = "new_job";
      $this->load->view('dashboard',$data);
    }
    else
    {
      $dashboard = base_url()."dashboard";
      header("location: $dashboard");
    }
  }
  public function job($job_id)
  {
    $id =get_details('id');
		$account_type =strtolower(get_details('account_type'));
    if($id && $account_type == "buyer")
		{
      $rows = 'id,title,category,description,job_status,budget,created_on,skills';
      $data['jobs']['job'] = $this->Select->get_content($rows,$table="jobs",
      $where_condition=true,$where_part ="id = $job_id",
      $order_by ='id DESC',$limit= 10000);

      $columns = "bids.cover_letter,bids.seller_user_id,bids.bid_status,bids.bid_amount,users.first_name,users.last_name";
      $tables = array('bids','users');
     
      $joining_columns = array('bids.seller_user_id = users.id');
      $where_columns = array("bids.job_id = '$job_id'");
      
      $order_by = 'order by bids.id DESC';
      $limit = "limit 1000";

      $data['jobs']['proposals']= $this->Select->get_joined_data($columns,$tables,$joining_columns,$order_by,$limit,
			true,$where_columns);
      

      $data['view'] = 'jobs';
      $data['jobs']['view'] = "single_job";
      $this->load->view('dashboard',$data);
    }
    else
    {
      $dashboard = base_url()."dashboard";
      header("location: $dashboard");
    }
  }
  public function category()
  {
    $id =get_details('id');
		$account_type =strtolower(get_details('account_type'));
    if($id && $account_type == "buyer")
		{
      if(isset($_POST['begin_with']))
      {
        $begin_with = $_POST['begin_with'];
        $categories = $this->Select->get_content($rows="name",$table="categories",
        $where_condition=true,$where_part ="name REGEXP '(^$begin_with.*)$'",
        $order_by ='id ASC',$limit= 10);
        if(count($categories)>0)
        {
          $return = [true,$categories];
        }
        else
        {
          $return = [false,'no category'];
        }
        echo json_encode($return);
      }
      else
      {
        $userNewJob = base_url()."dashboard/jobs/new";
        header("location: $userNewJob");
      }
    }
    else
    {
      $dashboard = base_url()."dashboard";
      header("location: $dashboard");
    }
  }
  public function skills()
  {
    $id =get_details('id');
		$account_type =strtolower(get_details('account_type'));
    if($id && $account_type == "buyer")
		{
      if(isset($_POST['begin_with']))
      {
        $begin_with = $_POST['begin_with'];
        $skills =$this->Select->get_content($rows="name",$table="skills",
        $where_condition=true,$where_part ="name REGEXP '(^$begin_with.*)$'",
        $order_by ='id ASC',$limit= 10);
        if(count($skills)>0)
        {
          $return = [true,$skills];
        }
        else
        {
          $return = [false,'no skill'];
        }
        echo json_encode($return);
      }
      else
      {
        $userNewJob = base_url()."dashboard/jobs/new";
        header("location: $userNewJob");
      }
    }
    else
    {
      $dashboard = base_url()."dashboard";
      header("location: $dashboard");
    }
  }
  public function add_job()
  {
    $id =get_details('id');
		$account_type =strtolower(get_details('account_type'));
    if($id && $account_type == "buyer")
		{
      if(isset($_POST['title']) && isset($_POST['budget'])&& isset($_POST['category'])&&
      isset($_POST['skills'])&&isset($_POST['description']))
      {
        $time = time();
        $values = [$id,$_POST['title'],$_POST['category'],$_POST['description'],$_POST['skills'],$time,$_POST['budget']];
        $this->Insert->add_job($values);

        $title = $_POST['title'];
        $budget = $_POST['budget'];
        
        $new_job =$this->Select->get_content($rows="id",$table="jobs",
        $where_condition=true,$where_part ="buyer_user_id = '$id' and title='$title' and budget = '$budget'",
        $order_by ='id DESC',$limit= 1);

        $job_id = $new_job[0]['id'];

        $return= [true,$job_id];
        echo json_encode($return);
      }
      else
      {
        $userNewJob = base_url()."dashboard/jobs/new";
        header("location: $userNewJob");
      }
    }
    else
    {
      $dashboard = base_url()."dashboard";
      header("location: $dashboard");
    }
  }
  public function hire()
  {
    $id =get_details('id');
		$account_type =strtolower(get_details('account_type'));
    if($id && $account_type == "buyer")
		{
      $job_id = $_POST['job_id'];
      $seller_id = $_POST['seller_id'];
      $amount = $_POST['amount'];
      $values = array($job_id,$seller_id,$amount);
      $this->Insert->add_employment($values);
      echo json_encode([true,'hired']);
    }
    else
    {
      $dashboard = base_url()."dashboard";
      header("location: $dashboard");
    }
  }
}//end class