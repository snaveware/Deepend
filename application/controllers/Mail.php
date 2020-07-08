<?php 
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');
class Mail extends CI_Controller
{
	function index()
	{
    $this->load->library('email');

    $this->email->from('work.evans020@gmail.com', 'Evans Work');
    $this->email->to('evansmwenda006@gmail.com');

    $this->email->subject('Testing email module');
    $this->email->message('<p>sending email at deepend using smtp mailer</p>');

    $this->email->send();
  }
}