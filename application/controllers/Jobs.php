<?php 
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');
class Jobs extends CI_Controller
{
	public function index()
	{
		$this->load->view('jobs');
	}
	
	public function get_posts()
	{
		if(isset($_GET['quantity']) || isset($_GET['page']) || isset($_GET['category'])
		||isset($_GET['keywords']))
		{
			$the_quantity =isset($_GET['quantity'])? $_GET['quantity']: 10  ;
			$the_page = isset($_GET['page'])? $_GET['page']: 1 ;
			$the_category = isset($_GET['category'])? $_GET['category']: "*"  ;
			$the_keywords =  isset($_GET['keywords'])?"(.*)". $_GET['keywords'].".*": null  ;
			if($the_category =="*")
			{
				$time = time();
				if($the_keywords)
				{
					$the_where_columns = "jobs.job_status = 'bidding' and jobs.bids < jobs.maximum_bids 
					and jobs.uptime+jobs.created_on >$time and 
					(jobs.description REGEXP '$the_keywords'or jobs.skills REGEXP '$the_keywords' or
					 jobs.title REGEXP '$the_keywords' or jobs.category REGEXP '$the_keywords' )";
				}
				else
				{
					$the_where_columns = "jobs.job_status = 'bidding' and jobs.bids < jobs.maximum_bids 
					and jobs.uptime+jobs.created_on >$time ";
				}
				
			}
			else{
				$time = time();
				if($the_keywords)
				{
					$the_where_columns = "jobs.job_status = 'bidding' and jobs.bids < jobs.maximum_bids 
					and jobs.uptime+jobs.created_on >$time and jobs.category = '$the_category'
					and jobs.description REGEXP '$the_keywords'";
				}
				else
				{
					$the_where_columns = "jobs.job_status = 'bidding' and jobs.bids < jobs.maximum_bids 
				and jobs.uptime+jobs.created_on >$time and jobs.category = '$the_category'";
				}
			}
			if($the_page == 1)
			{
				$the_limit = $the_quantity;
			}
			else
			{
				$seen_posts = ($the_page-1) * $the_quantity;
				$the_limit = "$seen_posts,$the_quantity";
			}

			$columns = "jobs.id,jobs.title,jobs.category,jobs.description,jobs.skills,jobs.maximum_bids,
			jobs.created_on,jobs.uptime,jobs.budget,jobs.bids,users.first_name,users.last_name
			,users.review,users.location,users.image";

			$tables = array('jobs','users');
			$join_columns = array('jobs.buyer_user_id = users.id');
			$order_by = 'order by jobs.created_on DESC';
			$limit = "limit $the_limit";
			$where_columns = array("$the_where_columns");
			$results_count = $this->Select->get_joined_data('jobs.id',$tables,$join_columns,$order_by,'limit 100000',
			true,$where_columns);
			$the_results_count = count($results_count);

			$data = $this->Select->get_joined_data($columns,$tables,$join_columns,$order_by,$limit,
			true,$where_columns);
			array_push($data,$the_results_count);

			echo json_encode($data);
		}
		else
		{
			echo"page not found";
		}
	}//end function

}//end class

?>