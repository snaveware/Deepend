<?php 
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller
{
	function index()
	{
    $id =get_details('id');
		$account_type =strtolower(get_details('account_type'));
		if($id)
		{
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
      $this->load->view('dashboard',$data);
    }
    else
		{
			$base = base_url();
			header("location: $base");
		}
  }
}