<?php 
	session_start();
class Logout extends CI_controller
{
	public function index()
	{
		$home = base_url();
		if (isset($_SESSION['id']))
		{
			session_unset();
			session_destroy();

			header("location: $home ");
		}
		elseif(isset($_COOKIE['id']))
		{
			$id = $_COOKIE['id'];
			setcookie('id',$id,time()-10,'/');
			header("location: $home ");
		}
	}
}
?>