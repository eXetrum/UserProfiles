<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Userauth  { 
	  
    private $login_page = "";   
    private $logout_page = "";   
     
    private $username;
    private $password;
	
	private $isFrozen;
	

    /**
    * Turn off notices so we can have session_start run twice
    */
    function __construct() 
    {
      error_reporting(E_ALL & ~E_NOTICE);
      $this->login_page = base_url() . "index.php?/Login";
      $this->logout_page = base_url() . "index.php?/Home";
	  
	  $CI =& get_instance();
	  $CI->config->load('acl');
    }

    /**
    * @return string
    * @desc Login handling
    */
    public function login($username,$password) 
    {

      session_start();
        
      // User is already logged in if SESSION variables are good. 
      if ($this->validSessionExists() == true)
      {
        $this->redirect($_SESSION['basepage']);
      }

      // First time users don't get an error message.... 
      if ($_SERVER['REQUEST_METHOD'] == 'GET') return;
        
      // Check login form for well formedness.....if bad, send error message
      if ($this->formHasValidCharacters($username, $password) == false)
      {
         return "Username/password fields cannot be blank!";
      }
        
      // verify if form's data coresponds to database's data
      if ($this->userIsInDatabase() == false)
      {
		  return 'Invalid username/password!';
      }
      else
      { 
        if($this->isFrozen) {
		  return "Account frozen!";
		} 
        // We're in!
        // Redirect authenticated users to the correct landing page
        // ex: admin goes to admin, members go to members
		$this->writeSession();
        $this->redirect($_SESSION['basepage']);
      }
    }
	
    /**
    * @return void
    * @desc Validate if user is logged in
    */
    public function loggedin() 
    {

      session_start();     

      // Users who are not logged in are redirected out
      if ($this->validSessionExists() == false)
      {
        $this->redirect($this->login_page);
      }
       
		 
      // Access Control List checking goes here..
      // Does user have sufficient permissions to access page?
      // Ex. Can a bronze level access the Admin page?   
	  $CI =& get_instance();
	  $acl = $CI->config->item("acl");
	  
	  $func_name = $CI->router->fetch_method();
	  $page = strtolower($CI->router->fetch_class());
	  $accesslevel = strtolower($_SESSION['accesslevel']);

	  if($acl[$page][$accesslevel] == 0) {
		  $this->redirect($_SESSION['basepage']);
	  }
      
  
      return true;
    }
	
    /**
    * @return void
    * @desc The user will be logged out.
    */
    public function logout() 
    {
      session_start(); 
      $_SESSION = array();
      session_destroy();
      header("Location: ".$this->logout_page);
    }
    
    /**
    * @return bool
    * @desc Verify if user has got a session and if the user's IP corresonds to the IP in the session.
    */
    public function validSessionExists() 
    {
      session_start();
      if (!isset($_SESSION['username']))
      {
        return false;
      }
      else
      {
        return true;
      }
    }
    
    /**
    * @return void
    * @desc Verify if login form fields were filled out correctly
    */
    public function formHasValidCharacters($username, $password) 
    {
      // check form values for strange characters and length (3-12 characters).
      // if both values have values at this point, then basic requirements met
      if ( (empty($username) == false) && (empty($password) == false) )
      {
        $this->username = $username;
        $this->password = $password;
        return true;
      }
      else
      {
        return false;
      }
    }
	
    /**
    * @return bool
    * @desc Verify username and password with MySQL database.
    */
    public function userIsInDatabase() 
    {

      // Remember: you can get CodeIgniter instance from within a library with:
      $CI =& get_instance();
      // And then you can access database query method with:
      $CI->db->select("*");
	  $CI->db->from("userslab6");
	  $CI->db->where("username = '" . $this->username."'");
	  $query = $CI->db->get();
	  
	  $User = $query->result();
	  $User = $User[0];
        
      // Access database to verify username and password from database table
      if (count($User) && $User->password == $this->password)  
      {    
        $this->accesslevel = $User->accesslevel;
		$this->isFrozen = $User->frozen;
        return true;
      } 
      else 
      {
        return false; 
      }
    }
    
    
    /**
    * @return void
    * @param string $page
    * @desc Redirect the browser to the value in $page.
    */
    public function redirect($page) 
    {
        header("Location: ".$page);
        exit();
    }
    
    /**
    * @return void
    * @desc Write username and other data into the session.
    */
    public function writeSession() 
    {
        $_SESSION['username'] = $this->username;
        $_SESSION['accesslevel'] = $this->accesslevel;
		if($this->accesslevel == "admin") {
			$_SESSION['basepage'] = base_url() . "index.php?/Admin";
		} else if($this->accesslevel == "member") {
			$_SESSION['basepage'] = base_url() . "index.php?/Members";
		} else {
			$_SESSION['basepage'] = base_url() . "index.php?/Home";
		}
        
        
    }
	
    /**
    * @return string
    * @desc Username getter, not necessary 
    */
    public function getUsername() 
    {
        return $_SESSION['username'];
    }
		 
}

