<?php 
// A class to help work with Sessions
// In our case, primarily to manage logging users in and out

// Keep in mind when working with sessions that it is generally
// inadvisable to store DB-related objects in sesssions

// ***Note: this is a change from my original non-object session.php
class Session {

	private $loggedIn=false;
	public $userID;
	public $message;

	function __construct() {
		session_start();
		$this->checkLogin();
		if($this->loggedIn) {
			// actions to take right away if user is logged in
		} else {
			// actions to take right away if user is not logged in
		}
	}
	public function isLoggedIn(){
		return $this->loggedIn;
	}
	
	public function login($user) {
		// database should find user based on username/password
		if($user) {
			$this->userID = $_SESSION['userID'] = $user->id;
			$this->loggedIn = true;
		}
	}
	
	public function logout() {
		unset($_SESSION['userID']);
		unset($this->userID);
		$this->loggedIn = false;
	}
	
	private function checkLogin() {
		if(isset($_SESSION['userID'])) {
			$this->userID = $_SESSION['userID'];
			$this-> loggedIn = true;
		} else {
			unset($this->userID);
			$this->loggedIn = false;
		}	
	}

	public function setMessage($msg) {
		$this->message = $_SESSION['message'] = $msg; 
		
	}
	
	// ********these functions were from non-object session.php (calls should be updated)*******
	
	public function putMessage() {
		if (isset($_SESSION["message"])) {
			// $this->message = $_SESSION["message"];
			$output = "<div class=\"message\">" . htmlentities($_SESSION["message"]) ."</div>";
				
			// Clear Message
			$_SESSION["message"] = null;
			$this->message = "";
			return $output;
		}
	}
	
	public function errors() {
		if (isset($_SESSION["errors"])) {
			$errors = $_SESSION["errors"];
				
			// Clear errors after use
			$_SESSION["errors"] = null;
				
			return $errors;
		}
	}
	

}

	
$session = new Session();
	
?>