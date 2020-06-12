<?php 
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');
class Gigs extends CI_Controller
{
	function index()
	{
    $id =get_details('id');
		$account_type =strtolower(get_details('account_type'));
		if($id)
		{
      if(get_details('account_type') =="seller")
      {
        $data['view'] = "gigs";
        $this->load->view('dashboard',$data);
      }
      else
      {
        $dashboard = base_url()."dashboard";
        header("location: $dashboard");
      }
    }
  }
}