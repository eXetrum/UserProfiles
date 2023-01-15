<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Members extends CI_Controller {

  var $TPL;

  public function __construct()
  {
    parent::__construct();
    // Your own constructor code

   $this->TPL['loggedin'] = $this->userauth->loggedin();
   $this->TPL['active'] = array('home'    => false,
                                'members' => true,
                                'admin'   => false,
                                'login'   => false);

  }

  public function index()
  {
    $this->template->show('members', $this->TPL);
  }
}
?>