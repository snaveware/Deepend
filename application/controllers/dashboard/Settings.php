<?php 
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');
class Settings extends CI_Controller
{
	function index()
	{
    $id =get_details('id');
		$account_type =strtolower(get_details('account_type'));
		if($id)
		{
      $data['view'] = "settings";
      $this->load->view('dashboard',$data);
    }
  }
}