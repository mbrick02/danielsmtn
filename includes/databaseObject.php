<?php 
// If it's going to need the database then it's
//  probably smart to require it before we start. also need functions.php called by initialize
// user.php called by initialize.php, so, LIB_PATH available
require_once(LIB_PATH.DS.'database.php');  // called by initialize but require_once is safe

class DatabaseObject {

	protected static $tableName;
	
	protected static $dbFields = array('userID', 'fName', 'lName', 'email');
	
	protected static $funcSQL;
	
	protected static $IDField = "userID"; // *** default assumes table tbUsers
	
	public $email;

	// Common Database Methods moved to DatabaseObject - other classes will extend DatabaseObject
	// (code was/is in all db objects--no late binding before 5.4)
	// Note with class methods (static) you don't have to instantiate an object
	

	public function getIDField() {
		return static::$IDField;
	}
	
	protected static function attributes() { // called by: sanitizedAttributes() and hasAttribute()
		// return an array of attribute names and their values
		$attributes = array();
		foreach(static::$dbFields as $field) {
			if (property_exists(get_called_class(), $field)) {
				// note below: $this->$field dynamically naming the attribute by $field variable value
				$attributes[$field] = $field;
			}
		}
		return $attributes;
	}

	private function hasAttribute($attribute) { // called by: instantiate
		// get_object_vars returns an associative array with all attributes
		// (incl. private ones!)
		// *old: $objectVars = get_object_vars($this); // returned all attributes not just db
		$objectVars = $this->attributes();
		
		// We don't care about the value, we just want to know if key exits
		return array_key_exists($attribute, $objectVars);
	}

	protected static function sanitizedAttributes() {
		global $database;
		$cleanAttributes =  array();
		// sanitize the values before submitting
		// Note: does not alter the actual value of each attribute
		foreach(static::attributes() as $key => $value){
			$cleanAttributes[$key] = $database->escapeValue($value);
		}
		return $cleanAttributes;
	}
	
	public static function findAll() {
		// returns object array
		static::$funcSQL = "SELECT * FROM " . static::$tableName;
		return static::findBySQL(static::$funcSQL);
		// return static::$funcSQL . " - *DEBUG* - class: " . get_called_class();
	}
	
	public static function findByID($id=0) {
		global $database;
		// change to array: $resultSet = static::findBySQL("SELECT * FROM  " . static::$tableName . " WHERE id={$id} LIMIT 1");
		$resultObjArray = static::findBySQL("SELECT * FROM " . static::$tableName ." WHERE " . static::$IDField . "={$id} LIMIT 1");
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
			$objectArray[] = static::instantiate($row);
		}
		return $objectArray;
	}

	public static function findRecsByField($field="", $value) {
		global $database;
	
		if (property_exists($this, $field)) {  // ***still need to create isValidField or use similar function
			$resultObjArray = static::findBySQL("SELECT * FROM " . static::$tableName ." WHERE ". static::$field . "={$value}");
		} else {
			$resultObjArray = "";
		}
		return !empty($resultObjArray) ? $resultObjArray : false;
	}
		
	private static function instantiate($record) {
		// Could check that $record exists and is an array
		if (is_array($record)) {
			$className = get_called_class();
			$object = new $className;
			// **DOESNT WORK/HELP: $attributes = $object->attributes();   ** run this to set attributes? *
	
			// example for below: $object->lName = $record['lName'];  // $record as ['lName']=>"Doe"
			foreach($record as $attribute=>$value){
				// debug 2/16/15
				$dbgHsAttr = "Not an Attribute <br/>"; 
				if($object->hasAttribute($attribute)) {
					$object->$attribute = $value;
					echo " in INSTATITE " . $attribute . " = " . strval($value) . "<br>"; // *** DEBUG
					$dbgHsAttr = "Valid Attribute <br/>";
				}
				// DEBUG 2/17/15 echo "instantiate: " . $attribute . " - value: " . $value . "<br/>". $dbgHsAttr;
				// mysqli_free_result($record); // ** 2/1/15 not sure if this will blow up but might save memory
			}
		
			return $object;
		} else {
			return NULL;  // ****NOT SURE THIS IS GRACEFUL FAIL**debug: echo "User::instantiate = null";
		}
	}
	
	public function save() {
		$idField = self::getIDField();
		// A new record won't have an id yet.
		return isset($this->$idField) ? $this->update($idField) : $this->create();
	}

	
	protected function create() {
		global $database;
		// Don't forget SQL syntax and habits:
		//  - INSERT INTO table (key, key) VALUES ('value', 'value')
		// - single-quotes around all values
		// - escape all values to prevent SQL injection
		$attributes = $this->sanitizedAttributes();
	
		$sql = "INSERT INTO " . static::$tableName ." (";
		$sql .= join(", ", array_keys($attributes));
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
	
	protected function update($idField) {
		global $database;
	
		$attributes = $this->sanitizedAttributes();
		$attributePairs = array();
		
		// print_r($attributes);  // *** DEBUG
		
		foreach($attributes as $key => $value) {
			$attributePairs[] = "{$key}='{$value}'";
			echo " KEY = " . $key . " VALUE = " . $value . "<br>";  // *** DEBUG
		}
		$sql = "UPDATE ". static::$tableName . " SET ";
		$sql .= join(", ", $attributePairs);
		$sql .= " WHERE ". static::$IDField . "=". $database->escapeValue($this->$idField);
	
		echo $sql; // *** debug
		
		// $database->query($sql);
		return ($database->affectedRows() == 1) ? true : false;
	}
	
// 	public function **debug**mbusertest($testvar = "") {
// 		echo "<br /><br />Current databaseObject objectvars: <br />  ";
// 		print_r(get_object_vars($this));
// 	}
}


?>