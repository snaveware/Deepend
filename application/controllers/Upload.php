<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');
class Upload extends CI_Controller
{
  function index()
  {
    $is_image = strstr($_FILES['file']['type'],'image');
    $is_video =  strstr($_FILES['file']['type'],'video');
    if($is_image)
    {
      $config['upload_path']= 'assets/images/';
      $config['allowed_types']= 'png|jpeg|jpg|gif';
      $config['max_size'] = '2048';
      $config['overwrite']= false;
      $this->load->library('upload',$config);
      if(! $this->upload->do_upload('file'))
      {
        $error = array('error' => $this->upload->display_errors());
        echo json_encode($error); 
      }
      else
      {
        $data = array('upload_data' => $this->upload->data());
        echo json_encode($data);
      }
    }
    elseif($is_video)
    {
      $config['upload_path']= 'assets/videos/';
      $config['allowed_types']= 'mp4';
      $config['max_size'] = '20000000';
      $config['overwrite']= false;
      $this->load->library('upload',$config);
      if(! $this->upload->do_upload('file'))
      {
        $error = array('error' => $this->upload->display_errors());
        echo json_encode($error); 
      }
      else
      {
        $data = array('upload_data' => $this->upload->data());
        echo json_encode($data);
      }
    }
    else
    {
      echo "error uploading";
    }
  }
}

?>