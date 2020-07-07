<?php 
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');
class Settings extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->id = get_details('id');
    $this->base_url = base_url();
		$this->account_type =strtolower(get_details('account_type'));
		if($this->id)
		{
      $rows = "first_name,last_name,email,gender,image,telephone,location,languages,user_description";
      $this->personal_data = $this->Select->get_content($rows,$table="users",
      $where_condition=true,$where_part ="id= $this->id",
      $order_by ='id ASC',$limit= 1);
    }
  }
	public function index()
	{
    $data['profiles'] = $this->Select->get_content($rows="id,profile_title",$table="profiles",
    $where_condition=true,$where_part = "user_id =$this->id",
    $order_by ='id ASC',$limit= 1000);

    $data['portfolios'] = $this->Select->get_content($rows="id,portfolio_title,images,videos",$table="portfolios",
    $where_condition=true,$where_part = "user_id =$this->id",
    $order_by ='id ASC',$limit= 1000);

    $data['personal_data'] = $this->personal_data;
    $data['view'] = "settings";
    $this->load->view('dashboard',$data);
  }
  public function save()
  {
    if(isset($_POST['personal_data']))
    {

      $new_personal_data = json_decode($_POST['personal_data']);
      $columns = array();
      $values = array();
     foreach ($new_personal_data as $key => $value)
      {
       if($value != $this->personal_data[0][$key])
       {
        array_push($columns,$key);
        array_push($values,$value);
       }
       else
       {
         continue;
       }
      }
      if(count($columns)!=count($values))
       {
        echo json_encode([false,'Error saving changes']);
        return;
        exit();
       }
     for($i=0;$i<count($columns);$i++)
     {
       $key = $columns[$i]=="user_description"?'description':$columns[$i];
       if(isset($_SESSION[$key]))
       {
         $_SESSION[$key] = $values[$i];
       }
       elseif(isset($_COOKIE[$key]))
       {
        setcookie($key,$values[$i],time()+86400*365,'/');
       }
       else
       {
        continue;
       }
     }
     if(count($columns)>0)
     {
      $this->Update->update_data($table="users",$columns,$values,$where_part="id = $this->id");
      echo json_encode([true,$values]);
     }
     else
     {
      echo json_encode([false,'You have not made any changes']);
     }
    }
    else
    {
      $settings = $this->base_url."dashboard/settings";
      header("location: $settings");
    }
  }
  public function change_profile()
  {
    if(isset($_POST['profile']))
    {
      $columns = array('image');
      $values = array(trim($_POST['profile']));
      $this->Update->update_data($table="users",$columns,$values,$where_part="id = $this->id");
      if(isset($_COOKIE['image']))
      {
        setcookie('image',$_POST['profile'],time()+86400*365,'/');
      }
      else
      {
        $_SESSION['image'] = $_POST['profile'];
      }
      echo json_encode([true,'changed']);
    }
  }
  public function delete_profile($id)
  {
    $this->Delete->delete_row($table="profiles",$id);
  }
  public function delete_portfolio($id)
  {
    $this->Delete->delete_row($table="portfolios",$id);
  }
}