<?php
function redirectTo($newLocation = NULL) {
	if ($newLocation != NULL) {
		header("Location: " . $newLocation);
		exit;
	}
	
}

function outputMessage($message="") {
	if (!empty($message)) {
		return "<p class=\"message\">{$message}</p>";
	} else {
		return "";
	}
}

// __autoload is object function like __clone __constructor __destructor BUT outside object
function __autoload($className) {
	$className = strtolower($className);
	$path = LIB_PATH.DS."{$className}.php";
	if(file_exists($path)) {
		require_once($path);
	} else {
		die("The file {$className}.php could not be found.");
	}
}

function includeLayoutTemplate($template="") {
	include(LIB_PATH.DS.'layout'.DS.$template);
}

function mysqlPrep($string) {
	global $connection;
	
	$escapedString = mysqli_real_escape_string($connection, $string);
	return $escapedString;
}

function confirmQuery($resultSet) {
	if (!$resultSet) {
		die("Database query failed.");
	}
}

function formErrors($errors){
	$output = "";
	if (!empty($errors)) {
		$output = "<div class=\"error\">";
		$output .= "Please fix the following errors:";
		$output .= "<ul>";
		foreach ($errors as $key => $error) {
			$output .= "<li>{$error}</li>";
		}
		$output .= "</ul>";
		$output .= "</div>";
	}

	return $output;
}

function findAllAdmins() {
	global $connection;
	$query = "SELECT * ";
	$query .= "FROM admins ";
	// $query .= "ORDER BY adminLName ASC";
	// echo $query;
	$adminSet = mysqli_query($connection, $query);
	confirmQuery($adminSet);
	
	return $adminSet;
}

function findAdminByID($adminID) {
	global $connection;
	
	$safeAdminID = mysqli_real_escape_string($connection, $adminID);
	
	$query = "SELECT * ";
	$query .= "FROM admins ";
	$query .= "WHERE adminID = {$safeAdminID} ";
	$query .= "LIMIT 1";
	
	$adminsSet = mysqli_query($connection, $query);
	// echo $query;
	confirmQuery($adminsSet);
	
	if ($admin = mysqli_fetch_assoc($adminsSet)) {
		return $admin;
	} else {
		return null;
	}	
}

function dishAnchorPreTag($layoutContext, $dishID){
	if (($layoutContext == "admin") || ($layoutContext == "thisChef")) {  // if admin or dish of this chef, make editable
		$dishAPreTag = "<a href=\'editDish.php?dishID=" . urlencode($dishID) . "\'>";
	}  else {
		$dishAPreTag = "";
	}
	return $dishAPreTag;
}

function findAllDishes() {
	global $connection;
	$query = "SELECT * ";
	$query .= "FROM dish ";
	// $query .= "ORDER BY dish ASC";
	// echo $query;
	$dishesSet = mysqli_query($connection, $query);
	confirmQuery($dishesSet);
	
	return $dishesSet;
}

function findDishByID($dishID){
	global $connection;
	
	$safe_dishID = mysqli_real_escape_string($connection, $dishID);
	
	$query = "SELECT * ";
	$query .= "FROM dish ";
	$query .= "WHERE dishID = {$safe_dishID} ";
	$query .= "LIMIT 1";

	$dishesSet = mysqli_query($connection, $query);
	// echo $query;
	confirmQuery($dishesSet);
	
	if ($dish = mysqli_fetch_assoc($dishesSet)) {
		return $dish;
	} else {
		return null;
	}	
}

function checkUEmail($givenEmail){
	$validEmail = $givenEmail; // in future we will check the email against tbGuest of AccessDB
	return $validEmail;
	
}

function navigation(){
	$output = "<ul>";
	$output .= "<li><a href=\"./index.htm\">Home</a></li>";
	$output .= "<!-- probably need this to go to Usfruct for year -->";
	$output .= "<li><a href=\"./showDishes.php\">Show Dishes</a></li>";
	$output .= "<li><a href=\"./priv/loginDM.php\">&#43; Add, Edit or Delete Dish</a></li>";
	$output .= "</ul>";
	
	return $output;
}

?>