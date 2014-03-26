<?php

class Form {
	
	public $errors = array();
	public $fields=array();
	public $requiredFields=array();
	
	public function __construct($fields = array(), $requiredFields = array()) {
//         foreach($fields as $key => $value) {
//             $this->$key = $value;
//         }
		$this->fields = $fields;
		$this->requiredFields = $requiredFields;
			
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
		return isset($value) && $value !== "";
	}
	
	public function validatePresences() {
		global $errors;
		foreach($this->requiredFields as $field) {
			$value = trim($_POST[$field]);
			if (!hasPresence($value)) {
				$errors[$field] = fieldnameAsText($field) . " can't be blank";
			}
		}
	}
	
	// * string length
	// max length
	public function hasMaxLength($value, $max) {
		return strlen($value) <= $max;
	}
	
	
	public function validateMaxLengths($fieldsWithMaxLengths) {
		global $errors;
		// Expects an assoc. array
		foreach ($fieldsWithMaxLengths as $field => $max) {
			$value = trim($_POST[$field]);
			if (!hasMaxLength($value, $max)) {
				$errors[$field] = fieldnameAsText($field) . " is too long";
			}
		}
	}
	
	// * inclusion in a set
	public function hasInclusionIn($value, $set) {
		return in_array($value, $set);
	}
	
} 
?>