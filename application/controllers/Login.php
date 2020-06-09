<?php 
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_controller
{
	public function index()
	{
		$this->load->view('login');
	}//end index function

	public function validate()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email','email','required|valid_email');
		$this->form_validation->set_rules('password','password',"required|min_length[6]|max_length[10]");
		$this->form_validation->set_rules('keep','keep me logged in','required');

		if($this->form_validation->run() == FALSE)
		{
			$data = array();
			$email_error = form_error('email');
			$password_error = form_error('password');

			$data['email_error'] = isset($email_error)? form_error('email'):'';
			$data['password_error'] = isset($password_error)? form_error('password'):'';
			echo json_encode($data);
		}
		else
		{
			$password = $_POST['password'];
			$email = $_POST['email'];
			$data = $this->Select->get_content("id,password,first_name,last_name,account_type,
			account_status,image,review",
			"users",true,"email = '$email'",);
			if(count($data) < 1 )
			{
				$data['email_error'] = '<p>user does not exist please check email</p>';
				$data['password_error'] = '';
				echo json_encode($data);
				exit();
			}
			elseif(count($data)==1)
			{
				if((int)$data[0]['password'] == (int)$password)
			{
				if ($data[0]['account_status'] == 'active' );
				{
					$image = $data[0]['image'];
					if($_POST['keep'] == 'checked')
					{
						setcookie('id',$data[0]['id'],time()+86400*365,'/');
						setcookie('first_name',$data[0]['first_name'],time()+86400*365,'/');
						setcookie('last_name',$data[0]['last_name'],time()+86400*365,'/');
						setcookie('account_type',$data[0]['account_type'],time()+86400*365,'/');
						setcookie('image',$data[0]['image'],time()+86400*365,'/');
						setcookie('review',$data[0]['review'],time()+86400*365,'/');
						$return = ['success',$image];
						echo json_encode($return);
					}else
					{
						$_SESSION['id'] = $data[0]['id'];
						$_SESSION['first_name'] = $data[0]['first_name'];
						$_SESSION['last_name'] = $data[0]['last_name'];
						$_SESSION['account_type'] = $data[0]['account_type'];
						$_SESSION['image'] = $data[0]['image'];
						$_SESSION['review'] = $data[0]['review'];
						$return = ['success',$image];
						echo json_encode($return);
					}
				}
			}
			else
			{
				$data['password_error'] = '<p>wrong password try again</p>';
				$data['email_error'] = '';
				echo json_encode($data);
				exit();
			}
			}
				
		}
	
	}
}//end class

?>