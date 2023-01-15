<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

  var $TPL;

  public function __construct()
  {
    parent::__construct();
    // Your own constructor code
   $this->TPL['table'] = "userslab6";

   $this->TPL['loggedin'] = $this->userauth->loggedin();
   $this->TPL['active'] = array('home'    => false,
                                'members' => false,
                                'admin'   => true,
                                'login'   => false);

  }
  
  /**
	checks if the entry exists in the database returns a boolean
  */
  private function exist($username)
  {          
    $sql = "SELECT COUNT(*) AS count FROM " . $this->TPL['table'] . " WHERE username = '$username'";
    $query = $this->db->query($sql);
    $row = $query->row();
    return ($row->count > 0) ? TRUE : FALSE;
  }
  
  /**
	toggle freeze param for specified user id
  */
  private function toggleFreeze($id) {
	  $sql = "UPDATE " . $this->TPL['table'] . " SET frozen = IF(frozen=1, 0, 1) WHERE compid='$id'";
	  $this->db->query($sql);
  }
  
  /**
    remove record with specified id	
  */
  private function removeUser($id) {
	  $this->db->where('compid', $id);
      $this->db->delete($this->TPL['table']);
  }
  
  
  /**
    Insert new user record into table
  */
  public function adduser() {
	  $this->TPL['errors'] = array();
      // Read form values
      $username    = $this->input->post('username');
	  $password    = $this->input->post('password');
	  $accesslevel = $this->input->post('accesslevel');
	  if(empty($username)) {
	    $this->TPL['errors'][] = 'The Username field is required.';
	  } else if($this->exist($username)) {
		$this->TPL['errors'][] = 'A user with that username already exists!';
		return $this->index();
	  }
	  if(empty($password)) {
		$this->TPL['errors'][] = 'The Password field is required.';  
	  }
	  if($accesslevel != 'member' and $accesslevel != 'admin') {
		$this->TPL['errors'][] = 'Access level must be either member or admin.';
	  }
	  
	  // If zero errors -> insert new record
	  if(count($this->TPL['errors']) == 0) {
		$data = array(
			'username'		=> $username,
			'password'		=> $password,
			'accesslevel'	=> $accesslevel,
			'frozen' 		=> FALSE
		);
		$this->db->insert($this->TPL['table'], $data);
	  }
	  
	  
	  return $this->index();
  }
  
  public function freeze($id) {
	 $this->toggleFreeze($id);
	 return $this->index();
  }
  
  public function delete($id) {
	  $this->removeUser($id);
	  return $this->index();
  }
  

  public function index()
  {
	$this->db->select('*');
	$this->db->from($this->TPL['table']);
	$query = $this->db->get();	
	$this->TPL['records'] = $query->result();
    $this->template->show('admin', $this->TPL);
  }
}
?>