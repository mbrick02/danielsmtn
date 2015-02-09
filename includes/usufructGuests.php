<?php 
// If it's going to need the database then it's
//  probably smart to require it before we start. also need functions.php called by initialize
// user.php called by initialize.php, so, LIB_PATH available
require_once(LIB_PATH.DS.'database.php');  // called by initialize but require_once is safe

class UsufructGuest extends DatabaseObject {

	static $tableName="usufructGuests";
	private $IDField = "guestID";
	public $guestID;
	public $fName;
	public $lName;
	public $email;

	
	static protected $dbFields = array('guestID', 'fName', 'lName', 'email');	

	
	// *** MAY WANT TO MAKE THIS EXTEND USER and have user extend databasObject
	
	public function save() {
		// A new record won't have an id yet.
		return isset($this->id) ? $this->update() : $this->create();
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
			$this->id = $database->insertID();
			return true;
		} else {
			return false;
		}
	}
	
	protected function update() {
		global $database;
		
		$attributes = $this->sanitizedAttributes();
		$attributePairs = array();
		foreach($attributes as $key => $value) {
			$attributePairs[] = "{$key}='{$value}'";
		}
		$sql = "UPDATE ". self::$table_name. " SET ";
		$sql .= join(", ", $attributePairs);
		$sql .= " WHERE ". $this->IDField . "=". $database->escapeValue($this->$IDField);
	
		$database->query($sql);
		return ($database->affected_rows() == 1) ? true : false;
	}

}


?>