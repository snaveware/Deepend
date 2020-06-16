<?php 
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');
class Join extends CI_controller
{
	public function index()
	{
    if(isset($_POST['first_name'])&&isset($_POST['last_name'])&&isset($_POST['email'])&&isset($_POST['password']))
    {
      $this->load->helper('form');
      $this->load->library('form_validation');

      $this->form_validation->set_rules('first_name','First Name','required|max_length[20]');
      $this->form_validation->set_rules('last_name','Last Name','required|max_length[20]');
      $this->form_validation->set_rules('email','Email','required|valid_email');
      $this->form_validation->set_rules('password','Password','required|min_length[6]');
      $this->form_validation->set_rules('account_type','Account Type','required|alpha');
      $this->form_validation->set_rules('gender','Gender','required|alpha');
      $this->form_validation->set_rules('city','City','required|alpha');
      $this->form_validation->set_rules('country','country','required|alpha');
      $this->form_validation->set_rules('languages','Languages','required');
      $this->form_validation->set_rules('description','Description','required|max_length[50]');

      if($this->form_validation->run()==False)
      {
        $errors = validation_errors();
        echo json_encode($errors);
      }else
      {
        $email = $_POST['email'];
        $user_id = $this->Select->get_content($rows="id",$table="users",
        $where_condition=true,$where_part ="email ='$email'",
        $order_by ='id ASC',$limit= 1);
        if(count($user_id)<1)
        {
          $first_name = $_POST['first_name'];
          $last_name = $_POST['last_name'];
          $email = $_POST['email'];
          $user_password =(int)$_POST['password'];
          $password =(string)password_hash($user_password,PASSWORD_DEFAULT);
          $account_type = $_POST['account_type'];
          $gender = $_POST['gender'];
          $languages = $_POST['languages'];
          $city = $_POST['city'];
          $country = $_POST['country'];
          $location = "$city|$country";
          $telephone = $_POST['telephone'];
          $description = $_POST['description'];
          $created_on = time();

          $columns = "first_name,last_name,password,email,account_type,created_on,telephone,location,languages,gender,user_description";
          $values =array($first_name,$last_name,$password,$email,$account_type,$created_on,$telephone,$location,$languages,$gender,$description);
          $this->Insert->insert_data('users',$columns,$values,$where_condition=false,
          $where_part=null);
          
          $user_data = $this->Select->get_content($rows="id,image",$table="users",
          $where_condition=true,$where_part ="email ='$email'",$order_by ='id ASC',$limit= 1);    
          
          $id = $user_data[0]['id'];

          $_SESSION['id'] = $id;
          $_SESSION['first_name'] = $first_name;
          $_SESSION['last_name'] = $last_name;
          $_SESSION['account_type'] = $account_type;
          $_SESSION['image'] = $user_data[0]['image'];
          $_SESSION['review'] = 0;
          $_SESSION['descriptiion'] = $description;
          $return = "joined";
          echo json_encode($return);
        }
        else
        {
          $error = "<p>Your Email is registered to another user</p>";
          echo json_encode($error);
        }
      }
    }
    else
    {
      $this->load->view('join');
    }
  }
  public function check_email()
  {
    if(isset($_POST['email']))
    {
      $email = $_POST['email'];
      if(filter_var($email,FILTER_VALIDATE_EMAIL))
      {
        $user_id = $this->Select->get_content($rows="id",$table="users",
        $where_condition=true,$where_part ="email ='$email '",
        $order_by ='id ASC',$limit= 1);
        if(count($user_id)>0)
        {
          $error = array(false,'user with same email already exists');
          echo json_encode($error);
        }
        else
        {
          $return = array(true,'user does not exist');
          echo json_encode($return);
        }
      }
      else
      {
        $error = array(false,'invalid email');
        echo json_encode($error);

      }
    }
    else
    {
      $join_page = base_url()."join";
      header("location: $join_page");
    }
  }
}
?>