<?php 
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');
class Email extends CI_Controller
{
	function __construct()
	{
      parent::Controller();   
      $this->load->library('email');
  }

  function index()
  {
    $config['protocol']    = 'smtp';
    $config['smtp_host']    = 'ssl://smtp.gmail.com';
    $config['smtp_port']    = '465';
    $config['smtp_timeout'] = '7';
    $config['smtp_user']    = 'work.evans020@gmail.com';
    $config['smtp_pass']    = 'Je_taime20449682';
    $config['charset']    = 'utf-8';
    $config['newline']    = "\r\n";
    $config['mailtype'] = 'text'; // or html
    $config['validation'] = TRUE; // bool whether to validate email or not      

    $this->email->initialize($config);

    $this->email->from('work.evans020@gmail.com', 'Evans');
    $this->email->to('evansmwenda006@gmail.com'); 

    $this->email->subject('Email Test');
    $this->email->message('Testing the email class.');  

    if($this->email->send())
    {
      echo "sent";
    }
    else{
      echo"not sent";
    }
  }
}
