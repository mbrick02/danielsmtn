<?php

$errors = array();

function fieldnameAsText($fieldname) {
	$fieldname = str_replace("_", " ", $fieldname);
	$fieldname =ucfirst($fieldname);
	return $fieldname;
}

// * presence
// use trim() so empty spaces don't count
// use === to avoid false positives
// empty() would consider "0" to be empty
function hasPresence($value) {
	return isset($value) && $value !== "";
}

function validatePresences($requiredFields) {
	global $errors;
	foreach($requiredFields as $field) {
		$value = trim($_POST[$field]);
		if (!hasPresence($value)) {
			$errors[$field] = fieldnameAsText($field) . " can't be blank";
		}
	}
}

// * string length
// max length
function hasMaxLength($value, $max) {
	return strlen($value) <= $max;
}


function validateMaxLengths($fieldsWithMaxLengths) {
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
function hasInclusionIn($value, $set) {
	return in_array($value, $set);
}

?>