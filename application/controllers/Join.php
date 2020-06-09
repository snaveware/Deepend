<?php 
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');
class Join extends CI_controller
{
	public function index()
	{
    $this->load->view('join');

  }
}
?>