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
	
	private $resultAry=array();
	
	public function splitEmails($match) {
		$lastIndex = count($this->resultAry) - 1;
		$result = $match[0]; //$match[1].$match[2].$match[3].$match[4].$match[5];
		if ($match[6]){
			$this->resultAry[$lastIndex+1] = $match[6];
		}
		return $result;
	}
	
	public function cleanEmail($email) {
		$result = $this->resultAry;  // have to use a "global" because callback does not accept parameters (other than default '$match')
		// $this->resultAry[] = preg_replace('/[\'\"\;]/', "", $email);
		$this->resultAry[] = rmvQts($email);
		// regular expression to find the first email 
		$regExpEmail = '#^(\w+)(@)([A-Z]+)(\.)([A-Z]{2,5})(.*|\s+\d+)(.*)$#si';
		
		// loop to make sure there are not multiple email addresses and put emails in separate array indices
		do {
			// the last index in the array is always one less the the count of indices on zero based array
			$lastIndex = count($this->resultAry) - 1;
			
			// if something is after the next email it is put in the next (new) index (new result is put in $lastIndex)
			// array($this, $fncName) structure must be used for a callback function in an object
			$this->resultAry[$lastIndex] = preg_replace_callback($regExpEmail, array($this, 'splitEmails'), $this->resultAry[$lastIndex]);
		} while (array_key_exists(($lastIndex+1), $this->resultAry)); // if a value has been to the array, loop again
		
		if ($this->resultAry[$lastIndex] == $email) {  // no change -- no need to update/create
			$this->resultAry = array();
			return false;
		}		
		
		$result = $this->resultAry;
		$this->resultAry = array();  // empty out global result array for next use
		return $result;
	}
	// ***?? MAY WANT TO MAKE THIS EXTEND USER and have user extend databasObject
	
	// ** below method from user.php (so eliminate if extended)
	public function fullName() {
		if(isset($this->fName) && isset($this->lName)) {
			return $this->fName . " " . $this->lName;
		} else {
			return " ";
		}
	}
}

?>