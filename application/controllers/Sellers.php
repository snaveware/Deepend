<?Php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');
class Sellers extends CI_Controller
{
  public function index()
  {
    $data = array();
    $sellers = $this->Select->get_content($rows="id,first_name,last_name,image,user_description,
    review,location,languages",$table="users",
    $where_condition=true,$where_part = "account_type = 'seller' and account_status = 'active' ",
    $order_by ='expenditure_or_earnings DESC',$limit= 1000);
    $data['sellers'] = $sellers;
    $this->load->view('sellers',$data);
    
  }
  public function seller($id)
  {
    $seller = $this->Select->get_content($rows="id,first_name,last_name,image,user_description,
    review,location,languages",$table="users",
    $where_condition=true,$where_part = "id =$id and account_type = 'seller' and account_status = 'active' ",
    $order_by ='expenditure_or_earnings DESC',$limit= 1000);
    print_r($seller);
  }

}
?>