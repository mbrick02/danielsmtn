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
	// protected static $id =& $guestID; // make alias (by address) so any parent calls to $id will get $guestID? 
	public $fName;
	public $lName;
	protected static $email;
	
	// ***?? MAY WANT TO MAKE THIS EXTEND USER and have user extend databasObject
	
	

}


?>