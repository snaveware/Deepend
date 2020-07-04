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
    $data['view'] = 'many_sellers';
    $this->load->view('sellers',$data);
    
  }
  public function seller($id=null)
  {
    if(!$id)
    {
      $sellers_page = base_url()."sellers";
      header("location: $sellers_page");
      exit();
    }
    $data['seller']['personal_details'] = $this->Select->get_content($rows="id,first_name,last_name,image,user_description,
    review,location,languages,account_type",$table="users",
    $where_condition=true,$where_part = "id =$id and account_type = 'seller' and account_status = 'active' ",
    $order_by ='expenditure_or_earnings DESC',$limit= 1000);
    $data['seller']['profiles'] = $this->Select->get_content($rows="id,profile_title",$table="profiles",
    $where_condition=true,$where_part = "user_id =$id",
    $order_by ='id ASC',$limit= 1000);
    if(isset($_GET['profile']))
    {
      $profile =$_GET['profile'];
      $data['seller']['main_profile']= $this->Select->get_content($rows="*",$table="profiles",
      $where_condition=true,$where_part = "id ='$profile' or profile_title = '$profile'",
      $order_by ='id ASC',$limit= 1);
    }
    else
    {
      $data['seller']['main_profile']= $this->Select->get_content($rows="*",$table="profiles",
      $where_condition=true,$where_part = "user_id =$id",
      $order_by ='id ASC',$limit= 1);
    }

    $data['seller']['portfolios'] = $this->Select->get_content($rows="id,portfolio_title,images",$table="portfolios",
    $where_condition=true,$where_part = "user_id =$id",
    $order_by ='id DESC',$limit= 1000);

    if(isset($_GET['portfolio']))
    {
      $portfolio =$_GET['portfolio'];
      $data['seller']['main_portfolio']= $this->Select->get_content($rows="*",$table="portfolios",
      $where_condition=true,$where_part = "id ='$portfolio' or portfolio_title = '$portfolio'",
      $order_by ='id ASC',$limit= 1);
    }
    else
    {
      $data['seller']['main_portfolio']= $this->Select->get_content($rows="*",$table="portfolios",
      $where_condition=true,$where_part = "user_id =$id",
      $order_by ='id ASC',$limit= 1);
    }

    $data['view'] = 'single_seller';
    $this->load->view('sellers',$data);
  }
}//end class
?>