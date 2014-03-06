<?php 
// If it's going to need the database then it's
//  probably smart to require it before we start. also need functions.php called by initialize
// user.php called by initialize.php, so, LIB_PATH available
require_once(LIB_PATH.DS.'database.php');  // called by initialize but require_once is safe

class User {

	protected static $tableName="tbusers";
	public $userID;
	public $username;
	public $password;
	public $fName;
	public $lName;
	public $email;
	public $userTypeID;
	
	// 3/3/14 currently only fields in usufructdish::tbusers: 
	//				userID, fName, lName, email, userTypeID

	// *********************** new user.php methods *****************************************

	//  ***** first updated methods
	// add these to user.php

	//…

	// note: these are public and not static--accessible from outside for an instance
	// although create ana update() could be protected to force user to use save()
	public function save() {
		// A new record won't have an id yet.
		return isset($this->id) ? $this->update() : $this->create();
	}

	protected static $dbFields = array('id', 'username', 'password', 'fName', 'lName', 'email', 'userTypeID');

	
	protected function attributes() {
		// return an array of attribute names and their values
		$attributes = array();
		foreach(self::$dbFields as $field) {
			if (property_exists($this, $field)) {
				$attributes[$field] = $this->$field;
			}
		}
	return $attributes;
	}
	
	// ***below is old verstion***
// 	protected function attributes() {
// 		// return an array of attribute keys and their values
// 		// get_object_vars returns associative array with attributes as keys and values
// 		return get_object_vars($this);
// 	}
		
	private function has_attribute($attribute) {
	$object_vars = $this->attributes();
	// just want to know if key exists
	return array_key_exists($attribute, $object_vars);
	}
	

	protected function sanitizedAttributes() {
		global $database;
		$cleanAttributes =  array();
		// sanitize the values before submitting
		// Note: does not alter the actual value of each attribute
		foreach($this->attributes() as $key => $value){
			$cleanAttributes[$key] = $database->escape_value($value);
	}
	return $cleanAttributes;
	}
	
	//  *** I think this is fixed???old save is the same as above public function save() {...

	protected function create() {
		global $database;
		// Don't forget SQL syntax and habits:
		//  - INSERT INTO table (key, key) VALUES ('value', 'value')
		// - single-quotes around all values
		// - escape all values to prevent SQL injection
		$attributes = $this->sanitizedAttributes();
	
		$sql = "INSERT INTO " . self::$tableName ." (";
		$sql .= join(", ", array_keys($attributes()));
		$sql .= ") VALUES ('";
		$sql .= join("', '", array_values($attributes));
		$sql .= "')";
		if($database->query($sql)) {
			$this->id = $database->insertID();
			return true;
		} else {
			return false;
		}
	}
	
	protected function update() {
		global $database;
		// Don't forget SQL syntax and habits:
		//  - UPDATE table SET key='value' key='value' WHERE condition
		// - single-quotes around all values
		// - escape all values to prevent SQL injection
		$attributes = $this->sanitizedAttributes();
		$attributePairs = array();
		foreach($attributes as $key => $value) {
			$attributePairs[] = "{$key}='{$value}'";
		}
		$sql = "UPDATE ". self::$table_name. " SET ";
		$sql .= join(", ", $attributePairs);;
		$sql .= " WHERE id=". $database->escapeValue($this->id);
	
		$database->query($sql);
		return ($database->affected_rows() == 1) ? true : false;
	}
	

	
	
	// ======*** authenticate() method for User class used in login.php ====
	public static function authenticate($username="", $password="") {
		global $database;
		$username = $database->escape_value($username);
		$password = $database->escape_value($passord);
		$sql = "SELECT * FROM " . self::$tableName;
		$sql .= " WHERE username = '{$username}' ";
		$sql .= "AND password = '{$password}' ";
		$sql .= "LIMIT 1";
	
		$resultArray = self::findBySQL($sql);
		return !empty($resultArray) ? array_shift($resultArray) : false;
	}
	
	public function fullName() {
		if(isset($this->firstName) && isset($this->lastName)) {
			return $this->firstName . " " . $this->lastName;
		} else {
			return " ";
		}
	}
	
	// Common Database Methods
	// *** below are Common Database Methods to be put in DatabaseObject
	// Note these are class methods (static) so you don't have to instantiate an object
	public static function findAll() {
		return self::findBySQL("SELECT * FROM " . self::$tableName);
	}
	
	public static function findByID($id=0) {
		global $database;
		// change to array: $resultSet = self::findBySQL("SELECT * FROM  " . self::$tableName . " WHERE id={$id} LIMIT 1");
		$resultObjArray = self::findBySQL("SELECT * FROM " . self::$tableName ." WHERE userID={$id} LIMIT 1");
		// no longer set: $found = $database->fetchArray($resultSet);
		return !empty($resultObjArray) ? array_shift($resultObjArray) : false;
	}
	
	public static function findBySQL($sql= "") {
		global $database;
		// ** debug: echo "<br />user-findBySQ SQL: <br />" . $sql . "<br />";
		$resultSet = $database->query($sql);
		$objectArray = array();
		
		while ($row = $database->fetchArray($resultSet)) {
			// add to end (?NOT ?replace) objectArray
			$objectArray[] = self::instantiate($row);
		}
		return $objectArray;
	}
	
	private static function instantiate($record) {
		// Could check that $record exists and is an array
		if (is_array($record)) {
			$object = new self;
			// $object->id = $record['id'];
			// $object->username = $record['username'];
			// $object->password = $record['password'];
			// $object->firstName = $record['firstName'];
			// $object->lastName = $record['lastName'];
	
			// INSTEAD of above:
			foreach($record as $attribute=>$value){
				if($object->hasAttribute($attribute)) {
					$object->$attribute = $value;
				}
			}
		
			return $object;
		} else {
			return NULL;  // ****NOT SURE THIS IS GRACEFUL FAIL**debug: echo "user::instantiate = null";
		}
	}
	
	private function hasAttribute($attribute) {
		// get_object_vars returns an associative array with all attributes
		// (incl. private ones!)
		$objectVars = get_object_vars($this);
	
		// We don't care about the value, we just want to know if key exits
		return array_key_exists($attribute, $objectVars);
	}
	
// **debug:
// 	public function mbusertest($testvar = "") {
// 		echo "<br /><br />Current user objectvars: <br />  ";
// 		print_r(get_object_vars($this));
// 	}

}


?>