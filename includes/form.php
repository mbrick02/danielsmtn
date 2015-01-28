<?php
require_once("initialize.php");
class Form {
	private $errors = array();
	private $fields = array();
	private $requiredField = array();
	private $fieldsWithMaxLengths = array();
	
	static $tablename ="tbusers";  // default value (currently set to User table)
	
	public function __construct($tablename="", $fields = array(), $requiredFields = array(), $fieldsWithMaxLengths = array()) {
//         foreach($fields as $key => $value) {
//             $this->$key = $value;
//         }
		$this->fields = $fields;
		$this->requiredFields = $requiredFields;
		$this->fieldsWithMaxLengths = $fieldsWithMaxLengths;
		if(empty($tablename)){
			$this->tablename = $tablename;
		}	
    }
    
    public function setObjectVals($dbObject) {
    	global $session;
    	
    	foreach($this->fields as $field){
    		$updatedUser = false;
    		if(isset($dbObject->$field)) {
    			if (isset($_POST["{$field}"])) {
	    			$dbObject->$field = $_POST["{$field}"];
	    			$updatedUser = true;
    			} else {
    				$session->setMessage(" Program error: " . $this->fieldnameAsText($field) . " not a form field "); //** this only give last error rather than all errors
    			}
    		} else {
    			$session->setMessage(" Program error: " . $this->fieldnameAsText($field) . " not in " . $this->tableName);
    		}
    	}
    	
    	return $updatedUser;
    }
    
	public function fieldnameAsText($fieldname) {
		$fieldname = str_replace("_", " ", $fieldname);
		$fieldname =ucfirst($fieldname);
		return $fieldname;
	}
	
	// * presence
	// use trim() so empty spaces don't count
	// use === to avoid false positives
	// empty() would consider "0" to be empty
	public function hasPresence($value) {
		return isset($value) && ($value !== "");
	}
	
	public function validatePresences() {
		foreach($this->requiredFields as $field) {
			$value = trim($_POST[$field]);
			if (!$this->hasPresence($value)) {
				$this->errors[$field] = $this->fieldnameAsText($field) . " can't be blank";
			}
		}
	}
	
	// * string length
	// max length
	public function hasMaxLength($value, $max) {
		return strlen($value) <= $max;
	}
	
	
	public function validateMaxLengths($fieldsWithMaxLengths) {
		
		// Expects an assoc. array
		foreach ($fieldsWithMaxLengths as $field => $max) {
			$value = trim($_POST[$field]);
			if (!$this->hasMaxLength($value, $max)) {
				$this->errors[$field] = $this->fieldnameAsText($field) . " is too long";
			}
		}
	}
	
	// * inclusion in a set
	public function hasInclusionIn($value, $set) {
		return in_array($value, $set);
	}
	
	public function formErrors($errors){
	$output = "";
	$this->errors = $errors; // not sure if this should be: .= (to make sure I get previous session $errors?) 
	if (!empty($this->errors)) {
		$output = "<div class=\"error\">";
		$output .= "Please fix the following errors:";
		$output .= "<ul>";
		foreach ($this->errors as $key => $error) {
			$output .= "<li>{$key} has error: {$error}</li>";
		}
		$output .= "</ul>";
		$output .= "</div>";
	}

	return $output;
	}
	
	// *** possible method to test string presence
// 	public function IsThisInSet($this, $set){
// 		return (preg_match("/{$this}/", $set));
// 	}
	
} 