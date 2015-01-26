<?php 
// If it's going to need the database then it's
//  probably smart to require it before we start. also need functions.php called by initialize
// user.php called by initialize.php, so, LIB_PATH available
require_once(LIB_PATH.DS.'database.php');  // called by initialize but require_once is safe

// class dish extends databaseObject (maybe change to user) - currently code is included
class Dish {	
	protected static $tableName="dish";
	public $dishID; //  1/23/15 was id;
	public $fName;
	public $lName;
	public $dish;
	public $email;
	// public $dishTypeID;
	
	// was 'userID' in original DB object 
	protected static $dbFields = array('dishID', 'fName', 'lName', 'dish', 'email');	


	// *********** methods copied from user.php methods 
	// *** (tempted to extend--using mysql v5.5--this and user from db but ?differences in functions?**
	// note: these are public and not static--accessible from outside for an instance
	// although create and update() could be protected to force user to use save()
	public function save() {
		// A new record won't have an id yet.
		return isset($this->dishID) ? $this->update() : $this->create();
	}
	
	protected function attributes() {
		// return an array of attribute names and their values
		$attributes = array();
		foreach(self::$dbFields as $field) {
			if (property_exists($this, $field)) {
				// note below: $this->$field dynamically naming the attribute by $field variable value
				$attributes[$field] = $this->$field;
			}
		}
	return $attributes;
	}
	
	// ***below is old version***
// 	protected function attributes() {
// 		// return an array of attribute keys and their values
// 		// get_object_vars returns associative array with attributes as keys and values
// 		return get_object_vars($this);
// 	}

	public static function make($dishID="", $fName, $lName, $dish, $email){
		if(!empty($fName) && !empty($lName) && !empty($dish) && !empty($email)) {
			$dish = new Dish(); // notice capital "D" like class name
			
			$dish->dishID = $dishID; // **test for empty? how does that affect save() 
			$dish->dish = $dish;
			$dish->fName = $fName;
			$dish->lName = $lName;
			$dish->email = $email;
			return $dish;
		} else {
			return false;
		}
	}
	

	protected function sanitizedAttributes() {
		global $database;
		$cleanAttributes =  array();
		// sanitize the values before submitting
		// Note: does not alter the actual value of each attribute
		foreach($this->attributes() as $key => $value){
			$cleanAttributes[$key] = $database->escapeValue($value);
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
		$sql .= join(", ", array_keys($attributes));
		$sql .= ") VALUES ('";
		$sql .= join("', '", array_values($attributes));
		$sql .= "')";
		if($database->query($sql)) {
			$this->dishID = $database->insertID();
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
		$sql .= join(", ", $attributePairs);
		$sql .= " WHERE id=". $database->escapeValue($this->dishID);
	
		$database->query($sql);
		return ($database->affected_rows() == 1) ? true : false;
	}
	
	// Common Database Methods
	// *** below are Common Database Methods to be put in DatabaseObject (change self to static)
	// Note these are class methods (static) to save from instantiating an object 
	public static function findAll() {
		// returns object array
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
			return NULL;  // ****NOT SURE THIS IS GRACEFUL FAIL**debug: echo "User::instantiate = null";
		}
	}
	
	private function hasAttribute($attribute) {
		// get_object_vars returns an associative array with all attributes
		// (incl. private ones!)
		// *old: $objectVars = get_object_vars($this);
		$objectVars = $this->attributes();
	
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