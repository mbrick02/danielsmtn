<?php

class Form {
	
	private $errors = array();
	private $fields=array();
	private $requiredFields=array();
	private $fieldsWithMaxLengths=array();
	
	public function __construct($fields = array(), $requiredFields = array(), $fieldsWithMaxLengths = array()) {
//         foreach($fields as $key => $value) {
//             $this->$key = $value;
//         }
		$this->fields = $fields;
		$this->requiredFields = $requiredFields;
		$this->fieldsWithMaxLengths = $fieldsWithMaxLengths;
			
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
    				$session->setMessage(" Program error: " . $this->fieldnameAsText($field) . " not a form field ");
    			}
    		} else {
    			array_push($arySetObjValsResults, " Program error: " . $this->fieldnameAsText($field) . " not a ". User::$tableName . " DB field in "); // ** debug 4/2/14
    			$session->setMessage(" Program error: " . $this->fieldnameAsText($field) . " not a ". User::$tableName . " DB field in ");
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
	
	public function formErrors(){
	$output = "";
	if (!empty($this->errors)) {
		$output = "<div class=\"error\">";
		$output .= "Please fix the following errors:";
		$output .= "<ul>";
		foreach ($this->errors as $key => $error) {
			$output .= "<li>{$error}</li>";
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
=======
<?php

class Form {
	
	private $errors = array();
	private $fields=array();
	private $requiredFields=array();
	private $fieldsWithMaxLengths=array();
	
	public function __construct($fields = array(), $requiredFields = array(), $fieldsWithMaxLengths = array()) {
//         foreach($fields as $key => $value) {
//             $this->$key = $value;
//         }
		$this->fields = $fields;
		$this->requiredFields = $requiredFields;
		$this->fieldsWithMaxLengths = $fieldsWithMaxLengths;
			
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
    				$session->setMessage(" Program error: " . $this->fieldnameAsText($field) . " not a form field ");
    			}
    		} else {
    			array_push($arySetObjValsResults, " Program error: " . $this->fieldnameAsText($field) . " not a ". User::$tableName . " DB field in "); // ** debug 4/2/14
    			$session->setMessage(" Program error: " . $this->fieldnameAsText($field) . " not a ". User::$tableName . " DB field in ");
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
	
	public function formErrors(){
	$output = "";
	if (!empty($this->errors)) {
		$output = "<div class=\"error\">";
		$output .= "Please fix the following errors:";
		$output .= "<ul>";
		foreach ($this->errors as $key => $error) {
			$output .= "<li>{$error}</li>";
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
>>>>>>> be44c5109f7c177b58bbd86b2534dfe7d1859e51
?>