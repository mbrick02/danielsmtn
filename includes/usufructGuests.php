<?php 
// If it's going to need the database then it's
//  probably smart to require it before we start. also need functions.php called by initialize
// user.php called by initialize.php, so, LIB_PATH available
require_once(LIB_PATH.DS.'database.php');  // called by initialize but require_once is safe

class UsufructGuests extends DatabaseObject {

	protected static $tableName = "usufructguests";
	protected static $dbFields = array('guestID', 'fName', 'lName', 'email');	
	protected static $IDField = "guestID";
	public $guestID;
	public $fName;
	public $lName;
	public $email;
	
	public function cleanEmail($email){
		$output = preg_replace("/\"/", "", $email);
		// $output = preg_replace("/(\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b)/", "$1", $output);
		return $output;
	}
	// ***?? MAY WANT TO MAKE THIS EXTEND USER and have user extend databasObject
}

?>