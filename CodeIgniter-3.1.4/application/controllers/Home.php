<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

  var $TPL;

  public function __construct()
  {
    parent::__construct();
    // Your own constructor code

   $this->TPL['loggedin'] = $this->userauth->validSessionExists();
   $this->TPL['active'] = array('home'    => true,
                                'members' => false,
                                'admin'   => false,
                                'login'   => false);

  }

  public function index()
  {
    $this->template->show('home', $this->TPL);
  }
}
?>