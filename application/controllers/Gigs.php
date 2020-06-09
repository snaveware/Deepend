<?Php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');
class Gigs extends CI_Controller
{
  public function index()
  {
    $this->load->view('gigs');
  }

}
?>