<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

  var $TPL;

  public function __construct()
  {
    parent::__construct();
    // Your own constructor code

   $this->TPL['loggedin'] = false;
   $this->TPL['active'] = array('home'    => false,
                                'members' => false,
                                'admin'   => false,
                                'login'   => true);

  }

  public function index()
  {
    $this->template->show('login', $this->TPL);
  }

  public function loginuser()
  {
    $this->TPL['msg'] =
      $this->userauth->login($this->input->post("username"),
                             $this->input->post("password"));

    $this->template->show('login', $this->TPL);
  }

  public function logout()
  {
    $this->userauth->logout();
  }

}
?>