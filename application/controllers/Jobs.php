<?php 
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');
class Jobs extends CI_Controller
{
	public function index()
	{
		$data['view'] = 'many_posts';
		$this->load->view('jobs',$data);
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
				if($the_keywords)
				{
					$the_where_columns = "jobs.job_status = 'bidding' and
					(jobs.description REGEXP '$the_keywords'or jobs.skills REGEXP '$the_keywords' or
					 jobs.title REGEXP '$the_keywords' or jobs.category REGEXP '$the_keywords' )";
				}
				else
				{
					$the_where_columns = "jobs.job_status = 'bidding' ";
				}
				
			}
			else{
				if($the_keywords)
				{
					$the_where_columns = "jobs.job_status = 'bidding'and jobs.category = '$the_category'
					and jobs.description REGEXP '$the_keywords'";
				}
				else
				{
					$the_where_columns = "jobs.job_status = 'bidding' and jobs.category = '$the_category'";
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

			$columns = "jobs.id,jobs.title,jobs.category,jobs.description,jobs.skills,
			jobs.created_on,jobs.budget,jobs.bids,users.first_name,users.last_name
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
 public function single($id)
 {
	$columns = "jobs.id,jobs.title,jobs.category,jobs.description,jobs.skills,
	jobs.created_on,jobs.budget,jobs.bids,users.first_name,users.last_name
	,users.review,users.location,users.image";
	$tables = array('jobs','users');
	$join_columns = array('jobs.buyer_user_id = users.id');
	$order_by = 'order by jobs.created_on DESC';
	$limit = "limit 1";
	$where_columns = array("jobs.job_status = 'bidding' and  jobs.id = $id");
	$data['job'] = $this->Select->get_joined_data($columns,$tables,$join_columns,$order_by,$limit,
	true,$where_columns);

	 $data['view'] = "single_post";
	 $this->load->view('jobs',$data);
 }
 public function new_proposal()
 {
	 $seller_id = get_details('id');
	 if($seller_id)
	 {
		 if(isset($_GET['id']))
		 {

			$job_id = $_GET['id'];
			$data['proposal']['status']=[true,'everything is verified'];
			$data['view'] = "new_proposal";
			$data['proposal']['seller_id'] =$seller_id;
			$data['proposal']['job_id'] = $job_id;

			$this->load->view('jobs',$data);
		 }
		 else
			{
			$data['proposal']['status']=[false,'job'];
			$data['view'] = "new_proposal";
			$this->load->view('jobs',$data);
			}	
	 }
	 else
	 {
		$data['proposal']['status']=[false,'login'];
		$data['view'] = "new_proposal";
		$this->load->view('jobs',$data);
	 }
 }
 public function send_proposal()
 {
	 if(! get_details('id'))
	 {
		 echo json_encode([false,"Please login first"]);
		 return;
		 exit();
	 }
	$columns = "job_id,seller_user_id,cover_letter,bid_amount";
	$job_id = $_POST['job_id'];
	$seller_id =get_details('id');
	$cover_letter = $_POST['cover_letter'];
	$amount = $_POST['amount'];
	$values = [$job_id,$seller_id,$cover_letter,$amount];
	$this->Insert->add_proposal($values);
	$newProposal =$this->Select->get_content($rows="id",$table="bids",
	$where_condition=true,$where_part ="job_id = '$job_id' and seller_user_id= '$seller_id' and bid_amount = '$amount'",
	$order_by ='id DESC',$limit= 1);
	$proposalId = $newProposal[0]['id'];
	echo json_encode([true,$proposalId]);
 }
}//end class

?>