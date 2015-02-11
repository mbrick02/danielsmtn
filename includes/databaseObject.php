<?php 
// If it's going to need the database then it's
//  probably smart to require it before we start. also need functions.php called by initialize
// user.php called by initialize.php, so, LIB_PATH available
require_once(LIB_PATH.DS.'database.php');  // called by initialize but require_once is safe

class DatabaseObject {

	static protected $dbFields = array();

	protected function attributes() {
		// return an array of attribute names and their values
		$attributes = array();
		foreach(static::$dbFields as $field) {
			if (property_exists($this, $field)) {
				// note below: $this->$field dynamically naming the attribute by $field variable value
				$attributes[$field] = $this->$field;
			}
		}
		return $attributes;
	}	
	
	// Common Database Methods
	// *** below are Common Database now in DatabaseObject 
	// (code was/is in all db objects--no late binding before 5.4)
	// Note these are class methods (static) so you don't have to instantiate an object 
	public static function findAll() {
		// returns object array
		return static::findBySQL("SELECT * FROM " . static::$tableName);
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
			$object = new self;
	
			// example for below: $object->lName = $record['lName'];  // $record as ['lName']=>"Doe"
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