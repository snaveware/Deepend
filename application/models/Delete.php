<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Delete extends CI_Model
{
  public function delete_row($table,$id)
  {
    $sql = "DELETE FROM $table WHERE id = ?";
    $this->db->query($sql,array($id));
  }
}