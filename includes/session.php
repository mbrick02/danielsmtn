<?php 
// A class to help work with Sessions
// In our case, primarily to manage logging users in and out

// Keep in mind when working with sessions that it is generally
// inadvisable to store DB-related objects in sesssions

// ***Note: this is a change from my original non-object session.php
class Session {
	private $loggedIn=false;
	public $userID;
	public  $pastLocation=""; // **2/6/15 make PRIVATE - use this to keep track of where the user was
	// *** I will probably abandon this since I seem to only use _SESSION['message']
	public $message;

	function __construct() {
		session_start();
		$this->checkMessage();
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
			$this->userID = $_SESSION['userID'] = $user->userID;
			$this->loggedIn = true;
		}
	}
	
	public function logout() {
		unset($_SESSION['userID']);
		unset($this->userID);
		$this->loggedIn = false;
		$this->message = $_SESSION['message'] = "";
		// xx let calling function redirect: redirectTo("page.pg");
		
		/*
		 * // hard-core version of logout with destroy
		 * session_start();
		 * $_SESSION = array();
		 * if (isset($_COOKIE[session_name()])){
		 * 	setcookie(session_name(), '', time()=42000, '/');
		 * }
		 * session_destroy();
		 * redirectTo("loginDM.php");		
		 */		
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
	
	private function checkPastLocation() {
		// Is there a PastLocation stored in the session?
		if(isset($_SESSION['pastLocation'])) {
			// Add it as an attribute and erase the stored version
			$this->pastLocation = $_SESSION['pastLocation'];
			unset($_SESSION['pastLocation']);
		} else {
			$this->pastLocation = "";
		}
	}

	private function setPastLocation($msg) {
		$this->pastLocation = $_SESSION['pastLocation'] = $msg;
	}
	
	private function putPastLocation() {
		if (!empty($this->pastLocation)) {
			// $this->pastLocation = $_SESSION["pastLocation"];
			$output = htmlentities($this->pastLocation);
				
			// Clear PastLocation
			$_SESSION["pastLocation"] = null;
			$this->pastLocation = "";
				
			return $output;
		}
	}
	
	public function pastLocation($loc = "") {  // *** designed to be a toggle like "message()"
		if (empty($loc)) {
			return $this->putPastLocation();
		} else {
			$this->setPastLocation($loc);
		}
	}

	private function checkMessage() {
		// Is there a message stored in the session?
		if(isset($_SESSION['message'])) {
			// Add it as an attribute and erase the stored version
			$this->message = $_SESSION['message'];
			unset($_SESSION['message']);
		} else {
			$this->message = "";
		}
	}
	
	private function setMessage($msg) {
		$this->message = $_SESSION['message'] = $msg; 
	}
	
	private function putMessage() {
		if (!empty($this->message)) {
			// $this->message = $_SESSION["message"];
			$output = "<div class=\"message\">" . htmlentities($this->message) ."</div>";
			
			// Clear Message
			$_SESSION["message"] = null;
			$this->message = "";
			
			return $output;
		}
	}
	
	public function message($msg = "") {
		if (empty($msg)) {
			return $this->putMessage();
		} else {
			$this->setMessage($msg);
		}
	}
		
	public function setErrors($errors = ""){
		$_SESSION["errors"] = $errors;
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