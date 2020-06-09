<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller
{

	public function index()
	{
		$this->load->model('Select');
		$data = $this->Select->get_content('content',"website_content",true,"category='call to action'",'',);
		$data['sub_heading']= $data[0]['content'];
		$data['heading'] = $data[1]['content'];
		$this->load->helper('custom_helper');
		$this->load->view('home',$data);
	}
	public function get_users()
	{
	
		$buyers = $this->Select->get_content('first_name,last_name,expenditure_or_earnings,account_type,image',"users",
		true,"account_type='buyer'",
		'expenditure_or_earnings DESC',5);
		$sellers = $this->Select->get_content('first_name,last_name,expenditure_or_earnings,account_type,image',"users",
		true,"account_type='seller'",
		'expenditure_or_earnings DESC',5);
		$buyers_count = count($this->Select->get_content('id',"users",true,"account_type='buyer'"));
		$the_buyers_count =array('buyers'=>$buyers_count);
		$sellers_count = count($this->Select->get_content('id',"users",true,"account_type='seller'"));
		$the_sellers_count =array('sellers'=>$sellers_count);
		$users = array_merge($buyers,$sellers);
		array_push($users,$the_buyers_count);
		array_push($users,$the_sellers_count);
		echo json_encode($users);
		
	}
}//end class
